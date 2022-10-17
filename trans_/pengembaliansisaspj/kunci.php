<?php include("../../conn.php"); ?>
<?php
    $conn->query("update pengembaliansisapanjar_heder set kunci=1 where nospjpanjar='".$_GET["nospjpanjar"]."'");
    echo "OK";
?>
<?php include("../../close.php"); ?>