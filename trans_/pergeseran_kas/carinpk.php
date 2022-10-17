<?php include "../../conn.php";?>
<?php

    $sql=$conn->query("select npkpanjar_heder.nonpk as nonpk,npkpanjar_heder.tglnpk as tglnpk,npkpanjar_heder.akun as akun,
					npkpanjar_rinci.nonpd as nonpd,npkpanjar_rinci.kegiatan as kegiatan,npkpanjar_rinci.kegiatanblud as kegiatanblud,
					npkpanjar_rinci.total as totalnpk 
					from npkpanjar_heder,npkpanjar_rinci
					where npkpanjar_rinci.nonpk=npkpanjar_heder.nonpk and npkpanjar_heder.kunci=1 and 
					year(npkpanjar_heder.tglnpk)='".$_SESSION["anggaran_tahun"]."' and npkpanjar_rinci.flag='' ");
$i=1;
?>
<table class="table table-hover table-bordered table table-striped" id="dataTables-example">
	<thead>
		<tr>
			<th>No.</th>
			<th>NO NPK</th>
			<th>TGL NPK</th>
			<th>AKUN</th>
			<th>NO NPD</th>
			<th>KODE KEGIATAN BLUD</th>
			<th>TOTAL</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php while($rs=$sql->fetch_object()){ ?>
		<tr>
			<td><?php echo $i; ?></td>
			<td><?php echo $rs->nonpk; ?></td>
			<td><?php echo $rs->tglnpk; ?></td>
			<td><?php echo $rs->akun; ?></td>
			<td><?php echo $rs->nonpd; ?></td>
			<td><?php echo $rs->kegiatanblud; ?></td>
			<td align="right"><?php echo rp($rs->totalnpk); ?></td>
			<td><input type="button" value="PILIH" onclick="pilih('<?php echo $rs->nonpk;?>','<?php echo rpz($rs->totalnpk);?>','<?php echo $rs->nonpd;?>');"></td>
		</tr>
		<?php $i++; } ?>
	</tbody>
</table>	
<?php include "../../close.php";?>