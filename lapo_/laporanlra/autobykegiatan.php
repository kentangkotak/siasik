<?php include "../../conn.php";?>
<?php
	
	$sql=$conn->query("select no as no,nomenklatur as nomenklatur,concat_ws('.',organisasi_kode1,organisasi_kode2,organisasi_kode3) as kodebagian,organisasi_nama as organisasi_nama,
	concat_ws('.',kode1,kode2,kode3,kode4,kode5) as kode50,uraian as uraian from kegiatan_blud where flag='' 
	and nomenklatur like '%".$_REQUEST['query']."%' and tahun='".$_SESSION["anggaran_tahun"]."' and flag='' ");
	$data=array();
	$data['query']='Usulan';
	if ($sql && $sql->num_rows){
		while($rs = $sql->fetch_object()){
			$data['suggestions'][] = array(
				'value' => htmlentities($rs->nomenklatur) ,
				'no' => htmlentities($rs->no),
				'nomenklatur' => htmlentities($rs->nomenklatur)
			);
		}
	}
	
	echo json_encode($data);
	//flush();
?>
	
<?php include "../../close.php";?>