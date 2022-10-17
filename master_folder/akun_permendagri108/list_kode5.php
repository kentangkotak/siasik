<?php include("../../conn.php"); ?>
<head>
	<link href="../../vendors/nprogress/nprogress.css" rel="stylesheet">
</head>
<?php
	$kat = explode('.',$_GET['kode4']);
	$kode1 = $kat[0];
	$kode2 = $kat[1];
	$kode3 = $kat[2];
	$kode4 = $kat[3];
	
	$sql=$conn->query("
		select 
			uraian,
			kode1,
			kode2,
			kode3,
			kode4,
			kode5 kode5x,
			concat(kode1,'.',kode2,'.',kode3,'.',kode4,'.',kode5) kode5
		from 
			akun_permendagri108
		where 
			kode1='".$kode1."' 
			and kode2='".$kode2."'
			and kode3='".$kode3."'
			and kode4='".$kode4."'
			and kode5<>''
	");
	$i=1;
?>
<br />

<table class="table table-hover table-bordered table table-striped" id="dataTables-example">
		<thead>
			<tr>
			<tr>
				<th>No.</th>
				<th>Akun</th>
				<th>Kelompok</th>
				<th>Jenis</th>
				<th>Objek</th>
				<th>Rincian Objek</th>
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
				<td><?php echo $rs->kode4; ?></td>
				<td><?php echo $rs->kode5x; ?></td>
				<td><?php echo $rs->uraian; ?></td>
				<td><a href="javascript:void(0)" onclick="list_kode6('<?php echo $rs->kode5; ?>')" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> View </a></td>
			</tr>
			<?php
				$i++;
				}
			?>
		</tbody>
	</table>
<script src="../../vendors/nprogress/nprogress.js"></script>
<?php include("../../close.php"); ?>