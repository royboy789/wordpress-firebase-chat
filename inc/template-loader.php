<?php

class _chatroom_tpl {

	function __init() {
		add_filter( 'the_content', array( $this, 'chat_template' ), 20 );
	}

	public function chat_template( $content ) {
		if ( 'chatrooms' !== get_post_type() ) {
			return $content;
		}
		if ( ! get_option( '_chatroom_firebase_url', false ) ) {
			return '<p>You need to setup your Firebase URL first</p>';
		}
		$content  = '<div ng-app="chat_app" ng-controller="chat_controller" ng-init="startChat(' . get_the_ID() . ')">';
		$content .= $this->get_template();
		$content .= '</div>';
		return $content;
	}

	public function get_template() {
		$theme_tpl = locate_template( 'firebase-chat/chatroom.php' );
		ob_start();
		if ( $theme_tpl ) {
			require_once $theme_tpl;
		} else {
			require_once CHATROOM_PLUGIN_PATH . 'templates/chatroom.php';
		}
		return ob_get_clean();
	}

}
