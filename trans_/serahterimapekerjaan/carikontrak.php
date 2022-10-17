<div id='cariusulancontent'>
<?php include "../../conn.php";?>
<?php
	$usulantxt='';
	if(isset($_GET['usulantxt']))
		$usulantxt=$_GET['usulantxt'];

    $sql=$conn->query("select * from kontrakPengerjaan_header where kunci=1 and flag='' and nokontrak like '%".$usulantxt."%' and year(tgltrans)='".$_SESSION["anggaran_tahun"]."'");
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
			<th>NOKONTRAK</th>
			<th>NAMA PERUSAHAAN</th>
			<th>TGL MULAI KONTRAK</th>
			<th>TGL AKHIR KONTRAK</th>
			<th>TGL TRANSAKSI</th>
			<th>PPTK</th>
			<th>PROGRAM</th>
			<th>KEGIATAN</th>
			<th>KEGIATAN BLUD</th>
			<!--<th>PERMEN 50</th>
			<th>URAIAN</th>-->
			<th>NILAI KONTRAK</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php while($rs=$sql->fetch_object()){ ?>
		<tr>
			<td><?php echo $i; ?></td>
			<td><?php echo $rs->nokontrak; ?></td>
			<td><?php echo $rs->namaperusahaan; ?></td>
			<td><?php echo $rs->tglmulaikontrak; ?></td>
			<td><?php echo $rs->tglakhirkontrak; ?></td>
			<td><?php echo $rs->tgltrans; ?></td>
			<td><?php echo $rs->namapptk; ?></td>
			<td><?php echo $rs->program; ?></td>
			<td><?php echo $rs->kegiatan; ?></td>
			<td><?php echo $rs->kegiatanblud; ?></td>
			<!--<td><?php echo $rs->kode50; ?></td>
			<td><?php echo $rs->uraianpekerjaan; ?></td>-->
			<td><?php echo rpzx($rs->nilaikontrak); ?></td>
			<td>
				<input type="button" value="PILIH" onclick="pilihkontrak('<?php echo $rs->kodekegiatanblud;?>','<?php echo $rs->kodeperusahaan;?>','<?php echo $rs->kodepptk;?>',
				'<?php echo $rs->kodemapingrs;?>','<?php echo $rs->namasuplier;?>','<?php echo $rs->kode50;?>','<?php echo $rs->nokontrak;?>','<?php echo $rs->namaperusahaan;?>',
				'<?php echo out_tanggal("-",$rs->tglmulaikontrak); ?>','<?php echo out_tanggal("-",$rs->tglakhirkontrak); ?>','<?php echo $rs->namapptk;?>','<?php echo $rs->program;?>',
				'<?php echo $rs->kegiatan;?>','<?php echo $rs->kegiatanblud;?>','<?php echo $rs->uraianpekerjaan;?>','<?php echo rpz($rs->nilaikontrak);?>','<?php echo rpz($rs->nilaikegiatan);?>');">
			</td>
		</tr>
		<?php $i++; } ?>
	</tbody>
</table>	
<script>
	function cariusulan(){
		usulantxt = document.querySelector('#cariusulantxt').value;
		$.get('trans_/serahterimapekerjaan/carikontrak.php',{
			usulantxt:usulantxt,
		},
		function(rs){
			document.querySelector('#cariusulancontent').innerHTML = rs;
		});
	}
</script>
<?php include "../../close.php";?>
</div>