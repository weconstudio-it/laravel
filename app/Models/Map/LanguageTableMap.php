<?php

namespace App\Models\Map;

use App\Models\Language;
use App\Models\LanguageQuery;
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
 * This class defines the structure of the 'language' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class LanguageTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.LanguageTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'language';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\App\\Models\\Language';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Language';

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
     * the column name for the iso639_1 field
     */
    const COL_ISO639_1 = 'language.iso639_1';

    /**
     * the column name for the i18n field
     */
    const COL_I18N = 'language.i18n';

    /**
     * the column name for the code field
     */
    const COL_CODE = 'language.code';

    /**
     * the column name for the description field
     */
    const COL_DESCRIPTION = 'language.description';

    /**
     * the column name for the active field
     */
    const COL_ACTIVE = 'language.active';

    /**
     * the column name for the created_at field
     */
    const COL_CREATED_AT = 'language.created_at';

    /**
     * the column name for the updated_at field
     */
    const COL_UPDATED_AT = 'language.updated_at';

    /**
     * the column name for the id field
     */
    const COL_ID = 'language.id';

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
        self::TYPE_PHPNAME       => array('Iso6391', 'I18n', 'Code', 'Description', 'Active', 'CreatedAt', 'UpdatedAt', 'Id', ),
        self::TYPE_CAMELNAME     => array('iso6391', 'i18n', 'code', 'description', 'active', 'createdAt', 'updatedAt', 'id', ),
        self::TYPE_COLNAME       => array(LanguageTableMap::COL_ISO639_1, LanguageTableMap::COL_I18N, LanguageTableMap::COL_CODE, LanguageTableMap::COL_DESCRIPTION, LanguageTableMap::COL_ACTIVE, LanguageTableMap::COL_CREATED_AT, LanguageTableMap::COL_UPDATED_AT, LanguageTableMap::COL_ID, ),
        self::TYPE_FIELDNAME     => array('iso639_1', 'i18n', 'code', 'description', 'active', 'created_at', 'updated_at', 'id', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Iso6391' => 0, 'I18n' => 1, 'Code' => 2, 'Description' => 3, 'Active' => 4, 'CreatedAt' => 5, 'UpdatedAt' => 6, 'Id' => 7, ),
        self::TYPE_CAMELNAME     => array('iso6391' => 0, 'i18n' => 1, 'code' => 2, 'description' => 3, 'active' => 4, 'createdAt' => 5, 'updatedAt' => 6, 'id' => 7, ),
        self::TYPE_COLNAME       => array(LanguageTableMap::COL_ISO639_1 => 0, LanguageTableMap::COL_I18N => 1, LanguageTableMap::COL_CODE => 2, LanguageTableMap::COL_DESCRIPTION => 3, LanguageTableMap::COL_ACTIVE => 4, LanguageTableMap::COL_CREATED_AT => 5, LanguageTableMap::COL_UPDATED_AT => 6, LanguageTableMap::COL_ID => 7, ),
        self::TYPE_FIELDNAME     => array('iso639_1' => 0, 'i18n' => 1, 'code' => 2, 'description' => 3, 'active' => 4, 'created_at' => 5, 'updated_at' => 6, 'id' => 7, ),
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
        $this->setName('language');
        $this->setPhpName('Language');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\App\\Models\\Language');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addColumn('iso639_1', 'Iso6391', 'VARCHAR', false, 2, null);
        $this->addColumn('i18n', 'I18n', 'VARCHAR', false, 10, null);
        $this->addColumn('code', 'Code', 'VARCHAR', false, 10, null);
        $this->addColumn('description', 'Description', 'VARCHAR', false, 20, null);
        $this->addColumn('active', 'Active', 'BOOLEAN', false, 1, true);
        $this->addColumn('created_at', 'CreatedAt', 'TIMESTAMP', false, null, null);
        $this->addColumn('updated_at', 'UpdatedAt', 'TIMESTAMP', false, null, null);
        $this->addPrimaryKey('id', 'Id', 'INTEGER', true, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('User', '\\App\\Models\\User', RelationMap::ONE_TO_MANY, array (
  0 =>
  array (
    0 => ':id_language',
    1 => ':id',
  ),
), null, null, 'Users', false);
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
        return $withPrefix ? LanguageTableMap::CLASS_DEFAULT : LanguageTableMap::OM_CLASS;
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
     * @return array           (Language object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = LanguageTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = LanguageTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + LanguageTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = LanguageTableMap::OM_CLASS;
            /** @var Language $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            LanguageTableMap::addInstanceToPool($obj, $key);
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
            $key = LanguageTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = LanguageTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Language $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                LanguageTableMap::addInstanceToPool($obj, $key);
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
            $criteria->addSelectColumn(LanguageTableMap::COL_ISO639_1);
            $criteria->addSelectColumn(LanguageTableMap::COL_I18N);
            $criteria->addSelectColumn(LanguageTableMap::COL_CODE);
            $criteria->addSelectColumn(LanguageTableMap::COL_DESCRIPTION);
            $criteria->addSelectColumn(LanguageTableMap::COL_ACTIVE);
            $criteria->addSelectColumn(LanguageTableMap::COL_CREATED_AT);
            $criteria->addSelectColumn(LanguageTableMap::COL_UPDATED_AT);
            $criteria->addSelectColumn(LanguageTableMap::COL_ID);
        } else {
            $criteria->addSelectColumn($alias . '.iso639_1');
            $criteria->addSelectColumn($alias . '.i18n');
            $criteria->addSelectColumn($alias . '.code');
            $criteria->addSelectColumn($alias . '.description');
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
        return Propel::getServiceContainer()->getDatabaseMap(LanguageTableMap::DATABASE_NAME)->getTable(LanguageTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(LanguageTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(LanguageTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new LanguageTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Language or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Language object or primary key or array of primary keys
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
            $con = Propel::getServiceContainer()->getWriteConnection(LanguageTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \App\Models\Language) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(LanguageTableMap::DATABASE_NAME);
            $criteria->add(LanguageTableMap::COL_ID, (array) $values, Criteria::IN);
        }

        $query = LanguageQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            LanguageTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                LanguageTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the language table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return LanguageQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Language or Criteria object.
     *
     * @param mixed               $criteria Criteria or Language object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(LanguageTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Language object
        }

        if ($criteria->containsKey(LanguageTableMap::COL_ID) && $criteria->keyContainsValue(LanguageTableMap::COL_ID) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.LanguageTableMap::COL_ID.')');
        }


        // Set the correct dbName
        $query = LanguageQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // LanguageTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
LanguageTableMap::buildTableMap();
