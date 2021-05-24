<?php
namespace App\Controllers;
// public $systemDirectory = __DIR__ . '/../../system';
include(APPPATH . 'Libraries/GroceryCrudEnterprise/autoload.php');
use GroceryCrud\Core\GroceryCrud;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 *
 * @package CodeIgniter
 */

use CodeIgniter\Controller;

echo '<link rel="manifest" href="/manifest.json">';
echo '<link rel="serviceworker" href="/sw.js">';

class BaseController extends Controller
{

	/**
	 * An array of helpers to be loaded automatically upon
	 * class instantiation. These helpers will be available
	 * to all other controllers that extend BaseController.
	 *
	 * @var array
	 */
	protected $helpers = [];

	/**
	 * Constructor.
	 */
	public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
	{
		// Do Not Edit This Line
		parent::initController($request, $response, $logger);

		//--------------------------------------------------------------------
		// Preload any models, libraries, etc, here.
		//--------------------------------------------------------------------
		// E.g.:
		// $this->session = \Config\Services::session();
		helper('custom_helper');
	}
	
	//tiga method ini kepake buat groceryCrud
	protected function _getDbData() {
		$db = (new \Config\Database())->default;
		return ['adapter' => [
			'driver' => 'MySQLi',
			'host'     => $db['hostname'],
			'database' => $db['database'],
			'username' => $db['username'],
			'password' => $db['password'],
			'charset' => 'utf8'
			]
		];
	}
	protected function _getGroceryCrudEnterprise($bootstrap = true, $jquery = true) {
		$db = $this->_getDbData();
		$config = (new \Config\GroceryCrudEnterprise())->getDefaultConfig();
		$groceryCrud = new GroceryCrud($config, $db);
		return $groceryCrud;
	}
	protected function _example_output($output = null,$o = null) {
    if (isset($output->isJSONResponse) && $output->isJSONResponse) {
			header('Content-Type: application/json; charset=utf-8');
			echo $output->output;
			exit;
    }
		$x = (array)$output;
		if(!is_null($o)){ //$o must be an array
			$x = array_replace($x, $o);
		}
		return view('common_crud', $x);
	}
}?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="serviceworker-register" href="/sw-register.js">

  <script>
  if ('serviceWorker' in navigator) {
  window.addEventListener('load', function() {
    navigator.serviceWorker.register('/sw.js').then(function(registration) {
      // Registration was successful
      console.log('ServiceWorker registration successful with scope: ', registration.scope);
    }, function(err) {
      // registration failed :(
      console.log('ServiceWorker registration failed: ', err);
    });
  });
    }else {
        console.log("No ServiceWorker for you :(");
    }
  </script>
</head>
