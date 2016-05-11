<?php
 
/*
 * Following code will get single product details
 * A product is identified by product id (pid)
 */
 
// array for JSON response
$response = array();
 
// include db connect class
require_once __DIR__ . '/db_connect.php';
 
// connecting to db
$db = new DB_CONNECT();
 
// check for post data
if (isset($_GET["pid"])) {
    $pid = $_GET['pid'];
 
    // get a product from haj table
    $result = mysql_query("SELECT *FROM message WHERE pid = $pid");
 
    if (!empty($result)) {
        // check for empty result
        if (mysql_num_rows($result) > 0) {
 
            $result = mysql_fetch_array($result);
 
            $message = array();
            $message["pid"] = $result["pid"];
            $message["remail"] = $result["remail"];
            $message["rname"] = $result["rname"];
	    $message["semail"] = $result["semail"];
            $message["sname"] = $result["sname"];
	    $message["rtable"] = $result["rtable"];
            $message["rpid"] = $result["rpid"];
	    $message["message"] = $result["message"];
           
            $message["created_at"] = $result["created_at"];
            $message["updated_at"] = $result["updated_at"];
            // success
            $response["success"] = 1;
 
            // user node
            $response["message"] = array();
 
            array_push($response["message"], $message);
 
            // echoing JSON response
            echo json_encode($response);
        } else {
            // no product found
            $response["success"] = 0;
            $response["message"] = "No item found";
 
            // echo no users JSON
            echo json_encode($response);
        }
    } else {
        // no product found
        $response["success"] = 0;
        $response["message"] = "No item found";
 
        // echo no users JSON
        echo json_encode($response);
    }
} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";
 
    // echoing JSON response
    echo json_encode($response);
}
?>