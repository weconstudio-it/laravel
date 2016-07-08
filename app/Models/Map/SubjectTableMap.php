<?php

namespace App\Models\Map;

use App\Models\Subject;
use App\Models\SubjectQuery;
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
 * This class defines the structure of the 'subject' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class SubjectTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.SubjectTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'subject';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\App\\Models\\Subject';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Subject';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 15;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 15;

    /**
     * the column name for the id field
     */
    const COL_ID = 'subject.id';

    /**
     * the column name for the active field
     */
    const COL_ACTIVE = 'subject.active';

    /**
     * the column name for the iso field
     */
    const COL_ISO = 'subject.iso';

    /**
     * the column name for the first_name field
     */
    const COL_FIRST_NAME = 'subject.first_name';

    /**
     * the column name for the last_name field
     */
    const COL_LAST_NAME = 'subject.last_name';

    /**
     * the column name for the address field
     */
    const COL_ADDRESS = 'subject.address';

    /**
     * the column name for the zip field
     */
    const COL_ZIP = 'subject.zip';

    /**
     * the column name for the city field
     */
    const COL_CITY = 'subject.city';

    /**
     * the column name for the province field
     */
    const COL_PROVINCE = 'subject.province';

    /**
     * the column name for the country field
     */
    const COL_COUNTRY = 'subject.country';

    /**
     * the column name for the phone field
     */
    const COL_PHONE = 'subject.phone';

    /**
     * the column name for the fax field
     */
    const COL_FAX = 'subject.fax';

    /**
     * the column name for the notes field
     */
    const COL_NOTES = 'subject.notes';

    /**
     * the column name for the created_at field
     */
    const COL_CREATED_AT = 'subject.created_at';

    /**
     * the column name for the updated_at field
     */
    const COL_UPDATED_AT = 'subject.updated_at';

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
        self::TYPE_PHPNAME       => array('Id', 'Active', 'Iso', 'FirstName', 'LastName', 'Address', 'Zip', 'City', 'Province', 'Country', 'Phone', 'Fax', 'Notes', 'CreatedAt', 'UpdatedAt', ),
        self::TYPE_CAMELNAME     => array('id', 'active', 'iso', 'firstName', 'lastName', 'address', 'zip', 'city', 'province', 'country', 'phone', 'fax', 'notes', 'createdAt', 'updatedAt', ),
        self::TYPE_COLNAME       => array(SubjectTableMap::COL_ID, SubjectTableMap::COL_ACTIVE, SubjectTableMap::COL_ISO, SubjectTableMap::COL_FIRST_NAME, SubjectTableMap::COL_LAST_NAME, SubjectTableMap::COL_ADDRESS, SubjectTableMap::COL_ZIP, SubjectTableMap::COL_CITY, SubjectTableMap::COL_PROVINCE, SubjectTableMap::COL_COUNTRY, SubjectTableMap::COL_PHONE, SubjectTableMap::COL_FAX, SubjectTableMap::COL_NOTES, SubjectTableMap::COL_CREATED_AT, SubjectTableMap::COL_UPDATED_AT, ),
        self::TYPE_FIELDNAME     => array('id', 'active', 'iso', 'first_name', 'last_name', 'address', 'zip', 'city', 'province', 'country', 'phone', 'fax', 'notes', 'created_at', 'updated_at', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Id' => 0, 'Active' => 1, 'Iso' => 2, 'FirstName' => 3, 'LastName' => 4, 'Address' => 5, 'Zip' => 6, 'City' => 7, 'Province' => 8, 'Country' => 9, 'Phone' => 10, 'Fax' => 11, 'Notes' => 12, 'CreatedAt' => 13, 'UpdatedAt' => 14, ),
        self::TYPE_CAMELNAME     => array('id' => 0, 'active' => 1, 'iso' => 2, 'firstName' => 3, 'lastName' => 4, 'address' => 5, 'zip' => 6, 'city' => 7, 'province' => 8, 'country' => 9, 'phone' => 10, 'fax' => 11, 'notes' => 12, 'createdAt' => 13, 'updatedAt' => 14, ),
        self::TYPE_COLNAME       => array(SubjectTableMap::COL_ID => 0, SubjectTableMap::COL_ACTIVE => 1, SubjectTableMap::COL_ISO => 2, SubjectTableMap::COL_FIRST_NAME => 3, SubjectTableMap::COL_LAST_NAME => 4, SubjectTableMap::COL_ADDRESS => 5, SubjectTableMap::COL_ZIP => 6, SubjectTableMap::COL_CITY => 7, SubjectTableMap::COL_PROVINCE => 8, SubjectTableMap::COL_COUNTRY => 9, SubjectTableMap::COL_PHONE => 10, SubjectTableMap::COL_FAX => 11, SubjectTableMap::COL_NOTES => 12, SubjectTableMap::COL_CREATED_AT => 13, SubjectTableMap::COL_UPDATED_AT => 14, ),
        self::TYPE_FIELDNAME     => array('id' => 0, 'active' => 1, 'iso' => 2, 'first_name' => 3, 'last_name' => 4, 'address' => 5, 'zip' => 6, 'city' => 7, 'province' => 8, 'country' => 9, 'phone' => 10, 'fax' => 11, 'notes' => 12, 'created_at' => 13, 'updated_at' => 14, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, )
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
        $this->setName('subject');
        $this->setPhpName('Subject');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\App\\Models\\Subject');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
        $this->addColumn('active', 'Active', 'BOOLEAN', true, 1, true);
        $this->addColumn('iso', 'Iso', 'VARCHAR', true, 50, null);
        $this->addColumn('first_name', 'FirstName', 'VARCHAR', true, 255, null);
        $this->addColumn('last_name', 'LastName', 'VARCHAR', true, 255, null);
        $this->addColumn('address', 'Address', 'VARCHAR', false, 255, null);
        $this->addColumn('zip', 'Zip', 'VARCHAR', false, 20, null);
        $this->addColumn('city', 'City', 'VARCHAR', false, 100, null);
        $this->addColumn('province', 'Province', 'VARCHAR', false, 100, null);
        $this->addColumn('country', 'Country', 'VARCHAR', false, 100, null);
        $this->addColumn('phone', 'Phone', 'VARCHAR', false, 100, null);
        $this->addColumn('fax', 'Fax', 'VARCHAR', false, 100, null);
        $this->addColumn('notes', 'Notes', 'LONGVARCHAR', false, null, null);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('User', '\\App\\Models\\User', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':id_subject',
    1 => ':id',
  ),
), 'CASCADE', 'CASCADE', 'Users', false);
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
        );
    } // getBehaviors()
    /**
     * Method to invalidate the instance pool of all tables related to subject     * by a foreign key with ON DELETE CASCADE
     */
    public static function clearRelatedInstancePool()
    {
        // Invalidate objects in related instance pools,
        // since one or more of them may be deleted by ON DELETE CASCADE/SETNULL rule.
        UserTableMap::clearInstancePool();
    }

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
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
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
                ? 0 + $offset
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
        return $withPrefix ? SubjectTableMap::CLASS_DEFAULT : SubjectTableMap::OM_CLASS;
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
     * @return array           (Subject object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = SubjectTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = SubjectTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + SubjectTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = SubjectTableMap::OM_CLASS;
            /** @var Subject $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            SubjectTableMap::addInstanceToPool($obj, $key);
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
            $key = SubjectTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = SubjectTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Subject $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                SubjectTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(SubjectTableMap::COL_ID);
            $criteria->addSelectColumn(SubjectTableMap::COL_ACTIVE);
            $criteria->addSelectColumn(SubjectTableMap::COL_ISO);
            $criteria->addSelectColumn(SubjectTableMap::COL_FIRST_NAME);
            $criteria->addSelectColumn(SubjectTableMap::COL_LAST_NAME);
            $criteria->addSelectColumn(SubjectTableMap::COL_ADDRESS);
            $criteria->addSelectColumn(SubjectTableMap::COL_ZIP);
            $criteria->addSelectColumn(SubjectTableMap::COL_CITY);
            $criteria->addSelectColumn(SubjectTableMap::COL_PROVINCE);
            $criteria->addSelectColumn(SubjectTableMap::COL_COUNTRY);
            $criteria->addSelectColumn(SubjectTableMap::COL_PHONE);
            $criteria->addSelectColumn(SubjectTableMap::COL_FAX);
            $criteria->addSelectColumn(SubjectTableMap::COL_NOTES);
            $criteria->addSelectColumn(SubjectTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(SubjectTableMap::COL_UPDATED_AT);
        } else {
            $criteria->addSelectColumn($alias . '.id');
            $criteria->addSelectColumn($alias . '.active');
            $criteria->addSelectColumn($alias . '.iso');
            $criteria->addSelectColumn($alias . '.first_name');
            $criteria->addSelectColumn($alias . '.last_name');
            $criteria->addSelectColumn($alias . '.address');
            $criteria->addSelectColumn($alias . '.zip');
            $criteria->addSelectColumn($alias . '.city');
            $criteria->addSelectColumn($alias . '.province');
            $criteria->addSelectColumn($alias . '.country');
            $criteria->addSelectColumn($alias . '.phone');
            $criteria->addSelectColumn($alias . '.fax');
            $criteria->addSelectColumn($alias . '.notes');
            $criteria->addSelectColumn($alias . '.created_at');
            $criteria->addSelectColumn($alias . '.updated_at');
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
        return Propel::getServiceContainer()->getDatabaseMap(SubjectTableMap::DATABASE_NAME)->getTable(SubjectTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(SubjectTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(SubjectTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new SubjectTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Subject or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Subject object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(SubjectTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \App\Models\Subject) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(SubjectTableMap::DATABASE_NAME);
            $criteria->add(SubjectTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = SubjectQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            SubjectTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                SubjectTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the subject table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return SubjectQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Subject or Criteria object.
     *
     * @param mixed               $criteria Criteria or Subject object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(SubjectTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Subject object
        }

        if ($criteria->containsKey(SubjectTableMap::COL_ID) && $criteria->keyContainsValue(SubjectTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.SubjectTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = SubjectQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // SubjectTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
SubjectTableMap::buildTableMap();
