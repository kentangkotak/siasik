<?php include "../../conn.php";?>
<?php

    $sql=$conn->query("select concat_ws('.',kode1,kode2,kode3,kode4,kode5,kode6,kode7) kode108,uraian,
	concat_ws('.',blud_akun,blud_kelompok,blud_jenis,blud_objectx,blud_rincian,blud_subrincian) as kode50,blud_uraian
    from akun_permendagri108 where uraian like '".$_REQUEST['query']."%' and kode7<>''");
	$data=array();
	$data['query']='Usulan';
	if ($sql && $sql->num_rows){
		while($rs = $sql->fetch_object()){
			$data['suggestions'][] = array(
				'value' => htmlentities($rs->uraian." || ".$rs->kode108),
				'uraian108' => htmlentities($rs->uraian),
				'kode108' => htmlentities($rs->kode108),
				'blud_uraian' => htmlentities($rs->blud_uraian),
				'kode50' => htmlentities($rs->kode50)			
			);
		}
	}
	
	echo json_encode($data);
	//flush();
?>
	
<?php include "../../close.php";?>