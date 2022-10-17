<?php include("../../conn.php"); ?>
<?php
	$sql=$conn->query("select penyesesuaianperioritas_heder.notrans as notrans,penyesesuaianperioritas_rinci.koderek50 as kode50,penyesesuaianperioritas_rinci.uraian50 as uraian50,
						penyesesuaianperioritas_rinci.nilai as nilai
						from penyesesuaianperioritas_heder,penyesesuaianperioritas_rinci
						where penyesesuaianperioritas_heder.notrans=penyesesuaianperioritas_rinci.notrans 
						and year(penyesesuaianperioritas_heder.tgltrans)='".$_SESSION["anggaran_tahun"]."' group by penyesesuaianperioritas_rinci.koderek50");

	$i=1;
?>
<br />

<table class="table table-hover table-bordered table table-striped" id="dataTables-example">
		<thead>
			<tr>
				<th>KODE</th>
				<th>URAIAN RINCIAN OBJECT</th>
				<th>JUMLAH</th>
			</tr>
		</thead>
		<tbody>
			<?php while($rs=$sql->fetch_object()){ ?>
			<tr>
				<td><?php echo $rs->kode50;?></td>
				<td><?php echo $rs->uraian50;?></td>
				<td><?php echo rp($rs->nilai);?></td>
				<td><a href="javascript:void(0)" onclick="tingkat2()" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> View </a></td>
			</tr>
			<?php
				$i++;
				}
			?>
		</tbody>
</table>
<?php include("../../close.php"); ?>