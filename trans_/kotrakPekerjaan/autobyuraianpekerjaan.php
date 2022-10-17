<?php include "../../conn.php";?>
<?php
	$data=explode( '|', $_GET['pptk'] );
	$kodepptk=$data[0];
	$pptk=$data[1];
	
	$sql=$conn->query("select penyesesuaianperioritas_heder.notrans as notrans,penyesesuaianperioritas_heder.kodepptk as kodepptk,penyesesuaianperioritas_heder.pptk as pptk,
						penyesesuaianperioritas_rinci.koderek50 as koderek50,penyesesuaianperioritas_rinci.uraian50 as uraian50,penyesesuaianperioritas_rinci.nilai as nilai,
						penyesesuaianperioritas_heder.kodekegiatan as kodekegiatanblud,penyesesuaianperioritas_heder.kegiatan as kegiatanblud
						from penyesesuaianperioritas_heder,penyesesuaianperioritas_rinci
						where penyesesuaianperioritas_heder.notrans=penyesesuaianperioritas_rinci.notrans 
						and year(penyesesuaianperioritas_heder.tgltrans)='".$_SESSION["anggaran_tahun"]."' and penyesesuaianperioritas_heder.kodekegiatan='".$_GET['kodekegiatanblud']."'
						and penyesesuaianperioritas_rinci.uraian50 like '%".$_REQUEST['query']."%' 
						group by penyesesuaianperioritas_rinci.koderek50");
	$data=array();
	$data['query']='Usulan';
	if ($sql && $sql->num_rows){
		while($rs = $sql->fetch_object()){
			$data['suggestions'][] = array(
				'value' => htmlentities($rs->uraian50) ,
				'koderek50' => htmlentities($rs->koderek50),
				'uraian50' => htmlentities($rs->uraian50),
				'nilai' => rpz($rs->nilai)
			);
		}
	}
	
	echo json_encode($data);
	//flush();
?>
	
<?php include "../../close.php";?>