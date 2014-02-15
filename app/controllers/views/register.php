

<div class="signupform">
	<h2>Hello. Sign up for our website. It's free.</h2>
	<hr>
	<form name="sgnup" action="Sign Up" method="POST" onsubmit="return validate()">
		<div>Enter your preferred username</div>
		<div class="field">
			<input class="input" name="username" type="text" required/>
		</div></br>
		<div>Enter your email</div>
		<div class="field">
			<input name="email" type="email" required/>
		</div></br>
		<div>Enter your new password</div>
		<div class="field">
			<input name="password" type="password" required/>
		</div></br>
		<div>Retype password</div>
		<div class="field">
			<input name="cpassword" type="password" required/>
		</div>
	 	<p style="margin-left:130px;"><input class="btn" type="submit" value="Submit"/></p>


	 </form>

</div>

<script>
//validates the input for correct symbols
//and validates the passwords match
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
</script>