<?php include "../../conn.php";?>
<?php

	$sql=$conn->query("select serahterima_heder.nokontrak as nokontrak,serahterima_heder.kodepihakketiga as kodepihakketiga,serahterima_heder.namaperusahaan as perusahaan,
						serahterima_heder.program as program,serahterima_heder.kegiatan as kegiatan,serahterima_heder.kodekegiatanblud as kodekegiatanblud,serahterima_heder.kegiatanblud as kegiatanblud,
						pihak_ketiga.bank as bank,pihak_ketiga.norek as norek,pihak_ketiga.npwp as npwp,serahterima_heder.kode50 as koderek50,serahterima_heder.uraianpekerjaan as uraianpekerjaan
						from serahterima_heder,pihak_ketiga
						where pihak_ketiga.kode=serahterima_heder.kodepihakketiga and serahterima_heder.flag='' and serahterima_heder.kunci=1 and
						serahterima_heder.kodepptk='".$_GET['kodepptk']."' and serahterima_heder.nokontrak like '%".$_REQUEST['query']."%' ");
	$data=array();
	$data['query']='Usulan';
	if ($sql && $sql->num_rows){
		while($rs = $sql->fetch_object()){
			$data['suggestions'][] = array(
				'value' => htmlentities($rs->nokontrak).'||'.htmlentities($rs->kegiatanblud).'||'.htmlentities($rs->perusahaan).'||'.htmlentities($rs->kegiatan),
				'kegiatan' => htmlentities($rs->kegiatan),
				'kodepihakketiga' => htmlentities($rs->kodepihakketiga),
				'perusahaan' => htmlentities($rs->perusahaan),
				'program' => htmlentities($rs->program),
				'kodekegiatanblud' => htmlentities($rs->kodekegiatanblud),
				'kegiatanblud' => htmlentities($rs->kegiatanblud),
				'bank' => htmlentities($rs->bank),
				'norek' => htmlentities($rs->norek),
				'nokontrak' => htmlentities($rs->nokontrak),
				'koderek50' => htmlentities($rs->koderek50),
				'uraianpekerjaan' => htmlentities($rs->uraianpekerjaan),
				'npwp' => htmlentities($rs->npwp)
			);
		}
	}
	
	echo json_encode($data);
	//flush();
?>
	
<?php include "../../close.php";?>