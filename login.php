<?php
#	Inicializa a sessão
session_start();
ob_start();


#	Controle
include_once("control/comom.php");


#	Cookies
$email = (isset($_COOKIE['CookieEmail'])) ? decrypta($_COOKIE['CookieEmail']) : '';
$senha = (isset($_COOKIE['CookieSenha'])) ? decrypta($_COOKIE['CookieSenha']) : '';
$lembrete = (isset($_COOKIE['CookieLembrete'])) ? decrypta($_COOKIE['CookieLembrete']) : '';
$checked = ($lembrete == 'SIM') ? 'checked' : '';
?>




<!DOCTYPE html>
<html>
  <head>
    <!--	metatags	-->
    <meta charset="utf-8">
    <title>.:: Admin2 ::.</title>
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="shortcut icon" href="img/favicon.ico"/>
    <link rel="bookmark" href="img/favicon.ico"/>
    
    <!-- site css -->
    <link rel="stylesheet" href="dist/css/site.min.css">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,800,700,400italic,600italic,700italic,800italic,300italic" rel="stylesheet" type="text/css">
    <style>
      body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #303641;
        color: #C1C3C6
      }
    </style>
    
    <!--	Js	-->
    <script type="text/javascript" src="dist/js/site.min.js"></script>
  </head>
  
  <body>
   
    <div class="container">
      
			<form class="form-signin" role="form" action="control/usuario_controle.php" method="post">
     		<input type="hidden" name="act" value="login">
     		<?php if(isset($_SESSION["erro_login"]) ) {//	erro login ?>
					<div class="alert alert-danger">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<?php echo $_SESSION["erro_login"]["mensagem"]; ?>
					</div>
				<?php }//fim erro login ?>
                      
      	<h3 class="form-signin-heading">Informe seus dados</h3>
        <div class="form-group">
          <div class="input-group">
            <div class="input-group-addon">
              <i class="glyphicon glyphicon-user"></i>
            </div>
            <input type="text" class="form-control" name="email" id="email" required="true" placeholder="E-mail" autocomplete="off" value="<?php echo $email; ?>"/>
          </div>
        </div>

        <div class="form-group">
          <div class="input-group">
            <div class="input-group-addon">
              <i class=" glyphicon glyphicon-lock "></i>
            </div>
            <input type="password" class="form-control" name="senha" id="senha" required="true" placeholder="Senha" autocomplete="off" value="<?php echo $senha; ?>"/>
          </div>
        </div>

        <label class="checkbox">
          <input type="checkbox" name="lembrete" value="SIM" <?php echo $checked; ?>> &nbsp Lembrar
        </label>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>
      </form>

    </div>
    <div class="clearfix"></div>
    <br><br>
    
    
    <!--footer-->
    <div class="site-footer login-footer">
      <div class="container">
        <div class="copyright clearfix text-center">
          <p><b>Admin2</b></p>
          <div class="footer-copyright text-center">© 2018 Design by Saulo. All rights reserved.</div>
        </div>
      </div>
    </div>
    
  </body>
</html>
