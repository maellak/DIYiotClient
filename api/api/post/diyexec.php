<?php

//header("Content-Type: text/html; charset=utf-8");

function diyexec() {
   
    global $app;

    $result = array();  

    $result["data"] = array();
    $result["controller"] = __FUNCTION__;
    $result["function"] = substr($app->request()->getPathInfo(),1);
    $result["method"] = $app->request()->getMethod();
    $params = loadParameters();
    $exec = $params["exec"];
    $diyexec = base64_decode($exec);
    $result["diyexec"] = $diyexec;
    try {
	$result["params"] = $params;
        exec("$diyexec 2>&1", $output, $return_var);

       	$result["result"] = $output;
        $result["status"] = "ok";
        $result["message"] = "[".$result["method"]."][".$result["function"]."]: NoErrors";
    } catch (Exception $e) {
        $result["status"] = "error";
        $result["message"] = "[".$result["method"]."][".$result["function"]."]:".$e->getMessage();
    } 
    return $result;
}

?>
