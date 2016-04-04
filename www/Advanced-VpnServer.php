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
<?php logmessage("Loading page Advanced-VpnServer.php");?>
<script>
  function ReturnProgressCa() {
	  document.getElementById('ca_indicator').innerHTML = '<img src="images/ProgressIndicator.GIF" width="100" height="15"  alt="">';
  }
  function ReturnReadyCa() {
	  document.getElementById('ca_indicator').innerHTML = '<img src="images/Ready.png" width="20" height="20"  alt="">';
  }
  function ReturnStatusCa(message) {
	  document.getElementById('ca_status').innerHTML = '<span style="color:red">' + message + '</span>';
  }
  function ReturnStatusNewCertificate(message) {
	  document.getElementById('ReturnStatus_openvpn_newuser').innerHTML = '<span style="color:red">' + message + '</span>';
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
         <li class='has-sub' id="Advanced"><a href='#'><span>Advanced</span></a>
            <ul id="AdvancedUl">
               <li><a href='Advanced-PortForwarding.php'><span>Port Forwarding</span></a></li>
               <li><a href='Advanced-CaptivePortal.php'><span>Captive Portal</span></a></li>
               <li><a href='Advanced-VpnServer.php'><span>VPN Server</span></a></li>
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
	$('#Advanced').addClass('active');
	$('#AdvancedUl').show();
  </script>
  <!-- InstanceEndEditable -->
  
  <article class="content">
    <!-- InstanceBeginEditable name="article" -->
<?php include 'mysqlfunctions.php';?>
<!-- ********************************************************************************************************************** -->
    <?php $configurationsettings = parse_ini_file("/home/pi/Raspberry-Wifi-Router/www/routersettings.ini");?>
<!-- ********************************************************************************************************************** -->
	<?php
	  if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['btn_vpnserver_enable'])) {
		logmessage("Checking if we need to enable OpenVPN Server");
		if 	(array_key_exists ("chk_enable_vpnserver" , $_POST)) {
  		  logmessage("We need to enable the OpenVPN Server.");
		  $configurationsettings['vpnserver'] = "enabled";
		}
		else {
   		  logmessage("We need to disable the OpenVPN Server.");
		  $configurationsettings['vpnserver'] = "disabled";
		}
		logmessage("Writing OpenVPN status to configuration file: /home/pi/Raspberry-Wifi-Router/www/routersettings.ini");
		write_php_ini($configurationsettings, "/home/pi/Raspberry-Wifi-Router/www/routersettings.ini");
	  }
	?>   	
<!-- ********************************************************************************************************************** -->
	<?php   	
	  if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['init_ca'])) {
		logmessage("Processing Certificate Authority form data.");
		$selectcrypto = $txtcountry = $txtprovince = $txtcity = $txtorganisation = $txtemail = "";
		$selectcryptoerr = $txtcountryerr = $txtprovinceerr = $txtcityerr = $txtorganisationerr = $txtemailerr = "";
		
		if (!empty($_POST["selectcrypto"])) {
		  $selectcrypto = test_input($_POST["selectcrypto"]);
		  if (!strcmp($selectcrypto, "1024") && !strcmp($selectcrypto, "2048") && !strcmp($selectcrypto, "4096")) {
			$selectcryptoerr = "Incorrect Selection data received!<br />"; 
		  }
		}
		
		if (!empty($_POST["txtcountry"])) {
		  $txtcountry = test_input($_POST["txtcountry"]);
		  if (!preg_match("/^[a-zA-Z]*$/",$txtcountry)) {
			$txtcountryerr = "Country field contains incorrect data, only a-zA-Z0-9_- allowed!<br />"; 
		  }
		}
		
		if (!empty($_POST["txtprovince"])) {
		  $txtprovince = test_input($_POST["txtprovince"]);
		  if (!preg_match("/^[a-zA-Z0-9_\- ]*$/",$txtprovince)) {
			$txtprovinceerr = $txtprovince . "Province field contains incorrect data, only a-zA-Z0-9_- allowed!<br />"; 
		  }
		}
  
		if (!empty($_POST["txtcity"])) {
		  $txtcity = test_input($_POST["txtcity"]);
		  if (!preg_match("/^[a-zA-Z0-9_\- ]*$/",$txtcity)) {
			$txtcityerr = "City field contains incorrect data, only a-zA-Z0-9_- allowed!<br />"; 
		  }
		}
  
		if (!empty($_POST["txtorganisation"])) {
		  $txtorganisation = test_input($_POST["txtorganisation"]);
		  if (!preg_match("/^[a-zA-Z0-9_\- ]*$/",$txtorganisation)) {
			$txtorganisationerr = "Organisation field contains incorrect data, only a-zA-Z0-9_- allowed!<br />"; 
		  }
		}
  
		if (!empty($_POST["txtemail"])) {
		  $txtemail = test_input($_POST["txtemail"]);
		  if (!preg_match("/^[a-zA-Z0-9@.]*$/",$txtemail)) {
			$txtemailerr = "Email field contains incorrect data, only a-zA-Z0-9_- allowed!<br />"; 
		  }
		}
	  $configurationsettings['certstrenght'] = $selectcrypto;
	  $configurationsettings['certcountry'] = $txtcountry;
	  $configurationsettings['certprovince'] = $txtprovince;
	  $configurationsettings['certcity'] = $txtcity;
	  $configurationsettings['certorg'] = $txtorganisation;
	  $configurationsettings['certemail'] = $txtemail;
	  logmessage("Writing Certificate Authority form data to config file: /home/pi/Raspberry-Wifi-Router/www/routersettings.ini");
	  write_php_ini($configurationsettings, "/home/pi/Raspberry-Wifi-Router/www/routersettings.ini");
	  }
	?>
