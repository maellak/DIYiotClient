<?php

header("Content-Type: text/html; charset=utf-8");
/**
*
* @SWG\Resource(
*   apiVersion="0.1",
*   swaggerVersion="2.0",
*   basePath="http://localhost:8888/api",
*   resourcePath="/ls",
*   description="Εκτελεση εντολής ls -la στον client",
*   produces="['application/json']"
* )
*/
/**
 * @SWG\Api(
 *   path="/ls",
 *   @SWG\Operation(
 *     method="GET",
 *     summary="Αναζήτηση σε κατάλογο συστήματος",
 *     notes="Επιστρέφει τον κατάλογο συστήματος",
 *     type="pathModel",
 *     nickname="find_catalog",
 *     @SWG\Parameter(
 *       name="path",
 *       description="Πληκτρολογηστε το system path",
 *       required=false,
 *       type="text",
 *       paramType="query"
 *     ),
 *     @SWG\ResponseMessage(code=200, message="Επιτυχία", responseModel="Success"),
 *     @SWG\ResponseMessage(code=500, message="Αποτυχία", responseModel="Failure")
 *   )
 * )
 *
     */ 

 /**
 *
 * @SWG\Model(
 *              id="pathModel",
 *              required="path",
 *                  @SWG\Property(name="path",type="string",description="Το path")
 * )
 */

/**
 * 
 */ 
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