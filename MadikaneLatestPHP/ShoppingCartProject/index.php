<!DOCTYPE html>
<html>
<head>
<title>Mos Wear | Home</title>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<link href='http://fonts.googleapis.com/css?family=Raleway:400,200,600,800,700,500,300,100,900' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Arimo:400,700,700italic' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="css/component.css" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Mos Wear Shopping Cart" 

		/>

<!-- start menu -->
<link href="css/megamenu.css" rel="stylesheet" type="text/css" media="all" />

<!-- start menu -->
<script language="javascript" src="User/functions.js"></script> 




</head>
<body>
<?php
   
    require "User/loginScript.php";
	require "functions.php";
	
?>
<!--header-->
<div class="header">
	 <div class="container">
	     <div class="main-header">
			  	<div class="carting">
					 
					 
					 		
					 			<?php
									if(isset($_SESSION["userId"]) && !empty($_SESSION["userId"])){

										$userId = $_SESSION["userId"];

										require_once "connect.php";
										$query = "Select*  from  users where userId = ".$userId." ";
						 				$rows = $conn->query($query);

						 				$name = "";

						 				foreach ($rows as $row){
						 					$name = $row["firstName"];
						 					echo "<a href='User/login.php?action=logout'  style ='font-weight:600;'>LOGOUT</a> ".$name;

										}
									}
									else{
										echo "<a href='User/login.php'>LOGIN</a>";
									}
								?>

					 			
					 		
					 	
					
				</div>
			 <div class="logo">
				 <h3><a href="index.php">MOS Wear</a></h3>
			  </div>	

			    <?php
					$loggedin = 0;
                      					 
					if(isset($_SESSION["userId"])){
						$loggedin = 1;
					    echo $_SESSION["userId"]; 
						
					}
				 

				// echo $_SESSION["cart"];
				?>

				<script type="text/javascript">
					function hi(){
						 var javaScriptVar = "<?php echo $loggedin; ?>";

						 if(javaScriptVar>0){
						 	 window.location="User/cart.php";
						 }
				         else{
				         	alert("You need to login first!");
				         }

				        
					}
				   
				</script>			  
			 <div class="box_1" onclick="hi()">




			  		
			 	
			    <h3>
						Total: 	R<?php    
									if(isset($_SESSION["total"])){
										echo  $_SESSION["total"]; 
				 					}else{
					 					echo "0";
					 				}
							 	?> 
				 		<span class="simpleCart_total"></span> 
				 		(<span id="simpleCart_quantity" class="simpleCart_quantity">
				 			<?php
				 				if(isset($_SESSION["nuOfItems"]))
				 					{ echo  $_SESSION["nuOfItems"]; 
				 			}else{
					 			echo "0";
					 		
					 		} ?> 
				 		</span> items)
				 		<img src="images/cart.png" alt=""/>
				 	</h3>
				<p>
				 	<a href="index.php?action=emptyCart"
				 		 class="simpleCart_empty">empty cart</a>
				</p>
			 
			 </div>
			 
			 <div class="clearfix"></div>
		 </div>
				
				<!-- start header menu -->
		<ul class="megamenu skyblue">
			<li class="active grid"><a class="color1" href="index.php">Home</a></li>
			<li class="grid"><a href="">CATAGORIES</a></li>
				<li class="grid"><a href="">GALLERY</a></li>
			<li class="grid"><a href="about.html">ABOUT US</a></li>
			<li class="grid"><a href="contact.html">CONTACT US</a></li>				
		</ul> 			 
			  <div class="clearfix"></div>			   	
	 </div>
		 <div class="caption">
		 <h1>FASHION AND CREATIVITY</h1> 
		 <p>Fashion is art and you are the canvas!</p>
	     </div>
</div>
<!--header-->
<div class="categoires">
</div>
<!---->
<div class="features" id="features">
	 <div class="container">
		 <div class="tabs-box">
			<ul class="tabs-menu">
				<!-- <li><a href="#tab1">All</a></li>-->
				<!-- <li><a href="#tab2">Man</a></li>-->
				<!-- <li><a href="#tab3">Woman</a></li>-->
			</ul>
			<div class="clearfix"> </div>
		 <div class="tab-grids">
			 <div id="tab1" class="tab-grid1">			   				  
				<?php
				 
				       displayItems();
				       	//displayCart();
				       if(isset($_GET["action"])){
				       	  	if($_GET["action"] == "addItem"){
				        		addItem();
				        	}
				       }
					         
				       
				?>		
				<div class="clearfix"></div>					
			 </div>
		 </div>				
		 </div>
	</div>
</div>
<!--fotter-->
<div class="fotter">
	 <div class="container">
	 <div class="col-md-6 contact">
		  <form>
			 <input type="text" class="text" value="Name..." onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Name...';}">
			 <input type="text" class="text" value="Email..." onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Email...';}">
			 <textarea onfocus="if(this.value == 'Message...') this.value='';" onblur="if(this.value == '') this.value='Message...';" >Message...</textarea>	
			 <div class="clearfix"></div>
			 <input type="submit" value="SUBMIT">
		 </form>

	 </div>
	 <div class="col-md-6 ftr-left">
		 <div class="ftr-list">
			 <ul>
				 <li><a href="#">Home</a></li>
				 <li><a href="about.html">About</a></li>
				 <li><a href="contact.html">Contact</a></li>
			 </ul>
		 </div>
		 <div class="ftr-list2">
			 <ul>				 
				<!-- <li><a href="#">Combos</a></li>-->
				 <!--<li><a href="#">Trendy</a></li>-->
				 <!-- <li><a href="#">Fashion</a></li>-->
				 <!-- <li><a href="#">College</a></li> -->
			 </ul>
		 </div>
		 <div class="clearfix"></div>
		 <h4>FOLLOW US</h4>
		 <div class="social-icons">
		 <a href="#"><span class="in"> </span></a>
		 <a href="#"><span class="you"> </span></a>
		 <a href="#"><span class="be"> </span></a>
		 <a href="#"><span class="twt"> </span></a>
		 <a href="#"><span class="fb"> </span></a>
		 </div>
	 </div>	 
	 <div class="clearfix"></div>
	 </div>
</div>
<!--fotter//-->
<div class="fotter-logo">
	 <div class="container">
	 <div class="ftr-logo"><h3><a href="index.html">MOS WEAR</a></h3></div>
	 <div class="ftr-info">
	 <p>&copy; 2016 All Rights Reseverd Design by APN GEEKS </p>
	</div>
	 <div class="clearfix"></div>
	 </div>
</div>
<!--fotter//-->

</body>
</html>