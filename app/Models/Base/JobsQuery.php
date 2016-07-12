<?php

namespace App\Models\Base;

use \Exception;
use \PDO;
use App\Models\Jobs as ChildJobs;
use App\Models\JobsQuery as ChildJobsQuery;
use App\Models\Map\JobsTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'jobs' table.
 *
 *
 *
 * @method     ChildJobsQuery orderByQueue($order = Criteria::ASC) Order by the queue column
 * @method     ChildJobsQuery orderByPayload($order = Criteria::ASC) Order by the payload column
 * @method     ChildJobsQuery orderByAttempts($order = Criteria::ASC) Order by the attempts column
 * @method     ChildJobsQuery orderByReserved($order = Criteria::ASC) Order by the reserved column
 * @method     ChildJobsQuery orderByReservedAt($order = Criteria::ASC) Order by the reserved_at column
 * @method     ChildJobsQuery orderByAvailableAt($order = Criteria::ASC) Order by the available_at column
 * @method     ChildJobsQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildJobsQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method     ChildJobsQuery orderById($order = Criteria::ASC) Order by the id column
 *
 * @method     ChildJobsQuery groupByQueue() Group by the queue column
 * @method     ChildJobsQuery groupByPayload() Group by the payload column
 * @method     ChildJobsQuery groupByAttempts() Group by the attempts column
 * @method     ChildJobsQuery groupByReserved() Group by the reserved column
 * @method     ChildJobsQuery groupByReservedAt() Group by the reserved_at column
 * @method     ChildJobsQuery groupByAvailableAt() Group by the available_at column
 * @method     ChildJobsQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildJobsQuery groupByUpdatedAt() Group by the updated_at column
 * @method     ChildJobsQuery groupById() Group by the id column
 *
 * @method     ChildJobsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildJobsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildJobsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildJobs findOne(ConnectionInterface $con = null) Return the first ChildJobs matching the query
 * @method     ChildJobs findOneOrCreate(ConnectionInterface $con = null) Return the first ChildJobs matching the query, or a new ChildJobs object populated from the query conditions when no match is found
 *
 * @method     ChildJobs findOneByQueue(string $queue) Return the first ChildJobs filtered by the queue column
 * @method     ChildJobs findOneByPayload(string $payload) Return the first ChildJobs filtered by the payload column
 * @method     ChildJobs findOneByAttempts(int $attempts) Return the first ChildJobs filtered by the attempts column
 * @method     ChildJobs findOneByReserved(int $reserved) Return the first ChildJobs filtered by the reserved column
 * @method     ChildJobs findOneByReservedAt(int $reserved_at) Return the first ChildJobs filtered by the reserved_at column
 * @method     ChildJobs findOneByAvailableAt(int $available_at) Return the first ChildJobs filtered by the available_at column
 * @method     ChildJobs findOneByCreatedAt(string $created_at) Return the first ChildJobs filtered by the created_at column
 * @method     ChildJobs findOneByUpdatedAt(string $updated_at) Return the first ChildJobs filtered by the updated_at column
 * @method     ChildJobs findOneById(int $id) Return the first ChildJobs filtered by the id column *

 * @method     ChildJobs requirePk($key, ConnectionInterface $con = null) Return the ChildJobs by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobs requireOne(ConnectionInterface $con = null) Return the first ChildJobs matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildJobs requireOneByQueue(string $queue) Return the first ChildJobs filtered by the queue column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobs requireOneByPayload(string $payload) Return the first ChildJobs filtered by the payload column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobs requireOneByAttempts(int $attempts) Return the first ChildJobs filtered by the attempts column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobs requireOneByReserved(int $reserved) Return the first ChildJobs filtered by the reserved column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobs requireOneByReservedAt(int $reserved_at) Return the first ChildJobs filtered by the reserved_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobs requireOneByAvailableAt(int $available_at) Return the first ChildJobs filtered by the available_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobs requireOneByCreatedAt(string $created_at) Return the first ChildJobs filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobs requireOneByUpdatedAt(string $updated_at) Return the first ChildJobs filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildJobs requireOneById(int $id) Return the first ChildJobs filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildJobs[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildJobs objects based on current ModelCriteria
 * @method     ChildJobs[]|ObjectCollection findByQueue(string $queue) Return ChildJobs objects filtered by the queue column
 * @method     ChildJobs[]|ObjectCollection findByPayload(string $payload) Return ChildJobs objects filtered by the payload column
 * @method     ChildJobs[]|ObjectCollection findByAttempts(int $attempts) Return ChildJobs objects filtered by the attempts column
 * @method     ChildJobs[]|ObjectCollection findByReserved(int $reserved) Return ChildJobs objects filtered by the reserved column
 * @method     ChildJobs[]|ObjectCollection findByReservedAt(int $reserved_at) Return ChildJobs objects filtered by the reserved_at column
 * @method     ChildJobs[]|ObjectCollection findByAvailableAt(int $available_at) Return ChildJobs objects filtered by the available_at column
 * @method     ChildJobs[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildJobs objects filtered by the created_at column
 * @method     ChildJobs[]|ObjectCollection findByUpdatedAt(string $updated_at) Return ChildJobs objects filtered by the updated_at column
 * @method     ChildJobs[]|ObjectCollection findById(int $id) Return ChildJobs objects filtered by the id column
 * @method     ChildJobs[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class JobsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \App\Models\Base\JobsQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\App\\Models\\Jobs', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildJobsQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildJobsQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildJobsQuery) {
            return $criteria;
        }
        $query = new ChildJobsQuery();
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
     * @return ChildJobs|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = JobsTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(JobsTableMap::DATABASE_NAME);
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
     * @return ChildJobs A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT queue, payload, attempts, reserved, reserved_at, available_at, created_at, updated_at, id FROM jobs WHERE id = :p0';
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
            /** @var ChildJobs $obj */
            $obj = new ChildJobs();
            $obj->hydrate($row);
            JobsTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildJobs|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildJobsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(JobsTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildJobsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(JobsTableMap::COL_ID, $keys, Criteria::IN);
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
     * @return $this|ChildJobsQuery The current query, for fluid interface
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

        return $this->addUsingAlias(JobsTableMap::COL_QUEUE, $queue, $comparison);
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
     * @return $this|ChildJobsQuery The current query, for fluid interface
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

        return $this->addUsingAlias(JobsTableMap::COL_PAYLOAD, $payload, $comparison);
    }

    /**
     * Filter the query on the attempts column
     *
     * Example usage:
     * <code>
     * $query->filterByAttempts(1234); // WHERE attempts = 1234
     * $query->filterByAttempts(array(12, 34)); // WHERE attempts IN (12, 34)
     * $query->filterByAttempts(array('min' => 12)); // WHERE attempts > 12
     * </code>
     *
     * @param     mixed $attempts The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobsQuery The current query, for fluid interface
     */
    public function filterByAttempts($attempts = null, $comparison = null)
    {
        if (is_array($attempts)) {
            $useMinMax = false;
            if (isset($attempts['min'])) {
                $this->addUsingAlias(JobsTableMap::COL_ATTEMPTS, $attempts['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($attempts['max'])) {
                $this->addUsingAlias(JobsTableMap::COL_ATTEMPTS, $attempts['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobsTableMap::COL_ATTEMPTS, $attempts, $comparison);
    }

    /**
     * Filter the query on the reserved column
     *
     * Example usage:
     * <code>
     * $query->filterByReserved(1234); // WHERE reserved = 1234
     * $query->filterByReserved(array(12, 34)); // WHERE reserved IN (12, 34)
     * $query->filterByReserved(array('min' => 12)); // WHERE reserved > 12
     * </code>
     *
     * @param     mixed $reserved The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobsQuery The current query, for fluid interface
     */
    public function filterByReserved($reserved = null, $comparison = null)
    {
        if (is_array($reserved)) {
            $useMinMax = false;
            if (isset($reserved['min'])) {
                $this->addUsingAlias(JobsTableMap::COL_RESERVED, $reserved['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($reserved['max'])) {
                $this->addUsingAlias(JobsTableMap::COL_RESERVED, $reserved['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobsTableMap::COL_RESERVED, $reserved, $comparison);
    }

    /**
     * Filter the query on the reserved_at column
     *
     * Example usage:
     * <code>
     * $query->filterByReservedAt(1234); // WHERE reserved_at = 1234
     * $query->filterByReservedAt(array(12, 34)); // WHERE reserved_at IN (12, 34)
     * $query->filterByReservedAt(array('min' => 12)); // WHERE reserved_at > 12
     * </code>
     *
     * @param     mixed $reservedAt The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobsQuery The current query, for fluid interface
     */
    public function filterByReservedAt($reservedAt = null, $comparison = null)
    {
        if (is_array($reservedAt)) {
            $useMinMax = false;
            if (isset($reservedAt['min'])) {
                $this->addUsingAlias(JobsTableMap::COL_RESERVED_AT, $reservedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($reservedAt['max'])) {
                $this->addUsingAlias(JobsTableMap::COL_RESERVED_AT, $reservedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobsTableMap::COL_RESERVED_AT, $reservedAt, $comparison);
    }

    /**
     * Filter the query on the available_at column
     *
     * Example usage:
     * <code>
     * $query->filterByAvailableAt(1234); // WHERE available_at = 1234
     * $query->filterByAvailableAt(array(12, 34)); // WHERE available_at IN (12, 34)
     * $query->filterByAvailableAt(array('min' => 12)); // WHERE available_at > 12
     * </code>
     *
     * @param     mixed $availableAt The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobsQuery The current query, for fluid interface
     */
    public function filterByAvailableAt($availableAt = null, $comparison = null)
    {
        if (is_array($availableAt)) {
            $useMinMax = false;
            if (isset($availableAt['min'])) {
                $this->addUsingAlias(JobsTableMap::COL_AVAILABLE_AT, $availableAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($availableAt['max'])) {
                $this->addUsingAlias(JobsTableMap::COL_AVAILABLE_AT, $availableAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobsTableMap::COL_AVAILABLE_AT, $availableAt, $comparison);
    }

    /**
     * Filter the query on the created_at column
     *
     * Example usage:
     * <code>
     * $query->filterByCreatedAt('2011-03-14'); // WHERE created_at = '2011-03-14'
     * $query->filterByCreatedAt('now'); // WHERE created_at = '2011-03-14'
     * $query->filterByCreatedAt(array('max' => 'yesterday')); // WHERE created_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $createdAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobsQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(JobsTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(JobsTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobsTableMap::COL_CREATED_AT, $createdAt, $comparison);
    }

    /**
     * Filter the query on the updated_at column
     *
     * Example usage:
     * <code>
     * $query->filterByUpdatedAt('2011-03-14'); // WHERE updated_at = '2011-03-14'
     * $query->filterByUpdatedAt('now'); // WHERE updated_at = '2011-03-14'
     * $query->filterByUpdatedAt(array('max' => 'yesterday')); // WHERE updated_at > '2011-03-13'
     * </code>
     *
     * @param     mixed $updatedAt The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildJobsQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(JobsTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(JobsTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobsTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
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
     * @return $this|ChildJobsQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(JobsTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(JobsTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(JobsTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildJobs $jobs Object to remove from the list of results
     *
     * @return $this|ChildJobsQuery The current query, for fluid interface
     */
    public function prune($jobs = null)
    {
        if ($jobs) {
            $this->addUsingAlias(JobsTableMap::COL_ID, $jobs->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the jobs table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(JobsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            JobsTableMap::clearInstancePool();
            JobsTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(JobsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(JobsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            JobsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            JobsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     $this|ChildJobsQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(JobsTableMap::COL_UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     $this|ChildJobsQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(JobsTableMap::COL_UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     $this|ChildJobsQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(JobsTableMap::COL_UPDATED_AT);
    }

    /**
     * Order by create date desc
     *
     * @return     $this|ChildJobsQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(JobsTableMap::COL_CREATED_AT);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     $this|ChildJobsQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(JobsTableMap::COL_CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date asc
     *
     * @return     $this|ChildJobsQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(JobsTableMap::COL_CREATED_AT);
    }

} // JobsQuery
