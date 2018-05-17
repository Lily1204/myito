<?php

namespace Base;

use \ActivityCategory as ChildActivityCategory;
use \ActivityCategoryQuery as ChildActivityCategoryQuery;
use \Answer as ChildAnswer;
use \AnswerQuery as ChildAnswerQuery;
use \Question as ChildQuestion;
use \QuestionQuery as ChildQuestionQuery;
use \Exception;
use \PDO;
use Map\AnswerTableMap;
use Map\QuestionTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;

/**
 * Base class that represents a row from the 'preguntas' table.
 *
 *
 *
 * @package    propel.generator..Base
 */
abstract class Question implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Map\\QuestionTableMap';


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
     * The value for the pregunta_id field.
     *
     * @var        int
     */
    protected $pregunta_id;

    /**
     * The value for the pregunta field.
     *
     * @var        string
     */
    protected $pregunta;

    /**
     * The value for the categoria_actividad_id field.
     *
     * @var        int
     */
    protected $categoria_actividad_id;

    /**
     * @var        ChildActivityCategory
     */
    protected $aActivityCategory;

    /**
     * @var        ObjectCollection|ChildAnswer[] Collection to store aggregation of ChildAnswer objects.
     */
    protected $collAnswers;
    protected $collAnswersPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildAnswer[]
     */
    protected $answersScheduledForDeletion = null;

    /**
     * Initializes internal state of Base\Question object.
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
     * Compares this with another <code>Question</code> instance.  If
     * <code>obj</code> is an instance of <code>Question</code>, delegates to
     * <code>equals(Question)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|Question The current object, for fluid interface
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
     * Get the [pregunta_id] column value.
     *
     * @return int
     */
    public function getPreguntaId()
    {
        return $this->pregunta_id;
    }

    /**
     * Get the [pregunta] column value.
     *
     * @return string
     */
    public function getPregunta()
    {
        return $this->pregunta;
    }

    /**
     * Get the [categoria_actividad_id] column value.
     *
     * @return int
     */
    public function getCategoriaActividadId()
    {
        return $this->categoria_actividad_id;
    }

    /**
     * Set the value of [pregunta_id] column.
     *
     * @param int $v new value
     * @return $this|\Question The current object (for fluent API support)
     */
    public function setPreguntaId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->pregunta_id !== $v) {
            $this->pregunta_id = $v;
            $this->modifiedColumns[QuestionTableMap::COL_PREGUNTA_ID] = true;
        }

        return $this;
    } // setPreguntaId()

    /**
     * Set the value of [pregunta] column.
     *
     * @param string $v new value
     * @return $this|\Question The current object (for fluent API support)
     */
    public function setPregunta($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->pregunta !== $v) {
            $this->pregunta = $v;
            $this->modifiedColumns[QuestionTableMap::COL_PREGUNTA] = true;
        }

        return $this;
    } // setPregunta()

    /**
     * Set the value of [categoria_actividad_id] column.
     *
     * @param int $v new value
     * @return $this|\Question The current object (for fluent API support)
     */
    public function setCategoriaActividadId($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->categoria_actividad_id !== $v) {
            $this->categoria_actividad_id = $v;
            $this->modifiedColumns[QuestionTableMap::COL_CATEGORIA_ACTIVIDAD_ID] = true;
        }

        if ($this->aActivityCategory !== null && $this->aActivityCategory->getCategoriaActividadId() !== $v) {
            $this->aActivityCategory = null;
        }

        return $this;
    } // setCategoriaActividadId()

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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : QuestionTableMap::translateFieldName('PreguntaId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->pregunta_id = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : QuestionTableMap::translateFieldName('Pregunta', TableMap::TYPE_PHPNAME, $indexType)];
            $this->pregunta = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : QuestionTableMap::translateFieldName('CategoriaActividadId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->categoria_actividad_id = (null !== $col) ? (int) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 3; // 3 = QuestionTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Question'), 0, $e);
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
        if ($this->aActivityCategory !== null && $this->categoria_actividad_id !== $this->aActivityCategory->getCategoriaActividadId()) {
            $this->aActivityCategory = null;
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
            $con = Propel::getServiceContainer()->getReadConnection(QuestionTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildQuestionQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aActivityCategory = null;
            $this->collAnswers = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Question::setDeleted()
     * @see Question::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(QuestionTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildQuestionQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(QuestionTableMap::DATABASE_NAME);
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
                QuestionTableMap::addInstanceToPool($this);
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

            if ($this->aActivityCategory !== null) {
                if ($this->aActivityCategory->isModified() || $this->aActivityCategory->isNew()) {
                    $affectedRows += $this->aActivityCategory->save($con);
                }
                $this->setActivityCategory($this->aActivityCategory);
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

            if ($this->answersScheduledForDeletion !== null) {
                if (!$this->answersScheduledForDeletion->isEmpty()) {
                    \AnswerQuery::create()
                        ->filterByPrimaryKeys($this->answersScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->answersScheduledForDeletion = null;
                }
            }

            if ($this->collAnswers !== null) {
                foreach ($this->collAnswers as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
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

        $this->modifiedColumns[QuestionTableMap::COL_PREGUNTA_ID] = true;
        if (null !== $this->pregunta_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . QuestionTableMap::COL_PREGUNTA_ID . ')');
        }
        if (null === $this->pregunta_id) {
            try {
                $dataFetcher = $con->query("SELECT nextval('preguntas_pregunta_id_seq')");
                $this->pregunta_id = (int) $dataFetcher->fetchColumn();
            } catch (Exception $e) {
                throw new PropelException('Unable to get sequence id.', 0, $e);
            }
        }


         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(QuestionTableMap::COL_PREGUNTA_ID)) {
            $modifiedColumns[':p' . $index++]  = 'pregunta_id';
        }
        if ($this->isColumnModified(QuestionTableMap::COL_PREGUNTA)) {
            $modifiedColumns[':p' . $index++]  = 'pregunta';
        }
        if ($this->isColumnModified(QuestionTableMap::COL_CATEGORIA_ACTIVIDAD_ID)) {
            $modifiedColumns[':p' . $index++]  = 'categoria_actividad_id';
        }

        $sql = sprintf(
            'INSERT INTO preguntas (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'pregunta_id':
                        $stmt->bindValue($identifier, $this->pregunta_id, PDO::PARAM_INT);
                        break;
                    case 'pregunta':
                        $stmt->bindValue($identifier, $this->pregunta, PDO::PARAM_STR);
                        break;
                    case 'categoria_actividad_id':
                        $stmt->bindValue($identifier, $this->categoria_actividad_id, PDO::PARAM_INT);
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
        $pos = QuestionTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getPreguntaId();
                break;
            case 1:
                return $this->getPregunta();
                break;
            case 2:
                return $this->getCategoriaActividadId();
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

        if (isset($alreadyDumpedObjects['Question'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Question'][$this->hashCode()] = true;
        $keys = QuestionTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getPreguntaId(),
            $keys[1] => $this->getPregunta(),
            $keys[2] => $this->getCategoriaActividadId(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aActivityCategory) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'activityCategory';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'categoria_actividad';
                        break;
                    default:
                        $key = 'ActivityCategory';
                }

                $result[$key] = $this->aActivityCategory->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->collAnswers) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'answers';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'respuestass';
                        break;
                    default:
                        $key = 'Answers';
                }

                $result[$key] = $this->collAnswers->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
     * @return $this|\Question
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = QuestionTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\Question
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setPreguntaId($value);
                break;
            case 1:
                $this->setPregunta($value);
                break;
            case 2:
                $this->setCategoriaActividadId($value);
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
        $keys = QuestionTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setPreguntaId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setPregunta($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setCategoriaActividadId($arr[$keys[2]]);
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
     * @return $this|\Question The current object, for fluid interface
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
        $criteria = new Criteria(QuestionTableMap::DATABASE_NAME);

        if ($this->isColumnModified(QuestionTableMap::COL_PREGUNTA_ID)) {
            $criteria->add(QuestionTableMap::COL_PREGUNTA_ID, $this->pregunta_id);
        }
        if ($this->isColumnModified(QuestionTableMap::COL_PREGUNTA)) {
            $criteria->add(QuestionTableMap::COL_PREGUNTA, $this->pregunta);
        }
        if ($this->isColumnModified(QuestionTableMap::COL_CATEGORIA_ACTIVIDAD_ID)) {
            $criteria->add(QuestionTableMap::COL_CATEGORIA_ACTIVIDAD_ID, $this->categoria_actividad_id);
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
        $criteria = ChildQuestionQuery::create();
        $criteria->add(QuestionTableMap::COL_PREGUNTA_ID, $this->pregunta_id);

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
        $validPk = null !== $this->getPreguntaId();

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
        return $this->getPreguntaId();
    }

    /**
     * Generic method to set the primary key (pregunta_id column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setPreguntaId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getPreguntaId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \Question (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setPregunta($this->getPregunta());
        $copyObj->setCategoriaActividadId($this->getCategoriaActividadId());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getAnswers() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addAnswer($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setPreguntaId(NULL); // this is a auto-increment column, so set to default value
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
     * @return \Question Clone of current object.
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
     * Declares an association between this object and a ChildActivityCategory object.
     *
     * @param  ChildActivityCategory $v
     * @return $this|\Question The current object (for fluent API support)
     * @throws PropelException
     */
    public function setActivityCategory(ChildActivityCategory $v = null)
    {
        if ($v === null) {
            $this->setCategoriaActividadId(NULL);
        } else {
            $this->setCategoriaActividadId($v->getCategoriaActividadId());
        }

        $this->aActivityCategory = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildActivityCategory object, it will not be re-added.
        if ($v !== null) {
            $v->addQuestion($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildActivityCategory object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildActivityCategory The associated ChildActivityCategory object.
     * @throws PropelException
     */
    public function getActivityCategory(ConnectionInterface $con = null)
    {
        if ($this->aActivityCategory === null && ($this->categoria_actividad_id != 0)) {
            $this->aActivityCategory = ChildActivityCategoryQuery::create()->findPk($this->categoria_actividad_id, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aActivityCategory->addQuestions($this);
             */
        }

        return $this->aActivityCategory;
    }


    /**
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param      string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('Answer' == $relationName) {
            $this->initAnswers();
            return;
        }
    }

    /**
     * Clears out the collAnswers collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addAnswers()
     */
    public function clearAnswers()
    {
        $this->collAnswers = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collAnswers collection loaded partially.
     */
    public function resetPartialAnswers($v = true)
    {
        $this->collAnswersPartial = $v;
    }

    /**
     * Initializes the collAnswers collection.
     *
     * By default this just sets the collAnswers collection to an empty array (like clearcollAnswers());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initAnswers($overrideExisting = true)
    {
        if (null !== $this->collAnswers && !$overrideExisting) {
            return;
        }

        $collectionClassName = AnswerTableMap::getTableMap()->getCollectionClassName();

        $this->collAnswers = new $collectionClassName;
        $this->collAnswers->setModel('\Answer');
    }

    /**
     * Gets an array of ChildAnswer objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildQuestion is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildAnswer[] List of ChildAnswer objects
     * @throws PropelException
     */
    public function getAnswers(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collAnswersPartial && !$this->isNew();
        if (null === $this->collAnswers || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collAnswers) {
                // return empty collection
                $this->initAnswers();
            } else {
                $collAnswers = ChildAnswerQuery::create(null, $criteria)
                    ->filterByQuestion($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collAnswersPartial && count($collAnswers)) {
                        $this->initAnswers(false);

                        foreach ($collAnswers as $obj) {
                            if (false == $this->collAnswers->contains($obj)) {
                                $this->collAnswers->append($obj);
                            }
                        }

                        $this->collAnswersPartial = true;
                    }

                    return $collAnswers;
                }

                if ($partial && $this->collAnswers) {
                    foreach ($this->collAnswers as $obj) {
                        if ($obj->isNew()) {
                            $collAnswers[] = $obj;
                        }
                    }
                }

                $this->collAnswers = $collAnswers;
                $this->collAnswersPartial = false;
            }
        }

        return $this->collAnswers;
    }

    /**
     * Sets a collection of ChildAnswer objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $answers A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildQuestion The current object (for fluent API support)
     */
    public function setAnswers(Collection $answers, ConnectionInterface $con = null)
    {
        /** @var ChildAnswer[] $answersToDelete */
        $answersToDelete = $this->getAnswers(new Criteria(), $con)->diff($answers);


        $this->answersScheduledForDeletion = $answersToDelete;

        foreach ($answersToDelete as $answerRemoved) {
            $answerRemoved->setQuestion(null);
        }

        $this->collAnswers = null;
        foreach ($answers as $answer) {
            $this->addAnswer($answer);
        }

        $this->collAnswers = $answers;
        $this->collAnswersPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Answer objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Answer objects.
     * @throws PropelException
     */
    public function countAnswers(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collAnswersPartial && !$this->isNew();
        if (null === $this->collAnswers || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collAnswers) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getAnswers());
            }

            $query = ChildAnswerQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByQuestion($this)
                ->count($con);
        }

        return count($this->collAnswers);
    }

    /**
     * Method called to associate a ChildAnswer object to this object
     * through the ChildAnswer foreign key attribute.
     *
     * @param  ChildAnswer $l ChildAnswer
     * @return $this|\Question The current object (for fluent API support)
     */
    public function addAnswer(ChildAnswer $l)
    {
        if ($this->collAnswers === null) {
            $this->initAnswers();
            $this->collAnswersPartial = true;
        }

        if (!$this->collAnswers->contains($l)) {
            $this->doAddAnswer($l);

            if ($this->answersScheduledForDeletion and $this->answersScheduledForDeletion->contains($l)) {
                $this->answersScheduledForDeletion->remove($this->answersScheduledForDeletion->search($l));
            }
        }

        return $this;
    }

    /**
     * @param ChildAnswer $answer The ChildAnswer object to add.
     */
    protected function doAddAnswer(ChildAnswer $answer)
    {
        $this->collAnswers[]= $answer;
        $answer->setQuestion($this);
    }

    /**
     * @param  ChildAnswer $answer The ChildAnswer object to remove.
     * @return $this|ChildQuestion The current object (for fluent API support)
     */
    public function removeAnswer(ChildAnswer $answer)
    {
        if ($this->getAnswers()->contains($answer)) {
            $pos = $this->collAnswers->search($answer);
            $this->collAnswers->remove($pos);
            if (null === $this->answersScheduledForDeletion) {
                $this->answersScheduledForDeletion = clone $this->collAnswers;
                $this->answersScheduledForDeletion->clear();
            }
            $this->answersScheduledForDeletion[]= clone $answer;
            $answer->setQuestion(null);
        }

        return $this;
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aActivityCategory) {
            $this->aActivityCategory->removeQuestion($this);
        }
        $this->pregunta_id = null;
        $this->pregunta = null;
        $this->categoria_actividad_id = null;
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
            if ($this->collAnswers) {
                foreach ($this->collAnswers as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collAnswers = null;
        $this->aActivityCategory = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(QuestionTableMap::DEFAULT_STRING_FORMAT);
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
