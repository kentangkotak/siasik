<?php include("../../conn.php"); ?>
<head>
	<link href="../../vendors/nprogress/nprogress.css" rel="stylesheet">
</head>
<?php

	$sql=$conn->query("select * from loging order by tgl desc");
	$i=1;
?>
<br />

<table class="table table-hover table-bordered table table-striped" id="dataTables-example">
		<thead>
			<tr>
				<th>Tgl</th>
				<th>Konten</th>
				<th>User</th>
				<th>Tabel</th>
			</tr>
		</thead>
		<tbody>
			<?php while($rs=$sql->fetch_object()){ ?>
			<tr>		
				<td><?php echo $rs->tgl; ?></td>
				<td><?php echo $rs->content; ?></td>
				<td><?php echo $rs->userId; ?></td>
				<td><?php echo $rs->tbl; ?></td>
			</tr>
			<?php
				$i++;
				}
			?>
		</tbody>
	</table>
<script src="../../vendors/nprogress/nprogress.js"></script>
<?php include("../../close.php"); ?>