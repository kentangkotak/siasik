<?php include "../../conn.php";?>
<?php
	//if (!isset($_REQUEST['term'])) exit;
	$sql=$conn->query("select * from akun_permendagri79
	where uraian like '%".$_GET['query']."%'");
	$data=array();
	$data['query']='Akun Permendagri 79';
	if ($sql && $sql->num_rows){
		while($rs = $sql->fetch_object()){
			$data['suggestions'][] = array(
				'value' => $rs->uraian,
				'kode1' => $rs->kode1,
				'kode2' => $rs->kode2,
				'kode3' => $rs->kode3
			);
		}
	}

	echo json_encode($data);
	//flush();
?>
	
<?php include "../../close.php";?>