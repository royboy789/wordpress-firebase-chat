<?php
/**
* Plugin Name: Chat Rooms powered by Firebase
* Plugin URI: http://www.roysivan.com
* Description: Using Firebase to create chat rooms
* Version: 1.1
* Author: Roy Sivan
* Author URI: http://www.roysivan.com
* Text Domain: firechatroom
* License: GPLv3
*/

define( 'CHATROOM_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'CHATROOM_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'CHATROOM_PLUGIN_VERSION', '0.1' );

require_once CHATROOM_PLUGIN_PATH . 'inc/init.php';
require_once CHATROOM_PLUGIN_PATH . 'inc/admin-menu.php';
require_once CHATROOM_PLUGIN_PATH . 'inc/chatroom-template.php';
require_once CHATROOM_PLUGIN_PATH . 'inc/shortcodes.php';

class fire_chat {

	function __construct() {
		new fireInit();
		new chat_admin_menu();
		new _chatroom_tpl();

		$shortcode = new chatroom_shortcode();
		$shortcode->__init();
		self::wp_hooks();
	}

	protected function wp_hooks() {
		add_action( 'admin_init', array( $this, 'wpapi_check' ) );
		add_action( 'admin_init', array( $this, 'angular_check' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'scripts' ) );
	}

	/** JSON REST API CHECK **/
	function wpapi_check() {
		if ( ! is_plugin_active( 'json-rest-api/plugin.php' ) ) {
			add_action( 'admin_notices', array( $this, 'chat_wpapi_error' ) );
		}
	}

	function wpapi_error() {
		echo '<div class="error"><p><strong>JSON REST API</strong> must be installed and activated for the <strong>Chat Rooms</strong> plugin to work properly - <a href="https://wordpress.org/plugins/json-rest-api/" target="_blank">Install Plugin</a></p></div>';
	}

	/** ANGULARJS FOR WP CHECK **/
	function angular_check() {
		if ( ! is_plugin_active( 'angularjs-for-wp/plugin.php' ) ) {
			add_action( 'admin_notices', array( $this, 'chat_angular_error' ) );
		}
	}

	function angular_error() {
		echo '<div class="error"><p><strong>AngularJS For WP</strong> must be installed and activated for the <strong>Chat Rooms</strong> plugin to work properly - <a href="https://wordpress.org/plugins/angularjs-for-wp/" target="_blank">Install Plugin</a></p></div>';
	}

	function scripts() {
		wp_enqueue_script(
			'angular-resource-library',
			'//ajax.googleapis.com/ajax/libs/angularjs/1.3.5/angular-resource.min.js',
			array( 'fireBase' ),
			'1.3.5',
			false
		);

		// Firebase
		wp_enqueue_script(
			'fireBase',
			'//cdn.firebase.com/js/client/2.0.4/firebase.js',
			array( 'angular-core' ),
			null,
			false
		);

		wp_enqueue_script(
			'angFire',
			'//cdn.firebase.com/libs/angularfire/0.9.2/angularfire.min.js',
			array( 'fireBase' ),
			null,
			false
		);

		wp_enqueue_script(
			'angular-chatroom-app',
			CHATROOM_PLUGIN_URL.'js/chatroom_app.js',
			array( 'angular-resource-library' ),
			CHATROOM_PLUGIN_VERSION,
			false
		);
		wp_localize_script(
			'angular-chatroom-app',
			'fireData',
			array(
				'fire_url' => get_option( '_chatroom_firebase_url', false ),
			)
		);
	}
}


// PLUGIN INIT
new fire_chat();
