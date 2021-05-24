<?php

namespace GroceryCrud\Core;

use Valitron\Validator;
use GroceryCrud\Core\Validate\ValidateInterface;

class Validate implements ValidateInterface
{
    public $_rules = [];
    public $_data = [];
    public $_errors = [];
    public $_labels = [];
    public $_uniqueCallback;

    function __construct($config)
    {

    }

    public function set_language($language) {
        $valitronLanguage = $this->_get_language_mapping($language);

        Validator::lang($valitronLanguage);
    }

    public function set_data($data)
    {
        $this->_data = $data;
        return $this;
    }

    public function set_label($field_name, $label)
    {
        $this->_labels[$field_name] = $label;
    }

    public function set_rule($field_name, $rule, $parameters = null)
    {
        $this->_rules[] = [
            'fieldName' => $field_name,
            'rule' => $rule,
            'parameters' => $parameters
        ];
    }

    public function set_errors($errors)
    {
        $this->_errors = $errors;
    }

    public function getErrors()
    {
        return $this->_errors;
    }

    public function setUniqueCallback(callable $uniqueCallback) {
        $this->_uniqueCallback = $uniqueCallback;

        return $this;
    }

    public function pre_render()
    {
        if ($this->_uniqueCallback !== null) {
            Validator::addRule('unique', $this->_uniqueCallback, 'must contain a unique value.');
        }
    }

    public function validate()
    {
        if (empty($this->_rules)) {
            return true;
        }

        $this->pre_render();

        $validator = new Validator($this->_data);

        if (!empty($this->_labels)) {
            $validator->labels($this->_labels);
        }

        foreach ($this->_rules as $rule) {
            if (is_array($rule['parameters'])) {

                if (count($rule['parameters']) === 1) {
                    $validator->rule($rule['rule'], $rule['fieldName'], $rule['parameters'][0]);
                } else if (count($rule['parameters']) === 2) {
                    $validator->rule($rule['rule'], $rule['fieldName'], $rule['parameters'][0], $rule['parameters'][1]);
                } else if (count($rule['parameters']) === 3) {
                    $validator->rule($rule['rule'], $rule['fieldName'], $rule['parameters'][0], $rule['parameters'][1], $rule['parameters'][3]);
                } else {
                    throw new \Exception('Validate doesn\'t support more than 3 parameters');
                }

            } else {
                $validator->rule($rule['rule'], $rule['fieldName'], $rule['parameters']);
            }

        }

        if($validator->validate()) {
            return true;
        } else {
            $this->set_errors($validator->errors());
            return false;
        }
    }

    private function _get_language_mapping($language) {

        // Most common scenario
        if ($language === 'English') {
            return 'en';
        }

        $languageMapping = [
            'German' => 'de',
            'Bulgarian' => 'bg',
            'Dutch' => 'nl',
            'pt-BR.Portuguese' => 'pt-br',
            'Indonesian' => 'id',
            'Lithuanian' => 'lt',
            'Polish' => 'pl',
            'Slovak' => 'sk',
            'Greek' => 'el',
            'Turkish' => 'tr'
        ];

        if (array_key_exists($language, $languageMapping)) {
            return $languageMapping[$language];
        }

        $short_lang = strtolower(substr($language, 0, 2));

        // Full list of languages supported from here:
        // https://github.com/vlucas/valitron/tree/master/lang
        if (in_array($short_lang, [
            'ar','es',
            'fr','it','ja',
            'ko','no','ro',
            'ru','sk','th',
            'tr','uk','vi'
        ])) {
            return $short_lang;
        }

        return 'en';
    }
}