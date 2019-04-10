app.controller('SinhVienController', function($scope, $http, mainURL){
	$scope.tuychon = function (id) {
		$scope.bomon = id;
		$http.get(mainURL + 'sinhvien/bomon/'+$scope.bomon).then(function (response) {
			$scope.arrBoMon		= angular.fromJson(response.data.message.dsBoMon);
			$scope.dataTitle 	= $scope.arrBoMon.find(bomon => bomon.id === $scope.bomon).ten;
			$scope.arrSinhVien 	= angular.fromJson(response.data.message.dsSinhVien);
		});	
	}

	$scope.tuychon('CNTT');

	$scope.hidden = true;

	$scope.modalExcel = function () {
		$('#myModalExcel').modal('show');
	}

	$scope.modal = function (state, id) {
		$scope.state = state;
		console.log(state);
		// switch (state){
		// 	case "add":
		// 		$scope.frmTitle = 'Đăng ký đề tài';
		// 		$scope.canbo = null;
		// 		break;
		// 	case "edit":
		// 		$scope.frmTitle = 'Sửa thông tin cán bộ';
		// 		$http.get(mainURL+ "admin/canbo/"+id)
		// 		.then(function (response){
		// 			$scope.canbo = response.data;
		// 		}).catch(function (err) {
		// 			console.log(err);
		// 			alert("Không tìm thấy cán bộ");
		// 		});

		// 		break;
		// 	default:
		// 		break;
		//}
		$("#myModal").modal('show');
	}

	// $scope.save = function (state, id) {

	// 		var url = mainURL + "admin/canbo"; //add
	// 		var data = $scope.canbo;
	// 		var method = "POST";

	// 		if(state == 'edit'){ 
	// 			url+= "/"+id; //update
	// 			method = "PUT";
	// 		}

	// 		//console.log(data);

	// 		$http({
	// 			method: method,
	// 			url: url,
	// 			data: $.param(data),
	// 			headers: { 'Content-Type' : 'application/x-www-form-urlencoded' }
	// 		})
	// 		.then(function (res){
	// 			console.log(res);
	// 			//location.reload();
	// 		}).catch(function (err) {
	// 			console.log(err);
	// 			alert('error');
	// 		});
	// 	}
	// 	$scope.confirmDelete = function (id) {
	// 		var isConfirmDelete = confirm('Bạn có chắc muốn xóa dòng dữ liệu này hay không');
	// 		if (isConfirmDelete) {
	// 			$http.delete(mainURL + 'admin/canbo/' + id)
	// 			.then(function (res) {
	// 				console.log(res);
	// 				//location.reload();
	// 			})
	// 			.catch(function(err) {
	// 				console.log(err);
	// 				alert('Xảy ra lỗi vui lòng kiểm tra log');
	// 			});
	// 		} else {
	// 			return false;
	// 		}
	// 	}
});

