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
function ReturnFailureDynamic(error) {
    document.getElementById('ReturnStatusDynamic').innerHTML = '<img src="images/Fail.jpg" width="20" height="20"  alt=""/><br />There was a problem saving your details: <br />' + error;
}
function ReturnProgressDynamic() {
    document.getElementById('ReturnStatusDynamic').innerHTML = '<img src="images/ProgressIndicator.GIF" width="100" height="15"  alt="">';
}
function ReturnReadyDynamic() {
    document.getElementById('ReturnStatusDynamic').innerHTML = '<img src="images/Ready.png" width="20" height="20"  alt="">';
}
function ReturnProgressStatic() {
    document.getElementById('ReturnStatusStatic').innerHTML = '<img src="images/ProgressIndicator.GIF" width="100" height="15"  alt="">';
}
function ReturnReadyStatic() {
    document.getElementById('ReturnStatusStatic').innerHTML = '<img src="images/Ready.png" width="20" height="20"  alt="">';
}
function ReturnFailureStatic(error) {
    document.getElementById('ReturnStatusStatic').innerHTML = 'There was a problem saving your details: <br />' + error;
}
function ReturnFailurePppoe(error) {
    document.getElementById('ReturnStatusPppoe').innerHTML = 'There was a problem saving your details: <br />' + error;
}
</script>
<?php include 'functions.php';?>
<?php logmessage("Loading page Configuration-NetworkSettings.php");?>
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


  <?php   	
	$configurationsettings = parse_ini_file("/var/www/routersettings.ini");
  ?>
