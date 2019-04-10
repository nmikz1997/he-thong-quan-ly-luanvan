app.controller('LichController', function($scope, $http, mainURL){

	$scope.obj = {
		id: 'LT1',
		ngay: '2019-03-08'
	};

	$scope.tuychon = function () {
		$http.get(mainURL + 'lich/'+$scope.obj.id+'/'+$scope.obj.ngay)
		.then(function (response) {
			$scope.arrNgay 		= response.data.message.dsNgay;
			$scope.arrDiadiem	= response.data.message.dsDiadiem;
			$scope.arrLich 		= response.data.message.dsLich;
			//$scope.dataTitle 	= $scope.arrDiadiem.find(diadiem => diadiem.id === $scope.diadiem).ten;
		});
	}

	$scope.timdd = function (diadiem) {
		//console.log($scope.obj);
		$scope.tuychon();
	};

	$scope.timNgay = function (ngay) {
		//console.log($scope.obj);
		$scope.tuychon();
	}

	$scope.tuychon();
	

	$scope.modal = function (state, id) {
		$scope.state = state;
		$scope.ngay = id;
		switch (state){
			case "add":
				//$scope.makeReadOnly = "false";
				$scope.frmTitle = 'Thêm Ngày';
				$scope.diadiem = null;
				break;
			case "edit":
				
				// $scope.frmTitle = 'Thêm luận văn';
				// $http.get(mainURL+ "admin/diadiem/"+id)
				// .then(function (response){
				// 	$scope.diadiem = response.data;
				// }).catch(function (err) {
				// 	console.log(err);
				// 	alert("Không tìm thấy địa điểm");
				// });

				break;
			default:
				break;
			}
			$("#myModal").modal('show');
		}

		$scope.save = function (state, id) {

			var data = $scope.ngay;
			var url = mainURL + "lich";
			var method = "POST";
			console.log(data);

			// if(state == 'edit'){ 
			// 	url+= "/"+id; //update
			// 	method = "PUT";
			// }

			$http({
				method: method,
				url: url,
				data: $.param(data),
				headers: { 'Content-Type' : 'application/x-www-form-urlencoded' }
			})
			.then(function (res){
				console.log(res);
				$scope.tuychon();
				$("#myModal").modal('hide');
				//location.reload();
			})
			.catch(function (err) {
				console.log(err);
				alert('error');
			});
		}

		$scope.confirmDelete = function (id) {
			var isConfirmDelete = confirm('Bạn có chắc muốn xóa dòng dữ liệu này hay không');
			if (isConfirmDelete) {
				$http.delete(mainURL + 'xoangay/' + id)
				.then(function (res) {
					console.log(res);
					$scope.tuychon();
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

