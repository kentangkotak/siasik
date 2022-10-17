<?php include("../../conn.php"); ?>
<?php
    $sqltotalrinci=$conn->query("
        select sum(nilai) as total from kontrakPengerjaan_rinci where nokontrak='".$_GET['nokontrak']."'
    ");
    $rstotalrinci=$sqltotalrinci->fetch_object();

    $totalrinci=$rstotalrinci->total;

    echo json_encode([
        "totalrincirp"=>rp($totalrinci)
    ]);
?>
<?php include("../../close.php"); ?>