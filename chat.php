<?php
	setcookie("id", $_POST["id"], time()+(60*60*24*7));

	$id = $_POST["id"];
	$pw = $_POST["pw"];

?><!DOCTYPE html>
<html>
<head>
	<title>チャット</title>
	<style>
		h1{
			font-size:12pt;
			border-bottom: 1px solid gray;
			color: blue;
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

<h1>秘密のチャット</h1>
<form>
	<?php
		echo $_GET['uname'];
	?>
	<input type="hidden" id="uname" value="<?= $_GET['uname'] ?>">
	<input type="text" id="msg">
	<button type="button" id="sbmt">送信</button>
</form>

<div id="chatlog"></div>

<script>
window.onload = function(){
  auth();

  getLog();
  document.querySelector("#sbmt").addEventListener("click",function(){
      var uname = document.querySelector("#uname").value;
      var msg   = document.querySelector("#msg").value;

      var request = new XMLHttpRequest();
        request.open('POST', 'http://127.0.0.1/chat/set.php', false);
        request.onreadystatechange = function(){
		   if (request.status === 200 || request.status === 304 ) {
			  var response = request.responseText;
			  var json     = JSON.parse(response);
			
		  	  if( json["head"]["status"] === false ){
				alert("失敗しました");
				return(false);	
			  }

		     getLog();
		   }
		  else if(request.status >= 500){
			 alert("ServerError");
		  }
	    };

       request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

		//禁則処理
		if(msg == "fuck" || msg == "Fuck" || msg == "FUCK" || msg == "Fuck" ||
		   msg == "suck" || msg == "Suck" || msg == "SUCK" || msg == "タヒネ"||
		   msg == "fucker" || msg == "Fucker" || msg == "FUCKER" ||
			msg == "sucker" || msg == "fuckin" || msg == "Fuckin" ||
		   msg == "FUCKIN" || msg == "Sucker" || msg == "SUCKER" ||
		   msg == "死ね" || msg == "しね" || msg == "シネ" || msg == "殺す")
		{
			msg = "****";
		}
		
       request.send(
    	    "uname=" + encodeURIComponent(uname) + "&"
    	  + "msg="   + encodeURIComponent(msg)
        );
    });
};

function auth(){
  var request = new XMLHttpRequest();
  request.open('POST', 'http://127.0.0.1/chat/auth.php', false);
  request.onreadystatechange = function(){
    if (request.status === 200 || request.status === 304 ) {
      var response = request.responseText;
      var json     = JSON.parse(response);
      
      if( json["head"]["status"] === false ){
         alert("ログインに失敗しました");
         location.href = "/chat/";
       }
      else{
         alert("ログインに成功しました");
       }
     }
   };

  request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  
  request.send(
    	  "id=" + encodeURIComponent("<?php echo $id; ?>") + "&"
    	+ "pw=" + encodeURIComponent("<?php echo $pw; ?>")
  );
}

function getLog(){
	var request = new XMLHttpRequest();	
	request.open('GET', 'http://127.0.0.1/chat/get.php', false);

	request.onreadystatechange = function(){
		if (request.status === 200 || request.status === 304 ) {
			var response = request.responseText;
			var json     = JSON.parse(response);
			
			if( json["head"]["status"] === false ){
				alert("失敗しました");
				return(false);	
			}
		
			var html="";
			for(i=0; i<json["body"].length; i++){
				html += json["body"][i]["name"] +":"+ json["body"][i]["message"] + "<br>";
			}
			document.querySelector("#chatlog").innerHTML = html;
		}
		else if(request.status >= 500){
			alert("ServerError");
		}
	};
	
	request.onerror = function(e){
		console.log(e);
	};
	
	request.send();
}
</script>
</body>
</html>
