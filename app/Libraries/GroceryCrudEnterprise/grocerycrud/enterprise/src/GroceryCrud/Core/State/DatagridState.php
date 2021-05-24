<?php
namespace GroceryCrud\Core\State;

use GroceryCrud\Core\GroceryCrud as GCrud;
use GroceryCrud\Core\Render\RenderAbstract;

class DatagridState extends StateAbstract {

    const FILTER_CONTAINS = 'contains';
    const FILTER_EQUALS = 'equals';
    const FILTER_STARTS_WITH = 'starts_with';
    const FILTER_ENDS_WITH = 'ends_with';
    const FILTER_HAS = 'has';
    const FILTER_HAS_NOT = 'does_not_have';
    const FILTER_NOT_EQUALS = 'not_equals';
    const FILTER_GREATER_THAN = 'greater_than';
    const FILTER_GREATER_OR_EQUAL = 'greater_than_or_equal';
    const FILTER_LESS_THAN = 'less_than';
    const FILTER_LESS_OR_EQUAL = 'less_than_or_equal';
    const FILTER_EMPTY = 'is_empty';
    const FILTER_NOT_EMPTY = 'is_not_empty';

    /**
     * DatagridState constructor.
     * @param \GroceryCrud\Core\GroceryCrud $gCrud
     * @throws \GroceryCrud\Core\Exceptions\Exception
     */
    function __construct(GCrud $gCrud)
    {
        $this->gCrud = $gCrud;
        $this->setModel();
    }

    public function getStateParameters()
    {
        $data = !empty($_POST) ? $_POST : $_GET;

        return (object)array(
            'search' => $this->getSearchData(false),
            'extended_search' => $this->getExtendedSearchData(),
            'basic_operator' => !empty($data['basic_operator']) ? $data['basic_operator'] : null,
            'page' => !empty($data['page']) && is_numeric($data['page']) ? $data['page'] : null,
            'per_page' => !empty($data['per_page']) ? $data['per_page'] : null,
            'sorting' => !empty($data['sorting']) ? $data['sorting'] : null,
            'order_by' => !empty($data['order_by']) ? $data['order_by'] : null
        );
    }

    protected function _getFieldsForEqualSearch() {
        $fieldsForEqualSearch = array_keys($this->gCrud->getRelations1toMany());

        $fieldTypes = $this->getFieldTypes(false);

        foreach ($fieldTypes as $fieldName => $fieldType) {
            switch ($fieldType->dataType) {
                case 'enum':
                case 'enum_searchable':
                case 'dropdown':
                case 'dropdown_search':
                    $fieldsForEqualSearch = array_merge([$fieldName], $fieldsForEqualSearch);
                    break;
            }
        }

        return $fieldsForEqualSearch;
    }

    public function getSearchData($includePermittedValues = true) {
        $data = !empty($_POST) ? $_POST : $_GET;

        $searchData = !empty($data['search']) ? $data['search'] : null;
        $dateFields = array_merge($this->getColumnDateFields($includePermittedValues), $this->getColumnDatetimeFields($includePermittedValues));

        $dateFormatData = $this->getDateFormatData();

        $dateNeedsFormatting = $dateFormatData->dateNeedsFormatting;

        if ($dateNeedsFormatting) {
            $dateRegex = $dateFormatData->dateRegex;
            $replacementString = $dateFormatData->replacementString;

            if ($searchData !== null) {
                foreach ($searchData as $searchName => $searchValue) {
                    if (in_array($searchName, $dateFields)) {
                        $searchData[$searchName] = preg_replace($dateRegex, $replacementString, $searchValue);
                    }
                }
            }
        }

        // If the search data are coming from fields that we know the values (such as relation) we need
        // to always add the equal sign at the beginning (so we will NOT search with LIKE %% )
        $fieldsForEqualSearch = $this->_getFieldsForEqualSearch();

        // Filter by the columns list as we don't want to search not visible to the user data
        $columns = $this->getColumns();
        $finalSearchData = [];
        if ($searchData !== null) {
            foreach ($searchData as $columnName => $searchValue) {
                if (in_array($columnName, $columns)) {
                    $finalSearchData[$columnName] = $searchValue;
                }


                // Search for relational data and add the equal at the beginning so we will always have
                // only a query with equal (and not with LIKE %%) for better performance
                if (in_array($columnName, $fieldsForEqualSearch)) {
                    $finalSearchData[$columnName] = preg_match('/^=/', $searchValue) ? $searchValue : '=' . $searchValue;
                }
            }
        }

        $mappedColumns = $this->getMappedColumns();

        foreach ($mappedColumns as $columnName => $mappedField) {
            if (array_key_exists($columnName, $finalSearchData)) {
                $finalSearchData[$mappedField] = $finalSearchData[$columnName];
                unset($finalSearchData[$columnName]);
            }
        }

        if (empty($finalSearchData)) {
            $finalSearchData = null;
        }

        return $finalSearchData;
    }

