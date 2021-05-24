<?php
namespace GroceryCrud\Core;

use GroceryCrud\Core\Layout\LayoutInterface;

class Layout implements LayoutInterface
{
    protected $_ApiUrl;
    protected $_themePath;
    protected $_assetsFolder;
    protected $_themeName 				= null;
    protected $_uniqueId 				= null;
    protected $theme 				    = 'Bootstrap';

    protected $css_files				= array();
    protected $js_files					= array();

    public function __construct($config) {
        $this->_themePath = realpath(dirname ( __FILE__ ) . '/../' . 'Themes') . '/';
        $this->_assetsFolder = $config['assets_folder'];
        $this->_themeName = 'Bootstrap';
    }

    public function setThemePath($themePath) {
        $this->_themePath = $themePath;

        return $this;
    }

    public function getThemePath() {
        return $this->_themePath;
    }

    public function setUniqueId($uniqueId)
    {
        $this->_uniqueId = $uniqueId;
    }

    public function getUniqueId()
    {
        return $this->_uniqueId;
    }

    public function setApiUrl($url){
        $this->_ApiUrl = $url;

        return $this;
    }

    public function getApiUrl()
    {
        if ($this->_ApiUrl !== null) {
            return $this->_ApiUrl;
        }

        if(php_sapi_name() !== 'cli') {
            return str_replace('&amp;', '&', htmlspecialchars($_SERVER['REQUEST_URI'], ENT_QUOTES, 'UTF-8'));
        }

        return '';
    }

    public function getThemeName()
    {
        return $this->_themeName;
    }

    public function setCssFile($css_file)
    {
        $this->css_files[sha1($css_file)] = $css_file;
    }

    public function setJavaScriptFile($js_file)
    {
        $this->js_files[sha1($js_file)] = $js_file;
    }

    public function get_css_files()
    {
        return $this->css_files;
    }

    public function get_js_files()
    {
        return $this->js_files;
    }

    public function setTheme($theme = null)
    {
        $this->theme = $theme;

        return $this;
    }

    public function theme_view($view, $vars = array(), $return = FALSE)
    {
        $vars = (is_object($vars)) ? get_object_vars($vars) : $vars;

        $ext = pathinfo($view, PATHINFO_EXTENSION);
        $file = ($ext == '') ? $view.'.php' : $view;

        $view_file = $this->_themePath . $this->theme.'/views/';

        $path = $view_file . $file;

        if ( !file_exists($path))
        {
            throw new \GroceryCrud\Core\Exceptions\Exception('Unable to load the requested file: '.$path, 16);
        }

        extract($vars);

        #region buffering...
        ob_start();

        include($path);

        $buffer = ob_get_contents();
        @ob_end_clean();
        #endregion

        if ($return === TRUE)
        {
            return $buffer;
        }

        $this->views_as_string .= $buffer;
    }
}
