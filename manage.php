<?php
include("config.php");
session_start();

$manager = $password = $email = $andress = $product = "";
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
	$sql = "UPDATE manageuser SET manager=:manager, pwd=:password, email=:email, andress=:andress WHERE id=:id;
	$connection->prepare($sql)->execute($data);
	$_SESSION['message'] = "Address updated!";
	header("location: manage.php");
	exit;
}

if(isset($_GET['del']){
 	$id = $_GET['del'];
 	$sql = "DELETE FROM manageuser WHERE id=?";
 	$connection->prepare($sql)->execute([$id]);
 	$_SESSION['message'] = "Andress deleted";
 	header("location: manage.php");
	exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>User Data</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<?php
	if(isset($_GET['edit'])){
		$id = $_GET['edit'];
		$update = true;
		$query = $connection->prepare("SELECT * FROM manageuser WHERE id=:id");
		$query->bindParam("id", $id, PDO::PARAM_INT);
		$query->execute();
		$result = $query->fetch(PDO::FETCH_ASSOC);
		$user = $result['manager'];
		$email = $result['email'];
		$andress = $result['andress'];
	}?>
	<?php 
	$query = $connection->prepare("SELECT * FROM manageuser");
	$query->execute();
	?>
	<?php if (isset($_SESSION['message'])): ?>
	<div class="msg">
		<?php 
			echo $_SESSION['message']; 
			unset($_SESSION['message']);
		?>
	</div>
	<?php endif ?>
		<div class="table-wrapper">
			<div class="table-title">
				<h1>Manage <b>Users</b></h1>
			</div>
			<form method="post" action="server.php" >

				<div class="input-group">
					<label>ID</label>
					<input type="text" name="id" value="<?php echo $id; ?>">
				</div>
				<div class="input-group">
					<label>USER</label>
					<input type="text" name="manager" value="<?php echo $user; ?>">
				</div>
				<div class = "input-group">
					<label>PASSWORK</label>
					<input type="password" name="password" value="<?php echo $password; ?>">
				</div>
				<div class="input-group">
					<label>EMAIL</label>
					<input type="email" name="email" value="<?php echo $email; ?>">
				</div>
				<div class = "input-group">
					<label>ANDRESS</label>
					<input type="text" name="andress" value="<?php echo $andress; ?>">
				</div>
				<div class="input-group">
					<?php if ($update == true): ?>
						<button class="btn" type="submit" name="update" style="background: #556B2F;" >update</button>
					<?php else: ?>
						<button class="btn" type="submit" name="save" >Save</button>
					<?php endif ?>
				</div>
			</form>
			<table>
				<thead>
					<tr>
						<th>No.</th>
						<th>ID</th>
						<th>USER</th>
						<th>PASSWORK</th>
						<th>EMAIL</th>
						<th>ANDRESS</th>
						<th colspan="3">ACTION</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$index = 1;
					while ($row = $query->fetch(PDO::FETCH_ASSOC)) { ?>
					<tr>
						<td><?php echo $index++; ?></td>
						<td><?php echo $row['id']; ?></td>
						<td><?php echo $row['manager']; ?></td>
						<td><?php echo $row['pwd']; ?></td>
						<td><?php echo $row['email']; ?></td>
						<td><?php echo $row['andress']; ?></td>
						<td><a href="view.php?view=<?php echo $row['id']; ?>" class="view_btn" >View</a></td>
						<td><a href="manage.php?edit=<?php echo $row['id']; ?>" class="edit_btn" >Edit</a></td>
						<td><a href="server.php?del=<?php echo $row['id']; ?>" class="del_btn">Delete</a></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>			
		</div>
	<button class="btn" onclick="goBack()">Back</button>
    	<script>
	function goBack() {
	window.history.go(-2);
	}
    	</script>
</body>
</html>
