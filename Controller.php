<?php
/**
 * FormFunnel Controller
 *
 * @author     Tim Lochmüller <tim@fruit-lab.de>
 */

namespace Piwik\Plugins\FormFunnel;

use Piwik\View;

/**
 * FormFunnel Controller
 *
 * @author     Tim Lochmüller <tim@fruit-lab.de>
 */
class Controller {

	/**
	 * Add action
	 */
	function add() {
		$view = new View('@FormFunnel/Add');

		return $view->render();
	}
} 