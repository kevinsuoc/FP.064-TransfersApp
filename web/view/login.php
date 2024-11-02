<form action="/" method="post">
    <input type="text" name="username" placeholder="nombre de usuario" required><br>
    <input type="password" name="password" placeholder="contraseña" required><br>
	<input type="hidden" name="request" value="login"> 
    <input type="submit" value="login"> <br>
</form>

<form action="/">
    <input type="hidden" name="request" value="registrarse"> 
    <input type="submit" value="registrarse"> <br>
</form>

<?php if (isset($loginError)){echo $loginError;}; ?>
<?php if (isset($loginMessage)){echo $loginMessage;}; ?>
