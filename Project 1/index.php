<?php
require_once("dbcontroller.php");
require_once('session_check.php');
$db_handle = new DBController();
$token = $_SESSION['id'];//for later use in making orders
if(!empty($_GET["action"])) {
switch($_GET["action"]) {
    case "add":
        if (!empty($_POST["quantity"])) {
            $total_price = $_SESSION['total_price'];
            //searching for the item being added and initializing the row
            $productByCode = $db_handle->runQuery("SELECT * FROM tblproduct WHERE code='" . $_GET["code"] . "'"); //I initialize the article being added to the cart in an array
            $itemArray = array($productByCode[0]["code"] => array('name' => $productByCode[0]["name"], 'code' => $productByCode[0]["code"], 'quantity' => $_POST["quantity"], 'price' => $productByCode[0]["price"], 'image' => $productByCode[0]["image"]));
            if (!empty($_SESSION["cart_item"])) {
                if (in_array($productByCode[0]["code"], array_keys($_SESSION["cart_item"]))) {
                    //in case the product is already in the cart I simply add the quantity in the form to the cart
                    foreach ($_SESSION["cart_item"] as $k => $v) {
                        if ($productByCode[0]["code"] == $k) {
                            if (empty($_SESSION["cart_item"][$k]["quantity"])) {
                                $_SESSION["cart_item"][$k]["quantity"] = 0;
                            }
                            $_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
                        }
                    }
                } else {//if it is not already in the cart, I merge it with the cart.
                    $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"], $itemArray);
                }
            } else {//if the cart is empty this is the first item in the cart, so the cart becomes the product
                $_SESSION["cart_item"] = $itemArray;
            }
        }
        break;
    case "remove":
        if (!empty($_SESSION["cart_item"])) {
            foreach ($_SESSION["cart_item"] as $k => $v) {
                if ($_GET["code"] == $k)
                    unset($_SESSION["cart_item"][$k]);
                if (empty($_SESSION["cart_item"]))
                    unset($_SESSION["cart_item"]);
            }
        }
        break;
    case "empty":
        unset($_SESSION["cart_item"]);
        break;
    case "order":
    {
        if (!empty($_SESSION["cart_item"])) {

            $total_price = $_SESSION['total_price'];
            $query = "INSERT INTO order_table (`total`,`username`) VALUES ('$total_price','$token')";
            $check = $db_handle->runQueryNoRe($query);
            $query = "SELECT * FROM order_table WHERE username='$token' ORDER BY id DESC";//since the username in the token is auto-incremented, I select the very last one made.
            $order_clone = $db_handle->runQuery($query);
            $order_id = $order_clone[0]['id'];//and initialize a variable with the last id in the ordered list
            foreach($_SESSION['cart_item'] as $item){
                $id=$item['code'];
                $query="SELECT * FROM tblproduct WHERE code = '$id'";
                $product_clone = $db_handle->runQuery($query);
                $product_id=$product_clone[0]['id'];
                $quantity = $item['quantity'];
                $price = $product_clone[0]['price']*$item['quantity'];
                //after initializing every column I need filled, I run the query
                $query="INSERT INTO `item_order` (`order_id`,`product_id`,`quantity`) VALUES ('$order_id','$product_id','$quantity')";
                $check=$db_handle->RunQueryNoRe($query);

            }
            if($check)
            {
                echo "Order successful!";
                unset ($_SESSION['cart_item']);
            }
        }
    }


}

}
?>
<html>
<head>
<title>Hard work</title>
<link href="style.css" type="text/css" rel="stylesheet" />
</head>
<body>
<?php
include_once 'navigation.php';
?>
<div id="shopping-cart">
<div class="txt-heading">Shopping Cart</div>

<a id="btnEmpty" href="index.php?action=empty">Empty Cart</a>
<?php
if(isset($_SESSION["cart_item"])){
    $total_quantity = 0;
    $total_price = 0;
?>
<table class="tbl-cart" cellpadding="10" borderspacing="1">
<tbody>
<tr>
<th style="text-align:left;">Name</th>
<th style="text-align:left;">Code</th>
<th style="text-align:right;" width="5%">Quantity</th>
<th style="text-align:right;" width="10%">Unit Price</th>
<th style="text-align:right;" width="10%">Price</th>
<th style="text-align:center;" width="5%">Remove</th>
</tr>
<?php
    foreach ($_SESSION["cart_item"] as $item){
        $item_price = $item["quantity"]*$item["price"];
		?>

                <td><img src="<?php echo $item["image"]; ?>" class="cart-item-image width:100px height:200px"><?php echo $item["name"]; ?></td>
				<td><?php echo $item["code"]; ?></td>
				<td style="text-align:right;"><?php echo $item["quantity"]; ?></td>
				<td  style="text-align:right;"><?php echo "$ ".$item["price"]; ?></td>
				<td  style="text-align:right;"><?php echo "$ ". number_format($item_price,2) ?></td>
				<td style="text-align:center;"><a href="index.php?action=remove&code=<?php echo $item["code"];?>" class="btnRemoveAction"> <img src="icon-delete.png" alt="Remove Item" ></a></td>
				</tr>
				<?php
				$total_quantity += $item["quantity"];
				$total_price += ($item["price"]*$item["quantity"]);
                $_SESSION['total_price']=$total_price;
		}
		?>

<tr>
<td colspan="2" text-align="right">Total:</td>
<td text-align="right"><?php echo $total_quantity; ?></td>
<td text-align="right" colspan="2"><strong><?php echo "$ ".number_format($total_price, 2); ?></strong></td>
<td style="text-align: center;">
    <a style="text-decoration: none; padding 10px;" href="index.php?action=order">Order</a>
</td>
</tr>
</tbody>
</table>
  <?php
} else {
?>
<div class="no-records">Your Cart is Empty</div>
<?php 
}
//-------------------END OF SHOPPING CART---------------
?>
</div>
<div id="product-grid">
	<div class="txt-heading">Products</div>
	<?php
	$product_array = $db_handle->runQuery("SELECT * FROM tblproduct ORDER BY id ASC");
	if (!empty($product_array)) {
		foreach($product_array as $key=>$value){
	?>
		<div class="product-item">
			<form method="post" action="index.php?action=add&code=<?php echo $product_array[$key]["code"]; ?>">
			<div class="product-image"><img src="<?php echo $product_array[$key]["image"]; ?>"style="height:150px; width:150px; margin-left:auto;margin-right:auto;"></div>
			<div class="product-tile-footer">
                <div class="product-title"><a href="product.php?code=<?php echo $product_array[$key]["id"];?> "><?php echo $product_array[$key]["name"]; ?></a></div>
			<div class="product-price"><?php echo "$".$product_array[$key]["price"]; ?></div>
			<div class="cart-action"><input type="text" class="product-quantity" name="quantity" value="1" size="2" /><input type="submit" value="Add to Cart" class="btnAddAction" /></div>
			</div>
			</form>
		</div>
	<?php
		}
	}
	?>
</div>
</body>
</html>