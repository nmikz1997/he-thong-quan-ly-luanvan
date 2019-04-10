app.controller('HoiDongController', function($scope, $http, mainURL){
	// DTOptionsBuilder, DTColumnBuilder, DTColumnDefBuilder
	$scope.tuychon = function (id) {
		$scope.bomon = id;
		$http.get(mainURL + 'hoidong/bomon/'+$scope.bomon)
		.then(function (response) {
			$scope.arrBoMon		= response.data.message.dsBoMon;
			$scope.arrCanBo		= response.data.message.dsCanBo;
			$scope.arrHoidong 	= response.data.message.dsHoidong;
			$scope.dataTitle 	= $scope.arrBoMon.find(bomon => bomon.id === $scope.bomon).ten;
		});	
	}

	$scope.getBomon = function (bomon) {
		console.log(bomon);
	}

	$scope.tuychon('CNTT');

	$scope.hidden = true;

	$scope.modal = function (state, id, canbo_id) {
		console.log(canbo_id);
		$scope.state = state;
		var data = $scope.arrCanBo.find(canbo => canbo.id === canbo_id);

		var indexData = $scope.arrCanBo.indexOf(data);
		if(indexData !== -1)
		{
			$scope.arrCanBo.splice(indexData,1);
		}

		$scope.arrChutich = [];

		$scope.arrCanBo.forEach(function (item) {
			$scope.arrChutich.push(item);
		});

		$scope.hienthiUV = function (canbo) {

			$scope.arrUyvien = [];

			$scope.arrCanBo.forEach(function (item) {
				$scope.arrUyvien.push(item);
			});

			var data = $scope.arrUyvien.find(uyvien => uyvien.id === canbo.chutich);

			var indexData = $scope.arrUyvien.indexOf(data);
			if(indexData !== -1)
			{
				$scope.arrUyvien.splice(indexData,1);
			}

		}
		
		$scope.lvID = id;
		$scope.frmTitle = 'Cập nhật hội đồng';
		$("#myModal").modal('show');
		$scope.canbo = null;
		
	}

	$scope.save = function (state, id) {

		$scope.canbo.idLuanvan = id;
		console.log($scope.canbo);

		var url = mainURL + "themhoidong"; //add
		var data = $scope.canbo;
		var method = "POST";

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
		}).catch(function (err) {
			console.log(err);
			$("#myModal").modal('hide');
			$scope.tuychon($scope.bomon);
			alert('error');
		});
	}

	$scope.lichModal = function (buoi, id) {
		$scope.buoi = buoi;
		$scope.lich = {
			ngay_id : null,
			diadiem_id : null
		};
		$scope.luanvan_id = id;
		//$http.get(mainURL + 'hoidong/bomon/'+$scope.bomon).then(function (response) {
			//chonlich/{buoi}
		$http.get(mainURL + 'chonlich/'+buoi+'/'+id)
		.then(function (res) {
			$scope.arrLich = res.data;
			console.log($scope.arrLich);
		})

		$scope.frmTitle = 'Chọn lịch';
		$("#lichModal").modal('show');
	}

	$scope.timDiaDiem = function (ngay_id) {
		console.log($scope.buoi);
		$http.get(mainURL + 'chondiadiem/'+$scope.buoi+'/'+ngay_id)
		.then(function (res) {
			$scope.arrDiaDiem = res.data;
			console.log($scope.arrDiaDiem);
		})
	}

	$scope.saveLich = function () {

		var data = {
			buoi: $scope.buoi,
			luanvan_id: $scope.luanvan_id,
			ngay_id: $scope.lich.ngay_id,
			diadiem_id: $scope.lich.diadiem_id
		};
		
		var url = mainURL + "testDB"; //add
		var method = "POST";

		$http({
			method: method,
			url: url,
			data: $.param(data),
			headers: { 'Content-Type' : 'application/x-www-form-urlencoded' }
		})
		.then(function (res){
			console.log(res);
			$scope.tuychon($scope.bomon);
			$("#lichModal").modal('hide');
			alert('Đã sắp lịch');
			//$scope.tuychon($scope.bomon);
		}).catch(function (err) {
			console.log(err);
			$scope.tuychon($scope.bomon);
			$("#myModal").modal('hide');
			alert('Có lỗi xẩy ra');
		});
	}
});

