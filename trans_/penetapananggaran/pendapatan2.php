<?php include("../../conn.php"); ?>
<?php
	$sql=$conn->query("select sum(nilai) as total from anggaran_pendapatan where tahun='".$_SESSION["anggaran_tahun"]."'");
	$rs=$sql->fetch_object();
	$i=1;
?>
<br />

<table class="table table-hover table-bordered table table-striped" id="dataTables-example">
		<thead>
			<tr>
				<th>KODE</th>
				<th>PROGRAM</th>
				<th>JUMLAH</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>4.1.04.16.01.0001</td>
				<td>PENDAPATAN BLUD</td>
				<td><?php echo rp($rs->total);?></td>
				<td><a href="javascript:void(0)" onclick="pendapatan_rinci()" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> View </a></td>
			</tr>
		</tbody>
</table>
<?php include("../../close.php"); ?>