<?php defined('SYSPATH') or die('No direct script access.');

class Mobile_Controller extends Kohana_Controller_Template {
	
	public $is_mobile = False;
	
	public function before()
	{
		$this->is_mobile = Mobile::getInstance()->isMobile();
		parent::before();
	}
	
	public function after()
	{
		parent::after();
	}
	
}
