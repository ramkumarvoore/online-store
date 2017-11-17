
<?php include 'db.php';?>
<html>
	<head>
<title>Learn jQuery By Shahzaib Kamal and Joe Parys</title>
<link rel="stylesheet" href="css/bootstrap.css">
<link rel="stylesheet" href="css/style1.css">
<link rel="stylesheet" href="css/lightbox.css">
<link rel="stylesheet" href="css/font-awesome.css">
<script src="js/jquery.js"></script>
<script src="js/lightbox.js"></script>
<script src="js/bootstrap.js"></script>	
	</head>
	<body>
	     <?php include 'header.php';?>
<div class="container">
 <div class="row">
		 
		 <?php
		 
		 if(isset($_GET['category'])){
		 $sql="SELECT * FROM online_shopping WHERE item_cat='$_GET[category]'";
		 $run=mysqli_query($con,$sql);
		 while($row=mysqli_fetch_assoc($run)){
			 $discount_price=$row['item_price']-$row['item_discount'];
			 $item_id=$row['item_id'];
			  $item_title=str_replace('','_',$row['item_title']);
	  echo "<div class='col-md-3'>
		   <div class='col-md-12  block nopadding'>
		   <div class='top'><img src='$row[item_img]' class='img-responsive'></div>
		   <div class='bottom'>
		   <h3 class='item-title'><a href='item.php?item_title=$item_title&item_id=$item_id'>$row[item_title]</a></h3>
		   <div class='pull-right cut_price text-muted'><del>$row[item_price]/-</del></div>
		   <div class='clearfix'></div>
		    <div class='pull-right dis_price'>$discount_price/-</div>
		   </div>
		   </div>
		   </div>";
		 }
		 }		 ?>
<div class="clearfix"></div>
</div>
</div>
	</body>
</html>
		