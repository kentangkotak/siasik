<?php include("../../conn.php"); ?>
<?php
    $sqlPagu=$conn->query("
        select 
            total
        from 
            penetapan_pagu 
        where 
            kodekegiatan='".$_GET["kodekegiatan"]."'
            and tahun='".$_SESSION["anggaran_tahun"]."'
    ");
    $rsPagu=$sqlPagu->fetch_object();

    $sqlUsulan=$conn->query("
        select 
            sum(usulanHonor_r.nilai) total
        from 
            usulanHonor_h, 
            usulanHonor_r 
        where
            usulanHonor_h.notrans=usulanHonor_r.notrans
            and usulanHonor_h.kodeKegiatan='".$_GET["kodekegiatan"]."'
            and year(usulanHonor_h.tglTransaksi)='".$_SESSION["anggaran_tahun"]."'
    ");
    $rsUsulan=$sqlUsulan->fetch_object();   

    $pagu=$rsPagu->total;
    $totalUsulan=$rsUsulan->total;
    $sisaPagu = $pagu - $totalUsulan;
    echo json_encode([
        "sisaPagu"=>$sisaPagu,
        "sisaPaguRp"=>rp($sisaPagu),
        "paguRp"=>rp($pagu),
        "totalUsulanRp"=>rp($totalUsulan)
    ]);
?>
<?php include("../../close.php"); ?>