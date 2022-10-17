<?php include("../../conn.php"); ?>
<head>
	<link href="../../vendors/nprogress/nprogress.css" rel="stylesheet">
</head>
<?php
	$kat = explode('.',$_GET['kode3']);
	$kode1 = $kat[0];
	$kode2 = $kat[1];
	$kode3 = $kat[2];
	$sql=$conn->query("
		select 
			uraian,
			kode1,
			kode2,
			kode3,
			kode4 kode4x,
			concat(kode1,'.',kode2,'.',kode3,'.',kode4) kode4,
			concat(kode1,'.',kode2) kode2x
		from 
			akun_permendagri50
		where 
			kode1='".$kode1."' 
			and kode2='".$kode2."'
			and kode3='".$kode3."'
			and kode4<>''
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
				<th>Jenis</th>
				<th>Objek</th>
				<th>Uraian</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php while($rs=$sql->fetch_object()){ ?>
			<tr>	
				<td><?php echo $i; ?></td>
				<td><?php echo $rs->kode1; ?></td>
				<td><?php echo $rs->kode2; ?></td>
				<td><?php echo $rs->kode3; ?></td>
				<td><?php echo $rs->kode4x; ?></td>
				<td><?php echo $rs->uraian; ?></td>
				<td><a href="javascript:void(0)" onclick="list_kode5('<?php echo $rs->kode4; ?>')" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> View </a>
				<a href="javascript:void(0)" onclick="list_kode3('<?php echo $rs->kode2x; ?>')" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> Back </a>
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