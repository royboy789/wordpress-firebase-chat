<?php
	
	class _chatroom_tpl {
		
		function __construct() {
			add_filter( 'the_content', array( $this, '_chatTemplate' ), 20 );
		}
		
		function _chatTemplate( $content ) {
			if( 'chatrooms' === get_post_type() ) {
				global $post;
				
				if( get_option( '_chatroom_firebase_url', false ) ) {
					$content = '<div ng-app="chat_app" ng-controller="chat_controller" ng-init="startChat('.$post->ID.')">';
						$content .= file_get_contents( CHATROOM_PLUGIN_PATH.'inc/chatroom.tpl.html' );	
					$content .= '</div>';
				} else {
					$content = '<p>You need to setup your Firebase URL first</p>';
				}
				
				
			}
			return $content;		
		}
		
	}