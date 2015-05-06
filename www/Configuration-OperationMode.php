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
function ReturnProgressOperation() {
    document.getElementById('ReturnOperationStatus').innerHTML = '<img src="images/ProgressIndicator.GIF" width="100" height="15"  alt="">';
}
function ReturnReadyOperation() {
    document.getElementById('ReturnOperationStatus').innerHTML = '<img src="images/Ready.png" width="20" height="20"  alt="">';
}
</script>
<?php include 'functions.php';?>
<?php logmessage("Loading page Configuration-OperationMode.php");?>
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
	$('#Configuration').addClass('active');
	$('#ConfigurationUl').show();
  </script>
  <!-- InstanceEndEditable -->
  
  <article class="content">
    <!-- InstanceBeginEditable name="article" -->
  <div id="ContentTitle">
  <span>Operation Mode</span>
  </div>
  <?php $configurationsettings = parse_ini_file("/var/www/routersettings.ini");?>

  <div id="ContentArticle">
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="application/x-www-form-urlencoded" id="formtimesync">
    <fieldset><legend>Change operation mode</legend>
      <table width="100%" border="0">
        <tr>
          <td width="40%" align="right">The Raspberry is functioning as:</td>
          <td width="60%"><span id="functionstat"><?php echo $configurationsettings['operationmode']?></span></td>
        </tr>
        <tr>
          <td align="right">Change operation mode to:</td>
          <td>
            <select name="selectopsmode" autofocus id="selectopsmode">
            	<option value="Router"<?php if($configurationsettings['operationmode'] == "Access Point") {echo " selected='selected'";}?>>Router</option>
                <option value="Access Point"<?php if($configurationsettings['operationmode'] == "Router") {echo " selected='selected'";}?>>Access Point</option>
            </select>
          </td>
        </tr>
        <tr>
          <td align="right"><input name="applybutton" type="submit" id="applybutton" value="Apply"></td>
          <td><span id="ReturnOperationStatus"></span></td>
        </tr>

      </table>
    </fieldset>
  </form>
  </div><!-- end div contentarticle-->
  
  <!-- InstanceEndEditable -->
  </article><!-- end .content -->


  <aside>
  <!-- InstanceBeginEditable name="aside" -->
  <p>Note: values in light grey are recommended values but have no configuration effect on the router.</p>
  
  
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
	
	echo "<script>ReturnProgressOperation();</script>";
	flush();
	$opsmode = "";
	$opsmodeerr = "";
	$networksettings = array();
	
	if (!empty($_POST["selectopsmode"])) {
	  $opsmode = test_input($_POST["selectopsmode"]);
	  
	  if (!strcmp($opsmode, "Access Point") && !strcmp($opsmode, "Router")) {
		$opsmodeerr = "Incorrect Selection data received!<br />"; 
	  }
	  else {  
		if (strcmp($opsmode, $configurationsettings['operationmode']) !== 0) {
			if(strcmp($opsmode,'Router') == 0) {
				logmessage("Reconfiguring operation mode to Router");
				
				logmessage("Rewriting /etc/network/interfaces file with settings for router mode");
				update_interfaces_file("Router");
				
				logmessage("Updating /var/www/routersettings.ini for Router operation mode");
				$configurationsettings['operationmode'] = "Router";
				write_php_ini($configurationsettings, "/var/www/routersettings.ini");
				
				logmessage("Updating rc.local to add IP address on wlan interface on boot.");
				shell_exec("sudo sed -i 's/# ip addr add 192.168.1.1\/24 dev wlan0/ip addr add 192.168.1.1\/24 dev wlan0/g' /etc/rc.local");
				
				logmessage("Stopping Access Point Daemon");
				shell_exec("sudo service hostapd stop 2>&1 | sudo tee --append /var/log/raspberrywap.log");

				logmessage("Unconfiguring interface eth0");
				shell_exec("sudo ifdown eth0 2>&1 | sudo tee --append /var/log/raspberrywap.log");

				//logmessage("Unconfiguring interface wlan0");
				//shell_exec("sudo ifdown wlan0 2>&1 | sudo tee --append /var/log/raspberrywap.log");
				
				logmessage("Deleting interface eth0 from bridge br0");
				shell_exec("sudo brctl delif br0 eth0 2>&1 | sudo tee --append /var/log/raspberrywap.log");
				
				logmessage("Deleting interface wlan0 from bridge br0");
				shell_exec("sudo brctl delif br0 wlan0 2>&1 | sudo tee --append /var/log/raspberrywap.log");
				
				logmessage("Unconfiguring interface br0");
				shell_exec("sudo ifdown br0 2>&1 | sudo tee --append /var/log/raspberrywap.log");
				
				logmessage("Bringing bridge interface br0 down");
				shell_exec("sudo ifconfig br0 down 2>&1 | sudo tee --append /var/log/raspberrywap.log");
				
				logmessage("Deleting bridge interface br0");
				shell_exec("sudo brctl delbr br0 2>&1 | sudo tee --append /var/log/raspberrywap.log");

				logmessage("Bringing interface eth0 down");
				shell_exec("sudo ifconfig eth0 down 2>&1 | sudo tee --append /var/log/raspberrywap.log");
				if(empty($configurationsettings['lanmac'])) {
					logmessage("Configuring default mac address 20:11:22:33:44:55 on interface eth0");
					shell_exec("sudo ifconfig eth0 hw ether 20:11:22:33:44:55 2>&1 | sudo tee --append /var/log/raspberrywap.log");
				}
				else {
					logmessage("Configuring mac address " . $configurationsettings['lanmac'] . " from configuration file on interface eth0");
					shell_exec("sudo ifconfig eth0 hw ether " . $configurationsettings['lanmac'] . " 2>&1 | sudo tee --append /var/log/raspberrywap.log");
				}
				logmessage("Bringing interface eth0 up");
				shell_exec("sudo ifconfig eth0 up 2>&1 | sudo tee --append /var/log/raspberrywap.log");
				logmessage("Configuring interface eth0");
				shell_exec("sudo ifup eth0 2>&1 | sudo tee --append /var/log/raspberrywap.log");
				
				logmessage("Removing bridge parameter from hostapd config.");
				hostapd_addbridge("disable");
				
				logmessage("Starting Access Point Management hostapd");
				shell_exec("sudo service hostapd start 2>&1 | sudo tee --append /var/log/raspberrywap.log");
				
				logmessage("Setting ip address " . $configurationsettings['wifiip'] . "/" . mask2cidr($configurationsettings['wifimask']) . " on interface wlan0");
				shell_exec("sudo ip addr add " . $configurationsettings['wifiip'] . "/" . mask2cidr($configurationsettings['wifimask']) . " dev wlan0 2>&1 | sudo tee --append /var/log/raspberrywap.log");
				
				logmessage("Enabling ip forwarding");
				shell_exec("sudo sysctl -w net.ipv4.ip_forward=1 2>&1 | sudo tee --append /var/log/raspberrywap.log");
				
				logmessage("Enabling ip forwarding restore on boot in rc.local");
				shell_exec("sudo sed -i 's/# sysctl -w net.ipv4.ip_forward=1/sysctl -w net.ipv4.ip_forward=1/g' /etc/rc.local");
				
				logmessage("Configuring dnsmasq to start at boot");
				shell_exec("sudo update-rc.d dnsmasq defaults 2>&1 | sudo tee --append /var/log/raspberrywap.log");
				
				logmessage("Starting dnsmasq");
				shell_exec("sudo service dnsmasq start 2>&1 | sudo tee --append /var/log/raspberrywap.log");

				logmessage("Enabling NAT");
				shell_exec("sudo iptables -t nat -A POSTROUTING -o eth0 -j MASQUERADE 2>&1 | sudo tee --append /var/log/raspberrywap.log");
				
				logmessage("Writing iptables to /var/tmp/iptables");
				shell_exec("sudo iptables-save > /var/tmp/iptables");
				
				logmessage("Enabling iptables restore on boot in rc.local");
				shell_exec("sudo sed -i 's/# iptables-restore < \/var\/tmp\/iptables/iptables-restore < \/var\/tmp\/iptables/g' /etc/rc.local");
				
				echo "<script>$('#functionstat').text('Router');</script>";
				echo "<script>$('#selectopsmode').val('Access Point');</script>";
			}
			
			
			
			
			
			
			
			
			if(strcmp($opsmode,'Access Point') == 0) {
				logmessage("Reconfiguring operation mode to Access Point");
				
				logmessage("Rewriting /etc/network/interfaces file with settings for Access Point mode");
				update_interfaces_file("Access Point");
				
				logmessage("Updating /var/www/routersettings.ini for Access Point operation mode");
				$configurationsettings['operationmode'] = "Access Point";
				write_php_ini($configurationsettings, "/var/www/routersettings.ini");
				
				logmessage("Disabling wlan0 ip address restore on boot in rc.local.");
				shell_exec("sudo sed -i 's/ip addr add 192.168.1.1\/24 dev wlan0/# ip addr add 192.168.1.1\/24 dev wlan0/g' /etc/rc.local");
				
				logmessage("Disabling IP forwarding");
				shell_exec("sudo sysctl -w net.ipv4.ip_forward=0  2>&1 | sudo tee --append /var/log/raspberrywap.log");
				
				logmessage("Disabling ip forwarding restore on boot in rc.local");
				shell_exec("sudo sed -i 's/sysctl -w net.ipv4.ip_forward=1/# sysctl -w net.ipv4.ip_forward=1/g' /etc/rc.local");
				
				
				if(strcmp($configurationsettings['captiveportal'],"disabled") == 0) {
					logmessage("Disabling dnsmasq to start at boot");
					shell_exec("sudo update-rc.d -f dnsmasq remove 2>&1 | sudo tee --append /var/log/raspberrywap.log");
					logmessage("Stopping dnsmasq service");
					shell_exec("sudo service dnsmasq stop  2>&1 | sudo tee --append /var/log/raspberrywap.log");
				}
				else {
				  logmessage("Stopping Captive Portal service.");
				  shell_exec("sudo killall chilli");
				  logmessage("Unscheduling Captive Portal service to start at boot.");
				  shell_exec("sudo update-rc.d –f chilli remove");
				  logmessage("Setting Captiveportal as disabled in configuration.");
				  $configurationsettings['captiveportal'] = "disabled";
				  logmessage("Saving configuration to /etc/network/interfaces file.");
				  write_php_ini($configurationsettings, "/var/www/routersettings.ini");
				}
				
				
				logmessage("Stopping Access Point Management hostapd");
				shell_exec("sudo service hostapd stop 2>&1 | sudo tee --append /var/log/raspberrywap.log");
				
				logmessage("Removing IP address from eth0");
				shell_exec("sudo ip addr flush dev eth0  2>&1 | sudo tee --append /var/log/raspberrywap.log");

				logmessage("Removing IP address from wlan0");
				shell_exec("sudo ip addr flush dev wlan0  2>&1 | sudo tee --append /var/log/raspberrywap.log");
				
				logmessage("Bringing interface eth0 down");
				shell_exec("sudo ifconfig eth0 down  2>&1 | sudo tee --append /var/log/raspberrywap.log");

				logmessage("Setting default mac address 20:11:22:33:44:56 on eth0 for access point mode");
				shell_exec("sudo ifconfig eth0 hw ether 20:11:22:33:44:56  2>&1 | sudo tee --append /var/log/raspberrywap.log");
				
				logmessage("Bringing interface eth0 up");
				shell_exec("sudo ifconfig eth0 up  2>&1 | sudo tee --append /var/log/raspberrywap.log");

				logmessage("Adding bridge parameter to hostapd config.");
				hostapd_addbridge("enable");

				//logmessage("Starting Access Point Management hostapd");
				//shell_exec("sudo service hostapd start 2>&1 | sudo tee --append /var/log/raspberrywap.log");
				
				logmessage("Configuring interface br0");
				shell_exec("sudo ifup br0 2>&1 | sudo tee --append /var/log/raspberrywap.log");			
				
				logmessage("Flushing iptables nat table entries, if any ...");
				shell_exec("sudo iptables -t nat -F 2>&1 | sudo tee --append /var/log/raspberrywap.log");
				
				logmessage("Disabling iptables restore on boot in rc.local");
				shell_exec("sudo sed -i 's/iptables-restore < \/var\/tmp\/iptables/# iptables-restore < \/var\/tmp\/iptables/g' /etc/rc.local");
				
				echo "<script>$('#functionstat').text('Access Point');</script>";
				echo "<script>$('#selectopsmode').val('Router');</script>";
			}
		}
	  echo "<script>ReturnReadyOperation();</script>";
	  }
	}
  }
  ?>
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>
