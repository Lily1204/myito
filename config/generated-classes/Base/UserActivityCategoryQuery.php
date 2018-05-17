<?php

namespace Base;

use \UserActivityCategory as ChildUserActivityCategory;
use \UserActivityCategoryQuery as ChildUserActivityCategoryQuery;
use \Exception;
use \PDO;
use Map\UserActivityCategoryTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'usuario_categoria_actividad' table.
 *
 *
 *
 * @method     ChildUserActivityCategoryQuery orderByCorreo($order = Criteria::ASC) Order by the correo column
 * @method     ChildUserActivityCategoryQuery orderByCategoriaActividadId($order = Criteria::ASC) Order by the categoria_actividad_id column
 * @method     ChildUserActivityCategoryQuery orderByEstatus($order = Criteria::ASC) Order by the estatus column
 *
 * @method     ChildUserActivityCategoryQuery groupByCorreo() Group by the correo column
 * @method     ChildUserActivityCategoryQuery groupByCategoriaActividadId() Group by the categoria_actividad_id column
 * @method     ChildUserActivityCategoryQuery groupByEstatus() Group by the estatus column
 *
 * @method     ChildUserActivityCategoryQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildUserActivityCategoryQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildUserActivityCategoryQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildUserActivityCategoryQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildUserActivityCategoryQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildUserActivityCategoryQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildUserActivityCategoryQuery leftJoinUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the User relation
 * @method     ChildUserActivityCategoryQuery rightJoinUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the User relation
 * @method     ChildUserActivityCategoryQuery innerJoinUser($relationAlias = null) Adds a INNER JOIN clause to the query using the User relation
 *
 * @method     ChildUserActivityCategoryQuery joinWithUser($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the User relation
 *
 * @method     ChildUserActivityCategoryQuery leftJoinWithUser() Adds a LEFT JOIN clause and with to the query using the User relation
 * @method     ChildUserActivityCategoryQuery rightJoinWithUser() Adds a RIGHT JOIN clause and with to the query using the User relation
 * @method     ChildUserActivityCategoryQuery innerJoinWithUser() Adds a INNER JOIN clause and with to the query using the User relation
 *
 * @method     ChildUserActivityCategoryQuery leftJoinActivityCategory($relationAlias = null) Adds a LEFT JOIN clause to the query using the ActivityCategory relation
 * @method     ChildUserActivityCategoryQuery rightJoinActivityCategory($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ActivityCategory relation
 * @method     ChildUserActivityCategoryQuery innerJoinActivityCategory($relationAlias = null) Adds a INNER JOIN clause to the query using the ActivityCategory relation
 *
 * @method     ChildUserActivityCategoryQuery joinWithActivityCategory($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ActivityCategory relation
 *
 * @method     ChildUserActivityCategoryQuery leftJoinWithActivityCategory() Adds a LEFT JOIN clause and with to the query using the ActivityCategory relation
 * @method     ChildUserActivityCategoryQuery rightJoinWithActivityCategory() Adds a RIGHT JOIN clause and with to the query using the ActivityCategory relation
 * @method     ChildUserActivityCategoryQuery innerJoinWithActivityCategory() Adds a INNER JOIN clause and with to the query using the ActivityCategory relation
 *
 * @method     \UserQuery|\ActivityCategoryQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildUserActivityCategory findOne(ConnectionInterface $con = null) Return the first ChildUserActivityCategory matching the query
 * @method     ChildUserActivityCategory findOneOrCreate(ConnectionInterface $con = null) Return the first ChildUserActivityCategory matching the query, or a new ChildUserActivityCategory object populated from the query conditions when no match is found
 *
 * @method     ChildUserActivityCategory findOneByCorreo(string $correo) Return the first ChildUserActivityCategory filtered by the correo column
 * @method     ChildUserActivityCategory findOneByCategoriaActividadId(int $categoria_actividad_id) Return the first ChildUserActivityCategory filtered by the categoria_actividad_id column
 * @method     ChildUserActivityCategory findOneByEstatus(boolean $estatus) Return the first ChildUserActivityCategory filtered by the estatus column *

 * @method     ChildUserActivityCategory requirePk($key, ConnectionInterface $con = null) Return the ChildUserActivityCategory by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserActivityCategory requireOne(ConnectionInterface $con = null) Return the first ChildUserActivityCategory matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUserActivityCategory requireOneByCorreo(string $correo) Return the first ChildUserActivityCategory filtered by the correo column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserActivityCategory requireOneByCategoriaActividadId(int $categoria_actividad_id) Return the first ChildUserActivityCategory filtered by the categoria_actividad_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserActivityCategory requireOneByEstatus(boolean $estatus) Return the first ChildUserActivityCategory filtered by the estatus column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUserActivityCategory[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildUserActivityCategory objects based on current ModelCriteria
 * @method     ChildUserActivityCategory[]|ObjectCollection findByCorreo(string $correo) Return ChildUserActivityCategory objects filtered by the correo column
 * @method     ChildUserActivityCategory[]|ObjectCollection findByCategoriaActividadId(int $categoria_actividad_id) Return ChildUserActivityCategory objects filtered by the categoria_actividad_id column
 * @method     ChildUserActivityCategory[]|ObjectCollection findByEstatus(boolean $estatus) Return ChildUserActivityCategory objects filtered by the estatus column
 * @method     ChildUserActivityCategory[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class UserActivityCategoryQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\UserActivityCategoryQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'myito', $modelName = '\\UserActivityCategory', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildUserActivityCategoryQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildUserActivityCategoryQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildUserActivityCategoryQuery) {
            return $criteria;
        }
        $query = new ChildUserActivityCategoryQuery();
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
     * $obj = $c->findPk(array(12, 34), $con);
     * </code>
     *
     * @param array[$correo, $categoria_actividad_id] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildUserActivityCategory|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(UserActivityCategoryTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = UserActivityCategoryTableMap::getInstanceFromPool(serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]))))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
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
     * @return ChildUserActivityCategory A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT correo, categoria_actividad_id, estatus FROM usuario_categoria_actividad WHERE correo = :p0 AND categoria_actividad_id = :p1';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_STR);
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildUserActivityCategory $obj */
            $obj = new ChildUserActivityCategory();
            $obj->hydrate($row);
            UserActivityCategoryTableMap::addInstanceToPool($obj, serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]));
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
     * @return ChildUserActivityCategory|array|mixed the result, formatted by the current formatter
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
     * $objs = $c->findPks(array(array(12, 56), array(832, 123), array(123, 456)), $con);
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
     * @return $this|ChildUserActivityCategoryQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(UserActivityCategoryTableMap::COL_CORREO, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(UserActivityCategoryTableMap::COL_CATEGORIA_ACTIVIDAD_ID, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildUserActivityCategoryQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(UserActivityCategoryTableMap::COL_CORREO, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(UserActivityCategoryTableMap::COL_CATEGORIA_ACTIVIDAD_ID, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
    }

    /**
     * Filter the query on the correo column
     *
     * Example usage:
     * <code>
     * $query->filterByCorreo('fooValue');   // WHERE correo = 'fooValue'
     * $query->filterByCorreo('%fooValue%', Criteria::LIKE); // WHERE correo LIKE '%fooValue%'
     * </code>
     *
     * @param     string $correo The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserActivityCategoryQuery The current query, for fluid interface
     */
    public function filterByCorreo($correo = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($correo)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserActivityCategoryTableMap::COL_CORREO, $correo, $comparison);
    }

    /**
     * Filter the query on the categoria_actividad_id column
     *
     * Example usage:
     * <code>
     * $query->filterByCategoriaActividadId(1234); // WHERE categoria_actividad_id = 1234
     * $query->filterByCategoriaActividadId(array(12, 34)); // WHERE categoria_actividad_id IN (12, 34)
     * $query->filterByCategoriaActividadId(array('min' => 12)); // WHERE categoria_actividad_id > 12
     * </code>
     *
     * @see       filterByActivityCategory()
     *
     * @param     mixed $categoriaActividadId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserActivityCategoryQuery The current query, for fluid interface
     */
    public function filterByCategoriaActividadId($categoriaActividadId = null, $comparison = null)
    {
        if (is_array($categoriaActividadId)) {
            $useMinMax = false;
            if (isset($categoriaActividadId['min'])) {
                $this->addUsingAlias(UserActivityCategoryTableMap::COL_CATEGORIA_ACTIVIDAD_ID, $categoriaActividadId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($categoriaActividadId['max'])) {
                $this->addUsingAlias(UserActivityCategoryTableMap::COL_CATEGORIA_ACTIVIDAD_ID, $categoriaActividadId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserActivityCategoryTableMap::COL_CATEGORIA_ACTIVIDAD_ID, $categoriaActividadId, $comparison);
    }

    /**
     * Filter the query on the estatus column
     *
     * Example usage:
     * <code>
     * $query->filterByEstatus(true); // WHERE estatus = true
     * $query->filterByEstatus('yes'); // WHERE estatus = true
     * </code>
     *
     * @param     boolean|string $estatus The value to use as filter.
     *              Non-boolean arguments are converted using the following rules:
     *                * 1, '1', 'true',  'on',  and 'yes' are converted to boolean true
     *                * 0, '0', 'false', 'off', and 'no'  are converted to boolean false
     *              Check on string values is case insensitive (so 'FaLsE' is seen as 'false').
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserActivityCategoryQuery The current query, for fluid interface
     */
    public function filterByEstatus($estatus = null, $comparison = null)
    {
        if (is_string($estatus)) {
            $estatus = in_array(strtolower($estatus), array('false', 'off', '-', 'no', 'n', '0', '')) ? false : true;
        }

        return $this->addUsingAlias(UserActivityCategoryTableMap::COL_ESTATUS, $estatus, $comparison);
    }

    /**
     * Filter the query by a related \User object
     *
     * @param \User|ObjectCollection $user The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildUserActivityCategoryQuery The current query, for fluid interface
     */
    public function filterByUser($user, $comparison = null)
    {
        if ($user instanceof \User) {
            return $this
                ->addUsingAlias(UserActivityCategoryTableMap::COL_CORREO, $user->getCorreo(), $comparison);
        } elseif ($user instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(UserActivityCategoryTableMap::COL_CORREO, $user->toKeyValue('PrimaryKey', 'Correo'), $comparison);
        } else {
            throw new PropelException('filterByUser() only accepts arguments of type \User or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the User relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildUserActivityCategoryQuery The current query, for fluid interface
     */
    public function joinUser($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('User');

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
            $this->addJoinObject($join, 'User');
        }

        return $this;
    }

    /**
     * Use the User relation User object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \UserQuery A secondary query class using the current class as primary query
     */
    public function useUserQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinUser($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'User', '\UserQuery');
    }

    /**
     * Filter the query by a related \ActivityCategory object
     *
     * @param \ActivityCategory|ObjectCollection $activityCategory The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildUserActivityCategoryQuery The current query, for fluid interface
     */
    public function filterByActivityCategory($activityCategory, $comparison = null)
    {
        if ($activityCategory instanceof \ActivityCategory) {
            return $this
                ->addUsingAlias(UserActivityCategoryTableMap::COL_CATEGORIA_ACTIVIDAD_ID, $activityCategory->getCategoriaActividadId(), $comparison);
        } elseif ($activityCategory instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(UserActivityCategoryTableMap::COL_CATEGORIA_ACTIVIDAD_ID, $activityCategory->toKeyValue('PrimaryKey', 'CategoriaActividadId'), $comparison);
        } else {
            throw new PropelException('filterByActivityCategory() only accepts arguments of type \ActivityCategory or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ActivityCategory relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildUserActivityCategoryQuery The current query, for fluid interface
     */
    public function joinActivityCategory($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ActivityCategory');

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
            $this->addJoinObject($join, 'ActivityCategory');
        }

        return $this;
    }

    /**
     * Use the ActivityCategory relation ActivityCategory object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \ActivityCategoryQuery A secondary query class using the current class as primary query
     */
    public function useActivityCategoryQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinActivityCategory($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ActivityCategory', '\ActivityCategoryQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildUserActivityCategory $userActivityCategory Object to remove from the list of results
     *
     * @return $this|ChildUserActivityCategoryQuery The current query, for fluid interface
     */
    public function prune($userActivityCategory = null)
    {
        if ($userActivityCategory) {
            $this->addCond('pruneCond0', $this->getAliasedColName(UserActivityCategoryTableMap::COL_CORREO), $userActivityCategory->getCorreo(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(UserActivityCategoryTableMap::COL_CATEGORIA_ACTIVIDAD_ID), $userActivityCategory->getCategoriaActividadId(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the usuario_categoria_actividad table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UserActivityCategoryTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            UserActivityCategoryTableMap::clearInstancePool();
            UserActivityCategoryTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(UserActivityCategoryTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(UserActivityCategoryTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            UserActivityCategoryTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            UserActivityCategoryTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // UserActivityCategoryQuery
