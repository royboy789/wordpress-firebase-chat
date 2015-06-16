<?php

class chatroom_shortcode {

	function __init() {
		add_shortcode( 'ng-chatroom', array( $this, 'do_chat_room' ) );
	}

	function do_chat_room( $atts ) {
		$args = shortcode_atts(
			array(
				'id' => '',
			),
			$atts
		);

		wp_enqueue_script( 'angular-resource-library' );
		wp_enqueue_script( 'fireBase' );
		wp_enqueue_script( 'angFire' );
		wp_enqueue_script( 'angular-chatroom-app' );

		ob_start();
		if ( '' === $args['id'] ) {
			echo '<p>post_id must be set in shortcode to display chat room</p>';
		} else {
			$content = '<h2>Testing: ' . $args['id'] . '</h2>';
			$content = '<div ng-app="chat_app" ng-controller="chat_controller" ng-init="startChat(' . $args['id'] . ')">';
				$content .= file_get_contents( CHATROOM_PLUGIN_PATH . 'inc/chatroom.tpl.html' );
			$content .= '</div>';
			echo $content;
		}
		return ob_get_clean();
	}
}
