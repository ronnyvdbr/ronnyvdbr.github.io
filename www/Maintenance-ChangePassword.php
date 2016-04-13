<?php include('logincheck.php');?>
<!doctype html>
<html lang="en"><!-- InstanceBegin template="/Templates/RWR-Template.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta charset="utf-8"> 
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- InstanceBeginEditable name="doctitle" -->
<title>Raspberry Wifi Router</title>
<!-- InstanceEndEditable -->
<link href="css/stylesheet.css" rel="stylesheet" type="text/css">
<link href="css/CssMenuStylesheet.css" rel="stylesheet" type="text/css">
<script src="Scripts/jquery-2.1.3.min.js" type="text/javascript"></script>
<script src="Scripts/CssMenuScript.js" type="text/javascript"></script>
<!-- InstanceBeginEditable name="head" -->
<?php include 'functions.php';?>
<?php logmessage("Loading page Maintenance-ChangePassword.php");?>
<script>
function ReturnProgressOperation() {
    document.getElementById('ReturnOperationStatus').innerHTML = '<img src="images/ProgressIndicator.GIF" width="100" height="15"  alt="">';
}
function ReturnReadyOperation() {
    document.getElementById('ReturnOperationStatus').innerHTML = '<img src="images/Ready.png" width="20" height="20"  alt="">';
}
function ReturnFailure(error) {
    document.getElementById("ReturnOperationStatus").innerHTML = '<img src="images/Fail.jpg" width="20" height="20"  alt=""/><br />There was a problem saving your details: <br />' + error + '<br />';
}

</script>
<!-- InstanceEndEditable --> 
</head>
 

<body>

<div class="container"> 
  
  <header>
    <div id="titlebar">
      <span><img src="images/WiFi%20Logo.gif" width="180" height="120"  alt=""/></span>
      <span id="title"><h1>Raspberry WiFi Router</h1></span>
    </div>
  </header>


  <div class="sidebar1">
    <nav>
      <div id='cssmenu'>
      <ul>
         <li class='active' id="Home"><a href='home.php'><span>Home</span></a></li>
         <li class='has-sub' id="Configuration"><a href='#'><span>Configuration</span></a>
            <ul id="ConfigurationUl">
               <li><a href='Configuration-DateTime.php'><span>Date/Time</span></a></li>
               <li><a href='Configuration-OperationMode.php'><span>Operation Mode</span></a></li>
               <li><a href='Configuration-NetworkSettings.php'><span>Network Settings</span></a></li>
               <li><a href='Configuration-WirelessSettings.php'><span>Wireless Settings</span></a></li>
            </ul>
         </li>
         <!--<li class='has-sub' id="Advanced"><a href='#'><span>Advanced</span></a>
            <ul id="AdvancedUl">
               <li><a href='Advanced-PortForwarding.php'><span>Port Forwarding</span></a></li>
               <li><a href='Advanced-CaptivePortal.php'><span>Captive Portal</span></a></li>
               <li><a href='Advanced-NetworkFilter.php'><span>Network Filter</span></a></li>
               <li><a href='Advanced-WebFilter.php'><span>Web Filter</span></a></li>
               <li class='last'><a href='Advanced-Wireless.php'><span>Advanced Wireless</span></a></li>
            </ul>
         </li>-->
        <li class='has-sub' id="Maintenance"><a href='#'><span>Maintenance</span></a>
            <ul id="MaintenanceUl">
               <li><a href='Maintenance-BackupConfig.php'><span>Backup Config</span></a></li>
               <li><a href='Maintenance-RestoreConfig.php'><span>Restore Config</span></a></li>
               <li><a href='Maintenance-FactoryReset.php'><span>Factory Reset</span></a></li>
               <li class='last'><a href='Maintenance-Reboot.php'><span>Reboot</span></a></li>
            </ul>
         </li>

         <li class='has-sub' id="Logs"><a href='#'><span>Logs</span></a>
            <ul id="LogsUl">
               <li><a href='Logs-Routerlog.php'><span>Routerlog</span></a></li>
               <li><a href='Logs-Dmesg.php'><span>Dmesg</span></a></li>
               <li><a href='Logs-Syslog.php'><span>Syslog</span></a></li>
               <li class='last'><a href='Logs-Messages.php'><span>Messages</span></a></li>
            </ul>
         </li>
         <li id="Logs"><a href='logout.php'><span>Log out</span></a>
         </li>
      </ul>
      </div>
    </nav>
  </div><!-- end .sidebar1 -->
  <!-- InstanceBeginEditable name="MenuExpander" -->
  <script>
	$('#Home').removeClass('active');
	$('#Maintenance').addClass('active');
	$('#MaintenanceUl').show();
  </script>
  <!-- InstanceEndEditable -->
  
  <article class="content">
    <!-- InstanceBeginEditable name="article" -->

