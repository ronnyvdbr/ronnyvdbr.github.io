# Raspberry-Wifi-Router:

###Welcome to the Raspberry-Wifi-Router project.

This project aims to build a descent Wifi Router out of a Raspberry Pi which is easily configurable via
a dynamic web interface designed in HTML/PHP.
This project came to life out of personal interest in hardware embedded design and software design in linux with PHP.
I'm putting my desing onto Github to share my work with the open source community, hoping to get some people interested in this project to contribute, the ultimate goal is to create a fantastic web gui for a cheap Raspberry Pi used as Wifi Router.

For the people that are only interested in trying the router, you can download the latest version of the ssd card image below:
* [Raspberry Pi Wifi Router v1.4](http://hyena.dscloud.me:8080/RaspberryWAPv1.4.zip)

The default configuration is set to obtain an IP address via DHCP from the wired ethernet connection.
To access the web interface, enter 'admin' as username and 'raspberry' as password.
To login via SSH, login with username 'pi' and password 'raspberry', and use sudo for root access.

Features:
Bridge and Router with NAT functionality
Static/Dynamic addressing
DHCP, DNS Proxy, NTP, 
hostapd wifi module
802.11 B/G/N depending on your wifi adapter
Wi-Fi Protected Access® (WPA/WPA2—PSK) and WEP
Captive Portal (coovachilli)
Still to be implemented:
Port forwarding (iptables).
Network Filter (firewall).
Web Filter (privoxy).
Proxy (squid, squidguard).
Advanced wireless configuration (hostapd).

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
* For this project I chose to start off with a minimal installation of Raspbian, the Wireless Router should be able to fit on a small sd card of 2 Gb.
* I didn't care to build a minimal Raspbian install myself, since there is already a very nice project for this on the net called minibian.
* You can grab an image of their minimal Raspbian OS image from their website https://minibianpi.wordpress.com/ and write that to SD card with win32diskimager to get started.
* The default username and password for minibian is root and raspberry

After booting this image for the first time, we need to resize the partition to 2 Gb to fit the Wireless Router:
* fdisk /dev/mmcblk0
* Press p to view the current partition lay-out.
* Note down the start sector of /dev/mmcblk0p2
* Press d, then press 2 to delete partition /dev/mmcblk0p2
* Now create a new parition with the same start sector, press n, then press p, then press 2, now enter the same start sector that u had written down.
* Now enter +2G to expand the partition to 2 Gb, Check the p output!
* Press w to write the new partition table.
Now you need to reboot:
* shutdown -r now
After the reboot you need to resize the filesystem on the partition. The resize2fs command will resize your filesystem to the new size from the changed partition table.
* resize2fs /dev/mmcblk0p2

##### You are now ready to continue the rest of the prep:

Login to your Raspberry Pi and paste below bootstrap in your shell, it will kick off the rest of the installation.
bash <(curl -s https://raw.githubusercontent.com/ronnyvdbr/ronnyvdbr.github.io/master/bootstrap.sh)
