<?php
include("config.php");

if(isset($_GET['Edit'])){
	global $id;
	$product = $_GET['Edit'];
	$sql = $connection->prepare("SELECT * FROM storedata WHERE product=:product AND id=:id");
	$sql->bindParam("product", $product, PDO::PARAM_STR);
	$sql->bindParam("id", $id, PDO::PARAM_INT);
	$sql->execute();
	$result = $query->fetch(PDO::FETCH_ASSOC);
	$product = $result['product'];
	$amount = $result['amount'];
	$profit = $result['profit'];
}?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Store data</title>
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
	<div class="container">
	<p id="success"></p>
		<div class="table-wrapper">
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
						$id = $_GET['view'];
						$query = $connection->prepare("SELECT * FROM storedata WHERE id=:id");
						$query->bindParam("id", $id, PDO::PARAM_INT);
        					$query->execute();
				
						$index = 0;
				
						while($result = $query->fetch(PDO::FETCH_ASSOC);) {
						echo '<tr>
								<td>'.($index++).'</td>
								<td>'.$row['product'].'</td>
								<td>'.$row['amount'].'</td>
								<td>'.$row['profit'].'</td>
								<td><a href="view.php?Edit=<?php echo $row['product']; ?>" class="edit_btn" >Edit</a></td>
							</tr>';
						}
					?>
				</tbody>
			</table>
			<form method="post" action="server.php" >
            //newly added field
				<input type="hidden" name="id" value="<?php echo $id; ?>">
			//modified form fields
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
		<button class="btn" onclick="goBack()">Back</button>
		<script>
		function goBack() {
			window.history.go(-1);
		}
		</script>
	</div>
</body>
</html>
