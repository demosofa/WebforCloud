<?php
$host = 'ec2-54-87-34-201.compute-1.amazonaws.com';
$dbname = 'd7drsbv5bd202n';
$user_db = 'epcqrbjgylnpjk';
$pw_db = '0ea10e0dd21c9abc5ef0106d7729dd684732a35faa5c850198558e4e2866bbd6';

$conn = pg_connect("host=$host port=5432 dbname=$dbname user=$user_db password=$pw_db");
if (!$conn) {
die("Connection failed: ".pg_connect_error());
}

$manager = $password = $email = $andress = $product = "";
$username = $pwd = "";
$id = $amount = $profit = 0;
$update = false;

if(isset($_POST['save'])){
	// khai bao value and ngan ngua van de postgresql injection
	$id = $_POST['id'];
	$manager = pg_escape_string($_POST['manager']);
	$password = pg_escape_string($_POST['password']);
	$email = pg_escape_string($_POST['email']);
	$andress = $_POST['andress'];
	// run query
	$sql = "INSERT INTO manageuser(id, manager, password, email, andress) VALUES('$id', '$manager', '$password', '$email', '$andress')";
	pg_query($conn, $sql);
	// luu message at server side and toi manage.php page
	$_SESSION['message'] = "Address saved"; 
	header('location: manage.php');
}

if(isset($_POST['update'])){
	$id = $_POST['id'];
	$manager = pg_escape_string($_POST['manager']);
	$password = pg_escape_string($_POST['password']);
	$email = pg_escape_string($_POST['email']);
	$andress = $_POST['andress'];
	$sql = "UPDATE manageuser SET manager = '$manager', password = '$password', email = '$email', andress = '$andress' WHERE id = '$id'";
	pg_query($conn, $sql);
	$_SESSION['message'] = "Address updated!";
	header('location: manage.php');
}

if(isset($_GET['del']){
 	$id = $_GET['del'];
 	$sql = "DELETE FROM manageuser WHERE id = $id";
 	pg_query($conn, $sql);
 	$_SESSION['message'] = "Andress deleted";
 	header("location: manage.php");
}

if(isset($_GET['view'])){
	$id = $_GET['view'];
	// luu user id trong cilent side and toi view.php page
	$_COOKIE['userid'] = $id;
	header('location: view.php');
}

if(isset($_POST['Updatedata'])){
	$id = $_POST['Updatedata'];
	$product = pg_escape_string($_POST['product']);
	$amount = $_POST['amount'];
	$profit = $_POST['profit'];
	$sql = "UPDATE storedata SET amount = '$amount', profit = '$profit' WHERE id = '$id' AND product = '$product'";
	pg_query($conn, $sql);
	$_SESSION['message'] = "Table updated";
 	header("location: view.php");
}

?>
