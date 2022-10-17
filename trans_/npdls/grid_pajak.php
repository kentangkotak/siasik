<?php include("../../conn.php"); ?>
<?php
	$sqlpajak=$conn->query("select * from npdls_pajak where nonpdls='".$_GET['nonpd']."' ");
	$rspajak=$sqlpajak->fetch_object();
?>
<table class="table table-hover table-bordered table table-striped">
	<thead>
		<tr>
			<th>KODE REKENING </th>
			<th>PAJAK</th>
			<th>NILAI</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td><?php echo $rspajak->koderekening; ?></td>
			<td>Utang PPH 21</td>
			<td align="right"><?php echo rpzx($rspajak->pph21); ?></td>
		</tr>
		<tr>
			<td><?php echo $rspajak->koderekening; ?></td>
			<td>Utang PPH 22</td>
			<td align="right"><?php echo rpzx($rspajak->pph22); ?></td>
		</tr>
		<tr>
			<td><?php echo $rspajak->koderekening; ?></td>
			<td>Utang PPH 23</td>
			<td align="right"><?php echo rpzx($rspajak->pph23); ?></td>
		</tr>
		<tr>
			<td><?php echo $rspajak->koderekening; ?></td>
			<td>Utang PPH 25</td>
			<td align="right"><?php echo rpzx($rspajak->pph25); ?></td>
		</tr>
		<tr>
			<td><?php echo $rspajak->koderekening; ?></td>
			<td>Utang Pajak Pasal 4 Ayat 2</td>
			<td align="right"><?php echo rpzx($rspajak->pasal4); ?></td>
		</tr>
		<tr>
			<td><?php echo $rspajak->koderekening; ?></td>
			<td>Utang PPN Pusat</td>
			<td align="right"><?php echo rpzx($rspajak->ppnpusat); ?></td>
		</tr>
		<tr>
			<td><?php echo $rspajak->koderekening; ?></td>
			<td>Utang Pajak Daerah</td>
			<td align="right"><?php echo rpzx($rspajak->pajakdaerah); ?></td>
		</tr>
	</tbody>
</table>
<?php include("../../close.php"); ?>