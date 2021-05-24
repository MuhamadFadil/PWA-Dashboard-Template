<?php
namespace GroceryCrud\Core;

use GroceryCrud\Core\Exceptions\Exception;
use GroceryCrud\Core\Model\iModel;
use GroceryCrud\Core\Model\ModelFieldType;
use GroceryCrud\Core\Render\RenderAbstract;
use GroceryCrud\Core\State\StateFactory;
use GroceryCrud\Core\GroceryCrud\GroceryCrudInterface;
use GroceryCrud\Core\Validate\ValidateInterface;

/**
 * PHP Grocery CRUD
 *
 * This is the Core library of grocery CRUD. Everything is rendered from
 * this file. Grocery CRUD is a PHP library that creates a full
 * functional CRUD system without the requirement of extra customisation
 * to the JavaScripts or the CSS to do it so.
 *
 *
 * @category   GroceryCRUD
 * @package    GroceryCRUD
 * @author     John Skoumbourdis <scoumbourdisj@gmail.com>
 * @copyright  Copyright (c) 2010 through 2019, John Skoumbourdis
 * @license    LICENSE.md
 * @version    2.7
 * @link       http://www.grocerycrud.com/enterprise
 */

class GroceryCrud implements GroceryCrudInterface
{
    const FIELD_TYPE_READ_ONLY = 'readonly';
    const FIELD_TYPE_REAL_BOOLEAN = 'boolean';
    const FIELD_TYPE_BOOLEAN_CHECKBOX = 'checkbox_boolean';
    const FIELD_TYPE_DROPDOWN = 'dropdown';
    const FIELD_TYPE_DROPDOWN_WITH_SEARCH = 'dropdown_search';
    const FIELD_TYPE_RELATIONAL_NATIVE = 'relational_native';
    const FIELD_TYPE_PASSWORD = 'password';
    const FIELD_TYPE_EMAIL = 'email';
    const FIELD_TYPE_INTEGER = 'int';
    const FIELD_TYPE_NUMERIC = 'numeric';
    const FIELD_TYPE_FLOAT = 'float';
    const FIELD_TYPE_COLOR = 'color';
    const FIELD_TYPE_URL = 'url';
    const FIELD_TYPE_HIDDEN = 'hidden';
    const FIELD_TYPE_DATE = 'date';
    const FIELD_TYPE_DATETIME = 'datetime';
    const FIELD_TYPE_TEXTAREA = 'text';
    const FIELD_TYPE_NATIVE_SELECT_N_TO_N = 'native_relational_n_n';
    const FIELD_TYPE_BACKEND_CALLBACK = 'backend_callback';
    const FIELD_TYPE_CALLBACK_COLUMN = 'callback_column';
    const FIELD_TYPE_MULTIPLE_SELECT_SEARCHABLE = 'multiselect_searchable';
    const FIELD_TYPE_MULTIPLE_SELECT_NATIVE = 'multiselect_native';
    const FIELD_TYPE_UPLOAD = 'upload';
    const FIELD_TYPE_BLOB = 'special_blob';

    const PREFIX_BLOB_UPLOAD = '__gcrud_upload';

    const VERSION = '2.7.10';

	/**
	 * Specifying the datagrid columns that the end-user will see.
	 *
	 * @var array
	 */
	protected $_datagrid_columns = [];

    /**
     * @var array
     */
    protected $_clone_form_fields = [];

    /**
     * @var array
     */
    protected $_read_form_fields = [];

	/**
	 * Specifying the fields that the end-user will see at the insert form.
	 *
	 * @var array
	 */
	protected $_insert_form_fields = [];

	/**
	 * Specifying the fields that the end-user will see at the update form.
	 *
	 * @var array
	 */
	protected $_update_form_fields = array();

	/**
	 * Specifying the basic database table name for this object.
	 *
	 * @var string
	 */
	protected $_dbTableName = null;

	/**
	 * The subject title that the end user will see for all the operations.
	 *
	 * @var string
	 */
	protected $_subject_title;


    /**
     * The subject title as plural that the end user will use for all the operations (mostly at the list)
     *
     * @var string
     */
    protected $_subject_title_plural;

	/**
	 *
	 * @var Model\ModelInterface
	 */
	protected $_model;

    /**
     * @var Layout\LayoutInterface
     */
    protected $_layout;

	/**
	 * @var array
	 */
	protected $_action_buttons = [];

    /**
     * @var string
     */
	protected $_skin = null;

	/**
	 * @var bool
	 */
	protected $_load_jquery = true;


	/**
	 * @var bool
	 */
	protected $_load_select2 = true;

    /**
     * @var bool
     */
    protected $_load_react = true;

    /**
     * @var bool
     */
	protected $_load_modernizr = true;

	/**
	 * @var bool
	 */
	protected $_load_bootstrap = true;

	/**
	 * @var bool
	 */
	protected $_load_jquery_ui = true;

	/**
	 * @var bool
	 */
	protected $_load_add = true;

	/**
	 * @var bool
	 */
	protected $_load_edit = true;

	/**
	 * @var bool
	 */
	protected $_load_delete_single = true;

	/**
	 * @var bool
	 */
	protected $_load_delete_multiple = true;

	/**
	 * @var bool
	 */
	protected $_load_clone = false;

	/**
	 * @var bool
	 */
	protected $_load_read = false;

    /**
     * @var array
     */
    protected $_depended_relation = [];

    /**
     * @var array
     */
    protected $_relation_with_dependencies = [];

	/**
	 * @var array
	 */
	protected $_relation_1_n = [];

    /**
     * @var array
     */
    protected $_relation_n_n = [];

    /**
     * @var array
     */
    protected $_unsetAddFields = [];

    /**
     * @var array
     */
    protected $_unsetEditFields = [];

    /**
     * @var array
     */
    protected $_unset_clone_fields = [];

    /**
     * @var array
     */
    protected $_unset_readFields = [];

    /**
     * @var bool
     */
    protected $_load_export = true;

    /**
     * @var bool
     */
    protected $_load_print = true;

    // Callbacks
    /**
     * @var callable|null
     */
    protected $_callback_insert = null;

    /**
     * @var callable|null
     */
    protected $_callback_before_insert = null;

    /**
     * @var callable|null
     */
    protected $_callback_after_insert = null;

    /**
     * @var callable|null
     */
    protected $_callback_update = null;

    /**
     * @var callable|null
     */
    protected $_callback_before_update = null;