<!-- ********************************************************************************************************************** -->
  <?php 
	if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['buttondynamic'])) {
	  logmessage("Processing Dynamic IP form data.");
	  $macchange = false;
	  $dhcpuid = $primarydns = $secondarydns = $mtus = $mac = "";
	  $dhcpuiderr = $primarydnserr = $secondarydnserr = $mtuerr = $macerr = "";
	  if (!empty($_POST["dhcpuid"])) {
		$dhcpuid = test_input($_POST["dhcpuid"]);
		if (!preg_match("/^[a-zA-Z0-9_-]*$/",$dhcpuid)) {
		  $dhcpuiderr = "dhcpuid field contains incorrect data, only a-zA-Z0-9_- allowed!<br />"; 
		}
	  }
	  if (!empty($_POST["primarydns"])) {
		$primarydns = test_input($_POST["primarydns"]);
		if (!preg_match("/^[a-zA-Z0-9.]*$/",$primarydns)) {
		  $primarydnserr = "primarydns field contains incorrect data, only a-zA-Z0-9. allowed!<br />"; 
		}
	  }
	  if (!empty($_POST["secondarydns"])) {
		$secondarydns = test_input($_POST["secondarydns"]);
		if (!preg_match("/^[a-zA-Z0-9.]*$/",$secondarydns)) {
		  $secondarydnserr = "secondarydns field contains incorrect data, only a-zA-Z0-9. allowed!<br />"; 
		}
	  }
	  if (!empty($_POST["mtus"])) {
		$mtus = test_input($_POST["mtus"]);
		if (!preg_match("/^[0-9]*$/",$mtus)) {
		  $mtuerr = "mtu field contains incorrect data, only 0-9 allowed!<br />"; 
		}
	  }
	  if (!empty($_POST["mac"])) {
		$mac = test_input($_POST["mac"]);
		if (!preg_match("/^[a-fA-F0-9:]*$/",$mac)) {
		  $macerr = "mac field contains incorrect data, only 0-9: allowed!<br />"; 
		}
	  }
	  if(empty($dhcpuiderr) && empty($primarydnserr) && empty($secondarydnserr) && empty($mtuerr) && empty($macerr)) {
		$configurationsettings['lantype'] = "dhcp";
		$configurationsettings['dhcpuid'] = $dhcpuid;
		if(isset($_POST['overridedns'])) {
		  logmessage("Setting DNS override, reading /etc/dhcp/dhclient.conf and changing settings.");
		  $configurationsettings['dhcpdnsoverride'] = "enabled";
		  $dhclientconf = file("/etc/dhcp/dhclient.conf");
		  foreach($dhclientconf as $key => $value) {
			if (strpos($value, 'supersede domain-name-servers') !== FALSE) {
			  unset($dhclientconf[$key]);
			}
		  }
		  if(!empty($primarydns) || !empty($secondarydns)) {
			  if(!empty($primarydns) && empty($secondarydns)) {
				array_push($dhclientconf,"supersede domain-name-servers " . $primarydns . ";\n");
			  }
			  else if(empty($primarydns) && !empty($secondarydns)) {
				array_push($dhclientconf,"supersede domain-name-servers " . $secondarydns . ";\n");
			  }
			  else if(!empty($primarydns) && !empty($secondarydns)) {
				array_push($dhclientconf,"supersede domain-name-servers " . $primarydns . "," . $secondarydns . ";\n");
			  }
		  }
		  //logmessage("Writing back changes to /etc/dhcp/dhclient.conf");
		  //file_put_contents("/etc/dhcp/dhclient.conf",$dhclientconf);
		}
		else {
		  logmessage("DNS override not set, setting config file accordingly, reading /etc/dhcp/dhclient.conf");
		  $configurationsettings['dhcpdnsoverride'] = "disabled";
		  $dhclientconf = file("/etc/dhcp/dhclient.conf");
		  foreach($dhclientconf as $key => $value) {
			if (strpos($value, 'supersede domain-name-servers') !== FALSE) {
			  unset($dhclientconf[$key]);
			}
		  }
		  //logmessage("Writing back changes to /etc/dhcp/dhclient.conf");
		  //file_put_contents("/etc/dhcp/dhclient.conf",$dhclientconf);
		}
		$configurationsettings['dns1'] = $primarydns;
		$configurationsettings['dns2'] = $secondarydns;
		$configurationsettings['lanmtu'] = $mtus;
	    //logmessage("Writing back changes to /etc/dhcp/dhclient.conf");
		//$dhclientconf = file("/etc/dhcp/dhclient.conf");
		foreach($dhclientconf as $key => $value) {
		  if (strpos($value, 'send host-name =') !== FALSE) {
			$dhclientconf[$key] = "send host-name = \"" . $dhcpuid . "\";\n";
		  }
		}
	    logmessage("Writing back changes to /etc/dhcp/dhclient.conf");
		file_put_contents("/etc/dhcp/dhclient.conf",$dhclientconf);
		$macchange = false;
		if(strcmp($mac,$configurationsettings['lanmac']) !== 0) {$macchange = true;}
		if(empty($mac))
			$configurationsettings['lanmac'] = '';
		else 
			$configurationsettings['lanmac'] = $mac;
	    logmessage("Writing changes to configuration file: /var/www/routersettings.ini");
		write_php_ini($configurationsettings, "/var/www/routersettings.ini");
		logmessage("Writing changes to interfaces file: /etc/network/interfaces");
		update_interfaces_file($configurationsettings['operationmode']);
	  }
	}
  ?>
