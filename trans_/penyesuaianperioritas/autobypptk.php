<?php include "../../conn.php";?>
<?php
	
	$sql=$conn->query("select * from pptk where nama like '%".$_REQUEST['query']."%' and bagian='".$_SESSION["anggaran_ruangan"]."' ");
	$data=array();
	$data['query']='Usulan';
	if ($sql && $sql->num_rows){
		while($rs = $sql->fetch_object()){
			$data['suggestions'][] = array(
				'value' => htmlentities($rs->nama) ,
				'nama' => htmlentities($rs->nama),
				'kodebagian' => htmlentities($rs->kodeBagian),
				'bagian' => htmlentities($rs->bagian),
				'kodebidangx' => htmlentities($rs->koderuanganmr),
				'nip' => $rs->nip		
			);
		}
	}
	
	echo json_encode($data);
	//flush();
?>
	
<?php include "../../close.php";?>