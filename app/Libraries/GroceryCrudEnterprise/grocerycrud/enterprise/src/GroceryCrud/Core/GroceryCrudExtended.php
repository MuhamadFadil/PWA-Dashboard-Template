<?php
namespace GroceryCrud\Core;
use GroceryCrud\Core\GroceryCrud;

/**
 * This is basically to use it with much more functions in order to extend the grocery CRUD functionality without
 * touching the Core functionality of grocery CRUD
 *
 * Class GroceryCrudExtended
 * @package GroceryCrud\Core
 */
class GroceryCrudExtended extends GroceryCrud
{
    public function __construct($config, $database = null)
    {
        parent::__construct([
            'assets_folder' => '',
            'environment' => 'production'
        ]);
    }
}
