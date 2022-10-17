<?php include("../../conn.php"); ?>
<head>
	<link href="../../vendors/nprogress/nprogress.css" rel="stylesheet">
</head>
<?php

	$sql=$conn->query("select * from pptk where flag='' and tahun='".$_SESSION["anggaran_tahun"]."'");
	$i=1;
?>
<br />

<table class="table table-hover table-bordered table table-striped" id="dataTables-example">
		<thead>
			<tr>
				<th>No.</th>
				<th>NIP</th>
				<th>NAMA</th>
				<th>ORGANISASI</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php while($rs=$sql->fetch_object()){ ?>
			<tr>
				<td align="center"><?php echo $i; ?></td>		
				<td><?php echo $rs->nip; ?></td>
				<td><?php echo $rs->nama; ?></td>
				<td><?php echo $rs->bagian." (".$rs->alias.")"; ?></td>
				<td><a href="javascript:void(0)" onclick="hapuspptk('<?php echo $rs->id; ?>')"><img src="images/hapus.png" width="20" height="20"></a></td>
			</tr>
			<?php
				$i++;
				}
			?>
		</tbody>
	</table>
<script src="../../vendors/nprogress/nprogress.js"></script>
<?php include("../../close.php"); ?>