<?php include("../../conn.php"); ?>
<?php
	$sql=$conn->query("select penyesesuaianperioritas_heder.kodekegiatan as kodekegiatan,penyesesuaianperioritas_heder.kegiatan as kegiatanblud,
						sum(penyesesuaianperioritas_rinci.nilai) as total
						from penyesesuaianperioritas_heder,penyesesuaianperioritas_rinci
						where penyesesuaianperioritas_heder.notrans=penyesesuaianperioritas_rinci.notrans 
						and year(penyesesuaianperioritas_heder.tgltrans)='".$_SESSION["anggaran_tahun"]."'
						group by penyesesuaianperioritas_heder.kegiatan");

	$i=1;
?>
<br />

<table class="table table-hover table-bordered table table-striped" id="dataTables-example">
		<thead>
			<tr>
				<th>KEGIATAN BLUDx</th>
				<th>JUMLAH</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php while($rs=$sql->fetch_object()){ ?>
			<tr>
				<td><?php echo $rs->kegiatanblud;?></td>
				<td><?php echo rpzx($rs->total);?></td>
				<td>
				<a href="javascript:void(0)" onclick="tingkat3('<?php echo $rs->kodekegiatan;?>')" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> View </a>
				<a href="javascript:void(0)" onclick="tingkat1()" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> Back </a>
				</td>
			</tr>
			<?php
				$i++;
				}
			?>
		</tbody>
</table>
<?php include("../../close.php"); ?>