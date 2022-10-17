<?php include "../../conn.php";?>
<?php
	
	$sql=$conn->query("select * from kegiatan_blud where nomenklatur like '%".$_REQUEST['query']."%' and tahun='".$_SESSION["anggaran_tahun"]."' and flag=''");
	$data=array();
	$data['query']='Usulan';
	if ($sql && $sql->num_rows){
		while($rs = $sql->fetch_object()){
			$data['suggestions'][] = array(
				'value' => htmlentities($rs->nomenklatur) .' || '. $rs->organisasi_nama,
				'nomenklatur' => htmlentities($rs->nomenklatur),
				'kode' => $rs->no
			);
		}
	}
	
	echo json_encode($data);
	//flush();
?>
	
<?php include "../../close.php";?>