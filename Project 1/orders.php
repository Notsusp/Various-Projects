<?php
    require_once("dbcontroller.php");
    require_once('session_check.php');
    $db_handle = new DBController();
    $user = $_SESSION['id'];
    $query= "SELECT * FROM order_table WHERE username = '$user'";
    $orders= $db_handle->runQuery($query);
    //using the index to track the number of orders the user made
    $index=1;


?>
<html>
<body>
<link href="style.css" type="text/css" rel="stylesheet" />
<?php
include_once 'navigation.php';
?>
<?php
if ($orders!=NULL)
{
?>
<div id="shopping-cart">
    <div class="txt-heading">History</div>

        <table class="tbl-cart" cellpadding="10" borderspacing="1">
            <tbody>

            <tr>
                <th style="width = 5%; text-align:center;">Index</th>
                <th style="text-align:left;">Link</th>
                <th style="text-align:left;">ID</th>
                <th style="text-align:right; width=5%">Date</th>
                <th style="text-align:right; width=5%">Total</th>
            </tr>
<?php
foreach($orders as $order)
{
?>
            <tr>
                <td><?php echo $order['id'] ?></td>
                <td><a href="./orderView.php?order_nr=<?php echo $order['id']?>">Click here to view</a></td>
                <td><?php echo $order['id'] ?></td>
                <td style="text-align:right;"><?php echo $order['createdAt'] ?></td>
                <td style="text-align:right;"><?php echo $order['total'] ?></td>
            </tr>
            <?php

            $index+=1;
                }
            }

            else{?>
        <div>No records</div>
            <?php }?>

</div>