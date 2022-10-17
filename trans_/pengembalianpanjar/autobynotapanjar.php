<?php include "../../conn.php";?>
<?php
	
	$sql=$conn->query("select notapanjar_rinci.nonotapanjar as nonotapanjar,notapanjar_heder.kodepptk as kodepptk,notapanjar_heder.pptk as pptk,notapanjar_heder.program as program,
						notapanjar_heder.kegiatan as kegiatan,notapanjar_heder.kodekegiatanblud as kodekegiatanblud,notapanjar_heder.kegiatanblud as kegiatanblud,
						notapanjar_rinci.total as total
						from notapanjar_heder,notapanjar_rinci
						where notapanjar_rinci.nonotapanjar=notapanjar_heder.nonotapanjar and notapanjar_heder.nonotapanjar like '%".$_REQUEST['query']."%'  ");
	$data=array();
	$data['query']='Usulan';
	if ($sql && $sql->num_rows){
		while($rs = $sql->fetch_object()){
			$data['suggestions'][] = array(
				'value' => htmlentities($rs->nonotapanjar).' | '.$rs->kegiatanblud ,
				'nonotapanjar' => htmlentities($rs->nonotapanjar),
				'kodepptk' => htmlentities($rs->kodepptk),
				'pptk' => $rs->pptk,
				'program' => $rs->program,
				'kegiatan' => $rs->kegiatan,
				'kodekegiatanblud' => $rs->kodekegiatanblud,
				'total' => rpz($rs->total),
				'kegiatanblud' => $rs->kegiatanblud
			);
		}
	}
	
	echo json_encode($data);
	//flush();
?>
	
<?php include "../../close.php";?>