<?php include("../../conn.php"); ?>
<?php
	$sql=$conn->query("select penyesesuaianperioritas_heder.notrans as notrans,penyesesuaianperioritas_heder.kodekegiatan as kodekegiatan,penyesesuaianperioritas_heder.kegiatan as kegiatan,
						penyesesuaianperioritas_rinci.usulan as usulan	
						from 
						penyesesuaianperioritas_heder,penyesesuaianperioritas_rinci
						where penyesesuaianperioritas_heder.notrans=penyesesuaianperioritas_rinci.notrans 
						and year(penyesesuaianperioritas_heder.tgltrans)='".$_SESSION["anggaran_tahun"]."'");

	$i=1;
?>
<br />

<table class="table table-hover table-bordered table table-striped" id="dataTables-example">
		<thead>
			<tr>
				<th>KODE</th>
				<th>KEGIATAN BLUD</th>
				<th>RINCIAN KEGIATAN</th>
			</tr>
		</thead>
		<tbody>
			<?php while($rs=$sql->fetch_object()){ ?>
			<tr>
				<td><?php echo $rs->kodekegiatan;?></td>
				<td><?php echo $rs->kegiatan;?></td>
				<td><?php echo $rs->usulan;?></td>
				<td><a href="javascript:void(0)" onclick="tingkat2()" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> View </a></td>
			</tr>
			<?php
				$i++;
				}
			?>
		</tbody>
</table>
<?php include("../../close.php"); ?>