function switch_button(id) {
		if (id==1) {
			// for login
			if ($("#login").hasClass("disabled")) {
				// dont show anything once the user is logged in
			
			}else{	

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

			$("#button_swap1").show();
			$("#button_swap2").hide();
			$("#button_swap3").hide();

			// $("#button_swap").text("Login");
			// $("#button_swap").val("Login");
			}

		}else if (id==2) {
			// for signup

			// shows the username ui
			$('#span_user').show();
			$('#icon_user').show();
			$('#username').show();

			// shows the password ui
			$('#span_password').show();
			$('#icon_password').show();
			$('#password').show();

			// shows the email ui
			$('#span_email').show();
			$('#icon_email').show();
			$('#email').show();

			$("#login").removeClass("active");
			$("#signup").addClass("active");
			$("#forgot_password").removeClass("active");

			$("#button_swap1").hide();
			$("#button_swap2").show();
			$("#button_swap3").hide();

			// $("#button_swap").text("SignUp");
			// $("#button_swap").val("SignUp");

		}else if(id==3){
			// for forgotpassword

			// hides the username ui
			$('#span_user').hide();
			$('#icon_user').hide();
			$('#username').hide();

			// hides the password ui
			$('#span_password').hide();
			$('#icon_password').hide();
			$('#password').hide();

			// shows the username ui
			$('#span_email').show();
			$('#icon_email').show();
			$('#email').show();

			$("#login").removeClass("active");
			$("#signup").removeClass("active");
			$("#forgot_password").addClass("active");

			$("#button_swap1").hide();
			$("#button_swap2").hide();
			$("#button_swap3").show();

			// $("#button_swap").text("Reset");
			// $("#button_swap").text("Reset");
		}

	}
