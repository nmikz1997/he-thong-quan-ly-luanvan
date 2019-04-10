app.controller('NgayController', function($scope, $http, mainURL){
	$scope.dataTitle 		= 'Địa điểm';
	$http.get(mainURL + 'ngay').then(function (response) {
		$scope.arr 	= response.data;
	});

	// $scope.modal = function (state, id) {
	// 	$scope.state = state;
	// 	if (state == "edit") $scope.makeReadOnly = "true";
	// 	switch (state){
	// 		case "add":
	// 			//$scope.makeReadOnly = "false";
	// 			$scope.frmTitle = 'Thêm địa điểm';
	// 			$scope.diadiem = null;
	// 			break;
	// 		case "edit":
				
	// 			$scope.frmTitle = 'Sửa địa điểm';
	// 			$http.get(mainURL+ "diadiem/"+id)
	// 			.then(function (response){
	// 				$scope.diadiem = response.data;
	// 			}).catch(function (err) {
	// 				console.log(err);
	// 				alert("Không tìm thấy địa điểm");
	// 			});

	// 			break;
	// 		default:
	// 			break;
	// 	}
	// 	$("#myModal").modal('show');
	// }

	// $scope.save = function (state, id) {

	// 		var url = mainURL + "diadiem"; //add
	// 		var data = $scope.diadiem;
	// 		var method = "POST";
	// 		if(state == 'edit'){ 
	// 			url+= "/"+id; //update
	// 			method = "PUT";
	// 		}

	// 		$http({
	// 			method: method,
	// 			url: url,
	// 			data: $.param(data),
	// 			headers: { 'Content-Type' : 'application/x-www-form-urlencoded' }
	// 		})
	// 		.then(function (res){
	// 			console.log(data);
	// 			//location.reload();
	// 		}).catch(function (err) {
	// 			console.log(err);
	// 			alert('error');
	// 		});
	// 	}
	// 	$scope.confirmDelete = function (id) {
	// 		var isConfirmDelete = confirm('Bạn có chắc muốn xóa địa điểm này');
	// 		if (isConfirmDelete) {
	// 			$http.delete(mainURL + 'diadiem/' + id)
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

