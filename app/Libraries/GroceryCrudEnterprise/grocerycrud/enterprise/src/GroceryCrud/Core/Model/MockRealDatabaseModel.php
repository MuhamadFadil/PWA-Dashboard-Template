<?php

namespace GroceryCrud\Core\Model;

use \GroceryCrud\Core\Model;
use Zend\Db\Adapter\Adapter;

class MockRealDatabaseModel extends Model {

    public function setDatabaseConnection($configDb) {
        $this->adapter = new Adapter([
            'driver' => 'Pdo_Mysql',
            'database' => 'unit_test_database',
            'username' => 'john',
            'password' => 'C6VzvB4x5h9XKecS',
            'charset' => 'utf8'
        ]);
    }
}