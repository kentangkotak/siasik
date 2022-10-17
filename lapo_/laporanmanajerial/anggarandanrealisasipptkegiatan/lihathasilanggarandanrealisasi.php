<?php include("../../../conn.php"); ?>
<?php
	$sql1=$conn->query("select * from profil" );
	$rs1=$sql1->fetch_object();
	
	$tgl=in_tanggal("/",trim($_GET['tgl']));
	$tglx=in_tanggal("/",trim($_GET['tglx']));

	$tgl_1=explode( '-', $tgl );
	$thn=$tgl_1[0];
?>
<!--<a href="javascript:void(0)" onclick="ExportToExcel_rbabelanja()"><img src="images/excel.jpg" width="20" height="20">Export to Excel</a>
<div id="excel_repot_rbabelanja">-->
<?php
		$sql=$conn->query("select pptk,kodekegiatan,kegiatan,round(sum(anggaran),2) as anggaran,round(sum(panjar),2) as panjar,round(sum(ls),2) as ls from(
							   select penyesesuaianperioritas_heder.pptk as pptk,penyesesuaianperioritas_heder.kodekegiatan as kodekegiatan,penyesesuaianperioritas_heder.kegiatan as kegiatan,t_tampung_pagu.pagu as anggaran,
							   '' as panjar,'' as ls 
							   from penyesesuaianperioritas_heder,t_tampung_pagu
							   where t_tampung_pagu.kodekegiatanblud=penyesesuaianperioritas_heder.kodekegiatan and year(penyesesuaianperioritas_heder.tgltrans)='".$thn."'
							   union all
							   select '' as pptk,spjpanjar_heder.kodekegiatanblud as kodekegiatan,'' as kegiatan,'' as anggaran,sum(spjpanjar_rinci.jumlahbelanjapanjar) as panjar,'' as ls
							   from spjpanjar_heder,spjpanjar_rinci
							   where spjpanjar_heder.nospjpanjar=spjpanjar_rinci.nospjpanjar and spjpanjar_heder.verif=1
							   and spjpanjar_heder.tglspjpanjar >='".$tgl."' and spjpanjar_heder.tglspjpanjar <='".$tglx."'
							   union all
							   select '' as pptk,npdls_heder.kodekegiatanblud as kodekegiatan,'' as kegiatan,'' as anggaran,'' as panjar,sum(npkls_rinci.total) as ls
							   from npkls_rinci,npkls_heder,npdls_heder
							   where npkls_heder.nopencairan=npkls_rinci.nopencairan and npkls_rinci.nonpdls=npdls_heder.nonpdls
							   and npkls_heder.tglpencairan >='".$tgl."' and npkls_heder.tglpencairan <='".$tglx."'
							   group by npdls_heder.kodekegiatanblud
						) as wew group by kodekegiatan order by pptk");
	
?>
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <center>BADAN LAYANAN UMUM DAERAH <?php echo  $rs1->nama;?></br>
				LAPORAN MANAJERIAL ANGGARAN & REALISASI PPTK KEGIATAN </br>
				TAHUN <?php echo $thn;?> </center>
        <div class="clearfix"></div>
      </div>
        <div class="x_content">
			<table class="table table-bordered table-striped jambo_table bulk_action dt-head-center" id="datatable-buttons"> 
					<thead>
						<tr>
							<th rowspan="2" class="text-center">PPTK</th>
							<th rowspan="2" class="text-center">KEGIATAN</th>
							<th rowspan="2" class="text-center">ANGGARAN</th>
							<th colspan="2" class="text-center">REALISASI</th>
							<th rowspan="2" class="text-center">TOTAL REALISASI</th>
							<th rowspan="2" class="text-center">SALDO</th>
						</tr>
						<tr>
							<td class="text-center">PANJAR</td>
							<td class="text-center">LS</td>
						</tr>
					</thead>
					<tbody>
						<?php while($rs=$sql->fetch_object()){ ?>
						<tr>
							<td><?php echo $rs->pptk; ?></td>
							<td><?php echo $rs->kegiatan; ?></td>
							<td align="right" nowrap="nowrap"><?php echo rpzx($rs->anggaran); ?></td>
							<td align="right" nowrap="nowrap"><?php echo rpzx($rs->panjar); ?></td>
							<td align="right" nowrap="nowrap"><?php echo rpzx($rs->ls); ?></td>
							<td align="right" nowrap="nowrap"><?php $realisasi=$rs->panjar+$rs->ls; echo rpzx($realisasi); ?></td>
							<td align="right" nowrap="nowrap"><?php $saldo=$rs->anggaran-$rs->panjar+$rs->ls; echo rpzx($saldo); ?></td>
						</tr>
						<?php
							$i++;
							$anggaran=$anggaran+$rs->anggaran;
							$totalpanjar=$totalpanjar+$rs->panjar;
							$totalls=$totalls+$rs->ls;
							$totalrealisasi=$totalrealisasi+$realisasi;
							$totalsaldo=$totalsaldo+$saldo;
							}
						?>
						<tr>
							<td></td>
							<td align="right">TOTAL ANGGARAN</td>
							<td align="right" nowrap="nowrap"><?php echo rpzx($anggaran); ?></td>
							<td align="right" nowrap="nowrap"><?php echo rpzx($totalpanjar); ?></td>
							<td align="right" nowrap="nowrap"><?php echo rpzx($totalls); ?></td>
							<td align="right" nowrap="nowrap"><?php echo rpzx($totalrealisasi); ?></td>
							<td align="right" nowrap="nowrap"><?php echo rpzx($totalsaldo); ?></td>
						</tr>
					</tbody>
			</table>
			</br>
	 </div>
</div>
<?php include("../../../close.php"); ?>