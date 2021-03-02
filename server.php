<?php
include("config.php");
session_start();

$manager = $password = $email = $andress = $product = "";
$id = $amount = $profit = 0;
$update = false;

if(isset($_GET['view'])){
	$id = $_GET['view'];
	$_SESSION['ID'] = $id;
	header("location: server.php");
	exit;
}

if(isset($_SESSION['ID'])){
	$id = $_SESSION['ID'];
	$query = $connection->prepare("SELECT * FROM storedata WHERE id=:id");
	$query->bindParam("id", $id, PDO::PARAM_INT);
	$query->execute();
	header("location: view.php");
	exit;
}

if(isset($_POST['Updatedata'])){
	$id = $_POST['Updatedata'];
	$product = $_POST['product'];
	$amount = $_POST['amount'];
	$profit = $_POST['profit'];
	$sql = "UPDATE storedata SET amount = ?, profit = ? WHERE id = ? AND product = ?";
	$connection->prepare($sql)->execute([$amount, $profit, $id, $product]);
	$_SESSION['message'] = "Table updated";
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
	$_SESSION['message'] = "Address saved"; 
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
