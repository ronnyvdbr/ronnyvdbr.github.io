apt-get -y install openvpn
apt-get -y install zip
mkdir /etc/openvpn/easy-rsa
cp -R /usr/share/doc/openvpn/examples/easy-rsa/2.0/* /etc/openvpn/easy-rsa
mkdir /var/www/temp/OpenVPN_ClientPackages

