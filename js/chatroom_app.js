var chat_app = angular.module( 'chat_app', ['firebase'] );

chat_app.controller('chat_controller', [ '$rootScope', '$scope', '$http', '$firebase', function( $rootScope, $scope, $http, $firebase ) {
	
	console.log('chatroom init..');
	
	$scope.startChat = function( post ) {
		console.log( post );
		$http.get( wpAngularVars.base +'/posts/' + post ).then(function(res) {
			$scope.chatroom = res.data;
			
			var fire_chatroom = $firebase( new Firebase( fireData.fire_url ).child( $scope.chatroom.ID )).$asObject();
			fire_chatroom.$bindTo( $scope, 'fireChat' );
			
		});
	}
	
	$scope.resetMsg = function( name ) {
		$scope.msg = {
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
		
	}
	
	
}]);