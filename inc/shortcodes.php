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

		fire_chat()->load_scripts();

		$template = new _chatroom_tpl;

		if ( '' === $args['id'] ) {
			return '<p>post_id must be set in shortcode to display chat room</p>';
		}
		$content  = '<div ng-app="chat_app" ng-controller="chat_controller" ng-init="startChat(' . absint( $args['id'] ) . ')">';
		$content .= $template->get_template();
		$content .= '</div>';
		return $content;
	}
}
