# Raspberry-Wifi-Router:

###Welcome to the Raspberry-Wifi-Router project.

This project aims to build a descent Wifi Router out of a Raspberry Pi which is easily configurable via
a dynamic web interface designed in HTML/PHP.
This project came to life out of personal interest in hardware embedded design and software design in linux with PHP.
I'm putting my desing onto Github to share my work with the open source community, hoping to get some people interested in this project to contribute, the ultimate goal is to create a fantastic web gui for a cheap Raspberry Pi used as Wifi Router.

For the people that are only interested in trying the router, you can download the latest version of the ssd card image below:
Download: [Raspberry Pi Wifi Router v1.0](http://ronnyvdb.synology.me:8080/RaspberryWAPv1.0.gz)

For the ones amongst us that are not scared of entering the matrix, here's how you assemble the ssd yourself:

##### Getting started:
Before getting started, make sure you have the right equipment at hand:
* Raspberry Pi - Model B - other models might work but are untested.
* Ssd card formatted fat32
* A wifi adapter which has a compatible cfg80211 driver.
Go to https://wireless.wiki.kernel.org/en/users/drivers
Search for a usb wifi driver which is cfg80211 compatible, and is capable of doing AP and PHY mode B/G/N.
Based on that driver, look for a physical device which will work with that driver.
This project was developed and tested with an Alfa Awus036NEH Usb Wireless Adapter: http://www.alfa.com.tw/products_show.php?pc=34&ps=22

##### Preparing your Raspberry Pi:
* For this project I chose to start off with a netinstall of Raspbian, because it gives u a minimal vanilla install of Raspbian Wheezy without any extra clutter.
* Credits go out to [Debian Pi](https://github.com/debian-pi/raspbian-ua-netinst), you can grab a copy of their latest net-installer [https://github.com/debian-pi/raspbian-ua-netinst/releases/tag/v1.0.6](https://github.com/debian-pi/raspbian-ua-netinst/releases/tag/v1.0.6).  Format your SSD fat32, and extract the zip onto the ssd.  Put into Raspberry Pi, and boot it up, it's just as simple as that.

##### After the net-install, login to your Raspberry Pi using root and raspbian as password, then continue the rest of the prep:

* sudo apt-get -y install git-core
* git clone https://github.com/ronnyvdbr/Raspberry-Wifi-Router.git



