<?php include("../../conn.php"); ?>
<?php
    $conn->query("update penyesesuaianperioritas_heder set kunciperubahan=1 where notrans='".$_GET["notrans"]."'");
    echo "OK";
?>
<?php include("../../close.php"); ?>