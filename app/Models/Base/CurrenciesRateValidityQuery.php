<?php

namespace App\Models\Base;

use \Exception;
use \PDO;
use App\Models\CurrenciesRateValidity as ChildCurrenciesRateValidity;
use App\Models\CurrenciesRateValidityQuery as ChildCurrenciesRateValidityQuery;
use App\Models\Map\CurrenciesRateValidityTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'currencies_rate_validity' table.
 *
 *
 *
 * @method     ChildCurrenciesRateValidityQuery orderByIdCurrency($order = Criteria::ASC) Order by the id_currency column
 * @method     ChildCurrenciesRateValidityQuery orderByStart($order = Criteria::ASC) Order by the start column
 * @method     ChildCurrenciesRateValidityQuery orderByEnd($order = Criteria::ASC) Order by the end column
 * @method     ChildCurrenciesRateValidityQuery orderByValue($order = Criteria::ASC) Order by the value column
 * @method     ChildCurrenciesRateValidityQuery orderByActive($order = Criteria::ASC) Order by the active column
 * @method     ChildCurrenciesRateValidityQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildCurrenciesRateValidityQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method     ChildCurrenciesRateValidityQuery orderById($order = Criteria::ASC) Order by the id column
 *
 * @method     ChildCurrenciesRateValidityQuery groupByIdCurrency() Group by the id_currency column
 * @method     ChildCurrenciesRateValidityQuery groupByStart() Group by the start column
 * @method     ChildCurrenciesRateValidityQuery groupByEnd() Group by the end column
 * @method     ChildCurrenciesRateValidityQuery groupByValue() Group by the value column
 * @method     ChildCurrenciesRateValidityQuery groupByActive() Group by the active column
 * @method     ChildCurrenciesRateValidityQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildCurrenciesRateValidityQuery groupByUpdatedAt() Group by the updated_at column
 * @method     ChildCurrenciesRateValidityQuery groupById() Group by the id column
 *
 * @method     ChildCurrenciesRateValidityQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildCurrenciesRateValidityQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildCurrenciesRateValidityQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildCurrenciesRateValidityQuery leftJoinCurrency($relationAlias = null) Adds a LEFT JOIN clause to the query using the Currency relation
 * @method     ChildCurrenciesRateValidityQuery rightJoinCurrency($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Currency relation
 * @method     ChildCurrenciesRateValidityQuery innerJoinCurrency($relationAlias = null) Adds a INNER JOIN clause to the query using the Currency relation
 *
 * @method     \App\Models\CurrencyQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildCurrenciesRateValidity findOne(ConnectionInterface $con = null) Return the first ChildCurrenciesRateValidity matching the query
 * @method     ChildCurrenciesRateValidity findOneOrCreate(ConnectionInterface $con = null) Return the first ChildCurrenciesRateValidity matching the query, or a new ChildCurrenciesRateValidity object populated from the query conditions when no match is found
 *
 * @method     ChildCurrenciesRateValidity findOneByIdCurrency(int $id_currency) Return the first ChildCurrenciesRateValidity filtered by the id_currency column
 * @method     ChildCurrenciesRateValidity findOneByStart(string $start) Return the first ChildCurrenciesRateValidity filtered by the start column
 * @method     ChildCurrenciesRateValidity findOneByEnd(string $end) Return the first ChildCurrenciesRateValidity filtered by the end column
 * @method     ChildCurrenciesRateValidity findOneByValue(string $value) Return the first ChildCurrenciesRateValidity filtered by the value column
 * @method     ChildCurrenciesRateValidity findOneByActive(boolean $active) Return the first ChildCurrenciesRateValidity filtered by the active column
 * @method     ChildCurrenciesRateValidity findOneByCreatedAt(string $created_at) Return the first ChildCurrenciesRateValidity filtered by the created_at column
 * @method     ChildCurrenciesRateValidity findOneByUpdatedAt(string $updated_at) Return the first ChildCurrenciesRateValidity filtered by the updated_at column
 * @method     ChildCurrenciesRateValidity findOneById(int $id) Return the first ChildCurrenciesRateValidity filtered by the id column *

 * @method     ChildCurrenciesRateValidity requirePk($key, ConnectionInterface $con = null) Return the ChildCurrenciesRateValidity by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCurrenciesRateValidity requireOne(ConnectionInterface $con = null) Return the first ChildCurrenciesRateValidity matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCurrenciesRateValidity requireOneByIdCurrency(int $id_currency) Return the first ChildCurrenciesRateValidity filtered by the id_currency column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCurrenciesRateValidity requireOneByStart(string $start) Return the first ChildCurrenciesRateValidity filtered by the start column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCurrenciesRateValidity requireOneByEnd(string $end) Return the first ChildCurrenciesRateValidity filtered by the end column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCurrenciesRateValidity requireOneByValue(string $value) Return the first ChildCurrenciesRateValidity filtered by the value column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCurrenciesRateValidity requireOneByActive(boolean $active) Return the first ChildCurrenciesRateValidity filtered by the active column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCurrenciesRateValidity requireOneByCreatedAt(string $created_at) Return the first ChildCurrenciesRateValidity filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCurrenciesRateValidity requireOneByUpdatedAt(string $updated_at) Return the first ChildCurrenciesRateValidity filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildCurrenciesRateValidity requireOneById(int $id) Return the first ChildCurrenciesRateValidity filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildCurrenciesRateValidity[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildCurrenciesRateValidity objects based on current ModelCriteria
 * @method     ChildCurrenciesRateValidity[]|ObjectCollection findByIdCurrency(int $id_currency) Return ChildCurrenciesRateValidity objects filtered by the id_currency column
 * @method     ChildCurrenciesRateValidity[]|ObjectCollection findByStart(string $start) Return ChildCurrenciesRateValidity objects filtered by the start column
 * @method     ChildCurrenciesRateValidity[]|ObjectCollection findByEnd(string $end) Return ChildCurrenciesRateValidity objects filtered by the end column
 * @method     ChildCurrenciesRateValidity[]|ObjectCollection findByValue(string $value) Return ChildCurrenciesRateValidity objects filtered by the value column
 * @method     ChildCurrenciesRateValidity[]|ObjectCollection findByActive(boolean $active) Return ChildCurrenciesRateValidity objects filtered by the active column
 * @method     ChildCurrenciesRateValidity[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildCurrenciesRateValidity objects filtered by the created_at column
 * @method     ChildCurrenciesRateValidity[]|ObjectCollection findByUpdatedAt(string $updated_at) Return ChildCurrenciesRateValidity objects filtered by the updated_at column
 * @method     ChildCurrenciesRateValidity[]|ObjectCollection findById(int $id) Return ChildCurrenciesRateValidity objects filtered by the id column
 * @method     ChildCurrenciesRateValidity[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class CurrenciesRateValidityQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \App\Models\Base\CurrenciesRateValidityQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\App\\Models\\CurrenciesRateValidity', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildCurrenciesRateValidityQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildCurrenciesRateValidityQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildCurrenciesRateValidityQuery) {
            return $criteria;
        }
        $query = new ChildCurrenciesRateValidityQuery();
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
     * @return ChildCurrenciesRateValidity|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = CurrenciesRateValidityTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(CurrenciesRateValidityTableMap::DATABASE_NAME);
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
     * @return ChildCurrenciesRateValidity A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id_currency, start, end, value, active, created_at, updated_at, id FROM currencies_rate_validity WHERE id = :p0';
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
            /** @var ChildCurrenciesRateValidity $obj */
            $obj = new ChildCurrenciesRateValidity();
            $obj->hydrate($row);
            CurrenciesRateValidityTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildCurrenciesRateValidity|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildCurrenciesRateValidityQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(CurrenciesRateValidityTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildCurrenciesRateValidityQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(CurrenciesRateValidityTableMap::COL_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id_currency column
     *
     * Example usage:
     * <code>
     * $query->filterByIdCurrency(1234); // WHERE id_currency = 1234
     * $query->filterByIdCurrency(array(12, 34)); // WHERE id_currency IN (12, 34)
     * $query->filterByIdCurrency(array('min' => 12)); // WHERE id_currency > 12
     * </code>
     *
     * @see       filterByCurrency()
     *
     * @param     mixed $idCurrency The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCurrenciesRateValidityQuery The current query, for fluid interface
     */
    public function filterByIdCurrency($idCurrency = null, $comparison = null)
    {
        if (is_array($idCurrency)) {
            $useMinMax = false;
            if (isset($idCurrency['min'])) {
                $this->addUsingAlias(CurrenciesRateValidityTableMap::COL_ID_CURRENCY, $idCurrency['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idCurrency['max'])) {
                $this->addUsingAlias(CurrenciesRateValidityTableMap::COL_ID_CURRENCY, $idCurrency['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CurrenciesRateValidityTableMap::COL_ID_CURRENCY, $idCurrency, $comparison);
    }

    /**
     * Filter the query on the start column
     *
     * Example usage:
     * <code>
     * $query->filterByStart('2011-03-14'); // WHERE start = '2011-03-14'
     * $query->filterByStart('now'); // WHERE start = '2011-03-14'
     * $query->filterByStart(array('max' => 'yesterday')); // WHERE start > '2011-03-13'
     * </code>
     *
     * @param     mixed $start The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCurrenciesRateValidityQuery The current query, for fluid interface
     */
    public function filterByStart($start = null, $comparison = null)
    {
        if (is_array($start)) {
            $useMinMax = false;
            if (isset($start['min'])) {
                $this->addUsingAlias(CurrenciesRateValidityTableMap::COL_START, $start['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($start['max'])) {
                $this->addUsingAlias(CurrenciesRateValidityTableMap::COL_START, $start['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CurrenciesRateValidityTableMap::COL_START, $start, $comparison);
    }

    /**
     * Filter the query on the end column
     *
     * Example usage:
     * <code>
     * $query->filterByEnd('2011-03-14'); // WHERE end = '2011-03-14'
     * $query->filterByEnd('now'); // WHERE end = '2011-03-14'
     * $query->filterByEnd(array('max' => 'yesterday')); // WHERE end > '2011-03-13'
     * </code>
     *
     * @param     mixed $end The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCurrenciesRateValidityQuery The current query, for fluid interface
     */
    public function filterByEnd($end = null, $comparison = null)
    {
        if (is_array($end)) {
            $useMinMax = false;
            if (isset($end['min'])) {
                $this->addUsingAlias(CurrenciesRateValidityTableMap::COL_END, $end['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($end['max'])) {
                $this->addUsingAlias(CurrenciesRateValidityTableMap::COL_END, $end['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CurrenciesRateValidityTableMap::COL_END, $end, $comparison);
    }

    /**
     * Filter the query on the value column
     *
     * Example usage:
     * <code>
     * $query->filterByValue(1234); // WHERE value = 1234
     * $query->filterByValue(array(12, 34)); // WHERE value IN (12, 34)
     * $query->filterByValue(array('min' => 12)); // WHERE value > 12
     * </code>
     *
     * @param     mixed $value The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCurrenciesRateValidityQuery The current query, for fluid interface
     */
    public function filterByValue($value = null, $comparison = null)
    {
        if (is_array($value)) {
            $useMinMax = false;
            if (isset($value['min'])) {
                $this->addUsingAlias(CurrenciesRateValidityTableMap::COL_VALUE, $value['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($value['max'])) {
                $this->addUsingAlias(CurrenciesRateValidityTableMap::COL_VALUE, $value['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CurrenciesRateValidityTableMap::COL_VALUE, $value, $comparison);
    }

    /**
     * Filter the query on the active column
     *
     * Example usage:
     * <code>
     * $query->filterByActive(true); // WHERE active = true
     * $query->filterByActive('yes'); // WHERE active = true
     * </code>
     *
     * @param     boolean|string $active The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildCurrenciesRateValidityQuery The current query, for fluid interface
     */
    public function filterByActive($active = null, $comparison = null)
    {
        if (is_string($active)) {
            $active = in_array(strtolower($active), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(CurrenciesRateValidityTableMap::COL_ACTIVE, $active, $comparison);
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
     * @return $this|ChildCurrenciesRateValidityQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(CurrenciesRateValidityTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(CurrenciesRateValidityTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CurrenciesRateValidityTableMap::COL_CREATED_AT, $createdAt, $comparison);
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
     * @return $this|ChildCurrenciesRateValidityQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(CurrenciesRateValidityTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(CurrenciesRateValidityTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CurrenciesRateValidityTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
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
     * @return $this|ChildCurrenciesRateValidityQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(CurrenciesRateValidityTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(CurrenciesRateValidityTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(CurrenciesRateValidityTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query by a related \App\Models\Currency object
     *
     * @param \App\Models\Currency|ObjectCollection $currency The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildCurrenciesRateValidityQuery The current query, for fluid interface
     */
    public function filterByCurrency($currency, $comparison = null)
    {
        if ($currency instanceof \App\Models\Currency) {
            return $this
                ->addUsingAlias(CurrenciesRateValidityTableMap::COL_ID_CURRENCY, $currency->getId(), $comparison);
        } elseif ($currency instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(CurrenciesRateValidityTableMap::COL_ID_CURRENCY, $currency->toKeyValue('PrimaryKey', 'Id'), $comparison);
        } else {
            throw new PropelException('filterByCurrency() only accepts arguments of type \App\Models\Currency or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Currency relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildCurrenciesRateValidityQuery The current query, for fluid interface
     */
    public function joinCurrency($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Currency');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Currency');
        }

        return $this;
    }

    /**
     * Use the Currency relation Currency object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \App\Models\CurrencyQuery A secondary query class using the current class as primary query
     */
    public function useCurrencyQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinCurrency($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Currency', '\App\Models\CurrencyQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildCurrenciesRateValidity $currenciesRateValidity Object to remove from the list of results
     *
     * @return $this|ChildCurrenciesRateValidityQuery The current query, for fluid interface
     */
    public function prune($currenciesRateValidity = null)
    {
        if ($currenciesRateValidity) {
            $this->addUsingAlias(CurrenciesRateValidityTableMap::COL_ID, $currenciesRateValidity->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the currencies_rate_validity table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(CurrenciesRateValidityTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            CurrenciesRateValidityTableMap::clearInstancePool();
            CurrenciesRateValidityTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(CurrenciesRateValidityTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(CurrenciesRateValidityTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            CurrenciesRateValidityTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            CurrenciesRateValidityTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     $this|ChildCurrenciesRateValidityQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(CurrenciesRateValidityTableMap::COL_UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     $this|ChildCurrenciesRateValidityQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(CurrenciesRateValidityTableMap::COL_UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     $this|ChildCurrenciesRateValidityQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(CurrenciesRateValidityTableMap::COL_UPDATED_AT);
    }

    /**
     * Order by create date desc
     *
     * @return     $this|ChildCurrenciesRateValidityQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(CurrenciesRateValidityTableMap::COL_CREATED_AT);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     $this|ChildCurrenciesRateValidityQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(CurrenciesRateValidityTableMap::COL_CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date asc
     *
     * @return     $this|ChildCurrenciesRateValidityQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(CurrenciesRateValidityTableMap::COL_CREATED_AT);
    }

} // CurrenciesRateValidityQuery
