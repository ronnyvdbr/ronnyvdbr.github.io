########################################################################################
# Bootstrap - Preparing the Raspbian OS.
########################################################################################
apt-get update
apt-get -y install apt-utils
apt-get -y install git-core
useradd pi
echo 'pi:raspberry'|chpasswd
usermod -a -G sudo pi
mkdir /home/pi
git clone https://github.com/ronnyvdbr/Raspberry-Wifi-Router.git /home/pi/Raspberry-Wifi-Router
cp /root/.profile /home/pi/.profile
cp /root/.bashrc /home/pi/.bashrc
sed -i 's/pi:x:1000:1000::\/home\/pi:\/bin\/sh/pi:x:1000:1000::\/home\/pi:\/bin\/bash/g' /etc/passwd
sed -i 's/# export LS_OPTIONS=/export LS_OPTIONS=/g' /home/pi/.bashrc
sed -i 's/# eval/eval/g' /home/pi/.bashrc
sed -i "s/# alias ls=/alias ls=/g" /home/pi/.bashrc
sed -i "s/# alias ll=/alias ll=/g" /home/pi/.bashrc
sed -i "s/# alias l=/alias l=/g" /home/pi/.bashrc
chown -R pi /home/pi
chgrp -R pi /home/pi
chmod -R 755 /home/pi

########################################################################################
# Update - Making sure that your Raspbian OS is the latest version.
########################################################################################
#apt-get -y install rpi-update
#rpi-update

########################################################################################
# Installer - Install all requirements for our Wireless Router
########################################################################################
rm /etc/ssh/ssh_host_* && dpkg-reconfigure openssh-server
echo 'root:raspberry'|chpasswd
echo "Europe/Dublin" > /etc/timezone    
dpkg-reconfigure -f noninteractive tzdata
sed -i "s/# en_US.UTF-8 UTF-8/en_US.UTF-8 UTF-8/g" /etc/locale.gen
/usr/sbin/locale-gen
apt-get -y install sudo
sudo apt-get -y install firmware-ralink
sudo apt-get -y install lighttpd php5-common php5-cgi php5
sudo lighty-enable-mod fastcgi-php
sudo rm -R /var/www
sudo ln -s /home/pi/Raspberry-Wifi-Router/www /var/www
sudo chown pi:www-data /var/www
sudo chown -R pi:www-data /home/pi/Raspberry-Wifi-Router/www
sudo chmod g+w /home/pi/Raspberry-Wifi-Router/www/routersettings.ini
sudo chmod 775 /var/www
sudo usermod -a -G www-data pi
sudo sed -i 's/\/var\/www\/html/\/var\/www/g' /etc/lighttpd/lighttpd.conf
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


