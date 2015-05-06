sudo sed -i 's/deb http:\/\/mirrordirector.raspbian.org\/raspbian wheezy main firmware/deb http:\/\/archive.raspbian.org\/raspbian wheezy main contrib non-free/g' /etc/apt/sources.list
apt-get update
sudo apt-get -y install debhelper libcurl4-gnutls-dev
echo 'mysql-server mysql-server/root_password password raspberry' | debconf-set-selections
echo 'mysql-server mysql-server/root_password_again password raspberry' | debconf-set-selections
sudo apt-get -y install mysql-server
sudo apt-get -y install php5-mysql
sudo apt-get -y install freeradius freeradius-mysql
update-rc.d mysql defaults
echo 'create database radius;' | mysql --host=localhost --user=root --password=raspberry
mysql --host=localhost --user=root --password=raspberry radius < /etc/freeradius/sql/mysql/schema.sql
mysql --host=localhost --user=root --password=raspberry radius < /etc/freeradius/sql/mysql/admin.sql
echo "insert into radcheck (username, attribute, op, value) values ('user', 'Cleartext-Password', ':=', 'password');" | mysql --host=localhost --user=root --password=raspberry radius
sudo sed -i 's/#[[:space:]]$INCLUDE sql.conf/$INCLUDE sql.conf/g' /etc/freeradius/radiusd.conf
sudo cp /home/pi/Raspberry-Wifi-Router/defconfig/sites-available-default /etc/freeradius/sites-available/default
/etc/init.d/freeradius restart
cd /usr/src
wget http://ap.coova.org/chilli/coova-chilli-1.3.0.tar.gz
tar xzf coova-chilli-1.3.0.tar.gz
cd coova-chilli-1.3.0
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
sed -i 's/$(MAKE) DESTDIR=$(CURDIR)\/debian\/tmp install/$(MAKE) DESTDIR=\/ install/g' /usr/src/coova-chilli-1.3.0/debian/rules
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
reboot