<!-- ********************************************************************************************************************** -->
  <?php
	if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['buttonstatic'])) {
  	  logmessage("Processing Static IP form data.");

	  $ipaddress = $subnetmask = $defaultgateway = $primarydns = $secondarydns = $mtus = $macaddress = "";
	  $ipaddresserr = $subnetmaskerr = $defaultgatewayerr = $primarydnserr = $secondarydnserr = $mtuerr = $macaddresserr = "";
	  
	  if (!empty($_POST["ipaddress"])) {
		$ipaddress = test_input($_POST["ipaddress"]);
		if (!preg_match("/^[0-9.]*$/",$ipaddress)) {
		  $ipaddresserr = "ipaddress field contains incorrect data, only a-zA-Z0-9_- allowed!<br />"; 
		}
	  }
	  if (!empty($_POST["subnetmask"])) {
		$subnetmask = test_input($_POST["subnetmask"]);
		if (!preg_match("/^[0-9.]*$/",$subnetmask)) {
		  $subnetmaskerr = "subnetmask field contains incorrect data, only a-zA-Z0-9_- allowed!<br />"; 
		}
	  }
	  if (!empty($_POST["defaultgateway"])) {
		$defaultgateway = test_input($_POST["defaultgateway"]);
		if (!preg_match("/^[0-9.]*$/",$defaultgateway)) {
		  $defaultgatewayerr = "defaultgateway field contains incorrect data, only a-zA-Z0-9_- allowed!<br />"; 
		}
	  }
	  if (!empty($_POST["primarydns"])) {
		$primarydns = test_input($_POST["primarydns"]);
		if (!preg_match("/^[a-zA-Z0-9.]*$/",$primarydns)) {
		  $primarydnserr = "primarydns field contains incorrect data, only a-zA-Z0-9_- allowed!<br />"; 
		}
	  }
	  if (!empty($_POST["secondarydns"])) {
		$secondarydns = test_input($_POST["secondarydns"]);
		if (!preg_match("/^[a-zA-Z0-9.]*$/",$secondarydns)) {
		  $secondarydnserr = "secondarydns field contains incorrect data, only a-zA-Z0-9_- allowed!<br />"; 
		}
	  }
	  if (!empty($_POST["mtus"])) {
		$mtus = test_input($_POST["mtus"]);
		if (!preg_match("/^[0-9]*$/",$mtus)) {
		  $mtuerr = "mtu field contains incorrect data, only a-zA-Z0-9_- allowed!<br />"; 
		}
	  }
	  if (!empty($_POST["mac"])) {
		$macaddress = test_input($_POST["mac"]);
		if (!preg_match("/^[a-fA-F0-9:]*$/",$macaddress)) {
		  $macaddresserr = "macaddress field contains incorrect data, only a-zA-Z0-9_- allowed!<br />"; 
		}
	  }
	  if(empty($ipaddresserr) && empty($subnetmaskerr) && empty($defaultgatewayerr) && empty($primarydnserr) && empty($secondarydnserr) && empty($mtuerr) && empty($macaddresserr) && !empty($ipaddress) && !empty($subnetmask)) {
		$configurationsettings['lantype'] = "static";
		$configurationsettings['lanip'] = $ipaddress;
		$configurationsettings['lanmask'] = $subnetmask;

		if(!empty($defaultgateway)) 
			$configurationsettings['langw'] = $defaultgateway;
		else
			$configurationsettings['langw'] = "";

		if(!empty($primarydns)) 
			$configurationsettings['dns1'] = $primarydns;
		else
			$configurationsettings['dns1'] = "";

		if(!empty($secondarydns)) 
			$configurationsettings['dns2'] = $secondarydns;
		else
			$configurationsettings['dns2'] = "";

		if(!empty($mtus)) 
			$configurationsettings['lanmtu'] = $mtus;
		else
			$configurationsettings['lanmtu'] = "";

		if(empty($mac))
			$configurationsettings['lanmac'] = '';
		else 
			$configurationsettings['lanmac'] = $mac;

	    logmessage("Writing changes to configuration file: /var/www/routersettings.ini");
		write_php_ini($configurationsettings, "/var/www/routersettings.ini");

		logmessage("Writing changes to interfaces file: /etc/network/interfaces");
		update_interfaces_file($configurationsettings['operationmode']);
	  }
	}
  ?>
