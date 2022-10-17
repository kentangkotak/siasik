<?php include("../../conn.php"); ?>
<?php
	$sql1=$conn->query("SELECT '5' as kode79,'Belanja' as uraian79,sum(penyesesuaianperioritas_rinci.nilai) as anggaran
						FROM pendamap7950x,penyesesuaianperioritas_rinci,penyesesuaianperioritas_heder
						where penyesesuaianperioritas_rinci.notrans=penyesesuaianperioritas_heder.notrans and 
						penyesesuaianperioritas_rinci.koderek50=pendamap7950x.kode50 
						and year(penyesesuaianperioritas_heder.tgltrans)='".$_SESSION["anggaran_tahun"]."'" );

?>
<a href="javascript:void(0)" onclick="ExportToExcel_rbabelanja()"><img src="images/excel.jpg" width="20" height="20">Export to Excel</a>
<div id="excel_repot_rbabelanja">
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>RENCANA BISNIS DAN ANGGARAN BELANJA
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
						<?php while($rs1=$sql1->fetch_object()){ ?>
						<tr>
							<td><?php echo $rs1->kode79; ?></td>
							<td><?php echo $rs1->uraian79; ?></td>
							<td><?php echo rp($rs1->anggaran); ?></td>
						</tr>
						<?php
							$sql2=$conn->query("SELECT * from pendamap7950x where level3='' and level4='' and level5='' and level2<>'' and level6='' and kode79<>''");
							?>
							<?php while($rs2=$sql2->fetch_object()){ 
								$sql2x=$conn->query("
								SELECT pendamap7950x.kode79 as kode79,pendamap7950x.uraian79 as uraian79,sum(penyesesuaianperioritas_rinci.nilai) as anggaran 
								from pendamap7950x,penyesesuaianperioritas_rinci,penyesesuaianperioritas_heder
								where pendamap7950x.kode50 = penyesesuaianperioritas_rinci.koderek50 and penyesesuaianperioritas_rinci.notrans=penyesesuaianperioritas_heder.notrans
								and concat(pendamap7950x.level1,'.',pendamap7950x.level2)='".$rs2->kode79."' and year(penyesesuaianperioritas_heder.tgltrans)='".$_SESSION["anggaran_tahun"]."'");
								$rs2x=$sql2x->fetch_object();
							?>
							<tr>
								<td><?php echo $rs2->kode79; ?></td>
								<td><?php echo $rs2->uraian79; ?></td>
								<td><?php echo rp($rs2x->anggaran); ?></td>
							</tr>
							<?php
							$sql3=$conn->query("
							SELECT pendamap7950x.kode79 as kode79,pendamap7950x.uraian79 as uraian79,sum(penyesesuaianperioritas_rinci.nilai) as anggaran 
							from pendamap7950x,penyesesuaianperioritas_rinci,penyesesuaianperioritas_heder
							where pendamap7950x.kode50 = penyesesuaianperioritas_rinci.koderek50 and penyesesuaianperioritas_rinci.notrans=penyesesuaianperioritas_heder.notrans
							and
							pendamap7950x.kelompok='".$rs2->kode79."' and year(penyesesuaianperioritas_heder.tgltrans)='".$_SESSION["anggaran_tahun"]."'
							group by pendamap7950x.kode79;");
							?>
							<?php while($rs3=$sql3->fetch_object()){ ?>
							<tr>
								<td><?php echo $rs3->kode79; ?></td>
								<td><?php echo $rs3->uraian79; ?></td>
								<td><?php echo rp($rs3->anggaran); ?></td>
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
			</br>
	 </div>
</div>
</div>
<?php include("../../close.php"); ?>