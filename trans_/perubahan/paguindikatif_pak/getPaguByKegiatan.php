<?php include("../../../conn.php"); ?>
<?php
    $sqlPendapatanAwal=$conn->query("
        select 
            sum(nilai) as total
        from 
            anggaran_pendapatan 
        where 
			tahun='".$_SESSION["anggaran_tahun"]."'
    ");
    $rsPendapatanAwal=$sqlPendapatanAwal->fetch_object();

    $sqlPendapatanPerubahan=$conn->query(" select sum(subtotal) as saldo from(
											select t_tampung_pendapatan.saldo as subtotal 
											from anggaran_pendapatan,t_tampung_pendapatan where anggaran_pendapatan.tahun='".$_SESSION["anggaran_tahun"]."' 
											and t_tampung_pendapatan.notrans=anggaran_pendapatan.notrans
											union all
											select t_tampung_pendapatan.saldo as subtotal 
											from perubahan,t_tampung_pendapatan where perubahan.tahun='".$_SESSION["anggaran_tahun"]."' and perubahan.statusperubahan=2
											and t_tampung_pendapatan.notrans=perubahan.notrans group by perubahan.notrans) as wew											
    ");
    $rsPendapatanPerubahan=$sqlPendapatanPerubahan->fetch_object();   

    $pendapatanAwal=$rsPendapatanAwal->total;
    $pendapatanPerubahan=$rsPendapatanPerubahan->saldo;
	$sisa=$pendapatanPerubahan - $pendapatanAwal;
    echo json_encode([
        "pendapatanAwalrp"=>rpzx($pendapatanAwal),
        "pendapatanPerubahanrp"=>rpzx($pendapatanPerubahan),
		"sisarp"=>rpzx($sisa)
    ]);
?>
<?php include("../../../close.php"); ?>