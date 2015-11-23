apt-get -y install rpi-update
rpi-update
sed -i "15i /home/pi/Raspberry-Wifi-Router/installer.sh" /etc/rc.local
reboot
