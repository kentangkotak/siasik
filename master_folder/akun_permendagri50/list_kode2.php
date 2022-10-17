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
			akun_permendagri50 
		where 
			kode1='".$_GET['kode1']."' 
			and kode3=''
			and kode2<>''
	");
	$i=1;
?>
<br />

<table class="table table-hover table-bordered table table-striped" id="dataTables-example">
		<thead>
			<tr>
				<th>No.</th>
				<th>Akun</th>
				<th>Kelompok</th>
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
				<td><a href="javascript:void(0)" onclick="list_kode3('<?php echo $rs->kode2; ?>')" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> View </a>
				<a href="javascript:void(0)" onclick="list();" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> Back </a>
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