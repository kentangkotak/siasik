<?php include("../../conn.php"); ?>
<?php

	$sql=$conn->query("select npkls_heder.nonpk as nonpk,npkls_heder.tglnpk as tglnpk,npkls_heder.akun as akun,sum(npkls_rinci.total) as total
						from npkls_heder,npkls_rinci 
						where npkls_heder.nonpk=npkls_rinci.nonpk and year(npkls_heder.tglnpk)='".$_SESSION["anggaran_tahun"]."' and npkls_heder.kunci=1 
						and npkls_heder.nopencairan='' group by npkls_heder.nonpk ");

	$i=1;
?>
<br />

<table class="table table-hover table-bordered table table-striped" id="dataTables-example">
		<thead>
			<tr>
				<th>No.</th>
				<th align="center">NO. NPK</th>
				<th align="center">TGL NPK</th>
				<th align="center">AKUN</th>
				<th align="center">TOTAL</th>
			</tr>
		</thead>
		<tbody>
			<?php while($rs=$sql->fetch_object()){ ?>
			<tr>
				<td><?php echo $i; ?></td>
				<td align="center"><a href="javascript:void(0)"; onClick="formnpkls('<?php echo $rs->nonpk; ?>');"><?php echo $rs->nonpk; ?></a></td>
				<td><?php echo $rs->tglnpk; ?></td>
				<td><?php echo $rs->akun; ?></td>
				<td><?php echo rpzx($rs->total); ?></td>
			</tr>
			<?php
				$i++;
				}
			?>
		</tbody>
	</table>
<?php include("../../close.php"); ?>