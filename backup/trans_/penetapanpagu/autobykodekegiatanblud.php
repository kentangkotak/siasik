<?php include "../../conn.php";?>
<?php
	
	$sql=$conn->query("select * from kegiatan_blud where nomenklatur like '".$_REQUEST['query']."%'	");
	$data=array();
	$data['query']='Usulan';
	if ($sql && $sql->num_rows){
		while($rs = $sql->fetch_object()){
			$data['suggestions'][] = array(
				'value' => htmlentities($rs->nomenklatur) .' || '.$rs->organisasi_nama,
				'nomenklatur' => htmlentities($rs->nomenklatur),
				'organisasi_kode1' => $rs->organisasi_kode1,
				'organisasi_kode2' => $rs->organisasi_kode2,
				'organisasi_kode3' => $rs->organisasi_kode3,
				'organisasi_nama' => $rs->organisasi_nama,
				'no' => $rs->no				
			);
		}
	}
	
	echo json_encode($data);
	//flush();
?>
	
<?php include "../../close.php";?>