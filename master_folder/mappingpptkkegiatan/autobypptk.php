<?php include "../../conn.php";?>
<?php
	
	$sql=$conn->query("select * from pptk where nama like '%".$_REQUEST['query']."%' and tahun='".$_SESSION["anggaran_tahun"]."' and flag=''	");
	$data=array();
	$data['query']='Usulan';
	if ($sql && $sql->num_rows){
		while($rs = $sql->fetch_object()){
			$data['suggestions'][] = array(
				'value' => htmlentities($rs->nama) .' || '.$rs->nip,
				'nip' => $rs->nip,
				'bagian' => $rs->bagian,
				'kodebagian' => $rs->kodeBagian,
				'alias' => $rs->alias,
				'nama' => $rs->nama
			);
		}
	}
	
	echo json_encode($data);
	//flush();
?>
	
<?php include "../../close.php";?>