<?php

namespace App\Models\Base;

use \Exception;
use \PDO;
use App\Models\Authorization as ChildAuthorization;
use App\Models\AuthorizationQuery as ChildAuthorizationQuery;
use App\Models\Map\AuthorizationTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'authorization' table.
 *
 *
 *
 * @method     ChildAuthorizationQuery orderByUri($order = Criteria::ASC) Order by the uri column
 * @method     ChildAuthorizationQuery orderByMethod($order = Criteria::ASC) Order by the method column
 * @method     ChildAuthorizationQuery orderByIdUser($order = Criteria::ASC) Order by the id_user column
 * @method     ChildAuthorizationQuery orderByIdUserGroup($order = Criteria::ASC) Order by the id_user_group column
 * @method     ChildAuthorizationQuery orderByOrder($order = Criteria::ASC) Order by the order column
 * @method     ChildAuthorizationQuery orderByPolicy($order = Criteria::ASC) Order by the policy column
 * @method     ChildAuthorizationQuery orderByLabel($order = Criteria::ASC) Order by the label column
 * @method     ChildAuthorizationQuery orderByEnabled($order = Criteria::ASC) Order by the enabled column
 * @method     ChildAuthorizationQuery orderByCreatedAt($order = Criteria::ASC) Order by the created_at column
 * @method     ChildAuthorizationQuery orderByUpdatedAt($order = Criteria::ASC) Order by the updated_at column
 * @method     ChildAuthorizationQuery orderById($order = Criteria::ASC) Order by the id column
 *
 * @method     ChildAuthorizationQuery groupByUri() Group by the uri column
 * @method     ChildAuthorizationQuery groupByMethod() Group by the method column
 * @method     ChildAuthorizationQuery groupByIdUser() Group by the id_user column
 * @method     ChildAuthorizationQuery groupByIdUserGroup() Group by the id_user_group column
 * @method     ChildAuthorizationQuery groupByOrder() Group by the order column
 * @method     ChildAuthorizationQuery groupByPolicy() Group by the policy column
 * @method     ChildAuthorizationQuery groupByLabel() Group by the label column
 * @method     ChildAuthorizationQuery groupByEnabled() Group by the enabled column
 * @method     ChildAuthorizationQuery groupByCreatedAt() Group by the created_at column
 * @method     ChildAuthorizationQuery groupByUpdatedAt() Group by the updated_at column
 * @method     ChildAuthorizationQuery groupById() Group by the id column
 *
 * @method     ChildAuthorizationQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildAuthorizationQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildAuthorizationQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildAuthorization findOne(ConnectionInterface $con = null) Return the first ChildAuthorization matching the query
 * @method     ChildAuthorization findOneOrCreate(ConnectionInterface $con = null) Return the first ChildAuthorization matching the query, or a new ChildAuthorization object populated from the query conditions when no match is found
 *
 * @method     ChildAuthorization findOneByUri(string $uri) Return the first ChildAuthorization filtered by the uri column
 * @method     ChildAuthorization findOneByMethod(string $method) Return the first ChildAuthorization filtered by the method column
 * @method     ChildAuthorization findOneByIdUser(int $id_user) Return the first ChildAuthorization filtered by the id_user column
 * @method     ChildAuthorization findOneByIdUserGroup(int $id_user_group) Return the first ChildAuthorization filtered by the id_user_group column
 * @method     ChildAuthorization findOneByOrder(int $order) Return the first ChildAuthorization filtered by the order column
 * @method     ChildAuthorization findOneByPolicy(boolean $policy) Return the first ChildAuthorization filtered by the policy column
 * @method     ChildAuthorization findOneByLabel(string $label) Return the first ChildAuthorization filtered by the label column
 * @method     ChildAuthorization findOneByEnabled(boolean $enabled) Return the first ChildAuthorization filtered by the enabled column
 * @method     ChildAuthorization findOneByCreatedAt(string $created_at) Return the first ChildAuthorization filtered by the created_at column
 * @method     ChildAuthorization findOneByUpdatedAt(string $updated_at) Return the first ChildAuthorization filtered by the updated_at column
 * @method     ChildAuthorization findOneById(int $id) Return the first ChildAuthorization filtered by the id column *

 * @method     ChildAuthorization requirePk($key, ConnectionInterface $con = null) Return the ChildAuthorization by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAuthorization requireOne(ConnectionInterface $con = null) Return the first ChildAuthorization matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildAuthorization requireOneByUri(string $uri) Return the first ChildAuthorization filtered by the uri column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAuthorization requireOneByMethod(string $method) Return the first ChildAuthorization filtered by the method column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAuthorization requireOneByIdUser(int $id_user) Return the first ChildAuthorization filtered by the id_user column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAuthorization requireOneByIdUserGroup(int $id_user_group) Return the first ChildAuthorization filtered by the id_user_group column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAuthorization requireOneByOrder(int $order) Return the first ChildAuthorization filtered by the order column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAuthorization requireOneByPolicy(boolean $policy) Return the first ChildAuthorization filtered by the policy column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAuthorization requireOneByLabel(string $label) Return the first ChildAuthorization filtered by the label column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAuthorization requireOneByEnabled(boolean $enabled) Return the first ChildAuthorization filtered by the enabled column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAuthorization requireOneByCreatedAt(string $created_at) Return the first ChildAuthorization filtered by the created_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAuthorization requireOneByUpdatedAt(string $updated_at) Return the first ChildAuthorization filtered by the updated_at column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAuthorization requireOneById(int $id) Return the first ChildAuthorization filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildAuthorization[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildAuthorization objects based on current ModelCriteria
 * @method     ChildAuthorization[]|ObjectCollection findByUri(string $uri) Return ChildAuthorization objects filtered by the uri column
 * @method     ChildAuthorization[]|ObjectCollection findByMethod(string $method) Return ChildAuthorization objects filtered by the method column
 * @method     ChildAuthorization[]|ObjectCollection findByIdUser(int $id_user) Return ChildAuthorization objects filtered by the id_user column
 * @method     ChildAuthorization[]|ObjectCollection findByIdUserGroup(int $id_user_group) Return ChildAuthorization objects filtered by the id_user_group column
 * @method     ChildAuthorization[]|ObjectCollection findByOrder(int $order) Return ChildAuthorization objects filtered by the order column
 * @method     ChildAuthorization[]|ObjectCollection findByPolicy(boolean $policy) Return ChildAuthorization objects filtered by the policy column
 * @method     ChildAuthorization[]|ObjectCollection findByLabel(string $label) Return ChildAuthorization objects filtered by the label column
 * @method     ChildAuthorization[]|ObjectCollection findByEnabled(boolean $enabled) Return ChildAuthorization objects filtered by the enabled column
 * @method     ChildAuthorization[]|ObjectCollection findByCreatedAt(string $created_at) Return ChildAuthorization objects filtered by the created_at column
 * @method     ChildAuthorization[]|ObjectCollection findByUpdatedAt(string $updated_at) Return ChildAuthorization objects filtered by the updated_at column
 * @method     ChildAuthorization[]|ObjectCollection findById(int $id) Return ChildAuthorization objects filtered by the id column
 * @method     ChildAuthorization[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class AuthorizationQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \App\Models\Base\AuthorizationQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\App\\Models\\Authorization', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildAuthorizationQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildAuthorizationQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildAuthorizationQuery) {
            return $criteria;
        }
        $query = new ChildAuthorizationQuery();
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
     * @return ChildAuthorization|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = AuthorizationTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(AuthorizationTableMap::DATABASE_NAME);
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
     * @return ChildAuthorization A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT uri, method, id_user, id_user_group, order, policy, label, enabled, created_at, updated_at, id FROM authorization WHERE id = :p0';
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
            /** @var ChildAuthorization $obj */
            $obj = new ChildAuthorization();
            $obj->hydrate($row);
            AuthorizationTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildAuthorization|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildAuthorizationQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(AuthorizationTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildAuthorizationQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(AuthorizationTableMap::COL_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the uri column
     *
     * Example usage:
     * <code>
     * $query->filterByUri('fooValue');   // WHERE uri = 'fooValue'
     * $query->filterByUri('%fooValue%'); // WHERE uri LIKE '%fooValue%'
     * </code>
     *
     * @param     string $uri The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAuthorizationQuery The current query, for fluid interface
     */
    public function filterByUri($uri = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($uri)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $uri)) {
                $uri = str_replace('*', '%', $uri);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(AuthorizationTableMap::COL_URI, $uri, $comparison);
    }

    /**
     * Filter the query on the method column
     *
     * Example usage:
     * <code>
     * $query->filterByMethod('fooValue');   // WHERE method = 'fooValue'
     * $query->filterByMethod('%fooValue%'); // WHERE method LIKE '%fooValue%'
     * </code>
     *
     * @param     string $method The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAuthorizationQuery The current query, for fluid interface
     */
    public function filterByMethod($method = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($method)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $method)) {
                $method = str_replace('*', '%', $method);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(AuthorizationTableMap::COL_METHOD, $method, $comparison);
    }

    /**
     * Filter the query on the id_user column
     *
     * Example usage:
     * <code>
     * $query->filterByIdUser(1234); // WHERE id_user = 1234
     * $query->filterByIdUser(array(12, 34)); // WHERE id_user IN (12, 34)
     * $query->filterByIdUser(array('min' => 12)); // WHERE id_user > 12
     * </code>
     *
     * @param     mixed $idUser The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAuthorizationQuery The current query, for fluid interface
     */
    public function filterByIdUser($idUser = null, $comparison = null)
    {
        if (is_array($idUser)) {
            $useMinMax = false;
            if (isset($idUser['min'])) {
                $this->addUsingAlias(AuthorizationTableMap::COL_ID_USER, $idUser['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idUser['max'])) {
                $this->addUsingAlias(AuthorizationTableMap::COL_ID_USER, $idUser['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AuthorizationTableMap::COL_ID_USER, $idUser, $comparison);
    }

    /**
     * Filter the query on the id_user_group column
     *
     * Example usage:
     * <code>
     * $query->filterByIdUserGroup(1234); // WHERE id_user_group = 1234
     * $query->filterByIdUserGroup(array(12, 34)); // WHERE id_user_group IN (12, 34)
     * $query->filterByIdUserGroup(array('min' => 12)); // WHERE id_user_group > 12
     * </code>
     *
     * @param     mixed $idUserGroup The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAuthorizationQuery The current query, for fluid interface
     */
    public function filterByIdUserGroup($idUserGroup = null, $comparison = null)
    {
        if (is_array($idUserGroup)) {
            $useMinMax = false;
            if (isset($idUserGroup['min'])) {
                $this->addUsingAlias(AuthorizationTableMap::COL_ID_USER_GROUP, $idUserGroup['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idUserGroup['max'])) {
                $this->addUsingAlias(AuthorizationTableMap::COL_ID_USER_GROUP, $idUserGroup['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AuthorizationTableMap::COL_ID_USER_GROUP, $idUserGroup, $comparison);
    }

    /**
     * Filter the query on the order column
     *
     * Example usage:
     * <code>
     * $query->filterByOrder(1234); // WHERE order = 1234
     * $query->filterByOrder(array(12, 34)); // WHERE order IN (12, 34)
     * $query->filterByOrder(array('min' => 12)); // WHERE order > 12
     * </code>
     *
     * @param     mixed $order The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAuthorizationQuery The current query, for fluid interface
     */
    public function filterByOrder($order = null, $comparison = null)
    {
        if (is_array($order)) {
            $useMinMax = false;
            if (isset($order['min'])) {
                $this->addUsingAlias(AuthorizationTableMap::COL_ORDER, $order['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($order['max'])) {
                $this->addUsingAlias(AuthorizationTableMap::COL_ORDER, $order['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AuthorizationTableMap::COL_ORDER, $order, $comparison);
    }

    /**
     * Filter the query on the policy column
     *
     * Example usage:
     * <code>
     * $query->filterByPolicy(true); // WHERE policy = true
     * $query->filterByPolicy('yes'); // WHERE policy = true
     * </code>
     *
     * @param     boolean|string $policy The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAuthorizationQuery The current query, for fluid interface
     */
    public function filterByPolicy($policy = null, $comparison = null)
    {
        if (is_string($policy)) {
            $policy = in_array(strtolower($policy), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(AuthorizationTableMap::COL_POLICY, $policy, $comparison);
    }

    /**
     * Filter the query on the label column
     *
     * Example usage:
     * <code>
     * $query->filterByLabel('fooValue');   // WHERE label = 'fooValue'
     * $query->filterByLabel('%fooValue%'); // WHERE label LIKE '%fooValue%'
     * </code>
     *
     * @param     string $label The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAuthorizationQuery The current query, for fluid interface
     */
    public function filterByLabel($label = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($label)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $label)) {
                $label = str_replace('*', '%', $label);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(AuthorizationTableMap::COL_LABEL, $label, $comparison);
    }

    /**
     * Filter the query on the enabled column
     *
     * Example usage:
     * <code>
     * $query->filterByEnabled(true); // WHERE enabled = true
     * $query->filterByEnabled('yes'); // WHERE enabled = true
     * </code>
     *
     * @param     boolean|string $enabled The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAuthorizationQuery The current query, for fluid interface
     */
    public function filterByEnabled($enabled = null, $comparison = null)
    {
        if (is_string($enabled)) {
            $enabled = in_array(strtolower($enabled), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(AuthorizationTableMap::COL_ENABLED, $enabled, $comparison);
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
     * @return $this|ChildAuthorizationQuery The current query, for fluid interface
     */
    public function filterByCreatedAt($createdAt = null, $comparison = null)
    {
        if (is_array($createdAt)) {
            $useMinMax = false;
            if (isset($createdAt['min'])) {
                $this->addUsingAlias(AuthorizationTableMap::COL_CREATED_AT, $createdAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($createdAt['max'])) {
                $this->addUsingAlias(AuthorizationTableMap::COL_CREATED_AT, $createdAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AuthorizationTableMap::COL_CREATED_AT, $createdAt, $comparison);
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
     * @return $this|ChildAuthorizationQuery The current query, for fluid interface
     */
    public function filterByUpdatedAt($updatedAt = null, $comparison = null)
    {
        if (is_array($updatedAt)) {
            $useMinMax = false;
            if (isset($updatedAt['min'])) {
                $this->addUsingAlias(AuthorizationTableMap::COL_UPDATED_AT, $updatedAt['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($updatedAt['max'])) {
                $this->addUsingAlias(AuthorizationTableMap::COL_UPDATED_AT, $updatedAt['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AuthorizationTableMap::COL_UPDATED_AT, $updatedAt, $comparison);
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
     * @return $this|ChildAuthorizationQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(AuthorizationTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(AuthorizationTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AuthorizationTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildAuthorization $authorization Object to remove from the list of results
     *
     * @return $this|ChildAuthorizationQuery The current query, for fluid interface
     */
    public function prune($authorization = null)
    {
        if ($authorization) {
            $this->addUsingAlias(AuthorizationTableMap::COL_ID, $authorization->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the authorization table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(AuthorizationTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            AuthorizationTableMap::clearInstancePool();
            AuthorizationTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(AuthorizationTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(AuthorizationTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            AuthorizationTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            AuthorizationTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    // timestampable behavior

    /**
     * Filter by the latest updated
     *
     * @param      int $nbDays Maximum age of the latest update in days
     *
     * @return     $this|ChildAuthorizationQuery The current query, for fluid interface
     */
    public function recentlyUpdated($nbDays = 7)
    {
        return $this->addUsingAlias(AuthorizationTableMap::COL_UPDATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by update date desc
     *
     * @return     $this|ChildAuthorizationQuery The current query, for fluid interface
     */
    public function lastUpdatedFirst()
    {
        return $this->addDescendingOrderByColumn(AuthorizationTableMap::COL_UPDATED_AT);
    }

    /**
     * Order by update date asc
     *
     * @return     $this|ChildAuthorizationQuery The current query, for fluid interface
     */
    public function firstUpdatedFirst()
    {
        return $this->addAscendingOrderByColumn(AuthorizationTableMap::COL_UPDATED_AT);
    }

    /**
     * Order by create date desc
     *
     * @return     $this|ChildAuthorizationQuery The current query, for fluid interface
     */
    public function lastCreatedFirst()
    {
        return $this->addDescendingOrderByColumn(AuthorizationTableMap::COL_CREATED_AT);
    }

    /**
     * Filter by the latest created
     *
     * @param      int $nbDays Maximum age of in days
     *
     * @return     $this|ChildAuthorizationQuery The current query, for fluid interface
     */
    public function recentlyCreated($nbDays = 7)
    {
        return $this->addUsingAlias(AuthorizationTableMap::COL_CREATED_AT, time() - $nbDays * 24 * 60 * 60, Criteria::GREATER_EQUAL);
    }

    /**
     * Order by create date asc
     *
     * @return     $this|ChildAuthorizationQuery The current query, for fluid interface
     */
    public function firstCreatedFirst()
    {
        return $this->addAscendingOrderByColumn(AuthorizationTableMap::COL_CREATED_AT);
    }

} // AuthorizationQuery
