app.controller('DeTaiGiaoVienController', function($scope, $http, mainURL){

	function render() {
		$http.get(mainURL + 'detaigiaovien').then(function (response) {
			$scope.canbo 		= response.data.message.canbo;
			$scope.arrDeTai 	= response.data.message.dsDetai;
		});	
	}
	
	render();

	$scope.hidden = true;

	$scope.modal = function (state, id) {
		$scope.state = state;
		
		switch (state){
			case "add":
				$scope.frmTitle = 'Thêm đề tài';
				$scope.detai = null;
				break;
			case "edit":
				$scope.frmTitle = 'Sửa thông tin đề tài';
				$http.get(mainURL+ "detaigiaovien/"+id)
				.then(function (response){
					$scope.detai = response.data;
				}).catch(function (err) {
					console.log(err);
					alert("Không tìm thấy đề tài");
				});

				break;
			default:
				break;
		}
		$("#myModal").modal('show');
	}

	$scope.save = function (state, id) {

			var url = mainURL + "detaigiaovien"; //add
			var data = $scope.detai;
			var method = "POST";

			if(state == 'edit'){ 
				url+= "/"+id; //update
				method = "PUT";
			}

			//console.log(data);

			$http({
				method: method,
				url: url,
				data: $.param(data),
				headers: { 'Content-Type' : 'application/x-www-form-urlencoded' }
			})
			.then(function (res){
				console.log(res);
				render();
				$("#myModal").modal('hide');
				//location.reload();
			}).catch(function (err) {
				console.log(err);
				$("#myModal").modal('hide');
				alert('error');
			});
		}
		$scope.confirmDelete = function (id) {
			var isConfirmDelete = confirm('Bạn có chắc muốn xóa dòng dữ liệu này hay không');
			if (isConfirmDelete) {
				$http.delete(mainURL + 'detaigiaovien/' + id)
				.then(function (res) {
					console.log(res);
					render();
					$("#myModal").modal('hide');
					//location.reload();
				})
				.catch(function(err) {
					console.log(err);
					$("#myModal").modal('hide');
					render();
					alert('Xảy ra lỗi vui lòng kiểm tra log');
				});
			} else {
				return false;
			}
		}
});