    public function getExtendedSearchData() {
        $data = !empty($_POST) ? $_POST : $_GET;

        $searchData = !empty($data['extended_search']) &&  $data['extended_search'] !== 'null'
                        ? $data['extended_search']
                        : null;

        $dateFields = array_merge($this->getColumnDateFields(false), $this->getColumnDatetimeFields(false));
        $dateFormatData = $this->getDateFormatData();
        $dateNeedsFormatting = $dateFormatData->dateNeedsFormatting;

        $mappedColumns = $this->getMappedColumns();

        if (!empty($mappedColumns)) {
            if ($searchData !== null) {
                foreach ($searchData as $searchIndex => $searchRow) {
                    if (array_key_exists($searchRow['name'], $mappedColumns)) {
                        $searchData[$searchIndex]['name'] = $mappedColumns[$searchRow['name']];
                    }
                }
            }
        }

        if ($dateNeedsFormatting) {
            $dateRegex = $dateFormatData->dateRegex;
            $replacementString = $dateFormatData->replacementString;

            if ($searchData !== null) {
                foreach ($searchData as &$searchContent) {
                    $fieldName = $searchContent['name'];
                    $fieldValue = !empty($searchContent['value']) ? $searchContent['value'] : null;
                    if ($fieldValue !== null && in_array($fieldName, $dateFields)) {
                        $searchContent['value'] = preg_replace($dateRegex, $replacementString, $fieldValue);
                    }
                }
            }
        }

        // Filter by the columns list as we don't want to search not visible to the user data
        $columns = $this->getColumns();
        $finalSearchData = [];
        if ($searchData !== null) {
            foreach ($searchData as $searchRow) {
                if (in_array($searchRow['name'], $columns)) {
                    $finalSearchData[] = $searchRow;
                }
            }
        }

        if (empty($finalSearchData)) {
            $finalSearchData = null;
        }

        return $finalSearchData;
    }

    public function initialize($stateParameters)
    {
        if ($stateParameters->search !== null) {
            $this->setFilters($stateParameters->search);
        }

        if ($stateParameters->extended_search !== null) {

            $filterOperator = $stateParameters->basic_operator === 'OR' ? 'filtersOr' : 'filtersAnd';

            foreach ($stateParameters->extended_search as $search) {
                if (!isset($this->{$filterOperator}[$search['name']])) {
                    $this->{$filterOperator}[$search['name']] = [];
                }

                if (empty($search['value']) && !in_array($search['filter'], [self::FILTER_EMPTY, self::FILTER_NOT_EMPTY])) {
                    continue;
                }

                switch ($search['filter']) {
                    case self::FILTER_CONTAINS:
                        $this->{$filterOperator}[$search['name']][] = $search['value'];
                        break;

                    case self::FILTER_STARTS_WITH:
                        $this->{$filterOperator}[$search['name']][] = '~' . $search['value'];
                        break;

                    case self::FILTER_ENDS_WITH:
                        $this->{$filterOperator}[$search['name']][] = $search['value'] . '~';
                        break;

                    case self::FILTER_HAS:
                        $this->{$filterOperator}[$search['name']][] = $search['value'];
                        break;

                    case self::FILTER_EQUALS:
                        $this->{$filterOperator}[$search['name']][] = '=' . $search['value'];
                        break;

                    case self::FILTER_NOT_EQUALS:
                    case self::FILTER_HAS_NOT:
                        $this->{$filterOperator}[$search['name']][] = '!=' . $search['value'];
                        break;

                    case self::FILTER_GREATER_THAN:
                        $this->{$filterOperator}[$search['name']][] = '>' . $search['value'];
                        break;

                    case self::FILTER_GREATER_OR_EQUAL:
                        $this->{$filterOperator}[$search['name']][] = '>=' . $search['value'];
                        break;

                    case self::FILTER_LESS_THAN:
                        $this->{$filterOperator}[$search['name']][] = '<' . $search['value'];
                        break;

                    case self::FILTER_EMPTY:
                        $this->{$filterOperator}[$search['name']][] = '=';
                        break;

                    case self::FILTER_NOT_EMPTY:
                        $this->{$filterOperator}[$search['name']][] = '!=';
                        break;

                    case self::FILTER_LESS_OR_EQUAL:
                        $this->{$filterOperator}[$search['name']][] = '<=' . $search['value'];
                        break;
                }
            }
        }
    }

