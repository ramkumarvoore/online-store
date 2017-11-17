 <nav  class="navbar navbar-inverse">
		    <div class="navbar-fluid">
			   <div class="navbar-header">
               <a href="#" class="navbar-brand">Online Shopping</a>
               </div>
			 <ul class="nav navbar-nav">
		        <li><a href="project.php">Home</a></li>
				<?php  
				  $cat_sql="SELECT * FROM category ";
	              $cat_run=mysqli_query($con,$cat_sql);
		           while($cat_row=mysqli_fetch_assoc($cat_run)){
			           $cat_name=ucwords($cat_row['cat_name']);
					   if($cat_row['cat_slug'] == '')
					   {
						   $cat_slug=$cat_row['cat_name'];
					   }
				        else{
							$cat_slug=$cat_row['cat_slug'];
						}
				  echo  "<li><a href='category.php?category=$cat_slug'>$cat_name</a></li>";
                 }
				?>
			 </ul>
			 <ul class="nav navbar-nav navbar-right" >
              <li><a href="#" >Login In</a> </li>
              <li><a href="#">Register</a></li> 
              <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" >Profile <span class="caret"></span></a>
              <ul class="dropdown-menu">
              <li><a href="#" >UserName</a></li>
              <li><a href="#">Logout</a></li> 
              </ul>
			</div>
		 </nav> 