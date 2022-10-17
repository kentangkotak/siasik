<?php include("../../conn.php"); ?>
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
		   select '' as notrans,saldoBankBk.tglOpname as tanggal,'' as kode50,'SALDO AWAL' as keterangan,saldoBankBk.nominal as awal,'' as masuk,'' as keluar,1 as urut 
		   from saldoBankBk
		   where date(saldoBankBk.tglOpname)>='".$tgl."' and date(saldoBankBk.tglOpname)<='".$tglx."'
		   UNION all
		   select idTrans as notrans,date(tglTrans) as tanggal,'' as kode50,ket as keterangan,'' as awal,nilai as masuk,'' as keluar,2 as urut 
		   from keu_trans_bk
		   where date(tglTrans)>='".$tgl."' and date(tglTrans)<='".$tglx."' and batal is null
		   union all
		   select spjpanjar_rinci.nospjpanjar as notrans,date(spjpanjar_heder.tglspjpanjar) as tanggal,spjpanjar_rinci.koderek50 as kode50,spjpanjar_rinci.rincianbelanja50 as keterangan
		   ,'' as awal,spjpanjar_rinci.jumlahbelanjapanjar as masuk,
		   '' as keluar,2 as urut
		   from spjpanjar_rinci,spjpanjar_heder where spjpanjar_heder.nospjpanjar=spjpanjar_rinci.nospjpanjar and 
		   date(spjpanjar_heder.tglspjpanjar)>='".$tgl."' and date(spjpanjar_heder.tglspjpanjar)<='".$tglx."'
		   union all
		   select spjpanjar_rinci.nospjpanjar as notrans,date(spjpanjar_heder.tglspjpanjar) as tanggal,spjpanjar_rinci.koderek50 as kode50,spjpanjar_rinci.rincianbelanja50 as keterangan
		   ,'' as awal,'' as masuk,
		   spjpanjar_rinci.jumlahbelanjapanjar as keluar,3 as urut
		   from spjpanjar_rinci,spjpanjar_heder where spjpanjar_heder.nospjpanjar=spjpanjar_rinci.nospjpanjar and 
		   date(spjpanjar_heder.tglspjpanjar)>='".$tgl."' and date(spjpanjar_heder.tglspjpanjar)<='".$tglx."'
		   union all
		   select pengembaliansisapanjar_heder.nopengembaliansisapanjar as notrans,pengembaliansisapanjar_heder.tglpengembaliansisapanjar as tanggal,
		   pengembaliansisapanjar_rinci.koderek50 as kode50,
		   pengembaliansisapanjar_rinci.rincianbelanja50 as keterangan,'' as awal,pengembaliansisapanjar_rinci.sisapanjar as masuk,'' as keluar,2 as urut
		   from pengembaliansisapanjar_heder,pengembaliansisapanjar_rinci
		   where pengembaliansisapanjar_heder.nopengembaliansisapanjar=pengembaliansisapanjar_rinci.nopengembaliansisapanjar and
		   date(pengembaliansisapanjar_heder.tglpengembaliansisapanjar)>='".$tgl."' and date(pengembaliansisapanjar_heder.tglpengembaliansisapanjar)<='".$tglx."'
		   union all
		   select noSpm as notrans,date(tglSpm) as tanggal,'' as kode50,uraian as keterangan,'' as awal,jumlahspp as masuk,'' as keluar,2 as urut 
		   from transSpm 
		   where date(tglSpm)>='".$tgl."' and date(tglSpm)<='".$tglx."'
		   union all
		   select notapanjar_rinci.nonotapanjar as notrans,date(notapanjar_heder.tglnotapanjar) as tanggal,notapanjar_rinci.koderek50 as kode50,
		   notapanjar_rinci.rincianbelanja50 as keterangan,'' as awal,
		   '' as masuk,notapanjar_rinci.total as keluar,3 as urut
		   from notapanjar_rinci,notapanjar_heder where notapanjar_rinci.nonotapanjar=notapanjar_heder.nonotapanjar and
		   date(notapanjar_heder.tglnotapanjar)>='".$tgl."' and date(notapanjar_heder.tglnotapanjar)<='".$tglx."'
		   union all
		   select npkls_heder.nopencairan as notrans,date(npkls_heder.tglpencairan) as tanggal,npdls_rinci.koderek50 as kode50,
		   npdls_rinci.rincianbelanja as keterangan,'' as awal,'' as masuk,
		   npkls_rinci.total as keluar,3 as urut
		   from npkls_heder,npkls_rinci,npdls_rinci
		   where npkls_heder.nopencairan=npkls_rinci.nopencairan and npdls_rinci.nonpdls=npkls_rinci.nonpdls 
           and date(npkls_heder.tglpencairan)>='".$tgl."' and date(npkls_heder.tglpencairan)<='".$tglx."'
		   group by npkls_heder.nonpk,npdls_rinci.nonpdls
		   union all
		   select npkls_heder.nonpk as notrans,date(npkls_heder.tglnpk) as tanggal,npdls_rinci.koderek50 as kode50,npdls_rinci.rincianbelanja as keterangan,'' as awal,
		   npkls_rinci.total as masuk,
		   '' as keluar,1 as urut
		   from npkls_heder,npkls_rinci,npdls_rinci
		   where npkls_heder.nopencairan=npkls_rinci.nopencairan and npdls_rinci.nonpdls=npkls_rinci.nonpdls 
           and date(npkls_heder.tglnpk)>='".$tgl."' and date(npkls_heder.tglnpk)<='".$tglx."'
		   group by npkls_heder.nonpk,npdls_rinci.nonpdls
		   union all
		   select sppgu_heder.nosppgu as notrans,date(sppgu_heder.tglsppgu) as tanggal,'' as kode50,sppgu_rinci.kegiatanblud as keterangan,
		   '' as awal,sppgu_rinci.nilai as masuk,'' as keluar,2 urut
		  from sppgu_heder,sppgu_rinci
		  where sppgu_heder.nosppgu=sppgu_rinci.nosppgu 
		  and date(sppgu_heder.tglsppgu)>='".$tgl."' and date(sppgu_heder.tglsppgu)<='".$tglx."'
		  group by sppgu_heder.nosppgu
		  union all		  
		 select pengembalianpanjar_heder.nopengembalianpanjar as notrans,date(pengembalianpanjar_heder.tglpengembalianpanjar) as tanggal,pengembalianpanjar_rinci.koderek50 as kode50,
		 pengembalianpanjar_rinci.rincianbelanja50 as keterangan,
		 '' as awal,pengembalianpanjar_rinci.jumlahpenerimaanpanjar as masuk,'' as keluar,2 as urut
		from pengembalianpanjar_heder,pengembalianpanjar_rinci
		where pengembalianpanjar_heder.nopengembalianpanjar=pengembalianpanjar_rinci.nopengembalianpanjar and date(pengembalianpanjar_heder.tglpengembalianpanjar)>='".$tgl."' 
		and date(pengembalianpanjar_heder.tglpengembalianpanjar)<='".$tglx."'
		union all
		select nocontrapost as notrans,date(tglcontrapost) as tanggal,contrapost.koderek50 as kode50,rincianbelanja as keterangan,'' as awal,nominalcontrapost as masuk,'' as keluar,2 as urut
		from  contrapost
		where date(tglcontrapost)>='".$tgl."' and date(tglcontrapost)<='".$tglx."'
	) as wew group by notrans,keterangan order by tanggal,urut");
	$i=1;
?>
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <center>BADAN LAYANAN UMUM DAERAH <?php echo  $rs1->nama;?></br>
				LAPORAN BUKU KAS UMUM BENDAHARA PENGELUARAN </br>
				UNTUK PERIODE <?php echo $tgl;?> SAMPAI PERIODE <?php echo $tglx;?> </center>
        <div class="clearfix"></div>
      </div>
        <div class="x_content">
			<table class="table table-bordered table-striped jambo_table bulk_action dt-head-center" id="datatable-buttons"> 
					<thead>
						<tr>
							<th>No.</th>
							<th>TANGGAL</th>
							<th>NO TRANSAKSI</th>
							<th>KODE 50</th>
							<th>URAIAN 50</th>
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
							<td><?php echo $rs->kode50;;?></td>
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
<?php include("../../close.php"); ?>