    protected function _getRelationNtoNColumns($columns) {
        $relational_fields = array_keys($this->gCrud->getRelationNtoN());

        $relational_columns = [];
        foreach ($columns as $rowNum => $columnName) {
            if (in_array($columnName, $relational_fields)) {
                $relational_columns[] = $columns[$rowNum];
            }
        }

        return $relational_columns;
    }



    public function setDatagridColumns() {

        $callbackColumns = $this->gCrud->getCallbackColumns();

        // GC-228: In order to solve the problem that not all the row is available in a callback column
        // we did create the below logic so we will get all the columns and filter them at the end
        if (empty($callbackColumns)) {
            $this->setColumns();
        } else {
            $allColumns = $this->getColumnNames();
            $this->gCrud->getModel()->setColumns($this->removeRelationalColumns($allColumns));
        }
    }

    public function getData() {
        $this->setInitialData();

        $stateParameters = $this->getStateParameters();
        $config = $this->getConfigParameters();

        $this->initialize($stateParameters);

        $model = $this->gCrud->getModel();

        $allColumns = $this->getColumns(StateAbstract::WITH_PRIMARY_KEY);

        $this->setDatagridColumns();

        $model->setPrimaryKey($this->getPrimaryKeyName());

        $defaultOrderBy = $this->gCrud->getDefaultOrderBy();

        if ($defaultOrderBy !== null && $stateParameters->order_by === null) {
            $model->setDefaultOrderBy($defaultOrderBy->ordering, $defaultOrderBy->sorting);
        }

        if ($stateParameters->order_by !== null) {
            $model->setOrderBy($stateParameters->order_by);

            if ($stateParameters->sorting !== null) {
                $model->setSorting($stateParameters->sorting);
            }
        }

        if ($stateParameters->per_page !== null) {
            $model->setLimit($stateParameters->per_page);
        } else {
            $model->setLimit($config['default_per_page']);
        }

        if ($stateParameters->page !== null) {
            $model->setPage($stateParameters->page);
        }

        if (!empty($this->filtersAnd)) {
            $model->setAndFilters($this->filtersAnd);
        }

        if (!empty($this->filtersOr)) {
            $model->setOrFilters($this->filtersOr);
        }

        if ($this->gCrud->getWhere() !== null) {
            $model->setWhere($this->gCrud->getWhere());
        }

        $model->setRelationalColumns($this->_getRelationNtoNColumns($allColumns));

        $relations1toN = $this->getRelations1ToN();
        foreach ($relations1toN as $num_row => $relation) {
            if (strstr($relation->titleField, '{')) {
                $relations1toN[$num_row]->originalTitleField = $relation->titleField;
                $relations1toN[$num_row]->titleField = $this->getFieldsArray($relation->titleField);
            }
        }

        $model->setDependedRelation($this->gCrud->getDependedRelation());
        $model->setRelations1ToN($this->getRelations1ToN());
        $model->setRelationNToN($this->getRelationsNToN());

        $model = $this->gCrud->getModel();

        $results = $model->getList();

        $output = (object)array();
        $output->filtered_total = $model->getTotalItems();
        $output->data = $results;

        return $output;
    }

    public function render()
    {
        $output = $this->getData();
        $output->data = $this->enhanceColumnResults($output->data);
        $output->data = $this->filterResults($output->data);
        $output = $this->addcsrfToken($output);

        $render = new RenderAbstract();

        $render->output = json_encode($output);
        $render->outputAsObject = $output;
        $render->isJSONResponse = true;

        return $render;
    }

    public function filterResults($results) {
        $callbackColumns = $this->gCrud->getCallbackColumns();

        // GC-228: If we don't have any callback columns we don't really need to filter the data
        if (empty($callbackColumns)) {
            return $results;
        }

        $columnNames = $this->getColumns(StateAbstract::WITH_PRIMARY_KEY);
        $columnNames[] = 'grocery_crud_extras';
        $finalResults = [];

        foreach ($results as $row) {
            $tmpRow = [];
            foreach ($row as $fieldName => $fieldValue) {
                if (in_array($fieldName, $columnNames)) {
                    $tmpRow[$fieldName] = $fieldValue;
                }
            }
            $finalResults[] = $tmpRow;
        }

        return $finalResults;
    }

    public function _getCommonData()
    {
        $data = (object)array();

        $data->subject 				= $this->gCrud->getSubject();
        $data->subject_plural 		= $this->gCrud->getSubjectPlural();

        return $data;
    }
}