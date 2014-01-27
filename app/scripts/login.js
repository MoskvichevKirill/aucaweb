$(function(){
	var login = $(".login");
	var popup = $(".popup")
	// Showing popup window on click
	login.on('click', function(){
		console.log("Sign is clicked");
		popup.fadeIn("slow", function(){
			popup.removeClass("hidden");	
		})
	});

	//Close popup window on background click
	popup.on('click', function(e){
		if(popup.is(e.target)){
			popup.fadeOut("slow", function(){
				popup.addClass("hidden");
			})
		}
	});

	//Login click event
	var submit = $("#logform");
	submit.on('submit', function(event){
		event.preventDefault();
		var email = $('#email').val()  // Stores user email
			, passw = $("#passw").val(); // Stores user password
	});
});