<?php
session_start();
$username = $_POST['username'];
$password = $_POST['password'];
$servername = "johnny.heliohost.org";
$dbusername = "maciejko_admin";
$dbpassword = "Maciusmi1";
$dbname = "maciejko_bank";	

$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

	
	if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
	}
	$sql = "SELECT * from users where username='$username' and password='$password'";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();

	$usernamedb = $row['username'];
	$passworddb = $row['password'];

	if($usernamedb == $username && $passworddb == $password){
		$_SESSION['loggedin'] = true;
		$_SESSION['username'] = $username;
	}
	else{
		echo "Login lub haslo jest niepoprawne";
	}
	header('Location: '.'main.php');
?>
	