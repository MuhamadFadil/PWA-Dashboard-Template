<?php
namespace GroceryCrud\Core\Model;


class ModelFieldType
{
    /**
     * @var bool
     */
    public $isNullable = false;

    /**
     * @var string
     */
    public $dataType = 'varchar';

    /**
     * @var null|string|array
     */
    public $defaultValue;

    /**
     * @var null|array
     */
    public $permittedValues;

    /**
     * @var null|array
     */
    public $options;

    /**
     * @var bool
     */
    public $isRequired = false;

    /**
     * @var bool
     */
    public $isReadOnly = false;

    /**
     * @param string $dataType
     * @return $this
     */
    public function setDataType($dataType)
    {
        $this->dataType = $dataType;

        return $this;
    }

    /**
     * @param null|array $permittedValues
     * @return $this
     */
    public function setPermittedValues($permittedValues)
    {
        $this->permittedValues = $permittedValues;

        return $this;
    }

    /**
     * @param null|array $options
     * @return $this
     */
    public function setOptions($options)
    {
        $this->options = $options;

        return $this;
    }

    /**
     * @param bool $isNullable
     * @return $this
     */
    public function setIsNullable($isNullable)
    {
        $this->isNullable = $isNullable;

        return $this;
    }
}