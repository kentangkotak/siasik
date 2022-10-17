<?php include("../../conn.php"); ?>
<?php
	$sql=$conn->query("select rs32.rs1 as notrans,rs1.rs2 as jenispelatihan,rs4.rs2 as tempat,rs2.rs2 as kategori,
						rs3.rs2 as penyelenggara,rs32.rs9 as tglmulai,rs32.rs10 as tglselesai,rs32.rs17 as pelatihan
						from rs1,rs2,rs3,rs32,rs4
						where rs32.rs5=rs1.rs1 and rs32.rs7=rs2.rs1 and rs32.rs8=rs3.rs1 and rs32.rs6=rs4.rs1 and rs32.rs2='' order by rs32.rs1 desc");
	$i=1;
?>
<br />

<table class="table table-hover table-bordered table table-striped" id="dataTables-example">
		<thead>
			<tr>
				<th>No.</th>
				<th>NOTRANS </th>
				<th>PELATIHAN </th>
				<th>JENIS PELATIHAN </th>
				<th>TEMPAT</th>
				<th>KATEGORI PELATIHAN</th>
				<th>MULAI</th>
				<th>SELESAI</th>
			</tr>
		</thead>
		<tbody>
			<?php while($rs=$sql->fetch_object()){ ?>
			<tr>
				<td><?php echo $i; ?></td>
				<td><a href="javascript:void(0)"; style="color: #0000FF" onClick="formpelaksanaanx('<?php echo $rs->notrans; ?>');"><?php echo $rs->notrans; ?></a></td>
				<td><?php echo $rs->pelatihan; ?></td>
				<td><?php echo $rs->jenispelatihan; ?></td>
				<td><?php echo $rs->tempat; ?></td>
				<td><?php echo $rs->kategori; ?></td>
				<td><?php echo out_tanggal("-",$rs->tglmulai); ?></td>
				<td><?php echo out_tanggal("-",$rs->tglselesai) ?></td>
			</tr>
			<?php
				$i++;
				}
			?>
		</tbody>
	</table>
<?php include("../../close.php"); ?>