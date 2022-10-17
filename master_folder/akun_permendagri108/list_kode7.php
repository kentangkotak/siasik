<?php include("../../conn.php"); ?>
<head>
	<link href="../../vendors/nprogress/nprogress.css" rel="stylesheet">
</head>
<?php
	$kat = explode('.',$_GET['kode6']);
	$kode1 = $kat[0];
	$kode2 = $kat[1];
	$kode3 = $kat[2];
	$kode4 = $kat[3];
	$kode5 = $kat[4];
	$kode6 = $kat[5];
	
	$sql=$conn->query("
		select 
			uraian,
			kode1,
			kode2,
			kode3,
			kode4,
			kode5,
			kode6,
			kode7 kode7x,
			concat(kode1,'.',kode2,'.',kode3,'.',kode4,'.',kode5,'.',kode6,'.',kode7) kode7
		from 
			akun_permendagri108
		where 
			kode1='".$kode1."' 
			and kode2='".$kode2."'
			and kode3='".$kode3."'
			and kode4='".$kode4."'
			and kode5='".$kode5."'
			and kode6='".$kode6."'
			and kode7<>''
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
				<th>Rincian Objek</th>
				<th>Sub Rincian Objek</th>
				<th>Sub Sub Rincian Objek</th>
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
				<td><?php echo $rs->kode5; ?></td>
				<td><?php echo $rs->kode6; ?></td>
				<td><?php echo $rs->kode7x; ?></td>
				<td><?php echo $rs->uraian; ?></td>
				<td></td>
			</tr>
			<?php
				$i++;
				}
			?>
		</tbody>
	</table>
<script src="../../vendors/nprogress/nprogress.js"></script>
<?php include("../../close.php"); ?>