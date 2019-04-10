app.controller('ThoiGianHeThongController', function($scope, $http, mainURL){
	$scope.dataTitle 		= 'Thời gian hệ thống';
	$http.get(mainURL + 'thoigianhethong').then(function (response) {
		$scope.arr 	= angular.fromJson(response.data.message.jsonTGHT);
	});

	$scope.modal = function (state, id) {
		$scope.state = state;
		$scope.frmTitle = 'Sửa thời gian hệ thống';
		$scope.tghtid = id;

		$http.get(mainURL+ "thoigianhethong/"+id)
		.then(function (response){
			
			var tgmo = response.data.thoigianmo.toString();
			var tgdong = response.data.thoigiandong.toString();
			
			$scope.thoigianhethong = {
				id: id,
				thoigianmo: new Date(tgmo),
				thoigiandong: new Date(tgdong)
			};

		}).catch(function (err) {
			console.log(err);
			alert("Không tìm thấy");
		});

		$("#myModal").modal('show');
	}
	$scope.save = function (state, id) {
			var data = $scope.thoigianhethong;
			var url = mainURL + "thoigianhethong/" +id;
			var method = "PUT";
			console.log(data);

			$http({
				method: method,
				url: url,
				data: $.param(data),
				headers: { 'Content-Type' : 'application/x-www-form-urlencoded' }
			})
			.then(function (res){
				console.log(res);
				location.reload();
			}).catch(function (err) {
				console.log(err);
				alert('error');
			});
		}
});