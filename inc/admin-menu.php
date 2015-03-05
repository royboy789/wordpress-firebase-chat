<?php
	
	class chat_admin_menu {
		
		function __construct() {
			add_action( 'admin_menu', array( $this, '_chat_menus' ) );
			add_action( 'admin_init', array( $this, '_save_chat_settings' ) );
		}
		
		function _chat_menus() {
			add_submenu_page( 'edit.php?post_type=chatrooms', 'Chat Room Settings', 'Chat Room Settings', 'delete_pages', 'chat-room-settings', array( $this, '_chat_settings_page' ) );
		}
		
		function _chat_settings_page() {
			
			$chatroom_firebase_url = '';
			if( get_option( '_chatroom_firebase_url', true ) ) {
				$chatroom_firebase_url = get_option( '_chatroom_firebase_url' );
			}

			echo '<h2>Chat Settings</h2>';
			
			echo '<form action="'.admin_url('edit.php?post_type=chatrooms&page=chat-room-settings').'" method="post">';
				echo '<table class="widefat">';
					echo '<thead>';
						echo '<th colspan="2"> FireBase Settings</th>';
					echo '</thead>';
					echo '<tbody>';
						echo '<tr>';
							echo '<td><strong>Firebase URL</strong></td>';
							echo '<td><input name="_chatroom_firebase_url" value="'.$chatroom_firebase_url.'" placeholder="https://xxxxx.firebase.io" style="display:block;width:90%;" />';
						echo '<tr>';
					echo '</tbody>';
				echo '</table>';
				echo '<br/><input class="button button-primary" type="submit" value="Save Chat Settings" />';
			echo '</form>';
			
			
			
		}
		
		function _save_chat_settings() {
			
			if( !$_POST ) { return; }
			
			if( isset( $_POST['_chatroom_firebase_url'] ) ){
				update_option( '_chatroom_firebase_url', $_POST['_chatroom_firebase_url'] );
			}
			
		}
		
		
		
	}
?>