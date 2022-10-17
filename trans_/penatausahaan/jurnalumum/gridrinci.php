<?php include("../../../conn.php"); ?>
<?php
	$sql=$conn->query("select * from jurnalumum_rinci where nobukti='".$_GET['nobukti']."'");
	$i=1;
?>
<div id="contentPagu"></div>
<table class="table table-hover table-bordered table table-striped" id="dataTables-example">
		<thead>
			<tr>
				<th>No.</th>
				<th>KODE PSAP 13 </th>
				<th>URAIAN PSAP 13</th>
				<th>DEBET</th>
				<th>KREDIT</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php while($rs=$sql->fetch_object()){ ?>
			<tr>
				<td><?php echo $i; ?></td>
				<td><?php echo $rs->kodepsap13; ?></td>
				<td><?php echo $rs->uraianpsap13; ?></td>
				<td align="right"><?php echo rpzx($rs->debet); ?></td>
				<td align="right"><?php echo rpzx($rs->kredit); ?></td>
				<td>
				<?php if($rs->verif ==''){ ?>
					<a href="javascript:void(0)" onclick="hapus_rinci('<?php echo $rs->id; ?>')"><img src="images/hapus.png" width="20" height="20"></a>
				</td>
				<?php } ?>
			</tr>
			<?php $i++; $subtotaldebet=$subtotaldebet+$rs->debet;$subtotalkredit=$subtotalkredit+$rs->kredit;}
			?>
			<tr>
				<td colspan="3" align="right">SUBTOTAL</td>
				<td align="right"><?php echo rpzx($subtotaldebet); ?></td>
				<td align="right"><?php echo rpzx($subtotalkredit); ?></td>
			</tr>
		</tbody>
	</table>
<?php include("../../../close.php"); ?>