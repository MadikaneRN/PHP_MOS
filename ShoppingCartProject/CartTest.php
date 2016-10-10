<?php

session_start();
class Product {
private $productId;
private $productName;
private $price;
public function __construct( $productId, $productName, $price ) {
$this->productId = $productId;
$this->productName = $productName;
$this->price = $price;
}
public function getId() {
return $this->productId;
}
public function getName() {
return $this->productName;
}
public function getPrice() {
return $this->price;
}
}


$products = array(
1 => new Product( 1,"SuperWidget", 19.99 ),
2 => new Product( 2,"MegaWidget", 29.99 ),
3 => new Product( 3,"WonderWidget", 39.99 )
);
if( isset( $_SESSION["cart"])) $_SESSION["cart"] = array();


addItem();

if (isset( $_GET["action"] )and $_GET["action"] == "removeItem" ) {
removeItem();
} else {
   
displayCart();
}


function addItem() {
	global $products;
	if ( isset( $_GET["productId"] ) ) {
	$productId = (int) $_GET["productId"];
	if ( !isset( $_SESSION["cart"][$productId] ) ) {
		$_SESSION["cart"][$productId] = $products[$productId];
	}
	}
	session_write_close();
	header( "Location: cart.php" );
}
function removeItem() {
	global $products;
	if ( isset( $_GET["productId"] )) {
	$productId = (int) $_GET["productId"];
	if ( isset( $_SESSION["cart"][$productId] ) ) {
	unset( $_SESSION["cart"][$productId] );
}
}
session_write_close();

}
function displayCart() {
	echo "striwwwwg";

global $products;


?>



<!DOCTYPE html>
<html>
<head>
<title> A shopping cart using sessions </title>
<link rel="stylesheet" type="text/css" href= "common.css"/>
</head>
<body>
<h1> Your shopping cart </h1>
<dl>
<a href = "cart.php?action=addItem&itemObject=hjgjgjg">
								<input type="button" class="item_add" value="ADD">
							</a>
<?php
$totalPrice = 0;
foreach ( $_SESSION["cart"] as $product ) {
$totalPrice += $product->getPrice();
?>
<dt><?php echo $product-> getName()?> </dt>
<dd> $ <?php echo number_format($product->getPrice(), 2 ) ?>
<a href="cart.php?action=removeItem & productId= <?php echo
$product-> getId() ?> "> Remove </a> </dd>
<?php } ?>
<dt> Cart Total: </dt>
<dd> <strong>$<?php echo number_format( $totalPrice, 2 ) ?> </strong> </dd>
</dl>
<h1>Product list </h1>
<dl>
<?php foreach ( $products as $product ) { ?>
<dt> <?php echo $product->getName() ?> </dt>
<dd>$<?php echo number_format( $product-> getPrice(), 2 ) ?>
<a href="cart.php?action=addItem&productId=<?php echo
$product->getId()?>"> Add Item </a> </dd>
<?php }



?>
</dl>

<?php
}
?>
</body>
</html >
