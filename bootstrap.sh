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
sh /home/pi/Raspberry-Wifi-Router/installer.sh
sh /home/pi/Raspberry-Wifi-Router/chillispot.sh
sh /home/pi/Raspberry-Wifi-Router/login_database.sh
sh /home/pi/Raspberry-Wifi-Router/openvpn.sh
