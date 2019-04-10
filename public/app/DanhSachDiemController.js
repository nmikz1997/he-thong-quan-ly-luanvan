app.controller('DanhSachDiemController', function($scope, $http, mainURL){
	$scope.tuychon = function (id) {
		$scope.bomon = id;
		$http.get(mainURL + 'xemdsDTB/'+$scope.bomon).then(function (response) {
			$scope.arrBoMon		= angular.fromJson(response.data.message.dsBoMon);
			$scope.dataTitle 	= $scope.arrBoMon.find(bomon => bomon.id === $scope.bomon).ten;
			$scope.arr 			= angular.fromJson(response.data.message.dsDiemSV);
		});
	}

	$scope.tuychon('CNTT');

});

