<?php
include("config.php");
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

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>User Data</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
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
						<th>ACTION</th>
					</tr>
				</thead>
				<tbody>
					<?php
					include("server.php");
					$query = $connection->prepare("SELECT * FROM manageuser");
					$query->execute();
					$index = 1;
					
					while($row = $query->fetch(PDO::FETCH_ASSOC)) {
					echo '<tr>
							<td>'.($index++).'</td>
							<td>'.$row['id'].'</td>
							<td>'.$row['manager'].'</td>
							<td>'.$row['pwd'].'</td>
							<td>'.$row['email'].'</td>
							<td>'.$row['andress'].'</td>
							<td><a href="view.php?view=<?php echo $row['id']; ?>" class="view_btn" >View</a></td>
							<td><a href="manage.php?edit=<?php echo $row['id']; ?>" class="edit_btn" >Edit</a></td>
							<td><a href="server.php?del=<?php echo $row['id']; ?>" class="del_btn">Delete</a></td>
						</tr>';
					}
					?>
				</tbody>
			</table>			
		</div>
</body>
</html>
