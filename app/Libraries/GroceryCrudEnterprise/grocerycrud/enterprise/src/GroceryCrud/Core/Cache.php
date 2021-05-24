<?php

namespace GroceryCrud\Core;

use Zend\Cache\StorageFactory;



class Cache
{
    protected $_cache;
    protected $_config;

    function __construct($config)
    {
        $this->_config = $config;
    }

    /**
     * @return \Zend\Cache\Storage\StorageInterface
     */
    function getCache()
    {
        //Lazy Loading...
        if ($this->_cache === null) {
            $this->_cache = StorageFactory::factory($this->_config['cache']);
        }

        return $this->_cache;
    }

    function setItem($name, $value)
    {
        $this->getCache()->setItem($name, $value);
    }

    function getItem($name)
    {
        return $this->getCache()->getItem($name);
    }
}