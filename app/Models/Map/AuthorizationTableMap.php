<?php

namespace App\Models\Map;

use App\Models\Authorization;
use App\Models\AuthorizationQuery;
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
 * This class defines the structure of the 'authorization' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class AuthorizationTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.AuthorizationTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'authorization';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\App\\Models\\Authorization';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Authorization';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 11;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 11;

    /**
     * the column name for the uri field
     */
    const COL_URI = 'authorization.uri';

    /**
     * the column name for the method field
     */
    const COL_METHOD = 'authorization.method';

    /**
     * the column name for the id_user field
     */
    const COL_ID_USER = 'authorization.id_user';

    /**
     * the column name for the id_user_group field
     */
    const COL_ID_USER_GROUP = 'authorization.id_user_group';

    /**
     * the column name for the order field
     */
    const COL_ORDER = 'authorization.order';

    /**
     * the column name for the policy field
     */
    const COL_POLICY = 'authorization.policy';

    /**
     * the column name for the label field
     */
    const COL_LABEL = 'authorization.label';

    /**
     * the column name for the enabled field
     */
    const COL_ENABLED = 'authorization.enabled';

    /**
     * the column name for the created_at field
     */
    const COL_CREATED_AT = 'authorization.created_at';

    /**
     * the column name for the updated_at field
     */
    const COL_UPDATED_AT = 'authorization.updated_at';

    /**
     * the column name for the id field
     */
    const COL_ID = 'authorization.id';

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
        self::TYPE_PHPNAME       => array('Uri', 'Method', 'IdUser', 'IdUserGroup', 'Order', 'Policy', 'Label', 'Enabled', 'CreatedAt', 'UpdatedAt', 'Id', ),
        self::TYPE_CAMELNAME     => array('uri', 'method', 'idUser', 'idUserGroup', 'order', 'policy', 'label', 'enabled', 'createdAt', 'updatedAt', 'id', ),
        self::TYPE_COLNAME       => array(AuthorizationTableMap::COL_URI, AuthorizationTableMap::COL_METHOD, AuthorizationTableMap::COL_ID_USER, AuthorizationTableMap::COL_ID_USER_GROUP, AuthorizationTableMap::COL_ORDER, AuthorizationTableMap::COL_POLICY, AuthorizationTableMap::COL_LABEL, AuthorizationTableMap::COL_ENABLED, AuthorizationTableMap::COL_CREATED_AT, AuthorizationTableMap::COL_UPDATED_AT, AuthorizationTableMap::COL_ID, ),
        self::TYPE_FIELDNAME     => array('uri', 'method', 'id_user', 'id_user_group', 'order', 'policy', 'label', 'enabled', 'created_at', 'updated_at', 'id', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Uri' => 0, 'Method' => 1, 'IdUser' => 2, 'IdUserGroup' => 3, 'Order' => 4, 'Policy' => 5, 'Label' => 6, 'Enabled' => 7, 'CreatedAt' => 8, 'UpdatedAt' => 9, 'Id' => 10, ),
        self::TYPE_CAMELNAME     => array('uri' => 0, 'method' => 1, 'idUser' => 2, 'idUserGroup' => 3, 'order' => 4, 'policy' => 5, 'label' => 6, 'enabled' => 7, 'createdAt' => 8, 'updatedAt' => 9, 'id' => 10, ),
        self::TYPE_COLNAME       => array(AuthorizationTableMap::COL_URI => 0, AuthorizationTableMap::COL_METHOD => 1, AuthorizationTableMap::COL_ID_USER => 2, AuthorizationTableMap::COL_ID_USER_GROUP => 3, AuthorizationTableMap::COL_ORDER => 4, AuthorizationTableMap::COL_POLICY => 5, AuthorizationTableMap::COL_LABEL => 6, AuthorizationTableMap::COL_ENABLED => 7, AuthorizationTableMap::COL_CREATED_AT => 8, AuthorizationTableMap::COL_UPDATED_AT => 9, AuthorizationTableMap::COL_ID => 10, ),
        self::TYPE_FIELDNAME     => array('uri' => 0, 'method' => 1, 'id_user' => 2, 'id_user_group' => 3, 'order' => 4, 'policy' => 5, 'label' => 6, 'enabled' => 7, 'created_at' => 8, 'updated_at' => 9, 'id' => 10, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, )
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
        $this->setName('authorization');
        $this->setPhpName('Authorization');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\App\\Models\\Authorization');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addColumn('uri', 'Uri', 'VARCHAR', true, 255, null);
        $this->addColumn('method', 'Method', 'VARCHAR', false, 255, null);
        $this->addColumn('id_user', 'IdUser', 'INTEGER', false, null, null);
        $this->addColumn('id_user_group', 'IdUserGroup', 'INTEGER', false, null, null);
        $this->addColumn('order', 'Order', 'INTEGER', false, null, null);
        $this->addColumn('policy', 'Policy', 'BOOLEAN', true, 1, true);
        $this->addColumn('label', 'Label', 'VARCHAR', false, 255, null);
        $this->addColumn('enabled', 'Enabled', 'BOOLEAN', true, 1, true);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 10 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return (string) $row[TableMap::TYPE_NUM == $indexType ? 10 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
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
                ? 10 + $offset
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
        return $withPrefix ? AuthorizationTableMap::CLASS_DEFAULT : AuthorizationTableMap::OM_CLASS;
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
     * @return array           (Authorization object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = AuthorizationTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = AuthorizationTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + AuthorizationTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = AuthorizationTableMap::OM_CLASS;
            /** @var Authorization $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            AuthorizationTableMap::addInstanceToPool($obj, $key);
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
            $key = AuthorizationTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = AuthorizationTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Authorization $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                AuthorizationTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(AuthorizationTableMap::COL_URI);
            $criteria->addSelectColumn(AuthorizationTableMap::COL_METHOD);
            $criteria->addSelectColumn(AuthorizationTableMap::COL_ID_USER);
            $criteria->addSelectColumn(AuthorizationTableMap::COL_ID_USER_GROUP);
            $criteria->addSelectColumn(AuthorizationTableMap::COL_ORDER);
            $criteria->addSelectColumn(AuthorizationTableMap::COL_POLICY);
            $criteria->addSelectColumn(AuthorizationTableMap::COL_LABEL);
            $criteria->addSelectColumn(AuthorizationTableMap::COL_ENABLED);
            $criteria->addSelectColumn(AuthorizationTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(AuthorizationTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(AuthorizationTableMap::COL_ID);
        } else {
            $criteria->addSelectColumn($alias . '.uri');
            $criteria->addSelectColumn($alias . '.method');
            $criteria->addSelectColumn($alias . '.id_user');
            $criteria->addSelectColumn($alias . '.id_user_group');
            $criteria->addSelectColumn($alias . '.order');
            $criteria->addSelectColumn($alias . '.policy');
            $criteria->addSelectColumn($alias . '.label');
            $criteria->addSelectColumn($alias . '.enabled');
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
        return Propel::getServiceContainer()->getDatabaseMap(AuthorizationTableMap::DATABASE_NAME)->getTable(AuthorizationTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(AuthorizationTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(AuthorizationTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new AuthorizationTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Authorization or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Authorization object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(AuthorizationTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \App\Models\Authorization) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(AuthorizationTableMap::DATABASE_NAME);
            $criteria->add(AuthorizationTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = AuthorizationQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            AuthorizationTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                AuthorizationTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the authorization table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return AuthorizationQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Authorization or Criteria object.
     *
     * @param mixed               $criteria Criteria or Authorization object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(AuthorizationTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Authorization object
        }

        if ($criteria->containsKey(AuthorizationTableMap::COL_ID) && $criteria->keyContainsValue(AuthorizationTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.AuthorizationTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = AuthorizationQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // AuthorizationTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
AuthorizationTableMap::buildTableMap();
