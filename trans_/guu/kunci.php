<?php include("../../conn.php"); ?>
<?php
    $conn->query("update sppgu_heder set kunci=1,tglkunci='".date('Y-m-d H:i:s')."',userkunci='".$_SESSION["anggaran_kodeuser"]."' where nosppgu='".$_GET["nosppgu"]."'");
    echo "OK";
?>
<?php include("../../close.php"); ?>