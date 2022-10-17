<?php include("../../conn.php"); ?>
<?php
    $conn->query("update penetapan_pagu set kunci=1 where notrans='".$_GET["notrans"]."'");
    echo "OK";
?>
<?php include("../../close.php"); ?>