<div id='cariusulancontent'>
<?php include "../../conn.php";?>
<?php
	$usulantxt='';
	if(isset($_GET['usulantxt']))
		$usulantxt=$_GET['usulantxt'];
	
		if($_GET['serahterimapekerjaan'] == 1){
			$sql=$conn->query("select serahterima_heder.noserahterimapekerjaan as noserahterima,serahterima50.koderek50 as koderek50,serahterima50.uraianrek50 as uraian50
								from serahterima_heder,serahterima50 
								where serahterima_heder.noserahterimapekerjaan=serahterima50.noserahterimapekerjaan and 
								serahterima_heder.noserahterimapekerjaan='".$_GET['noserahterima']."' and year(serahterima_heder.tgltrans)='".$_SESSION["anggaran_tahun"]."'
								and serahterima50.uraianrek50 like '%".$usulantxt."%'");
		}else{
			$sql=$conn->query("SELECT penyesesuaianperioritas_heder.kodekegiatan as kodekegiatan,t_tampung.koderek50 as koderek50,akun50_miroring.uraian as uraian50
								from t_tampung,akun50_miroring,penyesesuaianperioritas_heder
								where 
								concat_ws('.',akun50_miroring.akun,akun50_miroring.kelompok,akun50_miroring.jenis,akun50_miroring.objectx,akun50_miroring.rincian,akun50_miroring.subrincian)=t_tampung.koderek50
								and t_tampung.kodekegiatanblud='".$_GET['kodekegiatanblud']."' and penyesesuaianperioritas_heder.notrans=t_tampung.notrans and
								year(penyesesuaianperioritas_heder.tgltrans)='".$_SESSION["anggaran_tahun"]."' and akun50_miroring.uraian like '%".$usulantxt."%' 
								group by t_tampung.koderek50");
		}
$i=1;
?>
<input type='hidden' name='koderek50' id='koderek50' value='<?php echo $_GET['koderek50']; ?>'>
<input type='hidden' name=kodekegiatanblud' id='kodekegiatanblud' value='<?php echo $_GET['kodekegiatanblud']; ?>'>
<input type='text' name='cariusulantxt' id='cariusulantxt'>
<input type="button" value="Cari" onclick='cariusulan();'>
<table class="table table-hover table-bordered table table-striped" id="dataTables-example">
	<thead>
		<tr>
			<th>No.</th>
			<th>KODE REKENING 50</th>
			<th>URAIAN 50</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php while($rs=$sql->fetch_object()){ ?>
		<tr>
			<td><?php echo $i; ?></td>
			<td><?php echo $rs->koderek50; ?></td>
			<td><?php echo $rs->uraian50; ?></td>
			<td>
				<input type="button" value="PILIH" onclick="pilihrincianbelanja('<?php echo $rs->koderek50;?>','<?php echo str_replace(array("\n", "\r"), '', $rs->uraian50);?>')">
			</td>
		</tr>
		<?php $i++; } ?>
	</tbody>
</table>	
<script>
	function cariusulan(){
		usulantxt = document.querySelector('#cariusulantxt').value;
		$.get('trans_/npdls/carinokontrak.php',{
			usulantxt:usulantxt,
		},
		function(rs){
			document.querySelector('#cariusulancontent').innerHTML = rs;
		});
	}
</script>
<?php include "../../close.php";?>
</div>