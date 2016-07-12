<?php

namespace App\Models\Map;

use App\Models\CurrenciesRateValidity;
use App\Models\CurrenciesRateValidityQuery;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;


/**
 * This class defines the structure of the 'currencies_rate_validity' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class CurrenciesRateValidityTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.CurrenciesRateValidityTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'currencies_rate_validity';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\App\\Models\\CurrenciesRateValidity';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'CurrenciesRateValidity';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 8;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 8;

    /**
     * the column name for the id_currency field
     */
    const COL_ID_CURRENCY = 'currencies_rate_validity.id_currency';

    /**
     * the column name for the start field
     */
    const COL_START = 'currencies_rate_validity.start';

    /**
     * the column name for the end field
     */
    const COL_END = 'currencies_rate_validity.end';

    /**
     * the column name for the value field
     */
    const COL_VALUE = 'currencies_rate_validity.value';

    /**
     * the column name for the active field
     */
    const COL_ACTIVE = 'currencies_rate_validity.active';

    /**
     * the column name for the created_at field
     */
    const COL_CREATED_AT = 'currencies_rate_validity.created_at';

    /**
     * the column name for the updated_at field
     */
    const COL_UPDATED_AT = 'currencies_rate_validity.updated_at';

    /**
     * the column name for the id field
     */
    const COL_ID = 'currencies_rate_validity.id';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('IdCurrency', 'Start', 'End', 'Value', 'Active', 'CreatedAt', 'UpdatedAt', 'Id', ),
        self::TYPE_CAMELNAME     => array('idCurrency', 'start', 'end', 'value', 'active', 'createdAt', 'updatedAt', 'id', ),
        self::TYPE_COLNAME       => array(CurrenciesRateValidityTableMap::COL_ID_CURRENCY, CurrenciesRateValidityTableMap::COL_START, CurrenciesRateValidityTableMap::COL_END, CurrenciesRateValidityTableMap::COL_VALUE, CurrenciesRateValidityTableMap::COL_ACTIVE, CurrenciesRateValidityTableMap::COL_CREATED_AT, CurrenciesRateValidityTableMap::COL_UPDATED_AT, CurrenciesRateValidityTableMap::COL_ID, ),
        self::TYPE_FIELDNAME     => array('id_currency', 'start', 'end', 'value', 'active', 'created_at', 'updated_at', 'id', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('IdCurrency' => 0, 'Start' => 1, 'End' => 2, 'Value' => 3, 'Active' => 4, 'CreatedAt' => 5, 'UpdatedAt' => 6, 'Id' => 7, ),
        self::TYPE_CAMELNAME     => array('idCurrency' => 0, 'start' => 1, 'end' => 2, 'value' => 3, 'active' => 4, 'createdAt' => 5, 'updatedAt' => 6, 'id' => 7, ),
        self::TYPE_COLNAME       => array(CurrenciesRateValidityTableMap::COL_ID_CURRENCY => 0, CurrenciesRateValidityTableMap::COL_START => 1, CurrenciesRateValidityTableMap::COL_END => 2, CurrenciesRateValidityTableMap::COL_VALUE => 3, CurrenciesRateValidityTableMap::COL_ACTIVE => 4, CurrenciesRateValidityTableMap::COL_CREATED_AT => 5, CurrenciesRateValidityTableMap::COL_UPDATED_AT => 6, CurrenciesRateValidityTableMap::COL_ID => 7, ),
        self::TYPE_FIELDNAME     => array('id_currency' => 0, 'start' => 1, 'end' => 2, 'value' => 3, 'active' => 4, 'created_at' => 5, 'updated_at' => 6, 'id' => 7, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, )
    );

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('currencies_rate_validity');
        $this->setPhpName('CurrenciesRateValidity');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\App\\Models\\CurrenciesRateValidity');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addForeignKey('id_currency', 'IdCurrency', 'INTEGER', 'currency', 'id', true, null, null);
        $this->addColumn('start', 'Start', 'DATE', true, null, null);
        $this->addColumn('end', 'End', 'DATE', true, null, null);
        $this->addColumn('value', 'Value', 'DECIMAL', true, 10, null);
        $this->addColumn('active', 'Active', 'BOOLEAN', true, 1, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Currency', '\\App\\Models\\Currency', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':id_currency',
    1 => ':id',
  ),
), 'CASCADE', 'CASCADE', null, false);
    } // buildRelations()

    /**
     *
     * Gets the list of behaviors registered for this table
     *
     * @return array Associative array (name => parameters) of behaviors
     */
    public function getBehaviors()
    {
        return array(
            'timestampable' => array('create_column' => 'created_at', 'update_column' => 'updated_at', 'disable_created_at' => 'false', 'disable_updated_at' => 'false', ),
            'auto_add_pk' => array('name' => 'id', 'autoIncrement' => 'true', 'type' => 'INTEGER', ),
        );
    } // getBehaviors()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 7 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return (string) $row[TableMap::TYPE_NUM == $indexType ? 7 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        return (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 7 + $offset
                : self::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)
        ];
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param boolean $withPrefix Whether or not to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass($withPrefix = true)
    {
        return $withPrefix ? CurrenciesRateValidityTableMap::CLASS_DEFAULT : CurrenciesRateValidityTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array  $row       row returned by DataFetcher->fetch().
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array           (CurrenciesRateValidity object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = CurrenciesRateValidityTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = CurrenciesRateValidityTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + CurrenciesRateValidityTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = CurrenciesRateValidityTableMap::OM_CLASS;
            /** @var CurrenciesRateValidity $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            CurrenciesRateValidityTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = CurrenciesRateValidityTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = CurrenciesRateValidityTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var CurrenciesRateValidity $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                CurrenciesRateValidityTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria object containing the columns to add.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(CurrenciesRateValidityTableMap::COL_ID_CURRENCY);
            $criteria->addSelectColumn(CurrenciesRateValidityTableMap::COL_START);
            $criteria->addSelectColumn(CurrenciesRateValidityTableMap::COL_END);
            $criteria->addSelectColumn(CurrenciesRateValidityTableMap::COL_VALUE);
            $criteria->addSelectColumn(CurrenciesRateValidityTableMap::COL_ACTIVE);
            $criteria->addSelectColumn(CurrenciesRateValidityTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(CurrenciesRateValidityTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(CurrenciesRateValidityTableMap::COL_ID);
        } else {
            $criteria->addSelectColumn($alias . '.id_currency');
            $criteria->addSelectColumn($alias . '.start');
            $criteria->addSelectColumn($alias . '.end');
            $criteria->addSelectColumn($alias . '.value');
            $criteria->addSelectColumn($alias . '.active');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
            $criteria->addSelectColumn($alias . '.id');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getServiceContainer()->getDatabaseMap(CurrenciesRateValidityTableMap::DATABASE_NAME)->getTable(CurrenciesRateValidityTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(CurrenciesRateValidityTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(CurrenciesRateValidityTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new CurrenciesRateValidityTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a CurrenciesRateValidity or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or CurrenciesRateValidity object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param  ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CurrenciesRateValidityTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \App\Models\CurrenciesRateValidity) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(CurrenciesRateValidityTableMap::DATABASE_NAME);
            $criteria->add(CurrenciesRateValidityTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = CurrenciesRateValidityQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            CurrenciesRateValidityTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                CurrenciesRateValidityTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the currencies_rate_validity table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return CurrenciesRateValidityQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a CurrenciesRateValidity or Criteria object.
     *
     * @param mixed               $criteria Criteria or CurrenciesRateValidity object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CurrenciesRateValidityTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from CurrenciesRateValidity object
        }

        if ($criteria->containsKey(CurrenciesRateValidityTableMap::COL_ID) && $criteria->keyContainsValue(CurrenciesRateValidityTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.CurrenciesRateValidityTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = CurrenciesRateValidityQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // CurrenciesRateValidityTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
CurrenciesRateValidityTableMap::buildTableMap();
