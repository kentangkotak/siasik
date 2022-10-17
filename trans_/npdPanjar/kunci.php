<?php include("../../conn.php"); ?>
<?php
    $conn->query("update npdpanjar_heder set kunci=1 where nonpdpanjar='".$_GET["nonpdpanjar"]."'");
    echo "OK";
?>
<?php include("../../close.php"); ?>