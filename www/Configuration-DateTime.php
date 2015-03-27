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
function ReturnProgressTimezone() {
    document.getElementById('ReturnStatusTimezone').innerHTML = '<img src="images/ProgressIndicator.GIF" width="100" height="15"  alt="">';
}
function ReturnReadyTimezone() {
    document.getElementById('ReturnStatusTimezone').innerHTML = '<img src="images/Ready.png" width="20" height="20"  alt="">';
}
function ReturnProgressTimesync() {
    document.getElementById('ReturnStatusTimesync').innerHTML = '<img src="images/ProgressIndicator.GIF" width="100" height="15"  alt="">';
}
function ReturnReadyTimesync() {
    document.getElementById('ReturnStatusTimesync').innerHTML = '<img src="images/Ready.png" width="20" height="20"  alt="">';
}
function ReturnFailure(error) {
    document.getElementById("ReturnStatusTimesync").innerHTML = "There was a problem saving your details: " + error;
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
<!-- ********************************************************************************************************************** -->
  <?php date_default_timezone_set(trim(file_get_contents("/etc/timezone"),"\n"));
  		$configurationsettings = parse_ini_file("/var/www/routersettings.ini");
  ?>
<!-- ********************************************************************************************************************** -->
  <?php
	if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['buttontimezone'])) {
	file_put_contents("/etc/timezone", $_POST["selecttimezone"]);
	}
  ?>
<!-- ********************************************************************************************************************** -->
  <?php
	if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['buttontimesync'])) {
	$timeserver1 = $timeserver2 = $timeserver3 = $timeserver4 = "";
	$timeserver1err = $timeserver2err = $timeserver3err = $timeserver4err = "";
	// uitlezen en valideren van formulier
	if (!empty($_POST["timeserver1"])) {
		$timeserver1 = test_input($_POST["timeserver1"]);
		if (!preg_match("/^[0-9a-zA-Z.]*$/",$timeserver1)) {
		  $timeserver1err = "Time Server 1: Only letters, numbers and . allowed!<br />"; 
		}
	  }
	if (!empty($_POST["timeserver2"])) {
		$timeserver2 = test_input($_POST["timeserver2"]);
		if (!preg_match("/^[0-9a-zA-Z.]*$/",$timeserver2)) {
		  $timeserver2err = "Time Server 2: Only letters, numbers and . allowed!<br />"; 
		}
	  }
	if (!empty($_POST["timeserver3"])) {
		$timeserver3 = test_input($_POST["timeserver3"]);
		if (!preg_match("/^[0-9a-zA-Z.]*$/",$timeserver3)) {
		  $timeserver3err = "Time Server 3: Only letters, numbers and . allowed!<br />"; 
		}
	  }
	if (!empty($_POST["timeserver4"])) {
		$timeserver4 = test_input($_POST["timeserver4"]);
		if (!preg_match("/^[0-9a-zA-Z.]*$/",$timeserver4)) {
		  $timeserver4err = "Time Server 4: Only letters, numbers and . allowed!<br />"; 
		}
	  }
	// if the form was validated ok execute the rest
	if (empty($timeserver1err) && empty($timeserver2err) && empty($timeserver3err) && empty($timeserver4err)) {
		if 	(array_key_exists ("timesync_checkbox" , $_POST))
		  $configurationsettings['ntpclient'] = "enabled";
		else
		  $configurationsettings['ntpclient'] = "disabled";
		$splice = 0;
		$insertservers = array();
		$strconfigfile = "/etc/ntp.conf";
		$arrconfigfilecontents = file($strconfigfile);
		$arrconfigfilefiltered = preg_grep("/^server/",$arrconfigfilecontents);
		$splice = count($arrconfigfilefiltered);
		array_splice($arrconfigfilecontents,20,$splice,$insertservers);
		if(!empty($timeserver1)) {
			array_push($insertservers,"server $timeserver1 iburst\n");
		}
		if(!empty($timeserver2)) {
			array_push($insertservers,"server $timeserver2 iburst\n");
		}
		if(!empty($timeserver3)) {
			array_push($insertservers,"server $timeserver3 iburst\n");
		}
		if(!empty($timeserver4)) {
			array_push($insertservers,"server $timeserver4 iburst\n");
		}
		array_splice($arrconfigfilecontents,20,0,$insertservers);
		file_put_contents("/etc/ntp.conf", implode($arrconfigfilecontents));
		write_php_ini($configurationsettings, "/var/www/routersettings.ini");

	}
  }
  ?>
            
  <?php
	$strconfigfile = "/etc/ntp.conf";
	$arrconfigfilecontents = file($strconfigfile);
	$arrconfigfilefiltered = preg_grep("/^server/",$arrconfigfilecontents);
	$arrconfigfilefiltered = (str_replace("server " , "" , $arrconfigfilefiltered));
	$arrconfigfilefiltered = (str_replace("iburst" , "" , $arrconfigfilefiltered));
  ?>
	

  <div id="ContentTitle">
  <span>Date/Time</span>
  </div>
  
  <div id="ContentArticle">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="application/x-www-form-urlencoded" id="formtimezone">
      <fieldset><legend>Timezone Configuration</legend>
        <table width="100%" border="0">
          <tr>
            <td width="40%" align="right">Select your Time Zone:</td>
            <td width="60%">

              <select name="selecttimezone" autofocus id="selecttimezone" form="formtimezone">
              
			  <?php
              $timezones = timezone_identifiers_list();
			  $systemtimezone = trim(file_get_contents("/etc/timezone"),"\n");
			  
			  foreach($timezones as $timezone)
			  {
				if (($systemtimezone == $timezone) || ($systemtimezone == "Etc/UTC")) {
				  echo '<option selected="selected" value="' . $timezone . '">' . $timezone . '</option>';
				}
				else {
				  echo '<option value="' . $timezone . '">' . $timezone . '</option>';
				}
			  }
              ?>
              
              </select>
		    </td>
          </tr>
          <tr>
            <td align="right"><input name="buttontimezone" type="submit" id="buttontimezone" form="formtimezone" value="Apply"></td>
            <td><span id="ReturnStatusTimezone"></span></td>
          </tr>
        </table>
      </fieldset>
    </form>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="application/x-www-form-urlencoded" id="formtimesync">
      <fieldset><legend>Time Synchronisation</legend>
        <table width="100%" border="0">
          <tr>
            <td width="40%" align="right">Enable time Sync:</td>
            <td width="60%"><input name="timesync_checkbox" type="checkbox" id="timesync_checkbox" form="formtimesync" value="on" <?php if ($configurationsettings['ntpclient'] == "enabled") {echo "checked";}?>></td>
          </tr>
          <tr>
            <td align="right">Time Server 1:</td>
            <td><input name="timeserver1" type="text" id="timeserver1" form="formtimesync" placeholder="0.pool.ntp.org" pattern="^[0-9a-zA-Z.]*$" value="<?php echo rtrim(array_shift(array_slice($arrconfigfilefiltered, 0, 1)));?>"></td>
          </tr>
          <tr>
            <td align="right">Time Server 2:</td>
            <td><input name="timeserver2" type="text" id="timeserver2" form="formtimesync" placeholder="1.pool.ntp.org" pattern="^[0-9a-zA-Z.]*$" value="<?php echo rtrim(array_shift(array_slice($arrconfigfilefiltered, 1, 1)));?>"></td>
          </tr>
          <tr>
            <td align="right">Time Server 3:</td>
            <td><input name="timeserver3" type="text" id="timeserver3" form="formtimesync" placeholder="2.pool.ntp.org" pattern="^[0-9a-zA-Z.]*$" value="<?php echo rtrim(array_shift(array_slice($arrconfigfilefiltered, 2, 1)));?>"></td>
          </tr>
          <tr>
            <td align="right">Time Server 4:</td>
            <td><input name="timeserver4" type="text" id="timeserver3" form="formtimesync" placeholder="3.pool.ntp.org" pattern="^[0-9a-zA-Z.]*$" value="<?php echo rtrim(array_shift(array_slice($arrconfigfilefiltered, 3, 1)));?>"></td>
          </tr>

          <tr>
            <td align="right"><input name="buttontimesync" type="submit" id="buttontimesync" form="formtimesync" value="Apply"></td>
            <td><span id="ReturnStatusTimesync"></span></td>
          </tr>
        </table>
      </fieldset>
    </form>
  </div><!-- end div contentarticle -->


