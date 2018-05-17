<?php

namespace Base;

use \Question as ChildQuestion;
use \QuestionQuery as ChildQuestionQuery;
use \Exception;
use \PDO;
use Map\QuestionTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'preguntas' table.
 *
 *
 *
 * @method     ChildQuestionQuery orderByPreguntaId($order = Criteria::ASC) Order by the pregunta_id column
 * @method     ChildQuestionQuery orderByPregunta($order = Criteria::ASC) Order by the pregunta column
 * @method     ChildQuestionQuery orderByCategoriaActividadId($order = Criteria::ASC) Order by the categoria_actividad_id column
 *
 * @method     ChildQuestionQuery groupByPreguntaId() Group by the pregunta_id column
 * @method     ChildQuestionQuery groupByPregunta() Group by the pregunta column
 * @method     ChildQuestionQuery groupByCategoriaActividadId() Group by the categoria_actividad_id column
 *
 * @method     ChildQuestionQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildQuestionQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildQuestionQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildQuestionQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildQuestionQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildQuestionQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildQuestionQuery leftJoinActivityCategory($relationAlias = null) Adds a LEFT JOIN clause to the query using the ActivityCategory relation
 * @method     ChildQuestionQuery rightJoinActivityCategory($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ActivityCategory relation
 * @method     ChildQuestionQuery innerJoinActivityCategory($relationAlias = null) Adds a INNER JOIN clause to the query using the ActivityCategory relation
 *
 * @method     ChildQuestionQuery joinWithActivityCategory($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ActivityCategory relation
 *
 * @method     ChildQuestionQuery leftJoinWithActivityCategory() Adds a LEFT JOIN clause and with to the query using the ActivityCategory relation
 * @method     ChildQuestionQuery rightJoinWithActivityCategory() Adds a RIGHT JOIN clause and with to the query using the ActivityCategory relation
 * @method     ChildQuestionQuery innerJoinWithActivityCategory() Adds a INNER JOIN clause and with to the query using the ActivityCategory relation
 *
 * @method     ChildQuestionQuery leftJoinAnswer($relationAlias = null) Adds a LEFT JOIN clause to the query using the Answer relation
 * @method     ChildQuestionQuery rightJoinAnswer($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Answer relation
 * @method     ChildQuestionQuery innerJoinAnswer($relationAlias = null) Adds a INNER JOIN clause to the query using the Answer relation
 *
 * @method     ChildQuestionQuery joinWithAnswer($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Answer relation
 *
 * @method     ChildQuestionQuery leftJoinWithAnswer() Adds a LEFT JOIN clause and with to the query using the Answer relation
 * @method     ChildQuestionQuery rightJoinWithAnswer() Adds a RIGHT JOIN clause and with to the query using the Answer relation
 * @method     ChildQuestionQuery innerJoinWithAnswer() Adds a INNER JOIN clause and with to the query using the Answer relation
 *
 * @method     \ActivityCategoryQuery|\AnswerQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildQuestion findOne(ConnectionInterface $con = null) Return the first ChildQuestion matching the query
 * @method     ChildQuestion findOneOrCreate(ConnectionInterface $con = null) Return the first ChildQuestion matching the query, or a new ChildQuestion object populated from the query conditions when no match is found
 *
 * @method     ChildQuestion findOneByPreguntaId(int $pregunta_id) Return the first ChildQuestion filtered by the pregunta_id column
 * @method     ChildQuestion findOneByPregunta(string $pregunta) Return the first ChildQuestion filtered by the pregunta column
 * @method     ChildQuestion findOneByCategoriaActividadId(int $categoria_actividad_id) Return the first ChildQuestion filtered by the categoria_actividad_id column *

 * @method     ChildQuestion requirePk($key, ConnectionInterface $con = null) Return the ChildQuestion by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildQuestion requireOne(ConnectionInterface $con = null) Return the first ChildQuestion matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildQuestion requireOneByPreguntaId(int $pregunta_id) Return the first ChildQuestion filtered by the pregunta_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildQuestion requireOneByPregunta(string $pregunta) Return the first ChildQuestion filtered by the pregunta column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildQuestion requireOneByCategoriaActividadId(int $categoria_actividad_id) Return the first ChildQuestion filtered by the categoria_actividad_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildQuestion[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildQuestion objects based on current ModelCriteria
 * @method     ChildQuestion[]|ObjectCollection findByPreguntaId(int $pregunta_id) Return ChildQuestion objects filtered by the pregunta_id column
 * @method     ChildQuestion[]|ObjectCollection findByPregunta(string $pregunta) Return ChildQuestion objects filtered by the pregunta column
 * @method     ChildQuestion[]|ObjectCollection findByCategoriaActividadId(int $categoria_actividad_id) Return ChildQuestion objects filtered by the categoria_actividad_id column
 * @method     ChildQuestion[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class QuestionQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\QuestionQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'myito', $modelName = '\\Question', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildQuestionQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildQuestionQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildQuestionQuery) {
            return $criteria;
        }
        $query = new ChildQuestionQuery();
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
     * @return ChildQuestion|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(QuestionTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = QuestionTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildQuestion A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT pregunta_id, pregunta, categoria_actividad_id FROM preguntas WHERE pregunta_id = :p0';
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
            /** @var ChildQuestion $obj */
            $obj = new ChildQuestion();
            $obj->hydrate($row);
            QuestionTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildQuestion|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildQuestionQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(QuestionTableMap::COL_PREGUNTA_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildQuestionQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(QuestionTableMap::COL_PREGUNTA_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the pregunta_id column
     *
     * Example usage:
     * <code>
     * $query->filterByPreguntaId(1234); // WHERE pregunta_id = 1234
     * $query->filterByPreguntaId(array(12, 34)); // WHERE pregunta_id IN (12, 34)
     * $query->filterByPreguntaId(array('min' => 12)); // WHERE pregunta_id > 12
     * </code>
     *
     * @param     mixed $preguntaId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildQuestionQuery The current query, for fluid interface
     */
    public function filterByPreguntaId($preguntaId = null, $comparison = null)
    {
        if (is_array($preguntaId)) {
            $useMinMax = false;
            if (isset($preguntaId['min'])) {
                $this->addUsingAlias(QuestionTableMap::COL_PREGUNTA_ID, $preguntaId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($preguntaId['max'])) {
                $this->addUsingAlias(QuestionTableMap::COL_PREGUNTA_ID, $preguntaId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(QuestionTableMap::COL_PREGUNTA_ID, $preguntaId, $comparison);
    }

    /**
     * Filter the query on the pregunta column
     *
     * Example usage:
     * <code>
     * $query->filterByPregunta('fooValue');   // WHERE pregunta = 'fooValue'
     * $query->filterByPregunta('%fooValue%', Criteria::LIKE); // WHERE pregunta LIKE '%fooValue%'
     * </code>
     *
     * @param     string $pregunta The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildQuestionQuery The current query, for fluid interface
     */
    public function filterByPregunta($pregunta = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($pregunta)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(QuestionTableMap::COL_PREGUNTA, $pregunta, $comparison);
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
     * @return $this|ChildQuestionQuery The current query, for fluid interface
     */
    public function filterByCategoriaActividadId($categoriaActividadId = null, $comparison = null)
    {
        if (is_array($categoriaActividadId)) {
            $useMinMax = false;
            if (isset($categoriaActividadId['min'])) {
                $this->addUsingAlias(QuestionTableMap::COL_CATEGORIA_ACTIVIDAD_ID, $categoriaActividadId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($categoriaActividadId['max'])) {
                $this->addUsingAlias(QuestionTableMap::COL_CATEGORIA_ACTIVIDAD_ID, $categoriaActividadId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(QuestionTableMap::COL_CATEGORIA_ACTIVIDAD_ID, $categoriaActividadId, $comparison);
    }

    /**
     * Filter the query by a related \ActivityCategory object
     *
     * @param \ActivityCategory|ObjectCollection $activityCategory The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildQuestionQuery The current query, for fluid interface
     */
    public function filterByActivityCategory($activityCategory, $comparison = null)
    {
        if ($activityCategory instanceof \ActivityCategory) {
            return $this
                ->addUsingAlias(QuestionTableMap::COL_CATEGORIA_ACTIVIDAD_ID, $activityCategory->getCategoriaActividadId(), $comparison);
        } elseif ($activityCategory instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(QuestionTableMap::COL_CATEGORIA_ACTIVIDAD_ID, $activityCategory->toKeyValue('PrimaryKey', 'CategoriaActividadId'), $comparison);
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
     * @return $this|ChildQuestionQuery The current query, for fluid interface
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
     * Filter the query by a related \Answer object
     *
     * @param \Answer|ObjectCollection $answer the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildQuestionQuery The current query, for fluid interface
     */
    public function filterByAnswer($answer, $comparison = null)
    {
        if ($answer instanceof \Answer) {
            return $this
                ->addUsingAlias(QuestionTableMap::COL_PREGUNTA_ID, $answer->getPreguntaId(), $comparison);
        } elseif ($answer instanceof ObjectCollection) {
            return $this
                ->useAnswerQuery()
                ->filterByPrimaryKeys($answer->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByAnswer() only accepts arguments of type \Answer or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Answer relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildQuestionQuery The current query, for fluid interface
     */
    public function joinAnswer($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Answer');

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
            $this->addJoinObject($join, 'Answer');
        }

        return $this;
    }

    /**
     * Use the Answer relation Answer object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \AnswerQuery A secondary query class using the current class as primary query
     */
    public function useAnswerQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinAnswer($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Answer', '\AnswerQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildQuestion $question Object to remove from the list of results
     *
     * @return $this|ChildQuestionQuery The current query, for fluid interface
     */
    public function prune($question = null)
    {
        if ($question) {
            $this->addUsingAlias(QuestionTableMap::COL_PREGUNTA_ID, $question->getPreguntaId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the preguntas table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(QuestionTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            QuestionTableMap::clearInstancePool();
            QuestionTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(QuestionTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(QuestionTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            QuestionTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            QuestionTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // QuestionQuery
