<?php include("../../../conn.php"); ?>
<?php
	$sql1=$conn->query("select * from profil" );
	$rs1=$sql1->fetch_object();
?>
<!--<a href="javascript:void(0)" onclick="ExportToExcel_rbabelanja()"><img src="images/excel.jpg" width="20" height="20">Export to Excel</a>
<div id="excel_repot_rbabelanja">-->
<?php
		$sql=$conn->query("select concat_ws('.',maping5099.akunx,maping5099.kelompokx,maping5099.jenisx,maping5099.objectx,maping5099.rincianobjectx,maping5099.subrincianx) as kode99,
							maping5099.uraianakun99 as uraian,kode,round(sum(anggaran),2) as anggaran,round(sum(realisasi),2) as realisasi
							from(										
								select npdls_rinci.koderek50 as kode,'' as anggaran,sum(npdls_rinci.nominalpembayaran) as realisasi
								from npkls_rinci,npkls_heder,npdls_rinci
								where npkls_heder.nopencairan=npkls_rinci.nopencairan and npdls_rinci.nonpdls=npkls_rinci.nonpdls 
								and year(npkls_heder.tglpencairan) ='".$_GET['tahun']."' 
								group by npdls_rinci.koderek50
								union all
								select spjpanjar_rinci.koderek50 as kode,'' as anggaran,sum(spjpanjar_rinci.jumlahbelanjapanjar) as realisasi
								from spjpanjar_rinci,spjpanjar_heder
								where spjpanjar_rinci.nospjpanjar=spjpanjar_heder.nospjpanjar and spjpanjar_heder.verif=1
								and year(spjpanjar_heder.tglspjpanjar) ='".$_GET['tahun']."'
								group by spjpanjar_rinci.koderek50
								union all
								select t_tampung.koderek50 as kode,sum(t_tampung.pagu) as anggaran,'' as realisasi 
								from penyesesuaianperioritas_heder,t_tampung
								where penyesesuaianperioritas_heder.notrans=t_tampung.notrans 
								and year(penyesesuaianperioritas_heder.tgltrans)='".$_GET['tahun']."'
								group by t_tampung.koderek50) as xxx,maping5099 where kode=concat_ws('.',maping5099.akun,maping5099.kelompok,maping5099.jenis,maping5099.object,maping5099.rincianobject,maping5099.subrincian)
							group by (kode99)");
	
?>
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <center>BADAN LAYANAN UMUM DAERAH <?php echo  $rs1->nama;?></br>
				LAPORAN MANAJERIAL ANGGARAN PERKEGIATAN </br>
				TAHUN <?php echo $_GET['tahun'];?> </center>
        <div class="clearfix"></div>
      </div>
        <div class="x_content">
			<table class="table table-bordered table-striped jambo_table bulk_action dt-head-center" id="datatable-buttons"> 
					<thead>
						<tr>
							<th>KODE</th>
							<th>URAIAN</th>
							<th>ANGGARAN</th>
							<th>REALISASI</th>
						</tr>
					</thead>
					<tbody>
						<?php while($rs=$sql->fetch_object()){ ?>
						<tr>
							<td><?php echo $rs->kode99; ?></td>
							<td><?php echo $rs->uraian; ?></td>
							<td align="right"><?php echo rpzx($rs->anggaran); ?></td>
							<td align="right"><?php echo rpzx($rs->realisasi); ?></td>
						</tr>
						<?php
							$i++;
							$anggaran=$anggaran+$rs->anggaran;
							$realisasi=$realisasi+$rs->realisasi;
							}
						?>
						<tr>
							<td colspan="2" align="right">SUBTOTAL</td>
							<td align="right"><?php echo rpzx($anggaran); ?></td>
							<td align="right"><?php echo rpzx($realisasi); ?></td>
						</tr>
					</tbody>
			</table>
			</br>
	 </div>
</div>
<?php include("../../../close.php"); ?>