########################################################################################
# Chillispot - Install all requirements for our Chilli Spot
########################################################################################
sudo apt-get -y install debhelper libcurl4-gnutls-dev
echo 'mysql-server mysql-server/root_password password raspberry' | debconf-set-selections
echo 'mysql-server mysql-server/root_password_again password raspberry' | debconf-set-selections
sudo apt-get -y install mysql-server php5-mysql freeradius freeradius-mysql
update-rc.d mysql defaults
echo 'create database radius;' | mysql --host=localhost --user=root --password=raspberry
mysql --host=localhost --user=root --password=raspberry radius < /etc/freeradius/sql/mysql/schema.sql
mysql --host=localhost --user=root --password=raspberry radius < /etc/freeradius/sql/mysql/admin.sql
echo "insert into radcheck (username, attribute, op, value) values ('user', 'Cleartext-Password', ':=', 'password');" | mysql --host=localhost --user=root --password=raspberry radius
sudo sed -i 's/#[[:space:]]$INCLUDE sql.conf/$INCLUDE sql.conf/g' /etc/freeradius/radiusd.conf
sudo cp /home/pi/Raspberry-Wifi-Router/defconfig/sites-available-default /etc/freeradius/sites-available/default
/etc/init.d/freeradius restart
cd /usr/src
apt-get -y install libtool autoconf
# 64838431d536eae4a0401477f9c9175986bba775 - sha1 from git commit - 24 nov 15
git clone https://github.com/coova/coova-chilli.git
cd coova-chilli
./bootstrap
./configure  --prefix=/usr --mandir=\$${prefix}/share/man --infodir=\$${prefix}/share/info \
--sysconfdir=/etc --localstatedir=/var --enable-largelimits \
--enable-binstatusfile --enable-statusfile --enable-chilliproxy \
--enable-chilliradsec --enable-chilliredir --with-openssl --with-curl \
--with-poll --enable-dhcpopt --enable-sessgarden --enable-dnslog \
--enable-ipwhitelist --enable-redirdnsreq --enable-miniconfig \
--enable-libjson --enable-layer3 --enable-proxyvsa --enable-miniportal \
--enable-chilliscript --enable-eapol --enable-uamdomainfile \
--enable-modules --enable-multiroute
echo 9 > debian/compat
cat csed -i 's/$(MAKE) DESTDIR=$(CURDIR)\/debian\/tmp install/$(MAKE) DESTDIR=\/ install/g' /usr/src/coova-chilli-1.3.0/debian/rules
dpkg-buildpackage -us -uc
cd ..
echo N | dpkg -i /usr/src/coova-chilli_1.3.0_armhf.deb
wget http://downloads.sourceforge.net/project/haserl/haserl-devel/haserl-0.9.35.tar.gz
tar -xzf haserl-0.9.35.tar.gz
cd haserl-0.9.35
./configure
sudo make && sudo make install
sed -i 's/START_CHILLI=0/START_CHILLI=1/g' /etc/default/chilli
cp /etc/chilli/defaults /etc/chilli/config
sed -i 's/# HS_WANIF=eth0/HS_WANIF=eth0/g' /etc/chilli/config
sed -i 's/HS_LANIF=eth1/HS_LANIF=wlan0/g' /etc/chilli/config
sed -i 's/HS_DNS1=208.67.222.222/HS_DNS1=8.8.8.8/g' /etc/chilli/config
sed -i 's/HS_DNS2=208.67.220.220/HS_DNS2=8.8.4.4/g' /etc/chilli/config
echo "iptables -t nat -A POSTROUTING -o eth0 -j MASQUERADE" | tee --append /etc/chilli/up.sh
sed -i 's/haserl=$(which haserl 2>\/dev\/null)/haserl=\/usr\/local\/bin\/haserl/g' /etc/chilli/wwwsh
sudo sed -i 's/# Default-Start:  2 3 5/# Default-Start:  2 3 4 5/g' /etc/init.d/chilli
sudo sed -i 's/# Default-Stop:/# Default-Stop:  0 1 6/g' /etc/init.d/chilli
chmod o+r /etc/freeradius/sql/mysql/schema.sql
chmod o+r /etc/freeradius/sql/mysql/admin.sql


########################################################################################
# Login Database - Creating a login database and storing our user passwords
########################################################################################
echo 'create database login;' | mysql --host=localhost --user=root --password=raspberry
echo " \
CREATE TABLE users ( \
  id int(11) NOT NULL auto_increment, \
  username varchar(64) NOT NULL default '', \
  password varchar(64) NOT NULL default '', \
  PRIMARY KEY  (id) \
) ;" | mysql --host=localhost --user=root --password=raspberry --database login

echo " \
CREATE TABLE openvpnusers ( \
  id int(11) NOT NULL auto_increment, \
  openvpnservername varchar(64) NOT NULL default '', \
  username varchar(64) NOT NULL default '', \
  firstname varchar(64) NOT NULL default '', \
  lastname varchar(64) NOT NULL default '', \
  country varchar(2) NOT NULL default '', \
  province varchar(64) NOT NULL default '', \
  city varchar(64) NOT NULL default '', \
  organisation varchar(64) NOT NULL default '', \
  email varchar(64) NOT NULL default '', \
  packageurl varchar(64) NOT NULL default '', \
  PRIMARY KEY  (id) \
) ;" | mysql --host=localhost --user=root --password=raspberry --database login

echo "INSERT INTO users (username,password) VALUES('admin','raspberry');" | \
mysql --host=localhost --user=root --password=raspberry --database login

########################################################################################
# OpenVPN - Installing OpenVPN Requirements
########################################################################################
apt-get -y install openvpn
apt-get -y install zip
mkdir /etc/openvpn/easy-rsa
cp -R /usr/share/doc/openvpn/examples/easy-rsa/2.0/* /etc/openvpn/easy-rsa
mkdir /var/www/temp/OpenVPN_ClientPackages
update-rc.d -f openvpn remove
