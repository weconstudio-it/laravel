<?php

namespace App\Models\Base;

use \Exception;
use \PDO;
use App\Models\FailedJobs as ChildFailedJobs;
use App\Models\FailedJobsQuery as ChildFailedJobsQuery;
use App\Models\Map\FailedJobsTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'failed_jobs' table.
 *
 *
 *
 * @method     ChildFailedJobsQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildFailedJobsQuery orderByConnection($order = Criteria::ASC) Order by the connection column
 * @method     ChildFailedJobsQuery orderByQueue($order = Criteria::ASC) Order by the queue column
 * @method     ChildFailedJobsQuery orderByPayload($order = Criteria::ASC) Order by the payload column
 * @method     ChildFailedJobsQuery orderByFailedAt($order = Criteria::ASC) Order by the failed_at column
 *
 * @method     ChildFailedJobsQuery groupById() Group by the id column
 * @method     ChildFailedJobsQuery groupByConnection() Group by the connection column
 * @method     ChildFailedJobsQuery groupByQueue() Group by the queue column
 * @method     ChildFailedJobsQuery groupByPayload() Group by the payload column
 * @method     ChildFailedJobsQuery groupByFailedAt() Group by the failed_at column
 *
 * @method     ChildFailedJobsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildFailedJobsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildFailedJobsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildFailedJobs findOne(ConnectionInterface $con = null) Return the first ChildFailedJobs matching the query
 * @method     ChildFailedJobs findOneOrCreate(ConnectionInterface $con = null) Return the first ChildFailedJobs matching the query, or a new ChildFailedJobs object populated from the query conditions when no match is found
 *
 * @method     ChildFailedJobs findOneById(int $id) Return the first ChildFailedJobs filtered by the id column
 * @method     ChildFailedJobs findOneByConnection(string $connection) Return the first ChildFailedJobs filtered by the connection column
 * @method     ChildFailedJobs findOneByQueue(string $queue) Return the first ChildFailedJobs filtered by the queue column
 * @method     ChildFailedJobs findOneByPayload(string $payload) Return the first ChildFailedJobs filtered by the payload column
 * @method     ChildFailedJobs findOneByFailedAt(string $failed_at) Return the first ChildFailedJobs filtered by the failed_at column *

 * @method     ChildFailedJobs requirePk($key, ConnectionInterface $con = null) Return the ChildFailedJobs by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFailedJobs requireOne(ConnectionInterface $con = null) Return the first ChildFailedJobs matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildFailedJobs requireOneById(int $id) Return the first ChildFailedJobs filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFailedJobs requireOneByConnection(string $connection) Return the first ChildFailedJobs filtered by the connection column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFailedJobs requireOneByQueue(string $queue) Return the first ChildFailedJobs filtered by the queue column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFailedJobs requireOneByPayload(string $payload) Return the first ChildFailedJobs filtered by the payload column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildFailedJobs requireOneByFailedAt(string $failed_at) Return the first ChildFailedJobs filtered by the failed_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildFailedJobs[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildFailedJobs objects based on current ModelCriteria
 * @method     ChildFailedJobs[]|ObjectCollection findById(int $id) Return ChildFailedJobs objects filtered by the id column
 * @method     ChildFailedJobs[]|ObjectCollection findByConnection(string $connection) Return ChildFailedJobs objects filtered by the connection column
 * @method     ChildFailedJobs[]|ObjectCollection findByQueue(string $queue) Return ChildFailedJobs objects filtered by the queue column
 * @method     ChildFailedJobs[]|ObjectCollection findByPayload(string $payload) Return ChildFailedJobs objects filtered by the payload column
 * @method     ChildFailedJobs[]|ObjectCollection findByFailedAt(string $failed_at) Return ChildFailedJobs objects filtered by the failed_at column
 * @method     ChildFailedJobs[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class FailedJobsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \App\Models\Base\FailedJobsQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\App\\Models\\FailedJobs', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildFailedJobsQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildFailedJobsQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildFailedJobsQuery) {
            return $criteria;
        }
        $query = new ChildFailedJobsQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildFailedJobs|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = FailedJobsTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(FailedJobsTableMap::DATABASE_NAME);
        }
        $this->basePreSelect($con);
        if ($this->formatter || $this->modelAlias || $this->with || $this->select
         || $this->selectColumns || $this->asColumns || $this->selectModifiers
         || $this->map || $this->having || $this->joins) {
            return $this->findPkComplex($key, $con);
        } else {
            return $this->findPkSimple($key, $con);
        }
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildFailedJobs A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, connection, queue, payload, failed_at FROM failed_jobs WHERE id = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildFailedJobs $obj */
            $obj = new ChildFailedJobs();
            $obj->hydrate($row);
            FailedJobsTableMap::addInstanceToPool($obj, (string) $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildFailedJobs|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildFailedJobsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(FailedJobsTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildFailedJobsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(FailedJobsTableMap::COL_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFailedJobsQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(FailedJobsTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(FailedJobsTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FailedJobsTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the connection column
     *
     * Example usage:
     * <code>
     * $query->filterByConnection('fooValue');   // WHERE connection = 'fooValue'
     * $query->filterByConnection('%fooValue%'); // WHERE connection LIKE '%fooValue%'
     * </code>
     *
     * @param     string $connection The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFailedJobsQuery The current query, for fluid interface
     */
    public function filterByConnection($connection = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($connection)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $connection)) {
                $connection = str_replace('*', '%', $connection);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(FailedJobsTableMap::COL_CONNECTION, $connection, $comparison);
    }

    /**
     * Filter the query on the queue column
     *
     * Example usage:
     * <code>
     * $query->filterByQueue('fooValue');   // WHERE queue = 'fooValue'
     * $query->filterByQueue('%fooValue%'); // WHERE queue LIKE '%fooValue%'
     * </code>
     *
     * @param     string $queue The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFailedJobsQuery The current query, for fluid interface
     */
    public function filterByQueue($queue = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($queue)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $queue)) {
                $queue = str_replace('*', '%', $queue);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(FailedJobsTableMap::COL_QUEUE, $queue, $comparison);
    }

    /**
     * Filter the query on the payload column
     *
     * Example usage:
     * <code>
     * $query->filterByPayload('fooValue');   // WHERE payload = 'fooValue'
     * $query->filterByPayload('%fooValue%'); // WHERE payload LIKE '%fooValue%'
     * </code>
     *
     * @param     string $payload The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFailedJobsQuery The current query, for fluid interface
     */
    public function filterByPayload($payload = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($payload)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $payload)) {
                $payload = str_replace('*', '%', $payload);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(FailedJobsTableMap::COL_PAYLOAD, $payload, $comparison);
    }

    /**
     * Filter the query on the failed_at column
     *
     * Example usage:
     * <code>
     * $query->filterByFailedAt('2011-03-14'); // WHERE failed_at = '2011-03-14'
     * $query->filterByFailedAt('now'); // WHERE failed_at = '2011-03-14'
     * $query->filterByFailedAt(array('max' => 'yesterday')); // WHERE failed_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $failedAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildFailedJobsQuery The current query, for fluid interface
     */
    public function filterByFailedAt($failedAt = null, $comparison = null)
    {
        if (is_array($failedAt)) {
            $useMinMax = false;
            if (isset($failedAt['min'])) {
                $this->addUsingAlias(FailedJobsTableMap::COL_FAILED_AT, $failedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($failedAt['max'])) {
                $this->addUsingAlias(FailedJobsTableMap::COL_FAILED_AT, $failedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(FailedJobsTableMap::COL_FAILED_AT, $failedAt, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildFailedJobs $failedJobs Object to remove from the list of results
     *
     * @return $this|ChildFailedJobsQuery The current query, for fluid interface
     */
    public function prune($failedJobs = null)
    {
        if ($failedJobs) {
            $this->addUsingAlias(FailedJobsTableMap::COL_ID, $failedJobs->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the failed_jobs table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(FailedJobsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            FailedJobsTableMap::clearInstancePool();
            FailedJobsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(FailedJobsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(FailedJobsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            FailedJobsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            FailedJobsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // FailedJobsQuery
