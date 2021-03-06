<?php
/*
 * This file is part of WBF Framework: https://github.com/wagaweb/wbf
 *
 * @author WAGA Team <dev@waga.it>
 */

namespace WBF\components\pluginsframework;

require_once dirname(dirname(dirname(dirname(__FILE__))))."/vendor/autoload.php";

/*
 * The following autoloader is now deprecated
 */

//spl_autoload_register( 'WBF\includes\pluginsframework\plugin_autoload' );

function plugin_autoload( $class ) {
	$wbf_path = defined("WBF_DIRECTORY") ? WBF_DIRECTORY : get_option( "wbf_path" );

	if(!is_file($wbf_path."/vendor/autoload.php")){
		$wbf_path = WP_CONTENT_DIR."/plugins/wbf";
	}

	if(!is_file($wbf_path."/vendor/autoload.php")){
		throw new \Exception("Plugins framework: WBF Not Found");
	}

	require_once $wbf_path."/vendor/autoload.php";

	if ( $wbf_path ) {
		$plugin_main_class_dir = $wbf_path . "/includes/pluginsframework/";

		if ( preg_match( "/pluginsframework/", $class ) ) {
			$childclass = explode('\\', $class);
			$name = end($childclass);
			require_once( $plugin_main_class_dir.$name.'.php');
		}

		switch($class){
			case "WBF\admin\Notice_Manager":
				require_once($wbf_path . "/admin/notice-manager.php");
				break;
			case "WBF\includes\pluginsframework\License_Interface":
				require_once($wbf_path . "/includes/license-interface.php");
				break;
			case "WBF\includes\License_Interface":
				require_once($wbf_path . "/includes/license-interface.php");
				break;
			case "WBF\admin\License_Manager":
				require_once($wbf_path . "/admin/license-manager.php");
				break;
			case "WBF\includes\License":
				require_once($wbf_path . "/includes/class-license.php");
				break;
			case "WBF\includes\License_Exception":
				require_once($wbf_path . "/includes/class-license-exception.php");
				break;
			case "WBF\includes\Plugin_Update_Checker":
				require_once($wbf_path . "/includes/plugin-update-checker.php");
				break;
			case "PluginUpdateChecker":
			case "PluginUpdate":
			case "PluginInfo":
			case "PluginUpdateChecker_1_6":
			case "PluginInfo_1_6":
			case "PluginUpdate_1_6":
			case "PucFactory":
				require_once($wbf_path . "/vendor/yahnis-elsts/plugin-update-checker/plugin-update-checker.php");
				break;
		}
	}
}