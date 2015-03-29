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
$(document).ready(function(){
   $('#Home').removeClass('active');
   $('#Advanced').addClass('active');
	$('#AdvancedUl').show();
});
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
  
  <!-- InstanceEndEditable -->
  
  <article class="content">
    <!-- InstanceBeginEditable name="article" -->
  <!-- ********************************************************************************************************************** -->
    <div id="ContentTitle"><span>Advanced Wireless</span></div>
    
    <div id="ContentArticle">


    <fieldset><legend>AP netdevice name</legend>
      <table width="100%" border="0">
        <tr>
          <td colspan="2" align="center">(without 'ap' postfix, i.e., wlan0 uses wlan0ap for management frames with the Host AP driver); wlan0 with many nl80211 drivers
          </td>
        </tr>
        <tr>
          <td width="40%" align="right"><label for="wlanname">Wireless adapter name:</label></td>
          <td width="60%"><input name="wlanname" type="text" id="wlanname" placeholder="wlan0"></td>
        </tr>
      </table>
    </fieldset>


    <fieldset><legend>Driver interface type</legend>
      <table width="100%" border="0">
        <tr>
          <td colspan="2" align="center"> (hostap/wired/none/nl80211/bsd); default: hostap). nl80211 is used with all Linux mac80211 drivers.  Use driver=none if building hostapd as a standalone RADIUS server that does not control any wireless/wired driver.</td>
        </tr>
        <tr>
          <td width="40%" align="right"><label for="select">Driver interface type:</label></td>
          <td width="60%"> 
            <select name="select" id="select">
              <option value="hostap">hostap</option>
              <option value="nl80211">nl80211</option>
              <option value="wired">wired</option>
              <option value="none">none</option>
              <option value="bsd">bsd</option>
            </select>
          </td>
        </tr>
      </table>
    </fieldset>


    <fieldset><legend>Driver interface parameters</legend>
      <table width="100%" border="0">
        <tr>
          <td colspan="2" align="center">(mainly for development and testing use)</td>
        </tr>
        <tr>
          <td width="40%" align="right"><label for="textfield2">Driver parameters:</label></td>
          <td width="60%"><input type="text" name="textfield2" id="textfield2"></td>
        </tr>
      </table>
    </fieldset>
  
        
    <fieldset><legend>Log modules</legend>
      <table width="100%" border="0">
        <tr>
          <td width="40%" align="right"><label for="select2">Log modules:</label></td>
          <td width="60%">      
            <select name="select2" id="select2">
              <option value="-1">All</option>
              <option value="1">IEEE 802.11</option>
              <option value="2">IEEE 802.1X</option>
              <option value="4">RADIUS</option>
              <option value="8">WPA</option>
              <option value="16">driver interface</option>
              <option value="32">IAPP</option>
              <option value="64">MLME</option>
            </select>
          </td>
        </tr>
      </table>
    </fieldset>
  

    <fieldset><legend>Log level</legend>
      <table width="100%" border="0">
        <tr>
          <td width="40%" align="right"><label for="select3">Log level:</label></td>
          <td width="60%"><select name="select3" id="select3">
            <option value="0">verbose debugging</option>
            <option value="1">debugging</option>
            <option value="2">informational messages</option>
            <option value="3">notification</option>
            <option value="4">warning</option>
          </select></td>
        </tr>
      </table>
    </fieldset>
      
        
    <fieldset><legend>UTF-8 SSID</legend>
      <table width="100%" border="0">
        <tr>
          <td colspan="2" align="center">Whether the SSID is to be interpreted using UTF-8 encoding</td>
        </tr>
        <tr>
          <td width="40%" align="right"><label for="checkbox">UTF8 SSID:</label></td>
          <td width="60%"><input type="checkbox" name="checkbox" id="checkbox"></td>
        </tr>
      </table>
    </fieldset>
        
        
    <fieldset><legend>Country code</legend>
      <table width="100%" border="0">
        <tr>
          <td colspan="2" align="center">(ISO/IEC 3166-1). Used to set regulatory domain.  Set as needed to indicate country in which device is operating.  This can limit available channels and transmit power.</td>
        </tr>
        <tr>
          <td width="40%" align="right"><label for="select4">Country code:</label></td>
          <td width="60%"><select name="select4" id="select4"></select></td>
        </tr>
      </table>
    </fieldset>
        

    <fieldset><legend>Enable IEEE 802.11d</legend>
      <table width="100%" border="0">
        <tr>
          <td colspan="2" align="center">This advertises the country_code and the set of allowed channels and transmit power levels based on the regulatory limits. The country_code setting must be configured with the correct country for IEEE 802.11d functions.</td>
        </tr>
        <tr>
          <td width="40%" align="right"><label for="checkbox2">Enable IEEE 802.11d:</label></td>
          <td width="60%"><input type="checkbox" name="checkbox2" id="checkbox2"></td>
        </tr>
      </table>
    </fieldset>


    <fieldset><legend>Enable IEEE 802.11h</legend>
      <table width="100%" border="0">
        <tr>
          <td colspan="2" align="center">This enables radar detection and DFS support if available. DFS support is required on outdoor 5 GHz channels in most countries of the world. This can be used only when ieee80211d is enabled.</td>
        </tr>
        <tr>
          <td width="40%" align="right"><label for="checkbox3">Enable IEEE 802.11h:</label></td>
          <td width="60%"><input type="checkbox" name="checkbox3" id="checkbox3">  </td>
        </tr>
      </table>
    </fieldset>
        
        
    <fieldset><legend>Local Power Constraint</legend>
      <table width="100%" border="0">
        <tr>
          <td colspan="2" align="center">Add Power Constraint element to Beacon and Probe Response frames.  This config option adds Power Constraint element when applicable and Country element is added. Power Constraint element is required by Transmit Power Control. This can be used only when ieee80211d is enabled.  Valid values are 0 until 255.</td>
        </tr>
        <tr>
          <td width="40%" align="right"><label for="number">Local power constraint:</label></td>
          <td width="60%"><input name="number" type="number" id="number" max="255" min="0" step="1"></td>
        </tr>
      </table>
    </fieldset>
        

    <fieldset><legend>Spectrum management required</legend>
      <table width="100%" border="0">
        <tr>
          <td colspan="2" align="center">Set Spectrum Management subfield in the Capability Information field.  This config option forces the Spectrum Management bit to be set. When this option is not set, the value of the Spectrum Management bit depends on whether DFS or TPC is required by regulatory authorities. This can be used only when ieee80211d and local power contraint are enabled.</td>
        </tr>
        <tr>
          <td width="40%" align="right"><label for="checkbox4">Spectrum management required:</label></td>
          <td width="60%"><input type="checkbox" name="checkbox4" id="checkbox4"></td>
        </tr>
      </table>
    </fieldset>


    <fieldset><legend>Operation mode</legend>
      <table width="100%" border="0">
        <tr>
          <td colspan="2" align="center">(a = IEEE 802.11a, b = IEEE 802.11b, g = IEEE 802.11g, ad = IEEE 802.11ad (60 GHz); a/g options are used with IEEE 802.11n, too, to specify band) Default: IEEE 802.11b.  When configured will override common settings.</td>
        </tr>
        <tr>
          <td width="40%" align="right"><label for="select5">Operation mode:</label></td>
          <td width="60%">
            <select name="select5" id="select5">
              <option value="unconfigured">unconfigured</option>
              <option value="a">IEEE 802.11a</option>
              <option value="b">IEEE 802.11b</option>
              <option value="g">IEEE 802.11g</option>
              <option value="ad">IEEE 802.11ad (60 GHz)</option>
            </select>
          </td>
        </tr>
      </table>
    </fieldset>
  

    <fieldset><legend>Channel number (IEEE 802.11)</legend>
      <table width="100%" border="0">
        <tr>
          <td colspan="2" align="center">(default: 0, i.e., not set)  Please note that some drivers do not use this value from hostapd and the channel will need to be configured separately with iwconfig.  If CONFIG_ACS build option is enabled, the channel can be selected automatically at run time by setting channel=acs_survey or channel=0, both of which will enable the ACS survey based algorithm.</td>
        </tr>
        <tr>
          <td width="40%" align="right"><label for="select6">Channel number:</label></td>
          <td width="60%">
            <select name="select6" id="select6">
              <option value="unconfigured">unconfigured</option>
              <option value="acs_survey">acs_survey</option>
              <option value="0">0</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6">6</option>
              <option value="7">7</option>
              <option value="8">8</option>
              <option value="9">9</option>
              <option value="10">10</option>
              <option value="11">11</option>
              <option value="12">12</option>
              <option value="13">13</option>
              <option value="14">14</option>
            </select>
          </td>
        </tr>
      </table>
    </fieldset>
        

    <fieldset><legend>ACS tuning - Automatic Channel Selection</legend>
      <table width="100%" border="0">
        <tr>
          <td colspan="2" align="center">See: http://wireless.kernel.org/en/users/Documentation/acs<br>You can customize the ACS survey algorithm with following variables:<br>acs_num_scans requirement is 1..100 - number of scans to be performed that are used to trigger survey data gathering of an underlying device driver.  Scans are passive and typically take a little over 100ms (depending on the driver) on each available channel for given hw_mode. Increasing this value means sacrificing startup time and gathering more data wrt channel interference that may help choosing a better channel. This can also help fine tune the ACS scan time in case a driver has different scan dwell times.</td>
        </tr>
        <tr>
          <td width="40%" align="right"><label for="number2">acs_num_scans:</label></td>
          <td width="60%"><input type="number" name="number2" id="number2"></td>
        </tr>
      </table>
    </fieldset>
  
  
    <fieldset><legend>Channel list restriction</legend>
      <table width="100%" border="0">
        <tr>
          <td colspan="2" align="center">This option allows hostapd to select one of the provided channels when a channel should be automatically selected.  Default: not set (allow any enabled channel to be selected) chanlist=100 104 108 112 116</td>
        </tr>
        <tr>
          <td width="40%" align="right"><label for="textfield">Channel list:</label></td>
          <td width="60%"><input type="text" name="textfield" id="textfield"></td>
        </tr>
      </table>
    </fieldset>


    <fieldset><legend>Beacon interval</legend>
      <table width="100%" border="0">
        <tr>
          <td colspan="2" align="center">Beacon interval in kus (1.024 ms) (default: 100; range 15..65535)</td>
        </tr>
        <tr>
          <td width="40%" align="right"><label for="range">Beacon interval:</label></td>
          <td width="60%"><input name="range" type="range" id="range" max="65535" min="15"></td>
        </tr>
      </table>
    </fieldset>

       
    <fieldset><legend>DTIM (delivery traffic information message)</legend>
      <table width="100%" border="0">
        <tr>
          <td colspan="2" align="center">period (range 1..255): number of beacons between DTIMs (1 = every beacon includes DTIM element) (default: 2)</td>
        </tr>
        <tr>
          <td width="40%" align="right"><label for="range2">DTIM period:</label></td>
          <td width="60%"><input name="range2" type="range" id="range2" max="255" min="1" step="1"></td>
        </tr>
      </table>
    </fieldset>
        
        
    <fieldset><legend>Maximum stations</legend>
      <table width="100%" border="0">
        <tr>
          <td colspan="2" align="center">Maximum number of stations allowed in station table. New stations will be rejected after the station table is full. IEEE 802.11 has a limit of 2007 different association IDs, so this number should not be larger than that.  (default: 2007)</td>
        </tr>
        <tr>
          <td width="40%" align="right"><label for="number3">Maximum number stations:</label></td>
          <td width="60%"><input type="number" name="number3" id="number3"></td>
        </tr>
      </table>
    </fieldset>
        

    <fieldset><legend>RTS/CTS threshold</legend>
      <table width="100%" border="0">
        <tr>
          <td colspan="2" align="center">2347 = disabled (default); range 0..2347  If this field is not included in hostapd.conf, hostapd will not control RTS threshold and 'iwconfig wlan# rts &lt;val&gt;' can be used to set it.</td>
        </tr>
        <tr>
          <td width="40%" align="right"><label for="range3">RTS/CTS threshold:</label></td>
          <td width="60%"><input name="range3" type="range" id="range3" max="2347" min="0" step="1" value="2347"></td>
        </tr>
      </table>
    </fieldset>
        

    <fieldset><legend>&nbsp;Fragmentation threshold
      </legend>
      <table width="100%" border="0">
        <tr>
          <td colspan="2" align="center">2346 = disabled (default); range 256..2346;  If this field is not included in hostapd.conf, hostapd will not control fragmentation threshold and 'iwconfig wlan# frag &lt;val&gt;' can be used to set it.</td>
        </tr>
        <tr>
          <td width="40%" align="right"><label for="range4">Fragmentation treshold:</label></td>
          <td width="60%"><input name="range4" type="range" id="range4" max="2346" min="256" step="1" value="2346"></td>
        </tr>
  </table>
    </fieldset>



    <fieldset><legend>&nbsp;Rate configuration
      </legend>
      <table width="100%" border="0">
        <tr>
          <td colspan="2" align="center">Default is to enable all rates supported by the hardware. This configuration item allows this list be filtered so that only the listed rates will be left in the list. If the list is empty, all rates are used. This list can have entries that are not in the list of rates the hardware supports (such entries are ignored). The entries in this list are in 100 kbps, i.e., 11 Mbps = 110. If this item is present, at least one rate have to be matching with the rates hardware supports.  default: use the most common supported rate setting for the selected hw_mode (i.e., this line can be removed from configuration file in most cases) supported_rates=10 20 55 110 60 90 120 180 240 360 480 540</td>
        </tr>
        <tr>
          <td width="40%" align="right"><label for="textfield3">Rate configuration:</label></td>
          <td width="60%"><input type="text" name="textfield3" id="textfield3"></td>
        </tr>
  </table>
    </fieldset>


    <fieldset><legend>&nbsp;Basic rate set configuration
      </legend>
      <table width="100%" border="0">
        <tr>
          <td colspan="2" align="center">List of rates (in 100 kbps) that are included in the basic rate set.  If this item is not included, usually reasonable default set is used.  basic_rates=10 20; basic_rates=10 20 55 110; basic_rates=60 120 240;</td>
        </tr>
        <tr>
          <td width="40%" align="right"><label for="textfield4">Basic rate set:</label></td>
          <td width="60%"><input type="text" name="textfield4" id="textfield4"></td>
        </tr>
  </table>
    </fieldset>


    <fieldset><legend>&nbsp;Short Preamble
      </legend>
      <table width="100%" border="0">
        <tr>
          <td colspan="2" align="center">This parameter can be used to enable optional use of short preamble for frames sent at 2 Mbps, 5.5 Mbps, and 11 Mbps to improve network performance.  This applies only to IEEE 802.11b-compatible networks and this should only be enabled if the local hardware supports use of short preamble. If any of the associated STAs do not support short preamble, use of short preamble will be disabled (and enabled when such STAs disassociate) dynamically.  0 = do not allow use of short preamble (default) 1 = allow use of short preamble</td>
        </tr>
        <tr>
          <td width="40%" align="right"><label for="checkbox5">Short preamble: </label></td>
          <td width="60%"><input type="checkbox" name="checkbox5" id="checkbox5"></td>
        </tr>
  </table>
    </fieldset>


    <fieldset><legend>&nbsp;Station MAC address -based authentication
      </legend>
      <table width="100%" border="0">
        <tr>
          <td colspan="2" align="center">Please note that this kind of access control requires a driver that uses hostapd to take care of management frame processing and as such, this can be used with driver=hostap or driver=nl80211, but not with driver=atheros.  0 = accept unless in deny list  1 = deny unless in accept list  2 = use external RADIUS server (accept/deny lists are searched first)</td>
        </tr>
        <tr>
          <td width="40%" align="right"><label for="select7">Mac authentication:</label></td>
          <td width="60%"><select name="select7" id="select7">
            <option value="0">accept unless in deny list</option>
            <option value="1">deny unless in accept list</option>
            <option value="2">use external RADIUS server</option>
          </select></td>
        </tr>
  </table>
    </fieldset>



    <fieldset><legend>&nbsp;Accept/deny lists
      </legend>
      <table width="100%" border="0">
        <tr>
          <td colspan="2" align="center">Is  read from separate files (containing list of MAC addresses, one per line). Use absolute path name to make sure that the files can be read on SIGHUP configuration reloads.  accept_mac_file=/etc/hostapd.accept  deny_mac_file=/etc/hostapd.deny</td>
        </tr>
        <tr>
          <td width="40%" align="right"><label for="textfield5">Accept/Deny file path:</label></td>
          <td width="60%"><input name="textfield5" type="text" id="textfield5" placeholder="/etc/hostapd.accept"></td>
        </tr>
  </table>
    </fieldset>



    <fieldset><legend>&nbsp;IEEE 802.11 authentication algorithms
      </legend>
      <table width="100%" border="0">
        <tr>
          <td colspan="2" align="center">IEEE 802.11 specifies two authentication algorithms. hostapd can be configured to allow both of these or only one. Open system authentication should be used with IEEE 802.1X.  Bit fields of allowed authentication algorithms: bit 0 = Open System Authentication bit 1 = Shared Key Authentication (requires WEP)</td>
        </tr>
        <tr>
          <td width="40%" align="right"><label for="select8">Authentication algorithms:</label></td>
          <td width="60%"><select name="select8" id="select8">
            <option value="1">Open System</option>
            <option value="2">Shared Key</option>
            <option value="3" selected="selected">Both</option>
          </select></td>
        </tr>
  </table>
    </fieldset>



    <fieldset><legend>&nbsp;Send empty SSID
      </legend>
      <table width="100%" border="0">
        <tr>
          <td colspan="2" align="center">Send empty SSID in beacons and ignore probe request frames that do not specify full SSID, i.e., require stations to know SSID.  default: disabled (0);  1 = send empty (length=0) SSID in beacon and ignore probe request for broadcast SSID;  2 = clear SSID (ASCII 0), but keep the original length (this may be required with some clients that do not support empty SSID) and ignore probe requests for broadcast SSID</td>
        </tr>
        <tr>
          <td width="40%" align="right"><label for="ignore_broadcast_ssid">Send empty SSID:</label></td>
          <td width="60%"><select name="ignore_broadcast_ssid" id="ignore_broadcast_ssid">
            <option value="0" selected="selected">Disabled</option>
            <option value="1">Send Empty</option>
            <option value="2">Clear SSID</option>
          </select></td>
        </tr>
  </table>
    </fieldset>



    <fieldset><legend>&nbsp;vendor specfic elements
      </legend>
      <table width="100%" border="0">
        <tr>
          <td colspan="2" align="center">Additional vendor specfic elements for Beacon and Probe Response frames.  This parameter can be used to add additional vendor specific element(s) into the end of the Beacon and Probe Response frames. The format for these element(s) is a hexdump of the raw information elements (id+len+payload for one or more elements)</td>
        </tr>
        <tr>
          <td width="40%" align="right"><label for="textfield6">Vendor elements:</label></td>
          <td width="60%"><input type="text" name="textfield6" id="textfield6"></td>
        </tr>
  </table>
    </fieldset>


    <fieldset><legend>&nbsp;TX queue parameters (EDCF / bursting)
      </legend>
      <table width="100%" border="0">
        <tr>
          <td colspan="2" align="center">tx_queue_&lt;queue name&gt;_&lt;param&gt; ; queues: data0, data1, data2, data3, after_beacon, beacon ; (data0 is the highest priority queue)</td>
        </tr>
        <tr>
          <td colspan="2" align="center">parameters: aifs: AIFS (default 2) ; cwmin: cwMin (1, 3, 7, 15, 31, 63, 127, 255, 511, 1023) ; cwmax: cwMax (1, 3, 7, 15, 31, 63, 127, 255, 511, 1023); cwMax &gt;= cwMin ; burst: maximum length (in milliseconds with precision of up to 0.1 ms) for bursting</td>
        </tr>
        <tr>
          <td colspan="2" align="center">Default WMM parameters (IEEE 802.11 draft; 11-03-0504-03-000e): These parameters are used by the access point when transmitting frames to the clients.</td>
        </tr>
        <tr>
          <td colspan="2" align="center">Low priority / AC_BK = background ; tx_queue_data3_aifs=7 ; tx_queue_data3_cwmin=15 ; tx_queue_data3_cwmax=1023 ; tx_queue_data3_burst=0 ; Note: for IEEE 802.11b mode: cWmin=31 cWmax=1023 burst=0</td>
        </tr>
        <tr>
          <td colspan="2" align="center">Normal priority / AC_BE = best effort ; tx_queue_data2_aifs=3 ; tx_queue_data2_cwmin=15 ; tx_queue_data2_cwmax=63 ; tx_queue_data2_burst=0 ; Note: for IEEE 802.11b mode: cWmin=31 cWmax=127 burst=0</td>
        </tr>
        <tr>
          <td colspan="2" align="center">High priority / AC_VI = video ; tx_queue_data1_aifs=1 ; tx_queue_data1_cwmin=7 ; tx_queue_data1_cwmax=15 ; tx_queue_data1_burst=3.0 ; Note: for IEEE 802.11b mode: cWmin=15 cWmax=31 burst=6.0</td>
        </tr>
        <tr>
          <td colspan="2" align="center">Highest priority / AC_VO = voice ; tx_queue_data0_aifs=1 ; tx_queue_data0_cwmin=3 ; tx_queue_data0_cwmax=7 ; tx_queue_data0_burst=1.5 ; Note: for IEEE 802.11b mode: cWmin=7 cWmax=15 burst=3.3</td>
        </tr>
        <tr>
          <td width="40%" align="right"><label for="textarea">TX Queue parameters:</label></td>
          <td width="60%"><textarea name="textarea" cols="30" rows="5" id="textarea"></textarea></td>
        </tr>
  </table>
    </fieldset>


    <fieldset><legend>&nbsp;Default WMM parameters
      </legend>
      <table width="100%" border="0">
        <tr>
          <td colspan="3" align="center">Default WMM parameters (IEEE 802.11 draft; 11-03-0504-03-000e): for 802.11a or 802.11g networks.  These parameters are sent to WMM clients when they associate.  The parameters will be used by WMM clients for frames transmitted to the access point.</td>
        </tr>
        <tr>
          <td colspan="3" align="center">note - txop_limit is in units of 32microseconds ; note - acm is admission control mandatory flag. 0 = admission control not required, 1 = mandatory ; note - here cwMin and cmMax are in exponent form. the actual cw value used will be (2^n)-1 where n is the value given here.</td>
        </tr>
        <tr>
          <td width="40%" align="right">WMM Enabled:</td>
          <td colspan="2"><input type="checkbox" name="checkbox6" id="checkbox6"></td>
        </tr>
        <tr>
          <td colspan="3" align="center">WMM-PS Unscheduled Automatic Power Save Delivery [U-APSD] ; Enable this flag if U-APSD supported outside hostapd (eg., Firmware/driver)</td>
          </tr>
        <tr>
          <td align="right"><label for="checkbox7">U-APSD Enabled: </label></td>
          <td colspan="2"><input type="checkbox" name="checkbox7" id="checkbox7"></td>
        </tr>
        <tr>
          <td align="right"><p>
            <label>
            </label>
            Low priority / AC_BK = background<br>
          </p></td>
          <td width="9%" align="center"><input type="radio" name="wmm parameters" value="radio" id="wmmparameters_0"></td>
          <td width="51%">wmm_ac_bk_cwmin=4<br>
            wmm_ac_bk_cwmax=10<br>
            wmm_ac_bk_aifs=7<br>
            wmm_ac_bk_txop_limit=0<br>
            wmm_ac_bk_acm=0<br></td>
        </tr>
        <tr>
          <td colspan="3" align="center">Note: for IEEE 802.11b mode: cWmin=5 cWmax=10</td>
          </tr>
        <tr>
          <td align="right"><label>Normal priority / AC_BE = best effort:</label></td>
          <td align="center"><input type="radio" name="wmm parameters" value="radio" id="wmmparameters_1"></td>
          <td>wmm_ac_be_aifs=3<br>
            wmm_ac_be_cwmin=4<br>
            wmm_ac_be_cwmax=10<br>
            wmm_ac_be_txop_limit=0<br>
            wmm_ac_be_acm=0<br></td>
        </tr>
        <tr>
          <td colspan="3" align="center">Note: for IEEE 802.11b mode: cWmin=5 cWmax=7</td>
          </tr>
        <tr>
          <td align="right">High priority / AC_VI = video:</td>
          <td align="center"><input type="radio" name="wmm parameters" value="radio" id="wmmparameters_2"></td>
          <td>wmm_ac_vi_aifs=2<br>
            wmm_ac_vi_cwmin=3<br>
            wmm_ac_vi_cwmax=4<br>
            wmm_ac_vi_txop_limit=94<br>
            wmm_ac_vi_acm=0<br></td>
        </tr>
        <tr>
          <td colspan="3" align="center">Note: for IEEE 802.11b mode: cWmin=4 cWmax=5 txop_limit=188</td>
          </tr>
        <tr>
          <td align="right">Highest priority / AC_VO = voice:</td>
          <td align="center"><input type="radio" name="wmm parameters" value="radio" id="wmmparameters_3"></td>
          <td>wmm_ac_vo_aifs=2<br>
            wmm_ac_vo_cwmin=2<br>
            wmm_ac_vo_cwmax=3<br>
            wmm_ac_vo_txop_limit=47<br>
            wmm_ac_vo_acm=0<br></td>
        </tr>
        <tr>
          <td colspan="3" align="center">Note: for IEEE 802.11b mode: cWmin=3 cWmax=4 burst=102</td>
          </tr>
  </table>
    </fieldset>


    <fieldset><legend>&nbsp;Static WEP key configuration
      </legend>
      <table width="100%" border="0">
        <tr>
          <td colspan="2" align="center">The key number to use when transmitting.  It must be between 0 and 3, and the corresponding key must be set.</td>
        </tr>
        <tr>
          <td align="right"><label for="select9">Default key:</label></td>
          <td><select name="select9" id="select9">
            <option value="0">not set</option>
            <option value="1">Key 1</option>
            <option value="2">Key 2</option>
            <option value="3">Key 3</option>
            <option value="4">Key 4</option>
          </select></td>
        </tr>
        <tr>
          <td colspan="2" align="center">The key length should be 5, 13, or 16 characters, or 10, 26, or 32 digits, depending on whether 40-bit (64-bit), 104-bit (128-bit), or 128-bit (152-bit) WEP is used.  Only the default key must be supplied; the others are optional.</td>
          </tr>
        <tr>
          <td align="right"><label for="textfield7">Key 1:</label></td>
          <td><input name="textfield7" type="text" id="textfield7" placeholder="123456789a"></td>
        </tr>
        <tr>
          <td align="right"><label for="textfield8">Key 2:</label></td>
          <td><input name="textfield8" type="text" id="textfield8" placeholder="&quot;vwxyz&quot;"></td>
        </tr>
        <tr>
          <td align="right"><label for="textfield9">Key 3:</label></td>
          <td><input name="textfield9" type="text" id="textfield9" placeholder="0102030405060708090a0b0c0d"></td>
        </tr>
        <tr>
          <td width="40%" align="right"><label for="textfield10">Key 4:</label></td>
          <td width="60%"><input name="textfield10" type="text" id="textfield10" placeholder="&quot;.2.4.6.8.0.23&quot;"></td>
        </tr>
  </table>
    </fieldset>


    <fieldset><legend>&nbsp;Station inactivity limit
      </legend>
      <table width="100%" border="0">
        <tr>
          <td colspan="2" align="center">If a station does not send anything in ap_max_inactivity seconds, an empty data frame is sent to it in order to verify whether it is still in range. If this frame is not ACKed, the station will be disassociated and then deauthenticated. This feature is used to clear station table of old entries when the STAs move out of the range.</td>
        </tr>
        <tr>
          <td colspan="2" align="center">The station can associate again with the AP if it is still in range.  This inactivity poll is just used as a nicer way of verifying inactivity; i.e., client will not report broken connection because disassociation frame is not sent immediately without first polling the STA with a data frame. default: 300 (i.e., 5 minutes)</td>
        </tr>
        <tr>
          <td align="right"><label for="number4">Max inactivity:</label></td>
          <td><input name="number4" type="number" id="number4" value="300"></td>
        </tr>
        <tr>
          <td colspan="2" align="center">The inactivity polling can be disabled to disconnect stations based on inactivity timeout so that idle stations are more likely to be disconnected even if they are still in range of the AP. This can be done by setting skip_inactivity_poll to 1 (default 0).</td>
          </tr>
        <tr>
          <td width="40%" align="right"><label for="checkbox8">Skip inactivity poll: </label></td>
          <td width="60%"><input type="checkbox" name="checkbox8" id="checkbox8"></td>
        </tr>
  </table>
    </fieldset>


    <fieldset><legend>&nbsp;Disassociate stations
      </legend>
      <table width="100%" border="0">
        <tr>
          <td colspan="2" align="center">Disassociate stations based on excessive transmission failures or other indications of connection loss. This depends on the driver capabilities and may not be available with all drivers.</td>
        </tr>
        <tr>
          <td width="40%" align="right"><label for="checkbox9">Disassociate low acknowledge: </label></td>
          <td width="60%"><input type="checkbox" name="checkbox9" id="checkbox9"></td>
        </tr>
  </table>
    </fieldset>


    <fieldset><legend>&nbsp;Maximum allowed Listen Interval
      </legend>
      <table width="100%" border="0">
        <tr>
          <td colspan="2" align="center">(how many Beacon periods STAs are allowed to remain asleep). Default: 65535 (no limit apart from field size)</td>
        </tr>
        <tr>
          <td width="40%" align="right"><label for="number5">Maximum interval:</label></td>
          <td width="60%"><input name="number5" type="number" id="number5" value="65535"></td>
        </tr>
  </table>
    </fieldset>


    <fieldset><legend>&nbsp;WDS (4-address frame) mode
      </legend>
      <table width="100%" border="0">
        <tr>
          <td colspan="2" align="center">WDS (4-address frame) mode with per-station virtual interfaces (only supported with driver=nl80211) This mode allows associated stations to use 4-address frames to allow layer 2 bridging to be used.</td>
        </tr>
        <tr>
          <td align="right"><label for="checkbox10">Enable wds mode: </label></td>
          <td><input type="checkbox" name="checkbox10" id="checkbox10"></td>
        </tr>
        <tr>
          <td colspan="2" align="right">If bridge parameter is set, the WDS STA interface will be added to the same bridge by default. This can be overridden with the wds_bridge parameter to use a separate bridge.</td>
          </tr>
        <tr>
          <td width="40%" align="right"><label for="textfield11">Wds-Bridge:</label></td>
          <td width="60%"><input name="textfield11" type="text" id="textfield11" placeholder="wds-br0"></td>
        </tr>
  </table>
    </fieldset>


    <fieldset>
      <legend></legend>
    No Beaconing
      <table width="100%" border="0">
        <tr>
          <td colspan="2" align="center">Start the AP with beaconing disabled by default.</td>
        </tr>
        <tr>
          <td width="40%" align="right"><label for="checkbox11">Start without beaconing: </label></td>
          <td width="60%"><input type="checkbox" name="checkbox11" id="checkbox11"></td>
        </tr>
      </table>
    </fieldset>


    <fieldset>
      <legend></legend>
    Client Isolation
      <table width="100%" border="0">
        <tr>
          <td colspan="2" align="center">Client isolation can be used to prevent low-level bridging of frames between associated stations in the BSS. By default, this bridging is allowed.</td>
        </tr>
        <tr>
          <td width="40%" align="right"><label for="checkbox12">AP Isolation: </label></td>
          <td width="60%"><input type="checkbox" name="checkbox12" id="checkbox12"></td>
        </tr>
      </table>
    </fieldset>


    <fieldset><legend>&nbsp;BSS Load update period (in BUs)
      </legend>
      <table width="100%" border="0">
        <tr>
          <td colspan="2" align="center">This field is used to enable and configure adding a BSS Load element into Beacon and Probe Response frames.</td>
        </tr>
        <tr>
          <td width="40%" align="right"><label for="number6">BSS Load update period:</label></td>
          <td width="60%"><input name="number6" type="number" id="number6" placeholder="50"></td>
        </tr>
  </table>
    </fieldset>


    <fieldset><legend>&nbsp;Fixed BSS Load value for testing purposes
      </legend>
      <table width="100%" border="0">
        <tr>
          <td colspan="2" align="center"> This field can be used to configure hostapd to add a fixed BSS Load element into Beacon and Probe Response frames for testing purposes. The format is &lt;station count&gt;:&lt;channel utilization&gt;:&lt;available admission capacity&gt;</td>
        </tr>
        <tr>
          <td width="40%" align="right"><label for="textfield12">BSS Load Test:</label></td>
          <td width="60%"><input name="textfield12" type="text" id="textfield12" placeholder="12:80:20000"></td>
        </tr>
  </table>
    </fieldset>


    <fieldset><legend>&nbsp;</legend>
      <table width="100%" border="0">
        <tr>
          <td colspan="2" align="center">&nbsp;</td>
        </tr>
        <tr>
          <td width="40%" align="right">&nbsp;</td>
          <td width="60%">&nbsp;</td>
        </tr>
      </table>
    </fieldset>


    <fieldset><legend>&nbsp;</legend>
      <table width="100%" border="0">
        <tr>
          <td colspan="2" align="center">&nbsp;</td>
        </tr>
        <tr>
          <td width="40%" align="right">&nbsp;</td>
          <td width="60%">&nbsp;</td>
        </tr>
      </table>
    </fieldset>


    <fieldset><legend>&nbsp;</legend>
      <table width="100%" border="0">
        <tr>
          <td colspan="2" align="center">&nbsp;</td>
        </tr>
        <tr>
          <td width="40%" align="right">&nbsp;</td>
          <td width="60%">&nbsp;</td>
        </tr>
      </table>
    </fieldset>


    <fieldset><legend>&nbsp;</legend>
      <table width="100%" border="0">
        <tr>
          <td colspan="2" align="center">&nbsp;</td>
        </tr>
        <tr>
          <td width="40%" align="right">&nbsp;</td>
          <td width="60%">&nbsp;</td>
        </tr>
      </table>
    </fieldset>


    <fieldset><legend>&nbsp;</legend>
      <table width="100%" border="0">
        <tr>
          <td colspan="2" align="center">&nbsp;</td>
        </tr>
        <tr>
          <td width="40%" align="right">&nbsp;</td>
          <td width="60%">&nbsp;</td>
        </tr>
      </table>
    </fieldset>


    <fieldset><legend>&nbsp;</legend>
      <table width="100%" border="0">
        <tr>
          <td colspan="2" align="center">&nbsp;</td>
        </tr>
        <tr>
          <td width="40%" align="right">&nbsp;</td>
          <td width="60%">&nbsp;</td>
        </tr>
      </table>
    </fieldset>
    
    
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





<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>
