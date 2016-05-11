<?php
 
/*
 * Following code will list all the products
 */
 
// array for JSON response
$response = array();
 
// include db connect class
require_once __DIR__ . '/db_connect.php';
 
// connecting to db
$db = new DB_CONNECT();
 
// get all products from products table
$result = mysql_query("SELECT *FROM message") or die(mysql_error());
 
// check for empty result
if (mysql_num_rows($result) > 0) {
    // looping through all results
    // products node
    $response["message"] = array();
 
    while ($row = mysql_fetch_array($result)) {
        // temp user array
        $message = array();
        $message["pid"] = $row["pid"];
        $message["remail"] = $row["remail"];
        $message["sname"] = $row["sname"];
        $message["rname"] = $row["rname"];
        $message["semail"] = $row["semail"];
        $message["message"] = $row["message"];
        $message["rpid"] = $row["rpid"];
        $message["rtable"] = $row["rtable"];
        $message["created_at"] = $row["created_at"];
        $message["updated_at"] = $row["updated_at"];
 

 
        // push single product into final response array
        array_push($response["message"], $message);
    }
    // success
    $response["success"] = 1;
 
    // echoing JSON response
    echo json_encode($response);
} else {
    // no products found
    $response["success"] = 0;
    $response["message"] = "No Request found";
 
    // echo no users JSON
    echo json_encode($response);
}
?>
