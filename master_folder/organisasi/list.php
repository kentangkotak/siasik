<?php include("../../conn.php"); ?>
<head>
	<link href="../../vendors/nprogress/nprogress.css" rel="stylesheet">
</head>
<?php

	$sql=$conn->query("select * from organisasi where hidden is null or hidden='' order by kode1,kode2,kode3,kode4");
	$i=1;
?>
<br />

<table class="table table-hover table-bordered table table-striped" id="dataTables-example">
		<thead>
			<tr>
				<th>No.</th>
				<th>Kode 1</th>
				<th>Kode 2</th>
				<th>Kode 3</th>
				<th>Kode 4</th>
				<th>Nama Organisasi</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php while($rs=$sql->fetch_object()){ ?>
			<tr>
				<td align="center"><?php echo $i; ?></td>		
				<td align="center"><?php echo $rs->kode1; ?></td>
				<td align="center"><?php echo $rs->kode2; ?></td>
				<td align="center"><?php echo $rs->kode3; ?></td>
				<td align="center"><?php echo $rs->kode4; ?></td>
				<td><?php echo $rs->nama; ?></td>
				<td><a href="javascript:void(0)" onclick="hapus('<?php echo $rs->id; ?>')"><img src="images/hapus.png" width="20" height="20"></a></td>
			</tr>
			<?php
				$i++;
				}
			?>
		</tbody>
	</table>
<script src="../../vendors/nprogress/nprogress.js"></script>
<?php include("../../close.php"); ?>