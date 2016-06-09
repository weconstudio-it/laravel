<?php

namespace App\Http\Traits;

use Illuminate\Http\Request;
use Weconstudio\Grid\GridConfiguration;

trait GridOperations {

    /**
     * Elimina il record con id specificato
     *
     * @param Request $request
     * @param GridConfiguration $gridConfiguration
     * @return array|bool
     */
    private function grid_delete(Request $request, GridConfiguration $gridConfiguration) {
        try {
            if ($request->has('id')) {
                $id = intval($request->get('id'));
                $model = "{$gridConfiguration->model}Query";

                $instanceToDel = $model::create()->findPk($id);

                $ret = null;
                if (!is_null($instanceToDel) && method_exists($instanceToDel, 'delete')) {
                   $ret  = $instanceToDel->delete();
                }

                return [
                    'response' => true,
                    'message' => array($id => $ret)
                ];
            } else {
                if (!$request->has('id'))
                    throw new \Exception("An id should be specified for this operation: {$request->get('oper')}.");
            }
        } catch (\Exception $e) {
            return [
                'response' => false,
                'message' => $e->getMessage()
            ];
        }
    }

    /**
     * Crea un nuovo record dati i campi da aggiornare
     *
     * @param Request $request
     * @param GridConfiguration $gridConfiguration
     * @return bool|number
     */
    protected function grid_create(Request $request, GridConfiguration $gridConfiguration) {
        $model = $gridConfiguration->model;

        try {
            $data = $request->all();

            $obj = new $model();
            $obj->fromArray($data);
            $obj->save();

            return [
                'response' => true,
                'message' => array('id' => $obj->getId())
            ];
        } catch (\Exception $e) {
            return [
                'response' => false,
                'message' => $e->getMessage()
            ];
        }
    }

    /**
     * Aggiorna un record data la chiave primaria e i campi da aggionare
     *
     * @param array $parameters
     * @return number|boolean
     */
    protected function grid_update(Request $request, GridConfiguration $gridConfiguration) {
        try {
            if ($request->has('id')) {
                $id = intval($request->get("id"));

                $model = "{$gridConfiguration->model}Query";

                $instanceToEdit = $model::create()->findPk($id);

                if (!is_null($instanceToEdit)) {

                    try {
                        $instanceToEdit->fromArray($request->all());
                        $instanceToEdit->save();

                        return $id;
                    } catch (\Exception $e) {
                        return [
                            'response' => false,
                            'message' => $e->getMessage(),
                        ];
                    }

                } else {
                    return [
                        'response' => false,
                        'message' => "Object with ID: $id not found in (\"{$gridConfiguration->model}\")",
                    ];
                }
            }
        } catch (\Exception $e) {
            return [
                'response' => false,
                'message' => $e->getMessage()
            ];
        }

        return false;
    }

    /**
     * Gestore operazioni su griglia. Operazioni possibili:
     *  - del
     *  - edit
     *  - add
     *
     * @param Request $request
     * @param GridConfiguration $gridConfiguration
     * @return array
     * @throws \Exception
     */
    public function operation(Request $request, $gridConfiguration) {

        $gridConfiguration = $gridConfiguration = unserialize(\Session::get($gridConfiguration));

        try {
            if (!$request->has('oper')) {
                throw new \Exception("jqGrid operation not set.");
            }

            // in base all'operazione richiesta eseguo il codice opportuno
            switch ($request->get('oper')){
                case 'del':
                    $ret = $this->grid_delete($request, $gridConfiguration);

                    break;
                case "edit":
                    $ret = $this->grid_update($request, $gridConfiguration);

                    break;
                case "add":
                    $ret = $this->grid_create($request, $gridConfiguration);

                    break;
                default:
                    throw new \Exception("Operation jqgrid edit non gestita: {$request->get("oper")}");

                    break;
            }

            $response = $ret["response"];
            $message = $ret["message"];

        } catch (\Exception $ex) {
            $message = $ex->getMessage();
        }

        return response()->json([
            'response' => $request,
            'message' => $message
        ]);
    }

