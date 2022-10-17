<?php include("../../conn.php"); ?>
<?php
    $conn->query("update pengembalianpanjar_heder set kunci=1 where nopengembalianpanjar='".$_GET["nopengembalianpanjar"]."'");
    echo "OK";
?>
<?php include("../../close.php"); ?>