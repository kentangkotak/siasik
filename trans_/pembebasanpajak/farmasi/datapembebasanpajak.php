<?php include("../../../conn.php"); ?>
<?php
	$sql=$conn->query("select * from bebaspajak_heder");
	$i=1;
?>
<br />

<table class="table table-hover table-bordered table table-striped" id="dataTables-example">
		<thead>
			<tr>
				<th>No.</th>
				<th align="center">NO. PEMBEBASAN PAJAK</th>
				<th align="center">NO. PENERIMAAN</th>
				<th align="center">TGL PEMBEBASAN</th>
				<th align="center">NAMA PERUSAHAAN</th>
			</tr>
		</thead>
		<tbody>
			<?php while($rs=$sql->fetch_object()){ 
				$tglbebaspajak=$rs->tglbebaspajak;
			?>
			<tr>
				<td><?php echo $i; ?></td>
				<td align="center"><a href="javascript:void(0)"; onClick="formpembebasanpajakfarmasi('<?php echo $rs->notrans; ?>','<?php echo $rs->nopenerimaan; ?>');"><?php echo $rs->notrans; ?></a></td>
				<td><?php echo $rs->nopenerimaan; ?></td>
				<td><?php echo out_tanggal('-',$rs->tglbebaspajak); ?></td>
				<td><?php echo $rs->suplier; ?></td>
			</tr>
			<?php
				$i++;
				}
			?>
		</tbody>
	</table>
<?php include("../../../close.php"); ?>