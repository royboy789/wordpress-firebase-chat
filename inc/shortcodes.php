<?php
function do_chat_room( $atts ) {
	$a = shortcode_atts( array(
		'id' => ''
		), $atts );
	
	ob_start();
	if($a['id'] == ''){
		echo '<p>post_id must be set in shortcode to display chat room</p>';
		
	} else {
		echo '<div ng-app="chat_app" ng-controller="chat_controller" ng-init="startChat('.$a['id'].')" class="ng-scope">
		<div id="fire_chat_container">
			<div id="fire_chat_messages">
				<article ng-repeat="msg in fireChat.chat">
					<strong>{{msg.name}}</strong>: <span>{{msg.msg}}</span>
				</article>
			</div>
			<form id="fire_chat_form" ng-submit="newChat()">
				<input ng-model="msg.name" placeholder="Name" />
				<textarea ng-model="msg.msg" placeholder="Message"></textarea>
				<input type="submit" value="chat" />
			</form>
		</div>
	</div>';
}
return ob_get_clean();
}
add_shortcode( 'ng-chatroom', 'do_chat_room' );
?>