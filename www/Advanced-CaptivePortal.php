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
<script>
function ReturnProgress_form_enableportal() {
    document.getElementById('ReturnStatus_form_enableportal').innerHTML = '<img src="images/ProgressIndicator.GIF" width="100" height="15"  alt="">';
}
function ReturnReady_form_enableportal() {
    document.getElementById('ReturnStatus_form_enableportal').innerHTML = '<img src="images/Ready.png" width="20" height="20"  alt="">';
}
function ReturnProgress_form_addusers() {
    document.getElementById('ReturnStatus_form_addusers').innerHTML = '<img src="images/ProgressIndicator.GIF" width="100" height="15"  alt="">';
}
function ReturnReady_form_addusers() {
    document.getElementById('ReturnStatus_form_addusers').innerHTML = '<img src="images/Ready.png" width="20" height="20"  alt="">';
}
function ReturnStatus_form_addusers(error) {
    document.getElementById('ReturnStatus_form_addusers').innerHTML = '<img src="images/Fail.jpg" width="20" height="20"  alt=""/>' + error;
}
function ReturnProgress_form_deleteusers() {
    document.getElementById('ReturnStatus_form_deleteusers').innerHTML = '<img src="images/ProgressIndicator.GIF" width="100" height="15"  alt="">';
}
function ReturnReady_form_deleteusers() {
    document.getElementById('ReturnStatus_form_deleteusers').innerHTML = '<img src="images/Ready.png" width="20" height="20"  alt="">';
}
function ReturnStatus_form_deleteusers(error) {
    document.getElementById('ReturnStatus_form_deleteusers').innerHTML = '<img src="images/Fail.jpg" width="20" height="20"  alt=""/>' + error;
}
</script>
<?php include 'functions.php';?>
<?php include 'mysqlfunctions.php';?>
<?php logmessage("Loading page Advanced-CaptivePortal.php");?>
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
         <li class='has-sub' id="Advanced"><a href='#'><span>Advanced</span></a>
            <ul id="AdvancedUl">
               <li><a href='Advanced-PortForwarding.php'><span>Port Forwarding</span></a></li>
               <li><a href='Advanced-CaptivePortal.php'><span>Captive Portal</span></a></li>
               <li><a href='Advanced-NetworkFilter.php'><span>Network Filter</span></a></li>
               <li><a href='Advanced-WebFilter.php'><span>Web Filter</span></a></li>
               <li class='last'><a href='Advanced-Wireless.php'><span>Advanced Wireless</span></a></li>
            </ul>
         </li>
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
      </ul>
      </div>
    </nav>
  </div><!-- end .sidebar1 -->
  <!-- InstanceBeginEditable name="MenuExpander" -->
   <script>
	$('#Home').removeClass('active');
	$('#Advanced').addClass('active');
	$('#AdvancedUl').show();
  </script>
  <!-- InstanceEndEditable -->
  
  <article class="content">
    <!-- InstanceBeginEditable name="article" -->

  <?php   	
	$configurationsettings = parse_ini_file("/var/www/routersettings.ini");
  ?>
<!-- ********************************************************************************************************************** -->
  <?php 
	if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['button_enable'])) {
	  $doactions = False;
	  logmessage("Processing form_enableportal data.");
	  if(isset($_POST['enablecaptiveportal']) && strcmp($configurationsettings['captiveportal'],"disabled") == 0) {
		logmessage("Setting captive portal to enabled state.");
		$configurationsettings['captiveportal'] = "enabled";
		$doactions = True;
	  }
	  else if(!isset($_POST['enablecaptiveportal']) && strcmp($configurationsettings['captiveportal'],"enabled") == 0) {
		logmessage("Setting captive portal to disabled state.");
		$configurationsettings['captiveportal'] = "disabled";
		$doactions = True;
	  }
	  else {
		logmessage("Nothing to do.");
	  }
	  if($doactions) {
		logmessage("Writing captive portal state to configuration file.");
		write_php_ini($configurationsettings, "/var/www/routersettings.ini");
	  }
	}
  ?>
