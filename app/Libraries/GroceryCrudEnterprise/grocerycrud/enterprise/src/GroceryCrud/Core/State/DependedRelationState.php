<?php
namespace GroceryCrud\Core\State;

use GroceryCrud\Core\Exceptions\Exception;
use GroceryCrud\Core\GroceryCrud as GCrud;
use GroceryCrud\Core\Render\RenderAbstract;
use GroceryCrud\Core\Model;

class DependedRelationState extends StateAbstract {

    /**
     * MainState constructor.
     * @param GCrud $gCrud
     */
    function __construct(GCrud $gCrud)
    {
        $this->gCrud = $gCrud;
    }

    public function getStateParameters()
    {
        return (object)array(
            'fieldName' => !empty($_GET['field_name']) ? $_GET['field_name'] : null,
            'searchValue' => !empty($_GET['search_value']) ? $_GET['search_value'] : ''
        );
    }

    public function render()
    {
        $stateParameters = $this->getStateParameters();
        $fieldName = $stateParameters->fieldName;
        $searchValue = $stateParameters->searchValue;

        if (!$fieldName) {
            throw new \Exception('field_name parameter is required');
        }

        if (!$searchValue) {
            $relationalData = [];
        } else {
            $this->setModel();

            $dependedRelations = $this->gCrud->getDependedRelation();
            $relationWithDependencies = $this->gCrud->getRelationWithDependencies();
            $relations = $this->gCrud->getRelations1toMany();

            if (array_key_exists($fieldName, $relationWithDependencies)) {
                $dependedFieldName = $relationWithDependencies[$fieldName];
                $relation = $relations[$dependedFieldName];
                $relationalData = $this->getRelationalData(
                    $relation->tableName,
                    $relation->titleField,
                    [
                        $dependedRelations[$dependedFieldName]->fieldNameRelation => $searchValue
                    ],
                    $relation->orderBy
                );
            }
        }

        $output = (object) [
            'total_count' => count($relationalData),
            'items' => $relationalData
        ];

        $output = $this->addcsrfToken($output);

        $render = new RenderAbstract();

        $render->output = json_encode($output);
        $render->outputAsObject = $output;
        $render->isJSONResponse = true;

        return $render;

    }

}