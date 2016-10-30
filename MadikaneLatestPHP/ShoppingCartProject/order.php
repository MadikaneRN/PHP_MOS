<?php 

           
	class Order{

		public $orderId;
		public  $customerName;
		public $customerSurname;
		public $customerAdress;
		public $cellNumber;
		public $amountDue;
	
		public function __construct($orderId, $customerName, $customerSurname,$customerAdress, $cellNumber,$amountDue) {
			$this->orderId = $orderId;
			$this->customerName = $customerName;
			$this->customerSurname = $customerSurname;
			$this->customerAdress = $customerAdress;
			$this->amountDue = $amountDue;
			$this->cellNumber = $cellNumber;
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



    ?>