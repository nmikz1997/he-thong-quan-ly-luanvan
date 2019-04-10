app.controller('DiemLuanVanController', function($scope, $http, mainURL){
	$http.get(mainURL + 'diem/').then(function (response) {
		$scope.arr 	= response.data;
		var tong = 0;
		$scope.arr.forEach(function (danhgia) {
			tong += danhgia.diem + 0.0;
		});
		$scope.diem = (tong/3).toPrecision(3);
		//console.log($scope.diem);
	});
});

