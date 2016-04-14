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
<?php logmessage("Loading page home.php");?>
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
  
  <!-- InstanceEndEditable -->
  
  <article class="content">
    <!-- InstanceBeginEditable name="article" -->
  <?php date_default_timezone_set(trim(file_get_contents("/etc/timezone"),"\n"));?>
  <?php $routersettingsini = parse_ini_file("/home/pi/Raspberry-Wifi-Router/www/routersettings.ini");?>
  <?php $hostapdconf = parse_ini_file("/etc/hostapd/hostapd.conf");?>

  
  <div id="ContentTitle">
  <span>General</span>
  </div>
  
  <div id="ContentArticle">
    <table width="100%" border="0">
    <tr>
      <td colspan="2" align="center">The Raspberry Wireless Router Project can be found on github:<br />
        <a href="https://github.com/ronnyvdbr/ronnyvdbr.github.io" target="_blank">https://github.com/ronnyvdbr/ronnyvdbr.github.io</a></td>
      </tr>
    <tr>
      <td width="50%" align="right">Current Timezone:</td>
      <td width="50%"><?php echo date_default_timezone_get();?></td>
    </tr>
    <tr>
      <td align="right">Current Date/Time:</td>
      <td><?php echo date('d/m/Y - H:i:s');?></td>
    </tr>
    <tr>
      <td align="right">Software Version:</td>
      <td><?php echo $routersettingsini['softwareversion'];?></td>
    </tr>
    </table>
  </div>
  
  <div id="ContentTitle">
  <span>Operation Mode</span>
  </div>
  
  <div id="ContentArticle">
	
    <table width="100%" border="0">
	  <tr>
		<td align="center"><?php echo "The Raspberry Pi is currently functioning as: " . $routersettingsini['operationmode'];?></td>
	  </tr>
	</table>

	
    </div>
  
  <div id="ContentTitle">
  <span>LAN Connection</span>
  </div>
  
  <div id="ContentArticle">
    <table width="100%" border="0">
      <tr>
        <td width="50%" align="right">Connection Type:</td>
        <td width="50%"><?php if ($routersettingsini['lantype'] == "dhcp") {echo "Dhcp Client";}
        if ($routersettingsini['lantype'] == "static") {echo "Static IP";}
        if ($routersettingsini['lantype'] == "pppoe") {echo "PPPoE";}
		?></td>
      </tr>
      <tr>
        <td align="right">Cable status:</td>
        <td>
		<?php 
		if (strcmp($routersettingsini['operationmode'],"Router") == 0) {
			echo shell_exec("cat /sys/class/net/eth0/operstate");
		}
		if (strcmp($routersettingsini['operationmode'],"Access Point") == 0) {
			echo shell_exec("cat /sys/class/net/br0/operstate");
		}
		?>
        </td>
      </tr>
      <tr>
        <td align="right">Mac Address:</td>
        <td>
		<?php 
		if (strcmp($routersettingsini['operationmode'],"Router") == 0) {
			echo shell_exec("cat /sys/class/net/eth0/address");
		}
		if (strcmp($routersettingsini['operationmode'],"Access Point") == 0) {
			echo shell_exec("cat /sys/class/net/br0/address");
		}
		?>
        </td>
      </tr>
      <tr>
        <td align="right">IP Address:</td>
        <td>
		<?php 
		if (strcmp($routersettingsini['operationmode'],"Router") == 0) {
			echo shell_exec("ifconfig eth0 | awk '/inet / { print $2 }' | sed 's/addr://'");
		}
		if (strcmp($routersettingsini['operationmode'],"Access Point") == 0) {
			echo shell_exec("ifconfig br0 | awk '/inet / { print $2 }' | sed 's/addr://'");
		}
		?>
        </td>
      </tr>
      <tr>
        <td align="right">Subnet Mask:</td>
        <td>
		<?php 
		if (strcmp($routersettingsini['operationmode'],"Router") == 0) {
			echo shell_exec("ifconfig eth0 | awk '/Mask:/{ print $4;} ' | sed 's/Mask://'");
		}
		if (strcmp($routersettingsini['operationmode'],"Access Point") == 0) {
			echo shell_exec("ifconfig br0 | awk '/Mask:/{ print $4;} ' | sed 's/Mask://'");
		}
		?>
        </td>
      </tr>
      <tr>
        <td align="right">Default Gateway:</td>
        <td>
		<?php 
		echo shell_exec("ip route | awk '/default/ { print $3 }'");
		?>
        </td>
      </tr>
      <tr>
        <td align="right">Primary DNS Server:</td>
        <td>
		<?php echo shell_exec("cat /etc/resolv.conf | grep nameserver | awk -v n=1 '/^nameserver/{l++} (l==n){print}' | sed -e 's/nameserver //g'");
		?>
        </td>
      </tr>
      <tr>
        <td align="right">Secondary DNS Server:</td>
        <td>
		<?php 
		echo shell_exec("cat /etc/resolv.conf | grep nameserver | awk -v n=2 '/^nameserver/{l++} (l==n){print}' | sed -e 's/nameserver //g'");
		?>
        </td>
      </tr>
      
    </table>
  </div>
  
  <div id="ContentTitle">
  <span>WiFi Connection</span>
  </div>
  
  <div id="ContentArticle">
	<table width="100%" border="0">
      <tr>
        <td width="50%" align="right">Wireless Radio:</td>
        <td width="50%"><?php echo shell_exec("cat /sys/class/net/wlan0/operstate");?></td>
      </tr>
      <tr>
        <td align="right">SSID:</td>
        <td><?php echo $hostapdconf['ssid'];?></td>
      </tr>
      <tr>
        <td align="right">Wireless Channel:</td>
        <td><?php echo $hostapdconf['channel'];?></td>
      </tr>
      <tr>
        <td align="right">Wireless Mode:</td>
        <td><?php echo $hostapdconf['hw_mode'];?></td>
      </tr>
      <tr>
        <td align="right">Wireless Security:</td>
        <td>
        <?php
        if (walk($hostapdconf, "wep_default_key") || walk($hostapdconf, "wpa")) {
            if (walk($hostapdconf, "wep_default_key")) {echo "Wep";}
            if (walk($hostapdconf, "wpa")) {
                if ($hostapdconf['wpa'] == 1) {echo "Wpa";}
                else if ($hostapdconf['wpa'] == 2) {echo "Wpa2";}
                else if ($hostapdconf['wpa'] == 3) {echo "Wpa/Wpa2";}
            }
        }
        else { 
            echo "Disabled (open)";
        }
        ?>
        </td>
      </tr>
      <tr>
        <td align="right">Configured Country:</td>
        <td><?php echo $hostapdconf['country_code'];?></td>
      </tr>
      <tr>
        <td align="right">Base Station  ID:</td>
        <td><?php echo shell_exec("cat /sys/class/net/wlan0/address");?></td>
      </tr>
	
	<?php
	if (($routersettingsini['operationmode'] == "Router") && (shell_exec("cat /sys/class/net/wlan0/operstate") == "up\n") && ($routersettingsini['captiveportal'] == "disabled"))
	{
		echo "<tr>";
		  echo '<td align="right">IP Address:</td>';
		  echo "<td>" . shell_exec("ifconfig wlan0 | awk '/inet / { print $2 }' | sed 's/addr://'") . "</td>";
		echo "</tr>";
		echo "<tr>";
		  echo '<td align="right">Subnet Mask:</td>';
		  echo "<td>" . shell_exec("ifconfig wlan0 | awk '/Mask:/{ print $4;} ' | sed 's/Mask://'") . "</td>";
		echo "</tr>";
	  echo "</table>";
	}
	else if (($routersettingsini['operationmode'] == "Router") && ($routersettingsini['captiveportal'] == "enabled"))
	{
		echo "<tr>";
		  echo '<td align="right">IP Address:</td>';
		  echo "<td>" . shell_exec("ifconfig tun0 | awk '/inet / { print $2 }' | sed 's/addr://'") . "</td>";
		echo "</tr>";
		echo "<tr>";
		  echo '<td align="right">Subnet Mask:</td>';
		  echo "<td>" . shell_exec("ifconfig tun0 | awk '/Mask:/{ print $4;} ' | sed 's/Mask://'") . "</td>";
		echo "</tr>";
	  echo "</table>";
	}
	else 
	{
		echo "</table>";
	}
	?>
  </div><!-- end div contentarticle -->
  

  <!-- InstanceEndEditable -->
  </article><!-- end .content -->


  <aside>
  <!-- InstanceBeginEditable name="aside" -->
  All of the Raspberry Pi general network settings are displayed on this page.  
  Also the revision of the software is displayed on this page.
  If the device is running in Router operation mode, this page will also display an IP address separately for the Wifi network.
  
  
  <!-- InstanceEndEditable -->
  </aside>


  <footer>
  <p>Designed by Ronny Van den Broeck </p>
  <!-- InstanceBeginEditable name="footer" -->
  
  
  
  <!-- InstanceEndEditable -->
  </footer>
</div><!-- end .container -->

<!-- InstanceBeginEditable name="code" -->





<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>
