<?php
namespace GroceryCrud\Core\Render;

class RenderAbstract {

    /**
     * This is the HTML output that will be shown to the end user as a string.
     *
     * @var string
     */
    public $output = '';

    /**
     * @var bool
     */
    public $isJSONResponse = false;

    /**
     * This is the output as object so we can manually use it for other purposes
     * (e.g. unit tests, JSON data... e.t.c.)
     *
     * @var string
     */
    public $outputAsObject;

    /**
     * These are the JS files that need to be rendered to the end user
     *
     * @var array
     */
    public $js_files = array();


    /**
     * These are the CSS files that need to be rendered to the end user
     *
     * @var array
     */
    public $css_files = array();


}