<?php
include('config.php');
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
    <?php
	if(isset($_POST['login'])) {
		$username = pg_escape_string($_POST['username']);
		$pwd = pg_escape_string($_POST['pwd']);
		if(($username === 'admin') && ($pwd === 'admin')) {
			header('Location: manage.php');
		}
		else{
			$query = $connection->prepare("SELECT * FROM manageuser WHERE manager=:username AND pwd=:password");
        		$query->bindParam("username", $username, PDO::PARAM_STR);
			$query->bindParam("password", $pwd, PDO::PARAM_STR);
        		$query->execute();
			$result = $query->fetch(PDO::FETCH_ASSOC);
			if (!$result) {
				echo "tên đăng nhập hoặc mật khẩu không đúng !";
			}
			else{
				$id = $user['id'];
				header('location: view.php?view='.$id);
			}
		}
    	}?>
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
