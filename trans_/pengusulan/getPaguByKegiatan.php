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

    $sqlPrioritas=$conn->query("
        select 
            sum(penyesesuaianperioritas_rinci.nilai) total
        from 
            penyesesuaianperioritas_heder, 
            penyesesuaianperioritas_rinci 
        where
            penyesesuaianperioritas_heder.notrans=penyesesuaianperioritas_rinci.notrans
            and penyesesuaianperioritas_heder.kodekegiatan='".$_GET["kodekegiatan"]."'
            and year(penyesesuaianperioritas_heder.tgltrans)='".$_SESSION["anggaran_tahun"]."'
    ");
    $rsPrioritas=$sqlPrioritas->fetch_object();

    $pagu=$rsPagu->total;
    $totalUsulan=$rsUsulan->total;
    $totalPrioritas=$rsPrioritas->total;
    $sisaPagu = $pagu - $totalUsulan;
    $sisaPaguPrioritas = $pagu - $totalPrioritas;

    echo json_encode([
        "sisaPagu"=>$sisaPagu,
        "sisaPaguRp"=>rp($sisaPagu),
        "sisaPaguPrioritas"=>$sisaPaguPrioritas,
        "sisaPaguPrioritasRp"=>rp($sisaPaguPrioritas),
        "paguRp"=>rp($pagu),
        "totalUsulanRp"=>rp($totalUsulan),
        "totalPrioritas"=>$totalPrioritas,
        "totalPrioritasRp"=>rp($totalPrioritas)
    ]);
?>
<?php include("../../close.php"); ?>