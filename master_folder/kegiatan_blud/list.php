<?php include("../../conn.php"); ?>
<head>
	<link href="vendors/nprogress/nprogress.css" rel="stylesheet">
</head>
<?php

	$sql=$conn->query("select * from kegiatan_blud where flag<>'1' and tahun='".$_SESSION["anggaran_tahun"]."'");
	$i=1;
?>
<br />

<table class="table table-hover table-bordered table table-striped" id="dataTables-example">
		<thead>
			<tr>
				<th>No.</th>
				<th>Nomenklatur</th>
				<th>Prioritas</th>
				<th>Organisasi</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php while($rs=$sql->fetch_object()){ ?>
			<tr>	
				<td><?php echo $rs->no; ?></td>
				<td><?php echo $rs->nomenklatur; ?></td>
				<td><?php echo $rs->prioritas; ?></td>
				<td><?php echo $rs->organisasi_nama; ?></td>
				<td><a href="javascript:void(0)" onclick="hapus('<?php echo $rs->no; ?>')"><img src="images/hapus.png" width="20" height="20"></a></td>
			</tr>
			<?php
				$i++;
				}
			?>
		</tbody>
	</table>
<script src="vendors/nprogress/nprogress.js"></script>
<?php include("../../close.php"); ?>