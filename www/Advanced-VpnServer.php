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
function ReturnProgressCa() {
    document.getElementById('ca_indicator').innerHTML = '<img src="images/ProgressIndicator.GIF" width="100" height="15"  alt="">';
}
function ReturnReadyCa() {
    document.getElementById('ca_indicator').innerHTML = '<img src="images/Ready.png" width="20" height="20"  alt="">';
}
function ReturnStatusCa(message) {
    document.getElementById('ca_status').innerHTML = message;
}
</script>
<?php include 'functions.php';?>
<?php logmessage("Loading page Advanced-VpnServer.php");?>
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
	<?php   	
      $configurationsettings = parse_ini_file("/var/www/routersettings.ini");
	  
	  if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['init_ca'])) {

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
		  if (!preg_match("/^[a-zA-Z0-9_-]*$/",$txtcountry)) {
			$txtcountryerr = "Country field contains incorrect data, only a-zA-Z0-9_- allowed!<br />"; 
		  }
		}
		
		if (!empty($_POST["txtprovince"])) {
		  $txtprovince = test_input($_POST["txtprovince"]);
		  if (!preg_match("/^[a-zA-Z0-9_-]*$/",$txtprovince)) {
			$txtprovinceerr = "Province field contains incorrect data, only a-zA-Z0-9_- allowed!<br />"; 
		  }
		}
  
		if (!empty($_POST["txtcity"])) {
		  $txtcity = test_input($_POST["txtcity"]);
		  if (!preg_match("/^[a-zA-Z0-9_-]*$/",$txtcity)) {
			$txtcityerr = "City field contains incorrect data, only a-zA-Z0-9_- allowed!<br />"; 
		  }
		}
  
		if (!empty($_POST["txtorganisation"])) {
		  $txtorganisation = test_input($_POST["txtorganisation"]);
		  if (!preg_match("/^[a-zA-Z0-9_-]*$/",$txtorganisation)) {
			$txtorganisationerr = "Organisation field contains incorrect data, only a-zA-Z0-9_- allowed!<br />"; 
		  }
		}
  
		if (!empty($_POST["txtemail"])) {
		  $txtemail = test_input($_POST["txtemail"]);
		  if (!preg_match("/^[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/",$txtemail)) {
			$txtemailerr = "Email field contains incorrect data, only a-zA-Z0-9_- allowed!<br />"; 
		  }
		}
	  }
	?>
