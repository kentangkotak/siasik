<?php include("../../conn.php"); ?>
<head>
	<link href="../../vendors/nprogress/nprogress.css" rel="stylesheet">
</head>
<?php

	$sql=$conn->query("
		select 
			* 
		from 
			maping_blud_pemda
	");
	$i=1;
?>
<br />
<!--<div class="col-md-3 col-sm-3 col-xs-1 ">
<input type="button" name="tsimpan" class="btn btn-success btn-block" id="tsimpan" value="Tambah" size="20" onClick="forms('');">
</div>-->
<table class="table table-hover table-bordered table table-striped" id="dataTables-example">
		<thead>
			<tr>
				<th>No.</th>
				<th>Level1</th>
				<th>Level2</th>
				<th>Level3</th>
				<th>Level4</th>
				<th>Level5</th>
				<th>Uraian Permendagri 50</th>
				<th>Uraian BLUD</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php while($rs=$sql->fetch_object()){ ?>
			<tr>	
				<td><?php echo $i; ?></td>
				<td><?php echo $rs->level1; ?></td>
				<td><?php echo $rs->level2; ?></td>
				<td><?php echo $rs->level3; ?></td>
				<td><?php echo $rs->level4; ?></td>
				<td><?php echo $rs->level5; ?></td>
				<td><?php echo $rs->uraian50; ?></td>
				<td><?php echo $rs->uraianblud; ?></td>
				<td><a href="javascript:void(0)" onclick="list_kode2('<?php echo $rs->kode1; ?>')" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> View </a></td>
			</tr>
			<?php
				$i++;
				}
			?>
		</tbody>
	</table>
<script src="../../vendors/nprogress/nprogress.js"></script>
<?php include("../../close.php"); ?>