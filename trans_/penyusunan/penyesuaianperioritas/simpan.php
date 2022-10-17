<?php include("../../../conn.php"); ?>
<?php
$sql_kunci=$conn->query("select * from usulanHonor_h where kunci=''");
$rs_kunci=$sql_kunci->fetch_object();
//if($rs_kunci > 0){
//	echo "MAAF USULAN INI BELUM TERKUNCI...!!!";
//}else{
	if($_GET['id'] == ''){
		$harga= str_replace(',','',$_GET['harga']);
		$volume= str_replace(',','',$_GET['volume']);
		$nilai= str_replace(',','',$_GET['nilai']);
		$jumlahacc= str_replace(',','',$_GET['jumlahacc']);

		$total_penyesuaianx = $jumlahacc * $harga;
		$sql_cekx=$conn->query("select penyesesuaianperioritas_heder.notrans as notrans,sum(penyesesuaianperioritas_rinci.nilai) as nilai
								from penyesesuaianperioritas_rinci,penyesesuaianperioritas_heder
								where penyesesuaianperioritas_rinci.notrans=penyesesuaianperioritas_heder.notrans and penyesesuaianperioritas_heder.kodekegiatan='".trim($_GET['kodekegiatan'])."' 
								and  year(penyesesuaianperioritas_heder.tgltrans)='".$_SESSION["anggaran_tahun"]."'
								group by penyesesuaianperioritas_heder.kodekegiatan");
		$rs_cekx=$sql_cekx->fetch_object();
		$total_penyesuaian=$total_penyesuaianx+$rs_cekx->nilai;

		$sql_cek=$conn->query("select sum(total) as total from penetapan_pagu where kodekegiatan='".trim($_GET['kodekegiatan'])."' and tahun='".$_SESSION["anggaran_tahun"]."' group by kegiatanblud");
		$rs_cek=$sql_cek->fetch_object();
		$pagu=$rs_cek->total;
		if($total_penyesuaian > $pagu ){
			echo "MAAF NILAI YANG ANDA MASUKKAN MELEBIHI PAGU KEGIATAN...!!!";
		}else{
			$tanggaltrans=in_tanggal("/",trim($_GET['tgltrans']));
			$data=explode( '|', $_GET['ruangyangusul'] );
			$koderuang=$data[0];
			$ruang=$data[1];
			
			if($_GET['jumlahacc'] > $volume){
				echo "MAAF NILAI YANG DIACC LEBIH BESAR DARI USULAN...!!!";
			}else{
				if($_GET['notrans']==''){
					$sql=$conn->query("call penyesesuaianperioritas(@nomor);");
					$sql=$conn->query("select @nomor as nomor;");
					$jml=$sql->num_rows;
					if($jml>0){ 
						$rs=$sql->fetch_object();
						$counter=$rs->nomor+1;
					}		
					$kode=gennotran($counter,"PP");
					
					$conn->query("insert into penyesesuaianperioritas_heder(notrans,kodepptk,pptk,kodebidang,namabidang,kodekegiatan,kegiatan,tgltrans,kdruang_pengusul,ruang_pengusul,
					tgl_entry,user_entry) 
					values('".$kode."','".trim($_GET['kodepptk'])."','".trim($_GET['pptk'])."','".trim($_GET['kodebidang'])."','".trim($_GET['namabidang'])."',
					'".trim($_GET['kodekegiatan'])."','".trim($_GET['kegiatan'])."','".$tanggaltrans."','".$koderuang."','".$ruang."','".date('Y-m-d H:i:s')."',
					'".$_SESSION["anggaran_kodeuser"]."')");
					
					$conn->query("insert into penyesesuaianperioritas_rinci(notrans,usulan,volume,harga,nilai,koderek108,uraian108,koderek50,uraian50,
					jumlahacc,tgl_entry,user_entry,satuan,nousulan) 
					values('".$kode."','".trim($_GET['usulan'])."','".trim($volume)."','".trim($harga)."','".trim($total_penyesuaianx)."','".trim($_GET['koderek108'])."',
					'".trim($_GET['uraianrek108'])."','".trim($_GET['koderek50'])."','".trim($_GET['uraianrek50'])."','".trim($jumlahacc)."','".date('Y-m-d H:i:s')."',
					'".$_SESSION["anggaran_kodeuser"]."','".trim($_GET['satuan'])."','".trim($_GET['nousulan'])."')");
					
					$conn->query("update usulanHonor_r set flag='1' where notrans='".trim($_GET['nousulan'])."' and keterangan='".trim($_GET['usulan'])."' and volume='".trim($volume)."'");
					
					$sqlid=$conn->query("select id from penyesesuaianperioritas_rinci where notrans='".$kode."' and usulan='".trim($_GET['usulan'])."' and volume='".trim($volume)."' 
										and harga='".trim($harga)."' and nilai='".trim($total_penyesuaianx)."' and koderek108='".trim($_GET['koderek108'])."' 
										and koderek50='".trim($_GET['koderek50'])."' and jumlahacc='".trim($jumlahacc)."' and satuan='".trim($_GET['satuan'])."' 
										and nousulan='".trim($_GET['nousulan'])."'");
					$rsid=$sqlid->fetch_object();
					$idpp=$rsid->id;
					
					$conn->query("insert into t_tampung(notrans,idpp,usulan,pagu,koderek108,koderek50,kodekegiatanblud,tgl,volume,harga,satuan) 
					values('".$kode."','".$idpp."','".trim($_GET['usulan'])."','".trim($total_penyesuaianx)."','".trim($_GET['koderek108'])."','".trim($_GET['koderek50'])."',
					'".trim($_GET['kodekegiatan'])."','".$tanggaltrans."','".trim($volume)."','".trim($harga)."','".trim($_GET['satuan'])."')");
					echo "OK|".$kode;
				}else{
					$kode=$_GET['notrans'];
					$sqlcek_kunci=$conn->query("select * from penyesesuaianperioritas_heder where notrans='".trim($_GET['usulan'])."' and kunci=1");
					$jmlcek_kunci=$sqlcek_kunci->num_rows;
					if($jmlcek_kunci > 0){
						echo "MAAF DATA INI SUDAH TERKUNCI, HARAP HUBUNGI ADMINISTRATOR....!!!";
					}else{
						$conn->query("insert into penyesesuaianperioritas_rinci(notrans,usulan,volume,harga,nilai,koderek108,uraian108,koderek50,uraian50,
						jumlahacc,tgl_entry,user_entry,satuan,nousulan) 
						values('".$kode."','".trim($_GET['usulan'])."','".trim($volume)."','".trim($harga)."','".trim($total_penyesuaianx)."','".trim($_GET['koderek108'])."',
						'".trim($_GET['uraianrek108'])."','".trim($_GET['koderek50'])."','".trim($_GET['uraianrek50'])."','".trim($jumlahacc)."','".date('Y-m-d H:i:s')."',
						'".$_SESSION["anggaran_kodeuser"]."','".trim($_GET['satuan'])."','".trim($_GET['nousulan'])."')");

						$conn->query("update usulanHonor_r set flag='1' where notrans='".trim($_GET['nousulan'])."' and keterangan='".trim($_GET['usulan'])."' and volume='".trim($volume)."'");
						
						$sqlid=$conn->query("select id from penyesesuaianperioritas_rinci where notrans='".$kode."' and usulan='".trim($_GET['usulan'])."' and volume='".trim($volume)."' 
										and harga='".trim($harga)."' and nilai='".trim($total_penyesuaianx)."' and koderek108='".trim($_GET['koderek108'])."' 
										and koderek50='".trim($_GET['koderek50'])."' and jumlahacc='".trim($jumlahacc)."' and satuan='".trim($_GET['satuan'])."' 
										and nousulan='".trim($_GET['nousulan'])."'");
						$rsid=$sqlid->fetch_object();
						$idpp=$rsid->id;
						
						$conn->query("insert into t_tampung(notrans,idpp,usulan,pagu,koderek108,koderek50,kodekegiatanblud,tgl,volume,harga,satuan) 
						values('".$kode."','".$idpp."','".trim($_GET['usulan'])."','".trim($total_penyesuaianx)."','".trim($_GET['koderek108'])."','".trim($_GET['koderek50'])."',
						'".trim($_GET['kodekegiatan'])."','".$tanggaltrans."','".trim($volume)."','".trim($harga)."','".trim($_GET['satuan'])."')");
							
						echo "OK|".$kode;
					}
				}
			}
		}
	}else{
		$kode=$_GET['notrans'];
		$sqlcek_kunci=$conn->query("select * from penyesesuaianperioritas_heder where notrans='".$kode."' and kunci=1");
		$jmlcek_kunci=$sqlcek_kunci->num_rows;
		if($jmlcek_kunci > 0){
			echo "MAAF DATA INI SUDAH TERKUNCI, HARAP HUBUNGI ADMINISTRATOR....!!!";
		}else{
			$conn->query("update penyesesuaianperioritas_rinci set koderek108='".trim($_GET['koderek108'])."',uraian108='".trim($_GET['uraianrek108'])."',
			koderek50='".trim($_GET['koderek50'])."',
			uraian50='".trim($_GET['uraianrek50'])."' where notrans='".$kode."' and id='".trim($_GET['id'])."'");
			
			$conn->query("update t_tampung set koderek108='".trim($_GET['koderek108'])."',
			koderek50='".trim($_GET['koderek50'])."' where notrans='".$kode."' and idpp='".trim($_GET['id'])."'");
			echo "OK|".$kode;
		}
	}
//}


?>
<?php include("../../../close.php"); ?>