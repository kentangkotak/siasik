<?php include "../../conn.php";?>
<?php
	
	$sql=$conn->query("SELECT * FROM masterPendapatan WHERE rs3 like '".$_REQUEST['query']."%'	");
	$data=array();
	$data['query']='Usulan';
	if ($sql && $sql->num_rows){
		while($rs = $sql->fetch_object()){
			$data['suggestions'][] = array(
				'value' => $rs-> rs3 .' || '. htmlentities($rs->rs4) ,
				'koderekening' => $rs->rs3,
				'uraian' => htmlentities($rs->rs1)			
			);
		}
	}
	
	echo json_encode($data);
	//flush();
?>
	
<?php include "../../close.php";?>