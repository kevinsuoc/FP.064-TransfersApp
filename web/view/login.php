<form action="/controller/loginController.php" ?>
	<button type="submit">Ingresar</button>
	<?php if (isset($loginError)){echo $loginError;}; ?>
</form>
