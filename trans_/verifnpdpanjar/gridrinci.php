<?php include("../../conn.php"); ?>
<?php
	$sql=$conn->query("select npdpanjar_heder.nonpdpanjar as nonpdpanjar,npdpanjar_rinci.koderek50 as koderek50,npdpanjar_rinci.rincianbelanja50 as rincianbelanja50,
						npdpanjar_rinci.itembelanja as itembelanja,npdpanjar_rinci.totalpermintaanpanjar as total from npdpanjar_heder,npdpanjar_rinci 
						where npdpanjar_heder.nonpdpanjar=npdpanjar_rinci.nonpdpanjar and npdpanjar_heder.nonpdpanjar='".$_GET['nonpdpanjar']."' and npdpanjar_heder.kunci=1 ");
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
				<th>TOTAL</th>
			</tr>
		</thead>
		<tbody>
			<?php while($rs=$sql->fetch_object()){ ?>
			<tr>
				<td><?php echo $i; ?></td>
				<td><?php echo $rs->koderek50; ?></td>
				<td><?php echo $rs->rincianbelanja50; ?></td>
				<td><?php echo $rs->itembelanja; ?></td>
				<td align="right"><?php echo rpzx($rs->total); ?></td>
			</tr>
			<?php $i++; $subtotal=$subtotal+$rs->total;}?>
			<tr class="bodylist" valign="top";>
				<td colspan="4" align="right"><b>TOTAL</b></td>
				<td colspan="4" align="right"><?php echo rpzx($subtotal); ?></td>
			</tr>	
		</tbody>
	</table>
<?php include("../../close.php"); ?>