<?php include "../../conn.php";?>
<?php
    $sql=$conn->query("select * from serahterima_rinci where nokontrak='".$_GET[nokontrak]."' and keterangan like '%".$_REQUEST['query']."%' and flag='' ");
	$data=array();
	$data['query']='Usulan';
	if ($sql && $sql->num_rows){
		while($rs = $sql->fetch_object()){
			$data['suggestions'][] = array(
				'value' => htmlentities($rs->nopenerimaan).' ==> '.htmlentities($rs->keterangan).' ==> '.htmlentities(rpz($rs->nilai)),
				'nopenerimaan' => htmlentities($rs->nopenerimaan),
				'keterangan' => htmlentities($rs->keterangan),
				'idserahterima_rinci' => htmlentities($rs->id),
				'nilai' => htmlentities(rpz($rs->nilai))	
			);
		}
	}
	
	echo json_encode($data);
	//flush();
?>
	
<?php include "../../close.php";?>