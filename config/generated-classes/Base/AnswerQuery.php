<?php

namespace Base;

use \Answer as ChildAnswer;
use \AnswerQuery as ChildAnswerQuery;
use \Exception;
use \PDO;
use Map\AnswerTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'respuestas' table.
 *
 *
 *
 * @method     ChildAnswerQuery orderByRespuestaId($order = Criteria::ASC) Order by the respuesta_id column
 * @method     ChildAnswerQuery orderByRespuesta($order = Criteria::ASC) Order by the respuesta column
 * @method     ChildAnswerQuery orderByPreguntaId($order = Criteria::ASC) Order by the pregunta_id column
 *
 * @method     ChildAnswerQuery groupByRespuestaId() Group by the respuesta_id column
 * @method     ChildAnswerQuery groupByRespuesta() Group by the respuesta column
 * @method     ChildAnswerQuery groupByPreguntaId() Group by the pregunta_id column
 *
 * @method     ChildAnswerQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildAnswerQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildAnswerQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildAnswerQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildAnswerQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildAnswerQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildAnswerQuery leftJoinQuestion($relationAlias = null) Adds a LEFT JOIN clause to the query using the Question relation
 * @method     ChildAnswerQuery rightJoinQuestion($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Question relation
 * @method     ChildAnswerQuery innerJoinQuestion($relationAlias = null) Adds a INNER JOIN clause to the query using the Question relation
 *
 * @method     ChildAnswerQuery joinWithQuestion($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Question relation
 *
 * @method     ChildAnswerQuery leftJoinWithQuestion() Adds a LEFT JOIN clause and with to the query using the Question relation
 * @method     ChildAnswerQuery rightJoinWithQuestion() Adds a RIGHT JOIN clause and with to the query using the Question relation
 * @method     ChildAnswerQuery innerJoinWithQuestion() Adds a INNER JOIN clause and with to the query using the Question relation
 *
 * @method     \QuestionQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildAnswer findOne(ConnectionInterface $con = null) Return the first ChildAnswer matching the query
 * @method     ChildAnswer findOneOrCreate(ConnectionInterface $con = null) Return the first ChildAnswer matching the query, or a new ChildAnswer object populated from the query conditions when no match is found
 *
 * @method     ChildAnswer findOneByRespuestaId(int $respuesta_id) Return the first ChildAnswer filtered by the respuesta_id column
 * @method     ChildAnswer findOneByRespuesta(string $respuesta) Return the first ChildAnswer filtered by the respuesta column
 * @method     ChildAnswer findOneByPreguntaId(int $pregunta_id) Return the first ChildAnswer filtered by the pregunta_id column *

 * @method     ChildAnswer requirePk($key, ConnectionInterface $con = null) Return the ChildAnswer by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAnswer requireOne(ConnectionInterface $con = null) Return the first ChildAnswer matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildAnswer requireOneByRespuestaId(int $respuesta_id) Return the first ChildAnswer filtered by the respuesta_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAnswer requireOneByRespuesta(string $respuesta) Return the first ChildAnswer filtered by the respuesta column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAnswer requireOneByPreguntaId(int $pregunta_id) Return the first ChildAnswer filtered by the pregunta_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildAnswer[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildAnswer objects based on current ModelCriteria
 * @method     ChildAnswer[]|ObjectCollection findByRespuestaId(int $respuesta_id) Return ChildAnswer objects filtered by the respuesta_id column
 * @method     ChildAnswer[]|ObjectCollection findByRespuesta(string $respuesta) Return ChildAnswer objects filtered by the respuesta column
 * @method     ChildAnswer[]|ObjectCollection findByPreguntaId(int $pregunta_id) Return ChildAnswer objects filtered by the pregunta_id column
 * @method     ChildAnswer[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class AnswerQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\AnswerQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'myito', $modelName = '\\Answer', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildAnswerQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildAnswerQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildAnswerQuery) {
            return $criteria;
        }
        $query = new ChildAnswerQuery();
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
     * @return ChildAnswer|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(AnswerTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = AnswerTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildAnswer A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT respuesta_id, respuesta, pregunta_id FROM respuestas WHERE respuesta_id = :p0';
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
            /** @var ChildAnswer $obj */
            $obj = new ChildAnswer();
            $obj->hydrate($row);
            AnswerTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildAnswer|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildAnswerQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(AnswerTableMap::COL_RESPUESTA_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildAnswerQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(AnswerTableMap::COL_RESPUESTA_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the respuesta_id column
     *
     * Example usage:
     * <code>
     * $query->filterByRespuestaId(1234); // WHERE respuesta_id = 1234
     * $query->filterByRespuestaId(array(12, 34)); // WHERE respuesta_id IN (12, 34)
     * $query->filterByRespuestaId(array('min' => 12)); // WHERE respuesta_id > 12
     * </code>
     *
     * @param     mixed $respuestaId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAnswerQuery The current query, for fluid interface
     */
    public function filterByRespuestaId($respuestaId = null, $comparison = null)
    {
        if (is_array($respuestaId)) {
            $useMinMax = false;
            if (isset($respuestaId['min'])) {
                $this->addUsingAlias(AnswerTableMap::COL_RESPUESTA_ID, $respuestaId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($respuestaId['max'])) {
                $this->addUsingAlias(AnswerTableMap::COL_RESPUESTA_ID, $respuestaId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AnswerTableMap::COL_RESPUESTA_ID, $respuestaId, $comparison);
    }

    /**
     * Filter the query on the respuesta column
     *
     * Example usage:
     * <code>
     * $query->filterByRespuesta('fooValue');   // WHERE respuesta = 'fooValue'
     * $query->filterByRespuesta('%fooValue%', Criteria::LIKE); // WHERE respuesta LIKE '%fooValue%'
     * </code>
     *
     * @param     string $respuesta The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAnswerQuery The current query, for fluid interface
     */
    public function filterByRespuesta($respuesta = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($respuesta)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AnswerTableMap::COL_RESPUESTA, $respuesta, $comparison);
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
     * @see       filterByQuestion()
     *
     * @param     mixed $preguntaId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAnswerQuery The current query, for fluid interface
     */
    public function filterByPreguntaId($preguntaId = null, $comparison = null)
    {
        if (is_array($preguntaId)) {
            $useMinMax = false;
            if (isset($preguntaId['min'])) {
                $this->addUsingAlias(AnswerTableMap::COL_PREGUNTA_ID, $preguntaId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($preguntaId['max'])) {
                $this->addUsingAlias(AnswerTableMap::COL_PREGUNTA_ID, $preguntaId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AnswerTableMap::COL_PREGUNTA_ID, $preguntaId, $comparison);
    }

    /**
     * Filter the query by a related \Question object
     *
     * @param \Question|ObjectCollection $question The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildAnswerQuery The current query, for fluid interface
     */
    public function filterByQuestion($question, $comparison = null)
    {
        if ($question instanceof \Question) {
            return $this
                ->addUsingAlias(AnswerTableMap::COL_PREGUNTA_ID, $question->getPreguntaId(), $comparison);
        } elseif ($question instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(AnswerTableMap::COL_PREGUNTA_ID, $question->toKeyValue('PrimaryKey', 'PreguntaId'), $comparison);
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
     * @return $this|ChildAnswerQuery The current query, for fluid interface
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
     * @param   ChildAnswer $answer Object to remove from the list of results
     *
     * @return $this|ChildAnswerQuery The current query, for fluid interface
     */
    public function prune($answer = null)
    {
        if ($answer) {
            $this->addUsingAlias(AnswerTableMap::COL_RESPUESTA_ID, $answer->getRespuestaId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the respuestas table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(AnswerTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            AnswerTableMap::clearInstancePool();
            AnswerTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(AnswerTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(AnswerTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            AnswerTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            AnswerTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // AnswerQuery
