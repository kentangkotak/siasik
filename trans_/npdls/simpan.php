<?php include("../../conn.php"); ?>
<?php
$volumepermintaanpanjar= str_replace(',','',$_GET['volumepermintaanpanjar']);
$hargapermintaanpanjar= str_replace(',','',$_GET['hargapermintaanpanjar']);
$sisaanggaran= str_replace(',','',$_GET['sisaanggaran']);
$biayatransfer= str_replace(',','',$_GET['biayatransfer']);

if($_GET['kodekegiatanblud'] == 45){
	$totalpermintaanpanjar=str_replace(',','',$_GET['totalpermintaanpanjar']);
	$nominalpembayaran=str_replace(',','',$_GET['nominalpembayaran']);
}else{
	$totalpermintaanpanjar= $volumepermintaanpanjar*$hargapermintaanpanjar;
	$nominalpembayaran= $volumepermintaanpanjar*$hargapermintaanpanjar;
}
	

$harga= str_replace(',','',$_GET['harga']);
$volume= str_replace(',','',$_GET['volume']);
$total= str_replace(',','',$_GET['total']);
$sqlkunci=$conn->query("select * from npdls_heder where nonpdls='".$_GET['nonpd']."' and kunci=1");
$jmlkunci=$sqlkunci->num_rows;

$tglnpd=in_tanggal("/",trim($_GET['tglnpd']));
$nilai= str_replace(',','',$_GET['nilai']);

$data=explode("-",$tglnpd);
$bulan=$data[1];

if($bulan == '01' || $bulan == '02' || $bulan == '03'){
	$triwulan='TRIWULAN 1';
}else if($bulan == '04' || $bulan == '05' || $bulan == '06'){
	$triwulan='TRIWULAN 2';
}else if($bulan == '07' || $bulan == '08' || $bulan == '09'){
	$triwulan='TRIWULAN 3';
}else{
	$triwulan='TRIWULAN 4';
}

