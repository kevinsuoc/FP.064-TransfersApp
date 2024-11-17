<div class="form-container">
<form action="/" method="post"class="login-form"  >
  <div class="form-group">
    <label for="InputEmail1" class="form-label">Email address</label>
    <input type="text" class="form-control" name="username"placeholder="nombre de usuario" id="exampleInputEmail1" aria-describedby="emailHelp" required><br>
    
  </div>
  <div class="form-group">
    <label for="InputPassword1" class="form-label">Password</label>
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