    /**
     * @var callable|null
     */
    protected $_callback_after_update = null;

    /**
     * @var callable|null
     */
    protected $_callback_add_form = null;

    /**
     * @var callable|null
     */
    protected $_callback_edit_form = null;

    /**
     * @var callable|null
     */
    protected $_callback_read_form = null;

    /**
     * @var callable|null
     */
    protected $_callback_delete = null;

    /**
     * @var callable|null
     */
    protected $_callback_before_delete = null;

    /**
     * @var callable|null
     */
    protected $_callback_after_delete = null;

    /**
     * @var callable|null
     */
    protected $_callback_delete_multiple = null;

    /**
     * @var callable|null
     */
    protected $_callback_before_delete_multiple = null;

    /**
     * @var callable|null
     */
    protected $_callback_after_delete_multiple = null;

    /**
     * @var callable|null
     */
    protected $_callback_upload;

    /**
     * @var callable|null
     */
    protected $_callback_before_upload;

    /**
     * @var callable|null
     */
    protected $_callback_after_upload;

    /**
     * @var array
     */
    protected $_callbackAddFields = [];

    /**
     * @var array
     */
    protected $_callbackEditFields = [];

    /**
     * @var array
     */
    protected $_callbackCloneFields = [];

    /**
     * @var array
     */
    protected $_callbackReadFields = [];

    /**
     * @var array
     */
    protected $_callback_columns = [];

    /**
     * @var array
     */
    protected $_unset_search_columns = [];

    /**
     * @var array
     */
    protected $_unset_columns = [];

    /**
     * @var array
     */
    protected $_display_as = [];

    /**
     * @var array
     */
    protected $_field_types = [];

    /**
     * @var array
     */
    protected $_blob_fields = [];

    /**
     * @var array
     */
    protected $_rules = [];

    /**
     * @var array
     */
    protected $_uniqueFields = [];

    /**
     * @var array
     */
    protected $_readOnlyFields = [];

    /**
     * @var array
     */
    protected $_readOnlyAddFields = [];

    /**
     * @var array
     */
    protected $_readOnlyEditFields = [];

    /**
     * @var array
     */
    protected $_readOnlyCloneFields = [];

    /**
     * @var array
     */
    protected $_requiredFields = [];

    /**
     * @var string
     */
    protected $_apiUrlPath;

    /**
     * @var array
     */
    protected $_mapColumn = [];

    /**
     * @var array
     */
    protected $_mapFields = [];

    /**
     * @var array
     */
    protected $_mapColumns = [];

    /**
     * @var array
     */
    protected $_text_editor = [];

    /**
     * @var string
     */
    protected $_languagePath = null;


    /**
     * @var string
     */
    protected $_language = null;

    /**
     * @var array
     */
    protected $_lang_strings = [];

    /**
     * @var null|array
     */
    protected $_database;

    /**
     * @var array
     */
    protected $_config = [];

    /**
     * @var string
     */
    protected $_uniqueId;

    /**
     * @var string
     */
    protected $_tokenName = '__csrf';

    /**
     * @var null|string
     */
    protected $_tokenValue;

    /**
     * @var null|string|array
     */
    protected $_where;

    /**
     * @var null|object
     */
    protected $_defaultOrderBy;

    /**
     * @var bool
     */
    protected $_autoloadJavaScript = true;

    /**
     * Custom primary keys
     *
     * @var array
     */
    protected $_primaryKeys = [];

    /**
     * @var array
     */
    protected $_fieldTypesAddForm = [];

    /**
     * @var array
     */
    protected $_fieldTypesEditForm = [];

    /**
     * @var array
     */
    protected $_fieldTypesReadForm = [];

    /**
     * @var array
     */
    protected $_fieldTypesCloneForm = [];

    /**
     * @var array
     */
    protected $_fieldTypeColumns = [];

    /**
     * @var ValidateInterface
     */
    protected $_validate;

    /**
	 * The constructor of grocery CRUD library
	 *
	 */
	public function __construct($config, $database = null)
	{
        $this->_layout = new Layout($config);
		$this->_cache = new Cache($config);
        $this->_validate = new Validate($config);
        $this->_database = $database;

        if ($config === null) {
            throw new Exception('You will need to add a configurable file');
        }

        $this->_config = $config;
	}

    /**
     * @param string $configName
     * @param int|string $configValue
     * @return $this
     */
	public function setConfig($configName, $configValue)
    {
        $this->_config[$configName] = $configValue;

        return $this;
    }

	public function getConfig()
    {
        return $this->_config;
    }

	public function getDatabaseConfig()
    {
        return $this->_database;
    }

    /**
     * @param array|string $where
     * @return $this
     */
    public function where($where)
    {
        $this->_where = $where;

        return $this;
    }


    /**
     * @param string $tokenName
     * @return $this
     */
    public function setCsrfTokenName($tokenName) {
        $this->_tokenName = $tokenName;

        return $this;
    }

    /**
     * @return string
     */
    public function getCsrfTokenName() {
        return $this->_tokenName;
    }

    /**
     * @param string $tokenValue
     * @return $this
     */
    public function setCsrfTokenValue($tokenValue) {
        $this->_tokenValue = $tokenValue;

        return $this;
    }


    /**
     * @return string
     */
    public function getCsrfTokenValue() {
        return $this->_tokenValue;
    }

    /**
     * @param string $ordering
     * @param string $sorting
     * @return $this
     */
    public function defaultOrdering($ordering, $sorting = 'asc')
    {
        $this->_defaultOrderBy = (object)[
            'ordering' => $ordering,
            'sorting' => $sorting
        ];

        return $this;
    }

    /**
     * @return null|object
     */
    public function getDefaultOrderBy()
    {
        return $this->_defaultOrderBy;
    }


    /**
     * @return array|null|string
     */
    public function getWhere()
    {
        return $this->_where;
    }

    public function setModel(Model\ModelInterface $model)
    {
        $this->_model = $model;

        return $this;
    }

	/**
	 * Set the basic database table name for this object.
	 *
	 * Here we are actually specifying the database table name of
	 * this object. It is highly recommended to have this kind of
	 * information at your basic model just to be more readable
	 * and more extendable.
	 * However there are many cases that we can use this method:
	 * 	- We don't want to use a model. Grocery CRUD offers you
	 *    the opportunity to not use a model to do your job even faster
	 *  - You have a general structure of a model and you want to
	 *    actually set the basic database table name of the model.
	 *
	 * Notice: There is a case that the basic table name is specified
	 * at the model but you also used this method to set a table. In that
	 * case the table name that the model will use is the one that was set
	 * from this method.
	 *
	 * @link http://www.grocerycrud.com/documentation/options_functions/set_table
	 * @param string $dbTableName
	 * @return $this
	 */
	public function setTable($dbTableName)
	{
		$this->_dbTableName = $dbTableName;
	
		return $this;
	}

