<div id='cariusulancontent'>
<?php include("../../../conn.php"); ?>
<?php
	$usulantxt='';
	if(isset($_GET['usulantxt']))
		$usulantxt=$_GET['usulantxt']; 
	
	$sql=$conn->query("select npdpanjar_heder.nonpdpanjar as nonpdpanjar,npdpanjar_heder.tglnpdpanjar as tglnpdpanjar,npdpanjar_heder.kodepptk as kodepptk,
						npdpanjar_heder.pptk as pptk,npdpanjar_heder.triwulan as triwulan,
						npdpanjar_heder.program as program,npdpanjar_heder.kegiatan as kegiatan,npdpanjar_heder.kunci as kunci,
						npdpanjar_heder.kegiatanblud as kegiatanblud,npdpanjar_heder.kodekegiatanblud as kodekegiatanblud,
						round(sum(npdpanjar_rinci.totalpermintaanpanjar),2) as total
						from npdpanjar_heder left join npdpanjar_rinci
						on npdpanjar_rinci.nonpdpanjar=npdpanjar_heder.nonpdpanjar
						where year(npdpanjar_heder.tglnpdpanjar)='".$_SESSION["anggaran_tahun"]."' and npdpanjar_heder.kunci=1 and npdpanjar_heder.flagspp=''
						and npdpanjar_heder.nonpdpanjar like '%".$usulantxt."%'
						group by npdpanjar_heder.nonpdpanjar");
	$i=1;
?>
<br />
<input type='text' name='cariusulantxt' id='cariusulantxt'>
<input type="button" value="Cari" onclick='cariusulan();'>
<table class="table table-hover table-bordered table table-striped" id="dataTables-example">
		<thead>
			<tr>
				<th>No.</th>
				<th align="center">NO. NPD PANJAR</th>
				<th align="center">TGL NPD PANJAR</th>
				<th align="center">TRIWULAN</th>
				<th align="center">PPTK</th>
				<th align="center">PROGRAM</th>
				<th align="center">KEGIATAN</th>
				<th align="center">KEGIATAN BLUD</th>
				<th align="center">TOTAL</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php while($rs=$sql->fetch_object()){ ?>
			<tr>
				<td><?php echo $i; ?></td>
				<td align="center"><?php echo $rs->nonpdpanjar; ?></td>
				<td><?php echo out_tanggal('-',$rs->tglnpdpanjar); ?></td>
				<td><?php echo $rs->triwulan; ?></td>
				<td><?php echo $rs->pptk; ?></td>
				<td><?php echo $rs->program; ?></td>
				<td><?php echo $rs->kegiatan; ?></td>
				<td><?php echo $rs->kegiatanblud; ?></td>
				<td><?php echo rpzx($rs->total); ?></td>
				<td><input type="button" value="PILIH" onclick="pilihnpd('<?php echo $rs->nonpdpanjar;?>','<?php echo out_tanggal('-',$rs->tglnpdpanjar);?>','<?php echo $rs->triwulan; ?>',
			'<?php echo $rs->kodepptk; ?>','<?php echo $rs->pptk; ?>','<?php echo $rs->program; ?>','<?php echo $rs->kegiatan;?>','<?php echo $rs->kodekegiatanblud;?>','<?php echo $rs->kegiatanblud;?>','<?php echo rpz($rs->total);?>');"></td>
			</tr>
			<?php
				$i++;
				}
			?>
		</tbody>
	</table>
<script>
	function cariusulan(){
		usulantxt = document.querySelector('#cariusulantxt').value;
		$.get('trans_/panjar/spp/carinpd.php',{
			usulantxt:usulantxt,
		},
		function(rs){
			document.querySelector('#cariusulancontent').innerHTML = rs;
		});
	}
</script>
<?php include("../../../close.php"); ?>