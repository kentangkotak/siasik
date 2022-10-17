<?php include "../../conn.php";?>
<?php
	
	$sql=$conn->query("select * from masterRekBank where bank like '".$_REQUEST['query']."%'	");
	$data=array();
	$data['query']='Usulan';
	if ($sql && $sql->num_rows){
		while($rs = $sql->fetch_object()){
			$data['suggestions'][] = array(
				'value' => htmlentities($rs->bank) .' || '.$rs->kodeRek,
				'kodeRek' => htmlentities($rs->kodeRek),
				'namabank' => htmlentities($rs->bank)
			);
		}
	}
	
	echo json_encode($data);
	//flush();
?>
	
<?php include "../../close.php";?>