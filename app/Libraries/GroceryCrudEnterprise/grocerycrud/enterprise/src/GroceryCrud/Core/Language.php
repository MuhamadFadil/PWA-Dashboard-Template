<?php
namespace GroceryCrud\Core;

class Language {
    private $_language;

    /**
     *
     * Just an alias to getTranslatedString method
     * @param string $handle
     */
    public function t($handle)
    {
        return $this->getTranslatedString($handle);
    }

    /**
     *
     * Get the language string of the inserted string handle
     * @param string $handle
     */
    public function getTranslatedString($handle)
    {
        return $this->lang_strings[$handle];
    }

    /**
     *
     * Simply set the language
     * @example english
     * @param string $language
     */
    public function setLanguage($language)
    {
        $this->_language = $language;
    }
}