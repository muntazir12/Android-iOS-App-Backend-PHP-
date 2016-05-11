<?php

// Connect to MySQL
    $username = "root"; 
    $password = "muntazir1994"; 
    $host = "localhost:3306"; 
    $dbname = "android_api"; 
try {
$conn = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8", $username, $password);
//$conn = new PDO('mysql:host=localhost;dbname=test', 'root', '');
}
catch(PDOException $ex) 
    { 
        $msg = "Failed to connect to the database"; 
    } 
    
// Was the form submitted?
if (isset($_POST["ResetPasswordForm"]))
{
	// Gather the post data
	$email = $_POST["email"];
	$password = $_POST["password"];
	$confirmpassword = $_POST["confirmpassword"];
	$hash = $_POST["q"];

	// Use the same salt from the forgot_password.php file
	$salt = "498#2D83B631%3800EBD!801600D*7E3CC13";

	// Generate the reset key
	$resetkey = hash('sha512', $salt.$email);

	// Does the new reset key match the old one?
	if ($resetkey == $hash)
	{
		if ($password == $confirmpassword)
		{
			//has and secure the password
			$salt = sha1(rand());
        		$salt = substr($salt, 0, 10);
			$encrypted = base64_encode(sha1($password . $salt, true) . $salt);
        		$hash = array("salt" => $salt, "encrypted" => $encrypted);
			//next step
			$password = $hash["encrypted"];
			$salt = $hash["salt"]; // salt

			// Update the user's password
				$query = $conn->prepare('UPDATE users SET encrypted_password = :password, salt = :salt WHERE email = :email');
				$query->bindParam(':password', $password);
				$query->bindParam(':salt', $salt);
				$query->bindParam(':email', $email);
				$query->execute();
				$conn = null;
			echo "Your password has been successfully reset.";
		}
		else
			echo "Your password's do not match.";
	}
	else
		echo "Your password reset key is invalid.";
}

?>
