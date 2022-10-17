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

    $sqlPendapatanPerubahan=$conn->query("select sum(t_tampung_pendapatan.pagu) as subtotal 
											from anggaran_pendapatan,t_tampung_pendapatan where anggaran_pendapatan.tahun='".$_SESSION["anggaran_tahun"]."' 
											and t_tampung_pendapatan.notrans=anggaran_pendapatan.notrans
    ");
    $rsPendapatanPerubahan=$sqlPendapatanPerubahan->fetch_object();   

    $pendapatanAwal=$rsPendapatanAwal->total;
    $pendapatanPerubahan=$rsPendapatanPerubahan->subtotal;
	$sisa=$pendapatanPerubahan - $pendapatanAwal;
    echo json_encode([
        "pendapatanAwalrp"=>rpzx($pendapatanAwal),
        "pendapatanPerubahanrp"=>rpzx($pendapatanPerubahan),
		"sisarp"=>rpzx($sisa)
    ]);
?>
<?php include("../../../close.php"); ?>