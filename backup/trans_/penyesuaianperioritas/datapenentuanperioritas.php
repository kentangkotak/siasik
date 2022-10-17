<?php include("../../conn.php"); ?>
<?php
	$sql=$conn->query("select * from penyesesuaianperioritas_heder  ");
	$i=1;
?>
<br />
<table class="table table-hover table-bordered table table-striped" id="dataTables-example">
		<thead>
			<tr>
				<th>No.</th>
				<th>NOTRANS </th>
				<th>NAMA BIDANG </th>
				<th>NAMA PPTK </th>
				<th>TANGGAL </th>
				<th>AKSI</th>
			</tr>
		</thead>
		<tbody>
			<?php while($rs=$sql->fetch_object()){ ?>
			<tr>
				<td><?php echo $i; ?></td>
				<td align="center"><a href="javascript:void(0)"; onClick="formpenentuanperioritas('<?php echo $rs->notrans; ?>');"><?php echo $rs->notrans; ?></a></td>
				<td><?php echo $rs->namabidang; ?></td>
				<td><?php echo $rs->pptk; ?></td>
				<td><?php echo $rs->tgltrans; ?></td>
				<td><input type="button" value="Hapus" onclick="hapusHeader('<?php echo $rs->notrans; ?>');"></td>
			</tr>
			<?php
				$i++;
				}
			?>
		</tbody>
	</table>
<?php include("../../close.php"); ?>