    /**
     * Setting a skin name. The default theme that you use should be able to
     * handle the strings of the skin
     *
     * @param string $skin
     * @return $this
     */
    public function setSkin($skin)
    {
        $this->_skin = $skin;

        return $this;
    }

    public function getSkin()
    {
        return $this->_skin;
    }

    /**
     * Setting a theme by name. The themes will need to be under the folder "Themes"
     *
     * @param string $theme
     * @return $this
     */
    public function setTheme($theme)
    {
        $this->_layout->setTheme($theme);

        return $this;
    }

    /**
     * @param string $themePath
     * @return $this
     */
    public function setThemePath($themePath)
    {
        $this->_layout->setThemePath($themePath);

        return $this;
    }

	public function getRelations1toMany() {
		return $this->_relation_1_n;
	}

	/**
	 * The fields that we will use for the insert (or else add) form
	 *
	 * @param array $addFields
	 * @return $this
	 */
    public function addFields($addFields = array())
    {
        $this->insertFormFields($addFields);

		return $this;
    }

    /**
     * @param array $cloneFields
     * @return $this
     */
    public function cloneFields($cloneFields)
    {
        $this->_clone_form_fields = $cloneFields;

        return $this;
    }

    public function getCloneFields()
    {
        return $this->_clone_form_fields;
    }

    public function getCloneFormFields()
    {
        return $this->_clone_form_fields;
    }

    public function readFields($readFields)
    {
        $this->readFormFields($readFields);

        return $this;
    }

    public function readFormFields($readFields)
    {
        $this->_read_form_fields = $readFields;

        return $this;
    }

    /**
     * Set a custom primary key for a table. The common usage for this function is:
     * 1. When you need to change the default value of a primary key (e.g. to point to a different field for a join)
     * 2. To optimize your queries and to not have an extra query just for the primary key
     *
     * @param $primaryKey
     * @param $tableName
     */
    public function setPrimaryKey($primaryKey, $tableName) {
        $this->_primaryKeys[$tableName] = $primaryKey;

        return $this;
    }

    /**
     * @return array
     */
    public function getPrimaryKeys() {
        return $this->_primaryKeys;
    }

	/**
	 * Callback to call instead after the delete operation.
	 *
	 * @param mixed $callback
	 * @return $this
	 */
	public function callbackAfterDelete($callback)
	{
        $this->_callback_after_delete = $callback;

		return $this;
	}

    /**
     * Callback to call instead after the multiple delete operation.
     *
     * @param mixed $callback
     * @return $this
     */
    public function callbackAfterDeleteMultiple($callback)
    {
        $this->_callback_after_delete_multiple = $callback;

        return $this;
    }

	/**
	 * @param mixed $callback
	 * @return $this
	 */
	public function callbackAfterInsert($callback)
	{
        $this->_callback_after_insert = $callback;

		return $this;
	}

	/**
	 * @param mixed $callback
	 * @return $this
	 */
	public function callbackAfterUpdate($callback)
	{
        $this->_callback_after_update = $callback;

		return $this;
	}

	/**
	 * @param mixed $callback
	 * @return $this
	 */
	public function callbackAfterUpload($callback = null)
	{
        $this->_callback_after_upload = $callback;
		return $this;
	}

	/**
	 * @param mixed $callback
	 * @return $this
	 */
	public function callbackBeforeDelete($callback)
	{
        $this->_callback_before_delete = $callback;

		return $this;
	}

    /**
     * @param mixed $callback
     * @return $this
     */
    public function callbackAddForm($callback)
    {
        $this->_callback_add_form = $callback;

        return $this;
    }

    /**
     * @param mixed $callback
     * @return $this
     */
    public function callbackEditForm($callback)
    {
        $this->_callback_edit_form = $callback;

        return $this;
    }


    /**
     * @param mixed $callback
     * @return $this
     */
    public function callbackReadForm($callback)
    {
        $this->_callback_read_form = $callback;

        return $this;
    }

    /**
     * @param string $fieldName
     * @param callable $callback
     * @return $this
     */
    public function callbackAddField($fieldName, callable $callback)
    {
        $this->_callbackAddFields[$fieldName] = $callback;
        return $this;
    }

    /**
     * @param string $fieldName
     * @param callable $callback
     * @return $this
     */
    public function callbackEditField($fieldName, callable $callback)
    {
        $this->_callbackEditFields[$fieldName] = $callback;
        return $this;
    }

    /**
     * @param string $fieldName
     * @param callable $callback
     * @return $this
     */
    public function callbackCloneField($fieldName, callable $callback)
    {
        $this->_callbackCloneFields[$fieldName] = $callback;
        return $this;
    }

    /**
     * @param string $fieldName
     * @param callable $callback
     * @return $this
     */
    public function callbackReadField($fieldName, callable $callback)
    {
        $this->_callbackReadFields[$fieldName] = $callback;
        return $this;
    }

    /**
     * @param mixed $callback
     * @return $this
     */
    public function callbackBeforeDeleteMultiple($callback)
    {
        $this->_callback_before_delete_multiple = $callback;

        return $this;
    }

	/**
	 * @param mixed $callback
	 * @return $this
	 */
	public function callbackBeforeInsert($callback)
	{
        $this->_callback_before_insert = $callback;

		return $this;
	}

	/**
	 * @param mixed $callback
	 * @return $this
	 */
	public function callbackBeforeUpdate($callback)
	{
        $this->_callback_before_update = $callback;

		return $this;
	}

	/**
	 * @param mixed $callback
	 * @return $this
	 */
	public function callbackBeforeUpload($callback = null)
	{
        $this->_callback_before_upload = $callback;
		return $this;
	}

	/**
	 * @param string $columnName
	 * @param callable $callback
	 * @return $this
	 */
	public function callbackColumn($columnName, callable $callback)
	{
        $this->_callback_columns[$columnName] = $callback;
		return $this;
	}

	public function getCallbackColumns() {
        return $this->_callback_columns;
    }

