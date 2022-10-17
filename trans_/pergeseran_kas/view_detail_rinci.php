<?php include("../../conn.php"); ?>
<?php
	$sql=$conn->query("select * from pergeseranTrinci where notrans='".$_GET['notrans']."'");
	$i=1;
?>
<div id="contentPagu"></div>
<table class="table table-hover table-bordered table table-striped" id="dataTables-example">
		<thead>
			<tr>
				<th>No.</th>
				<th>NO. NPK</th>
				<th>KETERANGAN</th>
				<th>TOTAL</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php while($rs=$sql->fetch_object()){ ?>
			<tr>
				<td><?php echo $i; ?></td>
				<td><?php echo $rs->nonpk; ?></td>
				<td><?php echo $rs->keterangan; ?></td>
				<td align="right"><?php echo rp($rs->jumlah); ?></td>
				<td>
					 <!--<a href="javascript:void(0)" onclick="hapus_rinci('<?php echo $rs->id; ?>','<?php echo $rs->nonpk; ?>','<?php echo $rs->nopp; ?>','<?php echo $rs->nousulan; ?>',
					'<?php echo $rs->koderek50; ?>','<?php echo $rs->itembelanja; ?>')"><img src="images/hapus.png" width="20" height="20"></a>-->
				</td>
			</tr>
			<?php $i++; $subtotal=$subtotal+$rs->jumlah;}
			?>
			<tr>
				<td colspan="3">Subtotal</td>
				<td><?php echo rpzx($subtotal);?></td>
			</tr>
		</tbody>
	</table>
<?php include("../../close.php"); ?>