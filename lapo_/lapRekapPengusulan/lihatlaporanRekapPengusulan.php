<?php include("../../conn.php"); ?>
<?php
	
		$sql=$conn->query("SELECT bidang,kegiatan,uraian,volume,harga,total from(
							select usulanHonor_h.ruangan as bidang,usulanHonor_h.kegiatan as kegiatan,usulanHonor_r.keterangan as uraian,usulanHonor_r.volume as volume,usulanHonor_r.harga as harga,
							usulanHonor_r.nilai as total from usulanHonor_h,usulanHonor_r
							where usulanHonor_h.notrans=usulanHonor_r.notrans and year(usulanHonor_h.tglTransaksi)='".$_GET['thn']."') as wew group by bidang");

	$i=1;

?>
<a href="javascript:void(0)" onclick="ExportToExcel_laporanRekapPengusulan()"><img src="images/excel.jpg" width="20" height="20">Export to Excel</a>
<div id="excel_repot_laporanRekapPengusulan">
<div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>LAPORAN REKAP PENGUSULAN TAHUN <?php echo  $_GET['thn'];?></h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
			<table class="table table-hover table table-striped"> 
					<thead>
						<tr>
							<th nowrap="nowrap"></th>
							<th nowrap="nowrap">URAIAN</th>
							<th nowrap="nowrap">VOLUME</th>
							<th nowrap="nowrap">SATUAN</th>
							<th nowrap="nowrap">TOTAL</th>
						</tr>
					</thead>
					<tbody>
						<?php while($rs=$sql->fetch_object()){ ?>
						<tr>
							<td align="center" style="background-color: yellow;"></td>
							<td style="background-color: yellow;"><?php echo $rs->bidang; ?></td>
							<td style="background-color: yellow;"></td>
							<td style="background-color: yellow;"></td>
							<td style="background-color: yellow;"></td>
						</tr>
						
							<?php
							$sqlx=$conn->query("SELECT bidang,kegiatan,uraian,volume,harga,total from(
												select usulanHonor_h.ruangan as bidang,usulanHonor_h.kegiatan as kegiatan,usulanHonor_r.keterangan as uraian,usulanHonor_r.volume as volume,usulanHonor_r.harga as harga,
												sum(usulanHonor_r.nilai) as total from usulanHonor_h,usulanHonor_r
												where usulanHonor_h.notrans=usulanHonor_r.notrans and year(usulanHonor_h.tglTransaksi)='".$_GET['thn']."' and usulanHonor_h.ruangan='".$rs->bidang."' group by usulanHonor_h.kegiatan) as wew ");
							?>
							<?php while($rsx=$sqlx->fetch_object()){ ?>
							<tr>
								<td align="center"></td>
								<td> <?php echo $rsx->kegiatan; ?></td>
								<td></td>
								<td></td>
								<td align="right"><?php echo rp($rsx->total); ?></td>
							</tr>
									<?php
									$sqlxx=$conn->query("SELECT bidang,kegiatan,uraian,volume,harga,total from(
														select usulanHonor_h.ruangan as bidang,usulanHonor_h.kegiatan as kegiatan,usulanHonor_r.keterangan as uraian,usulanHonor_r.volume as volume,usulanHonor_r.harga as harga,
														usulanHonor_r.nilai as total from usulanHonor_h,usulanHonor_r
														where usulanHonor_h.notrans=usulanHonor_r.notrans and year(usulanHonor_h.tglTransaksi)='".$_GET['thn']."' and usulanHonor_h.kegiatan='".$rsx->kegiatan."' ) as wew ");
									?>
									<?php while($rsxx=$sqlxx->fetch_object()){ ?>
									<tr>
										<td align="center"></td>
										<td><?php echo $rsxx->uraian; ?></td>
										<td align="right"><?php echo round($rsxx->volume); ?></td>
										<td align="right"><?php echo rp($rsxx->harga); ?></td>
										<td align="right"><?php echo rp($rsxx->total); ?></td>
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