<!-- ********************************************************************************************************************** -->
	<?php
	  if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['btn_ca_reset'])) {
		logmessage("Processing Certificate Authority Reset form.");
		$configurationsettings['certauth'] = "disabled";
		$configurationsettings['certstrenght'] = 1024;
		$configurationsettings['certcountry'] = "";
		$configurationsettings['certprovince'] = "";
		$configurationsettings['certcity'] = "";
		$configurationsettings['certorg'] = "";
		$configurationsettings['certemail'] = "";
		logmessage("Writing reset changes to configuration file: /home/pi/Raspberry-Wifi-Router/www/routersettings.ini");
		write_php_ini($configurationsettings, "/home/pi/Raspberry-Wifi-Router/www/routersettings.ini");
	  }
	?>   	
<!-- ********************************************************************************************************************** -->
	<?php
	  if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['btn_openvpn_newuser'])) {
		logmessage("Processing Create Certificates form.");
		
		$openvpnservername = $txtusername = $txtfirstname = $txtlastname = $txtcountry = $txtprovince = $txtcity = $txtorganisation = $txtemail = "";
		
		$openvpnservernameerr = $txtusernameerr = $txtfirstnameerr = $txtlastnameerr = $txtcountryerr = $txtprovinceerr = $txtcityerr = $txtorganisationerr = $txtemailerr = "";
		
		if (!empty($_POST["openvpnservername"])) {
		  $openvpnservername = test_input($_POST["openvpnservername"]);
		  if (!preg_match("/^[a-zA-Z0-9_\-.]*$/",$openvpnservername)) {
			$openvpnservernameerr = "openvpnservername field contains incorrect data, only a-zA-Z0-9_- allowed!<br />"; 
		  }
		}
		if (!empty($_POST["txtusername"])) {
		  $txtusername = test_input($_POST["txtusername"]);
		  if (!preg_match("/^[a-zA-Z0-9_-]*$/",$txtusername)) {
			$txtusernameerr = "Username field contains incorrect data, only a-zA-Z0-9_- allowed!<br />"; 
		  }
		}
		
		if (!empty($_POST["txtfirstname"])) {
		  $txtfirstname = test_input($_POST["txtfirstname"]);
		  if (!preg_match("/^[a-zA-Z0-9_\- ]*$/",$txtfirstname)) {
			$txtfirstnameerr = "Firstname field contains incorrect data, only a-zA-Z0-9_- allowed!<br />"; 
		  }
		}

		if (!empty($_POST["txtlastname"])) {
		  $txtlastname = test_input($_POST["txtlastname"]);
		  if (!preg_match("/^[a-zA-Z0-9_\- ]*$/",$txtlastname)) {
			$txtlastnameerr = "Lastname field contains incorrect data, only a-zA-Z0-9_- allowed!<br />"; 
		  }
		}
	  
		if (!empty($_POST["txtcountry"])) {
		  $txtcountry = test_input($_POST["txtcountry"]);
		  if (!preg_match("/^[a-zA-Z]*$/",$txtcountry)) {
			$txtcountryerr = "Country field contains incorrect data, only a-zA-Z0-9_- allowed!<br />"; 
		  }
		}
		
		if (!empty($_POST["txtprovince"])) {
		  $txtprovince = test_input($_POST["txtprovince"]);
		  if (!preg_match("/^[a-zA-Z0-9_\- ]*$/",$txtprovince)) {
			$txtprovinceerr = "Province field contains incorrect data, only a-zA-Z0-9_- allowed!<br />"; 
		  }
		}
  
		if (!empty($_POST["txtcity"])) {
		  $txtcity = test_input($_POST["txtcity"]);
		  if (!preg_match("/^[a-zA-Z0-9_\- ]*$/",$txtcity)) {
			$txtcityerr = "City field contains incorrect data, only a-zA-Z0-9_- allowed!<br />"; 
		  }
		}
  
		if (!empty($_POST["txtorganisation"])) {
		  $txtorganisation = test_input($_POST["txtorganisation"]);
		  if (!preg_match("/^[a-zA-Z0-9_\- ]*$/",$txtorganisation)) {
			$txtorganisationerr = "Organisation field contains incorrect data, only a-zA-Z0-9_- allowed!<br />"; 
		  }
		}
  
		if (!empty($_POST["txtemail"])) {
		  $txtemail = test_input($_POST["txtemail"]);
		  if (!preg_match("/^[a-zA-Z0-9@.]*$/",$txtemail)) {
			$txtemailerr = "Email field contains incorrect data, only a-zA-Z0-9_- allowed!<br />"; 
		  }
		}
	
		if(empty($openvpnservernameerr) && empty($txtusernameerr) && empty($txtfirstnameerr) && empty($txtlastnameerr) && empty($txtcountryerr) && empty($txtprovinceerr) && empty($txtcityerr) && empty($txtorganisationerr) && empty($txtemailerr) && !empty($openvpnservername) && !empty($txtusername) && !empty($txtfirstname) && !empty($txtlastname) && !empty($txtcountry) && !empty($txtprovince) && !empty($txtcity) && !empty($txtorganisation) && !empty($txtemail)) {
		  
		  $txtpackageurl = "/temp/OpenVPN_ClientPackages/" . $txtusername . "-" . rand() . ".zip";
		  
		  logmessage("Writing client certificate details to login database.");
		  // insert records into database
		  insert("INSERT INTO openvpnusers (openvpnservername, username, firstname, lastname, country, province, city, organisation, email, packageurl) VALUES ('$openvpnservername','$txtusername', '$txtfirstname', '$txtlastname', '$txtcountry', '$txtprovince', '$txtcity', '$txtorganisation', '$txtemail', '$txtpackageurl')","login");
		}
	  }
	?>   	
