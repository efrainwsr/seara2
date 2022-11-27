<?php 
  
  require_once "clases/Conexion.php";
  $obj= new conectar();
  $conexion=$obj->conexion();

  $sql="SELECT * from usuarios where email='admin'";
  $result=mysqli_query($conexion,$sql);
  $validar=0;
  if(mysqli_num_rows($result) > 0){
    $validar=1;
  }
 ?>



<link rel="stylesheet" type="text/css" href="librerias/bootstrap/css/bootstrap.min.css" id="bootstrap-css">
<script src="librerias/jquery-3.2.1.min.js"></script>
<script src="librerias/bootstrap/js/bootstrap.min.js"></script>
<script src="js/funciones.js"></script>

<!------ Include the above in your HEAD tag ---------->

<link rel="stylesheet" href="librerias/bootstrap/css/font-awesome.min.css">
<link rel="stylesheet" href="css/login.css">

<div class="container">
   <div class="row">
    <div class="col-md-5 col-md-offset-3">
      <div class="panel panel-login">
        <div class="panel-body">
          <div class="row">
            <div class="col-lg-12">
              <form id="frmLogin" style="display: block;">
                <h2>LOGIN</h2>
                  <div class="form-group">
                    <input type="text" name="usuario" id="usuario" tabindex="1" class="form-control" placeholder="Usuario" value="">
                  </div>
                  <div class="form-group">
                    <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Contraseña">
                  </div>
                  
                  <div class="col-xs-6 form-group pull-right">     
                        <span name="entrarSistema" id="entrarSistema" tabindex="4" class="form-control btn btn-login" >Entrar</span>
                  </div>
              </form>

              <form id="register-form" action="#" method="post" role="form" style="display: none;">
                <h2>REGISTER</h2>
                  <div class="form-group">
                    <input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Username" value="">
                  </div>
                  <div class="form-group">
                    <input type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="Email Address" value="">
                  </div>
                  <div class="form-group">
                    <input type="password" name="passwordL" id="passwordL" tabindex="2" class="form-control" placeholder="Password">
                  </div>
                  <div class="form-group">
                    <input type="password" name="confirm-password" id="confirm-password" tabindex="2" class="form-control" placeholder="Confirm Password">
                  </div>
                  <div class="form-group">
                    <div class="row">
                      <div class="col-sm-6 col-sm-offset-3">
                        <input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Register Now">
                      </div>
                    </div>
                  </div>
              </form>
            </div>
          </div>
        </div>
        <div class="panel-heading">
          <div class="row">
            <div class="col-xs-6 tabs">
              <a href="#" class="active" id="login-form-link"><div class="login">LOGIN</div></a>
            </div>
            <?php if(!$validar): ?>
            <div class="col-xs-6 tabs">
              <a href="#" id="register-form-link"><div class="register">REGISTER</div></a>
            </div>
          <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
  
  $(function() {
    $('#login-form-link').click(function(e) {
      $("#login-form").delay(100).fadeIn(100);
    $("#register-form").fadeOut(100);
    $('#register-form-link').removeClass('active');
    $(this).addClass('active');
    e.preventDefault();
  });
  $('#register-form-link').click(function(e) {
    $("#register-form").delay(100).fadeIn(100);
    $("#login-form").fadeOut(100);
    $('#login-form-link').removeClass('active');
    $(this).addClass('active');
    e.preventDefault();
  });

});
</script>

<script type="text/javascript">
  $(document).ready(function(){
    $('#entrarSistema').click(function(){

    vacios=validarFormVacio('frmLogin');

      if(vacios > 0){
        alert("Debes llenar todos los campos!");
        return false;
      }

    datos=$('#frmLogin').serialize();
    $.ajax({
      type:"POST",
      data:datos,
      url:"procesos/regLogin/login.php",
      success:function(r){

        if(r==1){
          window.location="vistas/inicio.php";
        }else{
          alert("No se pudo acceder.");
        }
      }
    });
  });
  });
</script>