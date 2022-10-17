<?php include("../../conn.php"); ?>
<?php

	$sql=$conn->query("select pergeseranTheder.notrans as notrans,pergeseranTheder.tgltrans as tgltrans,pergeseranTheder.jenis as jenis,
						pergeseranTrinci.jumlah as jumlah,
						pergeseranTheder.kunci as kunci
						FROM pergeseranTheder left join pergeseranTrinci
						on pergeseranTheder.notrans=pergeseranTrinci.notrans where year(pergeseranTheder.tgltrans)='".$_SESSION["anggaran_tahun"]."' 
						and pergeseranTheder.flag=1");
	
	$i=1;
?>
<br />
<table class="table table-hover table-bordered table table-striped" id="dataTables-example">
		<thead>
			<tr>
				<th>No.</th>
				<th>NOTRANS </th>
				<th>TANGGAL TRANSAKSI</th>
				<th>JENIS </th>
				<th>JUMLAH PERGESERAN </th>
				<th>AKSI</th>
			</tr>
		</thead>
		<tbody>
			<?php while($rs=$sql->fetch_object()){ ?>
			<tr>
				<td><?php echo $i; ?></td>
				<td align="center"><a href="javascript:void(0)"; onClick="view_detail_rinci('<?php echo $rs->notrans; ?>');"><?php echo $rs->notrans; ?></a></td>
				<td><?php echo $rs->tgltrans; ?></td>
				<td><?php echo $rs->jenis; ?></td>
				<td><?php echo rpy($rs->jumlah); ?></td>
				<td>
					<a href="javascript:void(0)" onclick="bukaverif('<?php echo $rs->notrans; ?>')" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> BUKA VERIFIKASI </a>
				</td>
			</tr>
			<?php
				$i++;
				}
			?>
		</tbody>
	</table>
<?php include("../../close.php"); ?>