app.controller('NienKhoaController', function($scope, $http, mainURL){
	$scope.dataTitle 		= 'Niên khóa';
	$http.get(mainURL + 'nienkhoa').then(function (response) {
		$scope.arrNienKhoa 	= angular.fromJson(response.data.message.jsonNienKhoa);
	});

	$scope.modal = function (state, id) {
		$scope.state = state;
		switch (state){
			case "add":
				$scope.frmTitle = 'Thêm niên khóa';
				$scope.id = id;
				$scope.nienkhoa = null;
				break;
			case "edit":
				$scope.frmTitle = 'Sửa niên khóa';
				$http.get(mainURL+ "nienkhoa/"+id)
				.then(function (response){
					$scope.nienkhoa = response.data;
				}).catch(function (err) {
					console.log(err);
					alert("Không tìm thấy niên khóa");
				});

				break;
			default:
				break;
		}
		$("#myModal").modal('show');
	}

	$scope.save = function (state, id) {
			var url = mainURL + "nienkhoa"; //add
			var data = $scope.nienkhoa;

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
				location.reload();
			}).catch(function (err) {
				console.log(err);
				alert('error');
			});
		}
		$scope.confirmDelete = function (id) {
			var isConfirmDelete = confirm('Bạn có chắc muốn xóa dòng dữ liệu này hay không');
			if (isConfirmDelete) {
				$http.delete(mainURL + 'nienkhoa/' + id)
				.then(function (res) {
					console.log(res);
					location.reload();
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