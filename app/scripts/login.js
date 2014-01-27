$(function(){
	console.log("CSRF: "+ CSRF);
	var login = $(".login")
		, popup = $(".popup")
		, popupactive = false;

	var closePopup = function(){
		popup.fadeOut("slow", function(){
				popup.addClass("hidden");
			});
	}
	var tryLogin = function(){
		event.preventDefault();
		var email = $('#email').val()  // Stores user email
			, passw = $("#passw").val(); // Stores user password
		console.log(email + " " + passw);
	}

	// Showing popup window on click
	login.on('click', function(){
		popup.fadeIn("slow", function(){
			popup.removeClass("hidden");	
			popupactive = true;
		})
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
	var submit = $("#logform");
	submit.on('submit', function(event){
		tryLogin();
	});
});