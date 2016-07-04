# Raspberry-Wifi-Router:

###Welcome to the Raspberry-Wifi-Router project.

This project aims to build a descent Wifi Router out of a Raspberry Pi which is easily configurable via
a dynamic web interface designed in HTML/PHP.
This project came to life out of personal interest in hardware embedded design and software design in linux with PHP.
I'm putting my desing onto Github to share my work with the open source community, hoping to get some people interested in this project to contribute, the ultimate goal is to create a fantastic web gui for a cheap Raspberry Pi used as Wifi Router.

For the people that are only interested in trying the router, you can download the latest version of the SD card image below:
* [Raspberry Pi Wifi Router v1.4](https://ronnyvdbr.github.io/)

The default configuration is set to obtain an IP address via DHCP from the wired ethernet connection.
To access the web interface, enter 'admin' as username and 'raspberry' as password.
To login via SSH, login with username 'pi' and password 'raspberry', and use sudo for root access.

##### Features:
  * Bridge and Router with NAT functionality
  * Static/Dynamic addressing
  * DHCP, DNS Proxy, NTP, 
  * hostapd wifi module
  * 802.11 B/G/N depending on your wifi adapter
  * Wi-Fi Protected Access® (WPA/WPA2—PSK) and WEP
  * Captive Portal (coovachilli)

##### Features still to be implemented:
  * Port forwarding (iptables).
  * Network Filter (firewall).
  * Web Filter (privoxy).
  * Proxy (squid, squidguard).
  * Advanced wireless configuration (hostapd).

For the ones amongst us that are not scared of entering the matrix, here's how you assemble the ssd yourself:

##### Getting started:
Before getting started, make sure you have the right equipment at hand:
* Raspberry Pi - Model B - other models might work but are untested.
* SD card from minimal 2 Gb.
* A wifi adapter which has a compatible cfg80211 driver.
Go to https://wireless.wiki.kernel.org/en/users/drivers
Search for a usb wifi driver which is cfg80211 compatible, and is capable of doing AP and PHY mode B/G/N.
Based on that driver, look for a physical device which will work with that driver.
This project was developed and tested with an Alfa Awus036NEH Usb Wireless Adapter: http://www.alfa.com.tw/products_show.php?pc=34&ps=22

##### Preparing your Raspberry Pi:
* This project is built on top of a foundation Raspbian Jessie Lite image which can be downloaded from the foundation website at https://www.raspberrypi.org/downloads/raspbian/
* Download your copy of the image and write this to SD card with win32diskimager, boot it up in your Raspberry Pi.
* Login to your Raspberry Pi with username 'pi' and password 'raspberry'
* Follow the instructions in installer-jessie.sh to get everything installed.
