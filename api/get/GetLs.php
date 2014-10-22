<?php

header("Content-Type: text/html; charset=utf-8");

function GetLs($path) {
   
    global $app;

    $result = array();  

    $result["data"] = array();
    $result["controller"] = __FUNCTION__;
    $result["function"] = substr($app->request()->getPathInfo(),1);
    $result["method"] = $app->request()->getMethod();
    $params = loadParameters();
    
    try {
       
	$result["params"] = $params;

        //do ls 
        $parameter = 'ls -la '.$path;
        $output = shell_exec($parameter);
        $result["ls"] = $output;
        
//result_messages===============================================================      
        $result["status"] = "200";
        $result["message"] = "[".$result["method"]."][".$result["function"]."]: NoErrors";
    } catch (Exception $e) {
        $result["status"] = $e->getCode();
        $result["message"] = "[".$result["method"]."][".$result["function"]."]:".$e->getMessage();
    } 
        
    return $result;
    
}

?>