<!-- ********************************************************************************************************************** -->
	<?php
	  if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['btn_openvpn_deleteuser'])) {
		if(!empty($_POST['radiogroup_user'])) {
		  $recordset = select("select packageurl from openvpnusers where username='" . $_POST['radiogroup_user'] . "'","login");
			if (mysqli_num_rows($recordset) > 0) {
			  while($row = mysqli_fetch_assoc($recordset)) {
			  shell_exec("sudo rm /var/www" . $row['packageurl']);
			  }
			}
		  logmessage("Deleting user " . $_POST['radiogroup_user'] . " from certificate login database.");
		  delete('DELETE FROM openvpnusers WHERE username="' . $_POST['radiogroup_user'] . '"','login');
		  logmessage("Revoking Certificate.");
		  shell_exec("sudo bash -c '(cd /etc/openvpn/easy-rsa && . ./vars && ./revoke-full " . $_POST['radiogroup_user'] . ")' 2>&1 | sudo tee -a /var/log/raspberrywap.log");			
		  logmessage("Generating Certificate Revocation List");
		  shell_exec("sudo bash -c '(cd /etc/openvpn/easy-rsa && . ./vars && ./list-crl)' 2>&1 | sudo tee -a /var/log/raspberrywap.log");			
		  logmessage("Copying Certification Revocation List to OpenVPN config.");
		  shell_exec("sudo cp /etc/openvpn/easy-rsa/keys/crl.pem /etc/openvpn/crl.pem");
		}
		else {
			logmessage("No user selected to delete, nothing to do.");
			echo ('<script>ReturnStatus_form_deleteusers("No user selected, so nothing deleted.");</script>'); 
		}
	  }
	?>   	
    
<!-- ********************************************************************************************************************** -->
  <div id="ContentArticle">
<!-- ********************************************************************************************************************** -->
    <div id="div_vpnserver_enable">
    <div id="ContentTitle"><span>OpenVPN Server</span></div>
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="application/x-www-form-urlencoded" id="frm_vpnserver_enable">
      <fieldset><legend>Enable/Disable OpenVPN Server</legend>
      	<table width="100%" border="0">
          <tr>
            <td align="right"><label for="chk_enable_vpnserver">Enable OpenVPN Server:</label></td>
            <td><input name="chk_enable_vpnserver" type="checkbox" autofocus id="chk_enable_vpnserver" form="frm_vpnserver_enable" <?php if ($configurationsettings['vpnserver'] == "enabled") {echo "checked";}?>></td>
          </tr>
          <tr>
            <td width="40%">&nbsp;</td>
            <td width="60%"><input name="btn_vpnserver_enable" type="submit" id="btn_vpnserver_enable" form="frm_vpnserver_enable" value="Apply"></td>
          </tr>
        </table>
      </fieldset>
    </form>
    </div><!-- end div div_vpnserver_enable -->
