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
    $result = mysql_query("SELECT *FROM haj WHERE pid = $pid");
 
    if (!empty($result)) {
        // check for empty result
        if (mysql_num_rows($result) > 0) {
 
            $result = mysql_fetch_array($result);
 
            $haj = array();
            $haj["pid"] = $result["pid"];
            $haj["email"] = $result["email"];
            $haj["name"] = $result["name"];
            $haj["age"] = $result["age"];
            $haj["gender"] = $result["gender"];
            $haj["family"] = $result["family"];
            $haj["country"] = $result["country"];
            $haj["dependent"] = $result["dependent"];
            $haj["status"] = $result["status"];
            $haj["created_at"] = $result["created_at"];
            $haj["updated_at"] = $result["updated_at"];
            // success
            $response["success"] = 1;
 
            // user node
            $response["haj"] = array();
 
            array_push($response["haj"], $haj);
 
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