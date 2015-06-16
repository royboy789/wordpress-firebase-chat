<?php
/**
* Plugin Name: Chat Rooms powered by Firebase
* Plugin URI:  http://www.roysivan.com
* Description: Using Firebase to create chat rooms
* Version:     2.0
* Author:      Roy Sivan
* Author URI:  http://www.roysivan.com
* Text Domain: firechatroom
* License:     GPLv3
*/

define( 'CHATROOM_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'CHATROOM_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'CHATROOM_PLUGIN_VERSION', '0.1' );

require_once CHATROOM_PLUGIN_PATH . 'plugin.php';
require_once CHATROOM_PLUGIN_PATH . 'inc/init.php';
require_once CHATROOM_PLUGIN_PATH . 'inc/admin-menu.php';
require_once CHATROOM_PLUGIN_PATH . 'inc/template-loader.php';
require_once CHATROOM_PLUGIN_PATH . 'inc/shortcodes.php';

function fire_chat() {
	static $plugin;
	if ( is_null( $plugin ) ) {
		$plugin = new fire_chat();
	}
	return $plugin;
}

add_action( 'plugins_loaded', 'fire_chat' );