if($_GET['serahterimapekerjaan'] == 1){
	if($jmlkunci > 0){
		echo "MAAF DATA INI SUDAH TERKUNCI, ANDA TIDAK BISA MENAMBAH ATAU MENGHAPUS DATA YANG SUDAH ADA...!!!";
	}else if($totalpermintaanpanjar > $sisaanggaran){
		echo "MAAF SISA ANGGARAN TIDAK MENCUKUPI PERMINTAAN ANDA, SISA ANGGARAN UNTUK KEGIATAN INI ADALAH ".rp($sisaanggaran);
	}else{
				
		if($_GET['kodekegiatanblud'] == 45){
				if($_GET['nonpd']==''){
					$sqlalias=$conn->query("select * from pptk where nip='".$_GET['kodepptk']."' and flag=''");
					$rsalias=$sqlalias->fetch_object();
					$alias=$rsalias->alias;
						if($alias == "KEU"){
							$sql=$conn->query("call nonpdkeu(@nomor);");
							$sql=$conn->query("select @nomor as nomor;");
							$jml=$sql->num_rows;
								if($jml>0){ 
									$rs=$sql->fetch_object();
									$counter=$rs->nomor+1;
									$lbr=strlen($counter);for($i=1;$i<=5-$lbr;$i++){$has=$has."0";}
									$kode=$has.$counter."/".bulanrum(date('m'))."/".$alias."/NPD-LS/".date('Y');
								}		
						}else if($alias == "UMUM"){
							$sql=$conn->query("call nonpdumum(@nomor);");
							$sql=$conn->query("select @nomor as nomor;");
							$jml=$sql->num_rows;
								if($jml>0){ 
									$rs=$sql->fetch_object();
									$counter=$rs->nomor+1;
									$lbr=strlen($counter);for($i=1;$i<=5-$lbr;$i++){$has=$has."0";}
									$kode=$has.$counter."/".bulanrum(date('m'))."/".$alias."/NPD-LS/".date('Y');
								}	
						}else if($alias == "PNM"){
							$sql=$conn->query("call nonpdpnm(@nomor);");
							$sql=$conn->query("select @nomor as nomor;");
							$jml=$sql->num_rows;
								if($jml>0){ 
									$rs=$sql->fetch_object();
									$counter=$rs->nomor+1;
									$lbr=strlen($counter);for($i=1;$i<=5-$lbr;$i++){$has=$has."0";}
									$kode=$has.$counter."/".bulanrum(date('m'))."/".$alias."/NPD-LS/".date('Y');
								}
						}else if($alias == "YMD"){
							$sql=$conn->query("call nonpdyanmed(@nomor);");
							$sql=$conn->query("select @nomor as nomor;");
							$jml=$sql->num_rows;
								if($jml>0){ 
									$rs=$sql->fetch_object();
									$counter=$rs->nomor+1;
									$lbr=strlen($counter);for($i=1;$i<=5-$lbr;$i++){$has=$has."0";}
									$kode=$has.$counter."/".bulanrum(date('m'))."/".$alias."/NPD-LS/".date('Y');
								}
						}else if($alias == "KEPR"){
							$sql=$conn->query("call nonpdkeperawatan(@nomor);");
							$sql=$conn->query("select @nomor as nomor;");
							$jml=$sql->num_rows;
								if($jml>0){ 
									$rs=$sql->fetch_object();
									$counter=$rs->nomor+1;
									$lbr=strlen($counter);for($i=1;$i<=5-$lbr;$i++){$has=$has."0";}
									$kode=$has.$counter."/".bulanrum(date('m'))."/".$alias."/NPD-LS/".date('Y');
								}
						}else if($alias == "LSDK"){
							$sql=$conn->query("call nonpdlitbang(@nomor);");
							$sql=$conn->query("select @nomor as nomor;");
							$jml=$sql->num_rows;
								if($jml>0){ 
									$rs=$sql->fetch_object();
									$counter=$rs->nomor+1;
									$lbr=strlen($counter);for($i=1;$i<=5-$lbr;$i++){$has=$has."0";}
									$kode=$has.$counter."/".bulanrum(date('m'))."/".$alias."/NPD-LS/".date('Y');
								}
						}	
					
					$conn->query("insert into npdls_heder(nonpdls,tglnpdls,kodepptk,pptk,serahterimapekerjaan,triwulan,program,nokontrak,kegiatan,kodekegiatanblud,kegiatanblud,kodepenerima,penerima,bank,rekening,
					npwp,kodebidang,bidang,keterangan,biayatransfer,tglentry,userentry,noserahterima) 
					values('".trim($kode)."','".trim($tglnpd)."','".trim($_GET['kodepptk'])."','".trim($_GET['pptk'])."','".trim($_GET['serahterimapekerjaan'])."',
					'".trim($triwulan)."','".trim($_GET['program'])."','".trim($_GET['nokontrak'])."',
					'".trim($_GET['kegiatan'])."','".$_GET['kodekegiatanblud']."','".$_GET['kegiatanblud']."','".$_GET['kodepenerima']."','".$_GET['penerima']."',
					'".trim($_GET['bank'])."','".trim($_GET['rekening'])."','".trim($_GET['npwp'])."','".$_GET['kodebidang']."','".$_GET['bidang']."',
					'".trim($_GET['keterangan'])."','".$biayatransfer."',
					'".date('Y-m-d H:i:s')."','".$_SESSION["anggaran_kodeuser"]."','".trim($_GET['noserahterima'])."'
					)");
					
					$conn->query("insert into npdls_rinci(nonpdls,koderek50,rincianbelanja,koderek108,uraian108,itembelanja,nopenerimaan,idserahterima_rinci,
					tglentry,userentry,nousulan,volume,satuan,harga,total,volumels,hargals,totalls,satuanbaru,nominalpembayaran) 
					values('".trim($kode)."','".trim($_GET['koderek50'])."','".trim($_GET['rincianbelanja'])."','".trim($_GET['kode108'])."','".trim($_GET['uraian108'])."',
					'".trim($_GET['itembelanja'])."','".trim($_GET['nousulan'])."',
					'".trim($_GET['idserahterima_rinci'])."','".date('Y-m-d H:i:s')."','".$_SESSION["anggaran_kodeuser"]."','".trim($_GET['nousulan'])."',
					'".trim($volume)."','".trim($_GET['satuan'])."','".trim($harga)."','".trim($total)."',
					'".trim($volumepermintaanpanjar)."','".trim($hargapermintaanpanjar)."','".$totalpermintaanpanjar."','".trim($_GET['satuanbaru'])."','".$nominalpembayaran."')");
					
					$conn->query("update serahterima_heder set flag='1' where noserahterimapekerjaan='".trim($_GET['noserahterima'])."' ");
					$conn->query("update serahterima_penerimaanrinci set flag='1',nonpdls='".trim($kode)."' where nokontrak='".trim($_GET['nokontrak'])."' and kode108='".trim($_GET['kode108'])."' ");
					echo "OK|".trim($kode);
					
				}else{
					$kode=$_GET['nonpd'];
					
					$conn->query("insert into npdls_rinci(nonpdls,koderek50,rincianbelanja,koderek108,uraian108,itembelanja,nopenerimaan,idserahterima_rinci,
					tglentry,userentry,nousulan,volume,satuan,harga,total,volumels,hargals,totalls,satuanbaru,nominalpembayaran) 
					values('".$kode."','".trim($_GET['koderek50'])."','".trim($_GET['rincianbelanja'])."','".trim($_GET['kode108'])."','".trim($_GET['uraian108'])."',
					'".trim($_GET['itembelanja'])."','".trim($_GET['nousulan'])."',
					'".trim($_GET['idserahterima_rinci'])."','".date('Y-m-d H:i:s')."','".$_SESSION["anggaran_kodeuser"]."','".trim($_GET['nousulan'])."',
					'".trim($volume)."','".trim($_GET['satuan'])."','".trim($harga)."','".trim($total)."',
					'".trim($volumepermintaanpanjar)."','".trim($hargapermintaanpanjar)."','".$totalpermintaanpanjar."','".trim($_GET['satuanbaru'])."','".$nominalpembayaran."')");
					
					$conn->query("update serahterima_heder set flag='1' where noserahterimapekerjaan='".trim($_GET['noserahterima'])."' ");
					$conn->query("update serahterima_penerimaanrinci set flag='1',nonpdls='".$kode."' where nokontrak='".trim($_GET['nokontrak'])."' and kode108='".trim($_GET['kode108'])."'");
					echo "OK|".$kode;
				}
		}else{
				if($_GET['nonpd']==''){
					$sqlalias=$conn->query("select * from pptk where nip='".$_GET['kodepptk']."' and flag=''");
					$rsalias=$sqlalias->fetch_object();
					$alias=$rsalias->alias;
						if($alias == "KEU"){
							$sql=$conn->query("call nonpdkeu(@nomor);");
							$sql=$conn->query("select @nomor as nomor;");
							$jml=$sql->num_rows;
								if($jml>0){ 
									$rs=$sql->fetch_object();
									$counter=$rs->nomor+1;
									$lbr=strlen($counter);for($i=1;$i<=5-$lbr;$i++){$has=$has."0";}
									$kode=$has.$counter."/".bulanrum(date('m'))."/".$alias."/NPD-LS/".date('Y');
								}		
						}else if($alias == "UMUM"){
							$sql=$conn->query("call nonpdumum(@nomor);");
							$sql=$conn->query("select @nomor as nomor;");
							$jml=$sql->num_rows;
								if($jml>0){ 
									$rs=$sql->fetch_object();
									$counter=$rs->nomor+1;
									$lbr=strlen($counter);for($i=1;$i<=5-$lbr;$i++){$has=$has."0";}
									$kode=$has.$counter."/".bulanrum(date('m'))."/".$alias."/NPD-LS/".date('Y');
								}	
						}else if($alias == "PNM"){
							$sql=$conn->query("call nonpdpnm(@nomor);");
							$sql=$conn->query("select @nomor as nomor;");
							$jml=$sql->num_rows;
								if($jml>0){ 
									$rs=$sql->fetch_object();
									$counter=$rs->nomor+1;
									$lbr=strlen($counter);for($i=1;$i<=5-$lbr;$i++){$has=$has."0";}
									$kode=$has.$counter."/".bulanrum(date('m'))."/".$alias."/NPD-LS/".date('Y');
								}
						}else if($alias == "YMD"){
							$sql=$conn->query("call nonpdyanmed(@nomor);");
							$sql=$conn->query("select @nomor as nomor;");
							$jml=$sql->num_rows;
								if($jml>0){ 
									$rs=$sql->fetch_object();
									$counter=$rs->nomor+1;
									$lbr=strlen($counter);for($i=1;$i<=5-$lbr;$i++){$has=$has."0";}
									$kode=$has.$counter."/".bulanrum(date('m'))."/".$alias."/NPD-LS/".date('Y');
								}
						}else if($alias == "KEPR"){
							$sql=$conn->query("call nonpdkeperawatan(@nomor);");
							$sql=$conn->query("select @nomor as nomor;");
							$jml=$sql->num_rows;
								if($jml>0){ 
									$rs=$sql->fetch_object();
									$counter=$rs->nomor+1;
									$lbr=strlen($counter);for($i=1;$i<=5-$lbr;$i++){$has=$has."0";}
									$kode=$has.$counter."/".bulanrum(date('m'))."/".$alias."/NPD-LS/".date('Y');
								}
						}else if($alias == "LSDK"){
							$sql=$conn->query("call nonpdlitbang(@nomor);");
							$sql=$conn->query("select @nomor as nomor;");
							$jml=$sql->num_rows;
								if($jml>0){ 
									$rs=$sql->fetch_object();
									$counter=$rs->nomor+1;
									$lbr=strlen($counter);for($i=1;$i<=5-$lbr;$i++){$has=$has."0";}
									$kode=$has.$counter."/".bulanrum(date('m'))."/".$alias."/NPD-LS/".date('Y');
								}
						}	
					
					$conn->query("insert into npdls_heder(nonpdls,tglnpdls,kodepptk,pptk,serahterimapekerjaan,triwulan,program,nokontrak,kegiatan,kodekegiatanblud,kegiatanblud,kodepenerima,penerima,bank,rekening,
					npwp,kodebidang,bidang,keterangan,biayatransfer,tglentry,userentry,noserahterima) 
					values('".trim($kode)."','".trim($tglnpd)."','".trim($_GET['kodepptk'])."','".trim($_GET['pptk'])."','".trim($_GET['serahterimapekerjaan'])."',
					'".trim($triwulan)."','".trim($_GET['program'])."','".trim($_GET['nokontrak'])."',
					'".trim($_GET['kegiatan'])."','".$_GET['kodekegiatanblud']."','".$_GET['kegiatanblud']."','".$_GET['kodepenerima']."','".$_GET['penerima']."',
					'".trim($_GET['bank'])."','".trim($_GET['rekening'])."','".trim($_GET['npwp'])."','".$_GET['kodebidang']."','".$_GET['bidang']."',
					'".trim($_GET['keterangan'])."','".$biayatransfer."',
					'".date('Y-m-d H:i:s')."','".$_SESSION["anggaran_kodeuser"]."','".trim($_GET['noserahterima'])."'
					)");
					
					$conn->query("insert into npdls_rinci(nonpdls,koderek50,rincianbelanja,koderek108,uraian108,itembelanja,nopenerimaan,idserahterima_rinci,
					tglentry,userentry,nousulan,volume,satuan,harga,total,volumels,hargals,totalls,satuanbaru,nominalpembayaran) 
					values('".trim($kode)."','".trim($_GET['koderek50'])."','".trim($_GET['rincianbelanja'])."','".trim($_GET['kode108'])."','".trim($_GET['uraian108'])."',
					'".trim($_GET['itembelanja'])."','".trim($_GET['nousulan'])."',
					'".trim($_GET['idserahterima_rinci'])."','".date('Y-m-d H:i:s')."','".$_SESSION["anggaran_kodeuser"]."','".trim($_GET['nousulan'])."',
					'".trim($volume)."','".trim($_GET['satuan'])."','".trim($harga)."','".trim($total)."',
					'".trim($volumepermintaanpanjar)."','".trim($hargapermintaanpanjar)."','".$totalpermintaanpanjar."','".trim($_GET['satuanbaru'])."','".$nominalpembayaran."')");
				
					$conn->query("update serahterima_heder set flag='1' where noserahterimapekerjaan='".trim($_GET['noserahterima'])."' ");
					echo "OK|".trim($kode);
					
				}else{
					$kode=$_GET['nonpd'];
					
					$conn->query("insert into npdls_rinci(nonpdls,koderek50,rincianbelanja,koderek108,uraian108,itembelanja,nopenerimaan,idserahterima_rinci,
					tglentry,userentry,nousulan,volume,satuan,harga,total,volumels,hargals,totalls,satuanbaru,nominalpembayaran) 
					values('".$kode."','".trim($_GET['koderek50'])."','".trim($_GET['rincianbelanja'])."','".trim($_GET['kode108'])."','".trim($_GET['uraian108'])."',
					'".trim($_GET['itembelanja'])."','".trim($_GET['nousulan'])."',
					'".trim($_GET['idserahterima_rinci'])."','".date('Y-m-d H:i:s')."','".$_SESSION["anggaran_kodeuser"]."','".trim($_GET['nousulan'])."',
					'".trim($volume)."','".trim($_GET['satuan'])."','".trim($harga)."','".trim($total)."',
					'".trim($volumepermintaanpanjar)."','".trim($hargapermintaanpanjar)."','".$totalpermintaanpanjar."','".trim($_GET['satuanbaru'])."','".$nominalpembayaran."')");
					
					$conn->query("update serahterima_heder set flag='1' where noserahterimapekerjaan='".trim($_GET['noserahterima'])."' ");
					echo "OK|".$kode;
				}
		}
	}
}else{
	$sqlkunci=$conn->query("select * from npdls_heder where nonpdls='".$_GET['nonpd']."' and kunci=1");
	$jmlkunci=$sqlkunci->num_rows;
	if($totalpermintaanpanjar > $sisaanggaran){
		echo "MAAF SISA ANGGARAN TIDAK MENCUKUPI PERMINTAAN ANDA, SISA ANGGARAN UNTUK KEGIATAN INI ADALAH ".rp($sisaanggaran);
	}else{
		
		if($jmlkunci > 0){
			echo "MAAF DATA INI SUDAH TERKUNCI, ANDA TIDAK BISA MENAMBAH ATAU MENGHAPUS DATA YANG SUDAH ADA...!!!";
		}else{
				$tglnpd=in_tanggal("/",trim($_GET['tglnpd']));
				$nilai= str_replace(',','',$_GET['nilai']);
				if($_GET['kodekegiatanblud'] == 45){
						if($_GET['nonpd']==''){
							$sqlalias=$conn->query("select * from pptk where nip='".$_GET['kodepptk']."' and flag=''");
							$rsalias=$sqlalias->fetch_object();
							$alias=$rsalias->alias;
								if($alias == "KEU"){
									$sql=$conn->query("call nonpdkeu(@nomor);");
									$sql=$conn->query("select @nomor as nomor;");
									$jml=$sql->num_rows;
										if($jml>0){ 
											$rs=$sql->fetch_object();
											$counter=$rs->nomor+1;
											$lbr=strlen($counter);for($i=1;$i<=5-$lbr;$i++){$has=$has."0";}
											$kode=$has.$counter."/".bulanrum(date('m'))."/".$alias."/NPD-LS/".date('Y');
										}		
								}else if($alias == "UMUM"){
									$sql=$conn->query("call nonpdumum(@nomor);");
									$sql=$conn->query("select @nomor as nomor;");
									$jml=$sql->num_rows;
										if($jml>0){ 
											$rs=$sql->fetch_object();
											$counter=$rs->nomor+1;
											$lbr=strlen($counter);for($i=1;$i<=5-$lbr;$i++){$has=$has."0";}
											$kode=$has.$counter."/".bulanrum(date('m'))."/".$alias."/NPD-LS/".date('Y');
										}	
								}else if($alias == "PNM"){
									$sql=$conn->query("call nonpdpnm(@nomor);");
									$sql=$conn->query("select @nomor as nomor;");
									$jml=$sql->num_rows;
										if($jml>0){ 
											$rs=$sql->fetch_object();
											$counter=$rs->nomor+1;
											$lbr=strlen($counter);for($i=1;$i<=5-$lbr;$i++){$has=$has."0";}
											$kode=$has.$counter."/".bulanrum(date('m'))."/".$alias."/NPD-LS/".date('Y');
										}
								}else if($alias == "YMD"){
									$sql=$conn->query("call nonpdyanmed(@nomor);");
									$sql=$conn->query("select @nomor as nomor;");
									$jml=$sql->num_rows;
										if($jml>0){ 
											$rs=$sql->fetch_object();
											$counter=$rs->nomor+1;
											$lbr=strlen($counter);for($i=1;$i<=5-$lbr;$i++){$has=$has."0";}
											$kode=$has.$counter."/".bulanrum(date('m'))."/".$alias."/NPD-LS/".date('Y');
										}
								}else if($alias == "KEPR"){
									$sql=$conn->query("call nonpdkeperawatan(@nomor);");
									$sql=$conn->query("select @nomor as nomor;");
									$jml=$sql->num_rows;
										if($jml>0){ 
											$rs=$sql->fetch_object();
											$counter=$rs->nomor+1;
											$lbr=strlen($counter);for($i=1;$i<=5-$lbr;$i++){$has=$has."0";}
											$kode=$has.$counter."/".bulanrum(date('m'))."/".$alias."/NPD-LS/".date('Y');
										}
								}else if($alias == "LSDK"){
									$sql=$conn->query("call nonpdlitbang(@nomor);");
									$sql=$conn->query("select @nomor as nomor;");
									$jml=$sql->num_rows;
										if($jml>0){ 
											$rs=$sql->fetch_object();
											$counter=$rs->nomor+1;
											$lbr=strlen($counter);for($i=1;$i<=5-$lbr;$i++){$has=$has."0";}
											$kode=$has.$counter."/".bulanrum(date('m'))."/".$alias."/NPD-LS/".date('Y');
										}
								}	
							
							$conn->query("insert into npdls_heder(nonpdls,tglnpdls,kodepptk,pptk,serahterimapekerjaan,triwulan,program,nokontrak,kegiatan,kodekegiatanblud,kegiatanblud,kodepenerima,penerima,bank,rekening,
							npwp,kodebidang,bidang,keterangan,biayatransfer,tglentry,userentry,noserahterima) 
							values('".trim($kode)."','".trim($tglnpd)."','".trim($_GET['kodepptk'])."','".trim($_GET['pptk'])."','".trim($_GET['serahterimapekerjaan'])."',
							'".trim($triwulan)."','".trim($_GET['program'])."','".trim($_GET['nokontrak'])."',
							'".trim($_GET['kegiatan'])."','".$_GET['kodekegiatanblud']."','".$_GET['kegiatanblud']."','".$_GET['kodepenerima']."','".$_GET['penerima']."',
							'".trim($_GET['bank'])."','".trim($_GET['rekening'])."','".trim($_GET['npwp'])."','".$_GET['kodebidang']."','".$_GET['bidang']."',
							'".trim($_GET['keterangan'])."','".$biayatransfer."',
							'".date('Y-m-d H:i:s')."','".$_SESSION["anggaran_kodeuser"]."','".trim($_GET['noserahterima'])."'
							)");
							
							$conn->query("insert into npdls_rinci(nonpdls,koderek50,rincianbelanja,koderek108,uraian108,itembelanja,nopenerimaan,idserahterima_rinci,
							tglentry,userentry,nousulan,volume,satuan,harga,total,volumels,hargals,totalls,satuanbaru,nominalpembayaran) 
							values('".trim($kode)."','".trim($_GET['koderek50'])."','".trim($_GET['rincianbelanja'])."','".trim($_GET['kode108'])."','".trim($_GET['uraian108'])."',
							'".trim($_GET['itembelanja'])."','".trim($_GET['nousulan'])."',
							'".trim($_GET['idserahterima_rinci'])."','".date('Y-m-d H:i:s')."','".$_SESSION["anggaran_kodeuser"]."','".trim($_GET['nousulan'])."',
							'".trim($volume)."','".trim($_GET['satuan'])."','".trim($harga)."','".trim($total)."',
							'".trim($volumepermintaanpanjar)."','".trim($hargapermintaanpanjar)."','".$totalpermintaanpanjar."','".trim($_GET['satuanbaru'])."','".$nominalpembayaran."')");
							
							$conn->query("update serahterima_penerimaanrinci set flag='1',nonpdls='".trim($kode)."' where nokontrak='".trim($_GET['nokontrak'])."'");
							echo "OK|".trim($kode);
							
							
					}else{
							$kode=$_GET['nonpd'];
							
							$conn->query("insert into npdls_rinci(nonpdls,koderek50,rincianbelanja,koderek108,uraian108,itembelanja,nopenerimaan,idserahterima_rinci,
							tglentry,userentry,nousulan,volume,satuan,harga,total,volumels,hargals,totalls,satuanbaru,nominalpembayaran) 
							values('".$kode."','".trim($_GET['koderek50'])."','".trim($_GET['rincianbelanja'])."','".trim($_GET['kode108'])."','".trim($_GET['uraian108'])."',
							'".trim($_GET['itembelanja'])."','".trim($_GET['nousulan'])."',
							'".trim($_GET['idserahterima_rinci'])."','".date('Y-m-d H:i:s')."','".$_SESSION["anggaran_kodeuser"]."','".trim($_GET['nousulan'])."',
							'".trim($volume)."','".trim($_GET['satuan'])."','".trim($harga)."','".trim($total)."',
							'".trim($volumepermintaanpanjar)."','".trim($hargapermintaanpanjar)."','".$totalpermintaanpanjar."','".trim($_GET['satuanbaru'])."','".$nominalpembayaran."')");
							
							$conn->query("update serahterima_penerimaanrinci set flag='1',nonpdls='".trim($kode)."' where nokontrak='".trim($_GET['nokontrak'])."'");
							echo "OK|".$kode;
					}
				}else{
						if($_GET['nonpd']==''){
							$sqlalias=$conn->query("select * from pptk where nip='".$_GET['kodepptk']."' and flag=''");
							$rsalias=$sqlalias->fetch_object();
							$alias=$rsalias->alias;
								if($alias == "KEU"){
									$sql=$conn->query("call nonpdkeu(@nomor);");
									$sql=$conn->query("select @nomor as nomor;");
									$jml=$sql->num_rows;
										if($jml>0){ 
											$rs=$sql->fetch_object();
											$counter=$rs->nomor+1;
											$lbr=strlen($counter);for($i=1;$i<=5-$lbr;$i++){$has=$has."0";}
											$kode=$has.$counter."/".bulanrum(date('m'))."/".$alias."/NPD-LS/".date('Y');
										}		
								}else if($alias == "UMUM"){
									$sql=$conn->query("call nonpdumum(@nomor);");
									$sql=$conn->query("select @nomor as nomor;");
									$jml=$sql->num_rows;
										if($jml>0){ 
											$rs=$sql->fetch_object();
											$counter=$rs->nomor+1;
											$lbr=strlen($counter);for($i=1;$i<=5-$lbr;$i++){$has=$has."0";}
											$kode=$has.$counter."/".bulanrum(date('m'))."/".$alias."/NPD-LS/".date('Y');
										}	
								}else if($alias == "PNM"){
									$sql=$conn->query("call nonpdpnm(@nomor);");
									$sql=$conn->query("select @nomor as nomor;");
									$jml=$sql->num_rows;
										if($jml>0){ 
											$rs=$sql->fetch_object();
											$counter=$rs->nomor+1;
											$lbr=strlen($counter);for($i=1;$i<=5-$lbr;$i++){$has=$has."0";}
											$kode=$has.$counter."/".bulanrum(date('m'))."/".$alias."/NPD-LS/".date('Y');
										}
								}else if($alias == "YMD"){
									$sql=$conn->query("call nonpdyanmed(@nomor);");
									$sql=$conn->query("select @nomor as nomor;");
									$jml=$sql->num_rows;
										if($jml>0){ 
											$rs=$sql->fetch_object();
											$counter=$rs->nomor+1;
											$lbr=strlen($counter);for($i=1;$i<=5-$lbr;$i++){$has=$has."0";}
											$kode=$has.$counter."/".bulanrum(date('m'))."/".$alias."/NPD-LS/".date('Y');
										}
								}else if($alias == "KEPR"){
									$sql=$conn->query("call nonpdkeperawatan(@nomor);");
									$sql=$conn->query("select @nomor as nomor;");
									$jml=$sql->num_rows;
										if($jml>0){ 
											$rs=$sql->fetch_object();
											$counter=$rs->nomor+1;
											$lbr=strlen($counter);for($i=1;$i<=5-$lbr;$i++){$has=$has."0";}
											$kode=$has.$counter."/".bulanrum(date('m'))."/".$alias."/NPD-LS/".date('Y');
										}
								}else if($alias == "LSDK"){
									$sql=$conn->query("call nonpdlitbang(@nomor);");
									$sql=$conn->query("select @nomor as nomor;");
									$jml=$sql->num_rows;
										if($jml>0){ 
											$rs=$sql->fetch_object();
											$counter=$rs->nomor+1;
											$lbr=strlen($counter);for($i=1;$i<=5-$lbr;$i++){$has=$has."0";}
											$kode=$has.$counter."/".bulanrum(date('m'))."/".$alias."/NPD-LS/".date('Y');
										}
								}	
							
							$conn->query("insert into npdls_heder(nonpdls,tglnpdls,kodepptk,pptk,serahterimapekerjaan,triwulan,program,nokontrak,kegiatan,kodekegiatanblud,kegiatanblud,kodepenerima,penerima,bank,rekening,
							npwp,kodebidang,bidang,keterangan,biayatransfer,tglentry,userentry,noserahterima) 
							values('".trim($kode)."','".trim($tglnpd)."','".trim($_GET['kodepptk'])."','".trim($_GET['pptk'])."','".trim($_GET['serahterimapekerjaan'])."',
							'".trim($triwulan)."','".trim($_GET['program'])."','".trim($_GET['nokontrak'])."',
							'".trim($_GET['kegiatan'])."','".$_GET['kodekegiatanblud']."','".$_GET['kegiatanblud']."','".$_GET['kodepenerima']."','".$_GET['penerima']."',
							'".trim($_GET['bank'])."','".trim($_GET['rekening'])."','".trim($_GET['npwp'])."','".$_GET['kodebidang']."','".$_GET['bidang']."',
							'".trim($_GET['keterangan'])."','".$biayatransfer."',
							'".date('Y-m-d H:i:s')."','".$_SESSION["anggaran_kodeuser"]."','".trim($_GET['noserahterima'])."'
							)");
							
							$conn->query("insert into npdls_rinci(nonpdls,koderek50,rincianbelanja,koderek108,uraian108,itembelanja,nopenerimaan,idserahterima_rinci,
							tglentry,userentry,nousulan,volume,satuan,harga,total,volumels,hargals,totalls,satuanbaru,nominalpembayaran) 
							values('".trim($kode)."','".trim($_GET['koderek50'])."','".trim($_GET['rincianbelanja'])."','".trim($_GET['kode108'])."','".trim($_GET['uraian108'])."',
							'".trim($_GET['itembelanja'])."','".trim($_GET['nousulan'])."',
							'".trim($_GET['idserahterima_rinci'])."','".date('Y-m-d H:i:s')."','".$_SESSION["anggaran_kodeuser"]."','".trim($_GET['nousulan'])."',
							'".trim($volume)."','".trim($_GET['satuan'])."','".trim($harga)."','".trim($total)."',
							'".trim($volumepermintaanpanjar)."','".trim($hargapermintaanpanjar)."','".$totalpermintaanpanjar."','".trim($_GET['satuanbaru'])."','".$nominalpembayaran."')");
							
							echo "OK|".trim($kode);
							
							
					}else{
							$kode=$_GET['nonpd'];
							
							$conn->query("insert into npdls_rinci(nonpdls,koderek50,rincianbelanja,koderek108,uraian108,itembelanja,nopenerimaan,idserahterima_rinci,
							tglentry,userentry,nousulan,volume,satuan,harga,total,volumels,hargals,totalls,satuanbaru,nominalpembayaran) 
							values('".$kode."','".trim($_GET['koderek50'])."','".trim($_GET['rincianbelanja'])."','".trim($_GET['kode108'])."','".trim($_GET['uraian108'])."',
							'".trim($_GET['itembelanja'])."','".trim($_GET['nousulan'])."',
							'".trim($_GET['idserahterima_rinci'])."','".date('Y-m-d H:i:s')."','".$_SESSION["anggaran_kodeuser"]."','".trim($_GET['nousulan'])."',
							'".trim($volume)."','".trim($_GET['satuan'])."','".trim($harga)."','".trim($total)."',
							'".trim($volumepermintaanpanjar)."','".trim($hargapermintaanpanjar)."','".$totalpermintaanpanjar."','".trim($_GET['satuanbaru'])."','".$nominalpembayaran."')");
							
							echo "OK|".$kode;
					}
				}		
		}
	}
}	
		
?>
<?php include("../../close.php"); ?>
