<?php include("../../conn.php"); ?>
<?php
if($_SESSION['anggaran_level'] == 'SUPER'){
	$sql=$conn->query("select * from penyesesuaianperioritas_heder where year(tgltrans)='".$_SESSION["anggaran_tahun"]."' and kunci=1  ");
}else{
	$sql=$conn->query("select * from penyesesuaianperioritas_heder where year(tgltrans)='".$_SESSION["anggaran_tahun"]."' and kunci=1 and namabidang='".$_SESSION["anggaran_ruangan"]."'");
}
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
				<th>KEGIATAN </th>
				<th>TANGGAL </th>
			</tr>
		</thead>
		<tbody>
			<?php while($rs=$sql->fetch_object()){ ?>
			<tr>
				<td><?php echo $i; ?></td>
				<td align="center"><a href="javascript:void(0)"; onClick="formpenentuanperioritas('<?php echo $rs->notrans; ?>');"><?php echo $rs->notrans; ?></a></td>
				<td><?php echo $rs->namabidang; ?></td>
				<td><?php echo $rs->pptk; ?></td>
				<td><?php echo $rs->kegiatan; ?></td>
				<td><?php echo $rs->tgltrans; ?></td>
			</tr>
			<?php
				$i++;
				}
			?>
		</tbody>
	</table>
<?php include("../../close.php"); ?>