<?php include("../../conn.php"); ?>
<?php

	$sql=$conn->query("select nonpd,tglnpd,namapptk,triwulan,program,kegiatan,kegiatanblud,total,jenis from(
	select npdls_heder.nonpdls as nonpd,npdls_heder.tglnpdls as tglnpd,npdls_heder.pptk as namapptk,npdls_heder.triwulan as triwulan,
						npdls_heder.program as program,
						npdls_heder.kegiatan as kegiatan,npdls_heder.kegiatanblud as kegiatanblud,
						round(sum(npdls_rinci.nominalpembayaran),2) as total,npdls_heder.kunci as kunci,'LS' as jenis
						from npdls_heder left join npdls_rinci 
						on npdls_heder.nonpdls=npdls_rinci.nonpdls
						where year(npdls_heder.tglnpdls)='".$_SESSION["anggaran_tahun"]."' and npdls_heder.kunci=1 and npdls_heder.verif='1'
						group by npdls_heder.nonpdls
						union all
						select npdpanjar_heder.nonpdpanjar as nonpd,npdpanjar_heder.tglnpdpanjar as tglnpd,
						npdpanjar_heder.pptk as namapptk,npdpanjar_heder.triwulan as triwulan,
						npdpanjar_heder.program as program,npdpanjar_heder.kegiatan as kegiatan,
						npdpanjar_heder.kegiatanblud as kegiatanblud,round(sum(npdpanjar_rinci.totalpermintaanpanjar),2) as total,
						npdpanjar_heder.kunci as kunci,'PANJAR' as jenis
						from npdpanjar_heder left join npdpanjar_rinci
						on npdpanjar_rinci.nonpdpanjar=npdpanjar_heder.nonpdpanjar
						where year(npdpanjar_heder.tglnpdpanjar)='".$_SESSION["anggaran_tahun"]."' and npdpanjar_heder.kunci=1 and npdpanjar_heder.verif=1
						group by npdpanjar_heder.nonpdpanjar) as xxx");

	$i=1;
?>
<br />

<table class="table table-hover table-bordered table table-striped" id="dataTables-example">
		<thead>
			<tr>
				<th>No.</th>
				<th align="center">NO. NPD</th>
				<th align="center">TGL NPD</th>
				<th align="center">TRIWULAN</th>
				<th align="center">PPTK</th>
				<th align="center">PROGRAM</th>
				<th align="center">KEGIATAN</th>
				<th align="center">KEGIATAN BLUD</th>
				<th align="center">TOTAL</th>
			</tr>
		</thead>
		<tbody>
			<?php while($rs=$sql->fetch_object()){ ?>
			<tr>
				<td><?php echo $i; ?></td>
				<td align="center"><a href="javascript:void(0)"; onClick="formnpdcontra('<?php echo $rs->nonpd; ?>','<?php echo $rs->jenis; ?>');"><?php echo $rs->nonpd; ?></a></td>
				<td><?php echo out_tanggal('-',$rs->tglnpd); ?></td>
				<td><?php echo $rs->triwulan." (".$rs->jenis; ?>)</td>
				<td><?php echo $rs->namapptk; ?></td>
				<td><?php echo $rs->program; ?></td>
				<td><?php echo $rs->kegiatan; ?></td>
				<td><?php echo $rs->kegiatanblud; ?></td>
				<td><?php echo rpzx($rs->total); ?></td>
			</tr>
			<?php
				$i++;
				}
			?>
		</tbody>
	</table>
<?php include("../../close.php"); ?>