<?php

namespace Map;

use \UserActivityCategory;
use \UserActivityCategoryQuery;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;


/**
 * This class defines the structure of the 'usuario_categoria_actividad' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class UserActivityCategoryTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.UserActivityCategoryTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'myito';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'usuario_categoria_actividad';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\UserActivityCategory';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'UserActivityCategory';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 3;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 3;

    /**
     * the column name for the correo field
     */
    const COL_CORREO = 'usuario_categoria_actividad.correo';

    /**
     * the column name for the categoria_actividad_id field
     */
    const COL_CATEGORIA_ACTIVIDAD_ID = 'usuario_categoria_actividad.categoria_actividad_id';

    /**
     * the column name for the estatus field
     */
    const COL_ESTATUS = 'usuario_categoria_actividad.estatus';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('Correo', 'CategoriaActividadId', 'Estatus', ),
        self::TYPE_CAMELNAME     => array('correo', 'categoriaActividadId', 'estatus', ),
        self::TYPE_COLNAME       => array(UserActivityCategoryTableMap::COL_CORREO, UserActivityCategoryTableMap::COL_CATEGORIA_ACTIVIDAD_ID, UserActivityCategoryTableMap::COL_ESTATUS, ),
        self::TYPE_FIELDNAME     => array('correo', 'categoria_actividad_id', 'estatus', ),
        self::TYPE_NUM           => array(0, 1, 2, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Correo' => 0, 'CategoriaActividadId' => 1, 'Estatus' => 2, ),
        self::TYPE_CAMELNAME     => array('correo' => 0, 'categoriaActividadId' => 1, 'estatus' => 2, ),
        self::TYPE_COLNAME       => array(UserActivityCategoryTableMap::COL_CORREO => 0, UserActivityCategoryTableMap::COL_CATEGORIA_ACTIVIDAD_ID => 1, UserActivityCategoryTableMap::COL_ESTATUS => 2, ),
        self::TYPE_FIELDNAME     => array('correo' => 0, 'categoria_actividad_id' => 1, 'estatus' => 2, ),
        self::TYPE_NUM           => array(0, 1, 2, )
    );

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('usuario_categoria_actividad');
        $this->setPhpName('UserActivityCategory');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\UserActivityCategory');
        $this->setPackage('');
        $this->setUseIdGenerator(false);
        // columns
        $this->addForeignPrimaryKey('correo', 'Correo', 'VARCHAR' , 'usuarios', 'correo', true, null, null);
        $this->addForeignPrimaryKey('categoria_actividad_id', 'CategoriaActividadId', 'SMALLINT' , 'categoria_actividad', 'categoria_actividad_id', true, null, null);
        $this->addColumn('estatus', 'Estatus', 'BOOLEAN', true, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('User', '\\User', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':correo',
    1 => ':correo',
  ),
), 'CASCADE', 'CASCADE', null, false);
        $this->addRelation('ActivityCategory', '\\ActivityCategory', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':categoria_actividad_id',
    1 => ':categoria_actividad_id',
  ),
), 'CASCADE', 'CASCADE', null, false);
    } // buildRelations()

    /**
     * Adds an object to the instance pool.
     *
     * Propel keeps cached copies of objects in an instance pool when they are retrieved
     * from the database. In some cases you may need to explicitly add objects
     * to the cache in order to ensure that the same objects are always returned by find*()
     * and findPk*() calls.
     *
     * @param \UserActivityCategory $obj A \UserActivityCategory object.
     * @param string $key             (optional) key to use for instance map (for performance boost if key was already calculated externally).
     */
    public static function addInstanceToPool($obj, $key = null)
    {
        if (Propel::isInstancePoolingEnabled()) {
            if (null === $key) {
                $key = serialize([(null === $obj->getCorreo() || is_scalar($obj->getCorreo()) || is_callable([$obj->getCorreo(), '__toString']) ? (string) $obj->getCorreo() : $obj->getCorreo()), (null === $obj->getCategoriaActividadId() || is_scalar($obj->getCategoriaActividadId()) || is_callable([$obj->getCategoriaActividadId(), '__toString']) ? (string) $obj->getCategoriaActividadId() : $obj->getCategoriaActividadId())]);
            } // if key === null
            self::$instances[$key] = $obj;
        }
    }

    /**
     * Removes an object from the instance pool.
     *
     * Propel keeps cached copies of objects in an instance pool when they are retrieved
     * from the database.  In some cases -- especially when you override doDelete
     * methods in your stub classes -- you may need to explicitly remove objects
     * from the cache in order to prevent returning objects that no longer exist.
     *
     * @param mixed $value A \UserActivityCategory object or a primary key value.
     */
    public static function removeInstanceFromPool($value)
    {
        if (Propel::isInstancePoolingEnabled() && null !== $value) {
            if (is_object($value) && $value instanceof \UserActivityCategory) {
                $key = serialize([(null === $value->getCorreo() || is_scalar($value->getCorreo()) || is_callable([$value->getCorreo(), '__toString']) ? (string) $value->getCorreo() : $value->getCorreo()), (null === $value->getCategoriaActividadId() || is_scalar($value->getCategoriaActividadId()) || is_callable([$value->getCategoriaActividadId(), '__toString']) ? (string) $value->getCategoriaActividadId() : $value->getCategoriaActividadId())]);

            } elseif (is_array($value) && count($value) === 2) {
                // assume we've been passed a primary key";
                $key = serialize([(null === $value[0] || is_scalar($value[0]) || is_callable([$value[0], '__toString']) ? (string) $value[0] : $value[0]), (null === $value[1] || is_scalar($value[1]) || is_callable([$value[1], '__toString']) ? (string) $value[1] : $value[1])]);
            } elseif ($value instanceof Criteria) {
                self::$instances = [];

                return;
            } else {
                $e = new PropelException("Invalid value passed to removeInstanceFromPool().  Expected primary key or \UserActivityCategory object; got " . (is_object($value) ? get_class($value) . ' object.' : var_export($value, true)));
                throw $e;
            }

            unset(self::$instances[$key]);
        }
    }

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Correo', TableMap::TYPE_PHPNAME, $indexType)] === null && $row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('CategoriaActividadId', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return serialize([(null === $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Correo', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Correo', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Correo', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Correo', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Correo', TableMap::TYPE_PHPNAME, $indexType)]), (null === $row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('CategoriaActividadId', TableMap::TYPE_PHPNAME, $indexType)] || is_scalar($row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('CategoriaActividadId', TableMap::TYPE_PHPNAME, $indexType)]) || is_callable([$row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('CategoriaActividadId', TableMap::TYPE_PHPNAME, $indexType)], '__toString']) ? (string) $row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('CategoriaActividadId', TableMap::TYPE_PHPNAME, $indexType)] : $row[TableMap::TYPE_NUM == $indexType ? 1 + $offset : static::translateFieldName('CategoriaActividadId', TableMap::TYPE_PHPNAME, $indexType)])]);
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
            $pks = [];

        $pks[] = (string) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('Correo', TableMap::TYPE_PHPNAME, $indexType)
        ];
        $pks[] = (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 1 + $offset
                : self::translateFieldName('CategoriaActividadId', TableMap::TYPE_PHPNAME, $indexType)
        ];

        return $pks;
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param boolean $withPrefix Whether or not to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass($withPrefix = true)
    {
        return $withPrefix ? UserActivityCategoryTableMap::CLASS_DEFAULT : UserActivityCategoryTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array  $row       row returned by DataFetcher->fetch().
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array           (UserActivityCategory object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = UserActivityCategoryTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = UserActivityCategoryTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + UserActivityCategoryTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = UserActivityCategoryTableMap::OM_CLASS;
            /** @var UserActivityCategory $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            UserActivityCategoryTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = UserActivityCategoryTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = UserActivityCategoryTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var UserActivityCategory $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                UserActivityCategoryTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria object containing the columns to add.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(UserActivityCategoryTableMap::COL_CORREO);
            $criteria->addSelectColumn(UserActivityCategoryTableMap::COL_CATEGORIA_ACTIVIDAD_ID);
            $criteria->addSelectColumn(UserActivityCategoryTableMap::COL_ESTATUS);
        } else {
            $criteria->addSelectColumn($alias . '.correo');
            $criteria->addSelectColumn($alias . '.categoria_actividad_id');
            $criteria->addSelectColumn($alias . '.estatus');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getServiceContainer()->getDatabaseMap(UserActivityCategoryTableMap::DATABASE_NAME)->getTable(UserActivityCategoryTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(UserActivityCategoryTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(UserActivityCategoryTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new UserActivityCategoryTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a UserActivityCategory or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or UserActivityCategory object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param  ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UserActivityCategoryTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \UserActivityCategory) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(UserActivityCategoryTableMap::DATABASE_NAME);
            // primary key is composite; we therefore, expect
            // the primary key passed to be an array of pkey values
            if (count($values) == count($values, COUNT_RECURSIVE)) {
                // array is not multi-dimensional
                $values = array($values);
            }
            foreach ($values as $value) {
                $criterion = $criteria->getNewCriterion(UserActivityCategoryTableMap::COL_CORREO, $value[0]);
                $criterion->addAnd($criteria->getNewCriterion(UserActivityCategoryTableMap::COL_CATEGORIA_ACTIVIDAD_ID, $value[1]));
                $criteria->addOr($criterion);
            }
        }

        $query = UserActivityCategoryQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            UserActivityCategoryTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                UserActivityCategoryTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the usuario_categoria_actividad table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return UserActivityCategoryQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a UserActivityCategory or Criteria object.
     *
     * @param mixed               $criteria Criteria or UserActivityCategory object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UserActivityCategoryTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from UserActivityCategory object
        }


        // Set the correct dbName
        $query = UserActivityCategoryQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // UserActivityCategoryTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
UserActivityCategoryTableMap::buildTableMap();
