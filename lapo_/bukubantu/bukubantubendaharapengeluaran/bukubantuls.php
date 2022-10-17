<?php include("../../../conn.php"); ?>
<?php
	$sql1=$conn->query("select * from profil" );
	$rs1=$sql1->fetch_object();
?>
<!--<a href="javascript:void(0)" onclick="ExportToExcel_rbabelanja()"><img src="images/excel.jpg" width="20" height="20">Export to Excel</a>
<div id="excel_repot_rbabelanja">-->
<?php
	$tgl=in_tanggal("/",trim($_GET['tgl']));
	$tglx=in_tanggal("/",trim($_GET['tglx']));
	
	$sql=$conn->query("select notrans,tanggal,kode50,keterangan,awal,sum(masuk) as masukx,sum(keluar) as keluarx,urut from(
		   select npkls_heder.nopencairan as notrans,npkls_heder.tglpindahbuku as tanggal,npdls_rinci.koderek50 as kode50,
		   npdls_rinci.rincianbelanja as keterangan,'' as awal,npkls_rinci.total as masuk,
		   '' as keluar,1 as urut
		   from npkls_heder,npkls_rinci,npdls_rinci
		   where npkls_heder.nopencairan=npkls_rinci.nopencairan and npdls_rinci.nonpdls=npkls_rinci.nonpdls 
           and date(npkls_heder.tglpindahbuku)>='".$tgl."' and date(npkls_heder.tglpindahbuku)<='".$tglx."'  and npkls_heder.nopencairan<>''
		   group by npkls_heder.nonpk,npdls_rinci.nonpdls
		   union all
		   select npkls_heder.nopencairan as notrans,npkls_heder.tglpindahbuku as tanggal,npdls_rinci.koderek50 as kode50,
		   npdls_rinci.rincianbelanja as keterangan,'' as awal,'' as masuk,
		   npkls_rinci.total as keluar,2 as urut
		   from npkls_heder,npkls_rinci,npdls_rinci
		   where npkls_heder.nopencairan=npkls_rinci.nopencairan and npdls_rinci.nonpdls=npkls_rinci.nonpdls 
           and date(npkls_heder.tglpindahbuku)>='".$tgl."' and date(npkls_heder.tglpindahbuku)<='".$tglx."'  and npkls_heder.nopencairan<>''
		   group by npkls_heder.nonpk,npdls_rinci.nonpdls
	) as wew group by notrans,keterangan order by tanggal,urut");
	$i=1;
?>
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <center>BADAN LAYANAN UMUM DAERAH <?php echo  $rs1->nama;?></br>
				LAPORAN BUKU BANTU LS BENDAHARA PENGELUARAN </br>
				UNTUK PERIODE <?php echo $tgl;?> SAMPAI PERIODE <?php echo  $tglx;?> </center>
        <div class="clearfix"></div>
      </div>
        <div class="x_content">
			<table class="table table-bordered table-striped jambo_table bulk_action dt-head-center" id="datatable-buttons"> 
					<thead>
						<tr>
							<th>No.</th>
							<th>TANGGAL</th>
							<th>NO. TRANSAKSI</th>
							<th>KODE REKENING 50</th>
							<th>URAIAN</th>
							<th>PENERIMAAN</th>
							<th>PENGELUARAN</th>
							<th>SALDO SISA</th>
						</tr>
					</thead>
					<tbody>
						<?php while($rs=$sql->fetch_object()){ ?>
						<tr>
							<td align="center"><?php echo $i; ?></td>
							<td><?php echo $rs->tanggal; ?></td>
							<td><?php echo $rs->notrans; ?></td>
							<td><?php echo $rs->kode50; ?></td>
							<td><?php if($rs->keterangan == ''){ echo '';}else{ echo $rs->keterangan;} ?></td>
							<td><?php if($rs->masukx == 0){ echo '';}else{ echo rp($rs->masukx);} ?></td>
							<td><?php if($rs->keluarx == 0){ echo '';}else{ echo rp($rs->keluarx);} ?></td>
							<td align="right"><?php $sisa=$sisa+$rs->awal+$rs->masukx-$rs->keluarx; echo rp($sisa);?></td>
						</tr>
						<?php
							$i++;
							}
						?>
					</tbody>
			</table>
			</br>
	 </div>
</div>
</div>
<?php include("../../../close.php"); ?>