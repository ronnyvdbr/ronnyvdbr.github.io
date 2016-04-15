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
<script>
function ReturnStatus(message) {
    
	document.getElementById('status').innerHTML = message;
}
function ReturnProgress() {
    
	document.getElementById('status').innerHTML = 'Restoring back-up and rebooting Raspberry Pi, please wait for the login screen...';
	document.getElementById('progress').innerHTML = '<img src="images/ProgressIndicator.GIF" width="100" height="15"  alt="">';
}


function GoToHome() {
	window.location = '/login.php';
}
</script>
<?php include 'functions.php';?>
<?php logmessage("Loading page Maintenance-RestoreConfig.php");?>
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
              <li><a href='Maintenance-ChangePassword.php'><span>Password</span></a></li>
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
  <div id="ContentTitle">
  <span>Restore Configuration</span></div>
      
  <div id="ContentArticle">
   <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data" id="restore">
    <fieldset><legend>Upload configuration</legend>
      <table width="100%" border="0">
        <tbody>
          <tr>
            <td align="left">
              
              Select back-up to upload:          <br>
              </td>
          </tr>
          <tr>
            <td height="48" align="center"><input name="fileToUpload" type="file" id="fileToUpload" form="restore" style="width: 100%"></td>
            </tr>
          <tr>
            <td align="left"><input name="submit" type="submit" form="restore" value="Upload back-up" id="restore2"></td>
          </tr>
          <tr>
            <td align="center">&nbsp;</td>
          </tr>
          <tr>
            <td align="center"><span id="status" style="color:red">&nbsp;</span></td>
          </tr>
          <tr>
            <td align="center"><span id="progress">&nbsp;</span></td>
            </tr>
        </tbody>
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

  if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['submit'])) {

	$target_dir = "temp/";
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	
	// Check if file already exists
	if (file_exists($target_file)) {
		echo "<script>ReturnStatus('Sorry, file already exists.');</script>";
		logmessage("Backup not uploaded, file already exists.");
		$uploadOk = 0;
	}
	
	// Check file size
	if ($_FILES["fileToUpload"]["size"] > 500000) {
		echo "<script>ReturnStatus('Sorry, your file is too large.');</script>";
		logmessage("Backup not uploaded, file is too large.");
		$uploadOk = 0;
	}
	
	// Allow certain file formats
	if($imageFileType != "tar") {
		echo "<script>ReturnStatus('Sorry, only tar files are allowed.');</script>";
		logmessage("Backup not uploaded, only tar files are allowed.");
		$uploadOk = 0;
	}
	
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk !== 0) {
		if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
			
			//upload succeeded
			echo "<script>ReturnProgress();</script>";
			echo "<script>setTimeout(GoToHome, 60000);</script>";
			flush();
			
			//extracting file (restoring backup)
			logmessage("Mounting boot partition read-write.");
			shell_exec("sudo mount -o rw,relatime,fmask=0000,dmask=0022,codepage=437,iocharset=ascii,shortname=mixed,errors=remount-ro /dev/mmcblk0p1 /boot 2>&1 | sudo tee --append /var/log/raspberrywap.log");			
		  
			logmessage("Backup file /home/pi/Raspberry-Wifi-Router/www/temp/" . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.");
			logmessage("Extracting tar archive /home/pi/Raspberry-Wifi-Router/www/temp/" . basename($_FILES["fileToUpload"]["name"]));
			shell_exec("sudo tar -xf /home/pi/Raspberry-Wifi-Router/www/temp/" . basename($_FILES["fileToUpload"]["name"]) . " -C / 2>&1 | sudo tee --append /var/log/raspberrywap.log");
			
			logmessage("Mounting boot partition read-only.");
			shell_exec("sudo mount -o ro,relatime,fmask=0022,dmask=0022,codepage=437,iocharset=ascii,shortname=mixed,errors=remount-ro /dev/mmcblk0p1 /boot 2>&1 | sudo tee --append /var/log/raspberrywap.log");			
		  
			// restoring mysql databases
			logmessage("Restoring mysql database: login");
			shell_exec("sudo mysql --host=localhost --user=root --password=raspberry login < /tmp/login.db 2>&1 | sudo tee --append /var/log/raspberrywap.log");
			logmessage("Restoring mysql database: radius");
			shell_exec("sudo mysql --host=localhost --user=root --password=raspberry radius < /tmp/radius.db 2>&1 | sudo tee --append /var/log/raspberrywap.log");
			
			//reading service states from back-up file.
			logmessage("Reading service states from back-up.");
			$servicestates = parse_ini_file("/home/pi/Raspberry-Wifi-Router/www/temp/servicestates.ini");
			
			//restoring service states
			logmessage("Restoring service states from back-up.");
			
			if($servicestates['ntp.service'] == "enabled") {
			  shell_exec("sudo systemctl enable ntp.service 2>&1 | sudo tee --append /var/log/raspberrywap.log");
			}
			else {
			  shell_exec("sudo systemctl disable ntp.service 2>&1 | sudo tee --append /var/log/raspberrywap.log");
			}
			if($servicestates['dhcpcd.service'] == "enabled") {
			  shell_exec("sudo systemctl enable dhcpcd.service 2>&1 | sudo tee --append /var/log/raspberrywap.log");
			}
			else {
			  shell_exec("sudo systemctl disable dhcpcd.service 2>&1 | sudo tee --append /var/log/raspberrywap.log");
			}
			if($servicestates['hostapd.service'] == "enabled") {
			  shell_exec("sudo systemctl enable hostapd.service 2>&1 | sudo tee --append /var/log/raspberrywap.log");
			}
			else {
			  shell_exec("sudo systemctl disable hostapd.service 2>&1 | sudo tee --append /var/log/raspberrywap.log");
			}
			if($servicestates['openvpn.service'] == "enabled") {
			  shell_exec("sudo systemctl enable openvpn.service 2>&1 | sudo tee --append /var/log/raspberrywap.log");
			}
			else {
			  shell_exec("sudo systemctl disable openvpn.service 2>&1 | sudo tee --append /var/log/raspberrywap.log");
			}
			
			//removing back-up file
			logmessage("Removing back-up file.");
			shell_exec("sudo rm -fv /home/pi/Raspberry-Wifi-Router/www/temp/" . basename($_FILES["fileToUpload"]["name"]) . " 2>&1 | sudo tee --append /var/log/raspberrywap.log");
			
			session_start();
			session_destroy();
	
			logmessage("Reboot initiated.");
			shell_exec("sudo reboot");

			
			
		} else {
		  echo "<script>ReturnStatus('Sorry, could not upload backup file, error unspecified, giving up.');</script>";
		}
	}
  }
?>



<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>
