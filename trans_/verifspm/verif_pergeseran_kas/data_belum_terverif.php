<?php include("../../conn.php"); ?>
<?php

	$sql=$conn->query("select pergeseranTheder.notrans as notrans,pergeseranTheder.tgltrans as tgltrans,pergeseranTheder.jenis as jenis,pergeseranTrinci.jumlah as jumlah 
from pergeseranTheder LEFT JOIN pergeseranTrinci on pergeseranTheder.notrans=pergeseranTheder.notrans
where year(pergeseranTheder.tgltrans)='".$_SESSION["anggaran_tahun"]."' and pergeseranTheder.kunci=1 and pergeseranTheder.flag=''");
	
	$i=1;
?>
<br />
<table class="table table-hover table-bordered table table-striped" id="dataTables-example">
		<thead>
			<tr>
				<th>No.</th>
				<th>NOTRANS </th>
				<th>TANGGAL TRANSAKSI </th>
				<th>JENIS </th>
				<th>JUMLAH PERGESERAN </th>
				<th>AKSI</th>
			</tr>
		</thead>
		<tbody>
			<?php while($rs=$sql->fetch_object()){ ?>
			<tr>
				<td><?php echo $i; ?></td>
				<td align="center"><?php echo $rs->notrans; ?></td>
				<td><?php echo $rs->tgltrans; ?></td>
				<td><?php echo $rs->jenis; ?></td>
				<td><?php echo rpy($rs->jumlah); ?></td>
				<td>
					<a href="javascript:void(0)" onclick="verif('<?php echo $rs->notrans; ?>')" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> VERIFIKASI </a>
				</td>
			</tr>
			<?php
				$i++;
				}
			?>
		</tbody>
	</table>
<?php include("../../close.php"); ?>