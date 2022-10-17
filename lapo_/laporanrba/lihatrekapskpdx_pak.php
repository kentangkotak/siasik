<?php include("../../conn.php"); ?>
<?php
	$sql=$conn->query("select kode79,uraian79,round(sum(anggaranlama),2) as anggaranlamax,round(sum(anggaranbaru),2) as anggaranbarux,round(sum(anggaranbaru)-sum(anggaranlama),2) as sisa from(			
								SELECT pendamap7950.kode79 as kode79,pendamap7950.uraian79 as uraian79,sum(anggaran_pendapatan.nilai) as anggaranlama,'' as anggaranbaru
								FROM pendamap7950
								LEFT JOIN anggaran_pendapatan
								ON pendamap7950.kode79 = anggaran_pendapatan.kode79 
								and anggaran_pendapatan.tahun='".$_SESSION["anggaran_tahun"]."'
								union all
								SELECT pendamap7950.kode79 as kode79,pendamap7950.uraian79 as uraian79,'' as anggaranlama,sum(anggaran_pendapatan_pak.nilai) as anggaranbaru
								FROM pendamap7950
								LEFT JOIN anggaran_pendapatan_pak
								ON pendamap7950.kode79 = anggaran_pendapatan_pak.kode79 
								and anggaran_pendapatan_pak.tahun='".$_SESSION["anggaran_tahun"]."'
						) as wew group by kode79");