<!-- ********************************************************************************************************************** -->
    <div id="div_ca_init" <?php if($configurationsettings['certauth'] == "enabled" || $configurationsettings['vpnserver'] == "disabled") {echo 'style="display: none"';}?>>
    <div id="ContentTitle"><span>OpenVPN Server Certificate Authority</span></div>

      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="application/x-www-form-urlencoded" id="frm_ca_init">
        <fieldset><legend>Initialize Certificate Authority</legend>
          <table width="100%" border="0">
            <tr>
              <td colspan="2" align="center">The Raspberry WAP uses OpenVPN as its VPN server.<br />
      Since OpenVPN works with certificates to authenticate it's clients, you first need to initialize a Certificate Authority to establish a Public Key Infrastructure.<br />
      Once that you have initialised your Certificate Authority you will be able to generate certificates for clients who will be dialing into this VPN server.
              </td>          
            </tr>
            <tr>
              <td colspan="2" align="center">Beware when choosing the Cryptographic Strength for this Certificate Authority, the higher u choose, the slower this will run on the Raspberry Pi.</td>
              </tr>
            <tr>
              <td align="right">&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td width="30%" align="right"><label for="selectcrypto">Cryptographic strength:</label></td>
              <td width="70%"><select name="selectcrypto" autofocus id="selectcrypto" form="frm_ca_init" tabindex="1">
                <option value="1024" <?php if($configurationsettings['certstrenght'] == 1024)  {echo 'selected="selected"';}?>>1024 bit - ok, default security</option>
                <option value="2048" <?php if($configurationsettings['certstrenght'] == 2048)  {echo 'selected="selected"';}?>>2048 bit - if you're beïng paranoid</option>
                <option value="4096" <?php if($configurationsettings['certstrenght'] == 4096)  {echo 'selected="selected"';}?>>4096 bit - protection against Nsa</option>
              </select></td>
            </tr>
            <tr>
              <td align="right"><label for="txtcountry">Country:</label></td>
              <td><input name="txtcountry" type="text" required id="txtcountry" form="frm_ca_init" placeholder="BE" pattern="^[a-zA-Z]*$" size="2" maxlength="2" <?php if(!empty($configurationsettings['certcountry'])) {echo 'value="' . $configurationsettings['certcountry'] . '"';}?> pattern="^[a-zA-Z0-9_-]*$"></td>
            </tr>
            <tr>
              <td align="right"><label for="txtprovince">Province:</label></td>
              <td><input name="txtprovince" type="text" required id="txtprovince" form="frm_ca_init" placeholder="East-Flanders"  <?php if(!empty($configurationsettings['certprovince'])) {echo 'value="' . $configurationsettings['certprovince'] . '"';}?> pattern="^[a-zA-Z0-9_- ]*$"></td>
            </tr>
            <tr>
              <td align="right"><label for="txtcity">City:</label></td>
              <td><input name="txtcity" type="text" required id="txtcity" form="frm_ca_init" placeholder="Hamme"  <?php if(!empty($configurationsettings['certcity'])) {echo 'value="' . $configurationsettings['certcity'] . '"';}?>pattern="^[a-zA-Z0-9_- ]*$"></td>
            </tr>
            <tr>
              <td align="right"><label for="txtorganisation">Organisation:</label></td>
              <td><input name="txtorganisation" type="text" required id="txtorganisation" form="frm_ca_init" placeholder="none-private individual"  <?php if(!empty($configurationsettings['certorg'])) {echo 'value="' . $configurationsettings['certorg'] . '"';}?> pattern="^[a-zA-Z0-9_- ]*$"></td>
            </tr>
            <tr>
              <td align="right"><label for="txtemail">Email:</label></td>
              <td><input name="txtemail" type="text" required id="txtemail" form="frm_ca_init" placeholder="my-email@somedomain.com" size="30"  <?php if(!empty($configurationsettings['certemail'])) {echo 'value="' . $configurationsettings['certemail'] . '"';}?> pattern="^[a-zA-Z0-9@.]*$"></td>
            </tr>
            <tr>
              <td align="center">&nbsp;</td>
              <td><input name="init_ca" type="submit" id="init_ca" form="frm_ca_init" value="Initialize Certificate Authority"></td>
            </tr>
            <tr>
              <td align="center">&nbsp;</td>
              <td><span id="ca_indicator">ca indicator</span></td>
            </tr>
            <tr>
              <td align="center">&nbsp;</td>
              <td><span id="ca_status">ca status</span></td>
            </tr>
          </table>
        </fieldset>
      </form>
    </div><!-- end div div_ca_init -->
<!-- ********************************************************************************************************************** -->
    <div id="div_ca_reset" <?php if($configurationsettings['certauth'] == "enabled" && $configurationsettings['vpnserver'] == "enabled") {echo 'style="display: initial"';} else {echo 'style="display: none"';}?>>
    
      <div id="ContentTitle"><span>OpenVPN Server Certificate Authority</span></div>      

    
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="application/x-www-form-urlencoded" id="frm_ca_reset">
        <fieldset><legend>Certificate Authority</legend>
        	<table width="100%" border="0">
              <tr>
                <td width="6%"><img src="images/Ready.png" width="20" height="20"  alt=""/></td>
                <td colspan="2">Certificate Authority is configured.</td>
              </tr>
              <tr>
                <td><img src="images/Warning.png" width="20" height="20
                "  alt=""/></td>
                <td colspan="2">When the Private Key of your Certificate Authority has been compromised, you can reset the certificate authority. This will re-initialise the certificate authority, generating a new private key. <br/>Warning: this will render all issued client certificates invalid to login to this OpenVPN server.</td>
              </tr>
              <tr>
                <td><img src="images/Alert.png" width="20" height="20"  alt=""/></td>
                <td width="14%"><input name="btn_ca_reset" type="submit" id="btn_ca_reset" form="frm_ca_reset" value="Reset CA"></td>
                <td width="80%">Think twice before pressing the reset button.</td>
              </tr>
            </table>
        </fieldset>
      </form>
    </div><!-- end div div_ca_reset -->
