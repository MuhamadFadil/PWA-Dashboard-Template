<?php
namespace GroceryCrud\Core\Model;

use GroceryCrud\Core\GroceryCrud;

interface ModelInterface
{
	public function getOne($id);

	public function validateOne($id);

	public function getList();

	public function setTableName($tableName);

	public function getColumnNames();

    /**
     * @param string $ordering
     * @param string $sorting
     * @return $this
     */
    public function setDefaultOrderBy($ordering, $sorting);

    /**
     * @param array|string $where
     * @return $this
     */
	public function setWhere($where);

    /**
     * @return integer
     */
	public function getTotalItems();

    public function isUnique($name, $value, $primaryKeyValue);

    /**
     * @param string $primaryKey
     * @param null|string $tableName
     * @return $this
     */
    public function setPrimaryKey($primaryKey, $tableName = null);

    public function getRelationNtoNData($fieldInfo, $primaryKeyValue);

	public function insert($data);

    public function update($id, $data);

	public function removeOne($id);

	public function removeMultiple($ids);

    /**
     * Get the field types of the table name specified for all the table fields
     *
     * @param string $tableName
     * @return \GroceryCrud\Core\Model\ModelFieldType[]
     */
	public function getFieldTypes($tableName);

    /**
     * @return string
     */
	public function getPrimaryKeyField();

    public function extraWhereStatements($select);

    public function defaultOrdering($select);

    public function insertRelationManytoMany($fieldInfo, $data , $primaryKey);

    public function updateRelationManytoMany($fieldInfo, $data , $primaryKey);

    public function setRelations1ToN($dbRelations);

    public function setRelationNToN($dbRelations);

    public function setRelationalColumns($columns);

    /**
     * Get the database connection as a unique string. This string is used for caching and the only symbols
     * that are allowed are: alphameric strings and the symbol plus (+).
     *
     * The common usage is to return the database driver + the database name. For example: Mysql+intranet_db
     *
     * @return string
     */
    public function getDbUniqueId();
}