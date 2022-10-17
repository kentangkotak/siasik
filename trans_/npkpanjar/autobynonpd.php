<?php include "../../conn.php";?>
<?php
	
		$sql=$conn->query("select npdpanjar_heder.nonpdpanjar as nonpdpanjar,npdpanjar_heder.tglnpdpanjar as tglnpdpanjar,
						npdpanjar_heder.pptk as pptk,npdpanjar_heder.triwulan as triwulan,
						npdpanjar_heder.program as program,npdpanjar_heder.kegiatan as kegiatan,npdpanjar_heder.kunci as kunci,
						npdpanjar_heder.kodekegiatanblud as kodekegiatanblud,
						npdpanjar_heder.kegiatanblud as kegiatanblud,round(sum(npdpanjar_rinci.totalpermintaanpanjar),2) as total
						from npdpanjar_heder left join npdpanjar_rinci
						on npdpanjar_rinci.nonpdpanjar=npdpanjar_heder.nonpdpanjar
						where year(npdpanjar_heder.tglnpdpanjar)='".$_SESSION["anggaran_tahun"]."' and npdpanjar_heder.flag=''
						and npdpanjar_heder.nonpdpanjar like '%".$_REQUEST['query']."%' and npdpanjar_heder.verif=1
						group by npdpanjar_heder.nonpdpanjar");

		$data=array();
		$data['query']='Usulan';
		if ($sql && $sql->num_rows){
			while($rs = $sql->fetch_object()){
				$data['suggestions'][] = array(
					'value' => htmlentities($rs->nonpdpanjar).'|'.$rs->kegiatanblud ,
					'nonpdpanjar' => htmlentities($rs->nonpdpanjar),
					'tglnpdpanjar' => out_tanggal('-',$rs->tglnpdpanjar),
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