#!/usr/bin/php-cli
<?php
$par  =  "p:";     
$options = getopt($par);
$port = trim($options["p"]);

do{
$host="127.0.0.1:$port";
/** show all errors! */
ini_set('display_errors', 1);
error_reporting(E_ALL);

 $data = 'info=.';
 $ch = curl_init();
 curl_setopt ($ch, CURLOPT_URL,"$host/api/isAlivelocal?".$data);
 curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
 curl_setopt ($ch, CURLOPT_TIMEOUT, 60);
 curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 1);
 curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
        
 $result = curl_exec($ch);
 curl_close($ch);
 var_dump($result);
         
  //$output = json_encode($result);
  $result1 = json_decode($result);
 var_dump($result1);
 echo "$result1->result";
  if($result1->result == "ok"){
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

