<?php
  
  session_start();
  
  if (isset($_SESSION["utilisateur"]))
    header('Location: profil.php');
  
  include "module.php";
  include "moduleBDD.php";
  
  
  if (isset($_POST["submit"])) {        
    $email = $_POST["email"];
    $identifiant = $_POST["identifiant"];
    
    $erreur = "";
    
    connection(true);
    if ($email!==null){
    $message=$email;
    ecrireMessage($message);
    $utilisateur = get_utilisateur_selon_email($identifiant,$email);
     
      if ($utilisateur == null)
      {
      $erreur.= "This email is not used.<br/>";
      ecrireErreur($erreur);
      }
      else{
      $utilisateur = get_utilisateur_selon_email($identifiant,$email);
      $subjet = "Find your password.";
      $text = "Hello '.$utilisateur->Identifiant', your password is '.$utilisateur->MotDePasse.'";
      // mail($email,$subjet,$text);
      smtp_send_mail($email,$subjet,$text,"IDVParisDescartes");
      }
    }
    else{
      $erreur.= "wtf";
      ecrireErreur($erreur);
    }
  }
    
  
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>IDV | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/iCheck/square/blue.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition login-page">
<?php
		//include "navbar.php";
	?>
	<div class="login-box">
	<?php
			if ($message != "")
				ecrireMessage($message);
			if ($erreur != "")
				ecrireErreur($erreur);
		?>
      <div class="login-logo">
        <a href="index.php"><img src="images/logoIDV.png" /></a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">You have forgot your password</p>
        <form action="fogetPsd.php" method="post">
          <div class="form-group has-feedback">
            <input name="identifiant" type="text" class="form-control" placeholder="Your login">
            <input name="email" type="text" class="form-control" placeholder="Your email address">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="row">
             <div class="col-xs-4 col-xs-offset-2">
              <button type="submit" name="submit" class="btn btn-primary btn-long" >OK</button>
            </div><!-- /.col -->
            <div class="col-xs-6">
              <button name="submit" class="btn btn-primary btn-long" onclick="javascript:history.go(-1);">Cancel</button>
            </div> 
           
          </div>
        </form>

        <!--<div class="social-auth-links text-center">
          <p>- OR -</p>
          <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using Facebook</a>
          <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using Google+</a>
        </div> /.social-auth-links 

        

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script> 

    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="plugins/iCheck/icheck.min.js"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
  </body>
</html>