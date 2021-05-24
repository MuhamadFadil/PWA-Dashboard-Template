<?php

namespace GroceryCrud\Core\State;

use GroceryCrud\Core\GroceryCrud as GCrud;

class StateFactory
{

    /**
     * @param $stateName
     * @param \GroceryCrud\Core\GroceryCrud $groceryCrudObject
     * @return StateInterface
     */
    public function getStateClass($stateName, GCrud $groceryCrudObject)
    {
        $stateClassName = __NAMESPACE__ . '\\' . $stateName . 'State';

        return new $stateClassName($groceryCrudObject);
    }
}