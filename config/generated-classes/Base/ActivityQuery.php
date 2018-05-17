<?php

namespace Base;

use \Activity as ChildActivity;
use \ActivityQuery as ChildActivityQuery;
use \Exception;
use \PDO;
use Map\ActivityTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'actividades' table.
 *
 *
 *
 * @method     ChildActivityQuery orderByActividadId($order = Criteria::ASC) Order by the actividad_id column
 * @method     ChildActivityQuery orderByNombre($order = Criteria::ASC) Order by the nombre column
 * @method     ChildActivityQuery orderByCategoriaActividadId($order = Criteria::ASC) Order by the categoria_actividad_id column
 *
 * @method     ChildActivityQuery groupByActividadId() Group by the actividad_id column
 * @method     ChildActivityQuery groupByNombre() Group by the nombre column
 * @method     ChildActivityQuery groupByCategoriaActividadId() Group by the categoria_actividad_id column
 *
 * @method     ChildActivityQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildActivityQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildActivityQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildActivityQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildActivityQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildActivityQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildActivityQuery leftJoinActivityCategory($relationAlias = null) Adds a LEFT JOIN clause to the query using the ActivityCategory relation
 * @method     ChildActivityQuery rightJoinActivityCategory($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ActivityCategory relation
 * @method     ChildActivityQuery innerJoinActivityCategory($relationAlias = null) Adds a INNER JOIN clause to the query using the ActivityCategory relation
 *
 * @method     ChildActivityQuery joinWithActivityCategory($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ActivityCategory relation
 *
 * @method     ChildActivityQuery leftJoinWithActivityCategory() Adds a LEFT JOIN clause and with to the query using the ActivityCategory relation
 * @method     ChildActivityQuery rightJoinWithActivityCategory() Adds a RIGHT JOIN clause and with to the query using the ActivityCategory relation
 * @method     ChildActivityQuery innerJoinWithActivityCategory() Adds a INNER JOIN clause and with to the query using the ActivityCategory relation
 *
 * @method     ChildActivityQuery leftJoinArticle($relationAlias = null) Adds a LEFT JOIN clause to the query using the Article relation
 * @method     ChildActivityQuery rightJoinArticle($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Article relation
 * @method     ChildActivityQuery innerJoinArticle($relationAlias = null) Adds a INNER JOIN clause to the query using the Article relation
 *
 * @method     ChildActivityQuery joinWithArticle($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Article relation
 *
 * @method     ChildActivityQuery leftJoinWithArticle() Adds a LEFT JOIN clause and with to the query using the Article relation
 * @method     ChildActivityQuery rightJoinWithArticle() Adds a RIGHT JOIN clause and with to the query using the Article relation
 * @method     ChildActivityQuery innerJoinWithArticle() Adds a INNER JOIN clause and with to the query using the Article relation
 *
 * @method     \ActivityCategoryQuery|\ArticleQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildActivity findOne(ConnectionInterface $con = null) Return the first ChildActivity matching the query
 * @method     ChildActivity findOneOrCreate(ConnectionInterface $con = null) Return the first ChildActivity matching the query, or a new ChildActivity object populated from the query conditions when no match is found
 *
 * @method     ChildActivity findOneByActividadId(int $actividad_id) Return the first ChildActivity filtered by the actividad_id column
 * @method     ChildActivity findOneByNombre(string $nombre) Return the first ChildActivity filtered by the nombre column
 * @method     ChildActivity findOneByCategoriaActividadId(int $categoria_actividad_id) Return the first ChildActivity filtered by the categoria_actividad_id column *

 * @method     ChildActivity requirePk($key, ConnectionInterface $con = null) Return the ChildActivity by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildActivity requireOne(ConnectionInterface $con = null) Return the first ChildActivity matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildActivity requireOneByActividadId(int $actividad_id) Return the first ChildActivity filtered by the actividad_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildActivity requireOneByNombre(string $nombre) Return the first ChildActivity filtered by the nombre column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildActivity requireOneByCategoriaActividadId(int $categoria_actividad_id) Return the first ChildActivity filtered by the categoria_actividad_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildActivity[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildActivity objects based on current ModelCriteria
 * @method     ChildActivity[]|ObjectCollection findByActividadId(int $actividad_id) Return ChildActivity objects filtered by the actividad_id column
 * @method     ChildActivity[]|ObjectCollection findByNombre(string $nombre) Return ChildActivity objects filtered by the nombre column
 * @method     ChildActivity[]|ObjectCollection findByCategoriaActividadId(int $categoria_actividad_id) Return ChildActivity objects filtered by the categoria_actividad_id column
 * @method     ChildActivity[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ActivityQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\ActivityQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'myito', $modelName = '\\Activity', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildActivityQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildActivityQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildActivityQuery) {
            return $criteria;
        }
        $query = new ChildActivityQuery();
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
     * @return ChildActivity|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ActivityTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ActivityTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildActivity A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT actividad_id, nombre, categoria_actividad_id FROM actividades WHERE actividad_id = :p0';
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
            /** @var ChildActivity $obj */
            $obj = new ChildActivity();
            $obj->hydrate($row);
            ActivityTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildActivity|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildActivityQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ActivityTableMap::COL_ACTIVIDAD_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildActivityQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ActivityTableMap::COL_ACTIVIDAD_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the actividad_id column
     *
     * Example usage:
     * <code>
     * $query->filterByActividadId(1234); // WHERE actividad_id = 1234
     * $query->filterByActividadId(array(12, 34)); // WHERE actividad_id IN (12, 34)
     * $query->filterByActividadId(array('min' => 12)); // WHERE actividad_id > 12
     * </code>
     *
     * @param     mixed $actividadId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildActivityQuery The current query, for fluid interface
     */
    public function filterByActividadId($actividadId = null, $comparison = null)
    {
        if (is_array($actividadId)) {
            $useMinMax = false;
            if (isset($actividadId['min'])) {
                $this->addUsingAlias(ActivityTableMap::COL_ACTIVIDAD_ID, $actividadId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($actividadId['max'])) {
                $this->addUsingAlias(ActivityTableMap::COL_ACTIVIDAD_ID, $actividadId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ActivityTableMap::COL_ACTIVIDAD_ID, $actividadId, $comparison);
    }

    /**
     * Filter the query on the nombre column
     *
     * Example usage:
     * <code>
     * $query->filterByNombre('fooValue');   // WHERE nombre = 'fooValue'
     * $query->filterByNombre('%fooValue%', Criteria::LIKE); // WHERE nombre LIKE '%fooValue%'
     * </code>
     *
     * @param     string $nombre The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildActivityQuery The current query, for fluid interface
     */
    public function filterByNombre($nombre = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($nombre)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ActivityTableMap::COL_NOMBRE, $nombre, $comparison);
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
     * @return $this|ChildActivityQuery The current query, for fluid interface
     */
    public function filterByCategoriaActividadId($categoriaActividadId = null, $comparison = null)
    {
        if (is_array($categoriaActividadId)) {
            $useMinMax = false;
            if (isset($categoriaActividadId['min'])) {
                $this->addUsingAlias(ActivityTableMap::COL_CATEGORIA_ACTIVIDAD_ID, $categoriaActividadId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($categoriaActividadId['max'])) {
                $this->addUsingAlias(ActivityTableMap::COL_CATEGORIA_ACTIVIDAD_ID, $categoriaActividadId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ActivityTableMap::COL_CATEGORIA_ACTIVIDAD_ID, $categoriaActividadId, $comparison);
    }

    /**
     * Filter the query by a related \ActivityCategory object
     *
     * @param \ActivityCategory|ObjectCollection $activityCategory The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildActivityQuery The current query, for fluid interface
     */
    public function filterByActivityCategory($activityCategory, $comparison = null)
    {
        if ($activityCategory instanceof \ActivityCategory) {
            return $this
                ->addUsingAlias(ActivityTableMap::COL_CATEGORIA_ACTIVIDAD_ID, $activityCategory->getCategoriaActividadId(), $comparison);
        } elseif ($activityCategory instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ActivityTableMap::COL_CATEGORIA_ACTIVIDAD_ID, $activityCategory->toKeyValue('PrimaryKey', 'CategoriaActividadId'), $comparison);
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
     * @return $this|ChildActivityQuery The current query, for fluid interface
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
     * Filter the query by a related \Article object
     *
     * @param \Article|ObjectCollection $article the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildActivityQuery The current query, for fluid interface
     */
    public function filterByArticle($article, $comparison = null)
    {
        if ($article instanceof \Article) {
            return $this
                ->addUsingAlias(ActivityTableMap::COL_ACTIVIDAD_ID, $article->getActividadId(), $comparison);
        } elseif ($article instanceof ObjectCollection) {
            return $this
                ->useArticleQuery()
                ->filterByPrimaryKeys($article->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByArticle() only accepts arguments of type \Article or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Article relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildActivityQuery The current query, for fluid interface
     */
    public function joinArticle($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Article');

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
            $this->addJoinObject($join, 'Article');
        }

        return $this;
    }

    /**
     * Use the Article relation Article object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \ArticleQuery A secondary query class using the current class as primary query
     */
    public function useArticleQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinArticle($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Article', '\ArticleQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildActivity $activity Object to remove from the list of results
     *
     * @return $this|ChildActivityQuery The current query, for fluid interface
     */
    public function prune($activity = null)
    {
        if ($activity) {
            $this->addUsingAlias(ActivityTableMap::COL_ACTIVIDAD_ID, $activity->getActividadId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the actividades table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ActivityTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ActivityTableMap::clearInstancePool();
            ActivityTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ActivityTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ActivityTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ActivityTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ActivityTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ActivityQuery
