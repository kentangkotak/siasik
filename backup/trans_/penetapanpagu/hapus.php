<?php include("../../conn.php"); ?>
<?php
    $conn->query("delete from penetapan_pagu where notrans='".$_GET["notrans"]."'");
    echo "OK";
?>
<?php include("../../close.php"); ?>