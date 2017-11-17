<?php include 'db.php'; ?>

<?php
if(isset($_REQUEST['order_status'])){
	
	$upd_sql="UPDATE orders SET order_status=$_REQUEST[order_status] WHERE order_id='$_REQUEST[order_id]'";
	$run=mysqli_query($con,$upd_sql);
	
}
if(isset($_REQUEST['order_return_status'])){
	
	$upd_sql="UPDATE orders SET order_return_status=$_REQUEST[order_return_status] WHERE order_id='$_REQUEST[order_id]'";
	$run=mysqli_query($con,$upd_sql);
	
}
?>
	
	<table class="table table-bordered table-striped">
	<thead>
	<tr class="item-head"> 
	<th>S.no</th>
	<th>Buyer Name</th>
	<th>Buyer Email</th>
	<th>Buyer Contact</th>
	<th>Buyer State</th>
	<th>Buyer Delivery Address</th>
	<th>Buyer Checkout Ref</th>
	<th class="text-right">Total Payment</th>
	<th class="text-right">order Status</th>
	<th class="text-right">Return Status</th>
	</tr>
	</thead>
	<tbody>
	
	<?php
      $sql="SELECT * FROM orders";
	   $run=mysqli_query($con,$sql);
	   $c=1;
	   while($row=mysqli_fetch_assoc($run))
	   {
		  if($row['order_status']==0) {
			  $status_btn_class= 'btn-warning';
              $status_value='pending';			  
		  }else{
			  $status_btn_class= 'btn-success';
              $status_value='send';	
			  
		  }
		  if($row['order_return_status']==0) {
			  $return_btn_class= 'btn-danger';
              $return_value='No Return';			  
		  }else{
			  $return_btn_class= 'btn-primary';
              $return_value='Returned';	
			  
		  }
		  
	 echo "<tr>
	<td>$c</td>
	<td>$row[order_name]</td>
	<td>$row[order_email]</td>
	<td>$row[order_contact]</td>
	<td>$row[order_state]</td>
	<td> $row[order_delivery_address]</td>
	<td><button class='btn btn-primary' data-toggle='modal' data-target='#ref_data$row[order_id]'>$row[order_checkout_ref]</button>
     <div class='modal fade' id='ref_data$row[order_id]'>
	 <div class='modal-dialog'>
	 <div class='modal-content'>
	 <div class='modal-header'>
     <button class='close' data-dismiss='modal'>&times;</button>
     <h3>Checkout Details</h3>
     </div>
	 <div class='modal-body'>
	<table class='table'>
	<thead>
	<tr>
	<th>s.no</th>
	<th>Item Name</th>
	<th>Item qty</th>
	<th class='text-right'>Price</th>
	<th class='text-right'>Sub total</th>
	</tr>
	</thead>
	<tbody>";
	//$chk_sql="SELECT * FROM checkout WHERE chk_ref='$row[order_checkout_ref]'";
	$chk_sql="SELECT * FROM checkout c JOIN online_shopping o ON c.chk_item=o.item_id WHERE c.chk_ref='$row[order_checkout_ref]'";
	$chk_run=mysqli_query($con,$chk_sql);
	while($chk_row=mysqli_fetch_assoc($chk_run)){
		
	if($chk_row['item_title']==''){
		$item_title= 'sorry Data Deleted';
	}
	else{
		$item_title=$chk_row['item_title'];
	}
	$total=$chk_row['chk_qty']*$chk_row['item_price'];
	echo "<tr>
	<td>1</td>
	<td>$item_title</td>
	<td>$chk_row[chk_qty]</td>
	<td class='text-right'>$chk_row[item_price]/-</td>
	<td class='text-right'>$total/-</td>
	</tr>";
	
	echo "</tbody>
	</table>
	
	<table class='table'>
	<thead>
	<tr>
	<th colspan=2 class='text-center'>Order Summary</th>
	</tr>
	</thead>
	<tbody>
	<tr>
	<td>Grand total</td>
	<td class='text-right'>$row[order_total]/-</td>
	</tr>";
	}
	   
    echo " </tbody>
	</table>
	 </div>
	 </div>
	 </div>
	</div>
	</td>
	<td class='text-right'>$row[order_total]/-</td>";?>
	
	<td class='text-right'><button onclick="order_status(<?php echo $row['order_status'].', '.$row['order_id'];?>);" class='btn btn-block btn-sm <?php echo $status_btn_class;?>'><?php echo $status_value;?></button>
	
	<td class='text-right'><button onclick="order_return_status(<?php echo $row['order_return_status'].', '.$row['order_id'];?>);" class='btn btn-block btn-sm <?php echo $return_btn_class;?>'><?php echo $return_value;?></button>
	</td>
	</tr>
	<?php
	$c++;
	   }
	   ?>
	   </tbody>
	   </table>