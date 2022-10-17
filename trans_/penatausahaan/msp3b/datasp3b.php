<?php include("../../../conn.php"); ?>
<?php

	$sql=$conn->query("select nosp3b,tanggal,month(bulan_realisasi) as bulan,year(bulan_realisasi) as tahun,pendapatan as pendapatan,
						realisasi as realisasi,kunci as kunci from sp3b where year(tanggal)='".$_SESSION["anggaran_tahun"]."'");
	$i=1;
?>
<br />

<table class="table table-hover table-bordered table table-striped" id="dataTables-example">
		<thead>
			<tr>
				<th>No.</th>
				<th align="center">NO.SP3B</th>
				<th align="center">TANGGAL</th>
				<th align="center">TANGGAL REALISASI</th>
				<th align="center">PENDAPATAN</th>
				<th align="center">REALISASI</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php while($rs=$sql->fetch_object()){ ?>
			<tr>
				<td><?php echo $i; ?></td>
				<td><?php echo $rs->nosp3b; ?></td>
				<td><?php echo $rs->tanggal; ?></td>
				<td><?php echo bulan($rs->bulan)." ".$rs->tahun; ?></td>
				<td align="right"><?php echo rpzx($rs->pendapatan); ?></td>
				<td align="right"><?php echo rpzx($rs->realisasi) ?></td>
				<?php if($rs->kunci == ''){ ?>
				<td>
					<a href="javascript:void(0)" onclick="kunci('<?php echo $rs->nosp3b; ?>','<?php echo "garis_".$i; ?>')"><span id="<?php echo "garis_".$i ?>"><img src="images/unlock.png" width="20" height="20"></span></a>
				</td>
				<?php }else{ ?>
				<td>
					<a href="javascript:void(0)" onclick="cetaksp3b('<?php echo $rs->nosp3b; ?>','<?php echo "garis_".$i; ?>')"><span id="<?php echo "garis_".$i ?>"><img src="images/print.png" width="20" height="20"></span></a>
				</td>
				<?php }?>
			</tr>
			<?php
				$i++;
				}
			?>
		</tbody>
	</table>
<?php include("../../../close.php"); ?>