<!-- ********************************************************************************************************************** -->
  <?php
	if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['buttonpppoe'])) {
	  $ipaddress = $username = $password = $repeatpassword = $servicename = $idledisconnect = $primarydns = $secondarydns = $mtus = $mac = "";
	  $ipaddresserr = $usernameerr = $passworderr = $repeatpassworderr = $servicenameerr = $idledisconnecterr = $primarydnserr = $secondarydnserr = $mtuerr = $macerr = "";
	  if (!empty($_POST["ipaddress"])) {
		$ipaddress = test_input($_POST["ipaddress"]);
		if (!preg_match("/^[0-9.]*$/",$ipaddress)) {
		  $ipaddresserr = "dhcpuid field contains incorrect data, only a-zA-Z0-9_- allowed!<br />"; 
		}
	  }
	  if (!empty($_POST["username"])) {
		$username = test_input($_POST["username"]);
		if (!preg_match("/^[a-zA-Z0-9_-@]*$/",$username)) {
		  $usernameerr = "dhcpuid field contains incorrect data, only a-zA-Z0-9_- allowed!<br />"; 
		}
	  }
	  if (!empty($_POST["password"])) {
		$password = test_input($_POST["password"]);
		if (!preg_match("/^[a-zA-Z0-9_-@]*$/",$password)) {
		  $passworderr = "dhcpuid field contains incorrect data, only a-zA-Z0-9_- allowed!<br />"; 
		}
	  }
	  if (!empty($_POST["repeatpassword"])) {
		$repeatpassword = test_input($_POST["repeatpassword"]);
		if (!preg_match("/^[a-zA-Z0-9_-@]*$/",$repeatpassword)) {
		  $repeatpassworderr = "dhcpuid field contains incorrect data, only a-zA-Z0-9_- allowed!<br />"; 
		}
	  }
	  if (!empty($_POST["servicename"])) {
		$servicename = test_input($_POST["servicename"]);
		if (!preg_match("/^[a-zA-Z0-9_-@]*$/",$servicename)) {
		  $servicenameerr = "dhcpuid field contains incorrect data, only a-zA-Z0-9_- allowed!<br />"; 
		}
	  }
	  if (!empty($_POST["idledisconnect"])) {
		$idledisconnect = test_input($_POST["idledisconnect"]);
		if (!preg_match("/^[0-9]*$/",$idledisconnect)) {
		  $idledisconnecterr = "dhcpuid field contains incorrect data, only a-zA-Z0-9_- allowed!<br />"; 
		}
	  }
	  if (!empty($_POST["primarydns"])) {
		$primarydns = test_input($_POST["primarydns"]);
		if (!preg_match("/^[a-zA-Z0-9.]*$/",$primarydns)) {
		  $primarydnserr = "dhcpuid field contains incorrect data, only a-zA-Z0-9_- allowed!<br />"; 
		}
	  }
	  if (!empty($_POST["secondarydns"])) {
		$secondarydns = test_input($_POST["secondarydns"]);
		if (!preg_match("/^[a-zA-Z0-9.]*$/",$secondarydns)) {
		  $secondarydnserr = "dhcpuid field contains incorrect data, only a-zA-Z0-9_- allowed!<br />"; 
		}
	  }
	  if (!empty($_POST["mtus"])) {
		$mtus = test_input($_POST["mtus"]);
		if (!preg_match("/^[0-9]*$/",$mtus)) {
		  $mtuerr = "dhcpuid field contains incorrect data, only a-zA-Z0-9_- allowed!<br />"; 
		}
	  }
	  if (!empty($_POST["mac"])) {
		$mac = test_input($_POST["mac"]);
		if (!preg_match("/^[a-fA-F0-9:]*$/",$mac)) {
		  $macerr = "dhcpuid field contains incorrect data, only a-zA-Z0-9_- allowed!<br />"; 
		}
	  }
	}
  ?>
<!-- ********************************************************************************************************************** -->
<!-- Forms -->
<!-- ********************************************************************************************************************** -->
  <div id="ContentTitle">
  <span>Network Settings</span></div>
  
  <div id="ContentArticle">
    <div id="networktypeselector">
      <fieldset><legend>LAN Connection</legend>
        <p>Choose how the wired connection's network settings will be set.</p>
        <table width="100%" border="0">
          <tr>
            <td width="40%" align="right">Connection type:</td>
            <td width="60%">
              <select name="selectnetconf" id="selectnetconf">
                <option value="conf-dhcp" <?php if($configurationsettings['lantype'] == "dhcp") {echo "selected='selected'";}?>>Dynamic IP (DHCP)</option>
                <option value="conf-static" <?php if($configurationsettings['lantype'] == "static") {echo "selected='selected'";}?>>Static IP</option>
                <option value="conf-pppoe" <?php if($configurationsettings['lantype'] == "pppoe") {echo "selected='selected'";}?>>PPPoE (username/password)</option>
              </select>
            </td>
          </tr>
        </table>
      </fieldset>
  	</div><!-- end div networktypeselector -->
  </div><!-- end div contentarticle -->
  
  <br />
