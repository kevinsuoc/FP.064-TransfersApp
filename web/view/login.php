<!doctype html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <title>Login</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </head>
<form action="/" method="post">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input type="text" class="form-control" name="username"placeholder="nombre de usuario" id="exampleInputEmail1" aria-describedby="emailHelp" required><br>
    
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" name= "password" placeholder="contraseña" required><br>
   
  </div>
  <input type="hidden" name="request" value="login">
  <button type="submit" value="login" class="btn btn-primary">Login</button>
  
</form>
<form action="/">
    <input type="hidden" name="request" value="registrarse"> 
    <button type="submit" value="registrarse" class="btn btn-primary">Registrarse</button> <br>
</form>

<?php if (isset($loginError)){echo $loginError;}; ?>
<?php if (isset($loginMessage)){echo $loginMessage;}; ?>