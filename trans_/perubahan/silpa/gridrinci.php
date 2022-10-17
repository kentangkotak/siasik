<?php include("../../../conn.php"); ?>
<?php

	$sql=$conn->query("select * from silpa where tahun='".$_SESSION["anggaran_tahun"]."'");

	$i=1;
?>
<br />

<table class="table table-hover table-bordered table table-striped" id="dataTables-example">
		<thead>
			<tr>
				<th>No.</th>
				<th>TAHUN</th>
				<th>NOMINAL</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php while($rs=$sql->fetch_object()){ ?>
			<tr>
				<td><?php echo $i; ?></td>
				<td><?php echo $rs->tahun; ?></td>
				<td align="center"><?php echo rpzx($rs->nominal); ?></td>
				<?php if($rs->verif == ''){ ?>
					<td>
						<a href="javascript:void(0)" onclick="edit('<?php echo $rs->notrans; ?>','<?php echo out_tanggal("-",$rs->tanggal); ?>','<?php echo $rs->tahun; ?>','<?php echo rpz($rs->nominal); ?>')"><img src="images/edit.png" width="20" height="20"></a>
						<a href="javascript:void(0)" onclick="kunci('<?php echo $rs->notrans; ?>','<?php echo "garis_".$i; ?>')"><span id="<?php echo "garis_".$i ?>"><img src="images/unlock.png" width="20" height="20"></span></a>
					</td>
					<?php }else{ ?>
						<td>
							<img src="images/keyxx.png" width="20" height="20">
						</td>
					<?php } ?>
			</tr>
			<?php
				$i++;
				}
			?>
		</tbody>
	</table>
<?php include("../../../close.php"); ?>