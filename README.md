# Raspberry-Wifi-Router:

###Welcome to the Raspberry-Wifi-Router project.

This project aims to build a descent Wifi Router out of a Raspberry Pi which is easily configurable via
a dynamic web interface designed in HTML/PHP.
This project came to life out of personal interest in hardware embedded design and software design in linux with PHP.
I'm putting my desing onto Github to share my work with the open source community, hoping to get some people interested in this project to contribute, the ultimate goal is to create a fantastic web gui for a cheap Raspberry Pi used as Wifi Router.

####Licensing:
This software is released as free software under the General Public License, everyone is free to do with it what he wants.


#### Getting started:
Before getting started, make sure you have the right equipment at hand:
* Raspberry Pi - Model B - other models might work but are untested.
* Ssd card loaded with the latest Raspbian version -  can be downloaded from http://downloads.raspberrypi.org/raspbian_latest
* In my case 2015-02-16-raspbian-wheezy (put on ssd card with win32diskimager).
* A wifi adapter which has a compatible cfg80211 driver.
Go to https://wireless.wiki.kernel.org/en/users/drivers
Search for a usb wifi driver which is cfg80211 compatible, and is capable of doing AP and PHY mode B/G/N.
Based on that driver, look for a physical device which will work with that driver.
This project was developed and tested with an Alfa Awus036NEH Usb Wireless Adapter: http://www.alfa.com.tw/products_show.php?pc=34&ps=22

#### Preparing your Raspberry Pi:
* Boot up your Raspberry Pi with the Raspbian ssd. 
* Select 8 - advanced options, then A0 - Update this tool to the latest version.
* Select 1 - Expand Filesysem.
* Select 2 - Change User Password - set your password :-p.
* Select 3 - enable boot to command line.
* Select 4 - I1 - change localisation to your flavour, in my case en_US.UTF-8 UTF-8.
* Select 4 - I3 - change keyboard layout to Generic 102-key (Intl) PC - Belgian - Belgian (alternative, latin-9 only).
* Select 8 - advanced options, then A2 - Set the visible name for this Pi on a network - in my case RaspberryWAP.
* Select 8 - advanced options, then A3 - Change the amount of memory made available to the GPU - in my case 16 Mb.
* Select 8 - advanced options, then A4 - Enable/Disable remote command line access to your Pi using SSH - enable.
* Reboot your Raspberry Pi - sudo reboot
* Note down the ip address of your Raspberry Pi, it will appear above the login prompt on first boot after configuration.
* You are now able to use a terminal emulator like 'putty' to ssh into your Raspberry Pi, using pi as username, and your password.
* Update your Rasbian Os to the latest version:
* sudo apt-get update
* sudo apt-get upgrade
* Update the kernel and firmware:
* sudo rpi-update
* Reboot your Raspberry Pi - sudo reboot

#### Installing and configuring the needed Packages:
Login to your Raspberry Pi using pi as username.

##### Install Git:
* sudo apt-get -y install git-core (in my version of Raspbian already installed per default)

##### Install our web server lighttpd and enable php on it:
* sudo apt-get -y install lighttpd php5-common php5-cgi php5
* sudo lighty-enable-mod fastcgi-php

###### Clone our git repository with the web gui onto our Raspberry Pi:
* git clone https://github.com/ronnyvdbr/Raspberry-Wifi-Router.git

###### reconfigure lighttpd to serve our web gui and set some permissions:
* sudo rm -R /var/www
* sudo ln -s /home/pi/Raspberry-Wifi-Router/www /var/www
* sudo chown pi:www-data /var/www
* sudo chown -R pi:www-data /home/pi/Raspberry-Wifi-Router/www
* sudo chmod g+w /home/pi/Raspberry-Wifi-Router/www/routersettings.ini
* sudo chmod 775 /var/www
* sudo usermod -a -G www-data pi
* sudo sed -i 's/"index.php", "index.html", "index.lighttpd.html"/"home.php"/g' /etc/lighttpd/lighttpd.conf
* sudo /etc/init.d/lighttpd force-reload

##### We're building an access point, so we need hostapd, we're first going to set-up the Rasbian hostapd package:
* sudo apt-get -y install hostapd
* sudo sed -i 's/DAEMON_CONF=/DAEMON_CONF=\/etc\/hostapd\/hostapd.conf/g' /etc/init.d/hostapd

###### Now we are going to update the hostapd binaries to the latest version.  Let's grab a copy of the latest version of hostapd from the website and compile it:

###### First install some dependencies:
* sudo apt-get -y install libnl-3-dev
* sudo apt-get -y install libnl-genl-3-dev
* sudo apt-get -y install libssl-dev

###### Let's download our source code from the website:
* wget http://w1.fi/releases/hostapd-2.3.tar.gz
* tar -zxvf hostapd-2.3.tar.gz
* cd ~/hostapd-2.3/hostapd