    private function manageFilters(Request $request) {

        $filters = json_decode(str_replace("\\", "", $request->get('filters')));
        $operator = $filters->groupOp; // AND, OR

        $sqlConditions = '';

        foreach ($filters->rules as $rule) {

            if ($rule->data == '##' || ($rule->field == 'id' && $rule->data == '0'))
                continue;

            // skip dei filtri se il filtro si basa su un filtro emulato
//            if(method_exists($showFields[$rule->field], "emulateFilter") && $showFields[$rule->field]->emulateFilter) {
//                $aFiltriEmulate[$rule->field] = array("op"=>$rule->op, "data"=>$rule->data);
//                continue;
//            }

            // possibilità di modificare il tipo di ricerca default di una colonna
            //if(isset($showFields[$rule->field]) && is_object($showFields[$rule->field]) && property_exists($showFields[$rule->field], 'searchMode') && trim($showFields[$rule->field]->searchMode) != ''){
            //$rule->op = trim($showFields[$rule->field]->searchMode);
            //}

            $sqlConditions .= ($sqlConditions == '') ? "" : " $operator ";

            switch ($rule->op){
                case 'eq':	// equal
                case 'e':	// equal bug?
                    $sqlConditions .= "{$rule->field} = '{$rule->data}'";
                    $conditions[] = $rule->data;
                    break;
                case "eq_str":
                    $sqlConditions .= "{$rule->field} = '{$rule->data}'";
                    break;
                case "key_val":
                    $sqlConditions .= "{$rule->field} = {$rule->data}";
                    $conditions[$rule->field] = $rule->data;
                    break;
                case 'ne':	// not equal
                    $sqlConditions .= "{$rule->field} != ?";
                    $conditions[] = $rule->data;
                    break;
                case 'lt':	// less
                    $sqlConditions .= "{$rule->field} < ?";
                    $conditions[] = $rule->data;
                    break;
                case 'le':	// less or equal
                    $sqlConditions .= "{$rule->field} <= ?";
                    $conditions[] = $rule->data;
                    break;
                case 'gt':	// greater
                    $sqlConditions .= "{$rule->field} > ?";
                    $conditions[] = $rule->data;
                    break;
                case 'ge':	// greater or equal
                    $sqlConditions .= "{$rule->field} >= ?";
                    $conditions[] = $rule->data;
                    break;
                case 'bw':	// begins with
                    $sqlConditions .= "{$rule->field} LIKE '{$rule->data}%'";
                    break;
                case 'bn':	// does not begin with
                    $sqlConditions .= "{$rule->field} NOT LIKE CONCAT(?, '%')";
                    $conditions[] = $rule->data;
                    break;
                case 'in':	// is in
                    break;
                case 'ni':	// is not in
                    break;
                case 'ew':	// ends with
                    $sqlConditions .= "{$rule->field} LIKE CONCAT('%', ?)";
                    $conditions[] = $rule->data;
                    break;
                case 'en':	// does not end with
                    $sqlConditions .= "{$rule->field} NOT LIKE CONCAT('%', ?)";
                    $conditions[] = $rule->data;
                    break;
                case 'cn':	// contains
                    $sqlConditions .= "{$rule->field} LIKE CONCAT('%', '{$rule->data}%', '%')";
                    $conditions[] = $rule->data;
                    break;
                case 'nc':	// does not contain
                    $sqlConditions .= "{$rule->field} NOT LIKE CONCAT('%', ?, '%')";
                    $conditions[] = $rule->data;
                    break;
            }
        }

        return $sqlConditions;
    }

