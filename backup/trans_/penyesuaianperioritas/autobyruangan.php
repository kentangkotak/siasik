<?php include "../../conn.php";?>
<?php
	$conn_musrenbang = new mysqli("localhost","admin","alam02018sa","musrenbang");
    $sql=$conn_musrenbang->query("select * from rs3 where rs2 like '%".$_REQUEST['query']."%' ");
	$data=array();
	$data['query']='Usulan';
	if ($sql && $sql->num_rows){
		while($rs = $sql->fetch_object()){
			$data['suggestionx'][] = array(
				'value' => htmlentities($rs->rs2),
				'ruangan' => htmlentities($rs->rs2),
				'kode' => htmlentities($rs->rs1)	
			);
		}
	}
	
	echo json_encode($data);
	//flush();
?>
	
<?php include "../../close.php";?>