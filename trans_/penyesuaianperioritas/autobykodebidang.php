<?php include "../../conn.php";?>
<?php
	
	$sql=$conn->query("select kodebidangmusrenbang as kode,bidanganggaran as nama,concat_ws('.',kode1,kode2,kode3) as kodeorganisasi from 
						mappingjenisusulan where bidanganggaran like '".$_REQUEST['query']."%' group by bidanganggaran	");
	$data=array();
	$data['query']='Usulan';
	if ($sql && $sql->num_rows){
		while($rs = $sql->fetch_object()){
			$data['suggestions'][] = array(
				'value' => htmlentities($rs->nama) .' || '.$rs->kodeorganisasi,
				'nama' => htmlentities($rs->nama),
				'organisasi_kode1' => $rs->organisasi_kode1,
				'organisasi_kode2' => $rs->organisasi_kode2,
				'organisasi_kode3' => $rs->organisasi_kode3,
				'kodeorganisasi' => $rs->kodeorganisasi,
				'kode' => $rs->kode				
			);
		}
	}
	
	echo json_encode($data);
	//flush();
?>
	
<?php include "../../close.php";?>