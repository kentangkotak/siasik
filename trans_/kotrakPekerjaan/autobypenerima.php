<?php include "../../conn.php";?>
<?php
    $sql=$conn->query("select * from pihak_ketiga where nama like '%".$_REQUEST['query']."%' ");
	$data=array();
	$data['query']='Usulan';
	if ($sql && $sql->num_rows){
		while($rs = $sql->fetch_object()){
			$data['suggestions'][] = array(
				'value' => htmlentities($rs->nama),
				'nama' => htmlentities($rs->nama),
				'npwp' => htmlentities($rs->npwp),
				'kode' => htmlentities($rs->kode),
				'bank' => htmlentities($rs->bank),
				'norek' => htmlentities($rs->norek)	
			);
		}
	}
	
	echo json_encode($data);
	//flush();
?>
	
<?php include "../../close.php";?>