	/**
	 * @param mixed $callback
	 * @return $this
	 */
	public function callbackDelete($callback)
	{
        $this->_callback_delete = $callback;

		return $this;
	}

    /**
     * @param mixed $callback
     * @return $this
     */
    public function callbackDeleteMultiple($callback)
    {
        $this->_callback_delete_multiple = $callback;

        return $this;
    }

	/**
	 * @param mixed $callback
	 * @return $this
	 */
	public function callbackInsert($callback)
	{
        $this->_callback_insert = $callback;

		return $this;
	}

	/**
	 * @param mixed $callback
	 * @return $this
	 */
	public function callbackUpdate($callback)
	{
        $this->_callback_update = $callback;

		return $this;
	}

	/**
	 * @param mixed $callback
	 * @return $this
	 */
	public function callbackUpload($callback = null)
	{
        $this->_callback_upload = $callback;
		return $this;
	}

    /**
     * This is just an alias to the field_type
     *
     * @param $field
     * @param $fieldType
     * @param $extraValues
     * @return $this
     */
	public function changeFieldType($field , $fieldType, $extraValues = null)
	{
        $this->fieldType($field, $fieldType, $extraValues);
		return $this;
	}

    /**
     * Changes the displaying label of the field
     * @param $fieldName
     * @param $displayAs
     * @return $this
     */
    public function displayAs($fieldName, $displayAs = null)
    {
        if (is_array($fieldName)) {
            foreach ($fieldName as $field => $displayAs) {
                $this->_display_as[$field] = $displayAs;
            }
        } elseif ($displayAs !== null) {
            $this->_display_as[$fieldName] = $displayAs;
        }
        return $this;
    }

    public function getDisplayAs() {
        return $this->_display_as;
    }

	public function editFields($editFields)
	{
        $this->updateFormFields($editFields);
		return $this;
	}

    /**
     * @param array $readOnlyFields
     * @return $this
     */
    public function readOnlyFields($readOnlyFields)
    {
        $this->_readOnlyFields = $readOnlyFields;

        return $this;
    }

    /**
     * @param array $readOnlyAddFields
     * @return $this
     */
    public function readOnlyAddFields($readOnlyAddFields)
    {
        $this->_readOnlyAddFields = $readOnlyAddFields;

        return $this;
    }

    /**
     * @param array $readOnlyEditFields
     * @return $this
     */
    public function readOnlyEditFields($readOnlyEditFields)
    {
        $this->_readOnlyEditFields = $readOnlyEditFields;

        return $this;
    }


    /**
     * @param array $readOnlyCloneFields
     * @return $this
     */
    public function readOnlyCloneFields($readOnlyCloneFields)
    {
        $this->_readOnlyCloneFields = $readOnlyCloneFields;

        return $this;
    }

    /**
     * @return array
     */
    public function getReadOnlyCloneFields()
    {
        return $this->_readOnlyCloneFields;
    }

    /**
     * @param string $fieldName
     * @param ModelFieldType|string $fieldType
     * @param null|array $permittedValues
     * @param null|array $options
     * @return $this
     * @throws \Exception
     */
    public function fieldTypeAddForm($fieldName , $fieldType, $permittedValues = null, $options = null)
    {
        if ($fieldType instanceof ModelFieldType) {
            $this->_fieldTypesAddForm[$fieldName] = $fieldType;
        } else if (is_string($fieldType)) {
            $fieldTypeModel = new ModelFieldType();
            $fieldTypeModel->setDataType($fieldType);
            $fieldTypeModel->setPermittedValues($permittedValues);
            $fieldTypeModel->setOptions($options);

            $this->_fieldTypesAddForm[$fieldName] = $fieldTypeModel;
        } else {
            throw new \Exception('Unrecognized type of the variable $fieldType with value:' . $fieldType);
        }

        return $this;
    }

    /**
     * @param string $columnName
     * @param ModelFieldType|string $columnType
     * @param null|array $permittedValues
     * @param null|array $options
     * @return $this
     * @throws \Exception
     */
    public function fieldTypeColumn($columnName, $columnType, $permittedValues = null, $options = null) {
        if ($columnType instanceof ModelFieldType) {
            $this->_fieldTypeColumns[$columnName] = $columnType;
        } else if (is_string($columnType)) {
            $columnTypeModel = new ModelFieldType();
            $columnTypeModel->setDataType($columnType);
            $columnTypeModel->setPermittedValues($permittedValues);
            $columnTypeModel->setOptions($options);

            $this->_fieldTypeColumns[$columnName] = $columnTypeModel;
        } else {
            throw new \Exception('Unrecognized type of the variable $columnType with value:' . $columnType);
        }

        return $this;
    }

    /**
     * @param string $fieldName
     * @param ModelFieldType|string $fieldType
     * @param null|array $permittedValues
     * @param null|array $options
     * @return $this
     * @throws \Exception
     */
    public function fieldTypeEditForm($fieldName , $fieldType, $permittedValues = null, $options = null)
    {
        if ($fieldType instanceof ModelFieldType) {
            $this->_fieldTypesEditForm[$fieldName] = $fieldType;
        } else if (is_string($fieldType)) {
            $fieldTypeModel = new ModelFieldType();
            $fieldTypeModel->setDataType($fieldType);
            $fieldTypeModel->setPermittedValues($permittedValues);
            $fieldTypeModel->setOptions($options);

            $this->_fieldTypesEditForm[$fieldName] = $fieldTypeModel;
        } else {
            throw new \Exception('Unrecognized type of the variable $fieldType with value:' . $fieldType);
        }

        return $this;
    }

    /**
     * @param string $fieldName
     * @param ModelFieldType|string $fieldType
     * @param null|array $permittedValues
     * @param null|array $options
     * @return $this
     * @throws \Exception
     */
    public function fieldTypeReadForm($fieldName , $fieldType, $permittedValues = null, $options = null)
    {
        if ($fieldType instanceof ModelFieldType) {
            $this->_fieldTypesReadForm[$fieldName] = $fieldType;
        } else if (is_string($fieldType)) {
            $fieldTypeModel = new ModelFieldType();
            $fieldTypeModel->setDataType($fieldType);
            $fieldTypeModel->setPermittedValues($permittedValues);
            $fieldTypeModel->setOptions($options);
            $this->_fieldTypesReadForm[$fieldName] = $fieldTypeModel;
        } else {
            throw new \Exception('Unrecognized type of the variable $fieldType with value:' . $fieldType);
        }

        return $this;
    }

