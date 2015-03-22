<h1>Login</h1>
<form name="formname" method="POST">
	Name: <input type="text" name="login_name"><br><br>
	Password: <input type="password" name="login_password"><br><br>
	<input type="checkbox" name="cookie_remember"> <span onclick="$(this).prev().trigger('click')" style="cursor:pointer">Remember me</span><br><br>
	<input type="submit" value="Login">
</form>