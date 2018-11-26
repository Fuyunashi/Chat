<?php
$result = [];

$fp = fopen("data.txt", "r");
while( ($buff=fgets($fp)) != false ){
	$line = explode("\t", $buff);
	$result[] = [
		  "name"    => $line[0]
		, "message" => $line[1]
		, "time"    => $line[2]
	];
}
fclose($fp);

echo json_encode($result);