?>
<a href="javascript:void(0)" onclick="ExportToExcel_rbarekapitulasi()"><img src="images/excel.jpg" width="20" height="20">Export to Excel</a>
<div id="excel_repot_rekapitulasi">
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <center>BADAN LAYANAN UMUM DAERAH <?php echo  $rs1->nama;?></br>
				RENCANA BISNIS DAN ANGGARAN PENDAPATAN DAN BELANJA </br>
				UNTUK TAHUN YANG BERAKHIR SAMPAI 31 DESEMBER  <?php echo  $_SESSION["anggaran_tahun"];?> </center>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
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
						<?php while($rs=$sql->fetch_object()){ 
			?>
						<tr>
							<td><?php echo $rs->kode79; ?></td>
							<td><?php echo $rs->uraian79; ?></td>
							<td align="right"><?php echo rpzx($rs->anggaranlamax); ?></td>
							<td align="right"><?php echo rpzx($rs->anggaranbarux); ?></td>
							<td align="right"><?php echo rpzx($rs->sisa); ?></td>
						</tr>
						
							<?php
							$sqlx=$conn->query("SELECT * from pendamap7950 where level3='' and level2<>'' and level1=4");
							?>
							<?php while($rsx=$sqlx->fetch_object()){ 
								$sqlxx=$conn->query("select kode79,uraian79,round(sum(anggaranlama),2) as anggaranlamax,round(sum(anggaranbaru),2) as anggaranbarux,round(sum(anggaranbaru)-sum(anggaranlama),2) as sisa from(	
								SELECT pendamap7950.kode79 as kode79,pendamap7950.uraian79 as uraian79,sum(anggaran_pendapatan.nilai) as anggaranlama,'' as anggaranbaru 
								from pendamap7950,anggaran_pendapatan 
								where pendamap7950.kode79 = anggaran_pendapatan.kode79 and concat(pendamap7950.level1,'.',pendamap7950.level2)='".$rsx->kode79."'
								and anggaran_pendapatan.tahun='".$_SESSION["anggaran_tahun"]."'
								union all
								SELECT pendamap7950.kode79 as kode79,pendamap7950.uraian79 as uraian79,'' as anggaranlama,sum(anggaran_pendapatan_pak.nilai) as anggaranbaru 
								from pendamap7950,anggaran_pendapatan_pak 
								where pendamap7950.kode79 = anggaran_pendapatan_pak.kode79 and concat(pendamap7950.level1,'.',pendamap7950.level2)='".$rsx->kode79."'
								and anggaran_pendapatan_pak.tahun='".$_SESSION["anggaran_tahun"]."'
								) as pendapatan");
								$rsxx=$sqlxx->fetch_object();
							?>
							<tr>
								<td><?php echo $rsx->kode79; ?></td>
								<td><?php echo $rsx->uraian79; ?></td>
								<td align="right"><?php echo rpzx($rsxx->anggaranlamax); ?></td>
								<td align="right"><?php echo rpzx($rsxx->anggaranbarux); ?></td>
								<td align="right"><?php echo rpzx($rsxx->sisa); ?></td>
							</tr>
							<?php
							$sqlxx=$conn->query("select kode79,uraian79,round(sum(anggaranlama),2) as anggaranlamax,round(sum(anggaranbaru),2) as anggaranbarux,round(sum(anggaranbaru)-sum(anggaranlama),2) as sisa from(
								SELECT pendamap7950.kode79 as kode79,pendamap7950.uraian79 as uraian79,sum(anggaran_pendapatan.nilai) as anggaranlama,'' as anggaranbaru
								FROM pendamap7950
								LEFT JOIN anggaran_pendapatan
								ON pendamap7950.kode79 = anggaran_pendapatan.kode79 where pendamap7950.kelompok='".$rsx->kode79."' 
								and anggaran_pendapatan.tahun='".$_SESSION["anggaran_tahun"]."'
								group by pendamap7950.kode79
								union all
								SELECT pendamap7950.kode79 as kode79,pendamap7950.uraian79 as uraian79,'' as anggaranlama,sum(anggaran_pendapatan_pak.nilai) as anggaranbaru
								FROM pendamap7950
								LEFT JOIN anggaran_pendapatan_pak
								ON pendamap7950.kode79 = anggaran_pendapatan_pak.kode79 where pendamap7950.kelompok='".$rsx->kode79."' 
								and anggaran_pendapatan_pak.tahun='".$_SESSION["anggaran_tahun"]."'
								group by pendamap7950.kode79 ) as wew");
							?>
							<?php while($rsxx=$sqlxx->fetch_object()){ if($rsxx->anggaranlamax > 0){?>
							<tr>
								<td><?php echo $rsxx->kode79; ?></td>
								<td><?php echo $rsxx->uraian79; ?></td>
								<td align="right"><?php echo rpzx($rsxx->anggaranlamax); ?></td>
								<td align="right"><?php echo rpzx($rsxx->anggaranbarux); ?></td>
								<td align="right"><?php echo rpzx($rsxx->sisa); ?></td>
							</tr>
							<?php
							}
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
							$sqlsilpa=$conn->query("select kode79,uraian79,round(sum(anggaranlama),2) as anggaranlamax,round(sum(anggaranbaru),2) as anggaranbarux,round(sum(anggaranbaru)-sum(anggaranlama),2) as sisa from(
													select pendamap7950.kode79,pendamap7950.uraian79 as uraian79,'' as anggaranlama,sum(silpa.nominal) as anggaranbaru
													FROM pendamap7950,silpa
													where pendamap7950.kode79=6 and SUBSTRING_INDEX(silpa.kode79,'.',1)=pendamap7950.kode79 
													and silpa.tahun=".$_SESSION["anggaran_tahun"]."
													) as silpa");
						?>
						<?php while($rssilpa=$sqlsilpa->fetch_object()){ ?>
						<tr>
							<td><?php echo $rssilpa->kode79; ?></td>
							<td><?php echo $rssilpa->uraian79; ?></td>
							<td align="right"><?php echo rpzx($rssilpa->anggaranlamax); ?></td>
							<td align="right"><?php echo rpzx($rssilpa->anggaranbarux); ?></td>
							<td align="right"><?php echo rpzx($rssilpa->sisa); ?></td>
						</tr>
							<?php
								$sqlsilpax=$conn->query("select kode79,uraian79,round(sum(anggaranlama),2) as anggaranlamax,round(sum(anggaranbaru),2) as anggaranbarux,round(sum(anggaranbaru)-sum(anggaranlama),2) as sisa from(
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
							<?php while($rssilpax=$sqlsilpax->fetch_object()){ ?>
							<tr>
								<td><?php echo $rssilpax->kode79; ?></td>
								<td><?php echo $rssilpax->uraian79; ?></td>
								<td align="right"><?php echo rpzx($rssilpax->anggaranlamax); ?></td>
								<td align="right"><?php echo rpzx($rssilpax->anggaranbarux); ?></td>
								<td align="right"><?php echo rpzx($rssilpax->sisa); ?></td>
							</tr>
								<?php
									$sqlsilpax=$conn->query("select kode79,uraian79,round(sum(anggaranlama),2) as anggaranlamax,round(sum(anggaranbaru),2) as anggaranbarux,round(sum(anggaranbaru)-sum(anggaranlama),2) as sisa from(
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
								<?php while($rssilpax=$sqlsilpax->fetch_object()){ ?>
								<tr>
									<td><?php echo $rssilpax->kode79; ?></td>
									<td><?php echo $rssilpax->uraian79; ?></td>
									<td align="right"><?php echo rpzx($rssilpax->anggaranlamax); ?></td>
									<td align="right"><?php echo rpzx($rssilpax->anggaranbarux); ?></td>
									<td align="right"><?php echo rpzx($rssilpax->sisa); ?></td>
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
							$sql1=$conn->query("select kode79,uraian79,round(sum(anggaranlama),2) as anggaranlamax,round(sum(anggaranbaru),2) as anggaranbarux,round(sum(anggaranbaru)-sum(anggaranlama),2) as sisa from(
												SELECT '5' as kode79,'Belanja' as uraian79,sum(t_tampung.pagu) as anggaranlama,'' as anggaranbaru
													FROM pendamap7950x,t_tampung,penyesesuaianperioritas_heder
													where t_tampung.notrans=penyesesuaianperioritas_heder.notrans and 
													t_tampung.koderek50=pendamap7950x.kode50 
													and year(penyesesuaianperioritas_heder.tgltrans)='".$_SESSION["anggaran_tahun"]."'
													union all
													SELECT '5' as kode79,'Belanja' as uraian79,'' as anggaranlama,sum(usulanHonor_r_pak.nilai) as anggaranlama
													from usulanHonor_h_pak,usulanHonor_r_pak
													where usulanHonor_h_pak.notrans=usulanHonor_r_pak.notrans and year(usulanHonor_h_pak.tglTransaksi)=".$_SESSION["anggaran_tahun"]."
												) as belanja" );

						?>
						<?php while($rs1=$sql1->fetch_object()){ ?>
						<tr>
							<td><?php echo $rs1->kode79; ?></td>
							<td><?php echo $rs1->uraian79; ?></td>
							<td align="right"><?php echo rpzx($rs1->anggaranlamax); ?></td>
							<td align="right"><?php echo rpzx($rs1->anggaranbarux); ?></td>
							<td align="right"><?php echo rpzx($rs1->sisa); ?></td>
						</tr>
							<?php
								$sql2x=$conn->query("select kode79,uraian79,round(sum(anggaranlama),2) as anggaranlamax,round(sum(anggaranbaru),2) as anggaranbarux,round(sum(anggaranbaru)-sum(anggaranlama),2) as sisa from(
									SELECT kode79 as kode79,uraian79 as uraian79,'' as anggaranlama,'' as anggaranbaru
									 from pendamap7950x where kelompok=5
									 union all
									SELECT SUBSTRING_INDEX(pendamap7950x.kode79,'.',2) as kode79,pendamap7950x.uraian79 as uraian79,sum(t_tampung.pagu) as anggaranlama,'' as anggaranbaru 
									from pendamap7950x,t_tampung,penyesesuaianperioritas_heder
									where pendamap7950x.kode50 = t_tampung.koderek50 and t_tampung.notrans=penyesesuaianperioritas_heder.notrans
									and concat(pendamap7950x.level1)='".$rs1->kode79."' and year(penyesesuaianperioritas_heder.tgltrans)='".$_SESSION["anggaran_tahun"]."'
									group by SUBSTRING_INDEX(pendamap7950x.kode79,'.',2)
									union all
									SELECT SUBSTRING_INDEX(pendamap7950x.kode79,'.',2) as kode79,pendamap7950x.uraian79 as uraian79,'' as anggaranlama,sum(usulanHonor_r_pak.nilai) as anggaranbaru
									from pendamap7950x,usulanHonor_h_pak,usulanHonor_r_pak
									where pendamap7950x.kode50 = usulanHonor_r_pak.koderek50 and concat(pendamap7950x.level1)='".$rs1->kode79."' and
									usulanHonor_h_pak.notrans=usulanHonor_r_pak.notrans and year(usulanHonor_h_pak.tglTransaksi)='".$_SESSION["anggaran_tahun"]."'
									group by SUBSTRING_INDEX(pendamap7950x.kode79,'.',2)
									) as belanja group by kode79");
							?>
							<?php while($rs2x=$sql2x->fetch_object()){?>
							<tr>
								<td><?php echo $rs2x->kode79; ?></td>
								<td><?php echo $rs2x->uraian79; ?></td>
								<td align="right"><?php echo rpzx($rs2x->anggaranlamax); ?></td>
								<td align="right"><?php echo rpzx($rs2x->anggaranbarux); ?></td>
								<td align="right"><?php echo rpzx($rs2x->sisa); ?></td>
							</tr>
								<?php
									$sql3x=$conn->query("select kode79,uraian79,round(sum(anggaranlama),2) as anggaranlamax,round(sum(anggaranbaru),2) as anggaranbarux,round(sum(anggaranbaru)-sum(anggaranlama),2) as sisa from(
										SELECT SUBSTRING_INDEX(pendamap7950x.kode79,'.',3) as kode79,pendamap7950x.uraian79 as uraian79,sum(t_tampung.pagu) as anggaranlama,'' as anggaranbaru 
										from pendamap7950x,t_tampung,penyesesuaianperioritas_heder
										where pendamap7950x.kode50 = t_tampung.koderek50 and t_tampung.notrans=penyesesuaianperioritas_heder.notrans
										and concat(pendamap7950x.level1,'.',pendamap7950x.level2)='".$rs2x->kode79."' and year(penyesesuaianperioritas_heder.tgltrans)='".$_SESSION["anggaran_tahun"]."'
										group by SUBSTRING_INDEX(pendamap7950x.kode79,'.',3)
										union all
										SELECT SUBSTRING_INDEX(pendamap7950x.kode79,'.',3) as kode79,pendamap7950x.uraian79 as uraian79,'' as anggaranlama,sum(usulanHonor_r_pak.nilai) as anggaranbaru
										from pendamap7950x,usulanHonor_h_pak,usulanHonor_r_pak
										where pendamap7950x.kode50 = usulanHonor_r_pak.koderek50 and concat(pendamap7950x.level1,'.',pendamap7950x.level2)='".$rs2x->kode79."' and
										usulanHonor_h_pak.notrans=usulanHonor_r_pak.notrans and year(usulanHonor_h_pak.tglTransaksi)='".$_SESSION["anggaran_tahun"]."'
										group by SUBSTRING_INDEX(pendamap7950x.kode79,'.',3)
										) as belanja group by kode79");
								?>
								<?php while($rs3x=$sql3x->fetch_object()){ ?>
								<tr>
									<td><?php echo $rs3x->kode79; ?></td>
									<td><?php echo $rs3x->uraian79; ?></td>
									<td align="right"><?php echo rpzx($rs3x->anggaranlamax); ?></td>
									<td align="right"><?php echo rpzx($rs3x->anggaranbarux); ?></td>
									<td align="right"><?php echo rpzx($rs2x->sisa); ?></td>
								</tr>	
								<?php
									$i++;}
								?>
							<?php
								$i++;}
							?>
						<?php
								$i++;}
						?>
					</tbody>
			</table>
	 </div>
</div>
</div>
<?php include("../../close.php"); ?>