    /**
     * @param string $fieldName
     * @param ModelFieldType|string $fieldType
     * @param null|array $permittedValues
     * @param null|array $options
     * @return $this
     * @throws \Exception
     */
    public function fieldTypeCloneForm($fieldName , $fieldType, $permittedValues = null, $options = null)
    {
        if ($fieldType instanceof ModelFieldType) {
            $this->_fieldTypesCloneForm[$fieldName] = $fieldType;
        } else if (is_string($fieldType)) {
            $fieldTypeModel = new ModelFieldType();
            $fieldTypeModel->setDataType($fieldType);
            $fieldTypeModel->setPermittedValues($permittedValues);
            $fieldTypeModel->setOptions($options);
            $this->_fieldTypesCloneForm[$fieldName] = $fieldTypeModel;
        } else {
            throw new \Exception('Unrecognized type of the variable $fieldType with value:' . $fieldType);
        }

        return $this;
    }

    /**
     * @param string $fieldName
     * @param ModelFieldType|string $fieldType
     * @param null|array $permittedValues
     * @param null|array $options
     * @return $this
     * @throws \Exception
     */
    public function fieldTypeFormFields($fieldName , $fieldType, $permittedValues = null, $options = null)
    {
        $this->fieldTypeAddForm($fieldName , $fieldType, $permittedValues, $options);
        $this->fieldTypeEditForm($fieldName , $fieldType, $permittedValues, $options);
        $this->fieldTypeReadForm($fieldName , $fieldType, $permittedValues, $options);
        $this->fieldTypeCloneForm($fieldName , $fieldType, $permittedValues, $options);

        return $this;
    }

    /**
     * @return array
     */
    public function getFieldTypeColumns() {
        return $this->_fieldTypeColumns;
    }

    /**
     * @return array
     */
    public function getCallbackAddFields() {
        return $this->_callbackAddFields;
    }

    /**
     * @return array
     */
    public function getCallbackEditFields() {
        return $this->_callbackEditFields;
    }

    /**
     * @return array
     */
    public function getCallbackCloneFields() {
        return $this->_callbackCloneFields;
    }

    /**
     * @return array
     */
    public function getCallbackReadFields() {
        return $this->_callbackReadFields;
    }

    /**
     * @return array
     */
    public function getFieldTypesAddForm()
    {
        return $this->_fieldTypesAddForm;
    }

    /**
     * @return array
     */
    public function getFieldTypesEditForm()
    {
        return $this->_fieldTypesEditForm;
    }

    /**
     * @return array
     */
    public function getFieldTypesReadForm()
    {
        return $this->_fieldTypesReadForm;
    }

    /**
     * @return array
     */
    public function getFieldTypesCloneForm()
    {
        return $this->_fieldTypesCloneForm;
    }
    
    /**
     * @return array
     */
    public function getReadOnlyEditFields()
    {
        return $this->_readOnlyEditFields;
    }

    /**
     * @return array
     */
    public function getReadOnlyAddFields()
    {
        return $this->_readOnlyAddFields;
    }

    /**
     * @return array
     */
    public function getReadOnlyFields()
    {
        return $this->_readOnlyFields;
    }

    /**
     * @param string $field
     * @param string $fieldType
     * @param $permittedValues
     * @param $options
     * @return $this
     */
	public function fieldType($field , $fieldType, $permittedValues = null, $options = null)
	{
        $this->_field_types[$field] = (object)[
            'fieldName' => $field,
            'dataType' => $fieldType,
            'permittedValues' => $permittedValues,
            'options' => $options
        ];
		return $this;
	}

    /**
     * Get the field types from the end-user
     *
     * @return array
     */
	public function getFieldTypes()
    {
        return $this->_field_types;
    }

	public function getState()
	{
        return (new State())->getStateName();
	}

	public function getStateInfo()
	{
        $stateName = (new State())->getStateName();

        $stateFactory = new StateFactory();

        $stateObject = $stateFactory->getStateClass($stateName, $this);

        return $stateObject->getStateParameters();
	}

    /**
     * @param string $label
     * @param string $cssClassIcon
     * @param callable $urlCallback
     * @param bool $newTab
     * @return $this
     */
	public function setActionButton($label, $cssClassIcon, $urlCallback, $newTab = false) {
        $this->_action_buttons[] = (object)[
            'label' => $label,
            'iconCssClass' => $cssClassIcon,
            'urlCallback' => $urlCallback,
            'newTab' => $newTab
        ];

        return $this;
    }

    /**
     * @return array
     */
    public function getActionButtons() {
        return $this->_action_buttons;
    }

    public function setApiUrlPath($apiUrlPath)
    {
        $this->_apiUrlPath = $apiUrlPath;

        return $this;
    }

    public function setUniqueId($uniqueId)
    {
        $this->_uniqueId = $uniqueId;

        return $this;
    }

    public function getUniqueId()
    {
        return $this->_uniqueId;
    }

	public function getApiUrlPath()
    {
        return $this->_apiUrlPath;
    }

    /**
     * @param string $fieldName
     * @param string $filenameField
     * @param string $temporaryUploadDirectory
     * @param string $maxUploadSize
     * @return $this
     */
    public function setFieldBlob($fieldName, $filenameField, $temporaryUploadDirectory, $maxUploadSize) {
        $this->fieldType($fieldName, GroceryCrud::FIELD_TYPE_BLOB, null, (object)[
            'filenameField' => $filenameField,
            'temporaryUploadDirectory' => $temporaryUploadDirectory,
            'maxUploadSize' => $maxUploadSize
        ]);
        $this->_blob_fields[] = $fieldName;
        $this->mapColumn($fieldName, $filenameField);
        $this->mapField($fieldName, $filenameField);

        return $this;
    }

    public function getBlobFieldNames() {
        return $this->_blob_fields;
    }

    /**
     * @param string $fieldName
     * @param string $mapFieldName
     * @return $this
     */
    public function mapField($fieldName, $mapFieldName) {
        $this->_mapFields[$fieldName] = $mapFieldName;

        return $this;
    }

    /**
     * @return array
     */
    public function getMapFields() {
        return $this->_mapFields;
    }


    /**
     * @param string $columnName
     * @param string $mapColumnName
     * @return $this
     */
    public function mapColumn($columnName, $mapColumnName) {
        $this->_mapColumns[$columnName] = $mapColumnName;

        return $this;
    }

    /**
     * @return array
     */
    public function getMapColumns() {
        return $this->_mapColumns;
    }

