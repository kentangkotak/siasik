<?php include("../../../conn.php"); ?>
<?php
	$sql1=$conn->query("select * from profil" );
	$rs1=$sql1->fetch_object();
	
	$tgl=in_tanggal("/",trim($_GET['tgl']));
	$tglx=in_tanggal("/",trim($_GET['tglx']));

	$tgl_1=explode( '-', $tgl );
	$thn=$tgl_1[0];
?>
<!--<a href="javascript:void(0)" onclick="ExportToExcel_rbabelanja()"><img src="images/excel.jpg" width="20" height="20">Export to Excel</a>
<div id="excel_repot_rbabelanja">-->
<?php
		$sql=$conn->query("select kodepptk,namapptk,kegiatan from mappingpptkkegiatan where tahun='".$thn."' group by kodepptk order by kodebidang,namapptk");
?>
<div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_title">
        <center>BADAN LAYANAN UMUM DAERAH <?php echo  $rs1->nama;?></br>
				LAPORAN MANAJERIAL ANGGARAN & REALISASI PER KODE REKENING108 </br>
				TAHUN <?php echo $thn;?> </center>
        <div class="clearfix"></div>
      </div>
        <div class="x_content">
			<table class="table table-bordered table-striped jambo_table bulk_action dt-head-center" id="datatable-buttons"> 
					<thead>
						<tr>
							<th rowspan="3" class="text-center">KODE 108</th>
							<th rowspan="3" class="text-center">URAIAN 108</th>
							<?php while($rs=$sql->fetch_object()){ ?>
								<?php
									$sqlz=$conn->query("select count(kodekegiatan) as jmlkegiatan from mappingpptkkegiatan where tahun='".$thn."' and kodepptk='".$rs->kodepptk."' order by kodebidang,namapptk");
								?>
								<?php while($rsz=$sqlz->fetch_object()){ $rsz->jmlkegiatan ; $jmlkegiatan=$rsz->jmlkegiatan*3;?>
									<th colspan="<?php echo $jmlkegiatan ;?>" class="text-center"><?php echo $rs->namapptk; ?></th>
								<?php $i++;} ?>
							<?php $i++;} ?>
						</tr>
						<tr>
						<?php
								$sqlq=$conn->query("select kodepptk,namapptk,kegiatan from mappingpptkkegiatan where tahun='".$thn."' group by kodepptk order by kodebidang,namapptk");
						?>
						<?php while($rsq=$sqlq->fetch_object()){ ?>
							<?php
									$sqlx=$conn->query("select kodepptk,namapptk,kegiatan from mappingpptkkegiatan where tahun='".$thn."' and kodepptk='".$rsq->kodepptk."' order by kegiatan");
							?>
							<?php while($rsx=$sqlx->fetch_object()){ ?>
								<td colspan="3" class="text-center"><?php echo $rsx->kegiatan; ?></td>
							<?php $i++;} ?>
						<?php $i++;} ?>
						</tr>
						<?php
							$sqlc=$conn->query("select count(kodekegiatan) as jmlkegiatan from mappingpptkkegiatan where tahun='".$thn."' order by kodebidang,namapptk");
							$rsc=$sqlc->fetch_object();
							$jmlkegiatanx=$rsc->jmlkegiatan;
						?>
						<tr>
							<?php for ($i = 1; $i <= $jmlkegiatanx; $i++){ ?>
							<td class="text-center">ANGGARAN</td>
							<td class="text-center">REALISASI</td>
							<td class="text-center">SALDO</td>
							<?php } ?>
						</tr>
					</thead>
					<tbody>
						<?php
								$sqlx=$conn->query("select koderek108 as kode,t_tampung.uraian108 as uraian from t_tampung where tgl= '".$thn."' GROUP by koderek108");
							
						?>
						<?php while($rsx=$sqlx->fetch_object()){ ?>
						<tr>
							<td><?php echo $rsx->kode; ?></td>
							<td><?php echo $rsx->uraian; ?></td>
							<?php
									$sqlkegiatan=$conn->query("select kodekegiatan,kegiatan from mappingpptkkegiatan where tahun='".$thn."' order by kodebidang,namapptk,kegiatan");
								
							?>
							<?php while($rskegiatan=$sqlkegiatan->fetch_object()){ ?>
								<?php
									$sqlhasil=$conn->query("select round(sum(anggaran),2) as anggaranx,round(sum(realisasi),2) as realisasix,round(sum(anggaran)-sum(realisasi),2) as saldo from(
															select sum(t_tampung.pagu) as anggaran,'' as realisasi
															from penyesesuaianperioritas_heder,t_tampung
															where penyesesuaianperioritas_heder.notrans=t_tampung.notrans 
															and year(penyesesuaianperioritas_heder.tgltrans)= '".$thn."'
															and t_tampung.koderek108='".$rsx->kode."' 
															and penyesesuaianperioritas_heder.kodekegiatan='".$rskegiatan->kodekegiatan."'
															UNION all
															select '' as anggaran,sum(npdls_rinci.totalls) as realisasi
															from npdls_heder,npdls_rinci,npkls_heder
															where npdls_heder.nonpdls=npdls_rinci.nonpdls and npdls_heder.nonpdls=npkls_heder.nonpdls
															and npkls_heder.tglpencairan >='".$tgl."' and npkls_heder.tglpencairan <='".$tglx."'
															and npdls_rinci.koderek108='".$rsx->kode."' and npdls_heder.kodekegiatanblud='".$rskegiatan->kodekegiatan."'
															union all
														   select '' as anggaran,sum(spjpanjar_rinci.jumlahbelanjapanjar) as realisasi
														   from spjpanjar_heder,spjpanjar_rinci
														   where spjpanjar_heder.nospjpanjar=spjpanjar_rinci.nospjpanjar and spjpanjar_heder.verif=1
														   and spjpanjar_heder.tglspjpanjar >='".$tgl."' and spjpanjar_heder.tglspjpanjar <='".$tglx."'
														   and spjpanjar_rinci.koderek108='".$rsx->kode."' and spjpanjar_heder.kodekegiatanblud='".$rskegiatan->kodekegiatan."'												   	
														) as wew");
								?>
								<?php while($rshasil=$sqlhasil->fetch_object()){ ?>
										<td align="right" nowrap="nowrap"><?php if($rshasil->anggaranx=='' || $rshasil->anggaranx==0){echo '';}else{ echo rpzx($rshasil->anggaranx);}?></td>
										<td align="right" nowrap="nowrap"><?php if($rshasil->realisasix=='' || $rshasil->realisasix==0){echo '';}else{ echo rpzx($rshasil->realisasix);}?></td>
										<td align="right" nowrap="nowrap"><?php if($rshasil->saldo=='' || $rshasil->saldo==0){echo '';}else{ echo rpzx($rshasil->saldo);}?></td>
								<?php
									$i++;
									}
								?>
							<?php
								$i++;
								}
							?>
						</tr>
						<?php
							$i++;
							}
						?>
					</tbody>
			</table>
			</br>
</div>
<?php include("../../../close.php"); ?>