<?php include("../../conn.php"); ?>
<?php
    $conn->query("update usulanHonor_h set kunci='' where notrans='".$_GET["notrans"]."'");
    echo "OK";
?>
<?php include("../../close.php"); ?>