<!-- ********************************************************************************************************************** -->  
  <div id="conf-dhcp">
    <div id="ContentTitle"><span>Dynamic IP (DHCP)</span></div>
    <div id="ContentArticle">
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="application/x-www-form-urlencoded" id="dynamic">
        <table width="100%" border="0">
          <tr>
            <td width="40%" align="right">DHCP UID:</td>
            <td><input name="dhcpuid" type="text" autofocus id="dhcpuid" form="dynamic" placeholder="RaspberryWifi" pattern="^[a-zA-Z0-9_-]*$" maxlength="17" <?php if(!empty($configurationsettings['dhcpuid'])) {echo "value=" . $configurationsettings['dhcpuid'];}?>></td>
          </tr>
          <tr>
            <td align="right">Override DNS servers:</td>
            <td><input name="overridedns" type="checkbox" id="overridedns" form="dynamic" <?php if(strcmp($configurationsettings['dhcpdnsoverride'],"enabled") == 0) {echo "checked";}?>></td>
          </tr>
          <tr>
            <td align="right">Primary DNS Server:</td>
            <td><input name="primarydns" type="text" id="primarydns" form="dynamic" placeholder="8.8.8.8" pattern="^[a-zA-Z0-9.]*$" maxlength="15" <?php if(!empty($configurationsettings['dns1'])) {echo "value=" . $configurationsettings['dns1'];}?>></td>
          </tr>
          <tr>
            <td align="right">Secondary DNS Server:</td>
            <td><input name="secondarydns" type="text" id="secondarydns" form="dynamic" placeholder="8.8.4.4" pattern="^[a-zA-Z0-9.]*$" maxlength="15" <?php if(!empty($configurationsettings['dns2'])) {echo "value=" . $configurationsettings['dns2'];}?>></td>
          </tr>
          <tr>
            <td align="right">MTU:</td>
            <td><input name="mtus" type="text" id="mtus" form="dynamic" placeholder="1500" pattern="^[0-9]*$" maxlength="4" <?php if(!empty($configurationsettings['lanmtu'])) {echo "value=" . $configurationsettings['lanmtu'];}?>></td>
          </tr>
          <tr>
            <td align="right">Mac Address:</td>
            <td><input name="mac" type="text" id="mac" form="dynamic" placeholder="00:11:22:33:44:55" pattern="^[a-fA-F0-9:]*$" maxlength="18" <?php if(!empty($configurationsettings['lanmac'])) {echo "value=" . $configurationsettings['lanmac'];}?>></td>
          </tr>
            <tr>
            <td align="right"><input name="buttondynamic" type="submit" id="buttondynamic" form="dynamic" value="Apply"></td>
            <td><span id="ReturnStatusDynamic"></span></td>
            </tr>
        </table>
      </form>
    </div><!-- end div contentarticle -->
  </div><!-- end div conf-dhcp -->
<!-- ********************************************************************************************************************** -->
  <div id="conf-static">
    <div id="ContentTitle">
    <span>Static IP</span></div>
    
    <div id="ContentArticle">
      <form action="<?php //echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="application/x-www-form-urlencoded" id="static">
        <table width="100%" border="0">
          <tr>
            <td width="40%" align="right">IP Address:</td>
            <td width="60%"><input name="ipaddress" type="text" autofocus required id="ipaddress" form="static" placeholder="192.168.0.1" pattern="^[0-9.]*$" maxlength="15" <?php if(!empty($configurationsettings['lanip'])) {echo "value=" . $configurationsettings['lanip'];}?>></td>
          </tr>
          <tr>
            <td align="right">Subnet Mask:</td>
            <td><input name="subnetmask" type="text" required id="subnetmask" form="static" placeholder="255.255.255.0" pattern="^[0-9.]*$" maxlength="15" <?php if(!empty($configurationsettings['lanmask'])) {echo "value=" . $configurationsettings['lanmask'];}?>></td>
          </tr>
          <tr>
            <td align="right">Default Gateway:</td>
            <td><input name="defaultgateway" type="text" id="defaultgateway" form="static" placeholder="192.168.0.254" pattern="^[0-9.]*$" maxlength="15" <?php if(!empty($configurationsettings['langw'])) {echo "value=" . $configurationsettings['langw'];}?>></td>
          </tr>

          <tr>
            <td align="right">Primary DNS Server:</td>
            <td><input name="primarydns" type="text" id="primarydns" form="static" placeholder="8.8.8.8" pattern="^[a-zA-Z0-9.]*$" maxlength="15" <?php if(!empty($configurationsettings['dns1'])) {echo "value=" . $configurationsettings['dns1'];}?>></td>
          </tr>
          <tr>
            <td align="right">Secondary DNS Server:</td>
            <td><input name="secondarydns" type="text" id="secondarydns" form="static" placeholder="8.8.4.4" pattern="^[a-zA-Z0-9.]*$" maxlength="15" <?php if(!empty($configurationsettings['dns2'])) {echo "value=" . $configurationsettings['dns2'];}?>></td>
          </tr>
          <tr>
            <td align="right">MTU:</td>
            <td><input name="mtus" type="text" id="mtus" form="static" placeholder="1500" pattern="^[0-9]*$" maxlength="4" <?php if(!empty($configurationsettings['lanmtu'])) {echo "value=" . $configurationsettings['lanmtu'];}?>></td>
          </tr>
          <tr>
            <td align="right">Mac Address:</td>
            <td><input name="mac" type="text" id="mac" form="static" placeholder="00:11:22:33:44:55" pattern="^[a-fA-F0-9:]*$" maxlength="18" <?php if(!empty($configurationsettings['lanmac'])) {echo "value=" . $configurationsettings['lanmac'];}?>></td>
          </tr>
            <tr>
            <td align="right"><input name="buttonstatic" type="submit" id="buttonstatic" form="static" value="Apply"></td>
            <td><span id="ReturnStatusStatic"></span></td>
          </tr>
        </table>
      </form>
    </div><!-- end div contentarticle -->
  </div><!-- end dif conf-static -->
