<?php include "../../conn.php";?>
<?php
$conn_simrs = new mysqli("192.168.11.1","admin","alam01989sa","rs");

    $sql=$conn_simrs->query("select * from rs89 where rs2 like '%".$_REQUEST['query']."%' ");
	$data=array();
	$data['query']='Usulan';
	if ($sql && $sql->num_rows){
		while($rs = $sql->fetch_object()){
			$data['suggestions'][] = array(
				'value' => htmlentities($rs->rs2),
				'kode' => htmlentities($rs->rs1),
				'nama' => htmlentities($rs->rs2)	
			);
		}
	}
	
	echo json_encode($data);
	//flush();
?>
	
<?php include "../../close.php";?>