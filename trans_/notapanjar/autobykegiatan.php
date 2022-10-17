<?php include "../../conn.php";?>
<?php

	$sql=$conn->query("select * from mappingpptkkegiatan where kegiatan like '%".$_REQUEST['query']."%' and kodepptk='".$_GET['nip']."'  ");
	$data=array();
	$data['query']='Usulan';
	if ($sql && $sql->num_rows){
		while($rs = $sql->fetch_object()){
			$data['suggestions'][] = array(
				'value' => htmlentities($rs->kegiatan),
				'kegiatan' => htmlentities($rs->kegiatan),
				'kodekegiatan' => htmlentities($rs->kodekegiatan)	
			);
		}
	}
	
	echo json_encode($data);
	//flush();
?>
	
<?php include "../../close.php";?>