    /**
     * @param string $fieldName
     * @param string $uploadPath
     * @param string $publicPath
     * @return $this
     */
	public function setFieldUpload($fieldName, $uploadPath, $publicPath)
	{
        $this->fieldType($fieldName, 'upload', null, (object)[
            'uploadPath' => $uploadPath,
            'publicPath' => $publicPath
        ]);
		return $this;
	}

    public function setLanguagePath($languagePath = null)
    {
        $this->_languagePath = $languagePath;
        return $this;
    }
    public function getLanguagePath()
    {
        return $this->_languagePath;
    }

    public function setLanguage($language)
    {
        $this->_language = $language;

        return $this;
    }

	public function getLanguage()
    {
        return $this->_language;
    }

	public function setLangString($name, $translation)
	{
        $this->_lang_strings[$name] = $translation;
		return $this;
	}

	public function getLandStrings()
    {
        return $this->_lang_strings;
    }

    /**
     * @param string $fieldName
     * @param string $relatedTable
     * @param string $relatedTitleField
     * @param null|string|array $where
     * @param null|string $orderBy
     * @return $this
     */
	public function setRelation($fieldName , $relatedTable, $relatedTitleField, $where = null, $orderBy = null)
	{
		$this->_relation_1_n[$fieldName] = (object)array(
			'fieldName' => $fieldName,
			'tableName' => $relatedTable,
			'titleField' => $relatedTitleField,
            'originalTitleField' => $relatedTitleField,
            'where'     => $where,
            'orderBy'   => $orderBy
		);
		return $this;
	}


    /**
     * @param string $fieldName
     * @param string $dependencyFromField
     * @param string $fieldNameRelation
     * @return $this
     */
	public function setDependentRelation($fieldName, $dependencyFromField, $fieldNameRelation) {

        $this->_depended_relation[$fieldName] = (object)array(
            'fieldName' => $fieldName,
            'dependencyFromField' => $dependencyFromField,
            'fieldNameRelation' => $fieldNameRelation
        );

        $this->_relation_with_dependencies[$dependencyFromField] = $fieldName;

	    return $this;
    }

    public function getRelationWithDependencies() {
        return $this->_relation_with_dependencies;
    }

    public function getDependedRelation() {
        return $this->_depended_relation;
    }

	public function getDbRelations1ToN()
    {
        return $this->_relation_1_n;
    }

	public function getDbRelationsNToN()
    {
        return $this->_relation_n_n;
    }

    /**
     * @param ValidateInterface $validator
     * @return $this
     */
    public function setValidator(ValidateInterface $validator) {
        $this->_validate = $validator;

        return $this;
    }

    public function getValidator() {
        return $this->_validate;
    }

	public function setRelationNtoN(
	    $fieldName, $junctionTable, $referrerTable,
        $primaryKeyJunctionToCurrent, $primaryKeyToReferrerTable,
        $referrerTitleField, $sortingFieldName = null, $where = null
    )
	{
        $this->_relation_n_n[$fieldName] = (object)[
            'fieldName' => $fieldName,
            'junctionTable' => $junctionTable,
            'referrerTable' => $referrerTable,
            'primaryKeyJunctionToCurrent' => $primaryKeyJunctionToCurrent,
            'primaryKeyToReferrerTable' => $primaryKeyToReferrerTable,
            'referrerTitleField' => $referrerTitleField,
            'where' => $where,
            'sortingFieldName' => $sortingFieldName
        ];
		return $this;
	}

	public function getRelationNtoN()
    {
        return $this->_relation_n_n;
    }

	public function setRule($fieldName, $rule, $parameters = null)
    {
        $this->_rules[] = [
            'fieldName' => $fieldName,
            'rule' => $rule,
            'parameters' => $parameters
        ];

        return $this;
    }

	public function setRules($rules)
	{
        foreach ($rules as $rule) {
            $this->_rules[] = $rule;
        }
		return $this;
	}

	public function getValidationRules()
    {
        return $this->_rules;
    }

    /**
     * @param array $uniqueFields
     * @return $this
     */
	public function uniqueFields($uniqueFields)
	{
        $this->_uniqueFields = $uniqueFields;
		return $this;
	}

    /**
     * @param array $requiredFields
     * @return $this
     */
    public function requiredFields($requiredFields)
    {
        $this->_requiredFields = $requiredFields;
        return $this;
    }

    public function getRequiredFields()
    {
        return $this->_requiredFields;
    }

	public function getUniqueFields()
    {
        return $this->_uniqueFields;
    }

    public function unsetAutoloadJavaScript()
    {
        $this->_autoloadJavaScript = false;

        return $this;
    }

    public function setAutoloadJavaScript()
    {
        $this->_autoloadJavaScript = true;

        return $this;
    }

    /**
     * @return bool
     */
    public function getAutoloadJavaScript()
    {
        return $this->_autoloadJavaScript;
    }

    /**
     * @return $this
     */
	public function unsetAdd()
	{
        $this->_load_add = false;
		return $this;
	}

    /**
     * @return $this
     */
    public function setAdd()
    {
        $this->_load_add = true;
        return $this;
    }

    /**
     * @param array $fields
     * @return $this
     */
	public function unsetAddFields($fields)
	{
        $this->_unsetAddFields = $fields;
		return $this;
	}

    public function getUnsetAddFields() {
        return $this->_unsetAddFields;
    }

    public function unsetSearchColumns($columns)
    {
        $this->_unset_search_columns = $columns;
        return $this;
    }

    public function getUnsetSearchColumns()
    {
        return $this->_unset_search_columns;
    }

	public function unsetColumns($columns)
	{
        $this->_unset_columns = $columns;
		return $this;
	}

	public function getUnsetColumns() {
        return $this->_unset_columns;
    }

    public function unsetDelete()
    {
       $this->unsetDeleteSingle();
       $this->unsetDeleteMultiple();

        return $this;
    }

	public function unsetDeleteSingle()
	{
        $this->_load_delete_single = false;
		return $this;
	}

    public function setDelete()
    {
        $this->_load_delete_single = true;
        return $this;
    }

    public function unsetDeleteMultiple()
    {
        $this->_load_delete_multiple = false;
        return $this;
    }

    public function setDeleteMultiple()
    {
        $this->_load_delete_multiple = true;
        return $this;
    }

	public function unsetEdit()
	{
        $this->_load_edit = false;
		return $this;
	}

