<?php

namespace App\Models\Map;

use App\Models\FailedJobs;
use App\Models\FailedJobsQuery;
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
 * This class defines the structure of the 'failed_jobs' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class FailedJobsTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.FailedJobsTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'failed_jobs';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\App\\Models\\FailedJobs';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'FailedJobs';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 5;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 5;

    /**
     * the column name for the connection field
     */
    const COL_CONNECTION = 'failed_jobs.connection';

    /**
     * the column name for the queue field
     */
    const COL_QUEUE = 'failed_jobs.queue';

    /**
     * the column name for the payload field
     */
    const COL_PAYLOAD = 'failed_jobs.payload';

    /**
     * the column name for the failed_at field
     */
    const COL_FAILED_AT = 'failed_jobs.failed_at';

    /**
     * the column name for the id field
     */
    const COL_ID = 'failed_jobs.id';

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
        self::TYPE_PHPNAME       => array('Connection', 'Queue', 'Payload', 'FailedAt', 'Id', ),
        self::TYPE_CAMELNAME     => array('connection', 'queue', 'payload', 'failedAt', 'id', ),
        self::TYPE_COLNAME       => array(FailedJobsTableMap::COL_CONNECTION, FailedJobsTableMap::COL_QUEUE, FailedJobsTableMap::COL_PAYLOAD, FailedJobsTableMap::COL_FAILED_AT, FailedJobsTableMap::COL_ID, ),
        self::TYPE_FIELDNAME     => array('connection', 'queue', 'payload', 'failed_at', 'id', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Connection' => 0, 'Queue' => 1, 'Payload' => 2, 'FailedAt' => 3, 'Id' => 4, ),
        self::TYPE_CAMELNAME     => array('connection' => 0, 'queue' => 1, 'payload' => 2, 'failedAt' => 3, 'id' => 4, ),
        self::TYPE_COLNAME       => array(FailedJobsTableMap::COL_CONNECTION => 0, FailedJobsTableMap::COL_QUEUE => 1, FailedJobsTableMap::COL_PAYLOAD => 2, FailedJobsTableMap::COL_FAILED_AT => 3, FailedJobsTableMap::COL_ID => 4, ),
        self::TYPE_FIELDNAME     => array('connection' => 0, 'queue' => 1, 'payload' => 2, 'failed_at' => 3, 'id' => 4, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, )
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
        $this->setName('failed_jobs');
        $this->setPhpName('FailedJobs');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\App\\Models\\FailedJobs');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addColumn('connection', 'Connection', 'LONGVARCHAR', true, null, null);
        $this->addColumn('queue', 'Queue', 'LONGVARCHAR', true, null, null);
        $this->addColumn('payload', 'Payload', 'CLOB', true, null, null);
        $this->addColumn('failed_at', 'FailedAt', 'TIMESTAMP', true, null, 'CURRENT_TIMESTAMP');
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
        if ($row[TableMap::TYPE_NUM == $indexType ? 4 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return (string) $row[TableMap::TYPE_NUM == $indexType ? 4 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
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
                ? 4 + $offset
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
        return $withPrefix ? FailedJobsTableMap::CLASS_DEFAULT : FailedJobsTableMap::OM_CLASS;
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
     * @return array           (FailedJobs object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = FailedJobsTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = FailedJobsTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + FailedJobsTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = FailedJobsTableMap::OM_CLASS;
            /** @var FailedJobs $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            FailedJobsTableMap::addInstanceToPool($obj, $key);
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
            $key = FailedJobsTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = FailedJobsTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var FailedJobs $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                FailedJobsTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(FailedJobsTableMap::COL_CONNECTION);
            $criteria->addSelectColumn(FailedJobsTableMap::COL_QUEUE);
            $criteria->addSelectColumn(FailedJobsTableMap::COL_PAYLOAD);
            $criteria->addSelectColumn(FailedJobsTableMap::COL_FAILED_AT);
            $criteria->addSelectColumn(FailedJobsTableMap::COL_ID);
        } else {
            $criteria->addSelectColumn($alias . '.connection');
            $criteria->addSelectColumn($alias . '.queue');
            $criteria->addSelectColumn($alias . '.payload');
            $criteria->addSelectColumn($alias . '.failed_at');
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
        return Propel::getServiceContainer()->getDatabaseMap(FailedJobsTableMap::DATABASE_NAME)->getTable(FailedJobsTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(FailedJobsTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(FailedJobsTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new FailedJobsTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a FailedJobs or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or FailedJobs object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(FailedJobsTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \App\Models\FailedJobs) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(FailedJobsTableMap::DATABASE_NAME);
            $criteria->add(FailedJobsTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = FailedJobsQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            FailedJobsTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                FailedJobsTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the failed_jobs table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return FailedJobsQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a FailedJobs or Criteria object.
     *
     * @param mixed               $criteria Criteria or FailedJobs object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(FailedJobsTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from FailedJobs object
        }

        if ($criteria->containsKey(FailedJobsTableMap::COL_ID) && $criteria->keyContainsValue(FailedJobsTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.FailedJobsTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = FailedJobsQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // FailedJobsTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
FailedJobsTableMap::buildTableMap();
