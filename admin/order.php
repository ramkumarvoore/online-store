
<?php include 'db.php'; ?>
<html>
	<head>
<title>Learn jQuery By Shahzaib Kamal and Joe Parys</title>
<link rel="stylesheet" href="css/bootstrap.css">
<link rel="stylesheet" href="admin_style.css">
<link rel="stylesheet" href="css/lightbox.css">
<link rel="stylesheet" href="css/font-awesome.css">
<script src="js/jquery.js"></script>
<script src="js/lightbox.js"></script>
<script src="js/bootstrap.js"></script>	
<script>
 function order_func(){
	  var xmlhttp= new XMLHttpRequest();
	  xmlhttp.onreadystatechange=function(){
	 if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
						document.getElementById('get_data').innerHTML = xmlhttp.responseText;
					}
	  
	  }
	  xmlhttp.open('GET', 'orderphp.php', true);
      xmlhttp.send();
	 
 }
 
 function order_status(order_status,order_id){
	 if(order_status==1){
		 order_status=0;
	 }else
	 {
		 order_status=1;
	 }
	  var xmlhttp= new XMLHttpRequest();
	  xmlhttp.onreadystatechange=function(){
	 if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
						document.getElementById('get_data').innerHTML = xmlhttp.responseText;
					}
	  
	  }
	  xmlhttp.open('GET', 'orderphp.php?order_status='+order_status+'&order_id='+order_id, true);
      xmlhttp.send();
	 
 }
 
 function order_return_status(order_return_status,order_id){
	 if(order_return_status==1){
		 order_return_status=0;
	 }else
	 {
		 order_return_status=1;
	 }
	  var xmlhttp= new XMLHttpRequest();
	  xmlhttp.onreadystatechange=function(){
	 if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
						document.getElementById('get_data').innerHTML = xmlhttp.responseText;
					}
	  
	  }
	  xmlhttp.open('GET', 'orderphp.php?order_return_status='+order_return_status+'&order_id='+order_id, true);
      xmlhttp.send();
	 
 }
</script>
</head>
<body onload="order_func();">
<body onload="admin_func();">
	<?php include "header.php";?>
	<div class="container-fluid">
	<div id="get_data">
	
	</div>
	   </div>
</body>
</html>