    public function setEdit()
    {
        $this->_load_edit = true;
        return $this;
    }

    /**
     * @param array $fields
     * @return $this
     */
	public function unsetEditFields($fields)
	{
        $this->_unsetEditFields = $fields;
		return $this;
	}

	public function getUnsetEditFields() {
        return $this->_unsetEditFields;
    }

    public function unsetCloneFields($fields)
    {
        $this->_unset_clone_fields = $fields;
        return $this;
    }

    public function getUnsetCloneFields() {
        return $this->_unset_clone_fields;
    }

    public function unsetReadFields($fields)
    {
        $this->_unset_readFields = $fields;
        return $this;
    }

    public function getUnsetReadFields() {
        return $this->_unset_readFields;
    }

    /**
     * @return $this
     */
    public function setExport()
    {
        $this->_load_export = true;
        return $this;
    }

    /**
     * @return $this
     */
	public function unsetExport()
	{
        $this->_load_export = false;
		return $this;
	}

    /**
     * @return bool
     */
	public function getLoadExport()
    {
        return $this->_load_export;
    }

    /**
     * @param array $fields
     * @return $this
     */
	public function unsetFields($fields)
	{
        $this->unsetAddFields($fields);
        $this->unsetEditFields($fields);
        $this->unsetReadFields($fields);
        $this->unsetCloneFields($fields);

		return $this;
	}

    /**
     * @return $this
     */
	public function unsetJquery()
	{
		$this->_load_jquery = false;
		return $this;
	}

    /**
     * @return $this
     */
    public function unsetSelect2()
    {
        $this->_load_select2 = false;
        return $this;
    }

    /**
     * @return $this
     */
    public function unsetReact()
    {
        $this->_load_react = false;
        return $this;
    }

    /**
     * @return $this
     */
    public function unsetModernizr()
    {
        $this->_load_modernizr = false;
        return $this;
    }

    /**
     * @return $this
     */
	public function unsetBootstrap()
	{
		$this->_load_bootstrap = false;
		return $this;
	}

    /**
     * @return $this
     */
	public function unsetJqueryUi()
	{
		$this->_load_jquery_ui = false;
		return $this;
	}

    /**
     * @return $this
     */
	public function unsetOperations()
	{
        $this->unsetAdd();
        $this->unsetEdit();
        $this->unsetClone();
        $this->unsetDelete();
        $this->unsetRead();
		return $this;
	}

    /**
     * @return $this
     */
	public function unsetPrint()
	{
        $this->_load_print = false;
		return $this;
	}

    /**
     * @return $this
     */
    public function setPrint()
    {
        $this->_load_print = true;
        return $this;
    }


    /**
     * @return bool
     */
    public function getLoadPrint()
    {
        return $this->_load_print;
    }

    /**
     * @return $this
     */
	public function setRead()
	{
		$this->_load_read = true;
		return $this;
	}

    /**
     * @return $this
     */
	public function setClone()
    {
        $this->_load_clone = true;
        return $this;
    }

	public function unsetClone()
    {
        $this->_load_clone = false;
        return $this;
    }

    public function getLoadClone()
    {
        return $this->_load_clone;
    }

    /**
     * @return $this
     */
	public function unsetRead()
	{
		$this->_load_read = false;
		return $this;
	}

    /**
     * @param array $fields
     * @return $this
     */
	public function unsetTexteditor($fields)
	{
        foreach ($fields as $fieldName) {
            unset($this->_text_editor[$fieldName]);
        }
		return $this;
	}

	public function setTexteditor($fields)
    {
        foreach ($fields as $fieldName) {
            $this->_text_editor[$fieldName] = true;
        }
        return $this;
    }

    public function getTextEditorFields()
    {
        return $this->_text_editor;
    }

    public function getLoadAdd()
    {
        return $this->_load_add;
    }

    public function getLoadDelete()
    {
        return $this->_load_delete_single;
    }

    /**
     * @return bool
     */
    public function getLoadDeleteMultiple()
    {
        return $this->_load_delete_multiple;
    }

    /**
     * @return bool
     */
    public function getLoadEdit()
    {
        return $this->_load_edit;
    }

    /**
     * @return bool
     */
	public function getLoadRead()
	{
		return $this->_load_read;
	}

    /**
     * @return bool
     */
	public function getLoadJquery()
	{
		return $this->_load_jquery;
	}

    /**
     * @return bool
     */
	public function getLoadSelect2()
	{
		return $this->_load_select2;
	}

    /**
     * @return bool
     */
	public function getLoadModernizr()
	{
		return $this->_load_modernizr;
	}

    /**
     * @return bool
     */
	public function getLoadReact()
    {
        return $this->_load_react;
    }

    /**
     * @return bool
     */
	public function getLoadBootstrap()
	{
		return $this->_load_bootstrap;
	}

    /**
     * @return bool
     */
	public function getLoadJqueryUi()
	{
		return $this->_load_jquery_ui;
	}

    /**
     * @param string $file
     * @return $this
     */
	public function setCssFile($file)
    {
        $this->_layout->setCssFile($file);

        return $this;
    }

    /**
     * @param string $file
     * @return $this
     */
    public function setJsFile($file)
    {
        $this->_layout->setJsFile($file);
        return $this;
    }

	public function getCache()
	{
		return $this->_cache;
	}

	public function getLayout()
	{
		return $this->_layout;
	}

	public function getModel()
	{
		return $this->_model;
	}

	public function getSubject()
	{
		return $this->_subject_title;
	}

	public function getDbTableName() {
		return $this->_dbTableName;
	}

	public function getColumns()
	{
		return $this->_datagrid_columns;
	}

    public function getEditFields()
    {
        return $this->_update_form_fields;
    }

    public function getAddFields()
    {
        return $this->_insert_form_fields;
    }

    public function getCallbackAddForm() {
        return $this->_callback_add_form;
    }

    public function getCallbackEditForm() {
        return $this->_callback_edit_form;
    }

    public function getCallbackReadForm() {
        return $this->_callback_read_form;
    }

    public function getCallbackInsert()
    {
        return $this->_callback_insert;
    }

    public function getCallbackBeforeInsert()
    {
        return $this->_callback_before_insert;
    }

    public function getCallbackAfterInsert()
    {
        return $this->_callback_after_insert;
    }

    public function getCallbackUpload()
    {
        return $this->_callback_upload;
    }

    public function getCallbackBeforeUpload()
    {
        return $this->_callback_before_upload;
    }

