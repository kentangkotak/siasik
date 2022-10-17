<?php include "../../conn.php";?>
<?php
	
	$sql=$conn->query("select kontrakPengerjaan_header.id as kodeid,kontrakPengerjaan_header.nokontrak as notrans,kontrakPengerjaan_header.kodeperusahaan as kodeperusahaan,
						kontrakPengerjaan_header.namaperusahaan as namaperusahaan,kontrakPengerjaan_header.tglmulaikontrak as tglmulaikontrak,
						kontrakPengerjaan_header.tglakhirkontrak as tglakhirkontrak,kontrakPengerjaan_header.tgltrans as tgltrans,kontrakPengerjaan_header.kodepptk as kodepptk,
						kontrakPengerjaan_header.namapptk as namapptk,kontrakPengerjaan_header.program as program,kontrakPengerjaan_header.kegiatan as kegiatan,
						kontrakPengerjaan_header.kodekegiatanblud as kodekegiatanblud,kontrakPengerjaan_header.kegiatanblud as kegiatanblud,kontrakPengerjaan_header.kode50 as kode50,
						kontrakPengerjaan_header.uraianpekerjaan as  uraianpekerjaan,kontrakPengerjaan_header.nilaikegiatan as nilaikegiatan,kontrakPengerjaan_rinci.nofaktur as nofaktur,
						kontrakPengerjaan_rinci.nilai as nilai
						from kontrakPengerjaan_header,kontrakPengerjaan_rinci
						where kontrakPengerjaan_header.nokontrak=kontrakPengerjaan_rinci.nokontrak and kontrakPengerjaan_header.kunci=1 and kontrakPengerjaan_header.flag=''
						and kontrakPengerjaan_rinci.nofaktur like '%".$_REQUEST['query']."%' and year(kontrakPengerjaan_header.tglmulaikontrak)='".$_SESSION["anggaran_tahun"]."' group by kontrakPengerjaan_header.nokontrak");
	$data=array();
	$data['query']='Usulan';
	if ($sql && $sql->num_rows){
		while($rs = $sql->fetch_object()){
			$data['suggestions'][] = array(
				'value' => htmlentities($rs->nofaktur).'|'.htmlentities($rs->namaperusahaan).'|'.out_tanggal("-",$rs->tglmulaikontrak).'|'.
				 htmlentities($rs->namapptk).'|'.htmlentities($rs->program).'|'.htmlentities($rs->kegiatan).'|'.htmlentities($rs->kegiatanblud).'|'.htmlentities($rs->uraianpekerjaan) ,
				'nokontrak' => htmlentities($rs->nofaktur),
				'kodeperusahaan' => htmlentities($rs->kodeperusahaan),
				'namaperusahaan' => htmlentities($rs->namaperusahaan),
				'tglmulaikontrak' => out_tanggal("-",$rs->tglmulaikontrak),
				'tglakhirkontrak' => out_tanggal("-",$rs->tglakhirkontrak),
				'tgltrans' => htmlentities($rs->tgltrans),
				'kodepptk' => htmlentities($rs->kodepptk),
				'namapptk' => htmlentities($rs->namapptk),
				'program' => htmlentities($rs->program),
				'kegiatan' => htmlentities($rs->kegiatan),
				'uraianpekerjaan' => htmlentities($rs->uraianpekerjaan),
				'kode50' => htmlentities($rs->kode50),
				'kodekegiatanblud' => htmlentities($rs->kodekegiatanblud),
				'kegiatanblud' => htmlentities($rs->kegiatanblud),
				'kodeid' => htmlentities($rs->kodeid),
				'nilaikegiatan' => rpz($rs->nilai)
			);
		}
	}
	
	echo json_encode($data);
	//flush();
?>
	
<?php include "../../close.php";?>