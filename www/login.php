<!DOCTYPE html>
<!--[if lt IE 7 ]> <html lang="en" class="ie6 ielt8"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="ie7 ielt8"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="ie8"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--> <html lang="en"> <!--<![endif]-->
<head>
<meta charset="utf-8">
<title>Raspberry Wifi Router</title>
<link href="css/login.css" rel="stylesheet" type="text/css">
</head>
<body>


<?php
ob_start();
session_start(); // Starting Session
$error=''; // Variable To Store Error Message
if (isset($_POST['submit'])) {
	if (empty($_POST['username']) || empty($_POST['password'])) {
	  $error = "Username or Password is invalid";
	}
	else {
	  // Define $username and $password
	  $username=$_POST['username'];
	  $password=$_POST['password'];
	  // Establishing Connection with Server by passing server_name, user_id and password as a parameter
	  $connection = mysql_connect("localhost", "root", "raspberry");
	  // To protect MySQL injection for Security purpose
	  $username = stripslashes($username);
	  $password = stripslashes($password);
	  $username = mysql_real_escape_string($username);
	  $password = mysql_real_escape_string($password);
	  // Selecting Database
	  $db = mysql_select_db("login", $connection);
	  // SQL query to fetch information of registerd users and finds user match.
	  $query = mysql_query("select * from users where password='$password' AND username='$username'", $connection);
	  $rows = mysql_num_rows($query);
	  if ($rows == 1) {
		$_SESSION['login_user']=$username; // Initializing Session
		echo "<script type='text/javascript'> document.location = 'home.php'; </script>"; // Redirecting To Other Page
	  } 
	  else {
		$error = "Username or Password is invalid";
	  }
	mysql_close($connection); // Closing Connection
	}
}


if(isset($_SESSION['login_user'])){
echo "<script type='text/javascript'> document.location = 'home.php'; </script>";
}
?>

<div class="container">
	<section id="content">
		<form action="" method="post">
			<img src="images/WiFi Logo.gif" width="180" height="120"  alt=""/><h1>Raspberry Wifi Router</h1>
			<div>
				<input name="username" type="text" required id="username" placeholder="Username" />
			</div>
			<div>
				<input name="password" type="password" required id="password" placeholder="Password" />
			</div>
			<div>
				<table width="100%" border="0">
                  <tr>
                    <td align="center">
                      <input name="submit" type="submit" id="submit" value="Log in" />
                      <br />
                      <span><?php echo $error; ?></span>
                    </td>
                  </tr>
                </table>
		  </div>
		</form><!-- form -->
		<div class="button">
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>