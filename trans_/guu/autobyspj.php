<?php include "../../conn.php";?>
<?php

	$sql=$conn->query("select spjpanjar_heder.nospjpanjar as nospjpanjar,spjpanjar_heder.tglspjpanjar as tglspjpanjar,spjpanjar_heder.kegiatan as kegiatan,
					spjpanjar_heder.kodekegiatanblud as kodekegiatanblud,spjpanjar_heder.kegiatanblud as kegiatanblud,sum(spjpanjar_rinci.jumlahbelanjapanjar) as jumlah
					from spjpanjar_heder,spjpanjar_rinci
					where spjpanjar_heder.nospjpanjar=spjpanjar_rinci.nospjpanjar and spjpanjar_heder.nospjpanjar like '%".$_REQUEST['query']."%' and 
					year(spjpanjar_heder.tglspjpanjar)='".$_SESSION["anggaran_tahun"]."' and spjpanjar_heder.kunci=1 and spjpanjar_heder.flag='' and spjpanjar_heder.verif=1
					group by spjpanjar_heder.nospjpanjar ");
	$data=array();
	$data['query']='Usulan';
	if ($sql && $sql->num_rows){
		while($rs = $sql->fetch_object()){
			$data['suggestions'][] = array(
				'value' => htmlentities($rs->nospjpanjar).' ==> '.htmlentities(out_tanggal('-',$rs->tglspjpanjar)).' ==> '.htmlentities($rs->kegiatan).' ==> '.htmlentities($rs->kegiatanblud).' ==> '.htmlentities(rpx($rs->jumlah)),
				'nospjpanjar' => htmlentities($rs->nospjpanjar),
				'tglspjpanjar' => htmlentities(out_tanggal('-',$rs->tglspjpanjar)),
				'kegiatan' => htmlentities($rs->kegiatan),
				'kodekegiatanblud' => htmlentities($rs->kodekegiatanblud),
				'kegiatanblud' => htmlentities($rs->kegiatanblud),
				'jumlah' => htmlentities(rpz($rs->jumlah))
			);
		}
	}
	
	echo json_encode($data);
	//flush();
?>
	
<?php include "../../close.php";?>