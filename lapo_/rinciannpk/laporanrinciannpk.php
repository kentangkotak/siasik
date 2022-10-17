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
	$sql=$conn->query("SELECT npkls_heder.tglnpk as tgl,npkls_heder.nonpk as nonpk,npkls_rinci.nonpdls as nonpd,npkls_rinci.kegiatanblud as kegiatanblud,mappingpptkkegiatan.bidang as bidang,
						npdls_rinci.koderek50 as koderek50,
						npdls_rinci.rincianbelanja as rincianbelanja,npdls_rinci.koderek108 as kode108,npdls_rinci.uraian108 as uraian,npdls_rinci.itembelanja as itembelanja,
						npdls_rinci.nominalpembayaran as total
						from npkls_heder,npkls_rinci,npdls_rinci,mappingpptkkegiatan
						where npkls_heder.nonpk=npkls_rinci.nonpk and npkls_rinci.nonpdls=npdls_rinci.nonpdls
						and mappingpptkkegiatan.kodekegiatan=npkls_rinci.kodekegiatanblud and npkls_heder.tglnpk >='".$tgl."' and npkls_heder.tglnpk<='".$tglx."' order by npkls_heder.tglnpk");
	$i=1;
	$tmp_tgl="";
	$tmp_nonpk="";
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
								<th nowrap="nowrap">TGL NPK</th>
								<th nowrap="nowrap">NO. NPK</th>
								<th nowrap="nowrap">NO. NPD</th>
								<th nowrap="nowrap">KEGIATAN BLUD</th>
								<th nowrap="nowrap">BIDANG</th>
								<th nowrap="nowrap">KODE REKENING 50</th>
								<th nowrap="nowrap">URAIAN REKENING 50</th>
								<th nowrap="nowrap">KODE REKENING 108</th>
								<th nowrap="nowrap">URAIAN REKENING 108</th>
								<th nowrap="nowrap">NILAI</th>
							</tr>
						</thead>
						<tbody>
							<?php while($rs=$sql->fetch_object()){ ?>
							<tr>
								<td><?php echo $i; ?></td>
								<?php if($tmp_tgl=='' || $tmp_tgl <> $rs->tgl){ ?>
								<td><?php echo $tmp_tgl=$rs->tgl; ?></td>
								<td><?php echo $tmp_nonpk=$rs->nonpk; ?></td>
								<?php }else{ ?>
								<td nowrap="nowrap"><?php echo ""; ?></td>
								<td nowrap="nowrap"><?php echo ""; ?></td>
								<?php } ?>
								<td><?php echo $rs->nonpd; ?></td>
								<td><?php echo $rs->kegiatanblud; ?></td>
								<td><?php echo $rs->bidang; ?></td>
								<td><?php echo $rs->koderek50; ?></td>
								<td><?php echo $rs->rincianbelanja; ?></td>
								<td><?php echo $rs->kode108; ?></td>
								<td><?php echo $rs->uraian; ?></td>
								<td align="right" nowrap='nowrap'><?php echo rpzx($rs->total); ?></td>
							</tr>
							<?php $i++ ;$totalnilai=$totalnilai+$rs->total;}?>
							<tr class="p-3 mb-2 bg-danger text-white" valign="top";>
								<td colspan="10" align="right"><b>JUMLAH</b></td>
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