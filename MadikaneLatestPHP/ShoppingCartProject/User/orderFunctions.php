<?php

	class Order{

		public $orderId;
		public  $customerName;
		public $customerSurname;
		public $customerAdress;
		public $cellNumber;
		public $amountDue;
	
		public function __construct($orderId, $customerName, $customerSurname,$customerAdress,$cellNumber,$amountDue) {
			$this->orderId = $orderId;
			$this->customerName = $customerName;
			$this->customerSurname = $customerSurname;
			$this->customerAdress = $customerAdress;
			$this->cellNumber = $cellNumber;
			$this->amountDue = $amountDue;
		}


    	public function getOrderId(){
			return $this->orderId;
		}
		public function getCustomerName(){
			return $this->customerName;
		}
		public function getCustomerSurname(){
			return $this->customerSurname;
		}
		public function getCustomerAddress(){
			return $this->customerAdress;
		}

		public function getCellNumber(){
			return $this->cellNumber;
		}
		public function getAmountDue(){
			return $this->amountDue;
		}
   

    }




	function placeOrder(){
		require "../connect.php";
		//require "order.php";
		//require "loginScript.php";

		$orderId = " ";
		$customerName = " ";
		$customerSurname = "";
		$customerAdress  = "";
		$cellNumber = "";
		$amountDue  = "";


		$userId = $_SESSION["userId"];
		
		

		$query = "Select*  from  users where userId = '".$userId."'";
		$rows = $conn->query($query);

		foreach ($rows as $key => $row){
			

			$customerName = $row["firstName"];
			$customerSurname = $row["lastName"];
			$cellNumber = $row["mobileNumber"];
			$customerAdress  = $row["customerAddress"];
		}

		$amountDue  = $_SESSION["total"];

		$chopeddSurn = substr($customerName,0,3);
	    $orderId = uniqid("$chopeddSurn");


	
		$order = new Order($orderId, $customerName, $customerSurname,$customerAdress,$cellNumber,$amountDue);
		$orderId = $order->getOrderId();
	   	$customerName = $order->getCustomerName();
	    $customerSurname = $order->getCustomerSurname();
	    $customerAdress = $order->getCustomerAddress();
	    $cellNumber  = $order->getCellNumber();
	    $amountDue = $order->getAmountDue();


	    echo "Order Placed!!!";


		$stmt = $conn->prepare("INSERT INTO orders (orderId,customerName,customerSurname,customerAddress, phoneNumber,amountDue) VALUES (?,?,?,?,?,?)");

	   


	   $stmt->bindParam(1,$orderId);
       $stmt->bindParam(2,$customerName );
       $stmt->bindParam(3,$customerSurname);
       $stmt->bindParam(4,$customerAdress);
       $stmt->bindParam(5,$cellNumber);
       $stmt->bindParam(6,$amountDue);

        $stmt->execute();

		  
       $itemName = " ";
       $itemPrice = " ";
       $quality = $_SESSION["nuOfItems"];
       $date = date("Y-m-d");
       $tatus = "Not Delivered";


       foreach ($_SESSION["cart"] as $item ) {
       		$itemName  =  $item->getItemName();
       		$itemPrice =$item->getPrice();
           
            $stmt = $conn->prepare("INSERT INTO orderdetails (itemName,itemPrice,quantity,orderDate,status,orderId) VALUES (?,?,?,?,?,?)");

		   $stmt->bindParam(1,$itemName);
	       $stmt->bindParam(2,$itemPrice );
	       $stmt->bindParam(3,$quality);
	       $stmt->bindParam(4,$date);
	       $stmt->bindParam(5,$tatus);
	       $stmt->bindParam(6,$orderId);

	        $stmt->execute();


       }




	}

?>