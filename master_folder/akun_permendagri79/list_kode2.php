<?php include("../../conn.php"); ?>
<head>
	<link href="../../vendors/nprogress/nprogress.css" rel="stylesheet">
</head>
<?php
	$sql=$conn->query("
		select 
			uraian,
			kode1,
			kode2 kode2x,
			concat(kode1,'.',kode2) kode2 
		from 
			akun_permendagri79 
		where 
			kode1='".$_GET['kode1']."' 
			and (kode3='' or kode3 is null)
			and (kode2<>'' or kode2 is not null)
	");
	$i=1;
?>
<br />
<div class="col-md-3 col-sm-3 col-xs-1 ">
<input type="button" name="tsimpan" class="btn btn-success btn-block" id="tsimpan" value="Tambah" size="20" onClick="_form('<?php echo $_GET['kode1']; ?>');">
</div>
<table class="table table-hover table-bordered table table-striped" id="dataTables-example">
		<thead>
			<tr>
				<th>No.</th>
				<th>L.1</th>
				<th>L.2</th>
				<th>Uraian</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php while($rs=$sql->fetch_object()){ ?>
			<tr>	
				<td><?php echo $i; ?></td>
				<td><?php echo $rs->kode1; ?></td>
				<td><?php echo $rs->kode2x; ?></td>
				<td><?php echo $rs->uraian; ?></td>
				<td><a href="javascript:void(0)" onclick="list_kode3('<?php echo $rs->kode2; ?>')" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> View </a></td>
			</tr>
			<?php
				$i++;
				}
			?>
		</tbody>
	</table>
<script src="../../vendors/nprogress/nprogress.js"></script>
<?php include("../../close.php"); ?>