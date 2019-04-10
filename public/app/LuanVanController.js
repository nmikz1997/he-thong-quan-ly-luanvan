app.controller('LuanVanController', function($scope, $http, mainURL){
	$http.get(mainURL + 'luanvan/').then(function (response) {
		$scope.arrLuanVan 	= response.data.message.dsluanvan;
	});
});

