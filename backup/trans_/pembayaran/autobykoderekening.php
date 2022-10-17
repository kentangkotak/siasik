<?php include "../../conn.php";?>
<?php
	//if (!isset($_REQUEST['term'])) exit;
	$sql=$conn->query("select rs2 as koderekening from rs6 where rs2 like '%".$_GET['query']."%' group by rs2 ");
	$data=array();
	$data['query']='Kode Rekening';
	if ($sql && $sql->num_rows){
		while($rs = $sql->fetch_object()){
			$data['suggestions'][] = array(
				'value' => $rs->koderekening ,
				'data' => $rs->koderekening,
				'koderekening' => $rs->koderekening,
			);
		}
	}

	echo json_encode($data);
	//flush();
?>
	
<?php include "../../close.php";?>