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
 <ol class="breadcrumb">
  <li><a href="project.php">Home</a></li>
  
  <?php
  if(isset($_GET['item_id'])){
	 $sql="SELECT * FROM online_shopping WHERE item_id='$_GET[item_id]'";
	 $run=mysqli_query($con,$sql);
		 while($row=mysqli_fetch_assoc($run)){
			 $item_cat=ucwords($row['item_cat']);
			 $item_id=$row['item_id'];
    echo " <li><a href='category.php?category=$item_cat'>$item_cat</a></li>
          <li class='active'>$row[item_title]</a></li>";
 ?>
 </ol>
 </div>
 <div class="row">
 
 <?php
 
			echo "
			    <div class='col-md-8'>
                <h3 class='pp-title'>$row[item_title]</h3>
                <img src='$row[item_img]' class='img-responsive'>
                <h4 class='pp-desc-head'>Description</h4>
                <div class='pp-desc-detail'>
                $row[item_description]
                </div>
                </div>"; 
	 
        }
    }
 
 ?>


 <aside class="col-md-4">
 
 <a href="buy.php?chk_item_id=<?php echo $item_id ;?>" class="btn btn-success buy">BUY</a><br><br><br>
 <ul class="list-group">
<li class="list-group-item" style="font-size:20px;border-right:0;border-left:0;padding:28px 0 28px 0;">
   <div class="row">
   <div class="col-md-3"><i class="fa fa-truck fa-2x"></i> </div>
  <div class="col-md-9">Delivered In 5Days</div>
  </div>
  </li>
   
    
	<li class="list-group-item"style="font-size:20px;border-right:0;border-left:0;padding:28px 0 28px 0;">
   <div class="row">
   <div class="col-md-3"><i class="fa fa-refresh fa-2x"></i></div>
  <div class="col-md-9">Esay Return in 7 Days</div>
  </div>
	</li>
	
	<li class="list-group-item" style="font-size:20px;border-right:0;border-left:0;padding:28px 0 28px 0 ;">
   <div class="row">
   <div class="col-md-3"><i class="fa fa-phone fa-2x"></i> </div>
  <div class="col-md-9">Call Us 9592038184</div>
  </div>
	</li>
	
	 </ul>
	 </aside>
	 </div>

 
 <div class="page-header" style="text-align:center;">
 <h3> Related  Items</h3>
 </div>
  <div class="col-md-12">
   <?php
		 $rel_sql="SELECT * FROM online_shopping ORDER BY rand() LIMIT 3";
		 $rel_run=mysqli_query($con,$rel_sql);
		 while($rel_row=mysqli_fetch_assoc($rel_run)){
			 $discount_price=$rel_row['item_price']-$rel_row['item_discount'];
			 $item_id=$rel_row['item_id'];
			  $item_title=str_replace('','_',$rel_row['item_title']);
	  echo "<div class='col-md-3'>
		   <div class='col-md-12  block nopadding'>
		   <div class='top'><img src='$rel_row[item_img]' class='img-responsive'></div>
		   <div class='bottom'>
		   <h3 class='item-title'><a href='item.php?item_title=$item_title&item_id=$item_id'>$rel_row[item_title]</a></h3>
		   <div class='pull-right cut_price text-muted'><del>$rel_row[item_price]/-</del></div>
		   <div class='clearfix'></div>
		    <div class='pull-right dis_price'>$discount_price/-</div>
		   </div>
		   </div>
		   </div>";
		 } ?>
		 
  </div>

 </div>

</body>
</html>