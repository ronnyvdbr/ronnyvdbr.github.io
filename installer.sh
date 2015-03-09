rm /etc/ssh/ssh_host_* && dpkg-reconfigure openssh-server
dpkg-reconfigure tzdata
dpkg-reconfigure locales
apt-get install console-setup keyboard-configuration
dpkg-reconfigure keyboard-configuration
apt-get -y install rpi-update
rpi-update
apt-get -y install wireless-tools
apt-get install firmware-ralink
apt-get install sudo
useradd pi
useradd -G sudo pi
mkdir /home/pi
cp /root/.profile /home/pi/.profile
cp /root/.bashrc /home/pi/.bashrc
chown -R pi /home/pi
chgrp -R pi /home/pi
chmod -R 755 /home/pi
sed -i 's/pi:x:1000:1000::\/home\/pi:\/bin\/sh/pi:x:1000:1000::\/home\/pi:\/bin\/bash/g' /etc/passwd
sed -i 's/# export LS_OPTIONS='--color=auto'/export LS_OPTIONS='--color=auto'/g' /home/pi/.bashrc
sed -i s/# eval "dircolors"/eval "dircolors"/g' /home/pi/.bashrc
sed -i "s/# alias ls=\'ls $LS_OPTIONS\'/alias ls=\'ls $LS_OPTIONS\'/g" /home/pi/.bashrc
sed -i "s/# alias ll='ls $LS_OPTIONS -l'/alias ll='ls $LS_OPTIONS -l'/g" /home/pi/.bashrc
sed -i "s/# alias l='ls $LS_OPTIONS -lA'/alias l='ls $LS_OPTIONS -lA'/g" /home/pi/.bashrc
sudo apt-get -y install lighttpd php5-common php5-cgi php5
sudo lighty-enable-mod fastcgi-php
sudo /etc/init.d/lighttpd force-reload
sudo rm -R /var/www
sudo ln -s /home/pi/Raspberry-Wifi-Router/www /var/www
sudo chown pi:www-data /var/www
sudo chown -R pi:www-data /home/pi/Raspberry-Wifi-Router/www
sudo chmod g+w /home/pi/Raspberry-Wifi-Router/www/routersettings.ini
sudo chmod 775 /var/www
sudo usermod -a -G www-data pi
sudo sed -i 's/"index.php", "index.html", "index.lighttpd.html"/"home.php"/g' /etc/lighttpd/lighttpd.conf
sudo /etc/init.d/lighttpd force-reload
sudo apt-get -y install hostapd
sudo sed -i 's/DAEMON_CONF=/DAEMON_CONF=\/etc\/hostapd\/hostapd.conf/g' /etc/init.d/hostapd
sudo apt-get -y install libnl-3-dev
sudo apt-get -y install libnl-genl-3-dev
sudo apt-get -y install libssl-dev
wget http://w1.fi/releases/hostapd-2.3.tar.gz
tar -zxvf hostapd-2.3.tar.gz
cd ~/hostapd-2.3/hostapd
cp defconfig .config
sed -i 's/#CONFIG_LIBNL20=y/CONFIG_LIBNL20=y/g' .config
sed -i 's/#CFLAGS += -I$<path to libnl include files>/CFLAGS += -I\/usr\/include\/libnl3/g' .config
sed -i 's/#LIBS += -L$<path to libnl library files>/LIBS += -L\/lib\/arm-linux-gnueabihf/g' .config
sed -i 's/#CONFIG_IEEE80211N=y/CONFIG_IEEE80211N=y/g' .config
cd /lib/arm-linux-gnueabihf
sudo ln -s libnl-genl-3.so.200.5.2 libnl-genl.so
sudo ln -s libnl-3.so.200.5.2 libnl.so
cd ~/hostapd-2.3/hostapd
sudo apt-get -y install make
sudo make
sudo cp ~/hostapd-2.3/hostapd/hostapd /usr/sbin/hostapd
sudo cp ~/hostapd-2.3/hostapd/hostapd_cli /usr/sbin/hostapd_cli
sudo apt-get -y install iw
sudo apt-get -y install bridge-utils
sudo apt-get -y install macchanger
sudo apt-get -y install dnsmasq
sudo cp /home/pi/Raspberry-Wifi-Router/defconfig/interfaces /etc/network/interfaces
sudo chgrp www-data /etc/network/interfaces
sudo chmod g+w /etc/network/interfaces
sudo cp /home/pi/Raspberry-Wifi-Router/defconfig/dnsmasq.conf /etc/dnsmasq.conf
sudo chgrp www-data /etc/dnsmasq.conf
sudo chmod g+w /etc/dnsmasq.conf
sudo cp /home/pi/Raspberry-Wifi-Router/defconfig/hostapd.conf /etc/hostapd/hostapd.conf
sudo chgrp www-data /etc/hostapd/hostapd.conf
sudo chmod g+w /etc/hostapd/hostapd.conf
sudo /etc/init.d/hostapd start
sudo update-rc.d hostapd defaults
sudo sed -i 's/output_buffering = 4096/;output_buffering = 4096/g' /etc/php5/cgi/php.ini
sudo /etc/init.d/lighttpd force-reload
sudo chgrp www-data /etc/dhcp/dhclient.conf
sudo chmod g+w /etc/dhcp/dhclient.conf
sudo chgrp www-data /etc/ntp.conf
sudo chmod g+w /etc/ntp.conf
sudo chgrp www-data /etc/timezone
sudo chmod g+w /etc/timezone
sudo cp /home/pi/Raspberry-Wifi-Router/defconfig/routersettings.ini /var/www/routersettings.ini
sudo umount /dev/mmcblk0p1
sudo sed -i 's/\/dev\/mmcblk0p1 \/boot vfat defaults 0 2/\/dev\/mmcblk0p1 \/boot vfat rw,relatime,fmask=0000,dmask=0000,codepage=437,iocharset=ascii,shortname=mixed,errors=remount-ro 0 2/g' /etc/fstab
sudo mount /dev/mmcblk0p1
sudo touch /etc/sudoers.d/wr_commands
echo 'www-data ALL = (root) NOPASSWD: /usr/sbin/dpkg-reconfigure -f noninteractive tzdata' | sudo tee --append /etc/sudoers.d/wr_commands
echo 'www-data ALL = (root) NOPASSWD: /etc/init.d/ntp force-reload' | sudo tee --append /etc/sudoers.d/wr_commands
echo 'www-data ALL = (root) NOPASSWD: /etc/init.d/ntp stop' | sudo tee --append /etc/sudoers.d/wr_commands
echo 'www-data ALL = (root) NOPASSWD: /etc/init.d/networking restart' | sudo tee --append /etc/sudoers.d/wr_commands
echo 'www-data ALL = (root) NOPASSWD: /etc/init.d/hostapd restart' | sudo tee --append /etc/sudoers.d/wr_commands
echo 'www-data ALL = (root) NOPASSWD: /sbin/ifconfig *' | sudo tee --append /etc/sudoers.d/wr_commands
echo 'www-data ALL = (root) NOPASSWD: /sbin/brctl *' | sudo tee --append /etc/sudoers.d/wr_commands
echo 'www-data ALL = (root) NOPASSWD: /bin/rm /etc/dhcp3/dhclient-enter-hooks.d/nodnsupdate' | sudo tee --append /etc/sudoers.d/wr_commands
echo 'www-data ALL = (root) NOPASSWD: /sbin/service *' | sudo tee --append /etc/sudoers.d/wr_commands
echo 'www-data ALL = (root) NOPASSWD: /sbin/ifdown *' | sudo tee --append /etc/sudoers.d/wr_commands
echo 'www-data ALL = (root) NOPASSWD: /sbin/ifup *' | sudo tee --append /etc/sudoers.d/wr_commands
echo 'www-data ALL = (root) NOPASSWD: /bin/chown root /etc/dhcp3/dhclient-enter-hooks.d/nodnsupdate' | sudo tee --append /etc/sudoers.d/wr_commands
echo 'www-data ALL = (root) NOPASSWD: /bin/chmod +x /etc/dhcp3/dhclient-enter-hooks.d/nodnsupdate' | sudo tee --append /etc/sudoers.d/wr_commands
echo 'www-data ALL = (root) NOPASSWD: /usr/bin/macchanger' | sudo tee --append /etc/sudoers.d/wr_commands
echo 'www-data ALL = (root) NOPASSWD: /sbin/sysctl -w net.ipv4.ip_forward=1' | sudo tee --append /etc/sudoers.d/wr_commands
echo 'www-data ALL = (root) NOPASSWD: /sbin/sysctl enable dnsmasq' | sudo tee --append /etc/sudoers.d/wr_commands
echo 'www-data ALL = (root) NOPASSWD: /sbin/sysctl disable dnsmasq' | sudo tee --append /etc/sudoers.d/wr_commands
echo 'www-data ALL = (root) NOPASSWD: /etc/init.d/dnsmasq' | sudo tee --append /etc/sudoers.d/wr_commands
echo 'www-data ALL = (root) NOPASSWD: /sbin/iptables' | sudo tee --append /etc/sudoers.d/wr_commands
apt-get update && apt-get dist-upgrade
