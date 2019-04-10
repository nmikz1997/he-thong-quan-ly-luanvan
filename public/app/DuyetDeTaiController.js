app.controller('DuyetController', function($scope, $http, $location, mainURL){
	
	function refresh() {
		$http.get(mainURL + 'dondangky').then(function (response) {
			$scope.arr = response.data.message.dsDetaiDuocDangKy;
		});
	}

	refresh();

	$scope.duyet = function (id,detai_id,sinhvien_id) {
		data = {'id':id, 'detai_id': detai_id, 'sinhvien_id': sinhvien_id};
		
		$http({
			method: 'POST',
			url: mainURL + "duyetdon",
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

	$scope.xemBangDiem = function (sinhvien_id) {
		//var host = $location.host()+':'+$location.port();

		//$scope.bangdiem = "http://"+host+"/public/bangdiem/"+sinhvien_id;
		$scope.bangdiem = "http://localhost/quanlyluanvan/public/bangdiem/"+sinhvien_id;
		console.log($scope.bangdiem);
		$("#myModal").modal('show');
	}
	$scope.huyDuyet = function (id) {
		$http({
			method: 'PUT',
			url: mainURL + "huyduyet/"+id,
			data: "",
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
});

