<?php defined('SYSPATH') OR die('No direct access allowed.');

class Mobile {
	
	private $user_agents_test_match  = array(
        "w3c ", "acs-", "alav", "alca", "amoi", "audi",
        "avan", "benq", "bird", "blac", "blaz", "brew",
        "cell", "cldc", "cmd-", "dang", "doco", "eric",
        "hipt", "inno", "ipaq", "java", "jigs", "kddi",
        "keji", "leno", "lg-c", "lg-d", "lg-g", "lge-",
        "maui", "maxo", "midp", "mits", "mmef", "mobi",
        "mot-", "moto", "mwbp", "nec-", "newt", "noki",
        "xda",  "palm", "pana", "pant", "phil", "play",
        "port", "prox", "qwap", "sage", "sams", "sany",
        "sch-", "sec-", "send", "seri", "sgh-", "shar",
        "sie-", "siem", "smal", "smar", "sony", "sph-",
        "symb", "t-mo", "teli", "tim-", "tosh", "tsm-",
        "upg1", "upsi", "vk-v", "voda", "wap-", "wapa",
        "wapi", "wapp", "wapr", "webc", "winw", "winw",
        "xda-",);
	
	private $http_accept_regex = "|application/vnd\.wap\.xhtml\+xml|";
	
	private $user_agents_text_search = array(
		"up.browser", "up.link", "mmp" ,
		"symbian", "smartphone", "midp", "wap",
		"phone", "windows ce", "pda",
		"mobile", "mini", "palm", "netfront"
	);
	
	private static $instance = Null;
	
	private $is_mobile = Null; 
	
	public function __construct() {
		$this->is_mobile = False;
		if(!isset($_SERVER['HTTP_USER_AGENT'])) return;
		$this->user_agents_test_match = sprintf('/^(%s)/', implode('|', $this->user_agents_test_match));
		if(preg_match($this->user_agents_test_match, $_SERVER['HTTP_USER_AGENT']))
		{
			$this->is_mobile = True;
		} elseif (isset($_SERVER['HTTP_ACCEPT']) && preg_match($this->http_accept_regex, $_SERVER['HTTP_ACCEPT'])) {
			$this->is_mobile = True;
		}
		
		if(!$this->is_mobile)
		{
			$this->user_agents_text_search = sprintf('/^(%s)/', implode('|', $this->user_agents_text_search));
			if(preg_match($this->user_agents_text_search, $_SERVER['HTTP_USER_AGENT']))
			{
				$this->is_mobile = True;
			}		
		}
	}
	
	/**
	 *
	 * @return Mobile 
	 */
	public static function getInstance()
	{
		if(self::$instance === Null)
		{
			self::$instance = new Mobile();
		}
		return self::$instance;
	}
	
	public function isMobile()
	{
		return $this->is_mobile;
	}
	
}