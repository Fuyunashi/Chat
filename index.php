<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
</head>
<body>

<h1>ログイン</h1>
<form action="chat.php">
	ID:<input type="text" name="uname" value="<?= $_COOKIE['id'] ?>"><br>
	PW:<input type="password" name="pw"><br>
	<button>ログイン</button>
</form>

</body>
</html>
