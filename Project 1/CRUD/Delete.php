<?php
include_once '../session_check.php';
include_once '../dbcontroller.php';

$db_Handle=new DBController();
$key= $_POST['id'];
?>
<body style="text-align: center;">
<?php
$product_array = $db_Handle->RunQueryNoRe("DELETE FROM tblproduct WHERE id = $key ");
if (isset($product_array))
    echo "Done!";
else
    echo "Error!";
?>
</body>
