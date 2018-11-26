<?php
require("lib.php");
$result = [];

/**
 * MySQLに接続しデータを取得する
 *
 */
// 実行したいSQL
$sql = 'SELECT * FROM Monster';
//-------------------------------------------------
//SQLを実行
//-------------------------------------------------
$dbh = connectDB();                 //接続
$sth = $dbh->prepare($sql);         //SQL準備
$sth->execute();                    //実行
//取得した内容を表示する
while(true){
    //ここで1レコード取得
    $buff = $sth->fetch(PDO::FETCH_ASSOC);
    if( $buff === false ){
        break;    //データがもう存在しない場合はループを抜ける
    }
    // 表示
    $result[] = [
		  "name"    => $buff["name"]
		, "message" => $buff["message"]
		, "time"    => $buff["time"]
	];
};

echo json_encode($result);
