<?php include("../../conn.php"); ?>
<head>
	<link href="../../vendors/nprogress/nprogress.css" rel="stylesheet">
</head>
<?php
	$kat = explode('.',$_GET['kode2']);
	$kode1 = $kat[0];
	$kode2 = $kat[1];
	$sql=$conn->query("
		select 
			uraian,
			kode1,
			kode2,
			kode3 kode3x,
			concat(kode1,'.',kode2,'.',kode3) kode3
		from 
			akun_psap13
		where
			kode2='".$kode2."' 
			and kode1='".$kode1."'
			and kode3<>''
	");
	$i=1;
?>
<br />

<table class="table table-hover table-bordered table table-striped" id="dataTables-example">
		<thead>
			<tr>
				<th>No.</th>
				<th>L.1</th>
				<th>L.2</th>
				<th>L.3</th>
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
				<td><?php echo $rs->kode3x; ?></td>
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