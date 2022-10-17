<?php include("../../conn.php"); ?>
<?php
if($_SESSION["anggaran_koderuangan"]==''){
	$sql=$conn->query("select npdls_heder.nonpdls as nonpdls,npdls_heder.tglnpdls as tglnpdls,npdls_heder.pptk as namapptk,npdls_heder.triwulan as triwulan,npdls_heder.program as program,npdls_heder.keterangan as keterangan,
						npdls_heder.nokontrak as nokontrak,npdls_heder.kegiatan as kegiatan,npdls_heder.kodekegiatanblud as kodekegiatanblud,npdls_heder.kegiatanblud as kegiatanblud,npdls_heder.penerima as penerima,
						round(sum(npdls_rinci.nominalpembayaran),2) as total,npdls_heder.kunci as kunci,npdls_rinci.koderek50 as koderek50,npdls_heder.serahterimapekerjaan as serahterimapekerjaan
						from npdls_heder left join npdls_rinci 
						on npdls_heder.nonpdls=npdls_rinci.nonpdls
						where year(npdls_heder.tglnpdls)='".$_SESSION["anggaran_tahun"]."' and npdls_heder.kunci=1 and npdls_heder.verif='1'
						group by npdls_heder.nonpdls");
}else{
	$sql=$conn->query("select npdls_heder.nonpdls as nonpdls,npdls_heder.tglnpdls as tglnpdls,npdls_heder.pptk as namapptk,npdls_heder.triwulan as triwulan,npdls_heder.program as program,npdls_heder.keterangan as keterangan,
						npdls_heder.nokontrak as nokontrak,npdls_heder.kegiatan as kegiatan,npdls_heder.kodekegiatanblud as kodekegiatanblud,npdls_heder.kegiatanblud as kegiatanblud,npdls_heder.penerima as penerima,
						round(sum(npdls_rinci.nominalpembayaran),2) as total,npdls_heder.kunci as kunci,npdls_rinci.koderek50 as koderek50,npdls_heder.serahterimapekerjaan as serahterimapekerjaan
						from npdls_heder left join npdls_rinci 
						on npdls_heder.nonpdls=npdls_rinci.nonpdls
						where year(npdls_heder.tglnpdls)='".$_SESSION["anggaran_tahun"]."' and npdls_heder.kodebidang='".$_SESSION["anggaran_koderuangan"]."' and npdls_heder.kunci=1 and npdls_heder.verif='1'
						group by npdls_heder.nonpdls");
}
	$i=1;
?>
<br />

<table class="table table-hover table-bordered table table-striped" id="dataTables-example">
		<thead>
			<tr>
				<th>No.</th>
				<th align="center">NO. NPD LS</th>
				<th align="center">NO. KONTRAK</th>
				<th align="center">TGL NPD PANJAR</th>
				<th align="center">TRIWULAN</th>
				<th align="center">PPTK</th>
				<th align="center">KETERANGAN</th>
				<th align="center">KEGIATAN BLUD</th>
				<th align="center">PIHAK PENERIMA</th>
				<th align="center">TOTAL</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php while($rs=$sql->fetch_object()){ ?>
			<tr>
				<td><?php echo $i; ?></td>
				<td align="center"><a href="javascript:void(0)"; onClick="viewdetail('<?php echo $rs->nonpdls; ?>');"><?php echo $rs->nonpdls; ?></a></td>
				<td><?php echo $rs->nokontrak; ?></td>
				<td><?php echo out_tanggal('-',$rs->tglnpdls); ?></td>
				<td><?php echo $rs->triwulan; ?></td>
				<td><?php echo $rs->namapptk; ?></td>
				<td><?php echo $rs->keterangan; ?></td>
				<td><?php echo $rs->kegiatanblud; ?></td>
				<td><?php echo $rs->penerima; ?></td>
				<td><?php echo rpzx($rs->total); ?></td>
				<td>
					<a href="javascript:void(0)" onclick="bukakunci('<?php echo $rs->nonpdls; ?>')" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> BATAL VERIFIKASI </a>
				</td>
			</tr>
			<?php
				$i++;
				}
			?>
		</tbody>
	</table>
<?php include("../../close.php"); ?>