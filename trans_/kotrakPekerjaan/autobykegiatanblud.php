<?php include "../../conn.php";?>
<?php
	$data=explode( '|', $_GET['pptk'] );
	$kodepptk=$data[0];
	$pptk=$data[1];
	
	$sql=$conn->query("select penyesesuaianperioritas_heder.notrans as notrans,penyesesuaianperioritas_heder.kodepptk as kodepptk,penyesesuaianperioritas_heder.pptk as pptk,
						penyesesuaianperioritas_rinci.koderek50 as koderek50,penyesesuaianperioritas_rinci.uraian50 as uraian50,penyesesuaianperioritas_rinci.usulan as usulan,
						penyesesuaianperioritas_heder.kodekegiatan as kodekegiatanblud,penyesesuaianperioritas_heder.kegiatan as kegiatanblud
						from penyesesuaianperioritas_heder,penyesesuaianperioritas_rinci
						where penyesesuaianperioritas_heder.notrans=penyesesuaianperioritas_rinci.notrans 
						and year(penyesesuaianperioritas_heder.tgltrans)='".$_SESSION["anggaran_tahun"]."' and penyesesuaianperioritas_heder.kunci=1 and
						penyesesuaianperioritas_rinci.usulan like '%".$_REQUEST['query']."%' and penyesesuaianperioritas_heder.kodepptk='".$kodepptk."' group by notrans");
	$data=array();
	$data['query']='Usulan';
	if ($sql && $sql->num_rows){
		while($rs = $sql->fetch_object()){
			$data['suggestions'][] = array(
				'value' => htmlentities($rs->kegiatanblud) ,
				'kegiatanblud' => htmlentities($rs->kegiatanblud),
				'kodekegiatanblud' => htmlentities($rs->kodekegiatanblud)
			);
		}
	}
	
	echo json_encode($data);
	//flush();
?>
	
<?php include "../../close.php";?>