<?php
/**
 * FormFunnel Plugin
 *
 * @author     Tim Lochmüller <tim@fruit-lab.de>
 */

namespace Piwik\Plugins\FormFunnel;

use Piwik\Common;
use Piwik\Db;
use Piwik\DbHelper;
use Piwik\Menu\MenuMain;
use Piwik\Plugin;

/**
 * FormFunnel Plugin
 *
 * @author     Tim Lochmüller <tim@fruit-lab.de>
 */
class FormFunnel extends Plugin {

	/**
	 * Register same hooks
	 */
	public function getListHooksRegistered() {
		return array(
			'AssetManager.getJavaScriptFiles' => 'getJsFiles',
			'AssetManager.getStylesheetFiles' => 'getStylesheetFiles',
			'Menu.Reporting.addItems'         => 'addMenus',
		);
	}

	/**
	 * Add style sheets
	 *
	 * @param $stylesheets
	 */
	public function getStylesheetFiles(&$stylesheets) {
		$stylesheets[] = "plugins/FormFunnel/stylesheets/FormFunnel.css";
	}

	/**
	 * Add JavaScripts
	 *
	 * @param $jsFiles
	 */
	public function getJsFiles(&$jsFiles) {
		$jsFiles[] = "plugins/FormFunnel/javascripts/FormFunnel.js";
	}

	function addMenus() {
		$idSite = Common::getRequestVar('idSite');
		#$funnels = API::getInstance()
		#              ->getFunnels($idSite);
		#$goalsWithoutFunnels = API::getInstance()
		#                          ->getGoalsWithoutFunnels($idSite);
		#
		$funnels = array();
		$mainMenu = MenuMain::getInstance();


		if (count($funnels) == 0) {
			$mainMenu->add('FormFunnel', 'FormFunnel_Add', array(
				'module' => 'FormFunnel',
				'action' => 'add'
			));
		} else {
			$mainMenu->add('FormFunnel', 'FormFunnel_Overview', array('module' => 'FormFunnel'));
			foreach ($funnels as $funnel) {
				$mainMenu->add('FormFunnel', str_replace('%', '%%', $funnel['goal_name']), array(
					'module'   => 'FormFunnel',
					'action'   => 'report',
					'idFunnel' => $funnel['idfunnel']
				));
			}

		}
	}

	/**
	 * Install database tables
	 */
	public function install() {
		foreach ($this->getDatabaseDefinitions() as $table => $definition) {
			DbHelper::createTable($table, $definition);
		}
	}

	/**
	 * Uninstall database tables
	 */
	public function uninstall() {
		$tableNames = array_keys($this->getDatabaseDefinitions());
		foreach ($tableNames as $tableName) {
			Db::dropTables(Common::prefixTable($tableName));
		}
	}

	/**
	 * Get the table definition of the plugin
	 *
	 * @return array
	 */
	protected function getDatabaseDefinitions() {
		return array(
			'funnel' => '`idsite` int(11) NOT NULL,
		                  `idgoal` int(11) NOT NULL,
		            	  `idfunnel` int(11) NOT NULL,
		 				  `deleted` tinyint(4) NOT NULL default \'0\',
		                   PRIMARY KEY  (`idsite`,`idgoal`, `idfunnel`)'
		);
	}
}