<?php include "../../conn.php";?>
<?php
    $sql=$conn->query("select npdpanjar_heder.nonpdpanjar as nonpdpanjar,npdpanjar_heder.kodepptk as kodepptk,npdpanjar_heder.pptk as pptk,
						npdpanjar_heder.kodekegiatanblud as kodekegiatanblud,npdpanjar_heder.kegiatanblud as kegiatanblud,npdpanjar_heder.kodebidang as kodebidang,npdpanjar_heder.bidang as bidang,
						npdpanjar_heder.triwulan as triwulan,npdpanjar_rinci.koderek50 as koderek50,npdpanjar_rinci.rincianbelanja50 as rincianbelanja50,
						npdpanjar_rinci.nopp as nopp,npdpanjar_rinci.nousulan as nousulan,sum(npdpanjar_rinci.totalpermintaanpanjar) as total 
						from npdpanjar_heder,npdpanjar_rinci 
						where npdpanjar_heder.nonpdpanjar=npdpanjar_rinci.nonpdpanjar and 
						npdpanjar_heder.nonpdpanjar like '%".$_REQUEST['query']."%' and npdpanjar_heder.kunci='1' and 
						npdpanjar_heder.verif='1' and npdpanjar_heder.flag='1' and npdpanjar_rinci.flaggeser='1' and npdpanjar_rinci.flagverifgeser=''
						group by npdpanjar_heder.nonpdpanjar");
	
	$data=array();
	$data['query']='Usulan';
	if ($sql && $sql->num_rows){
		while($rs = $sql->fetch_object()){
			$data['suggestions'][] = array(
				'value' => htmlentities($rs->nonpdpanjar).'|'.$rs->pptk.'|'.$rs->kegiatanblud.'|'.rpzx($rs->total),
				'nonpdpanjar' => $rs->nonpdpanjar,
				'kodepptk' => $rs->kodepptk,
				'pptk' => $rs->pptk,
				'kodekegiatanblud' => $rs->kodekegiatanblud,
				'kegiatanblud' => $rs->kegiatanblud,
				'kodebidang' => $rs->kodebidang,
				'bidang' => $rs->bidang,
				'koderek50' => $rs->koderek50,
				'rincianbelanja50' => $rs->rincianbelanja50,
				'nopp' => $rs->nopp,
				'nousulan' => $rs->nousulan,
				'total' => rpz($rs->total),
				'triwulan' => $rs->triwulan
			);
		}
	}
	
	echo json_encode($data);
	//flush();
?>
	
<?php include "../../close.php";?>