<?php include("../../conn.php"); ?>
<head>
	<link href="../../vendors/nprogress/nprogress.css" rel="stylesheet">
</head>
<?php

	$sql=$conn->query("select * from permendagri_50_e where fungsi='".$_GET['fungsi']."' 
						and subfungsi='".$_GET['sub_fungsi']."' and urusan='".$_GET['urusan']."' and bid_urusan='".$_GET['bid_urusan']."' 
						group by program");
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
				<th>BIDANG URUSAN</th>
				<th>PROGRAM</th>
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
				<td><?php echo $rs->bid_urusan; ?></td>
				<td><?php echo $rs->program; ?></td>
				<td><?php echo $rs->uraian; ?></td>
				<td> <a href="javascript:void(0)" onclick="tingkat6('<?php echo $rs->fungsi; ?>','<?php echo $rs->subfungsi; ?>','<?php echo $rs->urusan; ?>','<?php echo $rs->bid_urusan; ?>','<?php echo $rs->program; ?>')" class="btn btn-primary btn-xs"><i class="fa fa-folder" ></i> View </a>
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