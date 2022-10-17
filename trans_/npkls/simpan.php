<?php include("../../conn.php"); ?>
<?php
			$tglnpk=in_tanggal("/",trim($_GET['tglnpk']));
			$tglnpd=in_tanggal("/",trim($_GET['tglnpd']));
			$total= str_replace(',','',$_GET['total']);
				// $sqlwew=$conn->query("select * from npkls_heder where nonpk='".$_GET['nonpk']."'");	
				// $jmlwew=$sqlwew->num_rows;	
				// if($jmlwew == 0){
				if($_GET['nonpk']==''){
					$sql=$conn->query("call nonpkls(@nomor);");
					$sql=$conn->query("select @nomor as nomor;");
					$jml=$sql->num_rows;
					if($jml>0){ 
						$rs=$sql->fetch_object();
						$counter=$rs->nomor+1;
					}
					$lbr=strlen($counter);for($i=1;$i<=5-$lbr;$i++){$has=$has."0";}
					$kode=$has.$counter."/".bulanrum(date('m'))."/NPK-LS/".date('Y');
				
					$conn->query("insert into npkls_heder(nonpk,tglnpk,akun,userentry,tglentry,nonpdls) values('".trim($kode)."','".trim($tglnpk)."','".trim($_GET['akun'])."','".$_SESSION["anggaran_kodeuser"]."','".date('Y-m-d H:i:s')."','".trim($_GET['nonpdls'])."')");
				
						if(trim($_GET['kodekegiatanblud']) == 45){
							$conn->query("insert into npkls_rinci(nonpk,nonpdls,tglnpd,kegiatan,kodekegiatanblud,kegiatanblud,total,userentry,tglentry) 
							values('".trim($kode)."','".trim($_GET['nonpdls'])."','".trim($tglnpd)."','".trim($_GET['kegiatan'])."','".trim($_GET['kodekegiatanblud'])."',
							'".trim($_GET['kegiatanblud'])."','".trim($total)."','".$_SESSION["anggaran_kodeuser"]."','".date('Y-m-d H:i:s')."')");
							
							$conn->query("update npdls_heder set flagnpk='1' where nonpdls='".trim($_GET['nonpdls'])."' ");
							$conn->query("update serahterima_penerimaanrinci set nonpkls='".trim($kode)."' where nonpdls='".trim($_GET['nonpdls'])."' ");
							
							echo "OK|".trim($kode);
						}else{
							$conn->query("insert into npkls_rinci(nonpk,nonpdls,tglnpd,kegiatan,kodekegiatanblud,kegiatanblud,total,userentry,tglentry) 
							values('".trim($kode)."','".trim($_GET['nonpdls'])."','".trim($tglnpd)."','".trim($_GET['kegiatan'])."','".trim($_GET['kodekegiatanblud'])."',
							'".trim($_GET['kegiatanblud'])."','".trim($total)."','".$_SESSION["anggaran_kodeuser"]."','".date('Y-m-d H:i:s')."')");
							
							$conn->query("update npdls_heder set flagnpk='1' where nonpdls='".trim($_GET['nonpdls'])."' ");
							$conn->query("update npdls_heder set nonpk='".trim($kode)."' where nonpdls='".trim($_GET['nonpdls'])."' ");
							echo "OK|".trim($kode);
						}
				}else{
					$kode=$_GET['nonpk'];
					$sql=$conn->query("select * from npkls_heder where nonpk='".$kode."' and kunci=1");
					$jml=$sql->num_rows;
					
					if($jml > 0){
						echo "MAAF TRANSAKSI INI SUDAH DIKUNCI....!!!";
					}else{
						if(trim($_GET['kodekegiatanblud']) == 45){
								$conn->query("insert into npkls_rinci(nonpk,nonpdls,tglnpd,kegiatan,kodekegiatanblud,kegiatanblud,total,userentry,tglentry) 
								values('".$kode."','".trim($_GET['nonpdls'])."','".trim($tglnpd)."','".trim($_GET['kegiatan'])."','".trim($_GET['kodekegiatanblud'])."',
								'".trim($_GET['kegiatanblud'])."','".trim($total)."','".$_SESSION["anggaran_kodeuser"]."','".date('Y-m-d H:i:s')."')");
								
								$conn->query("update npdls_heder set flagnpk='1' where nonpdls='".trim($_GET['nonpdls'])."' ");
								$conn->query("update serahterima_penerimaanrinci set nonpkls='".$kode."' where nonpdls='".trim($_GET['nonpdls'])."' ");
								
								echo "OK|".$kode;
						}else{
								$conn->query("insert into npkls_rinci(nonpk,nonpdls,tglnpd,kegiatan,kodekegiatanblud,kegiatanblud,total,userentry,tglentry) 
								values('".trim($kode)."','".trim($_GET['nonpdls'])."','".trim($tglnpd)."','".trim($_GET['kegiatan'])."','".trim($_GET['kodekegiatanblud'])."',
								'".trim($_GET['kegiatanblud'])."','".trim($total)."','".$_SESSION["anggaran_kodeuser"]."','".date('Y-m-d H:i:s')."')");
								
								$conn->query("update npdls_heder set flagnpk='1' where nonpdls='".trim($_GET['nonpdls'])."' ");
								$conn->query("update npdls_heder set nonpk='".trim($kode)."' where nonpdls='".trim($_GET['nonpdls'])."' ");
								echo "OK|".trim($kode);
						}
					}
					
					
				}
				
		
		
?>
<?php include("../../close.php"); ?>