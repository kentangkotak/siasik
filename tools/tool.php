<?php include("conn.php"); ?>
<?php
// $conn_simrs = new mysqli("192.168.11.1","admin","alam01989sa","rs");
// $sql=$conn->query("select * from serahterima_penerimaanrinci where nopencairan<>'00006/II/CAIR-LS/2022'");
// while($rs=$sql->fetch_object()){
	// $sqlsim=$conn_simrs->query("select * from rs81 where rs1='".$rs->nopenerimaan."'");
	// while($rssim=$sqlsim->fetch_object()){
		// $conn->query("update serahterima_penerimaanrinci set nofaktur='".$rssim->rs5."' where nopenerimaan='".$rs->nopenerimaan."' and nopencairan<>'00006/II/CAIR-LS/2022'");
	// }
// }

$sql=$conn->query("select * from serahterima_penerimaanrinci where nopencairan='00009/III/CAIR-LS/2022' group by nopenerimaan");
while($rs=$sql->fetch_object()){
	$conn_simrs = new mysqli("192.168.11.1","admin","alam01989sa","rs");
	$sqlsim=$conn_simrs->query("select nopenerimaan,nofaktur,kodesupplier,suplier,tglfaktur,tgljatuhtempo,round(diskon),sum(subtotal) as totalbelumppn,round(sum(subtotal)*pajakppn/100,2) as ppn,
								round(sum(subtotal)+sum(subtotal)*pajakppn/100,2) as total from(
										  select rs81.rs1 as nopenerimaan,rs81.rs5 as nofaktur,rs81.rs3 as kodesupplier,rs89.rs2 as suplier,rs81.rs11 as tglfaktur,rs81.rs9 as tgljatuhtempo,round(rs81.rs13,2) as pajakppn,
										  rs82.rs2 as kode,rs32.rs2 as obat,if(rs82.rs3>0,rs82.rs3,rs82.rs4) as jumlah,rs82.rs11 as satuan,rs82.rs8 as diskon,if(rs82.rs3>0,rs82.rs3*rs82.rs14,
										  rs82.rs4*rs82.rs14) as subtotal
										  from rs32,rs81,rs82,rs89
										  where rs81.rs1=rs82.rs1 and rs82.rs2=rs32.rs1 and rs81.rs3=rs89.rs1 
										  and rs81.rs1='".$rs->nopenerimaan."') 
										  as xxx group by nopenerimaan");
	while($rssim=$sqlsim->fetch_object()){
		$conn_simrs->query("insert into rs181(rs1,rs2,rs3,rs4,rs5,rs6,rs7,rs8,rs9,rs10,rs11,rs12)
		values('".$rs->nonpdls."','X','2022-02-23',
		'".$rssim->nopenerimaan."','".$rssim->nofaktur."','".$rssim->total."',
		'".$rssim->total."','sa','".$rssim->kodesupplier."','".date('Y-m-d H:i:s')."',
		'00009/III/CAIR-LS/2022','2022-02-23'
		)");
	}				
}
?>
<?php include("close.php"); ?>