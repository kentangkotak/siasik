<?php include "../../conn.php";?>
<?php

	$sql=$conn->query("select * from masterRekBank where bank like '%".$_REQUEST['query']."%' and flag=''  ");
	$data=array();
	$data['query']='Usulan';
	if ($sql && $sql->num_rows){
		while($rs = $sql->fetch_object()){
			$data['suggestions'][] = array(
				'value' => htmlentities($rs->bank),
				'bank' => htmlentities($rs->bank),
				'kode' => htmlentities($rs->kodebank),
				'koderek' => htmlentities($rs->kodeRek)	
			);
		}
	}
	
	echo json_encode($data);
	//flush();
?>
	
<?php include "../../close.php";?>