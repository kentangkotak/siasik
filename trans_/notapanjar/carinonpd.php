<div id='cariusulancontent'>
<?php include "../../conn.php";?>
<?php
	$usulantxt='';
	if(isset($_GET['usulantxt']))
		$usulantxt=$_GET['usulantxt']; 

    $sql=$conn->query("select npdpanjar_heder.nonpdpanjar as nonpdpanjar,npdpanjar_heder.kodepptk as kodepptk,npdpanjar_heder.pptk as pptk,
						npdpanjar_heder.kodekegiatanblud as kodekegiatanblud,npdpanjar_heder.kegiatanblud as kegiatanblud,npdpanjar_heder.kodebidang as kodebidang,npdpanjar_heder.bidang as bidang,
						npdpanjar_heder.triwulan as triwulan,npdpanjar_rinci.koderek50 as koderek50,npdpanjar_rinci.rincianbelanja50 as rincianbelanja50,
						npdpanjar_rinci.nopp as nopp,npdpanjar_rinci.nousulan as nousulan,sum(npdpanjar_rinci.totalpermintaanpanjar) as total,npdpanjar_heder.triwulan as triwulan
						from npdpanjar_heder,npdpanjar_rinci 
						where npdpanjar_heder.nonpdpanjar=npdpanjar_rinci.nonpdpanjar and 
						npdpanjar_heder.nonpdpanjar like '%".$usulantxt."%' and npdpanjar_heder.kunci='1' and npdpanjar_heder.flag='1' and 
						npdpanjar_heder.verif='1' and npdpanjar_heder.flagnotapanjar='' and year(npdpanjar_heder.tglnpdpanjar)='".$_SESSION["anggaran_tahun"]."'
						group by npdpanjar_heder.nonpdpanjar");
$i=1;
?>
<input type='text' name='cariusulantxt' id='cariusulantxt'>
<input type="button" value="Cari" onclick='cariusulan();'>
<table class="table table-hover table-bordered table table-striped" id="dataTables-example">
	<thead>
		<tr>
			<th>No.</th>
			<th>NO. NPD PANJAR</th>
			<th>PPTK</th>
			<th>KEGIATAN BLUD</th>
			<th>TOTAL ANGGARAN</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php while($rs=$sql->fetch_object()){ ?>
		<tr>
			<td><?php echo $i; ?></td>
			<td><?php echo $rs->nonpdpanjar; ?></td>
			<td><?php echo $rs->pptk; ?></td>
			<td><?php echo $rs->kegiatanblud; ?></td>
			<td align="right"><?php echo rp($rs->total); ?></td>
			<td><input type="button" value="PILIH" onclick="pilihnonpdpanjar('<?php echo $rs->nonpdpanjar;?>','<?php echo $rs->kodepptk;?>','<?php echo $rs->pptk; ?>',
			'<?php echo $rs->kodekegiatanblud; ?>','<?php echo $rs->kegiatanblud; ?>','<?php echo rpz($rs->total);?>','<?php echo $rs->kodebidang; ?>','<?php echo $rs->bidang; ?>',
			'<?php echo $rs->koderek50; ?>','<?php echo $rs->rincianbelanja50; ?>','<?php echo $rs->nopp; ?>','<?php echo $rs->nousulan; ?>','<?php echo $rs->triwulan; ?>');"></td>
		</tr>
		<?php $i++; } ?>
	</tbody>
</table>	
<script>
	function cariusulan(){
		usulantxt = document.querySelector('#cariusulantxt').value;
		$.get('trans_/notapanjar/carinonpd.php',{
			usulantxt:usulantxt,
			koderek50:koderek50,
			kodekegiatanblud:kodekegiatanblud,
		},
		function(rs){
			document.querySelector('#cariusulancontent').innerHTML = rs;
		});
	}
</script>
<?php include "../../close.php";?>
</div>