<!-- ********************************************************************************************************************** -->
  <div id="conf-pppoe">
    <div id="ContentTitle">
    <span>PPPoE</span></div>
    
    <div id="ContentArticle">
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="application/x-www-form-urlencoded" id="pppoe">
        <table width="100%" border="0">
          <tr>
            <td width="40%" align="right">IP Address:</td>
            <td width="60%"><input name="ipaddress" type="text" id="ipaddress" form="pppoe" placeholder="192.168.0.1" pattern="^[0-9.]*$" maxlength="15" <?php if(!empty($configurationsettings['pppoeip'])) {echo "value=" . $configurationsettings['pppoeip'];}?>></td>
          </tr>
          <tr>
            <td align="right">Username:</td>
            <td><input name="username" type="text" id="username" form="pppoe" placeholder="my pppoe username" pattern="^[a-zA-Z0-9_-@]*$" maxlength="30" <?php if(!empty($configurationsettings['pppoeusername'])) {echo "value=" . $configurationsettings['pppoeusername'];}?>></td>
          </tr>
          <tr>
            <td align="right">Password:</td>
            <td><input name="password" type="password" id="password" form="pppoe" pattern="^[a-zA-Z0-9_-@]*$" maxlength="30" <?php if(!empty($configurationsettings['pppoepassword'])) {echo "value=" . $configurationsettings['pppoepassword'];}?>></td>
          </tr>

          <tr>
            <td align="right">Repeat Password:</td>
            <td><input name="repeatpassword" type="password" id="repeatpassword" form="pppoe" pattern="^[a-zA-Z0-9_-@]*$" maxlength="30" <?php if(!empty($configurationsettings['pppoepassword'])) {echo "value=" . $configurationsettings['pppoepassword'];}?>></td>
          </tr>
          <tr>
            <td align="right">Servicename:</td>
            <td><input name="servicename" type="text" id="servicename" form="pppoe" placeholder="my service name" pattern="^[a-zA-Z0-9_-@]*$" maxlength="30" <?php if(!empty($configurationsettings['pppoeservicename'])) {echo "value=" . $configurationsettings['pppoeservicename'];}?>></td>
          </tr>
          <tr>
            <td align="right">Idle Disconnect:</td>
            <td><input name="idledisconnect" type="text" id="idledisconnect" form="pppoe" placeholder="60" pattern="^[0-9]*$" maxlength="4" <?php if(!empty($configurationsettings['pppoeidletimer'])) {echo "value=" . $configurationsettings['pppoeidletimer'];}?>></td>
          </tr>
          <tr>
            <td align="right">Primary DNS Server:</td>
            <td><input name="primarydns" type="text" id="primarydns" form="pppoe" placeholder="8.8.8.8" pattern="^[a-zA-Z0-9.]*$" maxlength="15" <?php if(!empty($configurationsettings['dns1'])) {echo "value=" . $configurationsettings['dns1'];}?>></td>
          </tr>
          <tr>
            <td align="right">Secondary DNS Server:</td>
            <td><input name="secondarydns" type="text" id="secondarydns" form="pppoe" placeholder="8.8.4.4" pattern="^[a-zA-Z0-9.]*$" maxlength="15" <?php if(!empty($configurationsettings['dns2'])) {echo "value=" . $configurationsettings['dns2'];}?>></td>
          </tr>
          <tr>
            <td align="right">MTU:</td>
            <td><input name="mtus" type="text" id="mtus" form="pppoe" placeholder="1500" pattern="^[0-9]*$" maxlength="4" <?php if(!empty($configurationsettings['lanmtu'])) {echo "value=" . $configurationsettings['lanmtu'];}?>></td>
          </tr>
          <tr>
            <td align="right">Mac Address:</td>
            <td><input name="mac" type="text" id="mac" form="pppoe" placeholder="00:11:22:33:44:55" pattern="^[a-fA-F0-9:]*$" maxlength="18" <?php if(!empty($configurationsettings['lanmac'])) {echo "value=" . $configurationsettings['lanmac'];}?>></td>
          </tr>
            <tr>
            <td align="right"><input name="buttonpppoe" type="submit" id="buttonpppoe" form="pppoe" value="Apply"></td>
            <td><span id="ReturnStatusPppoe"></td>
          </tr>
        </table>
      </form>
    </div><!-- end div contentarticle -->
  </div><!-- end div conf-pppoe -->