<!-- ********************************************************************************************************************** -->

  <div id="ContentTitle">
    <span>Vpn Server</span>
  </div>
  
  <div id="ContentArticle">
    <div id="uninitialised">
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
              <td colspan="2" align="center">Beware when choosing the Cryptographic Strength for this Certificate Authority, the higher u choose, the slower this will run on the Raspberry Pi</td>
              </tr>
            <tr>
              <td width="40%" align="right"><label for="selectcrypto">Cryptographic strength:</label></td>
              <td width="60%"><select name="selectcrypto" autofocus id="selectcrypto" form="frm_ca_init" tabindex="1">
                <option value="1024">1024 bit - ok, default security</option>
                <option value="2048">2048 bit - if you're beïng paranoid</option>
                <option value="4096" selected="selected">4096 bit - protection against Nsa</option>
              </select></td>
            </tr>
            <tr>
              <td align="right"><label for="txtcountry">Country:</label></td>
              <td><input name="txtcountry" type="text" required id="txtcountry" form="frm_ca_init" placeholder="Belgium" pattern="^[a-zA-Z0-9_-]*$"></td>
            </tr>
            <tr>
              <td align="right"><label for="txtprovince">Province:</label></td>
              <td><input name="txtprovince" type="text" required id="txtprovince" form="frm_ca_init" placeholder="East-Flanders" pattern="^[a-zA-Z0-9_-]*$"></td>
            </tr>
            <tr>
              <td align="right"><label for="txtcity">City:</label></td>
              <td><input name="txtcity" type="text" required id="txtcity" form="frm_ca_init" placeholder="Hamme" pattern="^[a-zA-Z0-9_-]*$"></td>
            </tr>
            <tr>
              <td align="right"><label for="txtorganisation">Organisation:</label></td>
              <td><input name="txtorganisation" type="text" required id="txtorganisation" form="frm_ca_init" placeholder="none-private individual" pattern="^[a-zA-Z0-9_-]*$"></td>
            </tr>
            <tr>
              <td align="right"><label for="txtemail">Email:</label></td>
              <td><input name="txtemail" type="text" required id="txtemail" form="frm_ca_init" placeholder="my-email@somedomain.com" pattern="^[a-z0-9!#$%&amp;'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&amp;'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?"></td>
            </tr>
            <tr>
              <td align="center">&nbsp;</td>
              <td><input name="init_ca" type="submit" id="init_ca" form="frm_uninit" value="Initialize Certificate Authority"></td>
            </tr>
            <tr>
              <td align="center">&nbsp;</td>
              <td><span id="ca_indicator"></span></td>
            </tr>
            <tr>
              <td align="center">&nbsp;</td>
              <td id="ca_status">&nbsp;</td>
            </tr>
          </table>
        </fieldset>
      </form>
    </div><!-- end div uninitialised -->
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
	<?php
      
	  if(empty($selectcryptoerr) && empty($txtcountryerr) && empty($txtprovinceerr) && empty($txtcityerr) && empty($txtorganisationerr) && empty($txtemailerr)) {
		echo "<script>ReturnProgressCa();</script>";
		echo "<script>ReturnStatusCa('Starting Certificate Authority Initialisation');</script>";
		flush();
		shell_exec("sudo mkdir /etc/openvpn/easy-rsa");
		shell_exec("sudo cp -R /usr/share/doc/openvpn/examples/easy-rsa/2.0/* /etc/openvpn/easy-rsa");
		
		shell_exec("sed -i 's/export KEY_SIZE=1024/export KEY_SIZE=" . $selectcrypto . "/g' /etc/openvpn/easy-rsa/vars");
		
		shell_exec("sudo sed -i 's/export KEY_COUNTRY=\"US\"/export KEY_COUNTRY=\"" . $txtcountry . "\"/g' /etc/openvpn/easy-rsa/vars");
		shell_exec("sudo sed -i 's/export KEY_PROVINCE=\"CA\"/export KEY_PROVINCE=\"" . $txtprovince . "\"/g' /etc/openvpn/easy-rsa/vars");
		shell_exec("sudo sed -i 's/export KEY_CITY=\"SanFrancisco\"/export KEY_CITY=\"" . $txtcity . "\"/g' /etc/openvpn/easy-rsa/vars");
		shell_exec("sudo sed -i 's/export KEY_ORG=\"Fort-Funston\"/export KEY_ORG=\"" . $txtorganisation . "\"/g' /etc/openvpn/easy-rsa/vars");
		shell_exec("sudo sed -i 's/export KEY_EMAIL=\"me@myhost.mydomain\"/export KEY_EMAIL=\"" . $txtemail . "\"/g' /etc/openvpn/easy-rsa/vars");
		shell_exec("sudo sed -i 's/export KEY_EMAIL=mail@host.domain//g' /etc/openvpn/easy-rsa/vars");
		shell_exec("sudo sed -i 's/export KEY_CN=changeme/export KEY_CN=Raspberry Pi OpenVPN CA/g' /etc/openvpn/easy-rsa/vars");
		shell_exec("sudo sed -i 's/export KEY_NAME=changeme/export KEY_NAME=Raspberry Pi OpenVPN CA/g' /etc/openvpn/easy-rsa/vars");
		shell_exec("sudo sed -i 's/export KEY_OU=changeme/export KEY_OU=Raspberry Pi OpenVPN CA/g' /etc/openvpn/easy-rsa/vars");
		
		shell_exec("source /etc/openvpn/easy-rsa/vars && sudo /etc/openvpn/easy-rsa/clean-all && sudo /etc/openvpn/easy-rsa/build-ca");

	  }
	  
	  else {
  		echo "<script>ReturnStatusCa('" . $selectcryptoerr . "'+'" . $txtcountryerr . "'+'" . $txtprovinceerr . "'+'" . $txtcityerr . "'+'" . $txtorganisationerr . "'+'" . $txtemailerr . "');</script>";
	  }

		  
	?>





<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>
