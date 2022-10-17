<?php include("../../conn.php"); ?>
<?php
if($_SESSION["anggaran_koderuangan"]==''){
	$sql=$conn->query("select npdpanjar_heder.nonpdpanjar as nonpdpanjar,npdpanjar_heder.tglnpdpanjar as tglnpdpanjar,
						npdpanjar_heder.pptk as pptk,npdpanjar_heder.triwulan as triwulan,
						npdpanjar_heder.program as program,npdpanjar_heder.kegiatan as kegiatan,npdpanjar_heder.kunci as kunci,
						npdpanjar_heder.kegiatanblud as kegiatanblud,round(sum(npdpanjar_rinci.totalpermintaanpanjar),2) as total
						from npdpanjar_heder left join npdpanjar_rinci
						on npdpanjar_rinci.nonpdpanjar=npdpanjar_heder.nonpdpanjar
						where year(npdpanjar_heder.tglnpdpanjar)='".$_SESSION["anggaran_tahun"]."' and npdpanjar_heder.kunci=1 and npdpanjar_heder.verif=''
						group by npdpanjar_heder.nonpdpanjar");
}else{
	$sql=$conn->query("select npdpanjar_heder.nonpdpanjar as nonpdpanjar,npdpanjar_heder.tglnpdpanjar as tglnpdpanjar,
						npdpanjar_heder.pptk as pptk,npdpanjar_heder.triwulan as triwulan,
						npdpanjar_heder.program as program,npdpanjar_heder.kegiatan as kegiatan,npdpanjar_heder.kunci as kunci,
						npdpanjar_heder.kegiatanblud as kegiatanblud,round(sum(npdpanjar_rinci.totalpermintaanpanjar),2) as total
						from npdpanjar_heder left join npdpanjar_rinci
						on npdpanjar_rinci.nonpdpanjar=npdpanjar_heder.nonpdpanjar
						where year(npdpanjar_heder.tglnpdpanjar)='".$_SESSION["anggaran_tahun"]."' and npdpanjar_heder.kunci=1 and npdpanjar_heder.verif=''
						and npdpanjar_heder.kodebidang='".$_SESSION["anggaran_koderuangan"]."'
						group by npdpanjar_heder.nonpdpanjar");
}
	$i=1;
?>
<br />

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
				<td align="center"><a href="javascript:void(0)"; onClick="viewdetail('<?php echo $rs->nonpdpanjar; ?>');"><?php echo $rs->nonpdpanjar; ?></a></td>
				<td><?php echo $rs->tglnpdpanjar; ?></td>
				<td><?php echo $rs->triwulan; ?></td>
				<td><?php echo $rs->pptk; ?></td>
				<td><?php echo $rs->program; ?></td>
				<td><?php echo $rs->kegiatan; ?></td>
				<td><?php echo $rs->kegiatanblud; ?></td>
				<td><?php echo rpzx($rs->total); ?></td>
				<td>
					<a href="javascript:void(0)" onclick="kunci('<?php echo $rs->nonpdpanjar; ?>')" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> VERIFIKASI </a>
				</td>
			</tr>
			<?php
				$i++;
				}
			?>
		</tbody>
	</table>
<?php include("../../close.php"); ?>