<?php
ini_set('display_errors',1);
error_reporting(-1);
require 'config.php';
if(isset($_POST['login'])) {
	$username = $_POST['username'];
	$pwd = $_POST['pwd'];
	$sql = "SELECT * FROM manageuser";
	$resultset = pg_query($conn, $sql);
	$users = pg_fetch_array($resultset);
	foreach($users as $user) {
		if(($username === 'admin') && 
			($pwd === 'admin')) {
			header('Location: manage.php');
		}
		elseif(($user['manager'] == $username) && 
			($user['pwd'] == $pwd)) {
			$id = $user['id'];
			header('location: view.php?view='.$id);
		}
	}
}
?>    
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Page</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <form method="post">
        <div class="login-box">
            <h1>Login</h1>
            <div class="input-group">
                <input type="text" placeholder="Username" name="username">
            </div>

            <div class="input-group">
                <input type="password" placeholder="Password" name="pwd">
            </div>

            <input class="button" type="submit" name="login" value="Log In">
        </div>
    </form>
</body>
 
</html>
