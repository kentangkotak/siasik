<?php include("../../conn.php"); ?>
<?php
    $conn->query("update pergeseranTheder set flag='',tglverifbatal='".date('Y-m-d H:i:s')."' where notrans='".$_GET["notrans"]."'");
    echo "OK";
?>
<?php include("../../close.php"); ?>