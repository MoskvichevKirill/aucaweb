$(function(){
	var login = $(".login")
		, popup = $(".popup")
		, logout = $(".logout")
		, register = $('#register')
		, useropt = $('.optbtn')
		, usermenu = $('.usermenu')
		, options = $('.options')
		, comment_form = $('.comment-form')
		, popupactive = false
		, activereply;

	var closePopup = function(){
		popup.fadeOut("slow", function(){
				popup.addClass("hidden");
			});
	}
	var tryLogin = function(){
		var email = $('input[name="email"]').val(),
				passw = $('input[name="password"]').val();
		console.log(email + " " + passw);
		$.ajax({
			url: "/aucaweb/app/login",
			method: "POST",
			data:{
				"CSRF" : CSRF,
				"email" : email,
				"password" : passw
			},
			success: function(data){
				console.log(data);
				var result = JSON.parse(data);
				var popupmessage = result.message;
				$('.widget-flash-message > span:first').remove();
				if(result.success){
					$('.widget-flash-message').append("<span class='success'>" + popupmessage + "</span>");
					location.reload();
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
			url: "/aucaweb/app/logout",
			method: "POST",
			data:{
				"CSRF" : CSRF
			},
			success: function(data){
				console.log('logout successful');
				// location.header();
				window.location = "/aucaweb/app/";
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
				url: "/aucaweb/app/register",
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
							window.location = "/aucaweb/app";
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
			url: "/aucaweb/app/post",
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
					if(id_post == null){
						$('.post-flash-message').append("<span class='success'>" + popupmessage + "</span>");
						window.location = "/aucaweb/app";
					} else{
						location.reload();
					}
				} else {
					$('.post-flash-message').append("<span class='err'>" + popupmessage + "</span>");
				}
			}
		});
	}

	options.on('click', function(){
		window.location = "/aucaweb/app/options";
	});
	comment_form.on('submit', function(event){
		event.preventDefault();
		var comment = $(this).find('.inp-comment').val();
		var id_post = $(this).find('input[name="id_post"]').val();
		createPost("", comment, "", id_post);
	});


	$('.reply-comment').on('click', function(e){
      e.preventDefault();
      if(activereply !== undefined){
      	console.log(activereply);
      	console.log($(this).next('.reply-form'));
      	if(activereply[0] == $(this).next('.reply-form')[0]){
      		$(this).next('.reply-form').hide();
      		activereply = undefined;
      		console.log("the same")
      	} else {
      		activereply.hide();
      		activereply = $(this).next('.reply-form');
      		$(this).next('.reply-form').show();
      	}
      } else {
      	activereply = $(this).next('.reply-form');
      	$(this).next('.reply-form').show();
      }
  });

  var ratePost = function(id, num, rate){
  	console.log(id, num);
  	$.ajax({
  		url: "/aucaweb/app/rate",
  		method: "POST",
  		data :{
  			"CSRF" : CSRF,
  			"id_post" : id,
				"inc" : num
  		},
  		success: function(data){
  			data = jQuery.parseJSON(data);
  			console.log(data);
  			if(data.success){
	  			console.log(parseInt(rate.find('.rate').text()) + num);
	  			var rating  = parseInt(rate.find('.rate').text()) + num;
	  			rate.find('.rate').text(rating);
	  			if(data.data == 1){
		  			rate.find('.down').removeClass("voted-down");
						rate.find('.up').addClass("voted-up");
	  			} else if(data.data == -1){
	  				rate.find('.up').removeClass("voted-up");
						rate.find('.down').addClass("voted-down");
	  			} else {
	  				rate.find('.down').removeClass("voted-down");
	  				rate.find('.up').removeClass("voted-up");
	  			}
  			}
  		}
  	});
  }
  var prev_rate =
  {
  	id: "",
  	inc: ""
  };
	$('.up').on('click', function(event){
		var id = $(this).parent().parent().data('id');
		ratePost(id, 1,$(this).parent().parent());
	});
	$('.down').on('click', function(event){
		var id = $(this).parent().parent().data('id');
		ratePost(id, -1, $(this).parent().parent());
	});
	//End of file
});
