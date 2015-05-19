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
              <td width="40%" align="right"><label for="cryptoselect">Cryptographic strength:</label></td>
              <td width="60%"><select name="cryptoselect" autofocus id="cryptoselect" form="frm_ca_init" tabindex="1">
                <option value="1024">1024 bit - ok, default security</option>
                <option value="2048">2048 bit - if you're beïng paranoid</option>
                <option value="4096">4096 bit - protection against Nsa</option>
              </select></td>
            </tr>
            <tr>
              <td align="right"><label for="txtcountry">Country:</label></td>
              <td><input name="txtcountry" type="text" id="txtcountry" form="frm_ca_init" placeholder="Belgium"></td>
            </tr>
            <tr>
              <td align="right"><label for="txtprovince">Province:</label></td>
              <td><input name="txtprovince" type="text" id="txtprovince" form="frm_ca_init" placeholder="East-Flanders"></td>
            </tr>
            <tr>
              <td align="right"><label for="txtcity">City:</label></td>
              <td><input name="txtcity" type="text" id="txtcity" form="frm_ca_init" placeholder="Hamme"></td>
            </tr>
            <tr>
              <td align="right"><label for="txtorganisation">Organisation:</label></td>
              <td><input name="txtorganisation" type="text" id="txtorganisation" form="frm_ca_init" placeholder="none-private individual"></td>
            </tr>
            <tr>
              <td align="right"><label for="txtemail">Email:</label></td>
              <td><input name="txtemail" type="text" id="txtemail" form="frm_ca_init" placeholder="my-email@somedomain.com"></td>
            </tr>
            <tr>
              <td align="center">&nbsp;</td>
              <td><input name="init_ca" type="submit" id="init_ca" form="frm_uninit" value="Initialize Certificate Authority"></td>
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






<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>
