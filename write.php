<?php 

$uname = $_GET['uname'];
$msg = $_GET["msg"];
$time = time();

$fp = fopen("data.txt", "a");
flock($fp, LOCK_EX);
fwrite($fp, $uname."\t".$msg."\n".$time."\n");
flock($fp, LOCK_UN);
fclose($fp);

header("Location: chat.php?uname = ".$uname);

?>
