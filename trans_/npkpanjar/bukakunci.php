<?php include("../../conn.php"); ?>
<?php
    $conn->query("update npkpanjar_heder set kunci='',userkunci='".$_SESSION["anggaran_kodeuser"]."',tglkunci='".date('Y-m-d H:i:s')."' where nonpk='".$_GET["nonpk"]."'");
    echo "OK";
?>
<?php include("../../close.php"); ?>