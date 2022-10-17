<?php include("../../conn.php"); ?>
<?php

	$sql=$conn->query("select npkls_heder.*,sum(npkls_rinci.total) as total 
						from npkls_heder,npkls_rinci 
						where npkls_heder.nonpk=npkls_rinci.nonpk and year(tglnpk)='".$_SESSION["anggaran_tahun"]."' group by npkls_heder.nonpk ");

	$i=1;
?>
<br />

<table class="table table-hover table-bordered table table-striped" id="dataTables-example">
		<thead>
			<tr>
				<th>No.</th>
				<th align="center">NO. NPK LS</th>
				<th align="center">TGL NPK LS</th>
				<th align="center">AKUN</th>
				<th align="center">TOTAL</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php while($rs=$sql->fetch_object()){ ?>
			<tr>
				<td><?php echo $i; ?></td>
				<td align="center"><a href="javascript:void(0)"; onClick="formnpkls('<?php echo $rs->nonpk; ?>');"><?php echo $rs->nonpk; ?></a></td>
				<td><?php echo $rs->tglnpk; ?></td>
				<td><?php echo $rs->akun; ?></td>
				<td align="right"><?php echo rpzx($rs->total); ?></td>
				<?php if($rs->kunci == ''){ ?>
					<td>
						<a href="javascript:void(0)" onclick="hapusHeader('<?php echo $rs->nonpk; ?>')"><img src="images/hapus.png" width="20" height="20"></a>
						<a href="javascript:void(0)" onclick="kunci('<?php echo $rs->nonpk; ?>','<?php echo "garis_".$i; ?>')"><span id="<?php echo "garis_".$i ?>"><img src="images/unlock.png" width="20" height="20"></span></a>
					</td>
				<?php }else{ ?>
					<?php if($_SESSION["anggaran_aksi"] == '1'){ ?>
						<td>
							<a href="javascript:void(0)" onclick="bukakunci('<?php echo $rs->nonpk; ?>','<?php echo "garis_".$i; ?>')"><span id="<?php echo "garis_".$i ?>"><img src="images/keyxx.png" width="20" height="20"></span></a>	
						</td>
					<?php }else{ ?>
						<td>
							<img src="images/keyxx.png" width="20" height="20">
						</td>
					<?php } ?>
				<?php } ?>
			</tr>
			<?php
				$i++;
				}
			?>
		</tbody>
	</table>
<?php include("../../close.php"); ?>