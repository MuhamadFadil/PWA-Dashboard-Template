<?php

namespace GroceryCrud\Core\Helpers;


class BlobFieldTypeHelper
{
    /**
     * @param string $fieldType
     * @return string
     */
    public static function getFilesizeFromFieldType($fieldType) {

        $fieldType = strtolower($fieldType);

        switch ($fieldType) {
            case 'tinyblob' :
                return '256B';
            case 'blob' :
                return '65K';
            case 'mediumblob' :
                return '16M';
            case 'longblob' :
                return '4G';
        }

        // The default value is the BLOB type
        return '65K';
    }
}