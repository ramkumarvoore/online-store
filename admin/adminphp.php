
<?php include 'db.php'; ?>
<?php 
if(isset($_REQUEST['del_item_id'])){
	
	$del_sql="DELETE FROM online_shopping WHERE item_id='$_REQUEST[del_item_id]'";
	$run=mysqli_query($con,$del_sql);
	
}
if(isset($_REQUEST['up_item_id']))
{
	$item_title=mysqli_real_escape_string($con,strip_tags($_REQUEST['item_title']));
	$item_description=mysqli_real_escape_string($con,strip_tags($_REQUEST['item_description']));
	$item_cat=mysqli_real_escape_string($con,strip_tags($_REQUEST['item_cat']));
	$item_qty=mysqli_real_escape_string($con,strip_tags($_REQUEST['item_qty']));
	$item_cost=mysqli_real_escape_string($con,strip_tags($_REQUEST['item_cost']));
	$item_price=mysqli_real_escape_string($con,strip_tags($_REQUEST['item_price']));
	$item_discount=mysqli_real_escape_string($con,strip_tags($_REQUEST['item_discount']));
	$item_delivery=mysqli_real_escape_string($con,strip_tags($_REQUEST['item_delivery']));
    $upd_sql="UPDATE online_shopping SET item_title='$item_title',item_description='$item_description',item_cat='$item_cat',item_qty='$item_qty',item_cost='$item_cost',item_price='$item_price',item_discount='$item_discount',item_delivery='$item_delivery' WHERE item_id='$_REQUEST[up_item_id]'";
     if(mysqli_query($con,$upd_sql))
		 { ?>
        <script>window.location="admin_portal.php"</script>
	     <?php }
		 
}
?>
<table class="table table-bordered table-striped">
	<thead>
	<tr class="item-head"> 
	<th>S.no</th>
	<th>item_id</th>
	<th>item_img</th>
	<th>item_title</th>
	<th >item_description</th>
	<th>item_cat</th>
	<th>item_qty</th>
	<th>item_cost</th>
	<th>item_price</th>
	<th>item_discount</th>
	<th>item_delivery</th>
	<th>Action</th>
	</tr>
	</thead>
	<tbody>
	<?php
       $sql="SELECT * FROM online_shopping";
	   $run=mysqli_query($con,$sql);
	   $c=1;
	   while($row=mysqli_fetch_assoc($run)){
	echo "<tr>
	<td>$c</td>
	<td>$row[item_id]</td>
	<td><img src='$row[item_img]' class='img-responsive'></td>
	<td>$row[item_title]</td>
	<td >$row[item_description]</td>
	<td>$row[item_cat]</td>
	<td>$row[item_qty]</td>
	<td>$row[item_cost]</td>
	<td>$row[item_price]</td>
	<td>$row[item_discount]</td>
	<td>$row[item_delivery]</td>
	<td><div class='dropdown'>
	<button data-toggle='dropdown' class='btn btn-danger dropdown-toggle'>Action<span class='caret'></span></button>
	  <ul class='dropdown-menu dropdown-menu-right'>
	  <li><a href='#edit_modal$row[item_id]' data-toggle='modal'>Edit</a></li>"; ?>
	  <li><a onclick="del_func(<?php echo $row['item_id']; ?>);" >Delete</a></li>
	 <?php 
 echo 	"</ul>
	  </div>
	  <div class='modal fade' id='edit_modal$row[item_id]'>
<div class='modal-dialog'>
<div class='modal-content'>
<div class='modal-header'>
<button class='close' data-dismiss='modal'>&times;</button>
<h3>Add Details</h3>
</div>
<div class='modal-body'>
<div id='form'>
<div class='form-group'>
<label>Item Title</label>
<input type='text' id='item_title' value='$row[item_title]' class='form-control' required>
</div>
<div class='form-group'>
<label>Item Description</label>
<textarea type='text' id='item_description'value='$row[item_description]' class='form-control' required>
</textarea>
</div>
<div class='form-group'>
<label>item Category</label>
<select class='form-control' id='item_category'>
<option>select the category</option>";?>
<?php
 $cat_sql="SELECT * FROM category";
 $cat_run=mysqli_query($con,$cat_sql);
 while($cat_row=mysqli_fetch_assoc($cat_run))
 {    
      $cat_name=ucwords($cat_row['cat_name']);
	 if($cat_row['cat_slug']==''){
		 $cat_slug=$cat_name;
	 }
	 else{
		 $cat_slug=$cat_row['cat_slug'];
	 }
	 if($cat_slug==$row['item_cat']){
		 echo "<option selected value='$cat_slug' >$cat_name</option>";
	 }else {
	 
	echo "<option value='$cat_slug'>$cat_name</option>";
	}
 }
?>
<?php
 echo "</select>
</div>
<div class='form-group'>
<label>item Quantity</label>
<input type='number' id='item_qty' value='$row[item_qty]'class='form-control'>
</div>

<div class='form-group'>
<label>item Cost</label>
<input type='number'  id='item_cost' value='$row[item_cost]'  class='form-control'>
</div>
<div class='form-group'>
<label>item Price</label>
<input type='number'  id='item_price' value='$row[item_price]' class='form-control'>
</div>
<div class='form-group'>
<label>item Discount</label>
<input type='number' id='item_discount' value='$row[item_discount]' class='form-control'>
</div>
<div class='form-group'>
<label>item Delivery</label>
<input type='number'  id='item_delivery' value='$row[item_delivery]' class='form-control'>
</div>
<div class='form-group'>
<input type='hidden' id='upd_item_id' value='$row[item_id]'>";?>
<button class='btn btn-success btn-block' onclick="edit_form();" class='form-control' >submit</button>
<?php 
echo "</div>
</div>
</div>
<div class='modal-header'>
<div class='text-right'>
<button class='btn btn-danger' data-dismiss='modal'>colse</button>
</div>
</div>
</div>
</div>
</div>
	  </td>
	</tr>";
	$c++;
	   }
	?>
	</tbody>
	
	
	</table>