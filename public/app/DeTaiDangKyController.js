app.controller('DeTaiDaDangKyController', function($scope, $http, mainURL, $sce){

	function refresh() {
		$http.get(mainURL + 'detaidadangky').then(function (response) {
			$scope.arrDeTai = response.data.message.DeTaiDaDangKy;
		});
	}

	refresh();

	$scope.dangkyluanvan = function (id) {
		data = {'id':id};
		
		$http({
			method: 'POST',
			url: mainURL + "dangkyluanvan",
			data: $.param(data),
			headers: { 'Content-Type' : 'application/x-www-form-urlencoded' }
		})
		.then(function (res){
			console.log(res);
			refresh();
		}).catch(function (err) {
			console.log(err);
			alert('error');
		});
	}

	$scope.huydangky = function (id) {
		var isConfirmDelete = confirm('Bạn có chắc muốn xóa đơn đăng ký này');
		if (isConfirmDelete) {
			$http.delete(mainURL + 'huydondangky/' + id)
			.then(function (res) {
				console.log(res);
				refresh();
				})
			.catch(function(err) {
				console.log(err);
				alert('Xảy ra lỗi vui lòng kiểm tra log');
			});
		} else {
			return false;
		}
	}

});

