<?php include("../../conn.php"); ?>
<?php
if($_SESSION["anggaran_koderuangan"]==''){
	$sql=$conn->query("select npdls_heder.nonpdls as nonpdls,npdls_heder.tglnpdls as tglnpdls,npdls_heder.pptk as namapptk,npdls_heder.triwulan as triwulan,npdls_heder.program as program,npdls_heder.keterangan as keterangan,
						npdls_heder.nokontrak as nokontrak,npdls_heder.kegiatan as kegiatan,npdls_heder.kodekegiatanblud as kodekegiatanblud,npdls_heder.kegiatanblud as kegiatanblud,npdls_heder.penerima as penerima,
						round(sum(npdls_rinci.nominalpembayaran),2) as total,npdls_heder.kunci as kunci,npdls_rinci.koderek50 as koderek50,npdls_heder.serahterimapekerjaan as serahterimapekerjaan,npdls_heder.nonpk as nonpk,npdls_heder.nopencairan as nopencairan
						from npdls_heder left join npdls_rinci 
						on npdls_heder.nonpdls=npdls_rinci.nonpdls
						where year(npdls_heder.tglnpdls)='".$_SESSION["anggaran_tahun"]."' 
						group by npdls_heder.nonpdls order by npdls_heder.tglnpdls desc");
}else{
	$sql=$conn->query("select npdls_heder.nonpdls as nonpdls,npdls_heder.tglnpdls as tglnpdls,npdls_heder.pptk as namapptk,npdls_heder.triwulan as triwulan,npdls_heder.program as program,npdls_heder.keterangan as keterangan,
						npdls_heder.nokontrak as nokontrak,npdls_heder.kegiatan as kegiatan,npdls_heder.kodekegiatanblud as kodekegiatanblud,npdls_heder.kegiatanblud as kegiatanblud,npdls_heder.penerima as penerima,
						round(sum(npdls_rinci.nominalpembayaran),2) as total,npdls_heder.kunci as kunci,npdls_rinci.koderek50 as koderek50,npdls_heder.serahterimapekerjaan as serahterimapekerjaan,npdls_heder.nonpk as nonpk,npdls_heder.nopencairan as nopencairan
						from npdls_heder left join npdls_rinci 
						on npdls_heder.nonpdls=npdls_rinci.nonpdls
						where year(npdls_heder.tglnpdls)='".$_SESSION["anggaran_tahun"]."' and npdls_heder.kodebidang='".$_SESSION["anggaran_koderuangan"]."'
						group by npdls_heder.nonpdls order by npdls_heder.tglnpdls desc");
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
				<th align="center">TGL NPD LS</th>
				<th align="center">TRIWULAN</th>
				<th align="center">PPTK</th>
			<!--	<th align="center">PROGRAM</th>
				<th align="center">KEGIATAN</th>-->
				<th align="center">KEGIATAN BLUD</th>
				<th align="center">PIHAK PENERIMA</th>
				<th align="center">KETERANGAN</th>
				<th align="center">STATUS</th>
				<th align="center">TOTAL</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php while($rs=$sql->fetch_object()){ ?>
			<tr>
				<td><?php echo $i; ?></td>
				<td align="center"><a href="javascript:void(0)"; onClick="formnpdls('<?php echo $rs->nonpdls; ?>','<?php echo $rs->nokontrak; ?>','<?php echo $rs->serahterimapekerjaan; ?>','<?php echo $rs->koderek50; ?>','<?php echo $rs->kodekegiatanblud; ?>');"><?php echo $rs->nonpdls; ?></a></td>
				<td><?php echo $rs->nokontrak; ?></td>
				<td><?php echo out_tanggal('-',$rs->tglnpdls); ?></td>
				<td><?php echo $rs->triwulan; ?></td>
				<td><?php echo $rs->namapptk; ?></td>
			<!--	<td><?php echo $rs->program; ?></td>
				<td><?php echo $rs->kegiatan; ?></td> -->
				<td><?php echo $rs->kegiatanblud; ?></td>
				<td><?php echo $rs->penerima; ?></td>
				<td><?php echo $rs->keterangan; ?></td>
				<td><?php if($rs->nopencairan == ''){echo '';}else{echo $rs->nopencairan;};?></td>
				<td><?php echo rpzx($rs->total); ?></td>
				<?php if($rs->kunci == ''){ ?>
					<td>
						<a href="javascript:void(0)" onclick="hapusHeader('<?php echo $rs->nonpdls; ?>','<?php echo $rs->nokontrak; ?>')"><img src="images/hapus.png" width="20" height="20"></a>
						<a href="javascript:void(0)" onclick="kunci('<?php echo $rs->nonpdls; ?>','<?php echo "garis_".$i; ?>')"><span id="<?php echo "garis_".$i ?>"><img src="images/unlock.png" width="20" height="20"></span></a>
					</td>
				<?php }else{ ?>
					<?php if($_SESSION["anggaran_aksi"] == '1'){ ?>
						<td>
							<a href="javascript:void(0)" onclick="bukakunci('<?php echo $rs->nonpdls; ?>','<?php echo "garis_".$i; ?>')"><span id="<?php echo "garis_".$i ?>"><img src="images/keyxx.png" width="20" height="20"></span></a>	
						</td>
					<?php }else{ ?>
						<td>
							<img src="images/keyxx.png" width="20" height="20">
						</td>
					<?php } ?>
				<?php } ?>
			</tr>
			<?php
				$i++;
				}
			?>
		</tbody>
	</table>
<?php include("../../close.php"); ?>