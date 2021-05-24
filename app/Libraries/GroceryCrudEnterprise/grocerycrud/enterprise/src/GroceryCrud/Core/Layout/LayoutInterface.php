<?php
namespace GroceryCrud\Core\Layout;

interface LayoutInterface
{
	public function getThemeName();

	public function setCssFile($css_file);

	public function setJavaScriptFile($javascript_file);

}