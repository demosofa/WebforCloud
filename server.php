<?php
define('HOST','localhost');
define('DATABASE' , 'db1656');
define('USERNAME' , 'root');
define('PASSWORD' , '');

$name = $email = $andress = "";
$id = $result = 0;
$update = false;

function exec($sql, $choice = null) {
	// tao connection toi database
	$conn = pg_connect(HOST, USERNAME, PASSWORD, DATABASE);
	if (!$conn) {
    	die("Connection failed: ".pg_connect_error());
	}
	// query
	$result = pg_query($conn, $sql);
	if($choice != null){
		return $result
	}
	// dong connection
	pg_close($conn);	
}

if(isset($_POST['save'])){
	// khai bao value and ngan ngua van de postgresql injection
	$manager = pg_escape_string($_POST['manager']);
	$password = pg_escape_string($_POST['password']);
	$email = pg_escape_string($_POST['email']);
	$andress = $_POST['andress'];
	// run query
	$sql = "INSERT INTO ManageUser(manager, password, email, andress) VALUES('$manager', '$password', '$email', '$andress')";
	excec($sql);
	// luu message at server side and toi manage.php page
	$_SESSION['message'] = "Address saved"; 
	header('location: manage.php');
}

if(isset($_POST['update'])){
	$id = $_POST['id'];
	$manager = pg_escape_string($_POST['manager']);
	$email = pg_escape_string($_POST['email']);
	$andress = $_POST['andress'];
	$sql = "UPDATE ManageUser SET id = '$id', manager = '$manager', email = '$email', andress = '$andress'";
	exec($sql);
	$_SESSION['message'] = "Address updated!";
	header('location: manage.php');
}

if(isset($_GET['del']){
 	$id = $_GET['del'];
 	$sql = "DELETE FROM ManageUser WHERE id = $id";
 	exec($sql);
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
	$sql = "UPDATE StoreData SET amount = '$amount', profit = '$profit' WHERE id = '$id' AND product = '$product'";
	exec($sql);
	$_SESSION['message'] = "Table updated";
 	header("location: view.php");
}

if(isset($_POST['login'])) {
	$username = pg_escape_string($_POST["username"]);
	$password = pg_escape_string($_POST["password"]);
	$sql = "SELECT * FROM ManageUser";
	$resultset = exec($sql,1);
	$users = pg_fetch_array($resultset);
	foreach($users as $user) {
		if(($user['username'] === 'admin') && 
			($user['password'] === 'admin')) {
			$_SESSION['message'] = "Hello admin";
			header("Location: manage.php");
		}
		elseif(($user['username'] === $username) && 
			($user['password'] === $password)) {
			$_SESSION['message'] = "Hello ".$username;
			header('location: view.php');
		}
		else{
			echo "<script language='javascript'>
					alert('WRONG INFORMATION');
				</script>";
			header("location: index.php");
		}
	}	
}
?>
