<?php

class chatroom_shortcode {
	
	function __init() {
		
		add_shortcode( 'ng-chatroom', array( $this, 'do_chat_room' ) );
		
	}
	
	function do_chat_room( $atts ) {
		$a = shortcode_atts( array(
			'id' => ''
			), $atts );
		
		ob_start();
		if($a['id'] == ''){
			echo '<p>post_id must be set in shortcode to display chat room</p>';
			
		} else {
			$content = '<h2>Testing: '.$a['id'].'</h2>';
			$content = '<div ng-app="chat_app" ng-controller="chat_controller" ng-init="startChat('.$a['id'].')">';
				$content .= file_get_contents( CHATROOM_PLUGIN_PATH.'inc/chatroom.tpl.html' );	
			$content .= '</div>';
			echo $content;
		}
		return ob_get_clean();
	}
}

?>