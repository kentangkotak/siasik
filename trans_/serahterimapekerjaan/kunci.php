<?php include("../../conn.php"); ?>
<?php
    $conn->query("update serahterima_heder set kunci=1 where noserahterimapekerjaan='".$_GET["noserahterimapekerjaan"]."'");
    echo "OK";
?>
<?php include("../../close.php"); ?>