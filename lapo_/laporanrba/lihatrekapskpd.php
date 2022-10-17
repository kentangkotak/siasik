<?php include("../../conn.php"); ?>
<?php
	$sql=$conn->query("SELECT pendamap7950.kode79 as kode79,pendamap7950.uraian79 as uraian79,sum(anggaran_pendapatan.nilai) as anggaran
								FROM pendamap7950
								LEFT JOIN anggaran_pendapatan
								ON pendamap7950.kode79 = anggaran_pendapatan.kode79 
								and anggaran_pendapatan.tahun='".$_SESSION["anggaran_tahun"]."'");

?>
<a href="javascript:void(0)" onclick="ExportToExcel_laporanRekapPengusulan()"><img src="images/excel.jpg" width="20" height="20">Export to Excel</a>
<div id="excel_repot_laporanRekapPengusulan">
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>RENCANA BISNIS DAN ANGGARAN PENDAPATAN
TAHUN ANGGARAN  <?php echo  $_SESSION["anggaran_tahun"];?></h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
			<table class="table table-hover table table-striped"> 
					<thead>
						<tr>
							<th nowrap="nowrap">KODE</th>
							<th nowrap="nowrap">URAIAN</th>
							<th nowrap="nowrap">TOTAL</th>
						</tr>
					</thead>
					<tbody>
						<?php while($rs=$sql->fetch_object()){ 
			?>
						<tr>
							<td><?php echo $rs->kode79; ?></td>
							<td><?php echo $rs->uraian79; ?></td>
							<td><?php echo rp($rs->anggaran); ?></td>
						</tr>
						
							<?php
							$sqlx=$conn->query("SELECT * from pendamap7950 where level3='' and level2<>'' and level1=4");
							?>
							<?php while($rsx=$sqlx->fetch_object()){ 
								$sqlxx=$conn->query("
								SELECT pendamap7950.kode79 as kode79,pendamap7950.uraian79 as uraian79,sum(anggaran_pendapatan.nilai) as anggaran 
								from pendamap7950,anggaran_pendapatan 
								where pendamap7950.kode79 = anggaran_pendapatan.kode79 and anggaran_pendapatan.tahun='".$_SESSION["anggaran_tahun"]."'
								and concat(pendamap7950.level1,'.',pendamap7950.level2)='".$rsx->kode79."'");
								$rsxx=$sqlxx->fetch_object();
							?>
							<tr>
								<td><?php echo $rsx->kode79; ?></td>
								<td><?php echo $rsx->uraian79; ?></td>
								<td align="right"><?php echo rp($rsxx->anggaran); ?></td>
							</tr>
							<?php
							$sqlxx=$conn->query("SELECT pendamap7950.kode79 as kode79,pendamap7950.uraian79 as uraian79,sum(anggaran_pendapatan.nilai) as anggaran
								FROM pendamap7950
								LEFT JOIN anggaran_pendapatan
								ON pendamap7950.kode79 = anggaran_pendapatan.kode79 where pendamap7950.kelompok='".$rsx->kode79."' 
								and anggaran_pendapatan.tahun='".$_SESSION["anggaran_tahun"]."' group by pendamap7950.kode79");
							?>
							<?php while($rsxx=$sqlxx->fetch_object()){ ?>
							<tr>
								<td><?php echo $rsxx->kode79; ?></td>
								<td><?php echo $rsxx->uraian79; ?></td>
								<td align="right"><?php echo rp($rsxx->anggaran); ?></td>
							</tr>
							<?php
								$i++;
								}
							?>
							<?php
								$i++;
								}
							?>
						<?php
							$i++;
							}
						?>
					</tbody>
			</table>
	 </div>
</div>
</div>
<?php include("../../close.php"); ?>