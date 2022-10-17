<?php include("../../conn.php"); ?>
<?php

	$tglpindahbuku=in_tanggal("/",trim($_GET['tglpindahbuku']));
	$tglpencairan=in_tanggal("/",trim($_GET['tglpencairan']));
			
			$sqlcek=$conn->query("select * from serahterima_penerimaanrinci where nonpkls='".$_GET['nonpk']."'");	
			$jmlcek=$sqlcek->num_rows;
			if($jmlcek > 0){
				$sql=$conn->query("call nopencairan(@nomor);");
				$sql=$conn->query("select @nomor as nomor;");
				$jml=$sql->num_rows;
				if($jml>0){ 
					$rs=$sql->fetch_object();
					$counter=$rs->nomor+1;
				}
				$lbr=strlen($counter);for($i=1;$i<=5-$lbr;$i++){$has=$has."0";}
				$kode=$has.$counter."/".bulanrum(date('m'))."/CAIR-LS/".date('Y');
				
				$conn->query("update npkls_heder set nopencairan='".$kode."',tglpindahbuku='".$tglpindahbuku."',tglpencairan='".$tglpencairan."',userentrycair='".$_SESSION["anggaran_kodeuser"]."',
				tglentrycair='".date('Y-m-d H:i:s')."' where nonpk='".$_GET['nonpk']."'");
				
				$conn->query("update npkls_rinci set nopencairan='".$kode."',userentrycair='".$_SESSION["anggaran_kodeuser"]."',
				tglentrycair='".date('Y-m-d H:i:s')."' where nonpk='".$_GET['nonpk']."' ");
				
				$conn->query("update serahterima_penerimaanrinci set nopencairan='".trim($kode)."' where nonpkls='".trim($_GET['nonpk'])."' ");
				$conn_simrs = new mysqli("192.168.11.1","admin","alam01989sa","rs");
				$sql=$conn->query("select * from serahterima_penerimaanrinci where nonpkls='".$_GET['nonpk']."' group by nopenerimaan");
				while($rs=$sql->fetch_object()){
					$conn_simrs->query("update rs81 set rs19=1 where rs1='".$rs->nopenerimaan."'");
					
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
						values('".$rs->nonpdls."','X','".$tglpencairan."',
						'".$rssim->nopenerimaan."','".$rssim->nofaktur."','".$rssim->total."',
						'".$rssim->total."','".$_SESSION["anggaran_kodeuser"]."','".$rssim->kodesupplier."','".date('Y-m-d H:i:s')."',
						'".$kode."','".$tglpencairan."'
						)");
					}
				}
				$sqlnpd=$conn->query("select * from npkls_rinci where nonpk='".$_GET['nonpk']."'");
				while($rsnpd=$sqlnpd->fetch_object()){
						$conn->query("update npdls_heder set nopencairan='".trim($kode)."' where nonpdls='".$rsnpd->nonpdls."' ");
				}
				echo "OK|".$kode;
			}else{
				$sql=$conn->query("call nopencairan(@nomor);");
				$sql=$conn->query("select @nomor as nomor;");
				$jml=$sql->num_rows;
				if($jml>0){ 
					$rs=$sql->fetch_object();
					$counter=$rs->nomor+1;
				}
				$lbr=strlen($counter);for($i=1;$i<=5-$lbr;$i++){$has=$has."0";}
				$kode=$has.$counter."/".bulanrum(date('m'))."/CAIR-LS/".date('Y');
				
				$conn->query("update npkls_heder set nopencairan='".$kode."',tglpindahbuku='".$tglpindahbuku."',tglpencairan='".$tglpencairan."',userentrycair='".$_SESSION["anggaran_kodeuser"]."',
				tglentrycair='".date('Y-m-d H:i:s')."' where nonpk='".$_GET['nonpk']."'");
				
				$conn->query("update npkls_rinci set nopencairan='".$kode."',userentrycair='".$_SESSION["anggaran_kodeuser"]."',
				tglentrycair='".date('Y-m-d H:i:s')."' where nonpk='".$_GET['nonpk']."' ");
				
				$sqlnpd=$conn->query("select * from npkls_rinci where nonpk='".$_GET['nonpk']."'");
				while($rsnpd=$sqlnpd->fetch_object()){
						$conn->query("update npdls_heder set nopencairan='".trim($kode)."' where nonpdls='".$rsnpd->nonpdls."' ");
				}
				
				echo "OK|".$kode;
			}
			
		
		
?>
<?php include("../../close.php"); ?>