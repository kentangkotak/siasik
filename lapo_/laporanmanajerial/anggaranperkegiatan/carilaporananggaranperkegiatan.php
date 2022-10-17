<?php include("../../../conn.php"); ?>
<?php
	$sql1=$conn->query("select * from profil" );
	$rs1=$sql1->fetch_object();
?>
<!--<a href="javascript:void(0)" onclick="ExportToExcel_rbabelanja()"><img src="images/excel.jpg" width="20" height="20">Export to Excel</a>
<div id="excel_repot_rbabelanja">-->
<?php
	if($_GET['kodebidang'] == '' && $_GET['kodepptk'] == ''){
		$sql=$conn->query("select * from mappingpptkkegiatan where tahun='".$_SESSION["anggaran_tahun"]."' group by kodepptk");
	}else if($_GET['kodepptk'] == ''){ 
		$sql=$conn->query("select * from mappingpptkkegiatan where tahun='".$_SESSION["anggaran_tahun"]."' and kodebidang='".$_GET['kodebidang']."' group by kodepptk");
	}else{
		$sql=$conn->query("select * from mappingpptkkegiatan where tahun='".$_SESSION["anggaran_tahun"]."' and kodebidang='".$_GET['kodebidang']."' and kodepptk='".$_GET['kodepptk']."' group by kodepptk");
	}
?>
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <center>BADAN LAYANAN UMUM DAERAH <?php echo  $rs1->nama;?></br>
				LAPORAN MANAJERIAL ANGGARAN PERKEGIATAN </br>
				TAHUN <?php echo $_SESSION["anggaran_tahun"];?> </center>
        <div class="clearfix"></div>
      </div>
        <div class="x_content">
			<table class="table table-bordered table-striped jambo_table bulk_action dt-head-center" id="datatable-buttons"> 
					<thead>
						<tr>
							<th>BAGIAN</th>
							<th>PPTK</th>
							<th>KEGIATAN</th>
							<th>PAGU ANGGARAN`</th>
						</tr>
					</thead>
					<tbody>
						<?php while($rs=$sql->fetch_object()){ ?>
						<tr>
							<td><?php echo $rs->bidang; ?></td>
							<td><?php echo $rs->namapptk; ?></td>
						</tr>
						<?php
							$sqlx=$conn->query("select penyesesuaianperioritas_heder.kegiatan as kegiatan,penyesesuaianperioritas_heder.pptk as pptk,t_tampung_pagu.pagu as pagu,penyesesuaianperioritas_heder.kodepptk
													from penyesesuaianperioritas_heder,t_tampung_pagu
													where penyesesuaianperioritas_heder.kodekegiatan=t_tampung_pagu.kodekegiatanblud and t_tampung_pagu.tahun='".$_SESSION["anggaran_tahun"]."' and 
													penyesesuaianperioritas_heder.kodepptk='".$rs->kodepptk."'");
							$total=0;
						?>
						<?php while($rsx=$sqlx->fetch_object()){ ?>
						<tr>
							<td></td>
							<td></td>
							<td><?php echo $rsx->kegiatan; ?></td>
							<td align="right"><?php echo rpzx($rsx->pagu); ?></td>
						</tr>
						<?php
							$i++;
							$total=$total+$rsx->pagu;
							}
						?>
							<tr>
								<td></td>
								<td></td>
								<td align="right">TOTAL</td>
								<td align="right"><?php echo rpzx($total); ?></td>
							</tr>
						<?php
							$i++;
							$totalall=$totalall+$total;
							}
						?>
							<tr>
								<td></td>
								<td></td>
								<td align="right">TOTAL SEMUA ANGGARAN</td>
								<td align="right"><?php echo rpzx($totalall); ?></td>
							</tr>
					</tbody>
			</table>
			</br>
	 </div>
</div>
<?php include("../../../close.php"); ?>