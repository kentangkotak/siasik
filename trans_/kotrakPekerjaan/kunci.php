<?php include("../../conn.php"); ?>
<?php
    $conn->query("update kontrakPengerjaan_header set kunci=1 where nokontrak='".$_GET["nokontrak"]."'");
    echo "OK";
?>
<?php include("../../close.php"); ?>