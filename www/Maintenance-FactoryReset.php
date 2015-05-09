<!-- check if our login_user is set, otherwise redirect to the logon screen -->
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
function ReturnProgress() {
    
	document.getElementById('status').innerHTML = 'Please stand by, rebooting ...';
	document.getElementById('progress').innerHTML = '<img src="images/ProgressIndicator.GIF" width="100" height="15"  alt="">';
}
function GoToHome() {
	window.location = '/login.php';
}
</script>
<?php include 'functions.php';?>
<?php logmessage("Loading page Advanced-NetworkFilter.php");?>
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
               <li><a href='Maintenance-ChangePassword.php'><span>Change Password</span></a></li>
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
  <span>Reset Factory Default</span></div>
      
  <div id="ContentArticle">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="application/x-www-form-urlencoded" id="reboot">
      <fieldset>
        <table width="100%" border="0">
          <tr>
            <td height="60" align="center">Warning, after resetting to default configuration all connections will be disconnected and the access point will be rebooted.</td>
          </tr>
          <tr>
            <td align="center"><span id="status"><input name="reboot" type="submit" id="reboot" form="reboot" value="Reset to factory default configuration"></span></td>
          </tr>
          <tr>
            <td align="center"><span id="progress"></span></td>
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
	if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['reboot'])) {
		logmessage("Factory reset initiated.");

		echo "<script>ReturnProgress();</script>";
		echo "<script>setTimeout(GoToHome, 60000);</script>";

    	logmessage("Copying /home/pi/Raspberry-Wifi-Router/defconfig/cmdline.txt to /boot/cmdline.txt");
		shell_exec("sudo cp /home/pi/Raspberry-Wifi-Router/defconfig/cmdline.txt /boot/cmdline.txt 2>&1 | sudo tee --append /var/log/raspberrywap.log");

    	logmessage("Copying /home/pi/Raspberry-Wifi-Router/defconfig/rc.local to /etc/rc.local");
		shell_exec("sudo cp /home/pi/Raspberry-Wifi-Router/defconfig/dnsmasq.conf /etc/dnsmasq.conf 2>&1 | sudo tee --append /var/log/raspberrywap.log");

    	logmessage("Copying /home/pi/Raspberry-Wifi-Router/defconfig/dnsmasq.conf to /etc/dnsmasq.conf");
		shell_exec("sudo cp /home/pi/Raspberry-Wifi-Router/defconfig/dnsmasq.conf /etc/dnsmasq.conf 2>&1 | sudo tee --append /var/log/raspberrywap.log");
 
    	logmessage("Copying /home/pi/Raspberry-Wifi-Router/defconfig/hostapd.conf to /etc/hostapd/hostapd.conf");
		shell_exec("sudo cp /home/pi/Raspberry-Wifi-Router/defconfig/hostapd.conf /etc/hostapd/hostapd.conf 2>&1 | sudo tee --append /var/log/raspberrywap.log");
 
    	logmessage("Copying /home/pi/Raspberry-Wifi-Router/defconfig/interfaces to /etc/network/interfaces");
		shell_exec("sudo cp /home/pi/Raspberry-Wifi-Router/defconfig/interfaces /etc/network/interfaces 2>&1 | sudo tee --append /var/log/raspberrywap.log");

    	logmessage("Copying /home/pi/Raspberry-Wifi-Router/defconfig/ntp.conf to /etc/ntp.conf");
		shell_exec("sudo cp /home/pi/Raspberry-Wifi-Router/defconfig/ntp.conf /etc/ntp.conf 2>&1 | sudo tee --append /var/log/raspberrywap.log");

    	logmessage("Copying /home/pi/Raspberry-Wifi-Router/defconfig/routersettings.ini to /var/www/routersettings.ini");
		shell_exec("sudo cp /home/pi/Raspberry-Wifi-Router/defconfig/routersettings.ini /var/www/routersettings.ini 2>&1 | sudo tee --append /var/log/raspberrywap.log");

    	logmessage("Copying /home/pi/Raspberry-Wifi-Router/defconfig/radiusd.conf to /etc/freeradius/radiusd.conf");
		shell_exec("sudo cp /home/pi/Raspberry-Wifi-Router/defconfig/radiusd.conf /etc/freeradius/radiusd.conf 2>&1 | sudo tee --append /var/log/raspberrywap.log");

    	logmessage("Copying /home/pi/Raspberry-Wifi-Router/defconfig/sites-available-default to /etc/freeradius/sites-available-default");
		shell_exec("sudo cp /home/pi/Raspberry-Wifi-Router/defconfig/sites-available-default  /etc/freeradius/sites-available-default 2>&1 | sudo tee --append /var/log/raspberrywap.log");

    	logmessage("Copying /home/pi/Raspberry-Wifi-Router/defconfig/wr_commands to /etc/sudoers.d/wr_commands");
		shell_exec("sudo cp /home/pi/Raspberry-Wifi-Router/defconfig/wr_commands /etc/sudoers.d/wr_commands 2>&1 | sudo tee --append /var/log/raspberrywap.log");


    	logmessage("Resetting admin password to default password 'raspberry'");
		shell_exec("sudo echo \"update users set password = 'raspberry' where username = 'admin';\" | sudo mysql --host=localhost --user=root --password=raspberry --database login 2>&1 | sudo tee --append /var/log/raspberrywap.log");

    	
		logmessage("Dropping Radius database.");
		shell_exec("sudo echo 'drop database radius;' | sudo mysql --host=localhost --user=root --password=raspberry 2>&1 | sudo tee --append /var/log/raspberrywap.log");
 
    	logmessage("Dropping Radius user.");
		shell_exec("sudo echo \"DROP USER 'radius'@'localhost';\" | sudo mysql --host=localhost --user=root --password=raspberry 2>&1 | sudo tee --append /var/log/raspberrywap.log");

    	logmessage("Recreating Radius database.");
		shell_exec("sudo echo 'create database radius;' | sudo mysql --host=localhost --user=root --password=raspberry 2>&1 | sudo tee --append /var/log/raspberrywap.log");
 
    	logmessage("Importing radius database schema.");
		shell_exec("sudo mysql --host=localhost --user=root --password=raspberry --database=radius < /etc/freeradius/sql/mysql/schema.sql 2>&1 | sudo tee --append /var/log/raspberrywap.log");
 
    	logmessage("Importing radius database admin schema.");
		shell_exec("sudo mysql --host=localhost --user=root --password=raspberry --database=radius < /etc/freeradius/sql/mysql/admin.sql 2>&1 | sudo tee --append /var/log/raspberrywap.log");

    	logmessage("Populating radius database with 1 user account.");
		shell_exec("sudo echo \"insert into radcheck (username, attribute, op, value) values ('user', 'Cleartext-Password', ':=', 'password');\" | mysql --host=localhost --user=root --password=raspberry radius 2>&1 | sudo tee --append /var/log/raspberrywap.log");



		logmessage("Disabling wlan0 ip address restore on boot in rc.local.");
		shell_exec("sudo sed -i 's/ip addr add 192.168.1.1\/24 dev wlan0/# ip addr add 192.168.1.1\/24 dev wlan0/g' /etc/rc.local");
		logmessage("Disabling iptables restore on boot in rc.local");
		shell_exec("sudo sed -i 's/iptables-restore < \/var\/tmp\/iptables/# iptables-restore < \/var\/tmp\/iptables/g' /etc/rc.local");
		logmessage("Disabling ip forwarding restore on boot in rc.local");
		shell_exec("sudo sed -i 's/sysctl -w net.ipv4.ip_forward=1/# sysctl -w net.ipv4.ip_forward=1/g' /etc/rc.local");



		logmessage("Stopping Captive Portal service and unscheduling chilli service at boot time");
		shell_exec("sudo killall chilli ; sudo update-rc.d -f chilli remove");

		session_start();
		session_destroy();

		logmessage("Reboot initiated.");
		shell_exec("sudo reboot");
	}
  ?>

<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>
