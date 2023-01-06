<?php

require_once("dbcontroller.php");
require_once('session_check.php');
$db_handle= new DBController();

?>

<div id="product-grid">

    <div><h1>Products</h1></div>
    <?php
    $code=$_GET['code'];
    echo $code;
    $product_array = $db_handle->runQuery("SELECT * FROM tblproduct WHERE Category = '$code'");
    if (!empty($product_array)) {
        foreach($product_array as $key=>$value){
            ?>
            <div class="product-item">
                <form method="post" action="index.php?action=add&code=<?php echo $product_array[$key]["code"]; ?>">
                    <div><img src="./<?php echo $product_array[$key]["image"]; ?>"style="height:150px; width:150px; margin-left:auto;margin-right:auto;"></div>
                    <div>
                        <div><a href="./product.php?code=<?php echo $product_array[$key]["id"];?> "><?php echo $product_array[$key]["name"]; ?></a></div>
                        <div><?php echo "$".$product_array[$key]["price"]; ?></div>
                        <div><input type="text" name="quantity" value="1" size="2" /><input type="submit" value="Add to Cart" /></div>
                    </div>
                </form>
            </div>
            <?php
        }
    }
    ?>
</div>