<!-- ********************************************************************************************************************** -->
   <div id="div_openvpn_newuser" <?php if($configurationsettings['certauth'] == "enabled" && $configurationsettings['vpnserver'] == "enabled") {echo 'style="display: initial"';} else {echo 'style="display: none"';}?>>
      <div id="ContentTitle"><span>OpenVPN User Certificate Generation</span></div>      

      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="application/x-www-form-urlencoded" id="frm_openvpn_newuser">
        <fieldset><legend>Create OpenVPN login user certificates</legend>
          <table width="100%" border="0">
            <tr>
              <td colspan="2">Each user that needs to login to this OpenVPN server will need a certificate package containing some openvpn parameters, a root certificate of this authority, and a client certificate to login with. U can generate these certificate packages here. Once U generate a certificate package, you will be able to download it from below list, you need to hand this over out of band to your user who will be dialing in.</td>
              </tr>
            <tr>
              <td align="right"><label for="openvpnservername">OpenVPN FQDN/IP:</label></td>
              <td><input name="openvpnservername" type="text" autofocus required id="openvpnservername" form="frm_openvpn_newuser" placeholder="Raspberry Pi public FQDN/IP" pattern="^[a-zA-Z0-9_-.]*$" size="25"></td>
            </tr>
            <tr>
              <td width="30%" align="right"><label for="txtusername">Username:</label></td>
              <td width="70%"><input name="txtusername" type="text" required id="txtusername" form="frm_openvpn_newuser" placeholder="johnd" pattern="^[a-zA-Z0-9_-]*$"></td>
            </tr>
            <tr>
              <td align="right">First Name:</td>
              <td><input name="txtfirstname" type="text" required id="txtfirstname" form="frm_openvpn_newuser" placeholder="John" pattern="^[a-zA-Z0-9_-\s]*$"></td>
            </tr>
            <tr>
              <td align="right"><label for="txtlastname">Last Name:</label></td>
              <td><input name="txtlastname" type="text" required id="txtlastname" form="frm_openvpn_newuser" placeholder="Doe" pattern="^[a-zA-Z0-9_-\s]*$"></td>
            </tr>
            <td align="right"><label for="txtcountry">Country:</label></td>
              <td><input name="txtcountry" type="text" required id="txtcountry" form="frm_openvpn_newuser" placeholder="BE" pattern="^[a-zA-Z]*$" size="2" maxlength="2" ($pattern="^[a-zA-Z0-9_-]*$"></td>
            </tr>
            <tr>
              <td align="right"><label for="txtprovince">Province:</label></td>
              <td><input name="txtprovince" type="text" required id="txtprovince" form="frm_openvpn_newuser" placeholder="East-Flanders" pattern="^[a-zA-Z0-9_-\s]*$"></td>
            </tr>
            <tr>
              <td align="right"><label for="txtcity">City:</label></td>
              <td><input name="txtcity" type="text" required id="txtcity" form="frm_openvpn_newuser" placeholder="Hamme" pattern="^[a-zA-Z0-9_-\s]*$"></td>
            </tr>
            <tr>
              <td align="right"><label for="txtorganisation">Organisation:</label></td>
              <td><input name="txtorganisation" type="text" required id="txtorganisation" form="frm_openvpn_newuser" placeholder="none-private individual" pattern="^[a-zA-Z0-9_-\s]*$"></td>
            </tr>
            <tr>
              <td align="right"><label for="txtemail">Email:</label></td>
              <td><input name="txtemail" type="text" required id="txtemail" form="frm_openvpn_newuser" placeholder="my-email@somedomain.com" size="30" pattern="^[a-zA-Z0-9@.]*$"></td>
            <tr>
              <td align="right">&nbsp;</td>
              <td><input name="btn_openvpn_newuser" type="submit" id="btn_openvpn_newuser" form="frm_openvpn_newuser" value="Generate Certificate Package"></td>
            </tr>
            <tr>
              <td align="right">&nbsp;</td>
              <td><span id="ReturnStatus_openvpn_newuser"></span></td>
            </tr>
          </table>
        </fieldset>
      </form>
    </div><!-- end div div_openvpn_newuser -->
<!-- ********************************************************************************************************************** -->
   <div id="div_openvpn_deleteuser" <?php if($configurationsettings['certauth'] == "enabled" && $configurationsettings['vpnserver'] == "enabled") {echo 'style="display: initial"';} else {echo 'style="display: none"';}?>>
      <div id="ContentTitle"><span>OpenVPN Delete Certificates</span></div>      
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="application/x-www-form-urlencoded" id="frm_openvpn_deleteuser">
        <fieldset>
          <legend>Delete OpenVPN login user certificates</legend>
          <table width="100%" border="1">
			<?php 
              $recordset = select("select openvpnservername,username,firstname,lastname,country,province,city,organisation,email,packageurl from openvpnusers","login");                  
              
              if (mysqli_num_rows($recordset) > 0) {
                // output data of each row
                while($row = mysqli_fetch_assoc($recordset)) {
                  $count = 0;
				  echo '<tr>';
					echo '<td>';
					  echo '<label><input type="radio" name="radiogroup_user" value="' . $row["username"] . '" id="users_0">';
					echo '</td>';
					echo '<td>';
					  echo $row["firstname"] . ' ' . $row["lastname"] . ', alias ' . $row["username"] . ', from ';
					  echo $row["city"] . ', ' . $row["province"] . ' in ' . $row["country"] . '</label>' . '<br />';
					  echo $row["organisation"] . ' - ' . $row["email"] . '<br />'; 					
					  echo 'OpenVPN server: ' . $row["openvpnservername"] . '--> <a href="' . $row["packageurl"] . '">Download user certificate.</a>';
					echo '</td>';
				  echo '</tr>';
                }
              } 
            ?>
            <tr>
              <td align="right">&nbsp;</td>
              <td><span id="ReturnStatus_form_deleteusers">
                <input name="btn_openvpn_deleteuser" type="submit" id="btn_openvpn_deleteuser" form="frm_openvpn_deleteuser" value="Delete User">
              </span></td>
            </tr>
          </table>
        </fieldset>
      </form>
    </div> <!-- end div div_openvpn_deleteuser -->
  </div> <!-- end div ContentArticle -->

    <!-- InstanceEndEditable -->
  </article><!-- end .content -->


  <aside>
  <!-- InstanceBeginEditable name="aside" --><!-- InstanceEndEditable -->
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
	  if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['btn_vpnserver_enable'])) {
		flush();
		if 	(array_key_exists ("chk_enable_vpnserver" , $_POST)) {
		  logmessage("Scheduling OpenVPN Server to start at boot time.");
		  shell_exec("sudo update-rc.d openvpn defaults 2>&1 | sudo tee -a /var/log/raspberrywap.log");
  		  if($configurationsettings['certauth'] == "enabled") {
			logmessage("Starting OpenVPN Service.");
			shell_exec("sudo service openvpn start 2>&1 | sudo tee -a /var/log/raspberrywap.log");
		  }
		}
		else {
		  logmessage("Unscheduling OpenVPN Server to start at boot time.");
		  shell_exec("sudo update-rc.d -f openvpn remove 2>&1 | sudo tee -a /var/log/raspberrywap.log");
  		  logmessage("Stopping OpenVPN Service.");
		  shell_exec("sudo service openvpn stop 2>&1 | sudo tee -a /var/log/raspberrywap.log");
		}
	  }
	?>   	
