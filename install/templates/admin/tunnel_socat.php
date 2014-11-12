#!/usr/bin/php-cli
<?php
$par  =  "p:";     
$options = getopt($par);
$port = trim($options["p"]);

do{
  $par="pgrep -f $port:127.0.0.1:$port";
  $i = shell_exec($par);
                                        
  if($i){
  	stream_set_blocking(STDIN, 1);
  	$string = file_get_contents("/root/admin/applconfig");
  	$config=json_decode($string,true);
  	
  	                                                                     
        $username=$config["username"];                                       
        $password=$config["password"];                                       
        $dataport=$config["dataport"];                                       
        $apiport=$config["apiport"];                                         
        $apihost=$config["apihost"];                                         
        $sshhost=$config["sshhost"];                                         
        $sshport=$config["sshport"];                                         
        $DEV=$config["DEV"];                                                 
        $BAUD=$config["BAUD"];                               
                                                          
        $par="/root/admin/tunnel.sh $port $username $sshhost $sshport /root/id_dsa";
        exec($par);                                                                   
        
    	die;
  }
  echo "sleep 1\n";
  sleep(1);
} while(true);

