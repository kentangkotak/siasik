<?php include("../../conn.php"); ?>
<?php
	$sql=$conn->query("select * from contrapost;");
$i=1;
?>
<br />
<form name="formrinci" id="demo-form2" class="form-horizontal form-label-left" onSubmit="return false;">
	<table class="table table-hover table-bordered table table-striped" id="dataTables-example">
			<thead>
				<tr>
					<th>No.</th>
					<th>NO. CONTRAPOST</th>
					<th>TGL CONTRAPOST</th>
					<th>NO. NPD</th>
					<th>NOMINAL NPD</th>
					<th>NOMINAL CONTRAPOST</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php while($rs=$sql->fetch_object()){ ?>
				<tr>
					<td><?php echo $i; ?></td>
					<td><?php echo $rs->nocontrapost; ?></td>
					<td><?php echo $rs->tglcontrapost; ?></td>
					<td><?php echo $rs->nonpd; ?></td>
					<td align="right"><?php echo rpzx($rs->nominalygdibayarkan); ?></td>
					<td align="right"><?php echo rpzx($rs->nominalcontrapost); ?></td>
					<?php if($rs->kunci == ''){ ?>
					<td>
							<a href="javascript:void(0)" onclick="hapusHeader('<?php echo $rs->id; ?>')"><img src="images/hapus.png" width="20" height="20"></a>
							<a href="javascript:void(0)" onclick="kunci('<?php echo $rs->id; ?>','<?php echo "garis_".$i; ?>')"><span id="<?php echo "garis_".$i ?>"><img src="images/unlock.png" width="20" height="20"></span></a>
					</td>
					<?php }else{ ?>
						<?php if($_SESSION["anggaran_aksi"] == '1'){ ?>
								<td>
									<a href="javascript:void(0)" onclick="bukakunci('<?php echo $rs->nonpdls; ?>','<?php echo "garis_".$i; ?>')"><span id="<?php echo "garis_".$i ?>"><img src="images/keyxx.png" width="20" height="20"></span></a>	
								</td>
						<?php }else{ ?>
								<td>
									<img src="images/keyxx.png" width="20" height="20">
								</td>
						<?php } ?>
					<?php } ?>
				</tr>
				<?php } ?>
			</tbody>
	</table>
</form>
<?php include("../../close.php"); ?>