<!-- ********************************************************************************************************************** -->
  <?php 
	if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['button_addusers'])) {
	  logmessage("Processing addusers_form data.");

	  $username = $password = "";
	  $usernameerr = $passworderr = "";
	  
	  logmessage("Validating username input.");
	  if (!empty($_POST["username"])) {
		$username = test_input($_POST["username"]);
		if (!preg_match("/^[a-zA-Z0-9]*$/",$username)) {
		  $usernameerr = "username field contains incorrect data, only a-zA-Z0-9 allowed!<br />"; 
		}
	  }
	  
	  logmessage("Validating password input.");
	  if (!empty($_POST["password"])) {
		$password = test_input($_POST["password"]);
		if (!preg_match("/^[a-zA-Z0-9]*$/",$password)) {
		  $passworderr = "username field contains incorrect data, only a-zA-Z0-9 allowed!<br />"; 
		}
	  }
	}
  ?>
<!-- ********************************************************************************************************************** -->
  <?php 
	if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['button_deleteusers'])) {
	  logmessage("Processing deleteusers_form data.");
	  
	  $deleteuser = "";
	  
	  if (!empty($_POST["captiveportalusers"])) {
		$deleteuser = test_input($_POST["captiveportalusers"]);
	  }
	}
  ?>
<!-- ********************************************************************************************************************** -->

    <div id="ContentTitle"><span>Captive Portal</span></div>
      
    <div id="ContentArticle" <?php if(strcmp($configurationsettings['operationmode'],'Router') == 0) {echo 'style="display: none"';}?>>
      <table width="100%" border="0">
        <tr>
          <td align="center">
              <p>The Raspberry Wap is currently operating in Access Point modus.<br />
              The Captive Portal functionality is only available when the Raspberry Wap is operating in Router modus.<br />
              To switch the Raspberry Wap to Router mode, select Configuration - Operation mode, and switch to Router mode.
              </p>
          </td>
        </tr>
    </table>
    </div><!--end div contentarticle-->
<!-- ********************************************************************************************************************** -->
    <div id="ContentArticle" <?php if(strcmp($configurationsettings['operationmode'],'Access Point') == 0) {echo 'style="display: none;';}?>>
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="application/x-www-form-urlencoded" id="form_enableportal">
        <fieldset><legend>Captive Portal</legend>
          <table width="100%" border="0">
            <tr>
              <td width="40%" align="right">Enable Captive Portal:</td>
              <td width="60%"><input name="enablecaptiveportal" type="checkbox" id="enablecaptiveportal" form="form_enableportal" <?php if(strcmp($configurationsettings['captiveportal'],'enabled') == 0) {echo 'checked';}?>></td>
            </tr>
            <tr>
              <td align="right"><input name="button_enable" type="submit" id="button_enable" form="form_enableportal" value="Apply"></td>
              <td><span id="ReturnStatus_form_enableportal"></span></td>
            </tr>
          </table>
        </fieldset>
      </form>
    </div><!--end div contentarticle-->