    /**
     * @return callable|null
     */
    public function getCallbackAfterUpload()
    {
        return $this->_callback_after_upload;
    }

    /**
     * @return callable|null
     */
    public function getCallbackUpdate()
    {
        return $this->_callback_update;
    }

    /**
     * @return callable|null
     */
    public function getCallbackBeforeUpdate()
    {
        return $this->_callback_before_update;
    }

    /**
     * @return callable|null
     */
    public function getCallbackAfterUpdate()
    {
        return $this->_callback_after_update;
    }

    /**
     * @return callable|null
     */
    public function getCallbackDelete()
    {
        return $this->_callback_delete;
    }

    /**
     * @return callable|null
     */
    public function getCallbackBeforeDelete()
    {
        return $this->_callback_before_delete;
    }

    /**
     * @return callable|null
     */
    public function getCallbackAfterDelete()
    {
        return $this->_callback_after_delete;
    }

    /**
     * @return callable|null
     */
    public function getCallbackDeleteMultiple()
    {
        return $this->_callback_delete_multiple;
    }

    /**
     * @return callable|null
     */
    public function getCallbackBeforeDeleteMultiple()
    {
        return $this->_callback_before_delete_multiple;
    }

    /**
     * @return callable|null
     */
    public function getCallbackAfterDeleteMultiple()
    {
        return $this->_callback_after_delete_multiple;
    }

    /**
     * @return array
     */
    public function getReadFields()
    {
        return $this->_read_form_fields;
    }

    /**
     * @return string
     */
	public function getSubjectPlural()
	{
		return $this->_subject_title_plural;
	}

    /**
	 * Where everything is rendering.
	 *
	 * This method is the most important method of GroceryCrud library.
	 * The actual functionality is to calculate all the parameters
	 * that the end user and the developer gives and return all the
	 * available information of what to render, not only as HTML but
	 * also returns the JavaScript and CSS information.
	 *
	 * Moreover this method is responsible for all the actions and
	 * the CRUD operations that the end user gives. All the decisions
	 * of which action to use (Create, Read, Update, Delete, Paging,
	 * Searching, Listing e.t.c.) are taken from this basic method.
	 *
	 * @link http://www.grocerycrud.com/documentation/options_functions/render
	 * @throws \Exception
     * @return RenderAbstract
	 */
	public function render()
	{
		$stateName = (new State())->getStateName();
        $stateFactory = new StateFactory();

        $stateObject = $stateFactory->getStateClass($stateName, $this);

		return $stateObject->render();
	}

	/**
	 * Here we specify the column names that we will display to the datagrid.
	 *
	 * Moreover we specify the ordering that the columns will display to
	 * the end-user's datagrid. For example: 'field_name1', 'field_name2'
	 * will display with a different order than: 'field_name2', 'field_name1'
	 *
	 * Be aware that we only show the field names that it is also related
	 * with the field names at the database e.g. email_address
	 * The actual display name of the column is been set from the method
	 * display_as or column_display_as
	 *
	 * @link http://www.grocerycrud.com/documentation/options_functions/columns
	 * @access	public
	 * @param array $columns
	 * @return $this
	 */
	public function columns($columns)
	{
		$this->_datagrid_columns = $columns;

		return $this;
	}

	/**
	 * Specifying the fields at the insert and the update form for the end-user.
	 *
	 * This method is responsible about what fields will appear to
	 * the end user. The ordering of the fields that the developer is
	 * adding is also the ordering that the end-user will also see.
	 *
	 * This method is just a shortcut for using both insert_form_fields
	 * and update_form_fields at the same time.
	 *
	 * @link http://www.grocerycrud.com/documentation/options_functions/fields
	 * @access	public
	 * @param array|string $fields
	 * @return $this
	 */
	public function fields($fields)
	{
		$this->insertFormFields($fields);
		$this->updateFormFields($fields);
		$this->cloneFormFields($fields);

		return $this;
	}

	/**
	 * Specifying the fields that the end-user will see at the insert form.
	 *
	 * Using this method we can easily set the fields that the end-user will
	 * see at the insert form. The developer that use this method has to
	 * consider that the priority of the fields is the priority that the
	 * end-user will also see.
	 *
	 * @access	public
	 * @param array|string $insertFormFields
	 * @return $this
	 */
	public function insertFormFields($insertFormFields)
	{
		$this->_insert_form_fields = $insertFormFields;

		return $this;
	}

	/**
	 * Specifying the fields that the end-user will see at the update form.
	 *
	 * This method is actually setting the fields that the end-user will
	 * see at the update form. Please consider that the priority of the fields
	 * that we add will also be the priority of the fields that the end-user
	 * will see.
	 *
	 * @access	public
	 * @param array $updateFormFields
	 * @return $this
	 */
	public function updateFormFields($updateFormFields)
	{
		$this->_update_form_fields = $updateFormFields;

		return $this;
	}

    /**
     * @param array $cloneFormFields
     * @return $this
     */
	public function cloneFormFields($cloneFormFields) {
	    $this->_clone_form_fields = $cloneFormFields;

	    return $this;
    }

	/**
	 * Set a subject title for all the CRUD operations for this object.
	 *
	 * This method is really useful when you want to specify what is the actual
	 * subject of your table CRUD. Moreover you don't have to add everytime
	 * all the strings that the user will see as they are very similar.
	 * The default value is "Record" and it is also translatable. It is very
	 * easy to set a subject and then this string is reused in almost every
	 * message or operation.
	 *
	 * For example if we insert as a subject the string "Employee" it will be:
	 *     - instead of "New record" we will have "New employee"
	 *     - instead of "Edit record" we will have "Edit employee"
	 *
	 * A good way to add a subject is to add it as a non plural subject. For
	 * example: Employee and not Employees, City and not Cities and so on...
	 *
	 * @link http://www.grocerycrud.com/documentation/options_functions/set_subject
	 * @access public
	 * @param string $subjectTitle
	 * @param string $subjectTitlePlural
	 * @return $this
	 */
	public function setSubject($subjectTitle, $subjectTitlePlural = '')
	{
		$this->_subject_title = $subjectTitle;
        $this->_subject_title_plural = $subjectTitlePlural;

		return $this;
	}

    /**
     * @return string
     */
	public function getTable()
    {
        return $this->getDbTableName();
    }

    /**
     * @return string|null
     */
    public function getThemeName() {
        return $this->_layout->getThemeName();
    }
}
