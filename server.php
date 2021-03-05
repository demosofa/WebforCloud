<?php
include("config.php");
session_start();

$manager = $password = $email = $andress = $product = "";
$id = $amount = $profit = 0;
$update = $Update = false;

if(isset($_GET['view'])){
	$_SESSION['ID'] = $_GET['view'];
	header("location: view.php");
	exit;
}

if(isset($_POST['updatedata'])){
	$id = $_POST['id'];
	$product = $_POST['product'];
	$amount = $_POST['amount'];
	$profit = $_POST['profit'];
	$sql = "UPDATE storedata SET amount = ?, profit = ? WHERE id = ? AND product = ?";
	$connection->prepare($sql)->execute([$amount, $profit, $id, $product]);
	$_SESSION['message'] = "Data updated";
 	header("location: view.php");
	exit;
}
if(isset($_POST['savedata'])){
	// khai bao value and ngan ngua van de postgresql injection
	$id = $_POST['id'];
	$product = $_POST['product'];
	$amount = $_POST['amount'];
	$profit = $_POST['profit'];
	// run query
	$sql = "INSERT INTO storedata(id, product, amount, profit) VALUES(?,?,?,?)";
	$connection->prepare($sql)->execute([$id, $product, $amount, $profit]);
	// luu message at server side and toi manage.php page
	$_SESSION['message'] = "Table saved"; 
	header("location: view.php");
	exit;
}

if(isset($_GET['delid'])){
	$id = $_GET['delid'];
	$product = $_GET['delproduct'];
	$sql = "DELETE FROM storedata WHERE id=? AND product=?";
	$connection->prepare($sql)->execute([$id, $product]);
	$_SESSION['message'] = "Data deleted";
	header("location: view.php");
	exit;
}

if(isset($_POST['save'])){
	// khai bao value and ngan ngua van de postgresql injection
	$id = $_POST['id'];
	$manager = $_POST['manager'];
	$password = $_POST['password'];
	$email = $_POST['email'];
	$andress = $_POST['andress'];
	// run query
	$sql = "INSERT INTO manageuser(id, manager, pwd, email, andress) VALUES(?,?,?,?,?)";
	$connection->prepare($sql)->execute([$id, $manager, $password, $email, $andress]);
	// luu message at server side and toi manage.php page
	$_SESSION['message'] = "Table saved"; 
	header("location: manage.php");
	exit;
}

if(isset($_POST['update'])){
	$id = $_POST['id'];
	$manager = $_POST['manager'];
	$password = $_POST['password'];
	$email = $_POST['email'];
	$andress = $_POST['andress'];
	$data = [
		'id' => $id,
		'manager' => $manager,
		'password' => $password,
		'email' => $email,
		'andress'=> $andress,
	];
	$sql = "UPDATE manageuser SET manager=:manager, pwd=:password, email=:email, andress=:andress WHERE id=:id";
	$connection->prepare($sql)->execute($data);
	$_SESSION['message'] = "Address updated!";
	header("location: manage.php");
	exit;
}

if(isset($_GET['del'])){
	$id = $_GET['del'];
	$sql = "DELETE FROM manageuser WHERE id=?";
	$connection->prepare($sql)->execute([$id]);
	$_SESSION['message'] = "Andress deleted";
	header("location: manage.php");
	exit;
}
?>