<!-- ********************************************************************************************************************** -->
    <div id="ContentTitle" <?php if((strcmp($configurationsettings['operationmode'],'Access Point') == 0) || (strcmp($configurationsettings['captiveportal'],'disabled') == 0)) {echo 'style="display: none;';}?>>
      <span>Captive Portal User Management</span>
    </div>

    <div id="ContentArticle" <?php if((strcmp($configurationsettings['operationmode'],'Access Point') == 0) || (strcmp($configurationsettings['captiveportal'],'disabled') == 0))  {echo 'style="display: none;';}?>>

      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="application/x-www-form-urlencoded" id="form_addusers">
        <fieldset><legend>Add Users</legend>
          <table width="100%" border="0">
            <tr>
              <td width="40%" align="right"><label for="username">Username:</label></td>
              <td width="60%">
                <input name="username" type="text" id="username" form="form_addusers" placeholder="myuser" pattern="^[a-zA-Z0-9]*$">
              
              </td>
            </tr>
            <tr>
              <td align="right"><label for="password">Password:</label></td>
              <td><input name="password" type="text" id="password" form="form_addusers" placeholder="mypassword" pattern="^[a-zA-Z0-9]*$"></td>
            </tr>
            <tr>
              <td align="right"><input name="button_addusers" type="submit" id="button_addusers" form="form_addusers" value="Add User"></td>
              <td valign="middle"><span id="ReturnStatus_form_addusers"></span></td>
            </tr>
          </table>
        </fieldset>
      </form>
  </div><!--end div ContentArticle-->
<!-- ********************************************************************************************************************** -->
  <?php 
	if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['button_addusers'])) {
  	  echo "<script>ReturnProgress_form_addusers();</script>";
	  if(empty($usernameerr) && empty($passworderr)) {
		logmessage("Username & Password input don't contain any errors.");
		if(!empty($username) && !empty($password)) {
			logmessage("Writing Username & Password to database.");
			insert("INSERT INTO radcheck (username, attribute, op, value) VALUES ('$username', 'Cleartext-Password', ':=', '$password')","radius");
			echo "<script>ReturnReady_form_addusers();</script>";

		}
		else {
			logmessage("Username & Password not written to database because one of both is empty.");
			echo '<script>ReturnStatus_form_addusers("Username or Password cannot be empty");</script>';
		}
	  }
	}
  ?>
<!-- ********************************************************************************************************************** -->
  <?php 
	if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['button_deleteusers'])) {
		echo "<script>ReturnProgress_form_deleteusers();</script>";
		if(!empty($deleteuser)) {
			logmessage("Deleting user from database.");
			logmessage($deleteuser);
			delete('DELETE FROM radcheck WHERE username="' . $deleteuser . '"','radius');
			echo "<script>ReturnReady_form_deleteusers();</script>";
		}
		else {
			logmessage("No user selected, nothing to do.");
			echo ('<script>ReturnStatus_form_deleteusers("No user selected, so nothing deleted.");</script>'); 
		}
	}
  ?>
