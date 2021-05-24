<?php

namespace GroceryCrud\Core\Profiler;

use Zend\Db\Adapter\Profiler\Profiler;

class FileProfiler extends Profiler
{
    /**
     * @return Profiler
     */
    public function profilerFinish()
    {
        parent::profilerFinish();

        file_put_contents("Logs/db-logs.log", print_r($this->getLastProfile(), true), FILE_APPEND);

        return $this;
    }
}