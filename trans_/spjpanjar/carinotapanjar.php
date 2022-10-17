<div id='cariusulancontent'>
<?php include "../../conn.php";?>
<?php
	$usulantxt='';
	if(isset($_GET['usulantxt']))
		$usulantxt=$_GET['usulantxt'];
		if($_SESSION['anggaran_koderuangan'] == ''){
			$sql=$conn->query("select notapanjar_rinci.nonotapanjar as nonotapanjar,notapanjar_heder.kodepptk as kodepptk,notapanjar_heder.pptk as pptk,notapanjar_heder.program as program,
						notapanjar_heder.kegiatan as kegiatan,notapanjar_heder.kodekegiatanblud as kodekegiatanblud,notapanjar_heder.kegiatanblud as kegiatanblud,
						sum(notapanjar_rinci.total) as total
						from notapanjar_heder,notapanjar_rinci
						where notapanjar_rinci.nonotapanjar=notapanjar_heder.nonotapanjar 
						and year(notapanjar_heder.tglnotapanjar)='".$_SESSION['anggaran_tahun']."' and notapanjar_heder.kunci=1 and notapanjar_heder.flag='' and
						notapanjar_heder.nonotapanjar like '%".$usulantxt."%' group by notapanjar_rinci.nonotapanjar");
		}else{
			$sql=$conn->query("select notapanjar_rinci.nonotapanjar as nonotapanjar,notapanjar_heder.kodepptk as kodepptk,notapanjar_heder.pptk as pptk,notapanjar_heder.program as program,
						notapanjar_heder.kegiatan as kegiatan,notapanjar_heder.kodekegiatanblud as kodekegiatanblud,notapanjar_heder.kegiatanblud as kegiatanblud,
						sum(notapanjar_rinci.total) as total
						from notapanjar_heder,notapanjar_rinci
						where notapanjar_rinci.nonotapanjar=notapanjar_heder.nonotapanjar and notapanjar_heder.kodebidang='".$_SESSION['anggaran_koderuangan']."' 
						and year(notapanjar_heder.tglnotapanjar)='".$_SESSION['anggaran_tahun']."' and notapanjar_heder.kunci=1 and notapanjar_heder.flag='' and
						notapanjar_heder.nonotapanjar like '%".$usulantxt."%' group by notapanjar_rinci.nonotapanjar");
		}
$i=1;
?>
<input type='text' name='cariusulantxt' id='cariusulantxt'>
<input type="button" value="Cari" onclick='cariusulan();'>
<table class="table table-hover table-bordered table table-striped" id="dataTables-example">
	<thead>
		<tr>
			<th>No.</th>
			<th>NOTA PANJAR</th>
			<th>KEGIATAN BLUD</th>
			<th>TOTAL</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php while($rs=$sql->fetch_object()){ ?>
		<tr>
			<td><?php echo $i; ?></td>
			<td><?php echo $rs->nonotapanjar; ?></td>
			<td><?php echo $rs->kegiatanblud; ?></td>
			<td><?php echo rpzx($rs->total); ?></td>
			<td>
				<input type="button" value="PILIH" onclick="pilihnotapanjar('<?php echo $rs->nonotapanjar;?>','<?php echo $rs->kodepptk; ?>',
				'<?php echo $rs->pptk; ?>','<?php echo $rs->program; ?>','<?php echo $rs->kegiatan; ?>','<?php echo $rs->kodekegiatanblud; ?>',
				'<?php echo $rs->kegiatanblud; ?>','<?php echo rpz($rs->total); ?>')">
			</td>
		</tr>
		<?php $i++; } ?>
	</tbody>
</table>	
<script>
	function cariusulan(){
		usulantxt = document.querySelector('#cariusulantxt').value;
		$.get('trans_/spjpanjar/carinotapanjar.php',{
			usulantxt:usulantxt,
		},
		function(rs){
			document.querySelector('#cariusulancontent').innerHTML = rs;
		});
	}
</script>
<?php include "../../close.php";?>
</div>