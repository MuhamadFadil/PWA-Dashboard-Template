<?php

namespace GroceryCrud\Core\Helpers;


class ArrayHelper
{
    public static function array_reject_value(array &$arrayToFilter, $deleteValue) {
        $filteredArray = array();

        foreach ($arrayToFilter as $key => $value) {
            if ($value !== $deleteValue) {
                $filteredArray[] = $value;
            }
        }

        return $filteredArray;
    }

    public static function array_reject(array &$arrayToFilter, callable $rejectCallback) {

        $filteredArray = array();

        foreach ($arrayToFilter as $key => $value) {
            if (!$rejectCallback($value, $key)) {
                $filteredArray[] = $value;
            }
        }

        return $filteredArray;
    }
}