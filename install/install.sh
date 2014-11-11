# First install all needed packages
# *********************************
for pkg in $(awk -F" - " '{ print $1 }' ./diyiotpackagelist) 
do 
	opkg install $pkg 
done
opkg install php5 php5-cli php5-mod-curl php5-mod-json \
kmod-usb-acm \
kmod-usb-core \
kmod-usb-hid \
kmod-usb-serial \
kmod-usb-serial-ftdi \
libusb \
libusb-1.0 

# make links and dirs
ln -s /usr/bin/php-cli /usr/bin/diyiotserver
cp -f templates/etc/rc.local /etc/rc.local
cp -f templates/etc/init.d/diyiotsocat /etc/init.d
cp -f templates/etc/init.d/diyiotserver /etc/init.d
chmod + x  /etc/init.d/diyiotserver
chmod + x  /etc/init.d/diyiotsocat
cp -f templates/etc/crontabs/root /etc/crontabs/root
chmod 600 /etc/crontabs/root

#
# connect to server
# *********************************
/usr/bin/php-cli  ./php/getconfig.php


#setting tty
# *********************************
stty -F /dev/ttyACM0   115200


