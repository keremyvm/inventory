<?php 
if(isset($_SESSION["nombre"]))
{
  header("Location: ".BASE_URL."main");
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo LIBRARIES ?>bower_components/bootstrap/dist/css/bootstrap.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo LIBRARIES ?>bower_components/font-awesome/css/font-awesome.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo LIBRARIES ?>bower_components/Ionicons/css/ionicons.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo LIBRARIES ?>dist/css/AdminLTE.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo LIBRARIES ?>plugins/iCheck/square/blue.css">
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <!-- my styles -->
  <link rel="stylesheet" href="<?php echo CSS ?>login.css">
  <link rel="stylesheet" href="lib/font/stylesheet.css">
</head>
<!--==========================
=            Body            =---------------------------------------------------
===========================-->
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
      <img src="<?php echo IMG?>plantilla/logo-blanco-bloque.png" alt="" class="img-responsive logo-header">
  </div>
  <div class="login-box-body">
      <p class="login-box-msg" >Ingreso al Sistema</p>
      <form id="frm_login" method="post" autocomplete="on" action="<?php echo BASE_URL?>login/iniciar">
         <!-- <form id="frm_login" method="post" autocomplete="on" action="http://127.0.0.1/inventory/login/iniciar"> -->
          <!-- input usuario -->
          <div class="form-group has-feedback">
              <input type="text" class="form-control" placeholder="Usuario" name="txt_usuario" id="txt_usuario">
              <span class="glyphicon glyphicon-user form-control-feedback"></span>
              <span class="txt_usuario input-error"></span>
          </div>
          <!-- input password -->
          <div class="form-group has-feedback">
              <input type="password" class="form-control" placeholder="Password" name="txt_password" id="txt_password">
              <span class="glyphicon glyphicon-lock form-control-feedback"></span>
              <span class="txt_password input-error" id="caracter-error"></span>
          </div>
          <!-- boton logeo -->
          <div class="row mt-2">
              <div class="col-xs-4" id="panel-btn">
                  <button type="submit" class="btn btn-primary btn-block btn-flat" id="btn_logeo">Ingresar</button>
              </div>
          </div>
      </form>
  </div>
</div>
<!--==========================
=            Script            =-------------------------------------------------------
===========================-->
<!-- <script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script> -->
<!--==========================
=           end Script            =-------------------------------------------------------
===========================-->
<!-- jQuery 3 -->
<script src="<?php echo LIBRARIES ?>bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo LIBRARIES ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?php echo LIBRARIES ?>plugins/iCheck/icheck.min.js"></script>
<!-- ajax -->
<script src="<?php echo AJAX ?>ajax_login.js"></script>  
</body>
</html>
