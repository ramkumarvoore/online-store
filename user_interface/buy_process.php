

<?php session_start();
  include 'db.php'; 
  
  if(isset($_REQUEST['chk_del_id'])){
  $del_sql="DELETE FROM checkout WHERE chk_id='$_REQUEST[chk_del_id]'" ;
  $run=mysqli_query($con,$del_sql);  
  }
  
  if(isset($_REQUEST['up_chk_qty'])){
  $up_chk_sql="UPDATE checkout SET chk_qty='$_REQUEST[up_chk_qty]' WHERE chk_id='$_REQUEST[up_chk_id]'";
  $run=mysqli_query($con,$up_chk_sql);  
  }
  
   echo "<table class='table'>
   <thead>
   
    <tr>
	  <td>s.no</td>
	  <td>Item</td>
	  <td>Qty</td>
	  <td>Delete</td>
	  <td>Price</td>
	  <td>Total</td>
	  
    </tr>
   </thead>
   <tbody>";
  
	  // $chk_sel_sql="SELECT * FROM checkout WHERE chk_ref='$_SESSION[ref]'";
	   $chk_sel_sql="SELECT * FROM checkout c JOIN online_shopping o ON c.chk_item=o.item_id WHERE c.chk_ref='$_SESSION[ref]'";
	   $chk_sel_run=mysqli_query($con,$chk_sel_sql);
	   $c=1;
	   $total=0;
	   $delivery_charges=0;
	   while($chk_sel_row=mysqli_fetch_assoc($chk_sel_run)){
		   $discount_price=$chk_sel_row['item_price']-$chk_sel_row['item_discount'];
           $subtotal=$discount_price * $chk_sel_row['chk_qty'];
		   $total+=$subtotal;
		   $delivery_charges+=$chk_sel_row['item_delivery'];
	 echo "<tr>
      <td>$c</td>
	  <td>$chk_sel_row[item_title]</td>
	  <td><input type='number' style='width:45px;'onblur=up_chk_qty(this.value,'$chk_sel_row[chk_id]'); value='$chk_sel_row[chk_qty]'></td>";?>
	  <td><button class='btn btn-danger' onclick=" del_func(<?php echo $chk_sel_row['chk_id'];?>);">Delete</button></td>
	 <?php echo " <td><b>$discount_price/-</b></td>
	  <td><b>$subtotal/-</b></td>
	  </tr>";
	   $c++;
	   }
	  $_SESSION['grandtotal']=$grandtotal=$delivery_charges+$total;
	   echo " </tbody>
</table>
</div>
</div>
</div>
<br><br>
<table class='table'>
     <thead>
	   <tr>
	   <td colspan='2' class='text-center'><b>Order summary</b></td>
	   </tr>
	 </thead>
	 <tbody>"; ?>
<?php
 echo "<tr>
	 <td> subtotal</td>
	 <td class='text-center'><b>$total/-</b></td>
	 </tr>
	  <tr>
	 <td> Delivery charges</td>
	 <td class='text-center'> <b>$delivery_charges</b></td>
	 </tr>
	  <tr>
	 <td> Grandtotal</td>
	 <td class='text-center'><b>$_SESSION[grandtotal]/-</b></td>
	 </tr>
	 	 </tbody>
</table>
	 ";
	  ?>