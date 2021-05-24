<?php
namespace GroceryCrud\Core\State;

class PrintState extends DatagridState {

    const MAX_AMOUNT_OF_PRINT = 500;

    public function getStateParameters()
    {
        $stateParameters = parent::getStateParameters();

        $stateParameters->per_page = PrintState::MAX_AMOUNT_OF_PRINT;

        return $stateParameters;
    }
}