<?php
/**
 * FormFunnel API
 *
 * @author     Tim Lochmüller <tim@fruit-lab.de>
 */


namespace Piwik\Plugins\FormFunnel;

/**
 * FormFunnel API
 *
 * @author     Tim Lochmüller <tim@fruit-lab.de>
 */

class API {

	/**
	 * Local instance of the API
	 *
	 * @var API
	 */
	static private $instance = NULL;

	/**
	 * Make construct private, so you have to use the getInstance method
	 */
	private function __construct() {
		// do nothing
	}

	/**
	 * Create a instance of the API
	 *
	 * @return API
	 */
	static public function getInstance() {
		if (self::$instance == NULL) {
			$c = __CLASS__;
			self::$instance = new $c();
		}
		return self::$instance;
	}

	public function addFunnel(){

	}

	public function removeFunnel(){

	}

	public function updateFunnel(){


	}
} 