<?php include("../../conn.php"); ?>
<?php
    $conn->query("update npdls_heder set verif=1,userverif='".$_SESSION["anggaran_kodeuser"]."',tglverif='".date('Y-m-d H:i:s')."' where nonpdls='".$_GET["nonpdls"]."'");
    echo "OK";
?>
<?php include("../../close.php"); ?>