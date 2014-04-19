<?php 
  include("config.php");
  session_start();
  if(isset($_SESSION['username']))
  {
        header("Location:panel.php");
  }

?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../assets/ico/favicon.ico">

    <title>pManage| Problem set manager</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">

      <form class="form-signin" role="form" action="<?php echo $_SERVER['php_self'];?>" method="post">
        <h2 class="form-signin-heading">Sign in</h2>
        <input type="text" class="form-control" placeholder="Username" name="username" required autofocus>
        <input type="password" class="form-control" placeholder="Password" password="password"  name="password" required>
	<?php
          if(isset($_POST['submit']))
          {
            //declarations from post 
            $username=$_POST['username'];
            $passwd=$_POST['password'];
            $selectuser="SELECT * FROM account where login='$username'";
            $data=pg_query($selectuser);

            if(pg_num_rows($data)>=1)
            {
		    $row= pg_fetch_assoc($data);
                    if($row['passwd']!=$passwd)
                    {
                      echo '<span style="color:red">Incorrect Password</span>';        
                    }
                    else
                    {
                        $_SESSION['username']=$username;
                        header("Location:panel.php");
                    }
            }
            else
            {
                echo '<span style="color:red">User does not exist!</span>';
            }
          }
        ?>
        <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Sign in</button>
      </form>
	
	
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  </body>
</html>

