app.controller('DiaDiemController', function($scope, $http, mainURL){
	$scope.dataTitle 		= 'Địa điểm';

	refresh = function () {
		$http.get(mainURL + 'diadiem').then(function (response) {
			$scope.arrDiaDiem 	= response.data.jsonDiaDiem;
		});
	}
	
	refresh();

	$scope.modal = function (state, id) {
		$scope.state = state;
		if (state == "edit") $scope.makeReadOnly = "true";
		switch (state){
			case "add":

				$scope.frmTitle = 'Thêm địa điểm';
				$scope.diadiem = null;
				break;

			case "edit":

				$scope.frmTitle = 'Sửa địa điểm';
				$http.get(mainURL+ "diadiem/"+id)
				.then(function (response){
					$scope.diadiem = response.data;
				}).catch(function (err) {
					console.log(err);
					alert("Không tìm thấy địa điểm");
				});

			break;
				default:
				break;
			}
			$("#myModal").modal('show');
		}

		$scope.save = function (state, id) {

			var url = mainURL + "diadiem"; //add
			var data = $scope.diadiem;
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
				//console.log(res);
				$("#myModal").modal('hide');
				refresh();
				//location.reload();
			}).catch(function (err) {
				console.log(err);
				alert('error');
			});
			
		}
		$scope.confirmDelete = function (id) {
			var isConfirmDelete = confirm('Bạn có chắc muốn xóa địa điểm này');
			if (isConfirmDelete) {
				$http.delete(mainURL + 'diadiem/' + id)
				.then(function (res) {
					console.log(res);
					refresh();
					//location.reload();
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