<!-- ********************************************************************************************************************** -->
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
<!-- ********************************************************************************************************************** -->
<script>
// jquery script to show and hide selected div's (DHCP, Static, Pppoe)
$('[id^="conf"]').hide(); // hide every div element on this web page where the ID contains "conf"
$("#selectnetconf").on('change', function() { // when the connection type selector is changed
    $("#"+this.value).show().siblings('[id^="conf"]').hide(); // show the correct div and hide the others
});
</script>
<!-- ********************************************************************************************************************** -->
<?php // when page loads, show the correct div according to config file
if(strcmp($configurationsettings['lantype'],"dhcp") == 0) {echo '<script>$("#conf-dhcp").show();</script>';}
if(strcmp($configurationsettings['lantype'],"static") == 0) {echo '<script>$("#conf-static").show();</script>';}
if(strcmp($configurationsettings['lantype'],"pppoe") == 0) {echo '<script>$("#conf-pppoe").show();</script>';}
?>  
<!-- ********************************************************************************************************************** -->
  <?php //apply shell actions to modify network configuration for the DHCP form
	if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['buttondynamic'])) {
	  // only apply shell actions when no form errors are present
	  if(empty($dhcpuiderr) && empty($primarydnserr) && empty($secondarydnserr) && empty($mtuerr) && empty($macerr)) {
		logmessage("Starting to apply dhcp form changes.");
		echo "<script>ReturnProgressDynamic();</script>";
		flush();
		// in case of mac change
		if($macchange) { // and when in access point mode
			if(strcmp($configurationsettings['operationmode'],"Access Point") == 0) {
				logmessage("Reconfiguring interface br0 (ifdown-ifup)");
				shell_exec("sudo ifdown br0 && sudo ifup br0");
			  } // or when in router mode
			if(strcmp($configurationsettings['operationmode'],"Router") == 0) {
				logmessage("Unconfiguring interface eth0 (ifdown)");
				shell_exec("sudo ifdown eth0");
				logmessage("Changing Mac address on interface eth0");
				shell_exec("sudo ifconfig eth0 hw ether " . $mac);
				logmessage("Configuring interface eth0 (ifup)");
				shell_exec("sudo ifup eth0");
			  }
		}
		// in case of no mac change
		else { //and when in access point mode
			if(strcmp($configurationsettings['operationmode'],"Access Point") == 0) {
				logmessage("Reconfiguring interface br0 (ifdown-ifup)");
				shell_exec("sudo ifdown br0 && sudo ifup br0");
			} // or when in router mode
			if(strcmp($configurationsettings['operationmode'],"Router") == 0) {
				logmessage("Reconfiguring interface eth0 (ifdown-ifup)");
				shell_exec("sudo ifdown eth0 && sudo ifup eth0");
			}
		}
		echo "<script>ReturnReadyDynamic();</script>";
	  }
	  else { // if form errors are present, show them in the status cell on the form
		logmessage("Wrong form data received: " . $dhcpuiderr . "'+'" . $primarydnserr . "'+'" . $secondarydnserr . "'+'" . $mtuerr . "'+'" . $macerr);
		echo "<script>ReturnFailureDynamic('" . $dhcpuiderr . "'+'" . $primarydnserr . "'+'" . $secondarydnserr . "'+'" . $mtuerr . "'+'" . $macerr . "');</script>";
	  }
	}
  ?>
