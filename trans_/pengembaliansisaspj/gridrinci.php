<?php include("../../conn.php"); ?>
<?php
	$sql=$conn->query("select * from pengembaliansisapanjar_rinci where nopengembaliansisapanjar='".$_GET['nopengembaliansisapanjar']."'");
	$i=1;
?>
<div id="contentPagu"></div>
<table class="table table-hover table-bordered table table-striped" id="dataTables-example">
		<thead>
			<tr>
				<th>No.</th>
				<th>KODE REKENING BELANJA </th>
				<th>RINCIAN BELANJA </th>
				<th>ITEM BELANJA</th>
				<th>JUMLAH ANGGARAN</th>
				<th>JUMLAH PENERIMAAN PANJAR</th>
				<th>JUMLAH BELANJA PANJAR</th>
				<th>SISA PANJAR</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php while($rs=$sql->fetch_object()){ ?>
			<tr>
				<td><?php echo $i; ?></td>
				<td><?php echo $rs->koderek50; ?></td>
				<td><?php echo $rs->rincianbelanja50; ?></td>
				<td><?php echo $rs->itembelanja; ?></td>
				<td align="right"><?php echo rp($rs->jumlahanggaran); ?></td>
				<td align="right"><?php echo rp($rs->jumlahpenerimaanpanjar); ?></td>
				<td align="right"><?php echo rp($rs->jumlahbelanjapanjar); ?></td>
				<td align="right"><?php echo rp($rs->sisapanjar); ?></td>
				<td>
					<a href="javascript:void(0)" onclick="hapus_rinci('<?php echo $rs->id; ?>','<?php echo $rs->nopengembaliansisapanjar; ?>','<?php echo $rs->idspj; ?>')"><img src="images/hapus.png" width="20" height="20"></a>
				</td>
			</tr>
			<?php $i++;}
			?>
		</tbody>
	</table>
<?php include("../../close.php"); ?>