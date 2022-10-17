<?php include "../../conn.php";?>
<?php

    $sql=$conn->query("select npdpanjar_heder.nonpdpanjar as nonpdpanjar,npdpanjar_heder.tglnpdpanjar as tglnpdpanjar,
						npdpanjar_heder.pptk as pptk,npdpanjar_heder.triwulan as triwulan,
						npdpanjar_heder.program as program,npdpanjar_heder.kegiatan as kegiatan,npdpanjar_heder.kunci as kunci,
						npdpanjar_heder.kodekegiatanblud as kodekegiatanblud,
						npdpanjar_heder.kegiatanblud as kegiatanblud,round(sum(npdpanjar_rinci.totalpermintaanpanjar),2) as total
						from npdpanjar_heder left join npdpanjar_rinci
						on npdpanjar_rinci.nonpdpanjar=npdpanjar_heder.nonpdpanjar
						where year(npdpanjar_heder.tglnpdpanjar)='".$_SESSION["anggaran_tahun"]."' and npdpanjar_heder.kunci=1
						and npdpanjar_heder.verif=1 and npdpanjar_heder.flag=''
						group by npdpanjar_heder.nonpdpanjar");
$i=1;
?>
<table class="table table-hover table-bordered table table-striped" id="dataTables-example">
	<thead>
		<tr>
			<th>No.</th>
			<th>No. NPD PANJAR</th>
			<th>TGL NPD PANJAR</th>
			<th>KEGIATAN</th>
			<th>KEGIATAN BLUD</th>
			<th>TOTAL</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php while($rs=$sql->fetch_object()){ ?>
		<tr>
			<td><?php echo $i; ?></td>
			<td><?php echo $rs->nonpdpanjar; ?></td>
			<td><?php echo $rs->tglnpdpanjar; ?></td>
			<td><?php echo $rs->kegiatan; ?></td>
			<td><?php echo $rs->kegiatanblud; ?></td>
			<td align="right"><?php echo rp($rs->total); ?></td>
			<td><input type="button" value="PILIH" onclick="pilih('<?php echo $rs->nonpdpanjar;?>','<?php echo $rs->kodekegiatanblud; ?>',
			'<?php echo out_tanggal("-",$rs->tglnpdpanjar);?>','<?php echo $rs->kegiatan;?>','<?php echo $rs->kegiatanblud;?>','<?php echo rpz($rs->total);?>');"></td>
		</tr>
		<?php $i++; } ?>
	</tbody>
</table>	
<?php include "../../close.php";?>