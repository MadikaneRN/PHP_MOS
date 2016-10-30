<?php
 
   
   session_start();

 	


  if(isset($_POST["email"]) && isset($_POST["password"])){


  	require "../connect.php";

  	$query = "Select*  from  users where email = '".$_POST["email"]."' AND password = '".$_POST["password"]."'";
	$rows = $conn->query($query);

	$rowsFound = $rows->rowCount();
	

	 	//echo $rowsFound;

	 	if( $rowsFound >0){
			//header( "Location: cart.php" );

			$userIdd = 0;

			foreach ($rows as $row) {
				$userId = $row["userId"];
			}
		    
		 	$_SESSION["userId"] = $userId;
		 	 header("Location:cart.php");
		 	
	 	}
	 	else{
	 		header("Location:login.php?loginError=invalidDetails");
		 
		 	
		   }

	}


?>