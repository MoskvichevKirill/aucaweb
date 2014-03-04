$(function(){
	var login = $(".login")
		, popup = $(".popup")
		, logout = $(".logout")
		, register = $('#register')
		, useropt = $('.optbtn')
		, usermenu = $('.usermenu')
		, options = $('.options')
		, popupactive = false;

	var closePopup = function(){
		popup.fadeOut("slow", function(){
				popup.addClass("hidden");
			});
	}
	var tryLogin = function(){
		//var email = $('#email').val()  // Stores user email
		//	, passw = $("#passw").val(); // Stores user password
		var email = $('input[name="email"]').val(),
				passw = $('input[name="password"]').val();
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
				var result = JSON.parse(data);
				var popupmessage = result.message;
				$('.widget-flash-message > span:first').remove();
				if(result.success){
					$('.widget-flash-message').append("<span class='success'>" + popupmessage + "</span>");
					window.location = "/aucaweb/app/";
				} else {
					if (window.location != "/aucaweb/app/login"){
						window.location = "/aucaweb/app/login";
					}
					$('.widget-flash-message').append("<span class='err'>" + popupmessage + "</span>");
					email = $('#email').val("");
					passw = $("#passw").val("");
				}
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
				// location.header();
				window.location = "http://localhost/aucaweb/app/";
			}
		});
	}

	var tryRegister = function(){
		var email = $('input[name="email"]').val()
			, username = $('input[name="username"]').val()
			, password = $('input[name="password"]').val()
			, cpassword = $('input[name="cpassword"]').val();
		console.log(password + " "+ cpassword);
		if(password != cpassword){
			alert("Введенные пароли не идентичны");
		} else {
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
					console.log(data);
					var result = jQuery.parseJSON(data);
					alert(result.message);
					if(result.success){
						setInterval(function(){
							window.location = "http://localhost/aucaweb/app";
						}, 1200);
					}
				}
			});
		}
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

	//On user menu click
	useropt.on('click', function(e){
		if(useropt.hasClass("active")){
			useropt.removeClass("active");
			usermenu.removeClass("visible");
		} else {
			useropt.addClass("active");
			usermenu.addClass("visible");
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

	register.on('submit', function(event){
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

	// Post form handlers
	var create_post = $('#addpost');
	create_post.on('submit ', function(event){
		event.preventDefault();
		var question = $('input[name="question"]').val()
		, description = $('textarea[name="description"]').val()
		, tags = $('input[name="tags"]').val();
		id_post = null;
		createPost(question, description, tags, id_post)
	});

	function createPost(question, description, tags, id_post){
		$.ajax({
			url: "http://localhost/aucaweb/server/post",
			method: "POST",
			data: {
				"CSRF" : CSRF,
				"title": question,
				"content": description,
				"tags": tags,
				"id_post" : id_post
			},
			success: function(data){
				var result = jQuery.parseJSON(data);
				var popupmessage = result.message;
				$('.post-flash-message > span:first').remove();
				if(result.success){
					$('.post-flash-message').append("<span class='success'>" + popupmessage + "</span>");
					window.location = "http://localhost/aucaweb/app";
				} else {
					$('.post-flash-message').append("<span class='err'>" + popupmessage + "</span>");
				}
			}
		});
	}

	options.on('click', function(){
		console.log('GO');
		window.location = "/aucaweb/app/options";
	});


	//End of file
});
