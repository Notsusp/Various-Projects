<?php
require_once("session_check.php");
require_once("dbcontroller.php");
include_once("navigation.php");
$db_handle = new DBController();
$index=0;
?>
<html>
<head>
    <title>Order Items</title>
    <link href="style.css" type="text/css" rel="stylesheet" />
</head>
<body>
<?php
include_once 'navigation.php';?>
    <?php
    if(!isset($_GET['order_nr']))
        header("LOCATION: index.php");
    else{
    $order_nr = $_GET['order_nr'];
    if(isset($_GET['case'])&&$_GET['case']=='delete') {
        $query = "delete from order_table where `id`='$order_nr'";
        $check = $db_handle->RunQueryNoRe($query);
        $check = $query = "delete from item_order where `order_id`='$order_nr'";
        $db_handle->RunQueryNoRe($query);
        header("LOCATION: index.php");
    }

        $query= "SELECT * FROM item_order WHERE order_id = $order_nr";
    $order_list = $db_handle->runQuery($query);
    $query= "SELECT * FROM order_table WHERE id = $order_nr";
    $order_clone=$db_handle->runQuery($query);
    $index=0;


        ?>
<div id="shopping-cart">
    <div>Order <?php echo $order_list[$index]['order_id'] ?></div>
        <table class="tbl-cart" cellpadding="10" borderspacing="1">
            <tbody>
            <tr>
                <th style="text-align:left;">Name</th>
                <th style="text-align:left;">Code</th>
                <th style="text-align:right;" width="5%">Quantity</th>
                <th style="text-align:right;" width="10%">Unit Price</th>
                <th style="text-align:right;" width="10%">Total Price</th>
            </tr>


            <?php
            foreach ($order_list as $item){
                $product_id=$item['product_id'];
                $query= "SELECT * FROM tblproduct WHERE id = '$product_id'";
                $product_clone= $db_handle->runQuery($query);
                $image = $product_clone[0]['image'];

                ?>
                <tr>
                <td><img style="height:200px;width:100px;" src="<?php echo $image?>" style="cart-item-image width:100px height:200px"><a href="product.php?code=<?php echo $product_clone[0]["id"];?>"><?php echo $product_clone[0]['name']; ?></a></td>
                <td><?php echo $product_clone[0]["code"]; ?></td>
                <td style="text-align:right;"><?php echo $order_list[$index]['quantity']; ?></td>
                <td  style="text-align:right;"><?php echo "$ ".$product_clone[0]['price']; ?></td>
                <td  style="text-align:right;"><?php $item_price = $order_list[$index]['quantity']*$product_clone[0]['price']; echo "$ ". number_format($item_price,2) ?></td>
                </tr>
                <?php
                $index+=1;
            }
            ?>

            <tr>
                <td colspan="2" text-align="right">Total:</td>
                <td text-align="right" colspan="2"><strong><?php echo "$ ".number_format($order_clone[0]['total'], 2); ?></strong></td>
                <td><a href="orderView.php?order_nr=<?php echo $order_nr; ?>&case=delete">Delete order</a></td>
            </tr>
            </tbody>
        </table>
        <?php
        }
    ?>
</div>