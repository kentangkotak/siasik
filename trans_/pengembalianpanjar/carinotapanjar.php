<div id='cariusulancontent'>
<?php include "../../conn.php";?>
<?php
	$usulantxt='';
	if(isset($_GET['usulantxt']))
		$usulantxt=$_GET['usulantxt'];
	
		$sql=$conn->query("select notapanjar_rinci.nonotapanjar as nonotapanjar,notapanjar_heder.kodepptk as kodepptk,notapanjar_heder.pptk as pptk,
						notapanjar_heder.program as program,notapanjar_rinci.koderek50 as koderek50,notapanjar_rinci.rincianbelanja50 as rincianbelanja,
						notapanjar_heder.kegiatan as kegiatan,notapanjar_heder.kodekegiatanblud as kodekegiatanblud,notapanjar_heder.kegiatanblud as kegiatanblud,
						notapanjar_rinci.total as total,notapanjar_heder.nonpd as nonpdpanjar
						from notapanjar_heder,notapanjar_rinci
						where notapanjar_rinci.nonotapanjar=notapanjar_heder.nonotapanjar and year(notapanjar_heder.tglnotapanjar)='".$_SESSION["anggaran_tahun"]."' 
						and notapanjar_heder.nonotapanjar like '%".$usulantxt."%' and notapanjar_heder.flag_pengembalian='' ");
$i=1;
?>
<input type='text' name='cariusulantxt' id='cariusulantxt'>
<input type="button" value="Cari" onclick='cariusulan();'>
<table class="table table-hover table-bordered table table-striped" id="dataTables-example">
	<thead>
		<tr>
			<th>No.</th>
			<th>NOTA PANJAR</th>
			<th>PPTK</th>
			<th>PROGRAM</th>
			<th>KEGIATAN</th>
			<th>KEGIATAN BLUD</th>
			<th>KODEREK BLUD</th>
			<th>RINCIAN BELANJA</th>
			<th>TOTAL</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php while($rs=$sql->fetch_object()){ ?>
		<tr>
			<td><?php echo $i; ?></td>
			<td><?php echo $rs->nonotapanjar; ?></td>
			<td><?php echo $rs->pptk; ?></td>
			<td><?php echo $rs->program; ?></td>
			<td><?php echo $rs->kegiatan; ?></td>
			<td><?php echo $rs->kegiatanblud; ?></td>
			<td><?php echo $rs->koderek50; ?></td>
			<td><?php echo $rs->rincianbelanja; ?></td>
			<td>
				<input type="button" value="PILIH" onclick="pilihnotapanjar('<?php echo $rs->nonotapanjar;?>','<?php echo $rs->kodepptk; ?>',
				'<?php echo $rs->pptk; ?>','<?php echo $rs->program; ?>','<?php echo $rs->kegiatan; ?>','<?php echo $rs->kodekegiatanblud; ?>',
				'<?php echo $rs->kegiatanblud; ?>','<?php echo $rs->koderek50; ?>','<?php echo $rs->rincianbelanja; ?>','<?php echo $rs->nonpdpanjar; ?>',
				'<?php echo $rs->total; ?>')">
			</td>
		</tr>
		<?php $i++; } ?>
	</tbody>
</table>	
<script>
	function cariusulan(){
		usulantxt = document.querySelector('#cariusulantxt').value;
		$.get('trans_/npdls/caripenerima.php',{
			usulantxt:usulantxt,
		},
		function(rs){
			document.querySelector('#cariusulancontent').innerHTML = rs;
		});
	}
</script>
<?php include "../../close.php";?>
</div>