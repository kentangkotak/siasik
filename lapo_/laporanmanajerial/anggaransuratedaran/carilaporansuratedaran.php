<?php include("../../../conn.php"); ?>
<?php
	$sql1=$conn->query("select * from profil" );
	$rs1=$sql1->fetch_object();
?>
<!--<a href="javascript:void(0)" onclick="ExportToExcel_rbabelanja()"><img src="images/excel.jpg" width="20" height="20">Export to Excel</a>
<div id="excel_repot_rbabelanja">-->
<?php
		$sql=$conn->query("select concat_ws('.',maping5099.akunx,maping5099.kelompokx,maping5099.jenisx,maping5099.objectx,maping5099.rincianobjectx,maping5099.subrincianx) as kode99,
							maping5099.uraianakun99 as uraian,
							concat_ws('.',maping5099.akun,maping5099.kelompok,maping5099.jenis,maping5099.object,maping5099.rincianobject,maping5099.subrincian) as kode50,
							t_tampung.koderek50 as koderek50,sum(t_tampung.pagu) as total
							from maping5099,t_tampung,penyesesuaianperioritas_heder
							where t_tampung.koderek50=concat_ws('.',maping5099.akun,maping5099.kelompok,maping5099.jenis,maping5099.object,maping5099.rincianobject,maping5099.subrincian) and penyesesuaianperioritas_heder.notrans=t_tampung.notrans 
							and year(penyesesuaianperioritas_heder.tgltrans)='".$_GET["tahun"]."'
							group by concat_ws('.',maping5099.akunx,maping5099.kelompokx,
							maping5099.jenisx,maping5099.objectx,
							maping5099.rincianobjectx,maping5099.subrincianx)");
	
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
						</tr>
					</thead>
					<tbody>
						<?php while($rs=$sql->fetch_object()){ ?>
						<tr>
							<td><?php echo $rs->kode99; ?></td>
							<td><?php echo $rs->uraian; ?></td>
							<td align="right"><?php echo rpzx($rs->total); ?></td>
						</tr>
						<?php
							$i++;$total=$total+$rs->total;
							}
						?>
						<tr>
							<td></td>
							<td align="right">TOTAL ANGGARAN</td>
							<td align="right"><?php echo rpzx($total); ?></td>
						</tr>
					</tbody>
			</table>
			</br>
	 </div>
</div>
<?php include("../../../close.php"); ?>