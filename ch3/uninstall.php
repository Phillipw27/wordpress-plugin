<?php 
//Check that code was called from Wordpress with uninstallation constant declared
//Uninstall plugin from wordpress
if(!defined('WP_UNINSTALL_PLUGIN')){
	exit;
}
//Check if options exist and delete them if present
if(false != get_option('ch2pho_options')){
	delete_option('ch2pho_options');
}