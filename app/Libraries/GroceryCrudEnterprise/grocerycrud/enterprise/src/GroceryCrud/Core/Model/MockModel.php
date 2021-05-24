<?php
namespace GroceryCrud\Core\Model;


class MockModel implements ModelInterface
{
    public function getList() {
        return array(array('testColumn' => ''));
    }

    public function insertRelationManytoMany($fieldInfo, $data , $primaryKey) {

    }

    public function validateOne($id)
    {
        // TODO: Implement validateOne() method.
    }

    public function setWhere($where)
    {
       return $this;
    }

    public function setDefaultOrderBy($ordering, $sorting)
    {
        // TODO: Implement setDefaultOrderBy() method.
    }

    public function getDbUniqueId()
    {
        return 'Mysql+mock_db';
    }

    public function setRelationNToN($dbRelations)
    {
        // TODO: Implement setRelationNToN() method.
    }

    public function setRelationalColumns($columns)
    {
        // TODO: Implement setRelationalColumns() method.
    }

    public function updateRelationManytoMany($fieldInfo, $data , $primaryKey) {

    }

    public function isUnique($name, $value, $primaryKeyValue)
    {
        // TODO: Implement isUnique() method.
    }

    public function setPrimaryKey($primaryKey, $tableName = null)
    {
        // TODO: Implement setPrimaryKey() method.
    }

    public function extraWhereStatements($select)
    {
        // TODO: Implement extraWhereStatements() method.
    }

    public function defaultOrdering($select)
    {
        // TODO: Implement setDefaultOrdering() method.
    }

    public function getFieldTypes($tableName)
    {
        // TODO: Implement getFieldTypes() method.
    }

    public function setTableName($tableName)
    {
        // TODO: Implement setTableName() method.
    }

    public function getColumnNames()
    {
        return array('testColumn');
    }

    public function getTotalItems()
    {
        return 1;
    }

    public function insert($data) {
        return true;
    }

    public function getOne($id)
    {
        // TODO: Implement getOne() method.
    }

    public function removeOne($id)
    {
        // TODO: Implement removeOne() method.
    }

    public function removeMultiple($ids)
    {
        // TODO: Implement removeMultiple() method.
    }

    public function update($id, $data)
    {
        // TODO: Implement update() method.
    }

    public function getPrimaryKeyField()
    {
        // TODO: Implement getPrimaryKeyField() method.
    }

    public function getRelationNtoNData($fieldInfo, $primaryKeyValue)
    {
        // TODO: Implement getRelationNtoNData() method.
    }

    public function setRelations1ToN($dbRelations)
    {
        // TODO: Implement setRelations1ToN() method.
    }

    public function setRelationsnToN($dbRelations)
    {
        // TODO: Implement setRelations1ToN() method.
    }
}