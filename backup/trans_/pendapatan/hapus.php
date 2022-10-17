<?php include("../../conn.php"); ?>
<?php
    $conn->query("delete from anggaran_pendapatan where notrans='".$_GET["notrans"]."'");
    echo "OK";
?>
<?php include("../../close.php"); ?>