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
					$sql2=$conn->query("select kode,uraian,round(sum(anggaranlama),2) as anggaranlamax,round(sum(anggaranbaru),2) as anggaranbarux,round(sum(anggaranbaru)-sum(anggaranlama),2) as sisa from(
											select concat_ws('.',akun50_miroring.akun,akun50_miroring.kelompok,akun50_miroring.jenis,akun50_miroring.objectx,akun50_miroring.rincian,akun50_miroring.subrincian) as kode,
											uraian,sum(anggaran_pendapatan.nilai) as anggaranlama,'' as anggaranbaru
											from  akun50_miroring,anggaran_pendapatan where akun=4 and kelompok is null and anggaran_pendapatan.tahun='".$_SESSION["anggaran_tahun"]."'
											union all
											select concat_ws('.',akun50_miroring.akun,akun50_miroring.kelompok,akun50_miroring.jenis,akun50_miroring.objectx,akun50_miroring.rincian,akun50_miroring.subrincian) as kode,
											uraian,'' as anggaranlama,sum(anggaran_pendapatan_pak.nilai) as anggaranbaru
											from  akun50_miroring,anggaran_pendapatan_pak where akun=4 and kelompok is null and anggaran_pendapatan_pak.tahun='".$_SESSION["anggaran_tahun"]."'
										) as pendapatan group by kode" );
					$rs2=$sql2->fetch_object();
				?>
				<table class="table table-bordered table-striped jambo_table bulk_action dt-head-center" id="datatable-buttons"> 
						<thead>
							<tr>
								<th nowrap="nowrap">KODE</th>
								<th nowrap="nowrap">URAIAN</th>
								<th nowrap="nowrap">ANGGARAN LAMA</th>
								<th nowrap="nowrap">ANGGARAN BARU</th>
								<th nowrap="nowrap">PENAMBAHAN ATAU PENGURANGAN</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td><b><?php echo $rs2->kode; ?></b></td>
								<td><b><?php echo $rs2->uraian; ?></b></td>
								<td align="right"><b><?php echo rpzx($rs2->anggaranlamax); ?></b></td>
								<td align="right"><b><?php echo rpzx($rs2->anggaranbarux); ?></b></td>
								<td align="right"><b><?php echo rpzx($rs2->sisa); ?></b></td>
							</tr>
							<?php
								$sql3=$conn->query("select kode,uraian,round(sum(anggaranlama),2) as anggaranlamax,round(sum(anggaranbaru),2) as anggaranbarux,round(sum(anggaranbaru)-sum(anggaranlama),2) as sisa from(
													select concat_ws('.',akun50_miroring.akun,akun50_miroring.kelompok,akun50_miroring.jenis,akun50_miroring.objectx,akun50_miroring.rincian,akun50_miroring.subrincian) as kode,
														uraian,sum(anggaran_pendapatan.nilai) as anggaranlama,'' as anggaranbaru
														from  akun50_miroring,anggaran_pendapatan where akun=4 and kelompok=1 and jenis is null and anggaran_pendapatan.tahun='".$_SESSION["anggaran_tahun"]."'
														union all
														select concat_ws('.',akun50_miroring.akun,akun50_miroring.kelompok,akun50_miroring.jenis,akun50_miroring.objectx,akun50_miroring.rincian,akun50_miroring.subrincian) as kode,
														uraian,'' as anggaranlama,sum(anggaran_pendapatan_pak.nilai) as anggaranbaru
														from  akun50_miroring,anggaran_pendapatan_pak where akun=4 and kelompok=1 and jenis is null and anggaran_pendapatan_pak.tahun='".$_SESSION["anggaran_tahun"]."'
													) as pendapatan group by kode");
								$rs3=$sql3->fetch_object();
							?>
								<tr>
									<td><b><?php echo $rs3->kode; ?></b></td>
									<td><b><?php echo $rs3->uraian; ?></b></td>
									<td align="right"><b><?php echo rpzx($rs3->anggaranlamax); ?></b></td>
									<td align="right"><b><?php echo rpzx($rs3->anggaranbarux); ?></b></td>
									<td align="right"><b><?php echo rpzx($rs3->sisa); ?></td>
								</tr>
								<?php
								$sql4=$conn->query("select kode,uraian,round(sum(anggaranlama),2) as anggaranlamax,round(sum(anggaranbaru),2) as anggaranbarux,round(sum(anggaranbaru)-sum(anggaranlama),2) as sisa from(
														select concat_ws('.',akun50_miroring.akun,akun50_miroring.kelompok,akun50_miroring.jenis,akun50_miroring.objectx,akun50_miroring.rincian,akun50_miroring.subrincian) as kode,
														uraian,sum(anggaran_pendapatan.nilai) as anggaranlama,'' as anggaranbaru
														from  akun50_miroring,anggaran_pendapatan where akun=4 and kelompok=1 and jenis=04 and objectx is null and anggaran_pendapatan.tahun='".$_SESSION["anggaran_tahun"]."'
														union all
														select concat_ws('.',akun50_miroring.akun,akun50_miroring.kelompok,akun50_miroring.jenis,akun50_miroring.objectx,akun50_miroring.rincian,akun50_miroring.subrincian) as kode,
														uraian,'' as anggaranlama,sum(anggaran_pendapatan_pak.nilai) as anggaranbaru
														from  akun50_miroring,anggaran_pendapatan_pak where akun=4 and kelompok=1 and jenis=04 and objectx is null and anggaran_pendapatan_pak.tahun='".$_SESSION["anggaran_tahun"]."'
														) as pendapatan group by kode");
								$rs4=$sql4->fetch_object();
								?>
								<tr>
									<td><b><?php echo $rs4->kode; ?></b></td>
									<td><b><?php echo $rs4->uraian; ?></b></td>
									<td align="right"><b><?php echo rpzx($rs4->anggaranlamax); ?></b></td>
									<td align="right"><b><?php echo rpzx($rs4->anggaranbarux); ?></b></td>
									<td align="right"><b><?php echo rpzx($rs4->sisa); ?></td>
								</tr>
								<?php
								$sql5=$conn->query("select kode,uraian,round(sum(anggaranlama),2) as anggaranlamax,round(sum(anggaranbaru),2) as anggaranbarux,round(sum(anggaranbaru)-sum(anggaranlama),2) as sisa from(
												select concat_ws('.',akun50_miroring.akun,akun50_miroring.kelompok,akun50_miroring.jenis,akun50_miroring.objectx,akun50_miroring.rincian,akun50_miroring.subrincian) as kode,
													uraian,sum(anggaran_pendapatan.nilai) as anggaranlama,'' as anggaranbaru
													from  akun50_miroring,anggaran_pendapatan 
													where akun=4 and kelompok=1 and jenis=04 and objectx=16 and rincian=01 and subrincian is null and anggaran_pendapatan.tahun='".$_SESSION["anggaran_tahun"]."'
													union all
													select concat_ws('.',akun50_miroring.akun,akun50_miroring.kelompok,akun50_miroring.jenis,akun50_miroring.objectx,akun50_miroring.rincian,akun50_miroring.subrincian) as kode,
													uraian,'' as anggaranlama,sum(anggaran_pendapatan_pak.nilai) as anggaranbaru
													from  akun50_miroring,anggaran_pendapatan_pak 
													where akun=4 and kelompok=1 and jenis=04 and objectx=16 and rincian=01 and subrincian is null and anggaran_pendapatan_pak.tahun='".$_SESSION["anggaran_tahun"]."'
												) as pendapatan group by kode");
								$rs5=$sql5->fetch_object();
								?>
								<tr>
									<td><?php echo $rs5->kode; ?></td>
									<td><?php echo $rs5->uraian; ?></td>
									<td align="right"><?php echo rpzx($rs5->anggaranlamax); ?></td>
									<td align="right"><?php echo rpzx($rs5->anggaranbarux); ?></td>
									<td align="right"><?php echo rpzx($rs5->sisa); ?></td>
								</tr>
								<?php
								$sql6=$conn->query("select kode,uraian,round(sum(anggaranlama),2) as anggaranlamax,round(sum(anggaranbaru),2) as anggaranbarux,round(sum(anggaranbaru)-sum(anggaranlama),2) as sisa from(
													select concat_ws('.',akun50_miroring.akun,akun50_miroring.kelompok,akun50_miroring.jenis,akun50_miroring.objectx,akun50_miroring.rincian,akun50_miroring.subrincian) as kode,
													uraian,sum(anggaran_pendapatan.nilai) as anggaranlama,'' as anggaranbaru
													from  akun50_miroring,anggaran_pendapatan 
													where akun=4 and kelompok=1 and jenis=04 and objectx=16 and rincian=01 and subrincian is null and anggaran_pendapatan.tahun='".$_SESSION["anggaran_tahun"]."'
													union all
													select concat_ws('.',akun50_miroring.akun,akun50_miroring.kelompok,akun50_miroring.jenis,akun50_miroring.objectx,akun50_miroring.rincian,akun50_miroring.subrincian) as kode,
													uraian,'' as anggaranlama,sum(anggaran_pendapatan_pak.nilai) as anggaranbarux
													from  akun50_miroring,anggaran_pendapatan_pak
													where akun=4 and kelompok=1 and jenis=04 and objectx=16 and rincian=01 and subrincian is null and anggaran_pendapatan_pak.tahun='".$_SESSION["anggaran_tahun"]."'
													) as pendapatan group by kode");
								$rs6=$sql6->fetch_object();
								?>
								<tr>
									<td><?php echo $rs6->kode; ?></td>
									<td><?php echo $rs6->uraian; ?></td>
									<td align="right"><?php echo rpzx($rs5->anggaranlamax); ?></td>
									<td align="right"><?php echo rpzx($rs5->anggaranbarux); ?></td>
									<td align="right"><?php echo rpzx($rs5->sisa); ?></td>
								</tr>
								<?php
									$i++; $anggaranTotallama=$anggaranTotallama+$rs6->anggaranlamax;
										  $anggaranTotalbaru=$anggaranTotalbaru+$rs6->anggaranbarux;
										  $sisaTotal=$sisaTotal+$rs6->sisa;										  
										
								?>
							<tr class="bodylist" valign="top";>
								<td colspan="2" align="right"><b>JUMLAH</b></td>
								<td align="right"><?php echo rpzx($anggaranTotallama); ?></td>
								<td align="right"><?php echo rpzx($anggaranTotalbaru); ?></td>
								<td align="right"><?php echo rpzx($sisaTotal); ?></td>
							</tr>
							<?php
									$sqlsilpa=$conn->query("select kode79,uraian79,round(sum(anggaranlama),2) as anggaranlamax,round(sum(anggaranbaru),2) as anggaranbarux,round(sum(anggaranbaru)-sum(anggaranlama),2) as sisa from(
															select pendamap7950.kode79,pendamap7950.uraian79 as uraian79,'' as anggaranlama,sum(silpa.nominal) as anggaranbaru
															FROM pendamap7950,silpa
															where pendamap7950.kode79=6 and SUBSTRING_INDEX(silpa.kode79,'.',1)=pendamap7950.kode79 
															and silpa.tahun=".$_SESSION["anggaran_tahun"]."
															) as silpa");
								?>
								<?php while($rssilpa=$sqlsilpa->fetch_object()){ ?>
								<tr>
									<td><b><?php echo $rssilpa->kode79; ?></b></td>
									<td><b><?php echo $rssilpa->uraian79; ?></b></td>
									<td align="right"><b><?php echo rpzx($rssilpa->anggaranlamax); ?></b></td>
									<td align="right"><b><?php echo rpzx($rssilpa->anggaranbarux); ?></b></td>
									<td align="right"><b><?php echo rpzx($rssilpa->sisa); ?></b></td>
								</tr>
									<?php
										$sqlsilpa1=$conn->query("select kode79,uraian79,round(sum(anggaranlama),2) as anggaranlamax,round(sum(anggaranbaru),2) as anggaranbarux,round(sum(anggaranbaru)-sum(anggaranlama),2) as sisa from(
														select pendamap7950.kode79 as kode79,pendamap7950.uraian79 as uraian79,'' as anggaranlama,'' as anggaranbaru 
														from pendamap7950
														where pendamap7950.kelompok='".$rssilpa->kode79."'
														group by pendamap7950.kode79
														union all
														select SUBSTRING_INDEX(kode79,'.',2) as kode79,'' as uraian79,'' as anggaranlama,nominal as anggaranbaru
														from silpa
														where SUBSTRING_INDEX(kode79,'.',1)='".$rssilpa->kode79."' and tahun=".$_SESSION["anggaran_tahun"]."
														group by kode79
														) as silpa group by kode79");
									?>
										<?php while($rssilpa1=$sqlsilpa1->fetch_object()){ ?>
											<tr>
												<td><b><?php echo $rssilpa1->kode79; ?></b></td>
												<td><b><?php echo $rssilpa1->uraian79; ?></b></td>
												<td align="right"><b><?php echo rpzx($rssilpa1->anggaranlamax); ?></b></td>
												<td align="right"><b><?php echo rpzx($rssilpa1->anggaranbarux); ?></b></td>
												<td align="right"><b><?php echo rpzx($rssilpa1->sisa); ?></b></td>
											</tr>
											<?php
											$sqlsilpax=$conn->query("select kode79,uraian79,round(sum(anggaranlama),2) as anggaranlamax,round(sum(anggaranbaru),2) as anggaranbarux,round(sum(anggaranbaru)-sum(anggaranlama),2) as sisa from(
																	select pendamap7950.kode79 as kode79,pendamap7950.uraian79 as uraian79,'' as anggaranlama,'' as anggaranbaru 
																	from pendamap7950
																	where pendamap7950.kelompok='".$rssilpa1->kode79."'
																	group by pendamap7950.kode79
																	union all
																	select SUBSTRING_INDEX(kode79,'.',3) as kode79,'' as uraian79,'' as anggaranlama,nominal as anggaranbaru
																	from silpa
																	where SUBSTRING_INDEX(kode79,'.',2)='".$rssilpa1->kode79."' and tahun=".$_SESSION["anggaran_tahun"]."
																	group by kode79
																	) as silpa group by kode79");
											?>
										<?php while($rssilpax=$sqlsilpax->fetch_object()){ ?>
										<tr>
											<td><b><?php echo $rssilpax->kode79; ?></b></td>
											<td><b><?php echo $rssilpax->uraian79; ?></b></td>
											<td align="right"><b><?php echo rpzx($rssilpax->anggaranlamax); ?></b></td>
											<td align="right"><b><?php echo rpzx($rssilpax->anggaranbarux); ?></b></td>
											<td align="right"><b><?php echo rpzx($rssilpax->sisa); ?></b></td>
										</tr>
											<?php
												$sqlsilpax2=$conn->query("select kode79,uraian79,round(sum(anggaranlama),2) as anggaranlamax,round(sum(anggaranbaru),2) as anggaranbarux,round(sum(anggaranbaru)-sum(anggaranlama),2) as sisa from(
																		select pendamap7950.kode79 as kode79,pendamap7950.uraian79 as uraian79,'' as anggaranlama,'' as anggaranbaru 
																		from pendamap7950
																		where pendamap7950.kelompok='".$rssilpax->kode79."'
																		group by pendamap7950.kode79
																		union all
																		select SUBSTRING_INDEX(kode79,'.',3) as kode79,'' as uraian79,'' as anggaranlama,nominal as anggaranbaru
																		from silpa
																		where SUBSTRING_INDEX(kode79,'.',2)='".$rssilpax->kode79."' and tahun=".$_SESSION["anggaran_tahun"]."
																		group by kode79
																		) as silpa group by kode79");
												?>
											<?php while($rssilpax2=$sqlsilpax2->fetch_object()){ ?>
											<tr>
												<td><?php echo $rssilpax2->kode79; ?></td>
												<td><?php echo $rssilpax2->uraian79; ?></td>
												<td align="right"><?php echo rpzx($rssilpax2->anggaranlamax); ?></td>
												<td align="right"><?php echo rpzx($rssilpax2->anggaranbarux); ?></td>
												<td align="right"><?php echo rpzx($rssilpax2->sisa); ?></td>
											</tr>
											<?php $i++; } ?>
										<?php $i++; } ?>
									<?php $i++; } ?>
								<?php $i++; $anggaranTotallamasilpa=$anggaranTotallamasilpa+$rssilpa->anggaranlamax;
											$anggaranTotalbarusilpa=$anggaranTotalbarusilpa+$rssilpa->anggaranbarux;
											$sisaTotalsilpa=$sisaTotalsilpa+$rssilpa->sisa;
								} ?>
								<tr class="bodylist" valign="top";>
									<td colspan="2" align="right"><b>JUMLAH</b></td>
									<td align="right"><?php echo rpzx($anggaranTotallamasilpa); ?></td>
									<td align="right"><?php echo rpzx($anggaranTotalbarusilpa); ?></td>
									<td align="right"><?php echo rpzx($sisaTotalsilpa); ?></td>
								</tr>
							<?php
								$sql2x=$conn->query("select kode,uraian,round(sum(anggaranlama),2) as anggaranlamax,round(sum(anggaranbaru),2) as anggaranbarux,round(sum(anggaranbaru)-sum(anggaranlama),2) as sisa from(
														   select concat_ws('.',akun50_miroring.akun,akun50_miroring.kelompok,akun50_miroring.jenis,akun50_miroring.objectx,akun50_miroring.rincian,akun50_miroring.subrincian) as kode,
														   uraian,'' as anggaranlama,'' as anggaranbaru from  akun50_miroring where akun=5 and kelompok is null
														   union all
														   select '' as kode,'' as uraian,sum(t_tampung.pagu) as anggaranlama,'' as anggaranbaru
														   from penyesesuaianperioritas_heder,t_tampung
														   where penyesesuaianperioritas_heder.notrans=t_tampung.notrans and 
														   year(penyesesuaianperioritas_heder.tgltrans)='".$_SESSION["anggaran_tahun"]."'
														   union all
														   select '' as kode,'' as uraian,'' as anggaranlama,sum(usulanHonor_r_pak.nilai) as anggaranbaru
														   from usulanHonor_h_pak,usulanHonor_r_pak
														   where usulanHonor_h_pak.notrans=usulanHonor_r_pak.notrans and
														   year(usulanHonor_h_pak.tglTransaksi)='".$_SESSION["anggaran_tahun"]."'	   
													) as xxx");
								$rs2x=$sql2x->fetch_object();
								?>
								<tr>
									<td><b><?php echo $rs2x->kode; ?></b></td>
									<td><b><?php echo $rs2x->uraian; ?></b></td>
									<td align="right"><b><?php echo rpzx($rs2x->anggaranlamax); ?></b></td>
									<td align="right"><b><?php echo rpzx($rs2x->anggaranbarux); ?></b></td>
									<td align="right"><b><?php echo rpzx($rs2x->sisa); ?></b></td>
								</tr>
								<?php
								$sql3x=$conn->query("select kode,uraian,round(sum(anggaranlama),2) as anggaranlamax,round(sum(anggaranbaru),2) as anggaranbarux,round(sum(anggaranbaru)-sum(anggaranlama),2) as sisa from(
													   select concat_ws('.',akun50_miroring.akun,akun50_miroring.kelompok,akun50_miroring.jenis,akun50_miroring.objectx,akun50_miroring.rincian,akun50_miroring.subrincian) as kode,
													   uraian,'' as anggaranlama,'' as anggaranbaru from  akun50_miroring where akun=5 and jenis is null and kelompok is not null 
													   union all
													   select SUBSTRING_INDEX(t_tampung.koderek50,'.',2) as kode,'' as uraian,sum(t_tampung.pagu) as anggaranlama,'' as anggaranbaru
													   from penyesesuaianperioritas_heder,t_tampung
													   where penyesesuaianperioritas_heder.notrans=t_tampung.notrans and year(penyesesuaianperioritas_heder.tgltrans)='".$_SESSION["anggaran_tahun"]."'
													   group by SUBSTRING_INDEX(t_tampung.koderek50,'.',2)
													   union all
													   select SUBSTRING_INDEX(usulanHonor_r_pak.koderek50,'.',2) as kode,'' as uraian,'' as anggaranlama,sum(usulanHonor_r_pak.nilai) as anggaranbaru
													   from usulanHonor_h_pak,usulanHonor_r_pak
													   where usulanHonor_h_pak.notrans=usulanHonor_r_pak.notrans and
													   year(usulanHonor_h_pak.tglTransaksi)='".$_SESSION["anggaran_tahun"]."'
													   group by SUBSTRING_INDEX(usulanHonor_r_pak.koderek50,'.',2)
													) as wew group by kode");
								?>
								<?php while($rs3x=$sql3x->fetch_object()){ if($rs3x->anggaranbarux > 0){ ?>
								<tr>
									<td><b><?php echo $rs3x->kode; ?></b></td>
									<td><b><?php echo $rs3x->uraian; ?></b></td>
									<td align="right"><b><?php echo rpzx($rs3x->anggaranlamax); ?></b></td>
									<td align="right"><b><?php echo rpzx($rs3x->anggaranbarux); ?></b></td>
									<td align="right"><b><?php echo rpzx($rs3x->sisa); ?></b></td>
								</tr>
										<?php
										$sql4x=$conn->query("select kode,uraian,round(sum(anggaranlama),2) as anggaranlamax,round(sum(anggaranbaru),2) as anggaranbarux,round(sum(anggaranbaru)-sum(anggaranlama),2) as sisa from(
															   select concat_ws('.',akun50_miroring.akun,akun50_miroring.kelompok,akun50_miroring.jenis,akun50_miroring.objectx,akun50_miroring.rincian,akun50_miroring.subrincian) as kode,
															   uraian,'' as anggaranlama,'' as anggaranbaru from  akun50_miroring where akun=5 and jenis is not null and objectx is null
															   union all
															   select SUBSTRING_INDEX(t_tampung.koderek50,'.',3) as kode,'' as uraian,sum(t_tampung.pagu) as anggaranlama,'' as anggaranbaru 
															   from penyesesuaianperioritas_heder,t_tampung
															   where penyesesuaianperioritas_heder.notrans=t_tampung.notrans and year(penyesesuaianperioritas_heder.tgltrans)='".$_SESSION["anggaran_tahun"]."'
															   and SUBSTRING_INDEX(t_tampung.koderek50,'.',2)='".$rs3x->kode."' 
															   group by SUBSTRING_INDEX(t_tampung.koderek50,'.',3)
															   union all
															   select SUBSTRING_INDEX(usulanHonor_r_pak.koderek50,'.',3) as kode,'' as uraian,'' as anggaranlama,sum(usulanHonor_r_pak.nilai) as anggaranbaru 
															   from usulanHonor_h_pak,usulanHonor_r_pak
															   where usulanHonor_h_pak.notrans=usulanHonor_r_pak.notrans and year(usulanHonor_h_pak.tglTransaksi)='".$_SESSION["anggaran_tahun"]."'
															   and SUBSTRING_INDEX(usulanHonor_r_pak.koderek50,'.',2)='".$rs3x->kode."' 
															   group by SUBSTRING_INDEX(usulanHonor_r_pak.koderek50,'.',3)
															) as wew group by kode");
										?>
										<?php while($rs4x=$sql4x->fetch_object()){ if($rs4x->anggaranbarux > 0){ ?>
										<tr>
											<td><b><?php echo $rs4x->kode; ?></b></td>
											<td><b><?php echo $rs4x->uraian; ?></b></td>
											<td align="right"><b><?php echo rpzx($rs4x->anggaranlamax); ?></b></td>
											<td align="right"><b><?php echo rpzx($rs4x->anggaranbarux); ?></b></td>
											<td align="right"><b><?php echo rpzx($rs4x->sisa); ?></b></td>
										</tr>
											<?php
											$sql5x=$conn->query("select kode,uraian,round(sum(anggaranlama),2) as anggaranlamax,round(sum(anggaranbaru),2) as anggaranbarux,round(sum(anggaranbaru)-sum(anggaranlama),2) as sisa from(
															   select concat_ws('.',akun50_miroring.akun,akun50_miroring.kelompok,akun50_miroring.jenis,akun50_miroring.objectx,akun50_miroring.rincian,akun50_miroring.subrincian) as kode,
															   uraian,'' as anggaranlama,'' as anggaranbaru from  akun50_miroring where akun=5 and objectx is not null and rincian is null
															   union all
															   select SUBSTRING_INDEX(t_tampung.koderek50,'.',4) as kode,'' as uraian,sum(t_tampung.pagu) as anggaranlama,'' as anggaranbaru 
															   from penyesesuaianperioritas_heder,t_tampung
															   where penyesesuaianperioritas_heder.notrans=t_tampung.notrans and year(penyesesuaianperioritas_heder.tgltrans)='".$_SESSION["anggaran_tahun"]."'
															   and SUBSTRING_INDEX(t_tampung.koderek50,'.',3)='".$rs4x->kode."' 
															   group by SUBSTRING_INDEX(t_tampung.koderek50,'.',4)
															   union all
															   select SUBSTRING_INDEX(usulanHonor_r_pak.koderek50,'.',4) as kode,'' as uraian,'' as anggaranlama,sum(usulanHonor_r_pak.nilai) as anggaranbaru 
															   from usulanHonor_h_pak,usulanHonor_r_pak
															   where usulanHonor_h_pak.notrans=usulanHonor_r_pak.notrans and year(usulanHonor_h_pak.tglTransaksi)='".$_SESSION["anggaran_tahun"]."'
															   and SUBSTRING_INDEX(usulanHonor_r_pak.koderek50,'.',3)='".$rs4x->kode."' 
															   group by SUBSTRING_INDEX(usulanHonor_r_pak.koderek50,'.',4)
															) as wew group by kode");
											?>
											<?php while($rs5x=$sql5x->fetch_object()){ 
												if($rs5x->anggaranbarux > 0){
											?>
											<tr>
												<td><?php echo $rs5x->kode; ?></td>
												<td><?php echo $rs5x->uraian; ?></td>
												<td align="right"><?php echo rpzx($rs5x->anggaranlamax); ?></td>
												<td align="right"><?php echo rpzx($rs5x->anggaranbarux); ?></td>
												<td align="right"><?php echo rpzx($rs5x->sisa); ?></td>
											</tr>
												<?php
												$sql6x=$conn->query("select kode,uraian,round(sum(anggaranlama),2) as anggaranlamax,round(sum(anggaranbaru),2) as anggaranbarux,round(sum(anggaranbaru)-sum(anggaranlama),2) as sisa from(
															   select concat_ws('.',akun50_miroring.akun,akun50_miroring.kelompok,akun50_miroring.jenis,akun50_miroring.objectx,akun50_miroring.rincian,akun50_miroring.subrincian) as kode,
															   uraian,'' as anggaranlama,'' as anggaranbaru from  akun50_miroring where akun=5 and rincian is not null and subrincian is null
															   union all
															   select SUBSTRING_INDEX(t_tampung.koderek50,'.',5) as kode,'' as uraian,sum(t_tampung.pagu) as anggaranlama,'' as anggaranbaru 
															   from penyesesuaianperioritas_heder,t_tampung
															   where penyesesuaianperioritas_heder.notrans=t_tampung.notrans and year(penyesesuaianperioritas_heder.tgltrans)='".$_SESSION["anggaran_tahun"]."'
															   and SUBSTRING_INDEX(t_tampung.koderek50,'.',4)='".$rs5x->kode."' 
															   group by SUBSTRING_INDEX(t_tampung.koderek50,'.',5)
															   union all
															   select SUBSTRING_INDEX(usulanHonor_r_pak.koderek50,'.',5) as kode,'' as uraian,'' as anggaranlama,sum(usulanHonor_r_pak.nilai) as anggaranbaru 
															   from usulanHonor_h_pak,usulanHonor_r_pak
															   where usulanHonor_h_pak.notrans=usulanHonor_r_pak.notrans and year(usulanHonor_h_pak.tglTransaksi)='".$_SESSION["anggaran_tahun"]."'
															   and SUBSTRING_INDEX(usulanHonor_r_pak.koderek50,'.',4)='".$rs5x->kode."' 
															   group by SUBSTRING_INDEX(usulanHonor_r_pak.koderek50,'.',5)
															) as wew group by kode");
												?>
												<?php while($rs6x=$sql6x->fetch_object()){ 
													if($rs6x->anggaranbarux > 0){
												?>
												<tr>
													<td><?php echo $rs6x->kode; ?></td>
													<td><?php echo $rs6x->uraian; ?></td>
													<td align="right"><?php echo rpzx($rs6x->anggaranlamax); ?></td>
													<td align="right"><?php echo rpzx($rs6x->anggaranbarux); ?></td>
													<td align="right"><?php echo rpzx($rs6x->sisa); ?></td>
												</tr>
													<?php
													$sql7x=$conn->query("select kode,uraian,round(sum(anggaranlama),2) as anggaranlamax,round(sum(anggaranbaru),2) as anggaranbarux,round(sum(anggaranbaru)-sum(anggaranlama),2) as sisa from(
															   select concat_ws('.',akun50_miroring.akun,akun50_miroring.kelompok,akun50_miroring.jenis,akun50_miroring.objectx,akun50_miroring.rincian,akun50_miroring.subrincian) as kode,
															   uraian,'' as anggaranlama,'' as anggaranbaru from  akun50_miroring where akun=5 and subrincian is not null
															   union all
															   select SUBSTRING_INDEX(t_tampung.koderek50,'.',6) as kode,'' as uraian,sum(t_tampung.pagu) as anggaranlama,'' as anggaranbaru 
															   from penyesesuaianperioritas_heder,t_tampung
															   where penyesesuaianperioritas_heder.notrans=t_tampung.notrans and year(penyesesuaianperioritas_heder.tgltrans)='".$_SESSION["anggaran_tahun"]."'
															   and SUBSTRING_INDEX(t_tampung.koderek50,'.',5)='".$rs6x->kode."' 
															   group by SUBSTRING_INDEX(t_tampung.koderek50,'.',6)
															   union all
															   select SUBSTRING_INDEX(usulanHonor_r_pak.koderek50,'.',6) as kode,'' as uraian,'' as anggaranlama,sum(usulanHonor_r_pak.nilai) as anggaranbaru 
															   from usulanHonor_h_pak,usulanHonor_r_pak
															   where usulanHonor_h_pak.notrans=usulanHonor_r_pak.notrans and year(usulanHonor_h_pak.tglTransaksi)='".$_SESSION["anggaran_tahun"]."'
															   and SUBSTRING_INDEX(usulanHonor_r_pak.koderek50,'.',5)='".$rs6x->kode."' 
															   group by SUBSTRING_INDEX(usulanHonor_r_pak.koderek50,'.',6)
															) as wew group by kode");
													?>
													<?php while($rs7x=$sql7x->fetch_object()){ 
														if($rs7x->anggaranbarux > 0){
													?>
													<tr>
														<td><a href="javascript:void(0)"; onClick="lihatbidang('<?php echo $rs7x->kode; ?>');"><?php echo $rs7x->kode; ?></a></td>
														<td><?php echo $rs7x->uraian; ?></td>
														<td align="right"><?php echo rpzx($rs7x->anggaranlamax); ?></td>
														<td align="right"><?php echo rpzx($rs7x->anggaranbarux); ?></td>
														<td align="right"><?php echo rpzx($rs7x->sisa); ?></td>
													</tr>
													<?php
														}
														$i++; $anggaranTotallamax=$anggaranTotallamax+$rs7x->anggaranlamax;
															  $anggaranTotalbarux=$anggaranTotalbarux+$rs7x->anggaranbarux;
															  $anggaranTotalsisax=$anggaranTotalsisax+$rs7x->sisa;
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
									<td align="right" nowrap="nowrap"><b><?php echo rpzx($anggaranTotallamax); ?></b></td>
									<td align="right" nowrap="nowrap"><b><?php echo rpzx($anggaranTotalbarux); ?></b></td>
									<td align="right" nowrap="nowrap"><b><?php echo rpzx($anggaranTotalsisax); ?></b></td>
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