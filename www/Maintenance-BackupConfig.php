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
<?php logmessage("Loading page Maintenance-BackupConfig.php");?>
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
  <div id="ContentTitle">
  <span>Backup Configuration</span></div>
      
  <div id="ContentArticle">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="application/x-www-form-urlencoded" id="backup">
      <fieldset>
        <table width="100%" border="0">
          <tr>
            <td height="25" align="center">&nbsp;</td>
          </tr>
          <tr>
            <td align="center"><span id="status"><input name="backup" type="submit" id="backup" form="backup" value="Download Configuration Back-Up"></span></td>
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
	if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['backup'])) {

		echo "<script>ReturnProgress();</script>";
		flush();
		logmessage("Backing up database login.");
		shell_exec("sudo mysqldump --host=localhost --user=root --password=raspberry login > /tmp/login.db");
		logmessage("Backing up database radius.");
		shell_exec("sudo mysqldump --host=localhost --user=root --password=raspberry radius > /tmp/radius.db");
		logmessage("Backing up configuration files.");
		shell_exec("sudo tar -cf /home/pi/Raspberry-Wifi-Router/www/temp/RaspberryWifiRouterBackup.tar /etc/timezone /etc/dhcpcd.conf /boot/cmdline.txt /etc/rc.local /etc/dnsmasq.conf /etc/hostapd/hostapd.conf /etc/systemd/system/hostapd.service /etc/network/interfaces /etc/ntp.conf /home/pi/Raspberry-Wifi-Router/www/routersettings.ini /etc/systemd/system/hostapd.service /etc/freeradius/radiusd.conf /etc/freeradius/sites-available-default /etc/sudoers.d/wr_commands /etc/openvpn/* /home/pi/Raspberry-Wifi-Router/www/temp/OpenVPN_ClientPackages/* /tmp/login.db /tmp/radius.db");
		
		
	
	
	}




<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>
