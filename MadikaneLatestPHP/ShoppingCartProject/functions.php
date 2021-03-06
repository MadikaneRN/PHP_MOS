<?php 
	

	    
	require "connect.php";
           
	class Item{

		public $itemId;
		public  $itemName;
		public $itemPrice;
		public $imageUrl;
		//public $isNew;
		public $catagory;

		public function __construct($itemId, $itemName, $itemPrice,$imageUrl,$catagory) {
			$this->itemId = $itemId;
			$this->itemName = $itemName;
			$this->itemPrice = $itemPrice;
			$this->imageUrl = $imageUrl;
			$this->catagory = $catagory;
		}


    	public function getItemId(){
			return $this->itemId;
		}
		public function getItemName(){
			return $this->itemName;
		}
		public function getPrice(){
			return $this->itemPrice;
		}
		public function getImageUrl(){
			return $this->imageUrl;
		}
		public function getCatagory(){
			return $this->catagory;
		}
   

    }

	        //select all items from the database
			$query = "Select*  from  items";
		   	$rows = $conn->query($query);
		   
			//creates an array to Objects of items
            $itemsArray[] = "";
             
          
			foreach($rows as $row){
				//grab items from the dabase and assign them relevent variables
				$id  = $row["id"];
				$item_Name = $row["itemname"];
				$item_Price = $row["itemprice"];
				$image_URL  = $row["imageurl"];
				$isNew = $row["isNew"];
				$catagory = "Hardcoded catagory";


			    //creates an object of an item, 
			    //since this statement is inside a forloop it will execute multiple times
			    //if there four rows(items) in the database four objects will be created
			    $item = new Item($id,$item_Name,$item_Price,$image_URL,$catagory);

			  	$index = $row["id"];

			  	//stores object(s) in the itemsArray, uses Item Id as and index of the Object - this makes it  possible for a user to remove an item from the Array(cart) By it's id.
			  	//this statement will also execute multiple times....if kuko i items ezy5 kwi database 
			  	//this statement will execute 5 times (5 items objects will be stored into the itemArray)
			  	$itemsArray[$index] =  $item;
			  	 //why do I even need to store items in this array ? line 134 unswers this question
			    }



	//create the user cart if it doesn't exist
	//ibalulekile le ! sign....If I don't put it the cart will be re created everytime time 
	//refresh the page (add new item), in other words the cart will always be empty if I don't put the ! sign 
	//in this statement	
	if (!isset( $_SESSION["cart"] ) ) $_SESSION["cart"] = array();
			   
    //when a user clicks add, I pass 'action' as a query string to the URL bar, so here I'm checking if this query string
    //ikhona kwi URL (it's important that I check if if it exist or not, if I don't, I will get a variable undifined error)
    //if the query string exists in the URL, meaning the user has clicked the Add button, I call the addItem function
	if (isset( $_GET["action"] ) and $_GET["action"] == "addItem") {
		addItem();
	}
	//I don't need this code in this script will take it out. It should be on the page that displays cart details
	elseif (isset( $_GET["action"]) and $_GET["action"] == "removeItem") {
		removeItem();
	} elseif (isset( $_GET["action"]) and $_GET["action"] == "emptyCart"){
	   emptyCart();
	}


function addItem(){
	  //makes the array to be accessible everywhere in the script
	 global $itemsArray;

    //when the user clicks add, I pass id to the URL bar as a query string, again I'm checking if it exist or not (if the user has 
	 //clicked the add button or not)

	//if it exists on the URL bar I begin the magic of adding items to the Cart

	if ( isset( $_GET["itemId"] ) ) {
		
		//This is the session that stores the total Price of the items in the cart
		//here I'm initializing it to zero....only if it doesn't exists at this point in time
		//if I don't put the ! sign the session will always be zero coz it's gonna be re-initized to zero everytime the
        //page is refreshed (everytime the add button is clicked)
		if(!isset($_SESSION["total"])){
			$_SESSION["total"] = 0;
		}
        //does the same as the above code  but for the number of items in the cart
		if(!isset($_SESSION["nuOfItems"])){
			$_SESSION["nuOfItems"] = 0;
		}

		//==================================================================================================
				//adding items to the cart
		//==================================================================================================
			
        //OK let the magic begin....
        //The code below ads items to the cart.....I grab the itemID from the URL bar and assign to a varible named itemId
		$itemId = (int) $_GET["itemId"];
		//I grab the price from the URL bar also
		$price =  $_GET["price"];

		//Stores Item Array Objects into the cart (note that the cart session is used as an array also)
		//this is because the cart (session) is  gonna hold multiple values (Objects)
			
		if (!isset( $_SESSION["cart"][$itemId] ) ) {


			$_SESSION["cart"][$itemId] = $itemsArray[$itemId];


			$_SESSION["nuOfItems"] = $_SESSION["nuOfItems"]+1;  //increments the number of items in the cart       
			$_SESSION["total"] = $_SESSION["total"]+$price;   //increments current total by the that is recived from the URL


		}
		
      
			
		
	}
	session_write_close();
	//header( "Location: index.php" ); //redirects the user to the home page

}

