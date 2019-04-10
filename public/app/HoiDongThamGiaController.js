app.controller('HDTGController', function($scope, $http, mainURL){
	function render() {
		$http.get(mainURL + 'hoidongthamgia')
		.then(function (response) {
			$scope.arr 	= response.data.message.luanvan;
		})
		.then(function () {
			$scope.checkDate = function (ngay) {
				if (ngay == null) return false; 
				ngay1 = new Date(ngay);
				ngay2 = new Date();
				if(ngay1 <= ngay2){
					return true;
				}else{
					return false;
				}
			}
		});
	}
	render();

	$scope.modal = function (id) {
		$scope.frmTitle = 'Chấm điểm';
		$scope.luanvan_id = id;

		$http.get(mainURL+ "findluanvan/"+id)
		.then(function (response)
		{
			console.log(response.data[0]);	
			$scope.luanvan = {
				id: response.data[0].luanvan_id,
				sinhvien_ten: response.data[0].sinhvien_ten,
				detai_ten: response.data[0].detai_ten,
			};

		}).catch(function (err) {
			console.log(err);
			alert("Không tìm thấy");
		});

		$("#myModal").modal('show');
	}
	$scope.save = function (id) {
		var data = {diem: $scope.luanvan.diem};
		console.log(data);
		var url = mainURL + "chamdiemluanvan/" +id;
		var method = "PUT";
		$http({
			method: method,
			url: url,
			data: $.param(data),
			headers: { 'Content-Type' : 'application/x-www-form-urlencoded' }
		})
		.then(function (res){
			render();
			$("#myModal").modal('hide');
			alert(res.data);
		})
		.catch(function (err) {
			render();
			console.log(err);
			alert('error');
		});
		}
	});