<!-- ********************************************************************************************************************** -->
	<?php
      
	  if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['init_ca'])) {
		if(empty($selectcryptoerr) && empty($txtcountryerr) && empty($txtprovinceerr) && empty($txtcityerr) && empty($txtorganisationerr) && empty($txtemailerr)) {
		  logmessage("Starting Certificate Authority Initialisation.");

  		  echo '<script>ReturnProgressCa();</script>';
		  echo '<script>ReturnStatusCa("Starting Certificate Authority Initialisation.");</script>';
		  
		  flush();
		  
		  logmessage("Creating new easy-rsa folder # sudo /usr/bin/make-cadir /etc/openvpn/easy-rsa");
		  shell_exec("sudo /usr/bin/make-cadir /etc/openvpn/easy-rsa 2>&1 | sudo tee -a /var/log/raspberrywap.log");
		  
		  logmessage("Modifying default Certificate Authority generation parameters.");
		  
		  logmessage("sudo sed -i 's/export KEY_SIZE=2048/export KEY_SIZE=" . $selectcrypto . "/g' /etc/openvpn/easy-rsa/vars 2>&1 | sudo tee -a /var/log/raspberrywap.log");
		  shell_exec("sudo sed -i 's/export KEY_SIZE=2048/export KEY_SIZE=" . $selectcrypto . "/g' /etc/openvpn/easy-rsa/vars 2>&1 | sudo tee -a /var/log/raspberrywap.log");
		  
		  logmessage("sudo sed -i 's/export KEY_COUNTRY=\"US\"/export KEY_COUNTRY=\"" . $txtcountry . "\"/g' /etc/openvpn/easy-rsa/vars 2>&1 | sudo tee -a /var/log/raspberrywap.log");
		  shell_exec("sudo sed -i 's/export KEY_COUNTRY=\"US\"/export KEY_COUNTRY=\"" . $txtcountry . "\"/g' /etc/openvpn/easy-rsa/vars 2>&1 | sudo tee -a /var/log/raspberrywap.log");
		  
		  logmessage("sudo sed -i 's/export KEY_PROVINCE=\"CA\"/export KEY_PROVINCE=\"" . $txtprovince . "\"/g' /etc/openvpn/easy-rsa/vars 2>&1 | sudo tee -a /var/log/raspberrywap.log");
		  shell_exec("sudo sed -i 's/export KEY_PROVINCE=\"CA\"/export KEY_PROVINCE=\"" . $txtprovince . "\"/g' /etc/openvpn/easy-rsa/vars 2>&1 | sudo tee -a /var/log/raspberrywap.log");
		  
		  logmessage("sudo sed -i 's/export KEY_CITY=\"SanFrancisco\"/export KEY_CITY=\"" . $txtcity . "\"/g' /etc/openvpn/easy-rsa/vars 2>&1 | sudo tee -a /var/log/raspberrywap.log");
		  shell_exec("sudo sed -i 's/export KEY_CITY=\"SanFrancisco\"/export KEY_CITY=\"" . $txtcity . "\"/g' /etc/openvpn/easy-rsa/vars 2>&1 | sudo tee -a /var/log/raspberrywap.log");
		  
		  logmessage("sudo sed -i 's/export KEY_ORG=\"Fort-Funston\"/export KEY_ORG=\"" . $txtorganisation . "\"/g' /etc/openvpn/easy-rsa/vars 2>&1 | sudo tee -a /var/log/raspberrywap.log");
		  shell_exec("sudo sed -i 's/export KEY_ORG=\"Fort-Funston\"/export KEY_ORG=\"" . $txtorganisation . "\"/g' /etc/openvpn/easy-rsa/vars 2>&1 | sudo tee -a /var/log/raspberrywap.log");
		  
		  logmessage("sudo sed -i 's/export KEY_EMAIL=\"me@myhost.mydomain\"/export KEY_EMAIL=\"" . $txtemail . "\"/g' /etc/openvpn/easy-rsa/vars 2>&1 | sudo tee -a /var/log/raspberrywap.log");
		  shell_exec("sudo sed -i 's/export KEY_EMAIL=\"me@myhost.mydomain\"/export KEY_EMAIL=\"" . $txtemail . "\"/g' /etc/openvpn/easy-rsa/vars 2>&1 | sudo tee -a /var/log/raspberrywap.log");
		  
		  logmessage("sudo sed -i 's/export KEY_EMAIL=mail@host.domain//g' /etc/openvpn/easy-rsa/vars 2>&1 | sudo tee -a /var/log/raspberrywap.log");
		  shell_exec("sudo sed -i 's/export KEY_EMAIL=mail@host.domain//g' /etc/openvpn/easy-rsa/vars 2>&1 | sudo tee -a /var/log/raspberrywap.log");
		  
		  logmessage("sudo sed -i 's/export KEY_CN=changeme/export KEY_CN=\"Raspberry Pi OpenVPN CA\"/g' /etc/openvpn/easy-rsa/vars 2>&1 | sudo tee -a /var/log/raspberrywap.log");
		  shell_exec("sudo sed -i 's/export KEY_CN=changeme/export KEY_CN=\"Raspberry Pi OpenVPN CA\"/g' /etc/openvpn/easy-rsa/vars 2>&1 | sudo tee -a /var/log/raspberrywap.log");
		  
		  logmessage("sudo sed -i 's/export KEY_NAME=changeme/export KEY_NAME=\"Raspberry Pi OpenVPN CA\"/g' /etc/openvpn/easy-rsa/vars 2>&1 | sudo tee -a /var/log/raspberrywap.log");
		  shell_exec("sudo sed -i 's/export KEY_NAME=changeme/export KEY_NAME=\"Raspberry Pi OpenVPN CA\"/g' /etc/openvpn/easy-rsa/vars 2>&1 | sudo tee -a /var/log/raspberrywap.log");
		  
		  logmessage("sudo sed -i 's/export KEY_OU=changeme/export KEY_OU=\"Raspberry Pi OpenVPN CA\"/g' /etc/openvpn/easy-rsa/vars 2>&1 | sudo tee -a /var/log/raspberrywap.log");
		  shell_exec("sudo sed -i 's/export KEY_OU=changeme/export KEY_OU=\"Raspberry Pi OpenVPN CA\"/g' /etc/openvpn/easy-rsa/vars 2>&1 | sudo tee -a /var/log/raspberrywap.log");
		  
		  logmessage("Generating Certificate Authority Private Key.");
		  echo '<script>ReturnStatusCa("Please wait ...  Generating Certificate Authority Private Key.");</script>';
		  flush();
		  shell_exec("sudo bash -c '(cd /etc/openvpn/easy-rsa && . ./vars && ./clean-all && ./pkitool --initca $*)' 2>&1 | sudo tee -a /var/log/raspberrywap.log");
		  shell_exec("sudo sed -i 's/export KEY_CN=\"Raspberry Pi OpenVPN CA\"/export KEY_CN=\"Raspberry Pi OpenVPN Server\"/g' /etc/openvpn/easy-rsa/vars 2>&1 | sudo tee -a /var/log/raspberrywap.log");
		  
		  // disable subject alternative names
		  shell_exec("sudo sed -i 's/subjectAltName=$ENV::KEY_ALTNAMES/# subjectAltName=$ENV::KEY_ALTNAMES/g' /etc/openvpn/easy-rsa/openssl-1.0.0.cnf 2>&1 | sudo tee -a /var/log/raspberrywap.log");
		  
		  logmessage("Generating Server Certificate.");
		  echo '<script>ReturnStatusCa("Please wait ...  Generating Server Certificate.");</script>';
		  flush();
		  shell_exec("sudo bash -c '(cd /etc/openvpn/easy-rsa && . ./vars && ./pkitool --server $*)' 2>&1 | sudo tee -a /var/log/raspberrywap.log");

		  logmessage("Generating Diffie Hellmann parameters.");
		  echo '<script>ReturnStatusCa("Please wait ...  Generating Diffie Hellman Parameters, this can take a while, so sit back and have a coffee :-)");</script>';
		  flush();
		  shell_exec("sudo bash -c '(cd /etc/openvpn/easy-rsa && . ./vars && ./build-dh)' 2>&1 | sudo tee -a /var/log/raspberrywap.log");
		  shell_exec("sudo service openvpn restart");
  		  echo '<script>document.getElementById("div_ca_init").style.display = "none";</script>';
		  echo '<script>document.getElementById("div_ca_reset").style.display = "inline";</script>';
		  echo '<script>document.getElementById("div_openvpn_newuser").style.display = "inline";</script>';
		  echo '<script>document.getElementById("div_openvpn_deleteuser").style.display = "inline";</script>';
		  $configurationsettings['certauth'] = "enabled";
		  logmessage("Writing Certificate Authority enabled state to config file: /home/pi/Raspberry-Wifi-Router/www/routersettings.ini");
		  write_php_ini($configurationsettings, "/home/pi/Raspberry-Wifi-Router/www/routersettings.ini");

		}
		else {
		  logmessage("Writing changes to configuration file: /home/pi/Raspberry-Wifi-Router/www/routersettings.ini");
		  echo "<script>ReturnStatusCa('" . $selectcryptoerr . "'+'" . $txtcountryerr . "'+'" . $txtprovinceerr . "'+'" . $txtcityerr . "'+'" . $txtorganisationerr . "'+'" . $txtemailerr . "');</script>";
		  flush();
		}
	  }
	?>