    public function grid(Request $request, GridConfiguration $gridConfiguration) {

        $request->session()->set(sha1($gridConfiguration->id), serialize($gridConfiguration));

        // ----- base parameters ---------
        $row_num    = intval($request->input('rows', $gridConfiguration->rowNum));
        $page       = intval($request->input('page', 1));

        // configurazione delle colonne
        $fieldsConfiguration = $gridConfiguration->getColumns();

        if(isset($gridConfiguration->actions) && $gridConfiguration->actions) {
            $fieldsConfiguration = array_merge(array(''=>array(
                'formatter' => 'actions',
                'editable' => 'false',
                'search' => false,
                'width' => '50px')
            ), $fieldsConfiguration);
        }

        // se non sono state passate le colonne le estraggo tutte
        if (count($fieldsConfiguration) == 0) {
            throw new \Exception("Definire l'elenco delle colonne.");
        } else {
            //U::debug($fieldsConfiguration, 1);
            foreach ($fieldsConfiguration as $column) {
                /* @var $column GridColumnConfiguration */

                if (is_object($column))
                    $showFields[$column->index] = $column;
                else if (is_array($column) && isset($column['index'])) {
                    $showFields[$column['index']] = $column;
                } else {
                    $showFields[''] = $column;
                }
            }
        }

        $gridIdentifier = $gridConfiguration->id;

        $sqlConditions = '';

        if ($request->has('filters')) {
            $sqlConditions = $this->manageFilters($request);
        }

        // ----- model instantiation ---------
        $staticModelName = "{$gridConfiguration->model}Query";
        $staticModel = $staticModelName::create();
        $primaryKeys = array_keys($staticModel->getTableMap()->getPrimaryKeys());

        if (count($primaryKeys) == 0)
            throw new \InvalidArgumentException("No primary defined for model '$staticModelName'");

        // ----- elements counting ---------
        if (strlen($sqlConditions) > 0)
            $staticModel->where($sqlConditions);

        $elements_count = $staticModel->count();

        $data['page']   = $page;
        $data['total']  = ceil($elements_count / $row_num);
        $data['records'] = $elements_count;
        $data['rows'] = array();

        // ----- Estrazione dati ---------
        $sortColumn = $request->input('sidx', $primaryKeys[0]);
        $sord       = $request->input('sord', 'ASC');

        $sortColumn = rtrim(trim($sortColumn), ",");        // prevent concatenation errors
        $sortOrder = ((strpos(strtoupper($sortColumn), "ASC") === false && strpos(strtoupper($sortColumn), "DESC") === false) ? $sord : "" );

        // se arriva il parametro di ordinamento e non è stato scelto un ordinamento in tabella
        $aOrderField = array();
        if($sortColumn == ''){
            $order = $request->input('order', ''); // ($parameters, 'order', '');

            if($order!=""){
                $orderFields = explode(",", $order);

                foreach ($orderFields as $of){
                    $order = explode(" ", $of);
                    $sortColumn = $order[0];
                    $sortOrder = isset($order[1])?$order[1]:"ASC";

                    $aOrderField[$sortColumn] = $sortOrder;
                }
            }
        }

        $staticModel = $staticModelName::create();

        if (strlen($sqlConditions) > 0)
            $staticModel->where($sqlConditions);

        $searchObj = $staticModel
                        ->limit($row_num)
                        ->offset(($page - 1) * $row_num);

        if(count($aOrderField)){
            foreach ($aOrderField as $orderField=>$orderOrder){
                $searchObj->orderBy($orderField, $orderOrder);
            }
        }else{
            // TODO PD desbrick $searchObj->orderBy($sortColumn, $sortOrder);
        }

        // per ogni record estraggo le informazioni richieste
        $keyField = $primaryKeys[0];

        foreach ($searchObj->find() as $row) {
            $cell       = array();
            $skipRow    = false;

            foreach (array_keys($showFields) as $i => $column) {

                if (is_object($showFields[$column]))
                    $field = $showFields[$column]->name;
                else if(is_array($showFields[$column]) && isset($showFields[$column], $showFields[$column]['name']))
                    $field = $showFields[$column]['name'];
                else
                    $field = '';

                if(isset($aFiltriEmulate[$column])){
                    switch ($aFiltriEmulate[$column]['op']){
                        case "bw":
                            if(strpos($row->$column, $aFiltriEmulate[$column]['data'])===false)
                                $skipRow = true;
                            die('ciao');
                            break;
                    }
                }

                if (method_exists($row, $field)) {
                    $val = ($row->$field());
                } else {

                    if (method_exists($row, "get$field")) {
                        $mtd = "get$field";
                        $val = $row->$mtd();
                    } elseif ($field == '') {
                        $val= '';
                    }else {
                        $val = $row->getByName ($field);
                    }
                }

                if($val instanceof \DateTime){
                    $val = $val->format("Y-m-d H:i:s");
                }
                $cell[] = "$val";
            }

            if(!$skipRow)
                array_push($data['rows'], array('id' => $row->getByName ($primaryKeys[0]), 'cell' => $cell));
        }

        return response()->json($data);

























        // specifica se verrà emesso il JSON dei dati o l'HTML della griglia
        $showData = false;
        $data = array();
        $showFields = array();
        $colNames = '';
        $colModel = '';

        /* @var $this->model Prop */
        if (isset($parameters['gridConfiguration'])) {

            $gridConfiguration = $parameters['gridConfiguration'];	/* @var  $gridConfiguration  GridConfiguration */

            $rowNum = intval(U::arrayIsSet($parameters, 'rows', $gridConfiguration->rowNum));
            $conditions = U::arrayIsSet ($parameters, 'conditions', array());
            $forceParams = U::arrayIsSet ($parameters, 'forceParams', array());
            // configurazione dell'URL di richiesta dati

            $gridConfiguration->url .= "&data" . (count($conditions) > 0 ? "&" . http_build_query(array('conditions' => $conditions)) : "");
            $gridConfiguration->editurl .= "&a=operation" . (count($forceParams) > 0 ? "&" . http_build_query($forceParams) : "");
            $subgridUrl = $gridConfiguration->subgrid ? $gridConfiguration->subgrid : '';

            // configurazione delle colonne
            $fieldsConfiguration = $gridConfiguration->getColumns();

            if(isset($gridConfiguration->actions) && $gridConfiguration->actions) {
                $fieldsConfiguration = array_merge(array(''=>array(
                    'formatter' => 'actions',
                    'editable' => 'false',
                    'search' => false,
                    'width' => '50px')
                ), $fieldsConfiguration);
            }

            // se non sono state passate le colonne le estraggo tutte
            if (count($fieldsConfiguration) == 0) {
                throw new \Exception("Definire l'elenco delle colonne.");
            } else {
                //U::debug($fieldsConfiguration, 1);
                foreach ($fieldsConfiguration as $column) {
                    /* @var $column GridColumnConfiguration */

                    if (is_object($column))
                        $showFields[$column->index] = $column;
                    else if (is_array($column) && isset($column['index'])) {
                        $showFields[$column['index']] = $column;
                    } else {
                        $showFields[''] = $column;
                    }
                }
            }

            $gridIdentifier = $gridConfiguration->id;

            // se viene passato il parametro data -> ritorno il json opportuno
            if (true || isset($parameters['data'])) {
                $this->setOutput("text/json");

                $showData = true;

                // ------ estrazione dei dati richiesti
                // filtri
                $sqlConditions = "";

                if (count($conditions) > 0) {
                    $sqlConditions = $conditions[0];
                    $conditions = array();
                }

                $aFiltriEmulate = array();

                if (isset($parameters["filters"])) {
                    $filters = json_decode(str_replace("\\", "", $parameters["filters"]));
                    $operator = $filters->groupOp;
                    foreach ($filters->rules as $rule) {
                        /*if ($rule->data == '0')
                            continue;*/
                        //U::debug($this->model->get_primary_key(), 1);
                        if ($rule->data == '##' || ($rule->field == 'id' && $rule->data == '0'))
                            continue;

                        // skip dei filtri se il filtro si basa su un filtro emulato
                        if(method_exists($showFields[$rule->field], "emulateFilter") && $showFields[$rule->field]->emulateFilter) {
                            $aFiltriEmulate[$rule->field] = array("op"=>$rule->op, "data"=>$rule->data);
                            continue;
                        }

                        // possibilità di modificare il tipo di ricerca default di una colonna
                        if(isset($showFields[$rule->field]) && is_object($showFields[$rule->field]) && property_exists($showFields[$rule->field], 'searchMode') && trim($showFields[$rule->field]->searchMode) != ''){
                            $rule->op = trim($showFields[$rule->field]->searchMode);
                        }

                        //if(!in_array($rule->op, array('key_val')))
                        $sqlConditions .= ($sqlConditions == '') ? "" : " $operator ";
                        //var_dump($rule);

                        switch ($rule->op){
                            case 'eq':	// equal
                            case 'e':	// equal bug?
                                //$sqlConditions .= "{$rule->field} = ?";
                                $sqlConditions .= "{$rule->field} = '{$rule->data}'";
                                $conditions[] = $rule->data;
                                break;
                            case "eq_str":
                                $sqlConditions .= "{$rule->field} = '{$rule->data}'";
                                break;
                            case "key_val":
                                $sqlConditions .= "{$rule->field} = {$rule->data}";
                                $conditions[$rule->field] = $rule->data;
                                break;
                            case 'ne':	// not equal
                                $sqlConditions .= "{$rule->field} != ?";
                                $conditions[] = $rule->data;
                                break;
                            case 'lt':	// less
                                $sqlConditions .= "{$rule->field} < ?";
                                $conditions[] = $rule->data;
                                break;
                            case 'le':	// less or equal
                                $sqlConditions .= "{$rule->field} <= ?";
                                $conditions[] = $rule->data;
                                break;
                            case 'gt':	// greater
                                $sqlConditions .= "{$rule->field} > ?";
                                $conditions[] = $rule->data;
                                break;
                            case 'ge':	// greater or equal
                                $sqlConditions .= "{$rule->field} >= ?";
                                $conditions[] = $rule->data;
                                break;
                            case 'bw':	// begins with
                                $sqlConditions .= "{$rule->field} LIKE '{$rule->data}%'";
                                break;
                            case 'bn':	// does not begin with
                                $sqlConditions .= "{$rule->field} NOT LIKE CONCAT(?, '%')";
                                $conditions[] = $rule->data;
                                break;
                            case 'in':	// is in
                                break;
                            case 'ni':	// is not in
                                break;
                            case 'ew':	// ends with
                                $sqlConditions .= "{$rule->field} LIKE CONCAT('%', ?)";
                                $conditions[] = $rule->data;
                                break;
                            case 'en':	// does not end with
                                $sqlConditions .= "{$rule->field} NOT LIKE CONCAT('%', ?)";
                                $conditions[] = $rule->data;
                                break;
                            case 'cn':	// contains
                                $sqlConditions .= "{$rule->field} LIKE CONCAT('%', '{$rule->data}%', '%')";
                                $conditions[] = $rule->data;
                                break;
                            case 'nc':	// does not contain
                                $sqlConditions .= "{$rule->field} NOT LIKE CONCAT('%', ?, '%')";
                                $conditions[] = $rule->data;
                                break;
                        }
                    }
                }



                if ($sqlConditions != '') {
                    $conditions = array_merge(array($sqlConditions), $conditions);
                }

                $staticModel = "{$this->model}Query";
                $primaryKeys = array_keys($staticModel::create()->getTableMap()->getPrimaryKeys());

                // ----- Conteggio elementi ---------
                $count = $staticModel::create()
                    ->where($sqlConditions == '' ? '1=1' : $sqlConditions)
                    ->count();

                $data['page'] = intval(U::arrayIsSet($parameters, 'page', 1));
                $data['total'] = ceil($count / $rowNum);
                $data['records'] = $count;
                $data['rows'] = array();

                // ----- Estrazione dati ---------
                $sortColumn = U::arrayIsSet($parameters, 'sidx', $primaryKeys[0]);

                if(U::stringEndsWith($sortColumn, ',')){
                    $sortColumn = rtrim($sortColumn, ", ");
                }

                if($sortColumn == "")
                    $sortColumn = $primaryKeys[0];

                $sortOrder = ( (strpos($sortColumn, "asc")===false && strpos($sortColumn, "desc")===false) ? U::arrayIsSet($parameters, 'sord', 'asc'):"" );

                // se arriva il parametro di ordinamento e non è stato scelto un ordinamento in tabella
                $aOrderField = array();
                if(U::arrayIsSet($parameters, 'sidx','')==''){
                    $order = U::arrayIsSet($parameters, 'order', '');
                    if($order!=""){

                        $orderFields = explode(",", $order);

                        foreach ($orderFields as $of){
                            $order = explode(" ", $of);
                            $sortColumn = $order[0];
                            $sortOrder = isset($order[1])?$order[1]:"ASC";

                            $aOrderField[$sortColumn] = $sortOrder;
                        }

                    }
                }

                $rows = $staticModel::create()
                    ->where($sqlConditions == '' ? '1=1' : $sqlConditions)
                    ->limit($rowNum)
                    ->offset((intval($data['page']) - 1) * $rowNum);

                if(count($aOrderField)){
                    foreach ($aOrderField as $orderField=>$orderOrder){
                        $rows->orderBy($orderField, $orderOrder);
                    }
                }else{
                    $rows->orderBy($sortColumn, $sortOrder);
                }

                $rows->find();


                // per ogni record estraggo le informazioni richieste
                $keyField = $primaryKeys[0];

                foreach ($rows as $row) {
                    //$cell = $gridConfiguration->getNavBar()->edit || $gridConfiguration->getNavBar()->del ? array(' ') : array();
                    $cell = array();
                    $skipRow = false;

                    foreach (array_keys($showFields) as $i => $column) {

                        if (is_object($showFields[$column]))
                            $field = $showFields[$column]->name;
                        else if(is_array($showFields[$column]) && isset($showFields[$column], $showFields[$column]['name']))
                            $field = $showFields[$column]['name'];
                        else
                            $field = '';

                        if(isset($aFiltriEmulate[$column])){
                            switch ($aFiltriEmulate[$column]['op']){
                                case "bw":
                                    if(strpos($row->$column, $aFiltriEmulate[$column]['data'])===false)
                                        $skipRow = true;
                                    die('ciao');
                                    break;
                            }
                        }

                        if (method_exists($row, $field)) {
                            $val = ($row->$field());
                        } else {

                            if (method_exists($row, "get$field")) {
                                $mtd = "get$field";
                                $val = $row->$mtd();
                            } elseif ($field == '') {
                                $val= '';
                            }else {
                                $val = $row->getByName ($field);
                            }
                        }

                        if($val instanceof \DateTime){
                            $val = $val->format("Y-m-d H:i:s");
                        }
                        $cell[] = "$val";
                    }

                    if(!$skipRow)
                        array_push($data['rows'], array('id' => $row->getByName ($primaryKeys[0]), 'cell' => $cell));
                }

                // return dei dati
                return compact ('showData', 'data');
            } else {

                // creazione dati javascript per creazione griglia
                foreach (array_keys($showFields) as $column) {
                    $column = $showFields[$column];

                    // il campo è accettato solo se  parte del set dei campi base o se contiene un '_' e quindi è un campo correlato
                    if (in_array($column->name, $columns) || strpos($column->name, '_') !== false || (method_exists($this->model, $column->name))) {
                        $colNames .= "'{$column->getLabel()}',";
                        $colModel .= "{$column->getJson()},";
                    }
                }

                $rowList = $gridConfiguration->rowList;
                $caption = $gridConfiguration->caption;

                // return per vista HTML griglia
                return compact ('showData', 'columns', 'rowNum', 'rowList', 'url', 'editUrl','colNames', 'colModel','data', 'caption', 'gridIdentifier', 'subgridUrl', 'gridEvents', 'gridConfiguration');
            }
        } else {
            throw new \Exception("gridConfiguration must be defined");
        }
    }
}