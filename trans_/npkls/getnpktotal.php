<?php include("../../conn.php"); ?>
<?php
    $sql=$conn->query("select npkls_heder.nonpk as nonpk,sum(npkls_rinci.total) as total
						from npkls_heder,npkls_rinci
						where npkls_heder.nonpk=npkls_rinci.nonpk and npkls_heder.nonpk='".$_GET['nonpk']."'");
    $rs=$sql->fetch_object();

    $totalrinci = $rs->total;
    echo json_encode([
        "totalrinci"=>rpz($totalrinci)
    ]);
?>
<?php include("../../close.php"); ?>