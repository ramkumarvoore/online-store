<?php include 'db.php';?> 
<?php
if(isset($_POST['ins_submit']))
{
	$item_title=mysqli_real_escape_string($con,strip_tags($_POST['item_title']));
	$item_description=mysqli_real_escape_string($con,strip_tags($_POST['item_description']));
	$item_category=mysqli_real_escape_string($con,strip_tags($_POST['item_category']));
	$item_qty=mysqli_real_escape_string($con,strip_tags($_POST['item_qty']));
	$item_cost=mysqli_real_escape_string($con,strip_tags($_POST['item_cost']));
	$item_price=mysqli_real_escape_string($con,strip_tags($_POST['item_price']));
	$item_discount=mysqli_real_escape_string($con,strip_tags($_POST['item_discount']));
	$item_delivery=mysqli_real_escape_string($con,strip_tags($_POST['item_delivery']));
	if(isset($_FILES['item_image']['name'])){
		$file_name=$_FILES['item_image']['name'];
		$path_address="img/$file_name";
		$path_address_db="img/$file_name";
		$img_confirm=1;
		$file_type=pathinfo($_FILES['item_image']['name'],PATHINFO_EXTENSION);
		if($_FILES['item_image']['size']>200000){
			$img_confirm=0;
			echo 'this size is very big';
		}
		if($file_type != 'jpg' && $file_type != 'png' && $file_type != 'gif' )
		{
			$img_confirm=0;
			echo 'this is not matching';
		}
		if($img_confirm==0){
			echo 'this is not matchin';
			
		}else{
			if(move_uploaded_file($_FILES['item_image']['tmp_name'],$path_address)){
	$sql="INSERT INTO online_shopping(item_img,item_title,item_description,item_cat,item_qty,item_cost,item_price,item_discount,item_delivery) VALUES('$path_address_db','$item_title','$item_description','$item_category','$item_qty','$item_cost','$item_price','$item_discount','$item_delivery')";
			if(mysqli_query($con,$sql))
            { ?>
        <script>window.location="admin_portal.php"</script>
	     <?php }

	}
		}
	}else{
		echo 'sorry';
	}
}

?>

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
<!--<script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>-->
  <script>tinymce.init({ selector:'textarea' });</script>
<script>
 function admin_func(){
	  var xmlhttp= new XMLHttpRequest();
	  xmlhttp.onreadystatechange=function(){
	 if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
						document.getElementById('get_data').innerHTML = xmlhttp.responseText;
					}
	  
	  }
	  xmlhttp.open('GET', 'adminphp.php', true);
      xmlhttp.send();
	 
 }
 
  function del_func(item_id){
	  var xmlhttp= new XMLHttpRequest();
	  xmlhttp.onreadystatechange=function(){
	 if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
						document.getElementById('get_data').innerHTML = xmlhttp.responseText;
					}
	  
	  }
	  xmlhttp.open('GET', 'adminphp.php?del_item_id='+item_id, true);
      xmlhttp.send();
	 
 }
 
  function edit_form(){
	item_id=document.getElementById('upd_item_id').value; 
	item_title=document.getElementById('item_title').value;
	item_description=document.getElementById('item_description').value;
	item_category=document.getElementById('item_category').value;
	item_qty=document.getElementById('item_qty').value;
	item_cost=document.getElementById('item_cost').value;
	item_price=document.getElementById('item_price').value;
	item_discount=document.getElementById('item_discount').value;
	item_delivery=document.getElementById('item_delivery').value;
	  var xmlhttp= new XMLHttpRequest();
	  xmlhttp.onreadystatechange=function(){
	 if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
						document.getElementById('get_data').innerHTML = xmlhttp.responseText;
					}
	  
	  }
	  xmlhttp.open('GET', 'adminphp.php?up_item_id='+item_id+'&item_title='+item_title+'&item_description='+item_description+'&item_cat='+item_category+'&item_qty='+item_qty+'&item_cost='+item_cost+'&item_price='+item_price+'&item_discount='+item_discount+'&item_delivery='+item_delivery, true);
      xmlhttp.send();
	 
 }
 
</script>
	</head>
	<body onload="admin_func();">
	<?php include "header.php";?>
	<div class="container">
	
	<button class="btn btn-primary " data-toggle="modal" data-backdrop="static" data-target="#add_person" >Add Persons</button><br><br>
<div class="modal fade" id="add_person">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button class=" close" data-dismiss="modal">&times;</button>
<h3>Add Details</h3>
</div>
<div class="modal-body">
<form method="post" enctype="multipart/form-data">
<div class="form-group"> 
<label>item Image</label>
<input type="file"  name="item_image" class="form-control" required>
</div>
<div class="form-group">
<label>Item Title</label>
<input type="text" name="item_title" class="form-control" required>
</div>
<div class="form-group">
<label>Item Description</label>
<textarea type="text"  name="item_description" class="form-control" required>
</textarea>
</div>
<div class="form-group">
<label>item Category</label>
<select class="form-control" name="item_category">
<option>select the category</option>
<?php
 $cat_sql="SELECT * FROM category";
 $cat_run=mysqli_query($con,$cat_sql);
 while($cat_row=mysqli_fetch_assoc($cat_run))
 {    
      $cat_name=ucwords($cat_row['cat_name']);
	 if($cat_row['slug']==''){
		 $cat_slug=$cat_name;
	 }
	 else{
		 $cat_slug=$cat_row['cat_slug'];
	 }
	echo "<option value='$cat_slug' >$cat_name</option>";
 }
?>

</select>
</div>
<div class="form-group">
<label>item Quantity</label>
<input type="number"  name="item_qty" class="form-control">
</div>

<div class="form-group">
<label>item Cost</label>
<input type="number"  name="item_cost" class="form-control">
</div>
<div class="form-group">
<label>item Price</label>
<input type="number"  name="item_price" class="form-control">
</div>
<div class="form-group">
<label>item Discount</label>
<input type="number" name="item_discount" class="form-control">
</div>
<div class="form-group">
<label>item Delivery</label>
<input type="number"  name="item_delivery" class="form-control">
</div>
<div class="form-group">
<button class="btn btn-success btn-block" name="ins_submit" class="form-control" >submit</button>
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

	<div id="get_data">
	
	
	
	</div>
	<?php //include "footer.php";?>
	</div>
	</body>
	
	</html>
	