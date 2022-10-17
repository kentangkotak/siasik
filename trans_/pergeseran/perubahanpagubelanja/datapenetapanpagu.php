<?php include("../../../conn.php"); ?>
<?php
if($_SESSION['anggaran_level'] == 'SUPER'){
	$sql=$conn->query("select penetapan_pagu.notrans as notrans,penetapan_pagu.kegiatanblud as kegiatanblud,penetapan_pagu.total as paguawal,
						t_tampung_pagu.pagu as total,penetapan_pagu.tahun as tahun
						from penetapan_pagu,t_tampung_pagu where penetapan_pagu.tahun='".$_SESSION["anggaran_tahun"]."' 
						and penetapan_pagu.kodekegiatan=t_tampung_pagu.kodekegiatanblud 
						");
}else{
	$sql=$conn->query("select penetapan_pagu.notrans as notrans,penetapan_pagu.kegiatanblud as kegiatanblud,penetapan_pagu.total as paguawal,
						t_tampung_pagu.pagu as total,penetapan_pagu.tahun as tahun
						from penetapan_pagu,t_tampung_pagu where penetapan_pagu.tahun='".$_SESSION["anggaran_tahun"]."' 
						and penetapan_pagu.kodekegiatan=t_tampung_pagu.kodekegiatanblud and penetapan_pagu.namaorganisasi='".$_SESSION["anggaran_ruangan"]."'");
}
	$i=1;
?>
<br />
<div id="contentPagu"></div>
<table class="table table-hover table-bordered table table-striped" id="dataTables-example">
		<thead>
			<tr>
				<th>No.</th>
				<th>NOTRANS </th>
				<th>KEGIATANBLUD </th>
				<th>PAGU AWAL</th>
				<th>PAGU PERGESERAN</th>
				<th>TAHUN</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php while($rs=$sql->fetch_object()){ ?>
			<tr>
				<td><?php echo $i; ?></td>
				<td><?php echo $rs->notrans; ?></td>
				<td><?php echo $rs->kegiatanblud; ?></td>
				<td align="right"><?php echo rp($rs->paguawal); ?></td>
				<td align="right"><?php echo rp($rs->total); ?></td>
				<td><?php echo $rs->tahun; ?></td>
				<td>
					<a href="javascript:void(0)" onclick="formpenetapanpagu('<?php echo $rs->notrans; ?>','<?php echo $rs->flag; ?>')"><img src="images/edit.png" width="20" height="20"></a>
				</td>
			</tr>
			<?php
				$i++;
				}
			?>
		</tbody>
	</table>
<?php include("../../../close.php"); ?>