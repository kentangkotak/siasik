<?php include("../../../conn.php"); ?>
<?php

	$sql=$conn->query("select * from jurnalumum_heder where year(tanggal)='".$_SESSION["anggaran_tahun"]."'");
	$i=1;
?>
<br />

<table class="table table-hover table-bordered table table-striped" id="dataTables-example">
		<thead>
			<tr>
				<th>No.</th>
				<th align="center">NO. BUKTI</th>
				<th align="center">TANGGAL</th>
				<th align="center">KETERANGAN</th>
			</tr>
		</thead>
		<tbody>
			<?php while($rs=$sql->fetch_object()){ ?>
			<tr>
				<td><?php echo $i; ?></td>
				<td align="center"><a href="javascript:void(0)"; onClick="formjurnalumum('<?php echo $rs->nobukti; ?>');"><?php echo $rs->nobukti; ?></a></td>
				<td><?php echo $rs->tanggal; ?></td>
				<td><?php echo $rs->keterangan; ?></td>
			</tr>
			<?php
				$i++;
				}
			?>
		</tbody>
	</table>
<?php include("../../../close.php"); ?>