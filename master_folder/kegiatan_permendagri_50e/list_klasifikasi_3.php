<?php include("../../conn.php"); ?>
<head>
	<link href="../../vendors/nprogress/nprogress.css" rel="stylesheet">
</head>
<?php

	$sql=$conn->query("select * from permendagri_50_e where fungsi='".$_GET['fungsi']."' and subfungsi='".$_GET['sub_fungsi']."' group by urusan");
	$i=1;
?>
<br />

<table class="table table-hover table-bordered table table-striped" id="dataTables-example">
		<thead>
			<tr>
				<th>No.</th>
				<th>FUNGSI</th>
				<th>SUBFUNGSI</th>
				<th>URUSAN</th>
				<th>NOMENKLATUR</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php while($rs=$sql->fetch_object()){ ?>
			<tr>
				<td align="center"><?php echo $i; ?></td>		
				<td><?php echo $rs->fungsi; ?></td>
				<td><?php echo $rs->subfungsi; ?></td>
				<td><?php echo $rs->urusan; ?></td>
				<td><?php echo $rs->uraian; ?></td>
				<td> <a href="javascript:void(0)" onclick="tingkat4('<?php echo $rs->fungsi; ?>','<?php echo $rs->subfungsi; ?>','<?php echo $rs->urusan; ?>')" class="btn btn-primary btn-xs"><i class="fa fa-folder" ></i> View </a>
					</a>
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