<?php

namespace Base;

use \Activity as ChildActivity;
use \ActivityQuery as ChildActivityQuery;
use \ArticleQuery as ChildArticleQuery;
use \User as ChildUser;
use \UserQuery as ChildUserQuery;
use \Exception;
use \PDO;
use Map\ArticleTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;

/**
 * Base class that represents a row from the 'articulos' table.
 *
 *
 *
 * @package    propel.generator..Base
 */
abstract class Article implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Map\\ArticleTableMap';


    /**
     * attribute to determine if this object has previously been saved.
     * @var boolean
     */
    protected $new = true;

    /**
     * attribute to determine whether this object has been deleted.
     * @var boolean
     */
    protected $deleted = false;

    /**
     * The columns that have been modified in current object.
     * Tracking modified columns allows us to only update modified columns.
     * @var array
     */
    protected $modifiedColumns = array();

    /**
     * The (virtual) columns that are added at runtime
     * The formatters can add supplementary columns based on a resultset
     * @var array
     */
    protected $virtualColumns = array();

    /**
     * The value for the id_articulo field.
     *
     * @var        int
     */
    protected $id_articulo;

    /**
     * The value for the titulo field.
     *
     * @var        string
     */
    protected $titulo;

    /**
     * The value for the descripcion field.
     *
     * @var        string
     */
    protected $descripcion;

    /**
     * The value for the links field.
     *
     * @var        string
     */
    protected $links;

    /**
     * The value for the imagen field.
     *
     * @var        string
     */
    protected $imagen;

    /**
     * The value for the calificacion field.
     *
     * @var        int
     */
    protected $calificacion;

    /**
     * The value for the correo field.
     *
     * @var        string
     */
    protected $correo;

    /**
     * The value for the actividad_id field.
     *
     * @var        int
     */
    protected $actividad_id;

    /**
     * @var        ChildUser
     */
    protected $aUser;

    /**
     * @var        ChildActivity
     */
    protected $aActivity;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * Initializes internal state of Base\Article object.
     */
    public function __construct()
    {
    }

    /**
     * Returns whether the object has been modified.
     *
     * @return boolean True if the object has been modified.
     */
    public function isModified()
    {
        return !!$this->modifiedColumns;
    }

    /**
     * Has specified column been modified?
     *
     * @param  string  $col column fully qualified name (TableMap::TYPE_COLNAME), e.g. Book::AUTHOR_ID
     * @return boolean True if $col has been modified.
     */
    public function isColumnModified($col)
    {
        return $this->modifiedColumns && isset($this->modifiedColumns[$col]);
    }

    /**
     * Get the columns that have been modified in this object.
     * @return array A unique list of the modified column names for this object.
     */
    public function getModifiedColumns()
    {
        return $this->modifiedColumns ? array_keys($this->modifiedColumns) : [];
    }

    /**
     * Returns whether the object has ever been saved.  This will
     * be false, if the object was retrieved from storage or was created
     * and then saved.
     *
     * @return boolean true, if the object has never been persisted.
     */
    public function isNew()
    {
        return $this->new;
    }

    /**
     * Setter for the isNew attribute.  This method will be called
     * by Propel-generated children and objects.
     *
     * @param boolean $b the state of the object.
     */
    public function setNew($b)
    {
        $this->new = (boolean) $b;
    }

    /**
     * Whether this object has been deleted.
     * @return boolean The deleted state of this object.
     */
    public function isDeleted()
    {
        return $this->deleted;
    }

    /**
     * Specify whether this object has been deleted.
     * @param  boolean $b The deleted state of this object.
     * @return void
     */
    public function setDeleted($b)
    {
        $this->deleted = (boolean) $b;
    }

    /**
     * Sets the modified state for the object to be false.
     * @param  string $col If supplied, only the specified column is reset.
     * @return void
     */
    public function resetModified($col = null)
    {
        if (null !== $col) {
            if (isset($this->modifiedColumns[$col])) {
                unset($this->modifiedColumns[$col]);
            }
        } else {
            $this->modifiedColumns = array();
        }
    }

    /**
     * Compares this with another <code>Article</code> instance.  If
     * <code>obj</code> is an instance of <code>Article</code>, delegates to
     * <code>equals(Article)</code>.  Otherwise, returns <code>false</code>.
     *
     * @param  mixed   $obj The object to compare to.
     * @return boolean Whether equal to the object specified.
     */
    public function equals($obj)
    {
        if (!$obj instanceof static) {
            return false;
        }

        if ($this === $obj) {
            return true;
        }

        if (null === $this->getPrimaryKey() || null === $obj->getPrimaryKey()) {
            return false;
        }

        return $this->getPrimaryKey() === $obj->getPrimaryKey();
    }

    /**
     * Get the associative array of the virtual columns in this object
     *
     * @return array
     */
    public function getVirtualColumns()
    {
        return $this->virtualColumns;
    }

    /**
     * Checks the existence of a virtual column in this object
     *
     * @param  string  $name The virtual column name
     * @return boolean
     */
    public function hasVirtualColumn($name)
    {
        return array_key_exists($name, $this->virtualColumns);
    }

    /**
     * Get the value of a virtual column in this object
     *
     * @param  string $name The virtual column name
     * @return mixed
     *
     * @throws PropelException
     */
    public function getVirtualColumn($name)
    {
        if (!$this->hasVirtualColumn($name)) {
            throw new PropelException(sprintf('Cannot get value of inexistent virtual column %s.', $name));
        }

        return $this->virtualColumns[$name];
    }

    /**
     * Set the value of a virtual column in this object
     *
     * @param string $name  The virtual column name
     * @param mixed  $value The value to give to the virtual column
     *
     * @return $this|Article The current object, for fluid interface
     */
    public function setVirtualColumn($name, $value)
    {
        $this->virtualColumns[$name] = $value;

        return $this;
    }

    /**
     * Logs a message using Propel::log().
     *
     * @param  string  $msg
     * @param  int     $priority One of the Propel::LOG_* logging levels
     * @return boolean
     */
    protected function log($msg, $priority = Propel::LOG_INFO)
    {
        return Propel::log(get_class($this) . ': ' . $msg, $priority);
    }

    /**
     * Export the current object properties to a string, using a given parser format
     * <code>
     * $book = BookQuery::create()->findPk(9012);
     * echo $book->exportTo('JSON');
     *  => {"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * @param  mixed   $parser                 A AbstractParser instance, or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param  boolean $includeLazyLoadColumns (optional) Whether to include lazy load(ed) columns. Defaults to TRUE.
     * @return string  The exported data
     */
    public function exportTo($parser, $includeLazyLoadColumns = true)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        return $parser->fromArray($this->toArray(TableMap::TYPE_PHPNAME, $includeLazyLoadColumns, array(), true));
    }

    /**
     * Clean up internal collections prior to serializing
     * Avoids recursive loops that turn into segmentation faults when serializing
     */
    public function __sleep()
    {
        $this->clearAllReferences();

        $cls = new \ReflectionClass($this);
        $propertyNames = [];
        $serializableProperties = array_diff($cls->getProperties(), $cls->getProperties(\ReflectionProperty::IS_STATIC));

        foreach($serializableProperties as $property) {
            $propertyNames[] = $property->getName();
        }

        return $propertyNames;
    }

    /**
     * Get the [id_articulo] column value.
     *
     * @return int
     */
    public function getIdArticulo()
    {
        return $this->id_articulo;
    }

    /**
     * Get the [titulo] column value.
     *
     * @return string
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Get the [descripcion] column value.
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Get the [links] column value.
     *
     * @return string
     */
    public function getLinks()
    {
        return $this->links;
    }

    /**
     * Get the [imagen] column value.
     *
     * @return string
     */
    public function getImagen()
    {
        return $this->imagen;
    }

    /**
     * Get the [calificacion] column value.
     *
     * @return int
     */
    public function getCalificacion()
    {
        return $this->calificacion;
    }

    /**
     * Get the [correo] column value.
     *
     * @return string
     */
    public function getCorreo()
    {
        return $this->correo;
    }

    /**
     * Get the [actividad_id] column value.
     *
     * @return int
     */
    public function getActividadId()
    {
        return $this->actividad_id;
    }

    /**
     * Set the value of [id_articulo] column.
     *
     * @param int $v new value
     * @return $this|\Article The current object (for fluent API support)
     */
    public function setIdArticulo($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->id_articulo !== $v) {
            $this->id_articulo = $v;
            $this->modifiedColumns[ArticleTableMap::COL_ID_ARTICULO] = true;
        }

        return $this;
    } // setIdArticulo()

    /**
     * Set the value of [titulo] column.
     *
     * @param string $v new value
     * @return $this|\Article The current object (for fluent API support)
     */
    public function setTitulo($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->titulo !== $v) {
            $this->titulo = $v;
            $this->modifiedColumns[ArticleTableMap::COL_TITULO] = true;
        }

        return $this;
    } // setTitulo()

    /**
     * Set the value of [descripcion] column.
     *
     * @param string $v new value
     * @return $this|\Article The current object (for fluent API support)
     */
    public function setDescripcion($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->descripcion !== $v) {
            $this->descripcion = $v;
            $this->modifiedColumns[ArticleTableMap::COL_DESCRIPCION] = true;
        }

        return $this;
    } // setDescripcion()

    /**
     * Set the value of [links] column.
     *
     * @param string $v new value
     * @return $this|\Article The current object (for fluent API support)
     */
    public function setLinks($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->links !== $v) {
            $this->links = $v;
            $this->modifiedColumns[ArticleTableMap::COL_LINKS] = true;
        }

        return $this;
    } // setLinks()

    /**
     * Set the value of [imagen] column.
     *
     * @param string $v new value
     * @return $this|\Article The current object (for fluent API support)
     */
    public function setImagen($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->imagen !== $v) {
            $this->imagen = $v;
            $this->modifiedColumns[ArticleTableMap::COL_IMAGEN] = true;
        }

        return $this;
    } // setImagen()

    /**
     * Set the value of [calificacion] column.
     *
     * @param int $v new value
     * @return $this|\Article The current object (for fluent API support)
     */
    public function setCalificacion($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->calificacion !== $v) {
            $this->calificacion = $v;
            $this->modifiedColumns[ArticleTableMap::COL_CALIFICACION] = true;
        }

        return $this;
    } // setCalificacion()

    /**
     * Set the value of [correo] column.
     *
     * @param string $v new value
     * @return $this|\Article The current object (for fluent API support)
     */
    public function setCorreo($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->correo !== $v) {
            $this->correo = $v;
            $this->modifiedColumns[ArticleTableMap::COL_CORREO] = true;
        }

        if ($this->aUser !== null && $this->aUser->getCorreo() !== $v) {
            $this->aUser = null;
        }

        return $this;
    } // setCorreo()

    /**
     * Set the value of [actividad_id] column.
     *
     * @param int $v new value
     * @return $this|\Article The current object (for fluent API support)
     */
    public function setActividadId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->actividad_id !== $v) {
            $this->actividad_id = $v;
            $this->modifiedColumns[ArticleTableMap::COL_ACTIVIDAD_ID] = true;
        }

        if ($this->aActivity !== null && $this->aActivity->getActividadId() !== $v) {
            $this->aActivity = null;
        }

        return $this;
    } // setActividadId()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
        // otherwise, everything was equal, so return TRUE
        return true;
    } // hasOnlyDefaultValues()

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array   $row       The row returned by DataFetcher->fetch().
     * @param int     $startcol  0-based offset column which indicates which restultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @param string  $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                  One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                            TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false, $indexType = TableMap::TYPE_NUM)
    {
        try {

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : ArticleTableMap::translateFieldName('IdArticulo', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id_articulo = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : ArticleTableMap::translateFieldName('Titulo', TableMap::TYPE_PHPNAME, $indexType)];
            $this->titulo = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : ArticleTableMap::translateFieldName('Descripcion', TableMap::TYPE_PHPNAME, $indexType)];
            $this->descripcion = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : ArticleTableMap::translateFieldName('Links', TableMap::TYPE_PHPNAME, $indexType)];
            $this->links = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : ArticleTableMap::translateFieldName('Imagen', TableMap::TYPE_PHPNAME, $indexType)];
            $this->imagen = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : ArticleTableMap::translateFieldName('Calificacion', TableMap::TYPE_PHPNAME, $indexType)];
            $this->calificacion = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : ArticleTableMap::translateFieldName('Correo', TableMap::TYPE_PHPNAME, $indexType)];
            $this->correo = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : ArticleTableMap::translateFieldName('ActividadId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->actividad_id = (null !== $col) ? (int) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 8; // 8 = ArticleTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Article'), 0, $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws PropelException
     */
    public function ensureConsistency()
    {
        if ($this->aUser !== null && $this->correo !== $this->aUser->getCorreo()) {
            $this->aUser = null;
        }
        if ($this->aActivity !== null && $this->actividad_id !== $this->aActivity->getActividadId()) {
            $this->aActivity = null;
        }
    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param      boolean $deep (optional) Whether to also de-associated any related objects.
     * @param      ConnectionInterface $con (optional) The ConnectionInterface connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ArticleTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildArticleQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aUser = null;
            $this->aActivity = null;
        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Article::setDeleted()
     * @see Article::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(ArticleTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildArticleQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $this->setDeleted(true);
            }
        });
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see doSave()
     */
    public function save(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($this->alreadyInSave) {
            return 0;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(ArticleTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $ret = $this->preSave($con);
            $isInsert = $this->isNew();
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
            } else {
                $ret = $ret && $this->preUpdate($con);
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                ArticleTableMap::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }

            return $affectedRows;
        });
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see save()
     */
    protected function doSave(ConnectionInterface $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            // We call the save method on the following object(s) if they
            // were passed to this object by their corresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aUser !== null) {
                if ($this->aUser->isModified() || $this->aUser->isNew()) {
                    $affectedRows += $this->aUser->save($con);
                }
                $this->setUser($this->aUser);
            }

            if ($this->aActivity !== null) {
                if ($this->aActivity->isModified() || $this->aActivity->isNew()) {
                    $affectedRows += $this->aActivity->save($con);
                }
                $this->setActivity($this->aActivity);
            }

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                    $affectedRows += 1;
                } else {
                    $affectedRows += $this->doUpdate($con);
                }
                $this->resetModified();
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @throws PropelException
     * @see doSave()
     */
    protected function doInsert(ConnectionInterface $con)
    {
        $modifiedColumns = array();
        $index = 0;

        $this->modifiedColumns[ArticleTableMap::COL_ID_ARTICULO] = true;
        if (null !== $this->id_articulo) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . ArticleTableMap::COL_ID_ARTICULO . ')');
        }
        if (null === $this->id_articulo) {
            try {
                $dataFetcher = $con->query("SELECT nextval('articulos_id_articulo_seq')");
                $this->id_articulo = (int) $dataFetcher->fetchColumn();
            } catch (Exception $e) {
                throw new PropelException('Unable to get sequence id.', 0, $e);
            }
        }


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(ArticleTableMap::COL_ID_ARTICULO)) {
            $modifiedColumns[':p' . $index++]  = 'id_articulo';
        }
        if ($this->isColumnModified(ArticleTableMap::COL_TITULO)) {
            $modifiedColumns[':p' . $index++]  = 'titulo';
        }
        if ($this->isColumnModified(ArticleTableMap::COL_DESCRIPCION)) {
            $modifiedColumns[':p' . $index++]  = 'descripcion';
        }
        if ($this->isColumnModified(ArticleTableMap::COL_LINKS)) {
            $modifiedColumns[':p' . $index++]  = 'links';
        }
        if ($this->isColumnModified(ArticleTableMap::COL_IMAGEN)) {
            $modifiedColumns[':p' . $index++]  = 'imagen';
        }
        if ($this->isColumnModified(ArticleTableMap::COL_CALIFICACION)) {
            $modifiedColumns[':p' . $index++]  = 'calificacion';
        }
        if ($this->isColumnModified(ArticleTableMap::COL_CORREO)) {
            $modifiedColumns[':p' . $index++]  = 'correo';
        }
        if ($this->isColumnModified(ArticleTableMap::COL_ACTIVIDAD_ID)) {
            $modifiedColumns[':p' . $index++]  = 'actividad_id';
        }

        $sql = sprintf(
            'INSERT INTO articulos (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'id_articulo':
                        $stmt->bindValue($identifier, $this->id_articulo, PDO::PARAM_INT);
                        break;
                    case 'titulo':
                        $stmt->bindValue($identifier, $this->titulo, PDO::PARAM_STR);
                        break;
                    case 'descripcion':
                        $stmt->bindValue($identifier, $this->descripcion, PDO::PARAM_STR);
                        break;
                    case 'links':
                        $stmt->bindValue($identifier, $this->links, PDO::PARAM_STR);
                        break;
                    case 'imagen':
                        $stmt->bindValue($identifier, $this->imagen, PDO::PARAM_STR);
                        break;
                    case 'calificacion':
                        $stmt->bindValue($identifier, $this->calificacion, PDO::PARAM_INT);
                        break;
                    case 'correo':
                        $stmt->bindValue($identifier, $this->correo, PDO::PARAM_STR);
                        break;
                    case 'actividad_id':
                        $stmt->bindValue($identifier, $this->actividad_id, PDO::PARAM_INT);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @return Integer Number of updated rows
     * @see doSave()
     */
    protected function doUpdate(ConnectionInterface $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();

        return $selectCriteria->doUpdate($valuesCriteria, $con);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param      string $name name
     * @param      string $type The type of fieldname the $name is of:
     *                     one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                     TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                     Defaults to TableMap::TYPE_PHPNAME.
     * @return mixed Value of field.
     */
    public function getByName($name, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = ArticleTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param      int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getIdArticulo();
                break;
            case 1:
                return $this->getTitulo();
                break;
            case 2:
                return $this->getDescripcion();
                break;
            case 3:
                return $this->getLinks();
                break;
            case 4:
                return $this->getImagen();
                break;
            case 5:
                return $this->getCalificacion();
                break;
            case 6:
                return $this->getCorreo();
                break;
            case 7:
                return $this->getActividadId();
                break;
            default:
                return null;
                break;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param     string  $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     *                    TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                    Defaults to TableMap::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = TableMap::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
    {

        if (isset($alreadyDumpedObjects['Article'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Article'][$this->hashCode()] = true;
        $keys = ArticleTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getIdArticulo(),
            $keys[1] => $this->getTitulo(),
            $keys[2] => $this->getDescripcion(),
            $keys[3] => $this->getLinks(),
            $keys[4] => $this->getImagen(),
            $keys[5] => $this->getCalificacion(),
            $keys[6] => $this->getCorreo(),
            $keys[7] => $this->getActividadId(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aUser) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'user';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'usuarios';
                        break;
                    default:
                        $key = 'User';
                }

                $result[$key] = $this->aUser->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aActivity) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'activity';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'actividades';
                        break;
                    default:
                        $key = 'Activity';
                }

                $result[$key] = $this->aActivity->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param  string $name
     * @param  mixed  $value field value
     * @param  string $type The type of fieldname the $name is of:
     *                one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                Defaults to TableMap::TYPE_PHPNAME.
     * @return $this|\Article
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = ArticleTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\Article
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setIdArticulo($value);
                break;
            case 1:
                $this->setTitulo($value);
                break;
            case 2:
                $this->setDescripcion($value);
                break;
            case 3:
                $this->setLinks($value);
                break;
            case 4:
                $this->setImagen($value);
                break;
            case 5:
                $this->setCalificacion($value);
                break;
            case 6:
                $this->setCorreo($value);
                break;
            case 7:
                $this->setActividadId($value);
                break;
        } // switch()

        return $this;
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param      array  $arr     An array to populate the object from.
     * @param      string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = ArticleTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setIdArticulo($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setTitulo($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setDescripcion($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setLinks($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setImagen($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setCalificacion($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setCorreo($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setActividadId($arr[$keys[7]]);
        }
    }

     /**
     * Populate the current object from a string, using a given parser format
     * <code>
     * $book = new Book();
     * $book->importFrom('JSON', '{"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param mixed $parser A AbstractParser instance,
     *                       or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param string $data The source data to import from
     * @param string $keyType The type of keys the array uses.
     *
     * @return $this|\Article The current object, for fluid interface
     */
    public function importFrom($parser, $data, $keyType = TableMap::TYPE_PHPNAME)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        $this->fromArray($parser->toArray($data), $keyType);

        return $this;
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(ArticleTableMap::DATABASE_NAME);

        if ($this->isColumnModified(ArticleTableMap::COL_ID_ARTICULO)) {
            $criteria->add(ArticleTableMap::COL_ID_ARTICULO, $this->id_articulo);
        }
        if ($this->isColumnModified(ArticleTableMap::COL_TITULO)) {
            $criteria->add(ArticleTableMap::COL_TITULO, $this->titulo);
        }
        if ($this->isColumnModified(ArticleTableMap::COL_DESCRIPCION)) {
            $criteria->add(ArticleTableMap::COL_DESCRIPCION, $this->descripcion);
        }
        if ($this->isColumnModified(ArticleTableMap::COL_LINKS)) {
            $criteria->add(ArticleTableMap::COL_LINKS, $this->links);
        }
        if ($this->isColumnModified(ArticleTableMap::COL_IMAGEN)) {
            $criteria->add(ArticleTableMap::COL_IMAGEN, $this->imagen);
        }
        if ($this->isColumnModified(ArticleTableMap::COL_CALIFICACION)) {
            $criteria->add(ArticleTableMap::COL_CALIFICACION, $this->calificacion);
        }
        if ($this->isColumnModified(ArticleTableMap::COL_CORREO)) {
            $criteria->add(ArticleTableMap::COL_CORREO, $this->correo);
        }
        if ($this->isColumnModified(ArticleTableMap::COL_ACTIVIDAD_ID)) {
            $criteria->add(ArticleTableMap::COL_ACTIVIDAD_ID, $this->actividad_id);
        }

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @throws LogicException if no primary key is defined
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = ChildArticleQuery::create();
        $criteria->add(ArticleTableMap::COL_ID_ARTICULO, $this->id_articulo);

        return $criteria;
    }

    /**
     * If the primary key is not null, return the hashcode of the
     * primary key. Otherwise, return the hash code of the object.
     *
     * @return int Hashcode
     */
    public function hashCode()
    {
        $validPk = null !== $this->getIdArticulo();

        $validPrimaryKeyFKs = 0;
        $primaryKeyFKs = [];

        if ($validPk) {
            return crc32(json_encode($this->getPrimaryKey(), JSON_UNESCAPED_UNICODE));
        } elseif ($validPrimaryKeyFKs) {
            return crc32(json_encode($primaryKeyFKs, JSON_UNESCAPED_UNICODE));
        }

        return spl_object_hash($this);
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getIdArticulo();
    }

    /**
     * Generic method to set the primary key (id_articulo column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setIdArticulo($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getIdArticulo();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \Article (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setTitulo($this->getTitulo());
        $copyObj->setDescripcion($this->getDescripcion());
        $copyObj->setLinks($this->getLinks());
        $copyObj->setImagen($this->getImagen());
        $copyObj->setCalificacion($this->getCalificacion());
        $copyObj->setCorreo($this->getCorreo());
        $copyObj->setActividadId($this->getActividadId());
        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setIdArticulo(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param  boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return \Article Clone of current object.
     * @throws PropelException
     */
    public function copy($deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }

    /**
     * Declares an association between this object and a ChildUser object.
     *
     * @param  ChildUser $v
     * @return $this|\Article The current object (for fluent API support)
     * @throws PropelException
     */
    public function setUser(ChildUser $v = null)
    {
        if ($v === null) {
            $this->setCorreo(NULL);
        } else {
            $this->setCorreo($v->getCorreo());
        }

        $this->aUser = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildUser object, it will not be re-added.
        if ($v !== null) {
            $v->addArticle($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildUser object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildUser The associated ChildUser object.
     * @throws PropelException
     */
    public function getUser(ConnectionInterface $con = null)
    {
        if ($this->aUser === null && (($this->correo !== "" && $this->correo !== null))) {
            $this->aUser = ChildUserQuery::create()->findPk($this->correo, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aUser->addArticles($this);
             */
        }

        return $this->aUser;
    }

    /**
     * Declares an association between this object and a ChildActivity object.
     *
     * @param  ChildActivity $v
     * @return $this|\Article The current object (for fluent API support)
     * @throws PropelException
     */
    public function setActivity(ChildActivity $v = null)
    {
        if ($v === null) {
            $this->setActividadId(NULL);
        } else {
            $this->setActividadId($v->getActividadId());
        }

        $this->aActivity = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildActivity object, it will not be re-added.
        if ($v !== null) {
            $v->addArticle($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildActivity object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildActivity The associated ChildActivity object.
     * @throws PropelException
     */
    public function getActivity(ConnectionInterface $con = null)
    {
        if ($this->aActivity === null && ($this->actividad_id != 0)) {
            $this->aActivity = ChildActivityQuery::create()->findPk($this->actividad_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aActivity->addArticles($this);
             */
        }

        return $this->aActivity;
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aUser) {
            $this->aUser->removeArticle($this);
        }
        if (null !== $this->aActivity) {
            $this->aActivity->removeArticle($this);
        }
        $this->id_articulo = null;
        $this->titulo = null;
        $this->descripcion = null;
        $this->links = null;
        $this->imagen = null;
        $this->calificacion = null;
        $this->correo = null;
        $this->actividad_id = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references and back-references to other model objects or collections of model objects.
     *
     * This method is used to reset all php object references (not the actual reference in the database).
     * Necessary for object serialisation.
     *
     * @param      boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep) {
        } // if ($deep)

        $this->aUser = null;
        $this->aActivity = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(ArticleTableMap::DEFAULT_STRING_FORMAT);
    }

    /**
     * Code to be run before persisting the object
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preSave(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preSave')) {
            return parent::preSave($con);
        }
        return true;
    }

    /**
     * Code to be run after persisting the object
     * @param ConnectionInterface $con
     */
    public function postSave(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postSave')) {
            parent::postSave($con);
        }
    }

    /**
     * Code to be run before inserting to database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preInsert(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preInsert')) {
            return parent::preInsert($con);
        }
        return true;
    }

    /**
     * Code to be run after inserting to database
     * @param ConnectionInterface $con
     */
    public function postInsert(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postInsert')) {
            parent::postInsert($con);
        }
    }

    /**
     * Code to be run before updating the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preUpdate(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preUpdate')) {
            return parent::preUpdate($con);
        }
        return true;
    }

    /**
     * Code to be run after updating the object in database
     * @param ConnectionInterface $con
     */
    public function postUpdate(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postUpdate')) {
            parent::postUpdate($con);
        }
    }

    /**
     * Code to be run before deleting the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preDelete(ConnectionInterface $con = null)
    {
        if (is_callable('parent::preDelete')) {
            return parent::preDelete($con);
        }
        return true;
    }

    /**
     * Code to be run after deleting the object in database
     * @param ConnectionInterface $con
     */
    public function postDelete(ConnectionInterface $con = null)
    {
        if (is_callable('parent::postDelete')) {
            parent::postDelete($con);
        }
    }


    /**
     * Derived method to catches calls to undefined methods.
     *
     * Provides magic import/export method support (fromXML()/toXML(), fromYAML()/toYAML(), etc.).
     * Allows to define default __call() behavior if you overwrite __call()
     *
     * @param string $name
     * @param mixed  $params
     *
     * @return array|string
     */
    public function __call($name, $params)
    {
        if (0 === strpos($name, 'get')) {
            $virtualColumn = substr($name, 3);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }

            $virtualColumn = lcfirst($virtualColumn);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }
        }

        if (0 === strpos($name, 'from')) {
            $format = substr($name, 4);

            return $this->importFrom($format, reset($params));
        }

        if (0 === strpos($name, 'to')) {
            $format = substr($name, 2);
            $includeLazyLoadColumns = isset($params[0]) ? $params[0] : true;

            return $this->exportTo($format, $includeLazyLoadColumns);
        }

        throw new BadMethodCallException(sprintf('Call to undefined method: %s.', $name));
    }

}
