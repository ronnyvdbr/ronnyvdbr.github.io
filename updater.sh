apt-get -y install rpi-update
rpi-update
sed -i 's/\n//g' /etc/rc.local

sed -i "15i /" Makefile.txt
