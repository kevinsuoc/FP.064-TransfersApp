
<div class="login-form">
<form action="/" method="post"  >
  <div class="form-group">
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input type="text" class="form-control" name="username"placeholder="nombre de usuario" id="exampleInputEmail1" aria-describedby="emailHelp" required><br>
    
  </div>
  <div class="form-group">
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
</div>
</div>
<?php if (isset($loginError)){echo $loginError;}; ?>
<?php if (isset($loginMessage)){echo $loginMessage;}; ?>