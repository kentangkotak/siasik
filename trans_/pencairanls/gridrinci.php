<?php include("../../conn.php"); ?>
<?php
	$sql=$conn->query("select * from npkls_rinci where nonpk='".$_GET['nonpk']."'");
	$i=1;
?>
<div id="contentPagu"></div>
<table class="table table-hover table-bordered table table-striped" id="dataTables-example">
		<thead>
			<tr>
				<th>No.</th>
				<th>NO NPD</th>
				<th>TANGGAL</th>
				<th>KEGIATAN</th>
				<th>KEGIATAN BLUD</th>
				<th>TOTAL</th>
			</tr>
		</thead>
		<tbody>
			<?php while($rs=$sql->fetch_object()){ ?>
			<tr>
				<td><?php echo $i; ?></td>
				<td><?php echo $rs->nonpdls; ?></td>
				<td><?php echo out_tanggal('-',$rs->tglnpd); ?></td>
				<td><?php echo $rs->kegiatan; ?></td>
				<td><?php echo $rs->kegiatanblud; ?></td>
				<td align="right"><?php echo rp($rs->total); ?></td>
			</tr>
			<?php $i++; $subtotal=$subtotal+$rs->total;}
			?>
			<tr class="bodylist" valign="top";>
				<td colspan="5" align="right"><b>TOTAL</b></td>
				<td colspan="6" align="right"><?php echo rpzx($subtotal); ?></td>
			</tr>
		</tbody>
	</table>
<?php include("../../close.php"); ?>