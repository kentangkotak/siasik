<?php include("../../conn.php"); ?>
<?php
    $sql=$conn->query("select sum(serahterima_rinci.tagihanfaktur) as total 
							from serahterima_rinci,serahterima_heder where serahterima_rinci.noserahterimapekerjaan='".$_GET['noserahterimapekerjaan']."' 
							and year(serahterima_heder.tgltrans)='".$_SESSION["anggaran_tahun"]."' and serahterima_rinci.noserahterimapekerjaan=serahterima_heder.noserahterimapekerjaan");
    $rs=$sql->fetch_object();

    $totalrinci = $rs->total;
    echo json_encode([
        "totalrinci"=>rpz($totalrinci)
    ]);
?>
<?php include("../../close.php"); ?>