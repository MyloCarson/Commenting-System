var endpoint = 'connect.php';
var userID;

app.controller("control_comment", function($scope,$http){

	// $http.get("http://localhost:8080/pv_comment/connect2.php").then(function(response){
	// 		$scope.resp=response.data.response;
	// 		$scope.statusCode = response.status;
	// 		$scope.statusText = response.statusText;
	// 		console.log(response.data.response);
	// 		$("#commentLabel").hide();
	// 		$("#comment").hide();
	// 		$("#commentBtn").hide();
	// 	});
	var request_code= 5;

	var data = $.param({
		'request_code': request_code
	});
	var config = {
		headers:{
			'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
		}
	};

	$http.post(endpoint,data,config)
	.success(function(response,status,headers,config){
		$scope.resp=response.data.response;
			$scope.statusCode = response.status;
			$scope.statusText = response.statusText;
			console.log(response.data.response);
			$("#commentLabel").hide();
			$("#comment").hide();
			$("#commentBtn").hide();
	})
	.error(function(response,status,headers,config){
			console.login(response);
	});
});

app.controller("loginController", function($scope,$http){
	

	$scope.login = function(){
		var request_code = 1;
		var data = $.param({
			'request_code':request_code,
			'email':$scope.email,
			'password':$scope.password });
		var config = {
			headers: {
				'Access-Control-Allow-Origin': '*',
				'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
			}
				

		};

		$http.post(endpoint,data,config)
		.success(function(response, status,headers,config){
			// console.log(response.response.id);
			if (response.code==1){
				$("#loginStatus").text("Logged in as "+response.response.username);
				// $scope.userID = response.response.id;
							$("#login").addClass("disabled");
							// $("#userID").val(response.response.id);
							userID = response.response.id;

							
							$('#span_email').hide();
							$('#icon_email').hide();
							$('#email').hide();

							// hides the password ui
							$('#span_password').hide();
							$('#icon_password').hide();
							$('#password').hide();

							// hide the buttons to login, they aint needed anylonger
							$("#button_swap1").hide();
							$("#login").hide();

							// now show comment box, since the user has logged in
							$("#commentLabel").show();
							$("#comment").show();
							$("#commentBtn").show();

							$("#error_message").hide();

			}else if (response.code==0){
				console.log(response.code);
				var error_message = "Wrong email or password";
				var pTag = "<p id='error_message'>"+error_message+"</p>";
				$("#div_doButtons").append(pTag);
			}
		})
		.error(function(data, status,headers,config){
			console.log(data);
		});


	};


});

app.controller("signUpContoller",function($scope,$http){
	$scope.signup= function(){
		var request_code = 2;

		var data = $.param({
			'request_code': request_code,
			'email':$scope.email,
			'password': $scope.password,
			'username':$scope.username

		});

		var config = {
			headers: {
				'Access-Control-Allow-Origin': '*',
				'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
			}
		};

		$http.post(endpoint,data,config)
		.success(function(response,headers,status,config){
			// console.log(response);
			if (response.code==1) {
				showLoginStuffs();
				
			}
		})
		.error(function(response,headers,status,config){
			console.log(response);
		});

	};
});


app.controller("resetController", function($scope,$http){
	var request_code =3
	$scope.reset=function(){
		var data =$.param({
			'email':$scope.email
		});

		var config = {
			headers:{
				'Access-Control-Allow-Origin': '*',
				'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
			}
		};

		$http.post(endpoint,data,config)
		.success(function(response,headers,status,config){
			console.log(response);
		})
		.error(function(response,headers,status,config){
			console.log(response);
		});
	};
});

app.controller("commentContoller", function($scope, $http){
	var request_code = 4;
	var topic = "0";
	var thread ="none";

	$scope.postComment  = function(){

		var data = $.param({
			'request_code': request_code,
			'topic':topic,
			'thread':thread,
			'comment':$scope.comment,
			'userID': userID
		});

		var config = {
			headers: {
				'Access-Control-Allow-Origin': '*',
				'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
			}
		};

		$http.post(endpoint,data,config)
		.success(function(response,data,status,config){
			//console.log(response.response);
			var pTag ="<p>"+$scope.comment+"<br><span>comment by: "+ response.response.username+"</span></p>";
			$("#insert_div").prepend(pTag);
			
		})
		.error(function(response,data,status,config){
			console.log(response);
		});
	};
});


function showLoginStuffs(){
	$("#login").addClass("active");
	$("#signup").removeClass("active");
	$("#forgot_password").removeClass("active");
	$("#button_swap1").show();
	$("#button_swap2").hide();
	$("#button_swap3").hide();

	$('#span_user').hide();
	$('#icon_user').hide();
	$('#username').hide();

	$('#span_password').show();
	$('#icon_password').show();
	$('#password').show();

	$('#span_email').show();
	$('#icon_email').show();
	$('#email').show();

	$("#login").addClass("active");
	$("#signup").removeClass("active");
	$("#forgot_password").removeClass("active");
}