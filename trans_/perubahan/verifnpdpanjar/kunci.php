<?php include("../../conn.php"); ?>
<?php
    $conn->query("update npdpanjar_heder set verif=1,userverif='".$_SESSION["anggaran_kodeuser"]."',tglverif='".date('Y-m-d H:i:s')."' where nonpdpanjar='".$_GET["nonpdpanjar"]."'");
    echo "OK";
?>
<?php include("../../close.php"); ?>