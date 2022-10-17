<?php include("../../conn.php"); ?>
<head>
	<link href="../../vendors/nprogress/nprogress.css" rel="stylesheet">
</head>
<?php

	$sql=$conn->query("select * from pihak_ketiga where hidden='' ");
	$i=1;
?>
<br />

<table class="table table-hover table-bordered table table-striped" id="dataTables-example">
		<thead>
			<tr>
				<th>No.</th>
				<th>KODE</th>
				<th>NAMA PERUSAHAAN</th>
				<th>ALAMAT PERUSAHAAN</th>
				<th>NOMOR TELEPON</th>
				<th>NPWP</th>
				<th>NO. REK</th>
				<th>CP</th>
				<th>BANK</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php while($rs=$sql->fetch_object()){ ?>
			<tr>
				<td align="center"><?php echo $i; ?></td>		
				<td><?php echo $rs->kode; ?></td>
				<td><?php echo $rs->nama; ?></td>
				<td><?php echo $rs->alamat; ?></td>
				<td><?php echo $rs->telepon; ?></td>
				<td><?php echo $rs->npwp; ?></td>
				<td><?php echo $rs->norek; ?></td>
				<td><?php echo $rs->cp; ?></td>
				<td><?php echo $rs->bank; ?></td>
				<td>
					<a href="javascript:void(0)" onclick="hapuspihakketiga('<?php echo $rs->id; ?>')"><img src="images/hapus.png" width="20" height="20"></a>
					<a href="javascript:void(0)" onclick="formpihakketiga('<?php echo $rs->kode; ?>')"><img src="images/edit.png" width="20" height="20"></a>
				</td>
			</tr>
			<?php
				$i++;
				}
			?>
		</tbody>
	</table>
<script src="../../vendors/nprogress/nprogress.js"></script>
<?php include("../../close.php"); ?>