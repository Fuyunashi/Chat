<?php
$uname = $_POST["uname"];
$msg   = $_POST["msg"];
$time  = time();

$fp = fopen("data.txt", "a");
flock($fp, LOCK_EX);
fwrite($fp, $uname."\t".$msg."\t".$time."\n");
flock($fp, LOCK_UN);
fclose($fp);

echo json_encode([
	"status"=>true
]);
