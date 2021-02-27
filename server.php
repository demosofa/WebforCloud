<?php
ini_set('display_errors',1);
error_reporting(-1);

session_start();

$manager = $password = $email = $andress = $product = "";
$username = $pwd = "";
$id = $amount = $profit = 0;
$update = false;

if(isset($_POST['save'])){
	// khai bao value and ngan ngua van de postgresql injection
	$id = $_POST['id'];
	$manager = $_POST['manager'];
	$password = $_POST['password'];
	$email = $_POST['email'];
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
	$manager = $_POST['manager'];
	$password = $_POST['password'];
	$email = $_POST['email'];
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

if(isset($_POST['Updatedata'])){
	$id = $_POST['Updatedata'];
	$product = $_POST['product'];
	$amount = $_POST['amount'];
	$profit = $_POST['profit'];
	$sql = "UPDATE storedata SET amount = '$amount', profit = '$profit' WHERE id = '$id' AND product = '$product'";
	pg_query($conn, $sql);
	$_SESSION['message'] = "Table updated";
 	header("location: view.php");
}

?>
