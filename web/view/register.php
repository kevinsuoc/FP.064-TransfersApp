<?php
require_once __DIR__ . '/../view/head.php';
require_once __DIR__ . '/../view/header.php';

?>
<body>

<div class="containerfromwelcome">
<div class="airlines-welcome">
    <div class="welcome-text">
        <h1>Página de Registro 
        </h1>
    </div>
</div>

<?php
require_once __DIR__ . '/../view/forms/registrar.php';
?>
<?php
/*<form action="/" method="post"class="login-form"  >
  <div class="form-group">
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input type="text" class="form-control" name="username"placeholder="nombre de usuario" id="exampleInputEmail1" aria-describedby="emailHelp" required><br>
    
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" name= "password" placeholder="contraseña" required><br>
   
  </div>
  <div class="d-flex justify-content-around">
  <input type="hidden" name="request" value="login">
  <button type="submit" value="login" class="btn-bd-primary">Login</button>
  
</form>
<form action="/">
    <input type="hidden" name="request" value="registrarse"> 
    <button type="submit" value="registrarse" class="btn-bd-primary">Registrarse</button> <br>
</form>
</div>
</div>
</div>
*/?>
</div>
</body>
</html>

<?php if (isset($loginError)){echo $loginError;}; ?>
<?php if (isset($loginMessage)){echo $loginMessage;}; ?>