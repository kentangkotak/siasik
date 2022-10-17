<?php include("../../conn.php"); ?>
<head>
	<link href="../../vendors/nprogress/nprogress.css" rel="stylesheet">
</head>
<?php
	$sql=$conn->query("select * from mapping_blud_79 where akun='".$_GET['akun']."' and kelompok='".$_GET['kelompok']."' 
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
				<th>KODE 79</th>
				<th>URAIAN 79</th>
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
				<td><?php echo $rs->kode_791.".".$rs->kode_792.".".$rs->kode_793; ?></td>
				<td><?php echo $rs->uraian_79; ?></td>
				<td> <a href="javascript:void(0)" onclick="mapping('<?php echo $rs->akun; ?>','<?php echo $rs->kelompok; ?>','<?php echo $rs->jenis; ?>','<?php echo $rs->objectx; ?>','<?php echo $rs->rincian; ?>','<?php echo $rs->subrincian; ?>')" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> Mapping </a></td>
			</tr>
			<?php
				$i++;
				}
			?>
		</tbody>
	</table>
<script src="../../vendors/nprogress/nprogress.js"></script>
<?php include("../../close.php"); ?>