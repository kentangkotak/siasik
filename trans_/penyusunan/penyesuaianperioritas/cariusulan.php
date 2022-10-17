<div id='cariusulancontent'>
<?php include "../../../conn.php";?>
<?php
	$usulantxt='';
	if(isset($_GET['usulantxt']))
		$usulantxt=$_GET['usulantxt'];

    $sql=$conn->query("select usulanHonor_h.notrans as notrans,usulanHonor_r.keterangan as rincian,round(usulanHonor_r.volume) as volume,usulanHonor_r.harga as harga,
						usulanHonor_r.nilai as nilai,
						usulanHonor_r.satuan as satuan
						from usulanHonor_r,usulanHonor_h
						where usulanHonor_h.notrans=usulanHonor_r.notrans and usulanHonor_h.kodeKegiatan='".$_GET['kodekegiatan']."' and usulanHonor_r.flag='' 
						and year(usulanHonor_h.tglTransaksi)='".$_SESSION["anggaran_tahun"]."'
						and usulanHonor_r.keterangan like '%".$usulantxt."%'");
$i=1;
?>
<input type='text' name='cariusulantxt' id='cariusulantxt'>
<input type="button" value="Cari" onclick='cariusulan();'>
<table class="table table-hover table-bordered table table-striped" id="dataTables-example">
	<thead>
		<tr>
			<th>No.</th>
			<th>USULAN</th>
			<th>VOLUME</th>
			<th>HARGA</th>
			<th>SATUAN</th>
			<th>NILAI</th>
		</tr>
	</thead>
	<tbody>
		<?php while($rs=$sql->fetch_object()){ ?>
		<tr>
			<td><?php echo $i; ?></td>
			<td><?php echo $rs->rincian; ?></td>
			<td><?php echo $rs->volume; ?></td>
			<td><?php echo rpzx($rs->harga); ?></td>
			<td><?php echo $rs->satuan; ?></td>
			<td><?php echo rpzx($rs->nilai); ?></td>
			<td>
				<input type="button" value="PILIH" onclick="pilihusulan('<?php echo $rs->notrans;?>','<?php echo $rs->rincian;?>','<?php echo $rs->volume;?>','<?php echo rpz($rs->harga);?>',
				'<?php echo $rs->satuan;?>','<?php echo rpz($rs->nilai);?>')">
			</td>
		</tr>
		<?php $i++; } ?>
	</tbody>
</table>	
<script>
	function cariusulan(){
		kodekegiatan=document.form.kodekegiatan.value;	
		usulantxt = document.querySelector('#cariusulantxt').value;
		$.get('trans_/penyusunan/penyesuaianperioritas/cariusulan.php',{
			usulantxt:usulantxt,
			kodekegiatan:kodekegiatan,
		},
		function(rs){
			document.querySelector('#cariusulancontent').innerHTML = rs;
		});
	}
</script>
<?php include "../../../close.php";?>
</div>