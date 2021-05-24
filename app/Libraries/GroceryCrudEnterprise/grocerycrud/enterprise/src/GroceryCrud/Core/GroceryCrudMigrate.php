<?php
namespace GroceryCrud\Core;

class GroceryCrudMigrate extends GroceryCrud {

    /**
     * Sets the database table that we will get our data.
     *
     * @param string $dbTableName
     * @return $this
     */
    public function set_table($dbTableName) {
        return $this->setTable($dbTableName);
    }

    /**
     * Changes the displaying label of the field
     *
     * @param string $fieldName
     * @param string $displayAs
     * @return $this
     */
    public function display_as($fieldName, $displayAs) {
        return $this->displayAs($fieldName, $displayAs);
    }

    /**
     * Add an action/operation to the list table.
     *
     * @param string $label
     * @param string $image_url
     * @param string $link_url
     * @param string $css_class
     * @param callable $url_callback
     * @return $this
     */
    public function add_action($label,  $image_url , $link_url , $css_class ,  $url_callback) {

        return parent::setActionButton($label, $css_class, $url_callback);
    }

    /**
     * @param $fields
     * @return $this
     */
    public function add_fields($fields) {
        return $this->addFields($fields);
    }

    /**
     * @param string $fieldName
     * @param callable $callback
     * @return GroceryCrudMigrate
     */
    public function callback_add_field($fieldName, $callback) {
        return $this->callbackAddField($fieldName, $callback);
    }

    /**
     * @param callable $callback
     * @return GroceryCrudMigrate
     */
    public function callback_after_delete($callback) {
        return $this->callbackAfterDelete($callback);
    }

    public function callback_after_insert() {

    }

    public function callback_after_update() {

    }

    public function callback_after_upload() {

    }

    public function callback_before_delete() {

    }

    public function callback_before_insert() {

    }

    public function callback_before_update() {

    }

    public function callback_before_upload() {

    }

    public function callback_column() {

    }

    public function callback_delete() {

    }

    public function callback_edit_field() {

    }

    public function callback_field() {

    }

    public function callback_insert() {

    }

    public function callback_read_field() {

    }

    public function callback_update() {

    }

    public function callback_upload() {

    }

    public function change_field_type() {

    }

    public function edit_fields() {

    }

    public function field_type() {

    }

    public function getStateInfo() {

    }

    public function get_primary_key() {

    }

    public function like() {

    }

    public function limit() {

    }

    public function order_by() {

    }

    public function or_like() {

    }

    public function or_where() {

    }

    public function required_fields() {

    }

    public function set_crud_url_path() {

    }

    public function set_field_upload() {

    }

    public function set_language() {

    }

    public function set_lang_string() {

    }

    public function set_model() {

    }

    public function set_primary_key() {

    }

    public function set_relation() {

    }

    public function set_relation_n_n() {

    }

    public function set_rules() {

    }

    public function set_subject() {

    }

    /**
     * @param string $theme
     * @return GroceryCrudMigrate
     */
    public function set_theme($theme) {
        return $this->setSkin($theme);
    }

    /**
     * @param array $fields
     * @return GroceryCrudMigrate
     */
    public function unique_fields($fields) {
        return $this->uniqueFields($fields);
    }

    /**
     * @return $this
     */
    public function unset_add() {
        return $this->unsetAdd();
    }

    /**
     * @param $fields
     * @return $this
     */
    public function unset_add_fields($fields) {
        return $this->unsetAddFields($fields);
    }

    /**
     * @return $this
     */
    public function unset_bootstrap() {
        return $this->unsetBootstrap();
    }

    /**
     * @return $this
     */
    public function unset_clone() {
        return $this->unsetClone();
    }

    /**
     * @param array $columns
     * @return $this
     */
    public function unset_columns($columns) {
        return $this->unsetColumns($columns);
    }

    /**
     * @return $this
     */
    public function unset_delete() {
        return $this->unsetDelete();
    }

    /**
     * @return $this
     */
    public function unset_edit() {
        return $this->unsetEdit();
    }

    /**
     * @param array $fields
     * @return $this
     */
    public function unset_edit_fields($fields) {
        return $this->unsetEditFields($fields);
    }

    /**
     * @return $this
     */
    public function unset_export() {
        return $this->unsetExport();
    }

    /**
     * @param array $fields
     * @return $this
     */
    public function unset_fields($fields) {
        return $this->unsetFields($fields);
    }

    /**
     * @return $this
     */
    public function unset_jquery() {
        return $this->unsetJquery();
    }

    /**
     * @return $this
     */
    public function unset_jquery_ui() {
        return $this->unsetJqueryUi();
    }

    /**
     * @return $this
     */
    public function unset_operations() {
        return $this->unsetOperations();
    }

    /**
     * @return $this
     */
    public function unset_print() {
        return $this->unsetPrint();
    }

    /**
     * @return $this
     */
    public function unset_read() {
        return $this->unsetRead();
    }

    /**
     * @param array $fields
     * @return $this
     */
    public function unset_texteditor($fields) {
        return $this->unsetTexteditor($fields);
    }

}