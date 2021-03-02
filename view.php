<?php
include("config.php");
session_start();	
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Store data</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<?php
	if(isset($_GET['id'])){
		$product = $_GET['product'];
		$id = $_GET['id'];
		$query = $connection->prepare("SELECT * FROM storedata WHERE product=:product AND id=:id");
		$query->bindParam("product", $product, PDO::PARAM_INT);
		$query->bindParam("id", $id, PDO::PARAM_INT);
		$query->execute();
		$result = $query->fetch(PDO::FETCH_ASSOC);
		$product = $result['product'];
		$amount = $result['amount'];
		$profit = $result['profit'];
	}
	?>
	<div class="table-wrapper">
		<div class="table-title">
			<h1>Manage <b>Store</b></h1>
		</div>
		<?php if (isset($_SESSION['message'])): ?>
		<div class="msg">
			<?php 
				echo $_SESSION['message']; 
				unset($_SESSION['message']);
			?>
		</div>
		<?php endif ?>
			<table>
				<thead>
					<tr>
						<th>No.</th>
						<th>PRODUCT</th>
						<th>AMOUNT</th>
						<th>PROFIT</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$GLOBALS['id'] = $_SESSION['ID'];
						$query = $connection->prepare("SELECT * FROM storedata WHERE id=:id");
						$query->bindParam("id", $id, PDO::PARAM_INT);
						$query->execute();
						$index = 1;
						while ($row = $query->fetch(PDO::FETCH_ASSOC)) { ?>
							<tr>
								<td><?php echo $index++; ?></td>
								<td><?php echo $row['product']; ?></td>
								<td><?php echo $row['amount']; ?></td>
								<td><?php echo $row['profit']; ?></td>
								<td><a href="view.php?product=<?php echo $row['product']; ?>&id=<?php echo $row['id']; ?>" class="edit_btn" >Edit</a></td>
							</tr>
					<?php } ?>
				</tbody>
			</table>
			<form method="post" action="server.php" >
				<input type="hidden" name="id" value="<?php echo $id; ?>">
				<div class="input-group">
					<label>PRODUCT</label>
					<input type="text" name="product" value="<?php echo $product; ?>">
				</div>
				<div class="input-group">
					<label>AMOUNT</label>
					<input type="text" name="amount" value="<?php echo $amount; ?>">
				</div>
				<div class="input-group">
					<label>PROFIT</label>
					<input type="text" name="profit" value="<?php echo $profit; ?>">
				</div>
				<button class="btn" type="submit" name="Updatedata" style="background: #556B2F;" >Update</button>
			</form>
		</div>
	</div>
</body>
</html>
