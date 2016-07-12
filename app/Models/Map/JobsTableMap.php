<?php

namespace App\Models\Map;

use App\Models\Jobs;
use App\Models\JobsQuery;
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
 * This class defines the structure of the 'jobs' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class JobsTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.JobsTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'jobs';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\App\\Models\\Jobs';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Jobs';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 9;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 9;

    /**
     * the column name for the queue field
     */
    const COL_QUEUE = 'jobs.queue';

    /**
     * the column name for the payload field
     */
    const COL_PAYLOAD = 'jobs.payload';

    /**
     * the column name for the attempts field
     */
    const COL_ATTEMPTS = 'jobs.attempts';

    /**
     * the column name for the reserved field
     */
    const COL_RESERVED = 'jobs.reserved';

    /**
     * the column name for the reserved_at field
     */
    const COL_RESERVED_AT = 'jobs.reserved_at';

    /**
     * the column name for the available_at field
     */
    const COL_AVAILABLE_AT = 'jobs.available_at';

    /**
     * the column name for the created_at field
     */
    const COL_CREATED_AT = 'jobs.created_at';

    /**
     * the column name for the updated_at field
     */
    const COL_UPDATED_AT = 'jobs.updated_at';

    /**
     * the column name for the id field
     */
    const COL_ID = 'jobs.id';

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
        self::TYPE_PHPNAME       => array('Queue', 'Payload', 'Attempts', 'Reserved', 'ReservedAt', 'AvailableAt', 'CreatedAt', 'UpdatedAt', 'Id', ),
        self::TYPE_CAMELNAME     => array('queue', 'payload', 'attempts', 'reserved', 'reservedAt', 'availableAt', 'createdAt', 'updatedAt', 'id', ),
        self::TYPE_COLNAME       => array(JobsTableMap::COL_QUEUE, JobsTableMap::COL_PAYLOAD, JobsTableMap::COL_ATTEMPTS, JobsTableMap::COL_RESERVED, JobsTableMap::COL_RESERVED_AT, JobsTableMap::COL_AVAILABLE_AT, JobsTableMap::COL_CREATED_AT, JobsTableMap::COL_UPDATED_AT, JobsTableMap::COL_ID, ),
        self::TYPE_FIELDNAME     => array('queue', 'payload', 'attempts', 'reserved', 'reserved_at', 'available_at', 'created_at', 'updated_at', 'id', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Queue' => 0, 'Payload' => 1, 'Attempts' => 2, 'Reserved' => 3, 'ReservedAt' => 4, 'AvailableAt' => 5, 'CreatedAt' => 6, 'UpdatedAt' => 7, 'Id' => 8, ),
        self::TYPE_CAMELNAME     => array('queue' => 0, 'payload' => 1, 'attempts' => 2, 'reserved' => 3, 'reservedAt' => 4, 'availableAt' => 5, 'createdAt' => 6, 'updatedAt' => 7, 'id' => 8, ),
        self::TYPE_COLNAME       => array(JobsTableMap::COL_QUEUE => 0, JobsTableMap::COL_PAYLOAD => 1, JobsTableMap::COL_ATTEMPTS => 2, JobsTableMap::COL_RESERVED => 3, JobsTableMap::COL_RESERVED_AT => 4, JobsTableMap::COL_AVAILABLE_AT => 5, JobsTableMap::COL_CREATED_AT => 6, JobsTableMap::COL_UPDATED_AT => 7, JobsTableMap::COL_ID => 8, ),
        self::TYPE_FIELDNAME     => array('queue' => 0, 'payload' => 1, 'attempts' => 2, 'reserved' => 3, 'reserved_at' => 4, 'available_at' => 5, 'created_at' => 6, 'updated_at' => 7, 'id' => 8, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, )
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
        $this->setName('jobs');
        $this->setPhpName('Jobs');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\App\\Models\\Jobs');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addColumn('queue', 'Queue', 'VARCHAR', true, 255, null);
        $this->addColumn('payload', 'Payload', 'CLOB', true, null, null);
        $this->addColumn('attempts', 'Attempts', 'TINYINT', true, 3, null);
        $this->addColumn('reserved', 'Reserved', 'TINYINT', true, 3, null);
        $this->addColumn('reserved_at', 'ReservedAt', 'INTEGER', false, 10, null);
        $this->addColumn('available_at', 'AvailableAt', 'INTEGER', true, 10, null);
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 8 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return (string) $row[TableMap::TYPE_NUM == $indexType ? 8 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
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
                ? 8 + $offset
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
        return $withPrefix ? JobsTableMap::CLASS_DEFAULT : JobsTableMap::OM_CLASS;
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
     * @return array           (Jobs object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = JobsTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = JobsTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + JobsTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = JobsTableMap::OM_CLASS;
            /** @var Jobs $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            JobsTableMap::addInstanceToPool($obj, $key);
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
            $key = JobsTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = JobsTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Jobs $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                JobsTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(JobsTableMap::COL_QUEUE);
            $criteria->addSelectColumn(JobsTableMap::COL_PAYLOAD);
            $criteria->addSelectColumn(JobsTableMap::COL_ATTEMPTS);
            $criteria->addSelectColumn(JobsTableMap::COL_RESERVED);
            $criteria->addSelectColumn(JobsTableMap::COL_RESERVED_AT);
            $criteria->addSelectColumn(JobsTableMap::COL_AVAILABLE_AT);
            $criteria->addSelectColumn(JobsTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(JobsTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(JobsTableMap::COL_ID);
        } else {
            $criteria->addSelectColumn($alias . '.queue');
            $criteria->addSelectColumn($alias . '.payload');
            $criteria->addSelectColumn($alias . '.attempts');
            $criteria->addSelectColumn($alias . '.reserved');
            $criteria->addSelectColumn($alias . '.reserved_at');
            $criteria->addSelectColumn($alias . '.available_at');
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
        return Propel::getServiceContainer()->getDatabaseMap(JobsTableMap::DATABASE_NAME)->getTable(JobsTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(JobsTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(JobsTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new JobsTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Jobs or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Jobs object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(JobsTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \App\Models\Jobs) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(JobsTableMap::DATABASE_NAME);
            $criteria->add(JobsTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = JobsQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            JobsTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                JobsTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the jobs table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return JobsQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Jobs or Criteria object.
     *
     * @param mixed               $criteria Criteria or Jobs object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(JobsTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Jobs object
        }

        if ($criteria->containsKey(JobsTableMap::COL_ID) && $criteria->keyContainsValue(JobsTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.JobsTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = JobsQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // JobsTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
JobsTableMap::buildTableMap();
