<?php include("../../conn.php"); ?>
<?php
	
	$sql=$conn->query("select * from transsppup where kunci=1 and verif='1' and year(tglTrans)='".$_SESSION["anggaran_tahun"]."'");
	$i=1;
?>
<br />

<table class="table table-hover table-bordered table table-striped" id="dataTables-example">
		<thead>
			<tr>
				<th>No.</th>
				<th>NO SPP UP </th>
				<th>TANGGAL TRANSAKSI </th>
				<th>BENDAHARA PENGELUARAN</th>
				<th>JUMLAH SPP</th>
				<th>BANK</th>
				<th>NO REK</th>
			</tr>
		</thead>
		<tbody>
			<?php while($rs=$sql->fetch_object()){ ?>
			<tr>
				<td><?php echo $i; ?></td>
				<td><?php echo $rs->nosppup; ?></td>
				<td><?php echo $rs->tglTrans; ?></td>
				<td><?php echo $rs->bendaharaKeluar; ?></td>
				<td><?php echo rp($rs->jumlahspp); ?></td>
				<td><?php echo $rs->bank; ?></td>
				<td><?php echo $rs->kodeRek; ?></td>
			</tr>
			<?php
				$i++;
				}
			?>
		</tbody>
	</table>
<?php include("../../close.php"); ?>