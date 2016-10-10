<?php 
   require "connect.php";

   	$query = "Select*  from  items";
   	$rows = $conn->query($query);
   
	$id = " ";
	$item_Name  = " ";
	$item_Price  = " ";
	$image_URL = " ";

	foreach($rows as $row){
		$id  = $row["id"];
		$item_Name = $row["itemname"];
		$item_Price = $row["itemprice"];
		$image_URL  = $row["imageurl"];

		echo"Item_id: ".$id. "</br>"
			."Item Name: ".$item_Name."</br>"
			."Item Price: ".$item_Price."</br>"
			."Image URL: ".$image_URL."</br></br>";
    }





    function displayItems(){
	   	
		   	require "connect.php";
			$query = "Select*  from  items";
		   	$rows = $conn->query($query);
		   
			$id = " ";
			$item_Name  = " ";
			$item_Price  = " ";
			$image_URL = " ";

			foreach($rows as $row){
				$id  = $row["id"];
				$item_Name = $row["itemname"];
				$item_Price = $row["itemprice"];
				$image_URL  = $row["imageurl"];
				$isNew = $row["isNew"];
			    ?>
		   		
		   		<div class="product-grid">					  
					<div class="more-product-info">

					    	<?php
		     					if($isNew ==1  ){
			      					echo "<span id ='isNew'>NEW</span>";
		     				 	}
							?>
					</div>						
					<div class="product-img b-link-stripe b-animate-go  thickbox">						   
						<?php echo'<img src="'.$image_URL.'" class="img-responsive" alt=""/>' ?>
						<div class="b-wrapper">
							<h4 class="b-animate b-from-left  b-delay03">							
								<button class="btns">ORDER NOW</button>
							</h4>
						</div>
					</div>					
					<div class="product-info simpleCart_shelfItem">
						<div class="product-info-cust">
							<h4><?php  echo $item_Name ?></h4>
							<span class="item_price"><?php echo "R".$item_Price ?></span>
							<input type="text" class="item_quantity" value="1" />
							<input type="button" class="item_add" value="ADD">
						</div>													
						<div class="clearfix"> </div>
					</div>
				</div>	

<?php 		}
		}
	}
?>


?>