<!-- ********************************************************************************************************************** -->
    <div id="ContentTitle" <?php if((strcmp($configurationsettings['operationmode'],'Access Point') == 0) || (strcmp($configurationsettings['captiveportal'],'disabled') == 0)) {echo 'style="display: none;';}?>>
      <span>Captive Portal User Database</span>
    </div>

    <div id="ContentArticle" <?php if((strcmp($configurationsettings['operationmode'],'Access Point') == 0) || (strcmp($configurationsettings['captiveportal'],'disabled') == 0))  {echo 'style="display: none;';}?>>

      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="application/x-www-form-urlencoded" id="form_deleteusers">
        <fieldset><legend>Captive Portal Users</legend>
          <table width="100%" border="0">
            <tr>
              <td width="40%" align="right"><label for="captiveportalusers">Captive Portal Users:</label></td>
              <td width="60%">
                <select name="captiveportalusers" size="5" id="captiveportalusers" form="form_deleteusers">
                  <?php 
					$recordset = select("select username,value from radcheck","radius");                   
                  	
					if (mysqli_num_rows($recordset) > 0) {
					  // output data of each row
					  while($row = mysqli_fetch_assoc($recordset)) {
						echo '<option label="Username: ' . $row["username"] . ', Password: ' . $row["value"] . '">' . $row["username"] . '</option>';
					  }
					} 
				  ?>
                </select></td>
            </tr>
            <tr>
              <td align="right"><input name="button_deleteusers" type="submit" id="button_deleteusers" form="form_deleteusers" value="Delete User"></td>
              <td><span id="ReturnStatus_form_deleteusers"></span></td>
            </tr>
          </table>
        </fieldset>
      </form>
    </div><!--end div ContentArticle-->
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
<!-- ********************************************************************************************************************** -->
  <?php 
	if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['button_enable'])) {
	  echo "<script>ReturnProgress_form_enableportal();</script>";
	  if($doactions) { 
		switch($configurationsettings['captiveportal'])
		  {
		  case "enabled":
			flush();
			logmessage("Stopping hostapd service.");
			shell_exec("sudo service hostapd stop 2>&1 | sudo tee -a /var/log/raspberrywap.log");
			logmessage("Unconfiguring interface wlan0.");
			shell_exec("sudo ifdown wlan0 --verbose 2>&1 | sudo tee -a /var/log/raspberrywap.log");
			logmessage("Stopping dnsmasq service.");
			shell_exec("sudo service dnsmasq stop 2>&1 | sudo tee -a /var/log/raspberrywap.log");
			logmessage("Unscheduling dnsmasq service to start at boot.");
			shell_exec("sudo update-rc.d -f dnsmasq remove 2>&1 | sudo tee -a /var/log/raspberrywap.log");
			logmessage("Starting Captive Portal service.");
			shell_exec("sudo service chilli start 2>&1 | sudo tee -a /var/log/raspberrywap.log");
			logmessage("Scheduling Captive Portal service to start at boot.");
			shell_exec("sudo update-rc.d chilli defaults 2>&1 | sudo tee -a /var/log/raspberrywap.log");
			logmessage("Starting hostapd service.");
			shell_exec("sudo service hostapd start 2>&1 | sudo tee -a /var/log/raspberrywap.log");
			logmessage("Updating rc.local to default configuration.");
			shell_exec("sudo sed -i 's/ip addr add 192.168.1.1\/24 dev wlan0//g' /etc/rc.local");
		  break;
		  case "disabled":
			flush();
			logmessage("Stopping hostapd service.");
			shell_exec("sudo service hostapd stop 2>&1 | sudo tee -a /var/log/raspberrywap.log");
			logmessage("Killing Captive Portal service.");
			shell_exec("sudo killall chilli 2>&1 | sudo tee -a /var/log/raspberrywap.log");
			logmessage("Unscheduling Captive Portal service to start at boot.");
			shell_exec("sudo update-rc.d -f chilli remove 2>&1 | sudo tee -a /var/log/raspberrywap.log");
			logmessage("Starting dnsmasq service.");
			shell_exec("sudo service dnsmasq start 2>&1 | sudo tee -a /var/log/raspberrywap.log");
			logmessage("Scheduling dnsmasq service to start at boot.");
			shell_exec("sudo update-rc.d chilli defaults 2>&1 | sudo tee -a /var/log/raspberrywap.log");
			logmessage("Starting hostapd service.");
			shell_exec("sudo service hostapd start 2>&1 | sudo tee -a /var/log/raspberrywap.log");
			logmessage("Configuring interface wlan0.");
			shell_exec("sudo ifup wlan0 2>&1 | sudo tee -a /var/log/raspberrywap.log");
			logmessage("Updating rc.local to add IP address on wlan interface on boot.");
			shell_exec("sudo sed -i 's/exit 0/ip addr add 192.168.1.1\/24 dev wlan0/g' /etc/rc.local");
			shell_exec('sudo echo "exit 0" | sudo tee --append /etc/rc.local');
		  break;
		  }
	  }
	echo "<script>ReturnReady_form_enableportal();</script>";
	}
  ?>
<!-- ********************************************************************************************************************** -->
  <?php 
  if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['button_deleteusers'])) {
      if(!empty($deleteuser)) {
          echo "<script>ReturnReady_form_deleteusers();</script>";
      }
      else {
          echo ('<script>ReturnStatus_form_deleteusers("No user selected, so nothing deleted.");</script>'); 
      }
  }
?>

<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>
