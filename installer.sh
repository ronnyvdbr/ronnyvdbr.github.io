rm /etc/ssh/ssh_host_* && dpkg-reconfigure openssh-server
echo 'root:raspberry'|chpasswd
echo "Europe/Dublin" > /etc/timezone    
dpkg-reconfigure -f noninteractive tzdata
sed -i "s/# en_US.UTF-8 UTF-8/en_US.UTF-8 UTF-8/g" /etc/locale.gen
/usr/sbin/locale-gen
apt-get -y install sudo
sudo apt-get -y install lighttpd php5-common php5-cgi php5
sudo lighty-enable-mod fastcgi-php
sudo rm -R /var/www
sudo ln -s /home/pi/Raspberry-Wifi-Router/www /var/www
sudo chown pi:www-data /var/www
sudo chown -R pi:www-data /home/pi/Raspberry-Wifi-Router/www
sudo chmod g+w /home/pi/Raspberry-Wifi-Router/www/routersettings.ini
sudo chmod 775 /var/www
sudo usermod -a -G www-data pi
sudo sed -i 's/"index.php", "index.html", "index.lighttpd.html"/"home.php"/g' /etc/lighttpd/lighttpd.conf
sudo /etc/init.d/lighttpd force-reload
apt-get -y install wireless-tools hostapd
sudo sed -i 's/DAEMON_CONF=/DAEMON_CONF=\/etc\/hostapd\/hostapd.conf/g' /etc/init.d/hostapd
sudo apt-get -y install libnl-3-dev
sudo apt-get -y install libnl-genl-3-dev
sudo apt-get -y install libssl-dev
wget -O /root/hostapd-2.5.tar.gz http://w1.fi/releases/hostapd-2.5.tar.gz
tar -zxvf /root/hostapd-2.5.tar.gz -C /root
cd /root/hostapd-2.5/hostapd
cp defconfig .config
sed -i 's/#CONFIG_LIBNL32=y/CONFIG_LIBNL32=y/g' .config
sed -i 's/#CFLAGS += -I$<path to libnl include files>/CFLAGS += -I\/usr\/include\/libnl3/g' .config
sed -i 's/#LIBS += -L$<path to libnl library files>/LIBS += -L\/lib\/arm-linux-gnueabihf/g' .config
sed -i 's/#CONFIG_IEEE80211N=y/CONFIG_IEEE80211N=y/g' .config
cd /lib/arm-linux-gnueabihf
sudo ln -s libnl-genl-3.so.200.5.2 libnl-genl.so
sudo ln -s libnl-3.so.200.5.2 libnl.so
cd /root/hostapd-2.5/hostapd
sudo apt-get -y install build-essential pkg-config
sudo make
sudo cp /root/hostapd-2.5/hostapd/hostapd /usr/sbin/hostapd
sudo cp /root/hostapd-2.5/hostapd/hostapd_cli /usr/sbin/hostapd_cli
sudo apt-get -y install iw
sudo apt-get -y install bridge-utils
sudo DEBIAN_FRONTEND=noninteractive apt-get -y install macchanger
sudo apt-get -y install dnsmasq
sudo apt-get -y install iptables
sudo cp /home/pi/Raspberry-Wifi-Router/defconfig/wr_commands /etc/sudoers.d/wr_commands
sudo chmod 644 /etc/sudoers.d/wr_commands
