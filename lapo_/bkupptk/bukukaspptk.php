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
	
	// if($_GET['kodepptk'] == ''){
			$sql=$conn->query("select notrans,tanggal,namapptk,keterangan,awal,sum(masuk) as masukx,sum(keluar) as keluarx,urut from(
			   select '' as notrans,saldoBankBk.tglOpname as tanggal,'' as namapptk,'SALDO AWAL' as keterangan,saldoBankBk.nominal as awal,'' as masuk,'' as keluar,1 as urut 
			   from saldoBankBk
			   where date(saldoBankBk.tglOpname)>='".$tgl."' and date(saldoBankBk.tglOpname)<='".$tglx."'
			   union all
			   select notapanjar_rinci.nonotapanjar as notrans,notapanjar_heder.tglnotapanjar as tanggal,notapanjar_heder.pptk as namapptk,notapanjar_rinci.rincianbelanja50 as keterangan,'' as awal,
			   notapanjar_rinci.total as masuk,'' as keluar,2 as urut
			   from notapanjar_rinci,notapanjar_heder where notapanjar_rinci.nonotapanjar=notapanjar_heder.nonotapanjar and
			   date(notapanjar_heder.tglnotapanjar)>='".$tgl."' and date(notapanjar_heder.tglnotapanjar)<='".$tglx."'
			   union all
			   select pengembaliansisapanjar_heder.nopengembaliansisapanjar as notrans,pengembaliansisapanjar_heder.tglpengembaliansisapanjar as tanggal,
			   pengembaliansisapanjar_heder.pptk as namapptk,
			   pengembaliansisapanjar_rinci.rincianbelanja50 as keterangan,'' as awal,'' as masuk,pengembaliansisapanjar_rinci.sisapanjar as keluar,2 as urut
			   from pengembaliansisapanjar_heder,pengembaliansisapanjar_rinci
			   where pengembaliansisapanjar_heder.nopengembaliansisapanjar=pengembaliansisapanjar_rinci.nopengembaliansisapanjar and
			   date(pengembaliansisapanjar_heder.tglpengembaliansisapanjar)>='".$tgl."' and date(pengembaliansisapanjar_heder.tglpengembaliansisapanjar)<='".$tglx."'
			   union all
			   select pengembalianpanjar_heder.nopengembalianpanjar as notrans,pengembalianpanjar_heder.tglpengembalianpanjar as tanggal,
			   pengembalianpanjar_heder.pptk as namapptk,
			   pengembalianpanjar_rinci.rincianbelanja50 as keterangan,
			   '' as awal,'' as masuk,pengembalianpanjar_rinci.jumlahpenerimaanpanjar as keluar,3 as urut
			   from pengembalianpanjar_heder,pengembalianpanjar_rinci
			   where pengembalianpanjar_heder.nopengembalianpanjar=pengembalianpanjar_rinci.nopengembalianpanjar and date(pengembalianpanjar_heder.tglpengembalianpanjar)>='".$tgl."' 
			   and date(pengembalianpanjar_heder.tglpengembalianpanjar)<='".$tglx."'
			) as wew group by notrans,keterangan order by tanggal,urut");
	// }else{
			// $sql=$conn->query("select notrans,tanggal,keterangan,awal,sum(masuk) as masukx,sum(keluar) as keluarx,urut from(
			   // select '' as notrans,saldoBankBk.tglOpname as tanggal,'SALDO AWAL' as keterangan,saldoBankBk.nominal as awal,'' as masuk,'' as keluar,1 as urut 
			   // from saldoBankBk
			   // where date(saldoBankBk.tglOpname)>='".$tgl."' and date(saldoBankBk.tglOpname)<='".$tglx."'
			   // union all
			   // select notapanjar_rinci.nonotapanjar as notrans,notapanjar_heder.tglnotapanjar as tanggal,notapanjar_rinci.rincianbelanja50 as keterangan,'' as awal,
			   // notapanjar_rinci.total as masuk,'' as keluar,2 as urut
			   // from notapanjar_rinci,notapanjar_heder where notapanjar_rinci.nonotapanjar=notapanjar_heder.nonotapanjar and
			   // date(notapanjar_heder.tglnotapanjar)>='".$tgl."' and date(notapanjar_heder.tglnotapanjar)<='".$tglx."'
			   // and notapanjar_heder.kodepptk='".$_GET['kodepptk']."'
			   // union all
			   // select pengembaliansisapanjar_heder.nopengembaliansisapanjar as notrans,pengembaliansisapanjar_heder.tglpengembaliansisapanjar as tanggal,
			   // pengembaliansisapanjar_rinci.rincianbelanja50 as keterangan,'' as awal,'' as masuk,pengembaliansisapanjar_rinci.sisapanjar as keluar,2 as urut
			   // from pengembaliansisapanjar_heder,pengembaliansisapanjar_rinci
			   // where pengembaliansisapanjar_heder.nopengembaliansisapanjar=pengembaliansisapanjar_rinci.nopengembaliansisapanjar and
			   // date(pengembaliansisapanjar_heder.tglpengembaliansisapanjar)>='".$tgl."' and date(pengembaliansisapanjar_heder.tglpengembaliansisapanjar)<='".$tglx."'
			   // and pengembaliansisapanjar_heder.kodepptk='".$_GET['kodepptk']."'
			   // union all
			   // select pengembalianpanjar_heder.nopengembalianpanjar as notrans,pengembalianpanjar_heder.tglpengembalianpanjar as tanggal,pengembalianpanjar_rinci.rincianbelanja50 as keterangan,
			   // '' as awal,'' as masuk,pengembalianpanjar_rinci.jumlahpenerimaanpanjar as keluar,3 as urut
			   // from pengembalianpanjar_heder,pengembalianpanjar_rinci
			   // where pengembalianpanjar_heder.nopengembalianpanjar=pengembalianpanjar_rinci.nopengembalianpanjar and date(pengembalianpanjar_heder.tglpengembalianpanjar)>='".$tgl."' 
			   // and date(pengembalianpanjar_heder.tglpengembalianpanjar)<='".$tglx."'
			   // and pengembalianpanjar_heder.kodepptk='".$_GET['kodepptk']."'
			// ) as wew group by notrans,keterangan order by tanggal,urut");
	// }
	$i=1;
?>
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <center>BADAN LAYANAN UMUM DAERAH <?php echo  $rs1->nama;?></br>
				LAPORAN BUKU KAS UMUM BENDAHARA PENGELUARAN </br>
				UNTUK BULAN <?php echo bulan($bln);?> TAHUN <?php echo  $thn;?> </center>
        <div class="clearfix"></div>
      </div>
        <div class="x_content">
			<table class="table table-bordered table-striped jambo_table bulk_action dt-head-center" id="datatable-buttons"> 
					<thead>
						<tr>
							<th>No.</th>
							<th>TANGGAL</th>
							<th>NOTRANS</th>
							<th>PPTK</th>
							<th>URAIAN</th>
							<th>SALDO AWAL</th>
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
							<td><?php echo $rs->namapptk; ?></td>
							<td><?php if($rs->keterangan == ''){ echo '';}else{ echo $rs->keterangan;} ?></td>
							<td><?php if($rs->awal == 0){ echo '';}else{ echo rp($rs->awal);} ?></td>
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