<?php
session_start();
if(isset($_SESSION['userlogged']))
{
	header("Location:dashboard.php");
}
else if($_SERVER["REQUEST_METHOD"]=="POST")
{
	require_once 'library/functions.login.php';
	$username=htmlspecialchars($_POST["username"]);
	$password=htmlspecialchars($_POST["password"]);
	
	$login=new Login();
	$session=$login->authenticate($username, $password);
	if($session)
	{
		$_SESSION["userlogged"]=1;
		$_SESSION["username"]=$session["username"];
		header("Location:dashboard.php");
	}
	else
	{
		$notification="Invalid Username/Password";
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
	<meta name="author" value="Saravanan Jayabalan">
	<title>Bingo!!</title>
	<!-- Bootstrap by Twitter -->
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.css">
	<script type="text/javascript" src="js/bootstrap.js"></script>
	<!-- jQuery with jQuery UI -->
	<link rel="stylesheet" type="text/css" href="css/jquery-ui-1.10.3.custom.css">
	<script type="text/javascript" src="js/jquery-1.9.1.js"></script>
	<script type="text/javascript" src="js/jquery-ui-1.10.3.custom.js"></script>
	<style type="text/css">
      body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
      }

      .form-signin {
        max-width: 300px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }
      .form-signin .form-signin-heading,
      .form-signin .checkbox {
        margin-bottom: 10px;
      }
      .form-signin input[type="text"],
      .form-signin input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
      }
    </style>
</head>
<body>
	<div class="container">
	    <form class="form-signin" action="index.php" method="post">
	        <h2 class="form-signin-heading">Please sign in</h2>
	        <?php
			if(isset($notification))
			{
				?>
				<div class="alert alert-error">
					<?php echo $notification;?>
				</div>
				<?php
				unset($notification);
			}
			?>
	        <input type="text" name="username" class="input-block-level" placeholder="Username">
	        <input type="password" name="password" class="input-block-level" placeholder="Password">
	        <button class="btn btn-large btn-primary" type="submit">Sign in</button>
			<hr>
		    <div class="footer">
			    <p>&copy; 2013-16 | Saravanan Jayabalan</p>
		    </div>
	    </form>
	</div> 
</body>
</html>