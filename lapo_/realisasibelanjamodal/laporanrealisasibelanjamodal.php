<?php include("../../conn.php"); ?>
<?php
$tglskrng=date('d');
$blnskrng=date('m');

$tgl=in_tanggal("/",trim($_GET['tgl']));
$tgl_x=explode( '-', $tgl );
$bulan=$tgl_x[1];
$hari=$tgl_x[2];

$tglx=in_tanggal("/",trim($_GET['tglx']));
$tgl_x2=explode( '-', $tglx );
$bulan2=$tgl_x2[1];
$hari2=$tgl_x2[2];

	$tgl_1=explode( '-', $tgl );
	$thn=$tgl_1[0];
	$kode= '1.3.2';
?>
<a href="javascript:void(0)" onclick="ExportToExcel_laporanLRA()"><img src="images/excel.jpg" width="20" height="20">Export to Excel</a>
<?php
	$sql=$conn->query("select npkls_heder.tglpencairan as tgl,npkls_rinci.nopencairan as nopencairan,npkls_rinci.nonpdls as nonpd,npdls_heder.nonpdls as nonpdls,npdls_rinci.koderek108 as kodeaset,npdls_rinci.itembelanja as itembelanja,npdls_rinci.uraian108 as namaaset,
       npdls_rinci.volumels as jumlah,npdls_rinci.hargals as harga,npdls_rinci.totalls as nilai,'' as keterangan 
       from npdls_heder,npdls_rinci,npkls_rinci,npkls_heder
       where npdls_heder.nonpdls=npdls_rinci.nonpdls and npdls_rinci.nonpdls=npkls_rinci.nonpdls 
       and npkls_heder.nopencairan<>'' and npkls_heder.tglpencairan>='".$tgl."' and npkls_heder.tglpencairan<='".$tglx."'
       and npkls_heder.nopencairan=npkls_rinci.nopencairan
       and SUBSTRING_INDEX(npdls_rinci.koderek108,'.',3)='".$kode."' order by npdls_rinci.uraian108");
	$i=1;
?>
<div id="excel_repot_laporanLRA">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<center>BADAN LAYANAN UMUM DAERAH <?php echo  $rs1->nama;?></br>
				LAPORAN REALISASI BELANJA MODAL </br>
				PERIODE <?php echo  $hari.' '.bulan($bulan).' - '.$hari2.' '.bulan($bulan2).' '.$thn;?> </center>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<table class="table table-bordered table-striped jambo_table bulk_action dt-head-center" id="dataTables-examplex"> 
						<thead>
							<tr>
								<th nowrap="nowrap">NO.</th>
								<th nowrap="nowrap">TGL PENCAIRAN</th>
								<th nowrap="nowrap">NO. PENCAIRAN NPK</th>
								<th nowrap="nowrap">NO. NPD</th>
								<th nowrap="nowrap">KODE ASET</th>
								<th nowrap="nowrap">NAMA ASET </th>
								<th nowrap="nowrap">JUMLAH</th>
								<th nowrap="nowrap">HARGA</th>
								<th nowrap="nowrap">NILAI</th>
							</tr>
						</thead>
						<tbody>
							<?php while($rs=$sql->fetch_object()){ ?>
							<tr>
								<td><?php echo $i; ?></td>
								<td><?php echo $rs->tgl; ?></td>
								<td><?php echo $rs->nopencairan; ?></td>
								<td><?php echo $rs->nonpd; ?></td>
								<td><?php echo $rs->kodeaset; ?></td>
								<td><?php echo $rs->namaaset; ?></td>
								<td align="right" nowrap='nowrap'><?php echo $rs->jumlah; ?></td>
								<td align="right" nowrap='nowrap'><?php echo rpzx($rs->harga); ?></td>
								<td align="right" nowrap='nowrap'><?php echo rpzx($rs->nilai); ?></td>
							</tr>
							<?php $i++ ;$totalnilai=$totalnilai+$rs->nilai;}?>
							<tr class="p-3 mb-2 bg-danger text-white" valign="top";>
								<td colspan="8" align="right"><b>JUMLAH</b></td>
								<td align="right"><b><?php echo rpzx($totalnilai); ?></b></td>
							</tr>
						</tbody>
					</table>
					<table width="100%" align="right">
						<tr align="center">
							<td></td>
							<td width="100">&nbsp;&nbsp;</td>
							<td>&nbsp;Probolinggo <?php echo $tglskrng.' '.bulan($blnskrng).' '.$thn;?>&nbsp;</td>
							
						</tr>
						<tr align="center">
							<td>&nbsp;&nbsp;</td>
							<td width="100">&nbsp;&nbsp;</td>
							<td>Pimpinan Badan Layanan Umum Daerah</td>
						</tr>
						<tr>
							<td colspan="5" height="30px">&nbsp;&nbsp;</td>
						</tr>
						<tr align="center">
							<td>&nbsp;<u></u>&nbsp;</td>
							<td width="100">&nbsp;&nbsp;</td>
							<td>&nbsp;<u>( dr. Abraar HS Kuddah, M.Si. Med., Sp.B )</u>&nbsp;</td>
						</tr>
						<tr align="center">
							<td>&nbsp;&nbsp;</td>
							<td width="100">&nbsp;&nbsp;</td>
							<td>&nbsp;NIP. 19690224 201406 1 001&nbsp;</td>
						</tr>
					</table>
				</br>
			</div>
		</div>
	</div>
</div>
<?php include("../../close.php"); ?>