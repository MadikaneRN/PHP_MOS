
<?php
class Item{

		public $itemId;

		//public $isNew;
		public $catagory;

		public function __construct($itemId) {
			$this->itemId = $itemId;
			
		}


    	public function getItemId(){
			return $this->itemId;
		}
	}
	?>	