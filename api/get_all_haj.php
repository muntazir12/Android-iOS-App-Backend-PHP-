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
$result = mysql_query("SELECT *FROM haj") or die(mysql_error());
 
// check for empty result
if (mysql_num_rows($result) > 0) {
    // looping through all results
    // products node
    $response["haj"] = array();
 
    while ($row = mysql_fetch_array($result)) {
        // temp user array
        $haj = array();
        $haj["pid"] = $row["pid"];
        $haj["email"] = $row["email"];
        $haj["name"] = $row["name"];
        $haj["age"] = $row["age"];
        $haj["gender"] = $row["gender"];
        $haj["family"] = $row["family"];
        $haj["country"] = $row["country"];
        $haj["dependent"] = $row["dependent"];
        $haj["created_at"] = $row["created_at"];
        $haj["updated_at"] = $row["updated_at"];
 

 
        // push single product into final response array
        array_push($response["haj"], $haj);
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
