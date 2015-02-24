# Raspberry-Wifi-Router

Welcome to the Raspberry-Wifi-Router project.
This project aims to build a descent Wifi Router out of a Raspberry Pi which is easily configurable via
a dynamic web interface designed in HTML/PHP.
This project came to life out of personal interest in hardware embedded design and software design in linux with PHP.
I'm putting my desing onto Github to share my work with the open source community, hoping to get some people interested in this project to contribute, the ultimate goal is to create a fantastic web gui for a cheap Raspberry Pi used as Wifi Router.

#Licensing
This software is released as free software under the General Public License, everyone is free to do with it what he wants.


#Getting started
Before getting started, make sure you have the right equipment at hand:
* Raspberry Pi - Model B - other models might work but are untested.
* ssd card loaded with the latest Raspbian version -  can be downloaded from http://downloads.raspberrypi.org/raspbian_latest (put on ssd card with win32diskimager).
* A wifi adapter which has a compatible cfg80211 driver
Go to https://wireless.wiki.kernel.org/en/users/drivers
Search for a usb wifi driver which is cfg80211 compatible, and is capable of doing AP and PHY mode B/G/N.
Based on that driver, look for a physical device which will work with that driver.
This project was developed and tested with an Alfa Awus036NEH Usb Wireless Adapter http://www.alfa.com.tw/products_show.php?pc=34&ps=22

Preparing your Raspberry Pi:


Installing all the needed Packages:
apt-get install lighttpd

Setting







