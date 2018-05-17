<?php

namespace Base;

use \Article as ChildArticle;
use \ArticleQuery as ChildArticleQuery;
use \Exception;
use \PDO;
use Map\ArticleTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'articulos' table.
 *
 *
 *
 * @method     ChildArticleQuery orderByIdArticulo($order = Criteria::ASC) Order by the id_articulo column
 * @method     ChildArticleQuery orderByTitulo($order = Criteria::ASC) Order by the titulo column
 * @method     ChildArticleQuery orderByDescripcion($order = Criteria::ASC) Order by the descripcion column
 * @method     ChildArticleQuery orderByLinks($order = Criteria::ASC) Order by the links column
 * @method     ChildArticleQuery orderByImagen($order = Criteria::ASC) Order by the imagen column
 * @method     ChildArticleQuery orderByCalificacion($order = Criteria::ASC) Order by the calificacion column
 * @method     ChildArticleQuery orderByCorreo($order = Criteria::ASC) Order by the correo column
 * @method     ChildArticleQuery orderByActividadId($order = Criteria::ASC) Order by the actividad_id column
 *
 * @method     ChildArticleQuery groupByIdArticulo() Group by the id_articulo column
 * @method     ChildArticleQuery groupByTitulo() Group by the titulo column
 * @method     ChildArticleQuery groupByDescripcion() Group by the descripcion column
 * @method     ChildArticleQuery groupByLinks() Group by the links column
 * @method     ChildArticleQuery groupByImagen() Group by the imagen column
 * @method     ChildArticleQuery groupByCalificacion() Group by the calificacion column
 * @method     ChildArticleQuery groupByCorreo() Group by the correo column
 * @method     ChildArticleQuery groupByActividadId() Group by the actividad_id column
 *
 * @method     ChildArticleQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildArticleQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildArticleQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildArticleQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildArticleQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildArticleQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildArticleQuery leftJoinUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the User relation
 * @method     ChildArticleQuery rightJoinUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the User relation
 * @method     ChildArticleQuery innerJoinUser($relationAlias = null) Adds a INNER JOIN clause to the query using the User relation
 *
 * @method     ChildArticleQuery joinWithUser($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the User relation
 *
 * @method     ChildArticleQuery leftJoinWithUser() Adds a LEFT JOIN clause and with to the query using the User relation
 * @method     ChildArticleQuery rightJoinWithUser() Adds a RIGHT JOIN clause and with to the query using the User relation
 * @method     ChildArticleQuery innerJoinWithUser() Adds a INNER JOIN clause and with to the query using the User relation
 *
 * @method     ChildArticleQuery leftJoinActivity($relationAlias = null) Adds a LEFT JOIN clause to the query using the Activity relation
 * @method     ChildArticleQuery rightJoinActivity($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Activity relation
 * @method     ChildArticleQuery innerJoinActivity($relationAlias = null) Adds a INNER JOIN clause to the query using the Activity relation
 *
 * @method     ChildArticleQuery joinWithActivity($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Activity relation
 *
 * @method     ChildArticleQuery leftJoinWithActivity() Adds a LEFT JOIN clause and with to the query using the Activity relation
 * @method     ChildArticleQuery rightJoinWithActivity() Adds a RIGHT JOIN clause and with to the query using the Activity relation
 * @method     ChildArticleQuery innerJoinWithActivity() Adds a INNER JOIN clause and with to the query using the Activity relation
 *
 * @method     \UserQuery|\ActivityQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildArticle findOne(ConnectionInterface $con = null) Return the first ChildArticle matching the query
 * @method     ChildArticle findOneOrCreate(ConnectionInterface $con = null) Return the first ChildArticle matching the query, or a new ChildArticle object populated from the query conditions when no match is found
 *
 * @method     ChildArticle findOneByIdArticulo(int $id_articulo) Return the first ChildArticle filtered by the id_articulo column
 * @method     ChildArticle findOneByTitulo(string $titulo) Return the first ChildArticle filtered by the titulo column
 * @method     ChildArticle findOneByDescripcion(string $descripcion) Return the first ChildArticle filtered by the descripcion column
 * @method     ChildArticle findOneByLinks(string $links) Return the first ChildArticle filtered by the links column
 * @method     ChildArticle findOneByImagen(string $imagen) Return the first ChildArticle filtered by the imagen column
 * @method     ChildArticle findOneByCalificacion(int $calificacion) Return the first ChildArticle filtered by the calificacion column
 * @method     ChildArticle findOneByCorreo(string $correo) Return the first ChildArticle filtered by the correo column
 * @method     ChildArticle findOneByActividadId(int $actividad_id) Return the first ChildArticle filtered by the actividad_id column *

 * @method     ChildArticle requirePk($key, ConnectionInterface $con = null) Return the ChildArticle by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildArticle requireOne(ConnectionInterface $con = null) Return the first ChildArticle matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildArticle requireOneByIdArticulo(int $id_articulo) Return the first ChildArticle filtered by the id_articulo column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildArticle requireOneByTitulo(string $titulo) Return the first ChildArticle filtered by the titulo column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildArticle requireOneByDescripcion(string $descripcion) Return the first ChildArticle filtered by the descripcion column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildArticle requireOneByLinks(string $links) Return the first ChildArticle filtered by the links column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildArticle requireOneByImagen(string $imagen) Return the first ChildArticle filtered by the imagen column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildArticle requireOneByCalificacion(int $calificacion) Return the first ChildArticle filtered by the calificacion column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildArticle requireOneByCorreo(string $correo) Return the first ChildArticle filtered by the correo column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildArticle requireOneByActividadId(int $actividad_id) Return the first ChildArticle filtered by the actividad_id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildArticle[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildArticle objects based on current ModelCriteria
 * @method     ChildArticle[]|ObjectCollection findByIdArticulo(int $id_articulo) Return ChildArticle objects filtered by the id_articulo column
 * @method     ChildArticle[]|ObjectCollection findByTitulo(string $titulo) Return ChildArticle objects filtered by the titulo column
 * @method     ChildArticle[]|ObjectCollection findByDescripcion(string $descripcion) Return ChildArticle objects filtered by the descripcion column
 * @method     ChildArticle[]|ObjectCollection findByLinks(string $links) Return ChildArticle objects filtered by the links column
 * @method     ChildArticle[]|ObjectCollection findByImagen(string $imagen) Return ChildArticle objects filtered by the imagen column
 * @method     ChildArticle[]|ObjectCollection findByCalificacion(int $calificacion) Return ChildArticle objects filtered by the calificacion column
 * @method     ChildArticle[]|ObjectCollection findByCorreo(string $correo) Return ChildArticle objects filtered by the correo column
 * @method     ChildArticle[]|ObjectCollection findByActividadId(int $actividad_id) Return ChildArticle objects filtered by the actividad_id column
 * @method     ChildArticle[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ArticleQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\ArticleQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'myito', $modelName = '\\Article', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildArticleQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildArticleQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildArticleQuery) {
            return $criteria;
        }
        $query = new ChildArticleQuery();
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
     * @return ChildArticle|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ArticleTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ArticleTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildArticle A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id_articulo, titulo, descripcion, links, imagen, calificacion, correo, actividad_id FROM articulos WHERE id_articulo = :p0';
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
            /** @var ChildArticle $obj */
            $obj = new ChildArticle();
            $obj->hydrate($row);
            ArticleTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildArticle|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildArticleQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ArticleTableMap::COL_ID_ARTICULO, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildArticleQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ArticleTableMap::COL_ID_ARTICULO, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id_articulo column
     *
     * Example usage:
     * <code>
     * $query->filterByIdArticulo(1234); // WHERE id_articulo = 1234
     * $query->filterByIdArticulo(array(12, 34)); // WHERE id_articulo IN (12, 34)
     * $query->filterByIdArticulo(array('min' => 12)); // WHERE id_articulo > 12
     * </code>
     *
     * @param     mixed $idArticulo The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildArticleQuery The current query, for fluid interface
     */
    public function filterByIdArticulo($idArticulo = null, $comparison = null)
    {
        if (is_array($idArticulo)) {
            $useMinMax = false;
            if (isset($idArticulo['min'])) {
                $this->addUsingAlias(ArticleTableMap::COL_ID_ARTICULO, $idArticulo['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($idArticulo['max'])) {
                $this->addUsingAlias(ArticleTableMap::COL_ID_ARTICULO, $idArticulo['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ArticleTableMap::COL_ID_ARTICULO, $idArticulo, $comparison);
    }

    /**
     * Filter the query on the titulo column
     *
     * Example usage:
     * <code>
     * $query->filterByTitulo('fooValue');   // WHERE titulo = 'fooValue'
     * $query->filterByTitulo('%fooValue%', Criteria::LIKE); // WHERE titulo LIKE '%fooValue%'
     * </code>
     *
     * @param     string $titulo The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildArticleQuery The current query, for fluid interface
     */
    public function filterByTitulo($titulo = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($titulo)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ArticleTableMap::COL_TITULO, $titulo, $comparison);
    }

    /**
     * Filter the query on the descripcion column
     *
     * Example usage:
     * <code>
     * $query->filterByDescripcion('fooValue');   // WHERE descripcion = 'fooValue'
     * $query->filterByDescripcion('%fooValue%', Criteria::LIKE); // WHERE descripcion LIKE '%fooValue%'
     * </code>
     *
     * @param     string $descripcion The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildArticleQuery The current query, for fluid interface
     */
    public function filterByDescripcion($descripcion = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($descripcion)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ArticleTableMap::COL_DESCRIPCION, $descripcion, $comparison);
    }

    /**
     * Filter the query on the links column
     *
     * Example usage:
     * <code>
     * $query->filterByLinks('fooValue');   // WHERE links = 'fooValue'
     * $query->filterByLinks('%fooValue%', Criteria::LIKE); // WHERE links LIKE '%fooValue%'
     * </code>
     *
     * @param     string $links The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildArticleQuery The current query, for fluid interface
     */
    public function filterByLinks($links = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($links)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ArticleTableMap::COL_LINKS, $links, $comparison);
    }

    /**
     * Filter the query on the imagen column
     *
     * Example usage:
     * <code>
     * $query->filterByImagen('fooValue');   // WHERE imagen = 'fooValue'
     * $query->filterByImagen('%fooValue%', Criteria::LIKE); // WHERE imagen LIKE '%fooValue%'
     * </code>
     *
     * @param     string $imagen The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildArticleQuery The current query, for fluid interface
     */
    public function filterByImagen($imagen = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($imagen)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ArticleTableMap::COL_IMAGEN, $imagen, $comparison);
    }

    /**
     * Filter the query on the calificacion column
     *
     * Example usage:
     * <code>
     * $query->filterByCalificacion(1234); // WHERE calificacion = 1234
     * $query->filterByCalificacion(array(12, 34)); // WHERE calificacion IN (12, 34)
     * $query->filterByCalificacion(array('min' => 12)); // WHERE calificacion > 12
     * </code>
     *
     * @param     mixed $calificacion The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildArticleQuery The current query, for fluid interface
     */
    public function filterByCalificacion($calificacion = null, $comparison = null)
    {
        if (is_array($calificacion)) {
            $useMinMax = false;
            if (isset($calificacion['min'])) {
                $this->addUsingAlias(ArticleTableMap::COL_CALIFICACION, $calificacion['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($calificacion['max'])) {
                $this->addUsingAlias(ArticleTableMap::COL_CALIFICACION, $calificacion['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ArticleTableMap::COL_CALIFICACION, $calificacion, $comparison);
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
     * @return $this|ChildArticleQuery The current query, for fluid interface
     */
    public function filterByCorreo($correo = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($correo)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ArticleTableMap::COL_CORREO, $correo, $comparison);
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
     * @see       filterByActivity()
     *
     * @param     mixed $actividadId The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildArticleQuery The current query, for fluid interface
     */
    public function filterByActividadId($actividadId = null, $comparison = null)
    {
        if (is_array($actividadId)) {
            $useMinMax = false;
            if (isset($actividadId['min'])) {
                $this->addUsingAlias(ArticleTableMap::COL_ACTIVIDAD_ID, $actividadId['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($actividadId['max'])) {
                $this->addUsingAlias(ArticleTableMap::COL_ACTIVIDAD_ID, $actividadId['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ArticleTableMap::COL_ACTIVIDAD_ID, $actividadId, $comparison);
    }

    /**
     * Filter the query by a related \User object
     *
     * @param \User|ObjectCollection $user The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildArticleQuery The current query, for fluid interface
     */
    public function filterByUser($user, $comparison = null)
    {
        if ($user instanceof \User) {
            return $this
                ->addUsingAlias(ArticleTableMap::COL_CORREO, $user->getCorreo(), $comparison);
        } elseif ($user instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ArticleTableMap::COL_CORREO, $user->toKeyValue('PrimaryKey', 'Correo'), $comparison);
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
     * @return $this|ChildArticleQuery The current query, for fluid interface
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
     * Filter the query by a related \Activity object
     *
     * @param \Activity|ObjectCollection $activity The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildArticleQuery The current query, for fluid interface
     */
    public function filterByActivity($activity, $comparison = null)
    {
        if ($activity instanceof \Activity) {
            return $this
                ->addUsingAlias(ArticleTableMap::COL_ACTIVIDAD_ID, $activity->getActividadId(), $comparison);
        } elseif ($activity instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ArticleTableMap::COL_ACTIVIDAD_ID, $activity->toKeyValue('PrimaryKey', 'ActividadId'), $comparison);
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
     * @return $this|ChildArticleQuery The current query, for fluid interface
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
     * Exclude object from result
     *
     * @param   ChildArticle $article Object to remove from the list of results
     *
     * @return $this|ChildArticleQuery The current query, for fluid interface
     */
    public function prune($article = null)
    {
        if ($article) {
            $this->addUsingAlias(ArticleTableMap::COL_ID_ARTICULO, $article->getIdArticulo(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the articulos table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ArticleTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ArticleTableMap::clearInstancePool();
            ArticleTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ArticleTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ArticleTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ArticleTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ArticleTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ArticleQuery
