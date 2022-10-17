<?php include("../../conn.php"); ?>
<?php
    $conn->query("update npdls_heder set kunci=1 where nonpdls='".$_GET["nonpdls"]."'");
    echo "OK";
?>
<?php include("../../close.php"); ?>