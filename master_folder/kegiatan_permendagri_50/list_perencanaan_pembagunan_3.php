<?php include("../../conn.php"); ?>
<head>
	<link href="../../vendors/nprogress/nprogress.css" rel="stylesheet">
</head>
<?php

	$sql=$conn->query("select * from permendagri_50_c where urusan='".$_GET['urusan']."' and bidang_urusan='".$_GET['bidang_urusan']."' group by program");
	$i=1;
?>
<br />
<div class="col-md-3 col-sm-3 col-xs-1 ">
<input type="button" name="tsimpan" class="btn btn-success btn-block" id="tsimpan" value="Tambah" size="20" onClick="form_perencanaan_pembangunan('3','<?php echo $_GET['urusan']; ?>','<?php echo $_GET['bidang_urusan']; ?>');">
</div>
<table class="table table-hover table-bordered table table-striped" id="dataTables-example">
		<thead>
			<tr>
				<th>No.</th>
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
				<td><?php echo $rs->urusan; ?></td>
				<td><?php echo $rs->bidang_urusan; ?></td>
				<td><?php echo $rs->program; ?></td>
				<td><?php echo $rs->nomenklatur; ?></td>
				<td> <a href="javascript:void(0)" onclick="tingkat4('<?php echo $rs->urusan; ?>','<?php echo $rs->bidang_urusan; ?>','<?php echo $rs->program; ?>')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-step-forward" ></i> View </a>
					<a href="javascript:void(0)" onclick="tingkat2('<?php echo $rs->urusan; ?>')" class="btn btn-primary btn-xs"><i class="glyphicon glyphicon-step-backward"></i> Back </a>
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