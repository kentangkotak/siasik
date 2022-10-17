<?php include "../../conn.php";?>
<?php
    $sql=$conn->query("select spjpanjar_heder.nospjpanjar as nospjpanjar,spjpanjar_heder.kodepptk as kodepptk,spjpanjar_heder.namapptk as namapptk,spjpanjar_heder.program as program,
						spjpanjar_heder.kegiatan as kegiatan,spjpanjar_heder.kodekegiatanblud as kodekegiatanblud,spjpanjar_heder.kegiatanblud as kegiatanblud
						from spjpanjar_heder,spjpanjar_rinci
						where spjpanjar_heder.nospjpanjar=spjpanjar_rinci.nospjpanjar and spjpanjar_heder.nospjpanjar like '%".$_REQUEST['query']."%' 
						and spjpanjar_rinci.flag='' and  
						year(spjpanjar_heder.tglspjpanjar)='".$_SESSION["anggaran_tahun"]."' ");
	$data=array();
	$data['query']='Usulan';
	if ($sql && $sql->num_rows){
		while($rs = $sql->fetch_object()){
			$data['suggestions'][] = array(
				'value' => htmlentities($rs->nospjpanjar).' ==> '.$rs->namapptk.' ==> '.$rs->program.' ==> '.$rs->kegiatan.' ==> '.$rs->kegiatanblud,
				'nospjpanjar' => htmlentities($rs->nospjpanjar),
				'kodepptk' => htmlentities($rs->kodepptk),
				'namapptk' => htmlentities($rs->namapptk),
				'program' => htmlentities($rs->program),
				'kegiatan' => htmlentities($rs->kegiatan),
				'kodekegiatanblud' => htmlentities($rs->kodekegiatanblud),
				'kegiatanblud' => htmlentities($rs->kegiatanblud)
			);
		}
	}
	
	echo json_encode($data);
	//flush();
?>
	
<?php include "../../close.php";?>