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
$result = mysql_query("SELECT *FROM umrah") or die(mysql_error());
 
// check for empty result
if (mysql_num_rows($result) > 0) {
    // looping through all results
    // products node
    $response["umrah"] = array();
 
    while ($row = mysql_fetch_array($result)) {
        // temp user array
        $umrah = array();
        $umrah["pid"] = $row["pid"];
        $umrah["email"] = $row["email"];
        $umrah["name"] = $row["name"];
        $umrah["age"] = $row["age"];
        $umrah["gender"] = $row["gender"];
        $umrah["family"] = $row["family"];
        $umrah["country"] = $row["country"];
        $umrah["dependent"] = $row["dependent"];
        $umrah["created_at"] = $row["created_at"];
        $umrah["updated_at"] = $row["updated_at"];
 

 
        // push single product into final response array
        array_push($response["umrah"], $umrah);
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
