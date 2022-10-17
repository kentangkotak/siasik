<?php include("../../conn.php"); ?>
<?php
	$sql1=$conn->query("select * from profil" );
	$rs1=$sql1->fetch_object();
?>
<a href="javascript:void(0)" onclick="ExportToExcel_rbabelanja()"><img src="images/excel.jpg" width="20" height="20">Export to Excel</a>
<div id="excel_repot_rbabelanja">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<center>BADAN LAYANAN UMUM DAERAH <?php echo  $rs1->nama;?></br>
				RENCANA BISNIS DAN ANGGARAN PENDAPATAN DAN BELANJA </br>
				UNTUK TAHUN YANG BERAKHIR SAMPAI 31 DESEMBER  <?php echo  $_SESSION["anggaran_tahun"];?> </center>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<?php
					$sql2=$conn->query("select concat_ws('.',akun50_miroring.akun,akun50_miroring.kelompok,akun50_miroring.jenis,akun50_miroring.objectx,akun50_miroring.rincian,akun50_miroring.subrincian) as kode,
										uraian,sum(anggaran_pendapatan.nilai) as anggaran
										from  akun50_miroring,anggaran_pendapatan where akun=4 and kelompok is null and anggaran_pendapatan.tahun='".$_SESSION["anggaran_tahun"]."'" );
					$rs2=$sql2->fetch_object();
				?>
				<table class="table table-bordered table-striped jambo_table bulk_action dt-head-center" id="datatable-buttons"> 
						<thead>
							<tr>
								<th nowrap="nowrap">KODE</th>
								<th nowrap="nowrap">URAIAN</th>
								<th nowrap="nowrap">ANGGARAN</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td><?php echo $rs2->kode; ?></td>
								<td><?php echo $rs2->uraian; ?></td>
								<td align="right"><?php echo rp($rs2->anggaran); ?></td>
							</tr>
							<?php
								$sql3=$conn->query("select concat_ws('.',akun50_miroring.akun,akun50_miroring.kelompok,akun50_miroring.jenis,akun50_miroring.objectx,akun50_miroring.rincian,akun50_miroring.subrincian) as kode,
													uraian,sum(anggaran_pendapatan.nilai) as anggaran
													from  akun50_miroring,anggaran_pendapatan where akun=4 and kelompok=1 and jenis is null and anggaran_pendapatan.tahun='".$_SESSION["anggaran_tahun"]."'");
								$rs3=$sql3->fetch_object();
							?>
								<tr>
									<td><?php echo $rs3->kode; ?></td>
									<td><?php echo $rs3->uraian; ?></td>
									<td align="right"><?php echo rp($rs3->anggaran); ?></td>
								</tr>
								<?php
								$sql4=$conn->query("select concat_ws('.',akun50_miroring.akun,akun50_miroring.kelompok,akun50_miroring.jenis,akun50_miroring.objectx,akun50_miroring.rincian,akun50_miroring.subrincian) as kode,
													uraian,sum(anggaran_pendapatan.nilai) as anggaran
													from  akun50_miroring,anggaran_pendapatan where akun=4 and kelompok=1 and jenis=04 and objectx is null and anggaran_pendapatan.tahun='".$_SESSION["anggaran_tahun"]."'");
								$rs4=$sql4->fetch_object();
								?>
								<tr>
									<td><?php echo $rs4->kode; ?></td>
									<td><?php echo $rs4->uraian; ?></td>
									<td align="right"><?php echo rp($rs4->anggaran); ?></td>
								</tr>
								<?php
								$sql5=$conn->query("select concat_ws('.',akun50_miroring.akun,akun50_miroring.kelompok,akun50_miroring.jenis,akun50_miroring.objectx,akun50_miroring.rincian,akun50_miroring.subrincian) as kode,
													uraian,sum(anggaran_pendapatan.nilai) as anggaran
													from  akun50_miroring,anggaran_pendapatan where akun=4 and kelompok=1 and jenis=04 and objectx=16 and rincian is null and anggaran_pendapatan.tahun='".$_SESSION["anggaran_tahun"]."'");
								$rs5=$sql5->fetch_object();
								?>
								<tr>
									<td><?php echo $rs5->kode; ?></td>
									<td><?php echo $rs5->uraian; ?></td>
									<td align="right"><?php echo rp($rs5->anggaran); ?></td>
								</tr>
								<?php
								$sql6=$conn->query("select concat_ws('.',akun50_miroring.akun,akun50_miroring.kelompok,akun50_miroring.jenis,akun50_miroring.objectx,akun50_miroring.rincian,akun50_miroring.subrincian) as kode,
													uraian,sum(anggaran_pendapatan.nilai) as anggaran
													from  akun50_miroring,anggaran_pendapatan 
													where akun=4 and kelompok=1 and jenis=04 and objectx=16 and rincian=01 and subrincian is null and anggaran_pendapatan.tahun='".$_SESSION["anggaran_tahun"]."';");
								$rs6=$sql6->fetch_object();
								?>
								<tr>
									<td><?php echo $rs6->kode; ?></td>
									<td><?php echo $rs6->uraian; ?></td>
									<td align="right"><?php echo rp($rs5->anggaran); ?></td>
								</tr>
								<?php
									$i++; $anggaranTotal=$anggaranTotal+$rs6->anggaran; $penerimaanTotal=$penerimaanTotal+$penerimaan;
										  $selisihTotal=$selisihTotal+$selisih; $selisihpersenTotal=$selisihpersenTotal+$selisihpersen;
									
								?>
							<tr class="bodylist" valign="top";>
								<td colspan="2" align="right"><b>JUMLAH</b></td>
								<td align="right"><?php echo rp($anggaranTotal); ?></td>
							</tr>
								<?php
								$sql2x=$conn->query("select kode,uraian,sum(anggaran) as anggaranx from(
													   select concat_ws('.',akun50_miroring.akun,akun50_miroring.kelompok,akun50_miroring.jenis,akun50_miroring.objectx,akun50_miroring.rincian,akun50_miroring.subrincian) as kode,
													   uraian,'' as anggaran from  akun50_miroring where akun=5 and kelompok is null
													   union all
													   select '' as kode,'' as uraian,sum(nilai) as anggaran
													   from penyesesuaianperioritas_heder,penyesesuaianperioritas_rinci
													   where penyesesuaianperioritas_heder.notrans=penyesesuaianperioritas_rinci.notrans and 
													   year(penyesesuaianperioritas_heder.tgltrans)='".$_SESSION["anggaran_tahun"]."' 
										
												) as xxx");
								$rs2x=$sql2x->fetch_object();
								?>
								<tr>
									<td><b><?php echo $rs2x->kode; ?></b></td>
									<td><b><?php echo $rs2x->uraian; ?></b></td>
									<td align="right"><b><?php echo rp($rs2x->anggaranx); ?></b></td>
								</tr>
								<?php
								$sql3x=$conn->query("select kode,uraian,sum(anggaran) as anggaranx from(
													   select concat_ws('.',akun50_miroring.akun,akun50_miroring.kelompok,akun50_miroring.jenis,akun50_miroring.objectx,akun50_miroring.rincian,akun50_miroring.subrincian) as kode,
													   uraian,'' as anggaran from  akun50_miroring where akun=5 and jenis is null and kelompok is not null 
													   union all
													   select SUBSTRING_INDEX(penyesesuaianperioritas_rinci.koderek50,'.',2) as kode,'' as uraian,sum(nilai) as anggaran 
													   from penyesesuaianperioritas_heder,penyesesuaianperioritas_rinci
													   where penyesesuaianperioritas_heder.notrans=penyesesuaianperioritas_rinci.notrans and year(penyesesuaianperioritas_heder.tgltrans)='".$_SESSION["anggaran_tahun"]."'
													   group by SUBSTRING_INDEX(penyesesuaianperioritas_rinci.koderek50,'.',2)
													) as wew group by kode");
								?>
								<?php while($rs3x=$sql3x->fetch_object()){ 
									if($rs3x->anggaranx > 0){
								?>
								<tr>
									<td><b><?php echo $rs3x->kode; ?></b></td>
									<td><b><?php echo $rs3x->uraian; ?></b></td>
									<td align="right"><b><?php echo rp($rs3x->anggaranx); ?></b></td>
								</tr>
										<?php
										$sql4x=$conn->query("select kode,uraian,sum(anggaran) as anggaranx from(
															   select concat_ws('.',akun50_miroring.akun,akun50_miroring.kelompok,akun50_miroring.jenis,akun50_miroring.objectx,akun50_miroring.rincian,akun50_miroring.subrincian) as kode,
															   uraian,'' as anggaran from  akun50_miroring where akun=5 and jenis is not null and objectx is null
															   union all
															   select SUBSTRING_INDEX(penyesesuaianperioritas_rinci.koderek50,'.',3) as kode,'' as uraian,sum(nilai) as anggaran 
															   from penyesesuaianperioritas_heder,penyesesuaianperioritas_rinci
															   where penyesesuaianperioritas_heder.notrans=penyesesuaianperioritas_rinci.notrans and year(penyesesuaianperioritas_heder.tgltrans)='".$_SESSION["anggaran_tahun"]."'
															   and SUBSTRING_INDEX(penyesesuaianperioritas_rinci.koderek50,'.',2)='".$rs3x->kode."' 
															   group by SUBSTRING_INDEX(penyesesuaianperioritas_rinci.koderek50,'.',3)
															) as wew group by kode");
										?>
										<?php while($rs4x=$sql4x->fetch_object()){ 
											if($rs4x->anggaranx > 0){
										?>
										<tr>
											<td><b><?php echo $rs4x->kode; ?></b></td>
											<td><b><?php echo $rs4x->uraian; ?></b></td>
											<td align="right"><b><?php echo rp($rs4x->anggaranx); ?></b></td>
										</tr>
											<?php
											$sql5x=$conn->query("select kode,uraian,sum(anggaran) as anggaranx from(
																   select concat_ws('.',akun50_miroring.akun,akun50_miroring.kelompok,akun50_miroring.jenis,akun50_miroring.objectx,akun50_miroring.rincian,akun50_miroring.subrincian) as kode,
																   uraian,'' as anggaran from  akun50_miroring where akun=5 and objectx is not null and rincian is null
																   union all
																   select SUBSTRING_INDEX(penyesesuaianperioritas_rinci.koderek50,'.',4) as kode,'' as uraian,sum(nilai) as anggaran
																   from penyesesuaianperioritas_heder,penyesesuaianperioritas_rinci
																   where penyesesuaianperioritas_heder.notrans=penyesesuaianperioritas_rinci.notrans and year(penyesesuaianperioritas_heder.tgltrans)='".$_SESSION["anggaran_tahun"]."'
																   and SUBSTRING_INDEX(penyesesuaianperioritas_rinci.koderek50,'.',3)='".$rs4x->kode."' 
																   group by SUBSTRING_INDEX(penyesesuaianperioritas_rinci.koderek50,'.',4)																 
																) as wew group by kode");
											?>
											<?php while($rs5x=$sql5x->fetch_object()){ 
												if($rs5x->anggaranx > 0){
											?>
											<tr>
												<td><?php echo $rs5x->kode; ?></td>
												<td><?php echo $rs5x->uraian; ?></td>
												<td align="right"><?php echo rp($rs5x->anggaranx); ?></td>
											</tr>
												<?php
												$sql6x=$conn->query("select kode,uraian,sum(anggaran) as anggaranx from(
																	   select concat_ws('.',akun50_miroring.akun,akun50_miroring.kelompok,akun50_miroring.jenis,akun50_miroring.objectx,akun50_miroring.rincian,akun50_miroring.subrincian) as kode,
																	   uraian,'' as anggaran from  akun50_miroring where akun=5 and rincian is not null and subrincian is null
																	   union all
																	   select SUBSTRING_INDEX(penyesesuaianperioritas_rinci.koderek50,'.',5) as kode,'' as uraian,sum(nilai) as anggaran 
																	   from penyesesuaianperioritas_heder,penyesesuaianperioritas_rinci
																	   where penyesesuaianperioritas_heder.notrans=penyesesuaianperioritas_rinci.notrans and year(penyesesuaianperioritas_heder.tgltrans)='".$_SESSION["anggaran_tahun"]."'
																	   and SUBSTRING_INDEX(penyesesuaianperioritas_rinci.koderek50,'.',4)='".$rs5x->kode."' 
																	   group by SUBSTRING_INDEX(penyesesuaianperioritas_rinci.koderek50,'.',5)																	 
																	) as wew group by kode");
												?>
												<?php while($rs6x=$sql6x->fetch_object()){ 
													if($rs6x->anggaranx > 0){
												?>
												<tr>
													<td><?php echo $rs6x->kode; ?></td>
													<td><?php echo $rs6x->uraian; ?></td>
													<td align="right"><?php echo rp($rs6x->anggaranx); ?></td>
												</tr>
													<?php
													$sql7x=$conn->query("select kode,uraian,sum(anggaran) as anggaranx from(
																		   select concat_ws('.',akun50_miroring.akun,akun50_miroring.kelompok,akun50_miroring.jenis,akun50_miroring.objectx,akun50_miroring.rincian,akun50_miroring.subrincian) as kode,
																		   uraian,'' as anggaran from  akun50_miroring where akun=5 and subrincian is not null
																		   union all
																		   select SUBSTRING_INDEX(penyesesuaianperioritas_rinci.koderek50,'.',6) as kode,'' as uraian,sum(nilai) as anggaran 
																		   from penyesesuaianperioritas_heder,penyesesuaianperioritas_rinci
																		   where penyesesuaianperioritas_heder.notrans=penyesesuaianperioritas_rinci.notrans and year(penyesesuaianperioritas_heder.tgltrans)='".$_SESSION["anggaran_tahun"]."'
																		   and SUBSTRING_INDEX(penyesesuaianperioritas_rinci.koderek50,'.',5)='".$rs6x->kode."' 
																		   group by SUBSTRING_INDEX(penyesesuaianperioritas_rinci.koderek50,'.',6)
																		) as wew group by kode");
													?>
													<?php while($rs7x=$sql7x->fetch_object()){ 
														if($rs7x->anggaranx > 0){
													?>
													<tr>
														<td><a href="javascript:void(0)"; onClick="lihatbidang('<?php echo $rs7x->kode; ?>');"><?php echo $rs7x->kode; ?></a></td>
														<td><?php echo $rs7x->uraian; ?></td>
														<td align="right"><?php echo rp($rs7x->anggaranx); ?></td>
													</tr>
													<?php
														}
														$i++; $anggaranTotalx=$anggaranTotalx+$rs7x->anggaranx;
														}
													?>
												<?php
													}
													$i++;
													}
												?>
											<?php
												}
												$i++;
												}
											?>
										<?php
											}
											$i++;
											}
										?>
								<?php
									}
									$i++; 
									}
									
									//$selisihTotal=$selisihTotal+$selisih; $selisihpersenTotal=$selisihpersenTotal+$selisihpersen;
								?>
								<tr class="bodylist" valign="top";>
									<td colspan="2" align="right"><b>JUMLAH</b></td>
									<td align="right"><b><?php echo rp($anggaranTotalx); ?></b></td>
								</tr>
						</tbody>
				</table>
				</br>
			</div>
		</div>
	</div>
</div>
<?php include("../../close.php"); ?>
<script>
$(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
} );
</script>