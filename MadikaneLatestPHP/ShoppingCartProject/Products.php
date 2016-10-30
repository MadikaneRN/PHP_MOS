
<?php
	class Product{

			public  $itemName;
			public $itemPrice;
			public $imageUrl;
			//public $isNew;
			public $catagory;

			public function __construct($itemName, $itemPrice,$imageUrl,$catagory) {
				$this->itemName = $itemName;
				$this->itemPrice = $itemPrice;
				$this->imageUrl = $imageUrl;
				$this->catagory = $catagory;
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
?>