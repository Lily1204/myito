<?php

namespace Base;

use \ActivityCategory as ChildActivityCategory;
use \ActivityCategoryQuery as ChildActivityCategoryQuery;
use \Exception;
use \PDO;
use Map\ActivityCategoryTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'categoria_actividad' table.
 *
 *
 *
 * @method     ChildActivityCategoryQuery orderByCategoriaActividadId($order = Criteria::ASC) Order by the categoria_actividad_id column
 * @method     ChildActivityCategoryQuery orderByNombreActividad($order = Criteria::ASC) Order by the nombre_actividad column
 *
 * @method     ChildActivityCategoryQuery groupByCategoriaActividadId() Group by the categoria_actividad_id column
 * @method     ChildActivityCategoryQuery groupByNombreActividad() Group by the nombre_actividad column
 *
 * @method     ChildActivityCategoryQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildActivityCategoryQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildActivityCategoryQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildActivityCategoryQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildActivityCategoryQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildActivityCategoryQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildActivityCategoryQuery leftJoinActivity($relationAlias = null) Adds a LEFT JOIN clause to the query using the Activity relation
 * @method     ChildActivityCategoryQuery rightJoinActivity($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Activity relation
 * @method     ChildActivityCategoryQuery innerJoinActivity($relationAlias = null) Adds a INNER JOIN clause to the query using the Activity relation
 *
 * @method     ChildActivityCategoryQuery joinWithActivity($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Activity relation
 *
 * @method     ChildActivityCategoryQuery leftJoinWithActivity() Adds a LEFT JOIN clause and with to the query using the Activity relation
 * @method     ChildActivityCategoryQuery rightJoinWithActivity() Adds a RIGHT JOIN clause and with to the query using the Activity relation
 * @method     ChildActivityCategoryQuery innerJoinWithActivity() Adds a INNER JOIN clause and with to the query using the Activity relation
 *
 * @method     ChildActivityCategoryQuery leftJoinUserActivityCategory($relationAlias = null) Adds a LEFT JOIN clause to the query using the UserActivityCategory relation
 * @method     ChildActivityCategoryQuery rightJoinUserActivityCategory($relationAlias = null) Adds a RIGHT JOIN clause to the query using the UserActivityCategory relation
 * @method     ChildActivityCategoryQuery innerJoinUserActivityCategory($relationAlias = null) Adds a INNER JOIN clause to the query using the UserActivityCategory relation
 *
 * @method     ChildActivityCategoryQuery joinWithUserActivityCategory($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the UserActivityCategory relation
 *
 * @method     ChildActivityCategoryQuery leftJoinWithUserActivityCategory() Adds a LEFT JOIN clause and with to the query using the UserActivityCategory relation
 * @method     ChildActivityCategoryQuery rightJoinWithUserActivityCategory() Adds a RIGHT JOIN clause and with to the query using the UserActivityCategory relation
 * @method     ChildActivityCategoryQuery innerJoinWithUserActivityCategory() Adds a INNER JOIN clause and with to the query using the UserActivityCategory relation
 *
 * @method     ChildActivityCategoryQuery leftJoinQuestion($relationAlias = null) Adds a LEFT JOIN clause to the query using the Question relation
 * @method     ChildActivityCategoryQuery rightJoinQuestion($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Question relation
 * @method     ChildActivityCategoryQuery innerJoinQuestion($relationAlias = null) Adds a INNER JOIN clause to the query using the Question relation
 *
 * @method     ChildActivityCategoryQuery joinWithQuestion($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Question relation
 *
 * @method     ChildActivityCategoryQuery leftJoinWithQuestion() Adds a LEFT JOIN clause and with to the query using the Question relation
 * @method     ChildActivityCategoryQuery rightJoinWithQuestion() Adds a RIGHT JOIN clause and with to the query using the Question relation
 * @method     ChildActivityCategoryQuery innerJoinWithQuestion() Adds a INNER JOIN clause and with to the query using the Question relation
 *
 * @method     \ActivityQuery|\UserActivityCategoryQuery|\QuestionQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildActivityCategory findOne(ConnectionInterface $con = null) Return the first ChildActivityCategory matching the query
 * @method     ChildActivityCategory findOneOrCreate(ConnectionInterface $con = null) Return the first ChildActivityCategory matching the query, or a new ChildActivityCategory object populated from the query conditions when no match is found
 *
 * @method     ChildActivityCategory findOneByCategoriaActividadId(int $categoria_actividad_id) Return the first ChildActivityCategory filtered by the categoria_actividad_id column
 * @method     ChildActivityCategory findOneByNombreActividad(string $nombre_actividad) Return the first ChildActivityCategory filtered by the nombre_actividad column *

 * @method     ChildActivityCategory requirePk($key, ConnectionInterface $con = null) Return the ChildActivityCategory by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildActivityCategory requireOne(ConnectionInterface $con = null) Return the first ChildActivityCategory matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildActivityCategory requireOneByCategoriaActividadId(int $categoria_actividad_id) Return the first ChildActivityCategory filtered by the categoria_actividad_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildActivityCategory requireOneByNombreActividad(string $nombre_actividad) Return the first ChildActivityCategory filtered by the nombre_actividad column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildActivityCategory[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildActivityCategory objects based on current ModelCriteria
 * @method     ChildActivityCategory[]|ObjectCollection findByCategoriaActividadId(int $categoria_actividad_id) Return ChildActivityCategory objects filtered by the categoria_actividad_id column
 * @method     ChildActivityCategory[]|ObjectCollection findByNombreActividad(string $nombre_actividad) Return ChildActivityCategory objects filtered by the nombre_actividad column
 * @method     ChildActivityCategory[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ActivityCategoryQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\ActivityCategoryQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'myito', $modelName = '\\ActivityCategory', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildActivityCategoryQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildActivityCategoryQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildActivityCategoryQuery) {
            return $criteria;
        }
        $query = new ChildActivityCategoryQuery();
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
     * @return ChildActivityCategory|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ActivityCategoryTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ActivityCategoryTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildActivityCategory A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT categoria_actividad_id, nombre_actividad FROM categoria_actividad WHERE categoria_actividad_id = :p0';
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
            /** @var ChildActivityCategory $obj */
            $obj = new ChildActivityCategory();
            $obj->hydrate($row);
            ActivityCategoryTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildActivityCategory|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildActivityCategoryQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ActivityCategoryTableMap::COL_CATEGORIA_ACTIVIDAD_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildActivityCategoryQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ActivityCategoryTableMap::COL_CATEGORIA_ACTIVIDAD_ID, $keys, Criteria::IN);
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
     * @param     mixed $categoriaActividadId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildActivityCategoryQuery The current query, for fluid interface
     */
    public function filterByCategoriaActividadId($categoriaActividadId = null, $comparison = null)
    {
        if (is_array($categoriaActividadId)) {
            $useMinMax = false;
            if (isset($categoriaActividadId['min'])) {
                $this->addUsingAlias(ActivityCategoryTableMap::COL_CATEGORIA_ACTIVIDAD_ID, $categoriaActividadId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($categoriaActividadId['max'])) {
                $this->addUsingAlias(ActivityCategoryTableMap::COL_CATEGORIA_ACTIVIDAD_ID, $categoriaActividadId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ActivityCategoryTableMap::COL_CATEGORIA_ACTIVIDAD_ID, $categoriaActividadId, $comparison);
    }

    /**
     * Filter the query on the nombre_actividad column
     *
     * Example usage:
     * <code>
     * $query->filterByNombreActividad('fooValue');   // WHERE nombre_actividad = 'fooValue'
     * $query->filterByNombreActividad('%fooValue%', Criteria::LIKE); // WHERE nombre_actividad LIKE '%fooValue%'
     * </code>
     *
     * @param     string $nombreActividad The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildActivityCategoryQuery The current query, for fluid interface
     */
    public function filterByNombreActividad($nombreActividad = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nombreActividad)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ActivityCategoryTableMap::COL_NOMBRE_ACTIVIDAD, $nombreActividad, $comparison);
    }

    /**
     * Filter the query by a related \Activity object
     *
     * @param \Activity|ObjectCollection $activity the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildActivityCategoryQuery The current query, for fluid interface
     */
    public function filterByActivity($activity, $comparison = null)
    {
        if ($activity instanceof \Activity) {
            return $this
                ->addUsingAlias(ActivityCategoryTableMap::COL_CATEGORIA_ACTIVIDAD_ID, $activity->getCategoriaActividadId(), $comparison);
        } elseif ($activity instanceof ObjectCollection) {
            return $this
                ->useActivityQuery()
                ->filterByPrimaryKeys($activity->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByActivity() only accepts arguments of type \Activity or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Activity relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildActivityCategoryQuery The current query, for fluid interface
     */
    public function joinActivity($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Activity');

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
            $this->addJoinObject($join, 'Activity');
        }

        return $this;
    }

    /**
     * Use the Activity relation Activity object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \ActivityQuery A secondary query class using the current class as primary query
     */
    public function useActivityQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinActivity($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Activity', '\ActivityQuery');
    }

    /**
     * Filter the query by a related \UserActivityCategory object
     *
     * @param \UserActivityCategory|ObjectCollection $userActivityCategory the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildActivityCategoryQuery The current query, for fluid interface
     */
    public function filterByUserActivityCategory($userActivityCategory, $comparison = null)
    {
        if ($userActivityCategory instanceof \UserActivityCategory) {
            return $this
                ->addUsingAlias(ActivityCategoryTableMap::COL_CATEGORIA_ACTIVIDAD_ID, $userActivityCategory->getCategoriaActividadId(), $comparison);
        } elseif ($userActivityCategory instanceof ObjectCollection) {
            return $this
                ->useUserActivityCategoryQuery()
                ->filterByPrimaryKeys($userActivityCategory->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByUserActivityCategory() only accepts arguments of type \UserActivityCategory or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the UserActivityCategory relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildActivityCategoryQuery The current query, for fluid interface
     */
    public function joinUserActivityCategory($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('UserActivityCategory');

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
            $this->addJoinObject($join, 'UserActivityCategory');
        }

        return $this;
    }

    /**
     * Use the UserActivityCategory relation UserActivityCategory object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \UserActivityCategoryQuery A secondary query class using the current class as primary query
     */
    public function useUserActivityCategoryQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinUserActivityCategory($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'UserActivityCategory', '\UserActivityCategoryQuery');
    }

    /**
     * Filter the query by a related \Question object
     *
     * @param \Question|ObjectCollection $question the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildActivityCategoryQuery The current query, for fluid interface
     */
    public function filterByQuestion($question, $comparison = null)
    {
        if ($question instanceof \Question) {
            return $this
                ->addUsingAlias(ActivityCategoryTableMap::COL_CATEGORIA_ACTIVIDAD_ID, $question->getCategoriaActividadId(), $comparison);
        } elseif ($question instanceof ObjectCollection) {
            return $this
                ->useQuestionQuery()
                ->filterByPrimaryKeys($question->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByQuestion() only accepts arguments of type \Question or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Question relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildActivityCategoryQuery The current query, for fluid interface
     */
    public function joinQuestion($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Question');

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
            $this->addJoinObject($join, 'Question');
        }

        return $this;
    }

    /**
     * Use the Question relation Question object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \QuestionQuery A secondary query class using the current class as primary query
     */
    public function useQuestionQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinQuestion($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Question', '\QuestionQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildActivityCategory $activityCategory Object to remove from the list of results
     *
     * @return $this|ChildActivityCategoryQuery The current query, for fluid interface
     */
    public function prune($activityCategory = null)
    {
        if ($activityCategory) {
            $this->addUsingAlias(ActivityCategoryTableMap::COL_CATEGORIA_ACTIVIDAD_ID, $activityCategory->getCategoriaActividadId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the categoria_actividad table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ActivityCategoryTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ActivityCategoryTableMap::clearInstancePool();
            ActivityCategoryTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ActivityCategoryTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ActivityCategoryTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ActivityCategoryTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ActivityCategoryTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ActivityCategoryQuery
