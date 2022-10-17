<?php include("../../conn.php"); ?>
<?php
	
		$sql=$conn->query("SELECT bidang,pptk,kegiatan,usulan,volume,harga,total from(
							select penyesesuaianperioritas_heder.namabidang as bidang,penyesesuaianperioritas_heder.pptk as pptk,penyesesuaianperioritas_heder.kegiatan as kegiatan,
							penyesesuaianperioritas_rinci.usulan as usulan,penyesesuaianperioritas_rinci.volume as volume,penyesesuaianperioritas_rinci.harga as harga,
							sum(penyesesuaianperioritas_rinci.nilai) as total
							from penyesesuaianperioritas_heder,penyesesuaianperioritas_rinci
							where penyesesuaianperioritas_heder.notrans=penyesesuaianperioritas_rinci.notrans 
							and year(penyesesuaianperioritas_heder.tgltrans)='".$_GET['thn']."' group by bidang) as wew ");

	$i=1;

?>
<a href="javascript:void(0)" onclick="ExportToExcel_laporanRekapPenyesuaianperioritasall()"><img src="images/excel.jpg" width="20" height="20">Export to Excel</a>
<div id="excel_repot_laporanRekapPenyesuaianperioritasall">
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>LAPORAN REKAP PENYESUAIAN PERIORITAS TAHUN <?php echo  $_GET['thn'];?></h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
			<table class="table table-hover table table-striped"> 
					<thead>
						<tr>
							<th nowrap="nowrap"></th>
							<th nowrap="nowrap">USULAN</th>
							<th nowrap="nowrap">VOLUME</th>
							<th nowrap="nowrap">SATUAN</th>
							<th nowrap="nowrap">TOTAL</th>
						</tr>
					</thead>
					<tbody>
						<?php while($rs=$sql->fetch_object()){ ?>
						<tr>
							<td align="center"></td>
							<td><?php echo $rs->bidang; ?></td>
							<td></td>
							<td></td>
							<td align="right"><?php echo rp($rs->total); ?></td>
						</tr>
						
							<?php
							$sqlx=$conn->query("SELECT bidang,pptk,kegiatan,usulan,volume,harga,total from(
												select penyesesuaianperioritas_heder.namabidang as bidang,penyesesuaianperioritas_heder.pptk as pptk,penyesesuaianperioritas_heder.kegiatan as kegiatan,
												penyesesuaianperioritas_rinci.usulan as usulan,penyesesuaianperioritas_rinci.volume as volume,penyesesuaianperioritas_rinci.harga as harga,
												sum(penyesesuaianperioritas_rinci.nilai) as total
												from penyesesuaianperioritas_heder,penyesesuaianperioritas_rinci
												where penyesesuaianperioritas_heder.notrans=penyesesuaianperioritas_rinci.notrans 
												and year(penyesesuaianperioritas_heder.tgltrans)='".$_GET['thn']."' and penyesesuaianperioritas_heder.namabidang='".$rs->bidang."' 
												group by penyesesuaianperioritas_heder.pptk) as wew");
							?>
							<?php while($rsx=$sqlx->fetch_object()){ ?>
							<tr>
								<td align="center"></td>
								<td><?php echo $rsx->pptk; ?></td>
								<td></td>
								<td></td>
								<td align="right"><?php echo rp($rsx->total); ?></td>
							</tr>
									<?php
									$sqlxx=$conn->query("SELECT bidang,pptk,kegiatan,usulan,volume,harga,total from(
															select penyesesuaianperioritas_heder.namabidang as bidang,penyesesuaianperioritas_heder.pptk as pptk,penyesesuaianperioritas_heder.kegiatan as kegiatan,
															penyesesuaianperioritas_rinci.usulan as usulan,penyesesuaianperioritas_rinci.volume as volume,penyesesuaianperioritas_rinci.harga as harga,
															sum(penyesesuaianperioritas_rinci.nilai) as total
															from penyesesuaianperioritas_heder,penyesesuaianperioritas_rinci
															where penyesesuaianperioritas_heder.notrans=penyesesuaianperioritas_rinci.notrans 
															and year(penyesesuaianperioritas_heder.tgltrans)='".$_GET['thn']."' and penyesesuaianperioritas_heder.namabidang='".$rs->bidang."'
															and penyesesuaianperioritas_heder.pptk='".$rsx->pptk."' group by penyesesuaianperioritas_heder.kegiatan 											
															) as wew ");
									?>
									<?php while($rsxx=$sqlxx->fetch_object()){ ?>
									<tr>
										<td align="center"></td>
										<td align="lefth"><?php echo $rsxx->kegiatan; ?></td>
										<td align="right"></td>
										<td align="right"></td>
										<td align="right"><?php echo rp($rsxx->total); ?></td>
									</tr>
											<?php
												$sqlxxx=$conn->query("SELECT bidang,pptk,kegiatan,usulan,volume,harga,total from(
																		select penyesesuaianperioritas_heder.namabidang as bidang,penyesesuaianperioritas_heder.pptk as pptk,penyesesuaianperioritas_heder.kegiatan as kegiatan,
																		penyesesuaianperioritas_rinci.usulan as usulan,penyesesuaianperioritas_rinci.volume as volume,penyesesuaianperioritas_rinci.harga as harga,
																		penyesesuaianperioritas_rinci.nilai as total
																		from penyesesuaianperioritas_heder,penyesesuaianperioritas_rinci
																		where penyesesuaianperioritas_heder.notrans=penyesesuaianperioritas_rinci.notrans 
																		and year(penyesesuaianperioritas_heder.tgltrans)='".$_GET['thn']."' and penyesesuaianperioritas_heder.namabidang='".$rs->bidang."'
																		and penyesesuaianperioritas_heder.kegiatan='".$rsxx->kegiatan."'
																		and penyesesuaianperioritas_heder.pptk='".$rsx->pptk."' 											
																		) as wew ");
												?>
												<?php while($rsxxx=$sqlxxx->fetch_object()){ ?>
												<tr>
													<td align="center"></td>
													<td align="right"><?php echo $rsxxx->usulan; ?></td>
													<td align="right"><?php echo $rsxxx->volume; ?></td>
													<td align="right"><?php echo rp($rsxxx->harga); ?></td>
													<td align="right"><?php echo rp($rsxxx->total); ?></td>
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
							$i++;
							}
						?>
					</tbody>
			</table>
	 </div>
</div>
<?php include("../../close.php"); ?>