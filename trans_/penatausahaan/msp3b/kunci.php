<?php include("../../../conn.php"); ?>
<?php
    $conn->query("update sp3b set kunci=1 where nosp3b='".$_GET["nosp3b"]."'");
    echo "OK";
?>
<?php include("../../../close.php"); ?>