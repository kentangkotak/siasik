<?php include "../../conn.php";?>
<?php
    $sql=$conn->query("select penyesesuaianperioritas_heder.kodekegiatan as kodekegiatan,penyesesuaianperioritas_heder.kegiatan as kegiatanblud,penyesesuaianperioritas_rinci.koderek50 as koderek50,
					penyesesuaianperioritas_rinci.uraian50 as uraian50,
					penyesesuaianperioritas_rinci.nilai as total
					from penyesesuaianperioritas_heder,penyesesuaianperioritas_rinci
					where penyesesuaianperioritas_heder.notrans=penyesesuaianperioritas_rinci.notrans and penyesesuaianperioritas_heder.kodekegiatan='".$_GET[kodekegiatan]."' and
					penyesesuaianperioritas_rinci.kunci=''
					and year(penyesesuaianperioritas_heder.tgltrans)='".$_SESSION["anggaran_tahun"]."' and penyesesuaianperioritas_rinci.uraian50 like '%".$_REQUEST['query']."%' 
					group by penyesesuaianperioritas_rinci.koderek50");
	$data=array();
	$data['query']='Usulan';
	if ($sql && $sql->num_rows){
		while($rs = $sql->fetch_object()){
			$data['suggestions'][] = array(
				'value' => htmlentities($rs->uraian50),
				'uraian50' => htmlentities($rs->uraian50),
				'koderek50' => htmlentities($rs->koderek50)	
			);
		}
	}
	
	echo json_encode($data);
	//flush();
?>
	
<?php include "../../close.php";?>