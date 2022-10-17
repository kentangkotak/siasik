<?php include("../../conn.php"); ?>
<?php
	$sql=$conn->query("select * from perubahanrincianbelanja where noperubahan='".$_GET['noperubahan']."'");
	$i=1;
?>
<div id="contentPagu"></div>
<table class="table table-hover table-bordered table table-striped" id="dataTables-example">
		<thead>
			<tr>
				<th>No.</th>
				<th>USULAN </th>
				<th>VOLUME </th>
				<th>HARGA</th>
				<th>NILAI</th>
				<!--<th></th>-->
			</tr>
		</thead>
		<tbody>
			<?php while($rs=$sql->fetch_object()){ ?>
			<tr>
				<td><?php echo $i; ?></td>
				<td><?php echo $rs->usulan; ?></td>
				<td><?php echo $rs->volumebaru.' '.$rs->satuan; ?></td>
				<td><?php echo rp($rs->hargabaru); ?></td>
				<td><?php echo rp($rs->totalbaru); ?></td>
				<!--<td><a href="javascript:void(0)" onclick="edit_usulan('<?php echo $rs->idpp; ?>','<?php echo $rs->notrans; ?>','1')"><img src="images/edit.png" width="20" height="20"></a>
				</td>-->
			</tr>
			<?php
				$i++;
				}
			?>
		</tbody>
	</table>
<?php include("../../close.php"); ?>