<?php include("../../conn.php"); ?>
<head>
	<link href="../../vendors/nprogress/nprogress.css" rel="stylesheet">
</head>
<?php

	$sql=mysqli_query($conn,"SELECT rs31.rs1 as noverif,rs31.rs2 as nousulan,rs31.rs3 as koderuangan,rs31.rs4 as tahun,rs31.rs5 as kodeusulan,rs31.rs6 as jumlah, 
					  rs31.rs9 as tglrencana,rs31.rs10 as keteranganx
					  FROM rs31");
	//$sqlx=mysqli_query($conn_musrenbang,"SELECT * FROM rs1");
	$i=1;
?>
<br />

<table class="table table-hover table-bordered table table-striped" id="dataTables-example">
		<thead>
			<tr>
				<th>No.</th>
				<th>NO. VERIF </th>
				<th>NO. USULAN </th>
				<th>RUANGAN</th>
				<th>TAHUN</th>
				<th>USULAN</th>
				<th>JUMLAH</th>
				<th>PERENCANAAN</th>
				<th>KETERANGAN</th>				
			</tr>
		</thead>
		<tbody>
			<?php while($rs=$sql->fetch_object()){ ?>
			<tr>
				<td><?php echo $i; ?></td>
				<td nowrap="nowrap"><?php echo $rs->noverif; ?></td>
				<td nowrap="nowrap"><?php echo $rs->nousulan; ?></td>
				<?php 
					$sqlx=mysqli_query($conn_musrenbang,"SELECT rs2 as ruangan FROM rs3  where rs1='".$rs->koderuangan."' ");
					$rsx=$sqlx->fetch_object();
				?>
				<td nowrap="nowrap"><?php echo $rsx->ruangan; ?></td>
				<td><?php echo $rs->tahun; ?></td>
				<?php 
					$sqlx=mysqli_query($conn_musrenbang,"SELECT rs2 as usulan FROM rs1  where rs1='".$rs->kodeusulan."' ");
					$rsx=$sqlx->fetch_object();
				?>
				<td nowrap="nowrap"><?php echo $rsx->usulan; ?></td>
				<td><?php echo $rs->jumlah; ?></td>
				<td><?php echo out_tanggal("-",$rs->tglrencana); ?></td>
				<td><?php echo $rs->keteranganx; ?></td>
			</tr>
			<?php
				$i++;
				}
			?>
		</tbody>
	</table>
<script src="../../vendors/nprogress/nprogress.js"></script>
<?php include("../../close.php"); ?>