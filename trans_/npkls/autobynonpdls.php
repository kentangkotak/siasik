<?php include "../../conn.php";?>
<?php
	
		$sql=$conn->query("select npdls_heder.nonpdls as nonpdls,npdls_heder.tglnpdls as tglnpdls,npdls_heder.kegiatan as kegiatan,npdls_heder.kodekegiatanblud as kodekegiatanblud,
							npdls_heder.kegiatanblud as kegiatanblud,sum(npdls_rinci.total) as total
							from npdls_heder left join npdls_rinci on
							npdls_heder.nonpdls=npdls_rinci.nonpdls
							where year(npdls_heder.tglnpdls)='".$_SESSION["anggaran_tahun"]."' and npdls_heder.kunci=1 and npdls_heder.verif=1 and npdls_heder.flag=''
							and npdls_heder.nonpdls like '%".$_REQUEST['query']."%'
							group by npdls_heder.nonpdls");

		$data=array();
		$data['query']='Usulan';
		if ($sql && $sql->num_rows){
			while($rs = $sql->fetch_object()){
				$data['suggestions'][] = array(
					'value' => htmlentities($rs->nonpdls).'|'.$rs->kegiatanblud ,
					'nonpdls' => htmlentities($rs->nonpdls),
					'tglnpdls' => out_tanggal('-',$rs->tglnpdls),
					'kegiatan' => htmlentities($rs->kegiatan),
					'kodekegiatanblud' => htmlentities($rs->kodekegiatanblud),
					'kegiatanblud' => htmlentities($rs->kegiatanblud),
					'total' => rpz($rs->total)		
				);
			}
		}
		
		echo json_encode($data);
		//flush();
?>
	
<?php include "../../close.php";?>