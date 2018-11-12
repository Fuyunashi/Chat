<!DOCTYPE html>
<html>
<head>
<title>ChatRoom</title>

<style>
	h1{
		font-size: 12pt;
		border-bottom: 1px solid gray;
	}
	form{
		border: 1px solid gray;
		padding: 10px;
		margin-bottom: 15px;
	}
	.timestamp{
		color: lightgray;
		font-size: 8pt;
	}
</style>
</head>

<body>

<h1>ClosedChatRoom</h1>
<form action = "write.php">
	<input type = "text" name = "msg">
		<button>送信</button>
	</input>
</form>

<?php 
$fp = fopen("data.txt", "r");
while(($buff = fgets($fp)) != false){
	$line = explode("\t", $buff);
	echo $line[0];
	echo ": ";
	echo "<span class = \"timestamp\">".date("Y-m-d H:i:s",+- $line[1])."</span>";
	echo "<br>\n";
}
fclose($fp);

?>

</body>


</html>
