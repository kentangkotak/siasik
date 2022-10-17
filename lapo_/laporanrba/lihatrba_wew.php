<?php include("../../conn.php"); ?>
<?php
	$thn=$_GET['thn'];
	$sql=$conn->query("SELECT pendamap7950.kode79 as kode79,pendamap7950.uraian79 as uraian79,sum(anggaran_pendapatan.nilai) as anggaran
								FROM pendamap7950
								LEFT JOIN anggaran_pendapatan
								ON pendamap7950.kode79 = anggaran_pendapatan.kode79 
								and anggaran_pendapatan.tahun='".$thn."'");

?>
<!--<a href="javascript:void(0)" onclick="ExportToExcel_rbarekapitulasi()"><img src="images/excel.jpg" width="20" height="20">Export to Excel</a>
<div id="excel_repot_rekapitulasi">-->
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
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
								where pendamap7950.kode79 = anggaran_pendapatan.kode79 and concat(pendamap7950.level1,'.',pendamap7950.level2)='".$rsx->kode79."'
								and anggaran_pendapatan.tahun='".$thn."'");
								$rsxx=$sqlxx->fetch_object();
							?>
							<tr>
								<td><?php echo $rsx->kode79; ?></td>
								<td><?php echo $rsx->uraian79; ?></td>
								<td><?php echo rp($rsxx->anggaran); ?></td>
							</tr>
							<?php
							$sqlxx=$conn->query("SELECT pendamap7950.kode79 as kode79,pendamap7950.uraian79 as uraian79,sum(anggaran_pendapatan.nilai) as anggaran
								FROM pendamap7950
								LEFT JOIN anggaran_pendapatan
								ON pendamap7950.kode79 = anggaran_pendapatan.kode79 where pendamap7950.kelompok='".$rsx->kode79."' 
								and anggaran_pendapatan.tahun='".$thn."'
								group by pendamap7950.kode79");
							?>
							<?php while($rsxx=$sqlxx->fetch_object()){ ?>
							<tr>
								<td><?php echo $rsxx->kode79; ?></td>
								<td><?php echo $rsxx->uraian79; ?></td>
								<td><?php echo rp($rsxx->anggaran); ?></td>
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
						<?php
							$sql1=$conn->query("SELECT '5' as kode79,'Belanja' as uraian79,sum(penyesesuaianperioritas_rinci.nilai) as anggaran
												FROM pendamap7950x,penyesesuaianperioritas_rinci,penyesesuaianperioritas_heder
												where penyesesuaianperioritas_rinci.notrans=penyesesuaianperioritas_heder.notrans and 
												penyesesuaianperioritas_rinci.koderek50=pendamap7950x.kode50 
												and year(penyesesuaianperioritas_heder.tgltrans)='".$thn."'" );

						?>
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
								and concat(pendamap7950x.level1,'.',pendamap7950x.level2)='".$rs2->kode79."' and year(penyesesuaianperioritas_heder.tgltrans)='".$thn."'");
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
							pendamap7950x.kelompok='".$rs2->kode79."' and year(penyesesuaianperioritas_heder.tgltrans)='".$thn."'
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
	 </div>
</div>
</div>
<?php include("../../close.php"); ?>