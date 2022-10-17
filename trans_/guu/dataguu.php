<?php include("../../conn.php"); ?>
<?php

	$sql=$conn->query("select sppgu_heder.*,sppgu_rinci.nospj as nospj,sppgu_rinci.kegiatanblud as kegiatanblud,sum(sppgu_rinci.nilai) as nilai
						from sppgu_heder left join sppgu_rinci
						on sppgu_heder.nosppgu=sppgu_rinci.nosppgu 
						where year(sppgu_heder.tglsppgu)='".$_SESSION["anggaran_tahun"]."' group by sppgu_heder.nosppgu");

	$i=1;
?>
<br />

<table class="table table-hover table-bordered table table-striped" id="dataTables-example">
		<thead>
			<tr>
				<th>No.</th>
				<th align="center">NO. SPP GU</th>
				<th align="center">TGL SPP GU</th>
				<th align="center">TRIWULAN</th>
				<th align="center">BENDAHARA PENGELUARAN</th>
				<th align="center">BANK</th>
				<th align="center">NO. SPJ</th>
				<th align="center">KEGIATAN BLUD</th>
				<th align="center">TOTAL</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php while($rs=$sql->fetch_object()){ ?>
			<tr>
				<td><?php echo $i; ?></td>
				<td align="center"><a href="javascript:void(0)"; onClick="formguu('<?php echo $rs->nosppgu; ?>');"><?php echo $rs->nosppgu; ?></a></td>
				<td><?php echo out_tanggal('-',$rs->tglsppgu); ?></td>
				<td><?php echo $rs->triwulan; ?></td>
				<td><?php echo $rs->bendaharapengeluaran; ?></td>
				<td><?php echo $rs->namabank; ?></td>
				<td><?php echo $rs->nospj; ?></td>
				<td><?php echo $rs->kegiatanblud; ?></td>
				<td><?php echo rpzx($rs->nilai); ?></td>
				<?php if($rs->kunci == ''){ ?>
					<td>
						<a href="javascript:void(0)" onclick="hapusHeader('<?php echo $rs->nosppgu; ?>','<?php echo $rs->nokontrak; ?>')"><img src="images/hapus.png" width="20" height="20"></a>
						<a href="javascript:void(0)" onclick="kunci('<?php echo $rs->nosppgu; ?>','<?php echo "garis_".$i; ?>')"><span id="<?php echo "garis_".$i ?>"><img src="images/unlock.png" width="20" height="20"></span></a>
					</td>
				<?php }else{ ?>
					<?php if($_SESSION["anggaran_aksi"] == '1'){ ?>
						<td>
							<a href="javascript:void(0)" onclick="bukakunci('<?php echo $rs->nosppgu; ?>','<?php echo "garis_".$i; ?>')"><span id="<?php echo "garis_".$i ?>"><img src="images/keyxx.png" width="20" height="20"></span></a>	
						</td>
					<?php }else{ ?>
						<td>
							<img src="images/keyxx.png" width="20" height="20">
						</td>
					<?php } ?>
				<?php } ?>
			</tr>
			<?php
				$i++;
				}
			?>
		</tbody>
	</table>
<?php include("../../close.php"); ?>