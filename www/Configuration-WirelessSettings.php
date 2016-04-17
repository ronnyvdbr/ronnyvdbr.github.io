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
function ReturnFailureStatus(error) {
    document.getElementById('ReturnOperationStatus').innerHTML = '<img src="images/Fail.jpg" width="20" height="20"  alt=""/><br />There was a problem saving your details: <br />' + error;
}
function ReturnProgressOperation() {
    document.getElementById('ReturnOperationStatus').innerHTML = '<img src="images/ProgressIndicator.GIF" width="100" height="15"  alt="">';
}
function ReturnReadyOperation() {
    document.getElementById('ReturnOperationStatus').innerHTML = '<img src="images/Ready.png" width="20" height="20"  alt="">';
}
</script>
<?php include 'functions.php';?>
<?php logmessage("Loading page Configuration-WirelessSettings.php");?>
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
  $('#Configuration').addClass('active');
  $('#ConfigurationUl').show();
</script>

  <!-- InstanceEndEditable -->
  
  <article class="content">
    <!-- InstanceBeginEditable name="article" -->
<!-- ********************************************************************************************************************** -->
  <?php   	
	$configurationsettings = parse_ini_file("/home/pi/Raspberry-Wifi-Router/www/routersettings.ini");
  ?>
<!-- ********************************************************************************************************************** -->
  <?php
	if($_SERVER['REQUEST_METHOD'] == 'POST') {
		echo "<script>ReturnProgressOperation();</script>";
	   
		$wifi = $ssid = $visibility = $operationmode = $channel = $channelwidth = $securitymode = $wepkey = "";
		$ssiderror = $visibilityerr = $operationmodeerr = $channelerr = $channelwidtherr = $securitymodeerr = $wepkeyerr = $wpakeyerr = "";
		
		if(isset($_POST['wificheckbox'])) {
			$wifi = "enabled";
		}
	  
		if (!empty($_POST["ssid"])) {
		  $ssid = test_input($_POST["ssid"]);
		  if (!preg_match("/^[a-zA-Z0-9_-]*$/",$ssid)) {
			  $ssiderror = "ssid field contains incorrect data, only a-zA-Z0-9 _ - allowed!<br />"; 
		  }
		}
		else {
		  $ssiderror = "ssid field is a required field, u need to specify a network name for SSID!<br />";
		}
		
  
		if (!empty($_POST["visibility"])) {
		  $visibility = test_input($_POST["visibility"]);
		  if (!strcmp($visibility, "enabled") && !strcmp($visibility, "disabled")) {
			  $visibilityerr = "Incorrect input received for Visibility Status!";
		  }
		}
		else {
		  $visibilityerr = "Visibility Status Selector is required!";
		}
		
		
		if (!empty($_POST["operationmode"])) {
		  $operationmode = test_input($_POST["operationmode"]);
		  if (!strcmp($operationmode, "IEEE 802.11-b") && !strcmp($operationmode, "IEEE 802.11-g") && !strcmp($operationmode, "IEEE 802.11-bgn")) {
			  $operationmodeerr = "Incorrect input received for Operation Mode!";
		  }
		}
		else {
		  $operationmodeerr = "Operation Mode Selector is required!";
		}
		
		if (!empty($_POST["channel"])) {
		  $channel = test_input($_POST["channel"]);
		  if (!strcmp($channel, "[1] - 2412 MHz") && !strcmp($channel, "[2] - 2417 MHz") && !strcmp($channel, "[3] - 2422 MHz") && !strcmp($channel, "[4] - 2427 MHz") && !strcmp($channel, "[5] - 2432 MHz") && !strcmp($channel, "[6] - 2437 MHz") && !strcmp($channel, "[7] - 2442 MHz") && !strcmp($channel, "[8] - 2447 MHz") && !strcmp($channel, "[9] - 2452 MHz") && !strcmp($channel, "[10] - 2457 MHz") && !strcmp($channel, "[11] - 2462 MHz") && !strcmp($channel, "[12] - 2467 MHz") && !strcmp($channel, "[13] - 2472 MHz")) {
			  $channelerr = "Incorrect input received for Channel!";
		  }
		}
		else {
		  $channelerr = "Channel Selector is required!";
		}
		
		//Read in and validation of channelwidth selector
		if (!empty($_POST["channelwidth"])) {
		  $channelwidth = test_input($_POST["channelwidth"]);
		  if (!strcmp($channelwidth, "20 Mhz") && !strcmp($channelwidth, "20/40 Mhz")) {
			  $channelwidtherr = "Incorrect input received for channelwidth!";
		  }
		}
		else {
		  $channelwidtherr = "Channelwidth Selector is required!";
		}
		
		
		if (!empty($_POST["securitymode"])) {
		  $securitymode = test_input($_POST["securitymode"]);
		  if (!strcmp($securitymode, "secmode") && !strcmp($securitymode, "secmode-WEP") && !strcmp($securitymode, "secmode-WPA")) {
			  $securitymodeerr = "Incorrect input received for Operation Mode!";
		  }
		}
		else {
		  $securitymodeerr = "Security Mode Selector is required!";
		}
		
		
		//Read in and validation of wep key
		if (!empty($_POST["txt-secmode-WEP"])) {
		  $wepkey = test_input($_POST["txt-secmode-WEP"]);
		  if (!preg_match("/^[a-zA-Z0-9]*$/",$wepkey)) {
			  $wepkeyerr = "Wepkey field contains incorrect data, only a-zA-Z0-9 allowed!<br />"; 
		  }
		}
		//Read in and validation of wpa preshared-key
		if (!empty($_POST["txt-secmode-WPA"])) {
		  $wpakey = test_input($_POST["txt-secmode-WPA"]);
		  if (!preg_match("/^[a-zA-Z0-9$@$!%*#?&]{8,}$/",$wpakey)) {
			  $wpakeyerr = "Wepkey field contains incorrect data, only a-zA-Z0-9 allowed!<br />"; 
		  }
		}


	  // only apply actions when no form errors are present
	  if(empty($ssiderror) && empty($visibilityerr) && empty($operationmodeerr) && empty($channelerr) && empty($channelwidtherr) && empty($securitymodeerr) && empty($wepkeyerr) && empty($wpakeyerr)) {
		  switch($wifi) {
			  case "":
				  $configurationsettings['wifi'] = "disabled";
			  break;
			  case "enabled":
				  $configurationsettings['wifi'] = "enabled";
			  break;
		  }
  		  $configurationsettings['ssid'] = $ssid;
		  $configurationsettings['ssidbroadcast'] = $visibility;
		  $configurationsettings['wifimode'] = $operationmode;
		  $configurationsettings['wifichannel'] = $channel;
		  $configurationsettings['wifichannelwidth'] = $channelwidth;
		  switch($securitymode) {
			  case "secmode":
				  $configurationsettings['wifisecurity'] = "";
			  break;
			  case "secmode-WEP":
				  $configurationsettings['wifisecurity'] = "WEP";
			  break;
			  case "secmode-WPA":
				  $configurationsettings['wifisecurity'] = "WPA";
			  break;
		  }
		  $configurationsettings['wifiwepkey'] = $wepkey;
  		  $configurationsettings['wifiwpapassword'] = $wpakey;
	      
		  logmessage("Writing changes to configuration file: /home/pi/Raspberry-Wifi-Router/www/routersettings.ini");
		  write_php_ini($configurationsettings, "/home/pi/Raspberry-Wifi-Router/www/routersettings.ini");
	  }
	}
