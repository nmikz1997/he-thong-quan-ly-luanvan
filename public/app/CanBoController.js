app.controller('CanBoController', function($scope, $http, mainURL){
	$http.get(mainURL + 'bomon')
	.then(function (response) {
		$scope.arrBoMon 	= angular.fromJson(response.data.message.jsonBoMon);
	})
	.then(function () {
		$scope.tuychon = function (id) {
		$scope.bomon = id;
		$http.get(mainURL + 'canbo/bomon/'+id).then(function (response) {
			$scope.dataTitle 	= $scope.arrBoMon.find(bomon => bomon.id === $scope.bomon).ten;
			$scope.arrCanBo 	= angular.fromJson(response.data.message.jsonCanBo);
		});	
		}
	});

	$scope.tuychon('CNTT');

	$scope.arrChucDanh = [  
		{id: "PGS.TS", ten: "Phó giáo sư, Tiến sĩ"},
		{id: "ThS", ten: "Thạc sĩ"},
		{id: "TS", ten: "Tiến sĩ"}
	];

	$scope.arrChucVu = [ {id: "GV", ten: "Giảng viên"}, {id: "TK", ten: "Thư ký bộ môn"} ];


	$scope.modal = function (state, id) {
		$scope.state = state;
		$scope.makeReadOnly = false;
		if (state == "edit") { 
			$scope.makeReadOnly = true; 
		}
		switch (state){
			case "add":
			
				$scope.frmTitle = 'Thêm cán bộ';
				$scope.canbo = null;
				break;
			case "edit":
				$scope.frmTitle = 'Sửa thông tin cán bộ';
				$http.get(mainURL+ "canbo/"+id)
				.then(function (response){
					$scope.canbo = response.data;
				}).catch(function (err) {
					console.log(err);
					alert("Không tìm thấy cán bộ");
				});

				break;
			default:
				break;
		}
		$("#myModal").modal('show');
	}

	$scope.save = function (state, id) {

		var url = mainURL + "canbo"; //add
		var data = $scope.canbo;
		var method = "POST";

		if(state == 'edit'){ 
			url+= "/"+id; //update
			method = "PUT";
		}

		$http({
			method: method,
			url: url,
			data: $.param(data),
			headers: { 'Content-Type' : 'application/x-www-form-urlencoded' }
		})
		.then(function (res){
			console.log(res);
			$("#myModal").modal('hide');
			$scope.tuychon($scope.bomon);
			//location.reload();
		}).catch(function (err) {
			console.log(err);
			//$("#myModal").modal('hide');
			$scope.tuychon($scope.bomon);
			alert('error');
		});
	}

	$scope.confirmDelete = function (id) {
		var isConfirmDelete = confirm('Bạn có chắc muốn xóa dòng dữ liệu này hay không');
		if (isConfirmDelete) {
			$http.delete(mainURL + 'canbo/' + id)
			.then(function (res) {
				console.log(res);
				$("#myModal").modal('hide');
				$scope.tuychon($scope.bomon);
				//location.reload();
			})
			.catch(function(err) {
				console.log(err);
				$("#myModal").modal('hide');
				$scope.tuychon($scope.bomon);
				alert('Xảy ra lỗi vui lòng kiểm tra log');
			});
		} else {
			return false;
		}
	}
});