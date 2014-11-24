<?php
//echo getcwd();
$string = file_get_contents("./applconfig");
$config=json_decode($string,true);

$username=$config["username"];
$password=$config["password"];
$apihost=$config["apihost"];

var_dump($config);

/** show all errors! */
ini_set('display_errors', 1);
error_reporting(E_ALL);

$data="grant_type=client_credentials&client_id=".$username."&client_secret=".$password;
$ch = curl_init();
curl_setopt ($ch, CURLOPT_URL,"$apihost/api/token");
curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt ($ch, CURLOPT_TIMEOUT, 60);
curl_setopt ($ch, CURLOPT_USERPWD, "$username:$password");
curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt ($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt ($ch, CURLOPT_POST, 1);
$curlResponse = curl_exec ($ch);
curl_close($ch);
$curlResponse = json_decode($curlResponse, TRUE);
$data = 'access_token='.$curlResponse['access_token'];
               //  var_dump($curlResponse);
               echo $data;
$ch = curl_init();
curl_setopt ($ch, CURLOPT_URL,"$apihost/api/devinfo?".$data);
curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt ($ch, CURLOPT_TIMEOUT, 60);
curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
                      
$result = curl_exec($ch);
var_dump($result);
curl_close($ch);
$i = json_decode($result, TRUE);
//var_dump($i);
//echo "\n\ndevinfo: ";
$error=0;
$config["apiport"] =  trim($i["result"]["devinfo"][0]["apiport"]);
if ( $config["apiport"] === '' || !isset($config["apiport"]))
	$error=1;
	
$config["dataport"] =  trim($i["result"]["devinfo"][0]["dataport"]);
if ( $config["dataport"] === '' || !isset($config["dataport"]))
	$error=1;
	
$config["sshhost"] =  trim($i["result"]["devinfo"][0]["sshhost"]);
if ( $config["sshhost"] === '' || !isset($config["sshhost"]))
	$error=1;

$config["sshport"] =  trim($i["result"]["devinfo"][0]["sshport"]);
if ( $config["sshport"] === '' || !isset($config["sshport"]))
	$error=1;

$config["apihost"] =  trim($i["result"]["devinfo"][0]["apihost"]);
if ( $config["apihost"] === '' || !isset($config["apihost"]))
	$error=1;

$config["DEV"] =  trim($i["result"]["devinfo"][0]["tty"]);
if ( $config["DEV"] === '' || !isset($config["DEV"]))
	$error=1;


$config["BAUD"] =  trim($i["result"]["devinfo"][0]["baud"]);
if ( $config["BAUD"] === '' || !isset($config["BAUD"]))
	$error=1;

$config["key"] =  trim($i["result"]["devinfo"]["key"]);
if ( $config["key"] === '' || !isset($config["key"]))
	$error=1;
var_dump($config);
if($error == 1)
{
	$errorlog = json_encode((array) $config);
	echo "\n\n\n\n\n";
	$action="$apihost/api/devinfo";	
	$data .= '&deverror='.$errorlog.'&action='.$action;
	echo $data;
	$ch = curl_init();
	curl_setopt ($ch, CURLOPT_URL,"$apihost/api/deverror");
	curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt ($ch, CURLOPT_TIMEOUT, 60);
	curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt ($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt ($ch, CURLOPT_POST, 1);
                      
	$result1 = curl_exec($ch);
	curl_close($ch);
	$i1 = json_decode($result1, TRUE);
var_dump($i1);
}else{
$json_data = json_encode((array) $config, JSON_PRETTY_PRINT);
file_put_contents('applconfig', $json_data);
file_put_contents('/root/admin/applconfig', $json_data);
file_put_contents('/root/id_dsa', $config["key"]);
exec('chmod 600 /root/id_dsa');
$BAUD=$config["BAUD"];
$DEV=$config["DEV"];
$dataport=$config["dataport"];
$apiport=$config["apiport"];
$sh = <<<EOD
#!/bin/ash
export BAUD=$BAUD
export DEV=$DEV
export dataport=$dataport
export diyiotserver=$apiport
export diyiotsocat=$dataport
EOD;

file_put_contents('/root/admin/applconfig.sh', $sh);
}
//echo " \n\n";

                        
