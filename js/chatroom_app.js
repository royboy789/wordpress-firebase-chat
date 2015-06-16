var $ = jQuery;
var chat_app = angular.module( 'chat_app', ['firebase'] );

chat_app.controller('chat_controller', [ '$rootScope', '$scope', '$http', '$firebase', function( $rootScope, $scope, $http, $firebase ) {

	console.log('chatroom init..');

	$scope.startChat = function( post ) {
		$http.get( wpAngularVars.base +'/posts/' + post ).then(function(res) {
			$scope.chatroom = res.data;

			var fire_chatroom = $firebase( new Firebase( fireData.fire_url ).child( $scope.chatroom.ID )).$asObject();
			fire_chatroom.$bindTo( $scope, 'fireChat' ).then(function(){
				console.log('chat messages init..');
				$scope.scrollChat();
			});
		});
	}

	$scope.resetMsg = function( name ) {
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
			$scope.fireChat.chat.push( $scope.msg );
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
