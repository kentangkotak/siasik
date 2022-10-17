<?php include "../../conn.php";?>
<?php

    $sql=$conn->query("select concat_ws('.',kode1,kode2,kode3,kode4,kode5,kode6) kode,uraian 
    from akun_permendagri50 where uraian like '%".$_REQUEST['query']."%' and kode6<>'' and kode1=5");
	$data=array();
	$data['query']='Usulan';
	if ($sql && $sql->num_rows){
		while($rs = $sql->fetch_object()){
			$data['suggestions'][] = array(
				'value' => htmlentities($rs->uraian." || ".$rs->kode),
				'uraian' => htmlentities($rs->uraian),
				'kode' => htmlentities($rs->kode)	
			);
		}
	}
	
	echo json_encode($data);
	//flush();
?>
	
<?php include "../../close.php";?>