?>
<!-- ********************************************************************************************************************** -->
    <div id="ContentTitle">
    <span>Wireless Settings</span></div>
    
    <div id="ContentArticle">
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="application/x-www-form-urlencoded" id="formwireless">
        <fieldset><legend>Common Settings</legend>
          <table width="100%" border="0">
            <tr>
              <td width="40%" align="right">Wireless Radio Enabled:</td>
              <td width="60%"><input name="wificheckbox" type="checkbox" id="wificheckbox" value="enabled" <?php if(strcmp($configurationsettings['wifi'],"enabled") == 0) {echo "checked";}?>></td>
            </tr>
            <tr>
              <td align="right">Wireless Network Name (SSID):</td>
              <td><input name="ssid" type="text" required id="ssid" placeholder="RaspberryWAP" pattern="^[a-zA-Z0-9_-]*$" <?php echo "value='" . $configurationsettings['ssid'] . "'"?>></td>
            </tr>
            <tr>
              <td align="right">Visibility Status:</td>
              <td><select name="visibility" id="visibility">
                <option value="enabled" <?php if(strcmp($configurationsettings['ssidbroadcast'],"enabled") == 0) {echo 'selected="selected"';}?>>Visible</option>
                <option value="disabled" <?php if(strcmp($configurationsettings['ssidbroadcast'],"disabled") == 0) {echo 'selected="selected"';}?>>Invisible</option>
              </select></td>
            </tr>
            <tr>
              <td align="right">Wireless Mode:</td>
              <td><select name="operationmode" id="operationmode">
                <option value="IEEE 802.11-b" <?php if(strcmp($configurationsettings['wifimode'],"IEEE 802.11-b") == 0) {echo 'selected="selected"';}?>>IEEE 802.11-b</option>
                <option value="IEEE 802.11-g" <?php if(strcmp($configurationsettings['wifimode'],"IEEE 802.11-g") == 0) {echo 'selected="selected"';}?>>IEEE 802.11-g</option>
                <option value="IEEE 802.11-bgn" <?php if(strcmp($configurationsettings['wifimode'],"IEEE 802.11-bgn") == 0) {echo 'selected="selected"';}?>>IEEE 802.11-bgn</option>
              </select></td>
            </tr>
            <tr>
              <td align="right">Channel:</td>
              <td><select name="channel" id="channel">
                <option value="1" <?php if(strcmp($configurationsettings['wifichannel'],"1") == 0) {echo 'selected="selected"';}?>>[1] - 2412 MHz</option>
                <option value="2" <?php if(strcmp($configurationsettings['wifichannel'],"2") == 0) {echo 'selected="selected"';}?>>[2] - 2417 MHz</option>
                <option value="3" <?php if(strcmp($configurationsettings['wifichannel'],"3") == 0) {echo 'selected="selected"';}?>>[3] - 2422 MHz</option>
                <option value="4" <?php if(strcmp($configurationsettings['wifichannel'],"4") == 0) {echo 'selected="selected"';}?>>[4] - 2427 MHz</option>
                <option value="5" <?php if(strcmp($configurationsettings['wifichannel'],"5") == 0) {echo 'selected="selected"';}?>>[5] - 2432 MHz</option>
                <option value="6" <?php if(strcmp($configurationsettings['wifichannel'],"6") == 0) {echo 'selected="selected"';}?>>[6] - 2437 MHz</option>
                <option value="7" <?php if(strcmp($configurationsettings['wifichannel'],"7") == 0) {echo 'selected="selected"';}?>>[7] - 2442 MHz</option>
                <option value="8" <?php if(strcmp($configurationsettings['wifichannel'],"8") == 0) {echo 'selected="selected"';}?>>[8] - 2447 MHz</option>
                <option value="9" <?php if(strcmp($configurationsettings['wifichannel'],"9") == 0) {echo 'selected="selected"';}?>>[9] - 2452 MHz</option>
                <option value="10" <?php if(strcmp($configurationsettings['wifichannel'],"10") == 0) {echo 'selected="selected"';}?>>[10] - 2457 MHz</option>
                <option value="11" <?php if(strcmp($configurationsettings['wifichannel'],"11") == 0) {echo 'selected="selected"';}?>>[11] - 2462 MHz</option>
                <option value="12" <?php if(strcmp($configurationsettings['wifichannel'],"12") == 0) {echo 'selected="selected"';}?>>[12] - 2467 MHz</option>
                <option value="13" <?php if(strcmp($configurationsettings['wifichannel'],"13") == 0) {echo 'selected="selected"';}?>>[13] - 2472 MHz</option>
              </select></td>
            </tr>
            <tr>
              <td align="right">Channel Width:</td>
              <td><select name="channelwidth" id="channelwidth">
                <option value="20 Mhz" <?php if(strcmp($configurationsettings['wifichannelwidth'],"20 Mhz") == 0) {echo 'selected="selected"';}?>>20 Mhz</option>
                <option value="20/40 Mhz" <?php if(strcmp($configurationsettings['wifichannelwidth'],"20/40 Mhz") == 0) {echo 'selected="selected"';}?>>20/40 Mhz</option>
              </select></td>
            </tr>
            <tr>
              <td align="right">Security Mode:</td>
              <td><select name="securitymode" id="securitymode">
                <option value="secmode" <?php if(strcmp($configurationsettings['wifisecurity'],"") == 0) {echo 'selected="selected"';}?>>None</option>
                <option value="secmode-WEP"<?php if(strcmp($configurationsettings['wifisecurity'],"WEP") == 0) {echo 'selected="selected"';}?>>WEP</option>
                <option value="secmode-WPA"<?php if(strcmp($configurationsettings['wifisecurity'],"WPA") == 0) {echo 'selected="selected"';}?>>WPA/WPA2-PSK</option>
              </select></td>
            </tr>
          
          </table>
          
          <table width="100%" border="0"  id="secmode-WEP">
            <tr>
              <td align="center">&nbsp;</td>
              <td width="60%">The key length should be 5, 13, or 16 characters<br />
                or 10, 26, or 32 digits, depending on whether:<br />64-bit, 128-bit, or 152-bit WEP is used.</td>
            </tr>
            <tr>
              <td width="40%" align="right">Wep Key:</td>
              <td width="60%"><input name="txt-secmode-WEP" type="text" id="txt-secmode-WEP" pattern="[a-zA-Z0-9]*$" size="40" <?php echo "value='" . $configurationsettings['wifiwepkey'] . "'"?>></td>
            </tr>
          </table>
          
          <table width="100%" border="0"  id="secmode-WPA">
            <tr>
              <td align="right">&nbsp;</td>
              <td>Note: The Pre-Shared key must be at least eight characters long.</td>
            </tr>
            <tr>
              <td width="40%" align="right">Pre-Shared key (password):</td>
              <td width="60%"><input name="txt-secmode-WPA" type="text" id="txt-secmode-WPA" pattern="^[a-zA-Z0-9$@$!%*#?&amp;]{8,}$" <?php echo "value='" . $configurationsettings['wifiwpapassword'] . "'"?>></td>
            </tr>
          </table>
          
          <table width="100%" border="0">
            <tr>
              <td width="40%" align="right"><input type="submit" name="submit" id="submit" value="Submit"></td>
              <td width="60%"><span id="ReturnOperationStatus"></span></td>
            </tr>
          </table>
        </fieldset>
      </form>
   </div><!-- end div ContentArticle -->

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
<script>
// jquery script to show and hide selected div's (DHCP, Static, Pppoe)
$('[id^="secmode"]').hide(); // hide every div element on this web page where the ID contains "conf"
$("#securitymode").on('change', function() { // when the connection type selector is changed
    $('[id^="secmode"]').hide();
	$("#"+this.value).show().siblings('[id^="secmode"]').hide();
	$("#txt-"+this.value).prop('required',true);
});
</script>
<!-- ********************************************************************************************************************** -->
<?php // when page loads, show the correct div according to config file
  if(strcmp($configurationsettings['wifisecurity'],"WEP") == 0) {echo '<script>$("#secmode-WEP").show();</script>';}
  if(strcmp($configurationsettings['wifisecurity'],"WPA") == 0) {echo '<script>$("#secmode-WPA").show();</script>';}
