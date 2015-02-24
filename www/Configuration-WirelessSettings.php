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
    <span>Wireless Settings</span></div>
    
    <div id="ContentArticle">
      <form>
        <fieldset><legend>Common Settings</legend>
          <table width="100%" border="0">
            <tr>
              <td width="40%" align="right">Wireless Radio Enabled:</td>
              <td width="60%"><input type="checkbox" name="checkbox" id="checkbox"></td>
            </tr>
            <tr>
              <td align="right">Wireless Network Name (SSID):</td>
              <td><input type="text" name="textfield" id="textfield"></td>
            </tr>
            <tr>
              <td align="right">Visibility Status:</td>
              <td><select name="visibilitystatus" id="visibilitystatus">
                <option value="Visible">Visible</option>
                <option value="Invisible">Invisible</option>
              </select></td>
            </tr>
            <tr>
              <td align="right">Operation Mode:</td>
              <td><select name="select" id="select">
                <option value="IEEE 802.11-b">IEEE 802.11-b</option>
                <option value="IEEE 802.11-g">IEEE 802.11-g</option>
                <option value="IEEE 802.11-bgn">IEEE 802.11-bgn</option>
              </select></td>
            </tr>
            <tr>
              <td align="right">Channel:</td>
              <td><select name="select2" id="select2">
                <option value="1">[1] - 2412 MHz</option>
                <option value="2">[2] - 2417 MHz</option>
                <option value="3">[3] - 2422 MHz</option>
                <option value="4">[4] - 2427 MHz</option>
                <option value="5">[5] - 2432 MHz</option>
                <option value="6">[6] - 2437 MHz</option>
                <option value="7">[7] - 2442 MHz</option>
                <option value="8">[8] - 2447 MHz</option>
                <option value="9">[9] - 2452 MHz</option>
                <option value="10">[10] - 2457 MHz</option>
                <option value="11">[11] - 2462 MHz</option>
                <option value="12">[12] - 2467 MHz</option>
                <option value="13">[13] - 2472 MHz</option>
              </select></td>
            </tr>
            <tr>
              <td align="right">Transmission Rate:</td>
              <td><select name="select3" id="select3">
                <option value="1">1.0 Mbps</option>
                <option value="2">2.0 Mbps</option>
                <option value="3">5.5 Mbps</option>
                <option value="4">11.0 Mbps</option>
                <option value="5">18.0 Mbps</option>
                <option value="6">24.0 Mbps</option>
                <option value="7">36.0 Mbps</option>
                <option value="8">48.0 Mbps</option>
                <option value="9">54.0 Mbps</option>
              </select></td>
              
           </tr>
            <tr>
              <td align="right">Channel Width:</td>
              <td><select name="select4" id="select4">
                <option value="1">20 Mhz</option>
                <option value="2">20/40 Mhz</option>
              </select></td>
            </tr>
            <tr>
              <td align="right">Security Mode:</td>
              <td><select name="select5" id="select5">
                <option value="None">None</option>
                <option value="WEP">WEP</option>
                <option value="WPA/WPA2-PSK">WPA/WPA2-PSK</option>
              </select></td>
            </tr>
            <tr>
              <td align="right"><input type="submit" name="submit" id="submit" value="Submit"></td>
              <td>&nbsp;</td>
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





<!-- InstanceEndEditable -->
</body>
<!-- InstanceEnd --></html>