<?php
  if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['buttontimesync'])) {
	if (!empty($timeserver1err) || !empty($timeserver2err) || !empty($timeserver3err) || !empty($timeserver4err)) {
	  echo "<script>ReturnFailureDynamic('" . $timeserver1err . "'+'" . $timeserver2err . "'+'" . $timeserver3err . "'+'" . $timeserver4err . "');</script>";
	}
  }
?>


  <!-- InstanceEndEditable -->
  </article><!-- end .content -->


  <aside>
  <!-- InstanceBeginEditable name="aside" -->
  <div id="aside">
  <p>Note: values in light grey are recommended values but have no configuration effect on the router.</p>
  
  
  
  
  </div>
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
  <?php
	if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['buttontimezone'])) {
	  echo "<script>ReturnProgressTimezone();</script>";
	  flush();
	  shell_exec("sudo dpkg-reconfigure -f noninteractive tzdata");
	  echo "<script>ReturnReadyTimezone();</script>";
	}
  ?>
<!-- ********************************************************************************************************************** -->
  <?php
	if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['buttontimesync'])) {
	  if (empty($timeserver1err) && empty($timeserver2err) && empty($timeserver3err) && empty($timeserver4err)) {
		echo "<script>ReturnProgressTimesync();</script>";
		flush();
		if 	(array_key_exists ("timesync_checkbox" , $_POST)) {
			shell_exec("sudo /etc/init.d/ntp force-reload");
			shell_exec("sudo update-rc.d ntp defaults");
		}
		else {
			shell_exec("sudo /etc/init.d/ntp stop");
			shell_exec("sudo update-rc.d -f ntp remove");
		}
		echo "<script>ReturnReadyTimesync();</script>";
	  }
	}
  ?>
<!-- ********************************************************************************************************************** -->
<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>
