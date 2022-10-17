<?php include("../../conn.php"); ?>
<?php
    $conn->query("update contrapost set kunci=1 where id='".$_GET["id"]."'");
    echo "OK";
?>
<?php include("../../close.php"); ?>