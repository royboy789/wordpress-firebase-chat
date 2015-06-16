<?php

class chat_admin_menu {

	function __construct() {
		add_action( 'admin_menu', array( $this, '_chat_menus' ) );
		add_action( 'admin_init', array( $this, '_save_chat_settings' ) );
	}

	function _chat_menus() {
		add_submenu_page(
			'edit.php?post_type=chatrooms',
			'Chat Room Settings',
			'Chat Room Settings',
			'delete_pages',
			'chat-room-settings',
			array( $this, '_chat_settings_page' )
		);
	}

	/**
	 * Helper function to determine if an automated task which should prevent
	 * saving meta box data is running.
	 *
	 * @since  1.1.1
	 * @access protected
	 * @return void
	 */
	protected function stop_save() {
		return defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ||
			defined( 'DOING_AJAX' ) && DOING_AJAX ||
			defined( 'DOING_CRON' ) && DOING_CRON;
	}

	function _chat_settings_page() {
		$chatroom_url = '';
		if ( get_option( '_chatroom_firebase_url', true ) ) {
			$chatroom_url = get_option( '_chatroom_firebase_url' );
		}
		$action = 'edit.php?post_type=chatrooms&amp;page=chat-room-settings';
		?>
		<div id="firebase-chat-sttings" class="wrap firebase-chat-gettings">
			<h2>Chat Settings</h2>

			<form action="<?php echo esc_url( admin_url( $action ) ); ?>" method="post">
				<?php wp_nonce_field( 'save_chat_settings', 'firebase_chat_settings_nonce' ); ?>
				<table class="widefat">
					<thead><th colspan="2">FireBase Settings</th></thead>
					<tbody>
						<tr>
							<td style="width: 20%;"><strong>Firebase URL</strong></td>
							<td><input class="widefat" type="url" name="_chatroom_firebase_url" value="<?php echo esc_url( $chatroom_url ); ?>" placeholder="https://xxxxx.firebase.io" />
						<tr>
					</tbody>
				</table>
				<br/>
				<input class="button button-primary" type="submit" value="Save Chat Settings" />
			</form>
		</div>
		<?php
	}

	function _save_chat_settings() {
		if ( $this->stop_save() || ! current_user_can( 'manage_options' ) ) {
			return;
		}
		$no = 'firebase_chat_settings_nonce';
		if ( ! isset( $_POST[ $no ] ) || ! wp_verify_nonce( $_POST[ $no ], 'save_chat_settings' ) ) {
			return;
		}
		if ( ! empty( $_POST['_chatroom_firebase_url'] ) ) {
			update_option( '_chatroom_firebase_url', esc_url( $_POST['_chatroom_firebase_url'] ) );
		}
	}

}
