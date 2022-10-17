<?php include("../../conn.php"); ?>
<head>
	<link href="../../vendors/nprogress/nprogress.css" rel="stylesheet">
</head>
<?php
	$sql=$conn->query("select * from akun50_miroring where akun='".$_GET['akun']."' and kelompok='".$_GET['kelompok']."' 
	and jenis='".$_GET['jenis']."' and objectx='".$_GET['objectx']."' and rincian='".$_GET['rincian']."' and subrincian is not null
	group by subrincian");
	$i=1;
?>
<br />

<table class="table table-hover table-bordered table table-striped" id="dataTables-example">
		<thead>
			<tr>
				<th>No.</th>
				<th>AKUN</th>
				<th>KELOMPOK</th>
				<th>JENIS</th>
				<th>OBJECT</th>
				<th>RINCIAN</th>
				<th>SUB RINCIAN</th>
				<th>URAIAN</th>
				<th>KODE PSAP13</th>
				<th>URAIAN PSAP13</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php while($rs=$sql->fetch_object()){ ?>
			<tr>
				<td align="center"><?php echo $i; ?></td>		
				<td><?php echo $rs->akun; ?></td>
				<td><?php echo $rs->kelompok; ?></td>
				<td><?php echo $rs->jenis; ?></td>
				<td><?php echo $rs->objectx; ?></td>
				<td><?php echo $rs->rincian; ?></td>
				<td><?php echo $rs->subrincian; ?></td>
				<td><?php echo $rs->uraian; ?></td>
				<td><?php echo $rs->kode_psap131.".".$rs->kode_psap132.".".$rs->kode_psap133; ?></td>
				<td><?php echo $rs->uraian_psap13; ?></td>
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