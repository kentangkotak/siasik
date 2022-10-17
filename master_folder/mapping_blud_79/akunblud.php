<?php include("../../conn.php"); ?>
<head>
	<link href="../../vendors/nprogress/nprogress.css" rel="stylesheet">
</head>
<?php

	$sql=$conn->query("select * from akun50_miroring group by akun");
	$i=1;
?>
<br />

<table class="table table-hover table-bordered table table-striped" id="dataTables-example">
		<thead>
			<tr>
				<th>No.</th>
				<th>AKUN</th>
				<th>URAIAN</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php while($rs=$sql->fetch_object()){ ?>
			<tr>
				<td align="center"><?php echo $i; ?></td>		
				<td><?php echo $rs->akun; ?></td>
				<td><?php echo $rs->uraian; ?></td>
				<td>
					<a href="javascript:void(0)" onclick="tingkat2('<?php echo $rs->akun; ?>')" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> View </a>
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