<?php include("../../conn.php"); ?>
<?php
    $conn->query("update notapanjar_heder set kunci=1,tglkunci='".date('Y-m-d H:i:s')."',userkunci='".$_SESSION["anggaran_kodeuser"]."' where nonotapanjar='".$_GET["nonotapanjar"]."'");
    echo "OK";
?>
<?php include("../../close.php"); ?>