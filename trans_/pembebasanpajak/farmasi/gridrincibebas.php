<?php include("../../../conn.php"); ?>
<div class="col-md-12 col-sm-12 col-xs-12">
	<div class="x_panel">
		<div class="x_content">
			<?php
				$sql=$conn->query("select * from bebaspajak_heder where notrans='".$_GET['notrans']."'");
			$i=1;
			?>
				<table width="100%" class="table table-bordered table-striped jambo_table bulk_action dt-head-center">
					<thead>
						<tr>
							<th>No.</th>
							<th>NO PENERIMAAN</th>
							<th>NO FAKTUR</th>
							<th>SUPPLIER</th>
							<th>TGL FAKTUR</th>
							<th>TGL JATUH TEMPOE</th>
							<th>TOTAL BELUM PPN</th>
							<th>PPN</th>
							<th>TOTAL</th>
						</tr>
					</thead>
					<tbody>
						<?php while($rs=$sql->fetch_object()){ ?>
						<tr>
							<td><?php echo $i; ?></td>
							<td><?php echo $rs->nopenerimaan; ?></td>
							<td><?php echo $rs->nofaktur; ?></td>
							<td><?php echo $rs->suplier; ?></td>
							<td><?php echo $rs->tglfaktur; ?></td>
							<td><?php echo $rs->tgljatuhtempo; ?></td>
							<td align="right" nowrap="nowrap"><?php echo rp($rs->totalbelumppn); ?></td>
							<td align="right"><?php echo rp($rs->ppn); ?></td>
							<td align="right"><?php echo rp($rs->total); ?></td>
						</tr>
						<?php
							$i++;
							}
						?>
					</tbody>
				</table>
			</div>
	</div>
</div>

<?php include("../../../close.php"); ?>