###### Let's configure some things before we start compiling:
* cp defconfig .config
* sed -i 's/#CONFIG_LIBNL20=y/CONFIG_LIBNL20=y/g' .config
* sed -i 's/#CFLAGS += -I$<path to libnl include files>/CFLAGS += -I\/usr\/include\/libnl3/g' .config
* sed -i 's/#LIBS += -L$<path to libnl library files>/LIBS += -L\/lib\/arm-linux-gnueabihf/g' .config
* sed -i 's/#CONFIG_IEEE80211N=y/CONFIG_IEEE80211N=y/g' .config
* cd /lib/arm-linux-gnueabihf
* sudo ln -s libnl-genl-3.so.200.5.2 libnl-genl.so
* sudo ln -s libnl-3.so.200.5.2 libnl.so
* cd ~/hostapd-2.3/hostapd
* make

###### Now overwrite the old hostapd binaries with the newly compiled ones:
* sudo cp ~/hostapd-2.3/hostapd/hostapd /usr/sbin/hostapd
* sudo cp ~/hostapd-2.3/hostapd/hostapd_cli /usr/sbin/hostapd_cli

###### Let's setup bridge utils, macchanger, and dnsmasq:
* sudo apt-get -y install bridge-utils
* sudo apt-get -y install macchanger
* sudo apt-get -y install dnsmasq

##### Now let's set the rest of some configuration bits which are needed to function correctly:

###### Copy some default config files into place, warning, taking below actions will change your ip address on next reboot:
* sudo cp /home/pi/Raspberry-Wifi-Router/defconfig/interfaces /etc/network/interfaces
* sudo chgrp www-data /etc/network/interfaces
* sudo chmod g+w /etc/network/interfaces

* sudo cp /home/pi/Raspberry-Wifi-Router/defconfig/hostapd.conf /etc/hostapd/hostapd.conf
* sudo chgrp www-data /etc/hostapd/hostapd.conf
* sudo chmod g+w /etc/hostapd/hostapd.conf
* sudo /etc/init.d/hostapd start
* sudo update-rc.d hostapd defaults

* sudo sed -i 's/output_buffering = 4096/;output_buffering = 4096/g' /etc/php5/cgi/php.ini
* sudo /etc/init.d/lighttpd force-reload

* sudo chgrp www-data /etc/dhcp/dhclient.conf
* sudo chmod g+w /etc/dhcp/dhclient.conf

* sudo chgrp www-data /etc/ntp.conf
* sudo chmod g+w /etc/ntp.conf

* sudo chgrp www-data /etc/timezone
* sudo chmod g+w /etc/timezone
 


###### We modify /etc/fstab to remount the root partition with write rights, this is needed to write configuration changes to cmdline.txt
* sudo umount /dev/mmcblk0p1 
* sudo sed -i 's/\/dev\/mmcblk0p1  \/boot           vfat    defaults          0       2/\/dev\/mmcblk0p1  \/boot           vfat    rw,relatime,fmask=0000,dmask=0000,codepage=437,iocharset=ascii,shortname=mixed,errors=remount-ro          0       2/g' /etc/fstab
* sudo mount /dev/mmcblk0p1

###### Let's create a sudoers file which determines which commands our webserver can execute to make configuration changes for the router
* sudo touch /etc/sudoers.d/wr_commands
* sudo nano /etc/sudoers.d/wr_commands

###### Paste all the below commands in the file and save it by pressing Ctrl-X and pressing y

* www-data ALL = (root) NOPASSWD: /usr/sbin/dpkg-reconfigure -f noninteractive tzdata
* www-data ALL = (root) NOPASSWD: /etc/init.d/ntp force-reload
* www-data ALL = (root) NOPASSWD: /etc/init.d/ntp stop
* www-data ALL = (root) NOPASSWD: /etc/init.d/networking restart
* www-data ALL = (root) NOPASSWD: /etc/init.d/hostapd restart
* www-data ALL = (root) NOPASSWD: /sbin/ifconfig *
* www-data ALL = (root) NOPASSWD: /sbin/brctl *
* www-data ALL = (root) NOPASSWD: /bin/rm /etc/dhcp3/dhclient-enter-hooks.d/nodnsupdate
* www-data ALL = (root) NOPASSWD: /sbin/service *
* www-data ALL = (root) NOPASSWD: /sbin/ifdown *
* www-data ALL = (root) NOPASSWD: /sbin/ifup *
* www-data ALL = (root) NOPASSWD: /bin/chown root /etc/dhcp3/dhclient-enter-hooks.d/nodnsupdate
* www-data ALL = (root) NOPASSWD: /bin/chmod +x /etc/dhcp3/dhclient-enter-hooks.d/nodnsupdate
* www-data ALL = (root) NOPASSWD: /usr/bin/macchanger
* www-data ALL = (root) NOPASSWD: /sbin/sysctl -w net.ipv4.ip_forward=1
* www-data ALL = (root) NOPASSWD: /etc/init.d/dnsmasq
* www-data ALL = (root) NOPASSWD: /sbin/iptables
