<?php
 session_start();
 include 'db.php';
 if(isset($_GET['chk_item_id']))
 {
	 $date=date('Y-m-d h:i:s');
	 $rand_num=mt_rand();
	 
	 if(isset($_SESSION['ref']))
	 {
		 
	 }else{
	 $_SESSION['ref']= $date.' '.$rand_num;
	 }
	 $chk_sql="INSERT INTO checkout(chk_item,chk_ref,chk_timing,chk_qty) VALUES ('$_GET[chk_item_id]','$_SESSION[ref]','$date',1)";
      if(mysqli_query($con,$chk_sql))
	  {
		  ?><script>window.location="buy.php";</script><?php
	  }
 }
 
if(isset($_POST['order_submit'])){
	 $name=$_POST['username'];
	 $email=$_POST['email'];
	 $contactnumber=$_POST['contactnumber'];
	 $state=$_POST['state'];
	 $deliveryaddress=$_POST['deliveryaddress'];
	 $sql="INSERT INTO orders(order_name,order_email,order_contact,order_state,order_delivery_address,order_checkout_ref,order_total,order_status,order_return_status) VALUES('$name','$email','$contactnumber','$state','$deliveryaddress','$_SESSION[ref]','$_SESSION[grandtotal]','0','0')";
	 mysqli_query($con,$sql);
 }
?>
 
<html>
<head>
<title>buy</title>
<link rel="stylesheet" href="css/bootstrap.css">
<link rel="stylesheet" href="css/style1.css">
<link rel="stylesheet" href="css/lightbox.css">
<link rel="stylesheet" href="css/font-awesome.css">
<script src="js/jquery.js"></script>
<script src="js/lightbox.js"></script>
<script src="js/bootstrap.js"></script>
<script>
function func(){
        xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function (){
					if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
						document.getElementById('get_data').innerHTML = xmlhttp.responseText;
					}
				}
				xmlhttp.open('GET', 'buy_process.php', true);
				xmlhttp.send();
			}
			
		function del_func(chk_id){
        xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function (){
					if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
						document.getElementById('get_data').innerHTML = xmlhttp.responseText;
					}
				}
				xmlhttp.open('GET', 'buy_process.php?chk_del_id='+chk_id, true);
				xmlhttp.send();
			}
			
			function up_chk_qty(chk_qty,chk_id){
        xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function (){
					if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
						document.getElementById('get_data').innerHTML = xmlhttp.responseText;
					}
				}
				xmlhttp.open('GET', 'buy_process.php?up_chk_qty='+chk_qty+'&up_chk_id='+chk_id, true);
				xmlhttp.send();
			}


</script>
</head>
<body onload="func();">
<?php include 'header.php';?>
<div class="container">
<div class="page-header">
<h3 class="pull-left">Check Out</h3>
</div>
<div class="pull-right" ><button class="btn btn-success" data-backdrop="static" data-target="#procced_modal" data-toggle="modal" >Procced</button>

<div class="modal fade" id="procced_modal">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button class=" close" data-dismiss="modal">&times;</button>
<h3>Add Details</h3>
</div>
<div class="modal-body">
<form method="post" >
<div class="form-group">
<label>Name</label>
<input type="text" id="name" name="username" class="form-control" required>
</div>
<div class="form-group">
<label>Email</label>
<input type="email" id="email" name="email"class="form-control" required>
</div>
<div class="form-group">
<label>Contact_number</label>
<input type="contactnumber" id="contactnumber"  name="contactnumber" class="form-control" required>
</div>
<div class="form-group">
<label for="state">City</label>
<input list="area" name="state" class="form-control" required>
<datalist id="area">
<option>LB nager</option>
<option>SR nager</option>
<option>Hightech city</option>
</datalist>
</div>
<div class="form-group">
<label>Delivery Address</label>
<input type="text" id="deliveryaddress" name="deliveryaddress" class="form-control">
</div>
<div class="form-group">
<button class="btn btn-success btn-block" name="order_submit" class="form-control" >submit</button>
</div>
</form>
</div>
<div class="modal-header">
<div class="text-right">
<button class="btn btn-danger" data-dismiss="modal">colse</button>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="clearfix"></div>
<br><br>
<div class="panel panel-default">
<div class="panel-heading" style="text-align:center;"><b>order Details</b></div>
<div class="panel-body">
<div id="get_data">
</div>
</div>
</div>
</div>
</body>
</html>