<!-- ********************************************************************************************************************** -->
  <?php 
	if($_SERVER['REQUEST_METHOD'] == 'POST') {
	  logmessage("Processing Password form data.");
	  
	  $savepasswordflag = "";
	  $password = $repeatpassword = "";
	  $passworderr = $repeatpassworderr = "";
	  
	  if (!empty($_POST["password"])) {
		$password = test_input($_POST["password"]);
		if (!preg_match("/^[a-zA-Z0-9_-]*$/",$password)) {
		  $passworderr = "dhcpuid field contains incorrect data, only a-zA-Z0-9_- allowed!<br />"; 
		}
	  }

	  if (!empty($_POST["repeatpassword"])) {
		$repeatpassword = test_input($_POST["repeatpassword"]);
		if (!preg_match("/^[a-zA-Z0-9_-]*$/",$repeatpassword)) {
		  $repeatpassworderr = "dhcpuid field contains incorrect data, only a-zA-Z0-9_- allowed!<br />"; 
		}
	  }
	
	  if (empty($passworderr) && empty($repeatpassworderr)) {
		  if($password == $repeatpassword) {
			  $savepasswordflag = "ok";
		  }
		  else {
			echo "<script>ReturnFailure('Passwords do not match!');</script>";
		  }
	  }
	  else {
		  echo "<script>ReturnFailure('" . $passworderr . "'+'" . $repeatpassworderr . "');</script>";
	  }
	}
  ?>

<!-- ********************************************************************************************************************** -->
    <div id="ContentTitle">
      <span>Change Password</span>
    </div>
  
    <div id="ContentArticle">
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="application/x-www-form-urlencoded" id="formtimesync">
        <fieldset>
          <legend>Change password</legend>
          <table width="100%" border="0">
            <tr>
              <td width="40%" align="right"><label for="password">Password:</label></td>
              <td width="60%"><input name="password" type="password" autofocus required="required" id="password" pattern="^[a-zA-Z0-9_-]*$"></td>
            </tr>
            <tr>
              <td align="right"><label for="password2">Repeat Password:</label> </td>
              <td><input name="repeatpassword" type="password" required="required" id="repeatpassword" pattern="^[a-zA-Z0-9_-]*$"></td>
            </tr>
            <tr>
              <td width="40%" align="right"><input name="applybutton" type="submit" id="applybutton" value="Apply"></td>
              <td width="60%"><span id="ReturnOperationStatus"></span></td>
            </tr>

          </table>
        </fieldset>
      </form>
    </div>
      
    <!-- InstanceEndEditable -->
  </article><!-- end .content -->


  <aside>
  <!-- InstanceBeginEditable name="aside" -->
  
  
  
  <!-- InstanceEndEditable -->
  </aside>


  <footer>
  <p>Designed by Ronny Van den Broeck </p>
  <!-- InstanceBeginEditable name="footer" -->

  
  
  <!-- InstanceEndEditable -->
  </footer>
</div><!-- end .container -->

<!-- InstanceBeginEditable name="code" -->
  <?php
	if($_SERVER['REQUEST_METHOD'] == 'POST') {
	  if($savepasswordflag == "ok") {
		  echo "<script>ReturnProgressOperation();</script>";
		  flush();
		  // Establishing Connection with Server by passing server_name, user_id and password as a parameter
		  $connection = mysql_connect("localhost", "root", "raspberry");
		  // Selecting Database
		  $db = mysql_select_db("login", $connection);
		  // SQL Query To update password
		  mysql_query("update users set password = '$password' where username = 'admin'", $connection);
		  mysql_close($connection); // Closing Connection
		  session_start();
          session_destroy();
		  echo "<script type='text/javascript'> document.location = 'login.php'; </script>"; // Redirecting To Login Page
	  }	  
	}
  ?>






<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>
