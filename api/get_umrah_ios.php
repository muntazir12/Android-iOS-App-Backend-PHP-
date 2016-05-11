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
if (isset($_POST["pid"])) {
    $pid = $_POST['pid'];
 
    // get a product from umrah table
    $result = mysql_query("SELECT *FROM umrah WHERE pid = $pid");
 
    if (!empty($result)) {
        // check for empty result
        if (mysql_num_rows($result) > 0) {
 
            $result = mysql_fetch_array($result);
 
            $umrah = array();
            $umrah["pid"] = $result["pid"];
            $umrah["email"] = $result["email"];
            $umrah["name"] = $result["name"];
            $umrah["age"] = $result["age"];
            $umrah["gender"] = $result["gender"];
            $umrah["family"] = $result["family"];
            $umrah["country"] = $result["country"];
            $umrah["dependent"] = $result["dependent"];
            $umrah["status"] = $result["status"];
            $umrah["created_at"] = $result["created_at"];
            $umrah["updated_at"] = $result["updated_at"];
            // success
            $response["success"] = 1;
 
            // user node
            $response["umrah"] = array();
 
            array_push($response["umrah"], $umrah);
 
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