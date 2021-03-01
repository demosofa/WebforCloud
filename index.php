<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'config.php';
if(isset($_POST['login'])) {
	$username = $_POST['username'];
	$pwd = $_POST['pwd'];
	if(($username === 'admin') && ($pwd === 'admin')) {
		header('Location: manage.php');
	}
	else{
		$sql = "SELECT * FROM manageuser WHERE manager = '$username' AND pwd = '$pwd'";
		$user = pg_query($conn, $sql);
		$nums = pg_num_rows($user);
		if ($num==0) {
			echo "tên đăng nhập hoặc mật khẩu không đúng !";
		}
		else{
			$id = $user['id'];
			header('location: view.php?view='.$id);
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