<!-- ********************************************************************************************************************** -->
	<?php
	  if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['btn_openvpn_newuser'])) {
		if(empty($openvpnservernameerr) && empty($txtusernameerr) && empty($txtfirstnameerr) && empty($txtlastnameerr) && empty($txtcountryerr) && empty($txtprovinceerr) && empty($txtcityerr) && empty($txtorganisationerr) && empty($txtemailerr)) {
		  if(!empty($openvpnservername) && !empty($txtusername) && !empty($txtfirstname) && !empty($txtlastname) && !empty($txtcountry) && !empty($txtprovince) && !empty($txtcity) && !empty($txtorganisation) && !empty($txtemail)) {
			  
			  logmessage("Generating Client certificate.");
			  echo '<script>ReturnStatus_openvpn_newuser("Generating Client Access Package.");</script>';
			  flush();
			  
			  logmessage("sudo bash -c '(cd /etc/openvpn/easy-rsa && . ./vars && export KEY_COUNTRY=\"" . $txtcountry . "\"  && export KEY_PROVINCE=\"" . $txtprovince . "\"  && export KEY_CITY=\"" . $txtcity . "\"  && export KEY_ORG=\"" . $txtorganisation . "\" && export KEY_EMAIL=\"" . $txtemail . "\" && export KEY_CN=\"" . $txtusername . "\" && ./pkitool $*)' 2>&1 | sudo tee -a /var/log/raspberrywap.log");
			  
			  shell_exec("sudo bash -c '(cd /etc/openvpn/easy-rsa && . ./vars && export KEY_COUNTRY=\"" . $txtcountry . "\"  && export KEY_PROVINCE=\"" . $txtprovince . "\"  && export KEY_CITY=\"" . $txtcity . "\"  && export KEY_ORG=\"" . $txtorganisation . "\" && export KEY_EMAIL=\"" . $txtemail . "\" && export KEY_CN=\"" . $txtusername . "\" && ./pkitool $*)' 2>&1 | sudo tee -a /var/log/raspberrywap.log");
			  
  			  logmessage("Fetching ovpn profile template.");
			  shell_exec("sudo cp -v /usr/share/doc/openvpn/examples/sample-config-files/client.conf /tmp/" . $txtusername . ".ovpn 2>&1 | sudo tee -a /var/log/raspberrywap.log");

  			  logmessage("Modifying client certificate file name on the ovpn template.");
			  shell_exec("sudo sed -i 's/client.crt/remote " . $openvpnservername ." 1194/g' /tmp/" . $txtusername . ".ovpn 2>&1 | sudo tee -a /var/log/raspberrywap.log");
  			  
  			  logmessage("Modifying servername or ip address on the ovpn template.");
			  shell_exec("sudo sed -i 's/remote my-server-1 1194/remote " . $openvpnservername ." 1194/g' /tmp/" . $txtusername . ".ovpn 2>&1 | sudo tee -a /var/log/raspberrywap.log");

  			  logmessage("Modifying server certificate file name on the ovpn template.");
			  shell_exec("sudo sed -i 's/cert remote/cert " . $txtusername . ".crt/g' /tmp/" . $txtusername . ".ovpn 2>&1 | sudo tee -a /var/log/raspberrywap.log");

  			  logmessage("Modifying private key file name on the ovpn template.");
			  shell_exec("sudo sed -i 's/key client.key/key " . $txtusername . ".key/g' /tmp/" . $txtusername . ".ovpn 2>&1 | sudo tee -a /var/log/raspberrywap.log");

  			  logmessage("Zipping all files as client package.");
			  shell_exec("sudo zip -j /var/www" . $txtpackageurl . " /tmp/" . $txtusername . ".ovpn /etc/openvpn/easy-rsa/keys/ca.crt /etc/openvpn/easy-rsa/keys/" . $txtusername . ".crt /etc/openvpn/easy-rsa/keys/" . $txtusername . ".key 2>&1 | sudo tee -a /var/log/raspberrywap.log");
			  
			  echo '<script>ReturnStatus_openvpn_newuser("Openvpn user created.");</script>';
			  flush();

		  }
		  else {
			  logmessage("Certificate generation failed, because one of the fields is not filled in.");
			  echo '<script>ReturnStatus_openvpn_newuser("All fields are required!");</script>';
		  }
		}
		else {
		  echo "error error!!!";
		  echo '<script>ReturnStatusNewCertificate("' . $txtusernameerr . $txtfirstnameerr . $txtlastnameerr . $txtcountryerr . $txtcityerr . $txtprovinceerr . $txtorganisationerr . $txtemailerr . '");</script>';
		}
	  }
	?>
<!-- ********************************************************************************************************************** -->
	<?php
	  if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['btn_ca_reset'])) {
		flush();
		logmessage("Removing easy-rsa folder /etc/openvpn/easy-rsa");
		shell_exec("sudo rm -rfv /etc/openvpn/easy-rsa 2>&1 | sudo tee -a /var/log/raspberrywap.log");
		logmessage("Removing any generated openvpn client packages /var/www/temp/OpenVPN_ClientPackages/*");
		shell_exec("sudo rm -fv /var/www/temp/OpenVPN_ClientPackages/* 2>&1 | sudo tee -a /var/log/raspberrywap.log");
		logmessage("Removing Temp files.");
		shell_exec("sudo rm -fv /tmp/* 2>&1 | sudo tee -a /var/log/raspberrywap.log");
		logmessage("Purging openvpn user database.");
		shell_exec("sudo echo 'truncate openvpnusers' | mysql --host=localhost --user=root --password=raspberry --database login 2>&1 | sudo tee -a /var/log/raspberrywap.log");
	  }
	?>   	

<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>
