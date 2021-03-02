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
	<?php if (isset($_SESSION['message'])): ?>
	<div class="msg">
		<?php 
			echo $_SESSION['message']; 
			unset($_SESSION['message']);
		?>
	</div>
	<div class="container">
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
						$index = 0;
						while ($row = $query->fetch(PDO::FETCH_ASSOC)) { ?>
							<tr>
								<td><?php echo $index++; ?></td>
								<td><?php echo $row['product']; ?></td>
								<td><?php echo $row['amount']; ?></td>
								<td><?php echo $row['profit']; ?></td>
								<td><a href="view.php?Edit=<?php echo $row['product']; ?>" class="edit_btn" >Edit</a></td>
							</tr>
					<?php } ?>
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
	</div>
</body>
</html>
