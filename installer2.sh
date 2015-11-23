sudo cp /home/pi/Raspberry-Wifi-Router/defconfig/interfaces /etc/network/interfaces
sudo chgrp www-data /etc/network/interfaces
sudo chmod g+w /etc/network/interfaces
sudo cp /home/pi/Raspberry-Wifi-Router/defconfig/ntp.conf /etc/ntp.conf
sudo chgrp www-data /etc/ntp.conf
sudo chmod g+w /etc/ntp.conf
sudo cp /home/pi/Raspberry-Wifi-Router/defconfig/dnsmasq.conf /etc/dnsmasq.conf
sudo chgrp www-data /etc/dnsmasq.conf
sudo chmod g+w /etc/dnsmasq.conf
sudo cp /home/pi/Raspberry-Wifi-Router/defconfig/hostapd.conf /etc/hostapd/hostapd.conf
sudo chgrp www-data /etc/hostapd/hostapd.conf
sudo chmod g+w /etc/hostapd/hostapd.conf
sudo update-rc.d hostapd defaults
sudo sed -i 's/output_buffering = 4096/;output_buffering = 4096/g' /etc/php5/cgi/php.ini
sudo chgrp www-data /etc/dhcp/dhclient.conf
sudo chmod g+w /etc/dhcp/dhclient.conf
sudo chgrp www-data /etc/timezone
sudo chmod g+w /etc/timezone
sudo cp /home/pi/Raspberry-Wifi-Router/defconfig/routersettings.ini /var/www/routersettings.ini
sudo umount /dev/mmcblk0p1
sudo sed -i 's/\/dev\/mmcblk0p1 \/boot vfat defaults 0 2/\/dev\/mmcblk0p1 \/boot vfat rw,relatime,fmask=0000,dmask=0000,codepage=437,iocharset=ascii,shortname=mixed,errors=remount-ro 0 2/g' /etc/fstab
sudo mount /dev/mmcblk0p1
sudo cp /home/pi/Raspberry-Wifi-Router/defconfig/cmdline.txt /boot/cmdline.txt
sudo update-rc.d -f ntp remove
rm /etc/udev/rules.d/*
echo '# ' | sudo tee --append /etc/udev/rules.d/75-persistent-net-generator.rules
sudo sed -i 's/deb http:\/\/mirrordirector.raspbian.org\/raspbian wheezy main firmware/deb http:\/\/archive.raspbian.org\/raspbian wheezy main contrib non-free/g' /etc/apt/sources.list
apt-get update 
apt-get -y install firmware-ralink
sudo sed -i 's/deb http:\/\/archive.raspbian.org\/raspbian wheezy main contrib non-free/deb http:\/\/mirrordirector.raspbian.org\/raspbian wheezy main firmware/g' /etc/apt/sources.list
apt-get update
sh /home/pi/Raspberry-Wifi-Router/chillispot.sh
reboot

