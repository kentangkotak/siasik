<?php include "../../conn.php";?>
<?php
	
	$sql=$conn->query("SELECT * FROM masterPendapatan WHERE rs1 like '%".$_REQUEST['query']."%'	");
	$data=array();
	$data['query']='Usulan';
	if ($sql && $sql->num_rows){
		while($rs = $sql->fetch_object()){
			$data['suggestions'][] = array(
				'value' => htmlentities($rs->rs1)  .' || '. $rs->rs3 ,
				'koderekening' => $rs->rs3,
				'map79' => $rs->rs2,
				'uraian' => htmlentities($rs->rs1)			
			);
		}
	}
	
	echo json_encode($data);
	//flush();
?>
	
<?php include "../../close.php";?>