function emptyCart(){

		unset($_SESSION["cart"]);
		$_SESSION["total"] = 0;
		$_SESSION["nuOfItems"] = 0;
	
}



function removeItem() {
 global $itemsArray;



	if (isset( $_GET["itemId"] )){
	$itemId = (int)$_GET["itemId"];
	$price =  $_GET["price"];

	if ( isset( $_SESSION["cart"][$itemId] ) ) {
		unset( $_SESSION["cart"][$itemId] );
	}

	$_SESSION["nuOfItems"] = $_SESSION["nuOfItems"]-1;  //decrements the number of items in the cart       
	$_SESSION["total"] = $_SESSION["total"]-$price;   //decrement current total price by the price recived from the URL
}
session_write_close();

}


function displayCart(){

	

	$totalPrice = 0;
	$imageUrl = " ";
	foreach ($_SESSION["cart"] as $item ) {
	$totalPrice += $item->getPrice();
	$imageUrl =	 "../".$item->getImageUrl();


	$itemId = $item->getItemId()
?>
	 <div class="cart-header">
				
				 	<a href = "cart.php?action=removeItem&itemId=<?php echo $item->getItemId()."&price=".$item->getPrice(); ?>">
						<div class="close1"></div>
					</a>
				 
				 <div class="cart-sec">
						<div class="cart-item cyc">
						    
							<?php echo'<img src="'.$imageUrl.'" alt=""/>' ?>
						</div>
					   <div class="cart-item-info">
							<h3><?php echo $item->getItemName() ?>
								<span>
									  	<?php  
									  	   echo "Item Id: ";
									  		echo $itemId; 
									  	?>
								</span>
							</h3>
							 <h4><span>Price. R </span><?php echo $item->getPrice() ?></h4>
							 <p class="qty">Qty ::</p>
							 <input min="1" type="number" id="quantity" name="quantity" value="1" class="form-control input-small">
					   </div>
					   <div class="clearfix"></div>
						<div class="delivery">
							 <p>Service Charges:: Rs.50.00</p>
							 <span>Delivered in 2-3 bussiness days</span>
							 <div class="clearfix"></div>
				        </div>						
				  </div>
</div>
<?php
	}
}
?>



<?php
      

		function displayItems(){
			require "connect.php";
			$query = "Select*  from  items";
		   	$rows = $conn->query($query);
		   
			
            global $itemsArray;
             
            $index = 0;
			foreach($rows as $row){
				$id  = $row["id"];
				$item_Name = $row["itemname"];
				$item_Price = $row["itemprice"];
				$image_URL  = $row["imageurl"];
				$isNew = $row["isNew"];
				$catagory = "Hardcoded catagory";
			   
			    $item = new Item($id,$item_Name,$item_Price,$image_URL,$item_Price);

          

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
							<h4><?php  echo $item->getItemName()?></h4>
							<span class="item_price"><?php echo "R".$item->getPrice() ?></span>
							<input type="text" class="item_quantity" value="1" />
							<a href = "index.php?action=addItem&itemId=<?php echo
														$item->getItemId()."&price=".$item->getPrice() ?>">
								<input type="button" class="item_add" value="ADD">
							</a>
						</div>													
						<div class="clearfix"> </div>
					</div>
				</div>	




 <?php

 		}



	}

?>









	
               

