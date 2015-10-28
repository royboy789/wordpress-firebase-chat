var $ = jQuery;
var chat_app = angular.module( 'chat_app', ['firebase'] );

chat_app.controller('chat_controller', [ '$rootScope', '$scope', '$http', '$firebase', function( $rootScope, $scope, $http, $firebase ) {

	console.log('chatroom init..');

	$scope.startChat = function( post ) {
		$http.get( wpAngularVars.base +'/chatrooms/' + post ).then(function(res) {
			console.log( res.data );
			$scope.chatroom = res.data;

			var fire_chatroom = $firebase( new Firebase( fireData.fire_url ).child( $scope.chatroom.id )).$asObject();
			fire_chatroom.$bindTo( $scope, 'fireChat' ).then(function(){
				console.log('chat messages init..');
				$scope.scrollChat();
			});
		});
	}

	$scope.resetMsg = function( name ) {
		if (fireData.user_name != '') {
			name = fireData.user_name;
		}
		$scope.msg = {
			name: name,
			msg: ''
		}
	}
	$scope.resetMsg();
	$scope.newChat = function() {

		var name = $scope.msg.name;

		if( !$scope.fireChat.chat ) {
			$scope.fireChat.chat = [$scope.msg];
		} else {
			if ($scope.msg.msg) {
				$scope.fireChat.chat.push( $scope.msg );
			}
		}

		$scope.resetMsg( name );
		$scope.scrollChat();

	}

	$scope.scrollChat = function() {
		if( $('#fire_chat_messages')[0].scrollHeight > $('#fire_chat_messages').outerHeight() ) {
			$('#fire_chat_messages').animate({
				scrollTop: $('#fire_chat_messages')[0].scrollHeight
			})
		}
	}


}]);
