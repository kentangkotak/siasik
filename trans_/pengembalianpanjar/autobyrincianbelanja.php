<?php include "../../conn.php";?>
<?php
    $sql=$conn->query("select npdpanjar_heder.nonpdpanjar as nonpdpanjar,npdpanjar_rinci.koderek50 as koderek50,npdpanjar_rinci.rincianbelanja50 as rincianbelanja50,
						npdpanjar_rinci.totalpermintaanpanjar as total
						from npdpanjar_heder,npdpanjar_rinci
						where npdpanjar_heder.nonpdpanjar=npdpanjar_rinci.nonpdpanjar and npdpanjar_rinci.rincianbelanja50 like '%".$_REQUEST['query']."%' 
						and year(npdpanjar_heder.tglnpdpanjar)='".$_SESSION["anggaran_tahun"]."' and npdpanjar_heder.kodekegiatanblud='".$_GET['kodekegiatanblud']."'
						group by npdpanjar_rinci.koderek50");
	$data=array();
	$data['query']='Usulan';
	if ($sql && $sql->num_rows){
		while($rs = $sql->fetch_object()){
			$data['suggestions'][] = array(
				'value' => htmlentities($rs->rincianbelanja50),
				'rincianbelanja50' => htmlentities($rs->rincianbelanja50),
				'koderek50' => htmlentities($rs->koderek50)	
			);
		}
	}
	
	echo json_encode($data);
	//flush();
?>
	
<?php include "../../close.php";?>