?>  
<!-- ********************************************************************************************************************** -->

<?php 
  if($_SERVER['REQUEST_METHOD'] == 'POST') {

	if(empty($ssiderror) && empty($visibilityerr) && empty($operationmodeerr) && empty($channelerr) && empty($channelwidtherr) && empty($securitymodeerr) && empty($wepkeyerr) && empty($wpakeyerr)) {
		
	
		$hostapdconfig = parse_ini_file("/etc/hostapd/hostapd.conf");
		$hostapdconfig['ssid'] = $configurationsettings['ssid'];
		
		echo "<script>ReturnProgressOperation();</script>";
		flush();
		
		switch ($configurationsettings['ssidbroadcast']) {
			case "enabled":
				$hostapdconfig['ignore_broadcast_ssid'] = "0";
			break;
			case "disabled":
				$hostapdconfig['ignore_broadcast_ssid'] = "2";
			break;
		}
		
		switch ($configurationsettings['wifimode']) {
			case "IEEE 802.11-b":
				$hostapdconfig['hw_mode'] = "b";
				$hostapdconfig['ieee80211n'] = "0";
			break;
			case "IEEE 802.11-g":
				$hostapdconfig['hw_mode'] = "g";
				$hostapdconfig['ieee80211n'] = "0";
			break;
			case "IEEE 802.11-bgn":
				$hostapdconfig['hw_mode'] = "g";
				$hostapdconfig['ieee80211n'] = "1";
			break;
		}
	
		switch ($configurationsettings['wifichannel']) {
			case "[1] - 2412 MHz":
				$hostapdconfig['channel'] = "1";
			break;
			case "[2] - 2417 MHz":
				$hostapdconfig['channel'] = "2";
			break;
			case "[3] - 2422 MHz":
				$hostapdconfig['channel'] = "3";
			break;
			case "[4] - 2427 MHz":
				$hostapdconfig['channel'] = "4";
			break;
			case "[5] - 2432 MHz":
				$hostapdconfig['channel'] = "5";
			break;
			case "[6] - 2437 MHz":
				$hostapdconfig['channel'] = "6";
			break;
			case "[7] - 2442 MHz":
				$hostapdconfig['channel'] = "7";
			break;
			case "[8] - 2447 MHz":
				$hostapdconfig['channel'] = "8";
			break;
			case "[9] - 2452 MHz":
				$hostapdconfig['channel'] = "9";
			break;
			case "[10] - 2457 MHz":
				$hostapdconfig['channel'] = "10";
			break;
			case "[11] - 2462 MHz":
				$hostapdconfig['channel'] = "11";
			break;
			case "[12] - 2467 MHz":
				$hostapdconfig['channel'] = "12";
			break;
			case "[13] - 2472 MHz":
				$hostapdconfig['channel'] = "13";
			break;
		}
		
		switch ($configurationsettings['wifichannelwidth']) {
			case "20 Mhz":
				$hostapdconfig['ht_capab'] = "";
			break;
			case "20/40 Mhz":
				$hostapdconfig['ht_capab'] = "[HT40+][SMPS-STATIC][SHORT-GI-40][RX-STBC1]";
			break;
		}
		
		switch ($configurationsettings['wifisecurity']) {
			case "":
				//in case of no security, remove both wep and wpa parameters
				foreach($hostapdconfig as $key => $value) {
				  if (strpos($key, 'wep_default_key') !== FALSE)
					unset($hostapdconfig[$key]);
				  if (strpos($key, 'wep_key0') !== FALSE)
					unset($hostapdconfig[$key]);
				  if (strpos($key, 'wpa') !== FALSE)
					unset($hostapdconfig[$key]);
				  if (strpos($key, 'wpa_passphrase') !== FALSE)
					unset($hostapdconfig[$key]);
				}
			break;

			
			case "WEP":
				//remove wpa mode if configured 
				foreach($hostapdconfig as $key => $value) {
				  if (strpos($key, 'wpa') !== FALSE)
					unset($hostapdconfig[$key]);
				  if (strpos($key, 'wpa_passphrase') !== FALSE)
					unset($hostapdconfig[$key]);
				}

				//set the wep-default key - this will activate wep security
				if(!walk($hostapdconfig, 'wep_default_key')) {
					$hostapdconfig["wep_default_key"] = "0";
				}
				$hostapdconfig["wep_key0"] = $configurationsettings['wifiwepkey'];
			break;

			
			case "WPA":
				//if we are coming from wep mode, unset it in our config 
				foreach($hostapdconfig as $key => $value) {
				  if (strpos($key, 'wep_default_key') !== FALSE)
					unset($hostapdconfig[$key]);
				  if (strpos($key, 'wep_key0') !== FALSE)
					unset($hostapdconfig[$key]);
				}
				
				if(!walk($hostapdconfig, 'wpa')) {
					$hostapdconfig["wpa"] = "3";
				}
				$hostapdconfig["wpa_passphrase"] = $configurationsettings['wifiwpapassword'];
			break;
		}
		
		logmessage("Writing configuration details to /etc/hostapd/hostapd.conf");
		write_hostapd_conf($hostapdconfig,"/etc/hostapd/hostapd.conf"); 
		
		switch($configurationsettings['wifi']) {
			case "enabled":
				logmessage("Scheduling hostapd to start at boot.");
				shell_exec("sudo systemctl enable hostapd.service 2>&1 | sudo tee --append /var/log/raspberrywap.log");
				logmessage("Restarting hostapd.");
				shell_exec("sudo systemctl restart hostapd.service 2>&1 | sudo tee --append /var/log/raspberrywap.log");
				echo "<script>ReturnReadyOperation();</script>";

			break;
			case "disabled":
				logmessage("Disabling Wireless Radio ...");
				logmessage("Unscheduling hostapd to start at boot.");
				shell_exec("sudo systemctl disable hostapd.service 2>&1 | sudo tee --append /var/log/raspberrywap.log");
				logmessage("Stopping hostapd.");
				shell_exec("sudo systemctl stop hostapd.service 2>&1 | sudo tee --append /var/log/raspberrywap.log");
				echo "<script>ReturnReadyOperation();</script>";
			break;
		}
	}
	else  {
		echo "<script>ReturnFailureStatus('" . $ssiderror . "'+'" . $visibilityerr . "'+'" . $operationmodeerr . "'+'" . $channelerr . "'+'" . $channelwidtherr . "'+'" . $securitymodeerr . "'+'" . $wepkeyerr . "'+'" . $wpakeyerr . ");</script>";
	}
  }
?>
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>
