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
         <li class='has-sub' id="Logs"><a href='#'><span>Logs</span></a>
            <ul id="LogsUl">
               <li><a href='Logs-Dmesg.php'><span>Dmesg</span></a></li>
               <li><a href='Logs-Hostapd.php'><span>Hostapd</span></a></li>
               <li class='last'><a href='Logs-DhcpClientList.php'><span>DHCP Client List</span></a></li>
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
				update_interfaces_file("Router");
				$configurationsettings['operationmode'] = "Router";
				write_php_ini($configurationsettings, "/var/www/routersettings.ini");
				
				shell_exec("sudo /sbin/ifdown eth0");
				shell_exec("sudo /sbin/ifdown wlan0");
				shell_exec("sudo /sbin/brctl delif br0 eth0");
				shell_exec("sudo /sbin/brctl delif br0 wlan0");
				shell_exec("sudo /sbin/ifdown br0");
				shell_exec("sudo /sbin/ifconfig br0 down");
				shell_exec("sudo /sbin/brctl delbr br0");
				shell_exec("sudo /etc/init.d/networking restart");
				shell_exec("sudo /etc/init.d/hostapd restart");
				echo "<script>$('#functionstat').text('Router');</script>";
				echo "<script>$('#selectopsmode').val('Access Point');</script>";
			}
			if(strcmp($opsmode,'Access Point') == 0) {
				update_interfaces_file("Access Point");
				$configurationsettings['operationmode'] = "Access Point";
				write_php_ini($configurationsettings, "/var/www/routersettings.ini");
				
				shell_exec("sudo /etc/init.d/networking restart");
				shell_exec("sudo /etc/init.d/hostapd restart");
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
