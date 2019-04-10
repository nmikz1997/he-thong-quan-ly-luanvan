app.controller('DeTaiChuaDangKyController', function($scope, $http, mainURL){
	$scope.tuychon = function (id) {
		$scope.bomon = id;
		$http.get(mainURL + 'detaichuadangky/'+$scope.bomon).then(function (response) {
			$scope.arrBoMon		= response.data.message.dsBoMon;
			$scope.arrDeTai 	= response.data.message.dsDetai;
			$scope.dataTitle 	= $scope.arrBoMon.find(bomon => bomon.id === $scope.bomon).ten;
		});	
	}

	$scope.tuychon('CNTT');

	$scope.hidden = true;

	$scope.dangky = function (id) {
		data = {'id' : id};

		var isConfirm = confirm('Bạn có chắc muốn đăng ký đề tài này không?');
		if (isConfirm) {
			$http({
				method: 'POST',
				url: mainURL + "detaidangky",
				data: $.param(data),
				headers: { 'Content-Type' : 'application/x-www-form-urlencoded' }
			})
			.then(function (res){
				console.log(res);
				$scope.tuychon($scope.bomon);
			}).catch(function (err) {
				console.log(err);
				alert('error');
			});
		} else {
			return false;
		}
	}

});

