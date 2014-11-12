#!/usr/bin/php-cli
<?php
$string = file_get_contents("/root/admin/applconfig");
$config=json_decode($string,true);

                                    
$username=$config["username"];
$password=$config["password"];
$dataport=$config["dataport"];
$apiport=$config["apiport"];
$apihost=$config["apihost"];
$sshhost=$config["apihost"];
$sshport=$config["sshport"];
$DEV=$config["DEV"];
$BAUD=$config["BAUD"];

$par="/root/admin/tunnel_api.php -p$apiport &";
exec($par);

$par="/root/admin/tunnel_socat.php -p$dataport &";
exec($par);


