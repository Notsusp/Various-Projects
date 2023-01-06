<?php
require_once 'session_check.php';
require_once 'dbcontroller.php';
$db_Handle=new DBController();
$key= $_GET['code'];
?>
<body style="text-align: center;">
    <?php
    $product_array = $db_Handle->runQuery("SELECT * FROM tblproduct WHERE id = $key ORDER BY id ASC");
    if (!empty($product_array)) {
        foreach($product_array as $key=>$value){
            ?>
                <div>
                    <div>
                        <form method="post" action="index.php?action=add&code=<?php echo $product_array[$key]["code"]; ?>">
                            <div><img src="<?php echo $product_array[$key]["image"]; ?>"style="display:block;height:150px; width:150px; margin-left:auto;margin-right:auto;"></div>
                            <div>
                                <div style="font-size: 26px;"><?php echo $product_array[$key]["name"]; ?></div>
                                <div><?php echo "$".$product_array[$key]["price"]; ?></div>
                                <div style="margin-top: 50px; margin-bottom: 50px;"><?php echo $product_array[$key]["product_desc"] ?></div>
                                <div><input type="text" name="quantity" value="1" size="2" /><input type="submit" value="Add to Cart"/></div>
                            </div>
                        </form>
                    </div>
                </div>
            <?php
        }
    }
    ?>
</body>
