<?php

include("config.php");

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

?>
