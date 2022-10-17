<?php include "../../conn.php";?>
<?php
	//if (!isset($_REQUEST['term'])) exit;
	$sql=$conn->query("select nomenklatur,bidang,organisasi_nama from kegiatan_blud where nomenklatur like '%".$_REQUEST['query']."%'");
	$data=array();
	$data['query']='Usulan';
	if ($sql && $sql->num_rows){
		while($rs = $sql->fetch_object()){
			$data['suggestions'][] = array(
				'value' => $rs-> nomenklatur,
				'nomenklatur' => $rs->nomenklatur,
				'bidang' => $rs->bidang,
				'organisasi_nama' => $rs->organisasi_nama
			);
		}
	}

	echo json_encode($data);
	//flush();
?>
	
<?php include "../../close.php";?>