<?php
 
/*
 * Following code will create a new product row
 * All product details are read from HTTP Post Request
 */
 
// array for JSON response
$response = array();
 
// check for required fields
if (isset($_POST['remail']) && isset($_POST['sname']) && isset($_POST['rname']) && isset($_POST['semail']) && isset($_POST['message']) && isset($_POST['rpid']) && isset($_POST['rtable'])) {
 
    $remail = $_POST['remail'];
    $sname = $_POST['sname'];
    $rname = $_POST['rname'];
    $semail = $_POST['semail'];
    $message = $_POST['message'];
    $rpid = $_POST['rpid'];
    $rtable = $_POST['rtable'];
    
 
    // include db connect class
    require_once __DIR__ . '/db_connect.php';
 
    // connecting to db
    $db = new DB_CONNECT();
 
    // mysql inserting a new row
    $result = mysql_query("INSERT INTO message(remail, sname, rname, semail, message, rpid, rtable) VALUES('$remail', '$sname', '$rname', '$semail', '$message', '$rpid', '$rtable')");
 
    // check if row inserted or not
    if ($result) {
        // successfully inserted into database
        $response["success"] = 1;
        $response["message"] = "Request successfully created.";
 
        // echoing JSON response
        echo json_encode($response);
    } else {
        // failed to insert row
        $response["success"] = 0;
        $response["message"] = "Oops! An error occurred.";
 
        // echoing JSON response
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