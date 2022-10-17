<?php "../../../conn.php";?>
<?php
	$conn_simrs = new mysqli("192.168.11.1","admin","alam01989sa","rs");
	$sql=$conn_simrs->query("select nopenerimaan,nofaktur,suplier,tglfaktur,tgljatuhtempo,round(diskon),sum(subtotal) as totalbelumppn,round(sum(subtotal)*pajakppn/100,2) as ppn,
		round(sum(subtotal)+sum(subtotal)*pajakppn/100,2) as total from(
          select rs81.rs1 as nopenerimaan,rs81.rs5 as nofaktur,rs89.rs2 as suplier,rs81.rs11 as tglfaktur,rs81.rs9 as tgljatuhtempo,round(rs81.rs13,2) as pajakppn,
          rs82.rs2 as kode,rs32.rs2 as obat,if(rs82.rs3>0,rs82.rs3,rs82.rs4) as jumlah,rs82.rs11 as satuan,rs82.rs8 as diskon,if(rs82.rs3>0,rs82.rs3*rs82.rs14,
          rs82.rs4*rs82.rs14) as subtotal
          from rs32,rs81,rs82,rs89
          where rs81.rs1=rs82.rs1 and rs82.rs2=rs32.rs1 and rs81.rs3=rs89.rs1 and rs81.rs19='' and rs81.rs8='Hutang' and rs81.rs10='exclude'
		 ) 
		  as xxx where nopenerimaan like '%".$_REQUEST['query']."%' group by nopenerimaan");
	$data=array();
	$data['query']='CARI FAKTUR';
	if ($sql && $sql->num_rows){
		while($rs = $sql->fetch_object()){
			$data['suggestions'][] = array(
				'value' => htmlentities($rs->nopenerimaan).' ('.htmlentities($rs->nofaktur).') '.htmlentities($rs->suplier),
				'nopenerimaan' => htmlentities($rs->nopenerimaan),
				'nofaktur' => htmlentities($rs->nofaktur)
			);
		}
	}
	
	echo json_encode($data);
	//flush();
?>
	
<?php include "../../../close.php";?>