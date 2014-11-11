<?php



function isAlive() {
   
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
        $parameter = 'datenow=`date +%s`; echo $datenow >> tmptmptmp';
        $output = shell_exec($parameter);
        $result["result"] = $output;
        
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