$(function(){
	var login = $(".login")
		, popup = $(".popup")
		, logout = $(".logout")
		, register = $('#register')
		, popupactive = false;

	var closePopup = function(){
		popup.fadeOut("slow", function(){
				popup.addClass("hidden");
			});
	}
	var tryLogin = function(){
		var email = $('#email').val()  // Stores user email
			, passw = $("#passw").val(); // Stores user password
		console.log(email + " " + passw);
		$.ajax({
			url: "http://localhost/aucaweb/server/login",
			method: "POST",
			data:{
				"CSRF" : CSRF,
				"email" : email,
				"password" : passw
			},
			success: function(data){
				console.log('login successful');
				console.log(data);
				console.log(JSON.parse(data));
				location.reload();
			}
		});
	}

	var tryLogout = function(){
		$.ajax({
			url: "http://localhost/aucaweb/server/logout",
			method: "POST",
			data:{
				"CSRF" : CSRF
			},
			success: function(data){
				console.log('logout successful');
				location.reload();
			}
		});
	}

	var tryRegister = function(){
		var email = $('input[name="email"]').val()
			, username = $('input[name="username"]').val()
			, password = $('input[name="password"]').val();
		console.log(email + " " + username + " " + password);

		$.ajax({
			url: "http://localhost/aucaweb/server/register",
			method: "POST",
			data: {
				"CSRF" : CSRF,
				"email": email,
				"username": username,
				"password": password
			},
			success: function(data){
				// console.log(data);
				var result = jQuery.parseJSON(data);
				console.log(result);
				alert(result.message);
				setInterval(function(){
					window.location = "http://localhost/aucaweb/app";
				}, 1200);

			}
		});

	}

	// Showing popup window on click
	login.on('click', function(){
		popup.fadeIn("slow", function(){
			popup.removeClass("hidden");	
			popupactive = true;
		})
	});

	//Logout click
	logout.on('click', function(){
		console.log("logging out");
		tryLogout();
	});


	//Close popup window on background click
	popup.on('click', function(e){
		if(popup.is(e.target)){
			closePopup();
		}
	});

	//Keydown handlers for popup window
	$(document).keydown(function(e){
		if(popupactive){
			if(e.keyCode === 27) { closePopup(); } // Pressing Esc key closes popup
			if(e.keyCode === 13) { tryLogin(); }
		}
	});

	//Login click event
	var submit = $("#login");
	submit.click('submit', function(event){
		event.preventDefault();
		tryLogin();
	});

	register.click('submit', function(event){
		event.preventDefault();
		tryRegister();
	});

	function validate()
	{
		var pswrd = document.sgnup.password.value;
        var cpswrd = document.sgnup.cpassword.value;
		var username = document.sgnup.username.value;
		var invalid = /[\W_]/; //only letters and numbers
		
		if (username.match(invalid))
		{
			alert("the username must contain only numbers and letters!");
			return false;
		}
		if (pswrd.match(invalid))
		{
			alert("the password must contain only numbers and letters!");
			return false;
		}
		if (cpswrd != pswrd)
		{
			alert("the passwords do not match!");
			return false;
		}

	}
});