<!-- ********************************************************************************************************************** -->
  <?php //apply shell actions to modify network configuration for the static form
	if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['buttonstatic'])) {
	  // only apply shell actions when no form errors are present
	  if(empty($ipaddresserr) && empty($subnetmaskerr) && empty($defaultgatewayerr) && empty($primarydnserr) && empty($secondarydnserr) && empty($mtuerr) && empty($macaddresserr)) {
		logmessage("Starting to apply Static IP form changes.");
		echo "<script>ReturnProgressStatic();</script>";
		// in case of mac change
		flush();
		if($macchange) { // and when in access point mode
			if(strcmp($configurationsettings['operationmode'],"Access Point") == 0) {
				logmessage("Reconfiguring interface br0 (ifdown-ifup)");
				shell_exec("sudo ifdown br0 && sudo ifup br0");
			  } // or when in router mode
			if(strcmp($configurationsettings['operationmode'],"Router") == 0) {
				logmessage("Unconfiguring interface eth0 (ifdown)");
				shell_exec("sudo ifdown eth0");
				logmessage("Changing Mac address on interface eth0");
				shell_exec("sudo ifconfig eth0 hw ether " . $mac);
				logmessage("Configuring interface eth0 (ifup)");
				shell_exec("sudo ifup eth0");
			  }
		}
		// in case of no mac change
		else { //and when in access point mode
			if(strcmp($configurationsettings['operationmode'],"Access Point") == 0) {
				logmessage("Reconfiguring interface br0 (ifdown-ifup)");
				shell_exec("sudo ifdown br0 && sudo ifup br0");
			} // or when in router mode
			if(strcmp($configurationsettings['operationmode'],"Router") == 0) {
				logmessage("Reconfiguring interface eth0 (ifdown-ifup)");
				shell_exec("sudo ifdown eth0 && sudo ifup eth0");
			}
		}
		echo "<script>ReturnReadyStatic();</script>";
	  }
	  else { // if form errors are present, show them in the status cell on the form
		if(empty($ipaddress) || empty($subnetmask))
		  echo "<script>ReturnFailureStatic('IP Address and Subnet Mask are required values!'";
		logmessage("Reconfiguring interface eth0 (ifdown-ifup)" . $ipaddresserr . "'+'" . $subnetmaskerr . "'+'" . $defaultgatewayerr . "'+'" . $primarydnserr . "'+'" . $secondarydnserr . "'+'" . $mtuerr . "'+'" . $macaddresserr);
		echo "<script>ReturnFailureStatic('" . $ipaddresserr . "'+'" . $subnetmaskerr . "'+'" . $defaultgatewayerr . "'+'" . $primarydnserr . "'+'" . $secondarydnserr . "'+'" . $mtuerr . "'+'" . $macaddresserr . "');</script>";
	  }
	}
  ?>
<!-- ********************************************************************************************************************** -->
<?php
  if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['buttonpppoe'])) {
	if(!empty($ipaddresserr) || !empty($usernameerr) || !empty($passworderr) || !empty($repeatpassworderr) || !empty($servicenameerr) || !empty($idledisconnecterr) || !empty($primarydnserr) || !empty($secondarydnserr) || !empty($mtuerr) || !empty($macerr)) {
	  echo "<script>ReturnFailureDynamic('" . $ipaddresserr . "'+'" . $usernameerr . "'+'" . $passworderr . "'+'" . $repeatpassworderr . "'+'" . $servicenameerr . "'+'" . $idledisconnecterr . "'+'" . $primarydnserr . "'+'" . $secondarydnserr . "'+'" . $mtuerr . "'+'" . $macerr . "');</script>";
	}
  }
?>  
<!-- ********************************************************************************************************************** -->
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>
