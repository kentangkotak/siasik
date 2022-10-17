<?php include("../../conn.php"); ?>
<?php
	$sql=$conn->query("select penyesesuaianperioritas_heder.kodekegiatan as kodekegiatan,penyesesuaianperioritas_heder.kegiatan as kegiatanblud,penyesesuaianperioritas_rinci.koderek50 as koderek50,penyesesuaianperioritas_rinci.uraian50 as uraian50,
penyesesuaianperioritas_rinci.koderek108 as koderek108,penyesesuaianperioritas_rinci.uraian108 as uraian108,
penyesesuaianperioritas_rinci.usulan as usulan,penyesesuaianperioritas_rinci.nilai as total
from penyesesuaianperioritas_heder,penyesesuaianperioritas_rinci
where penyesesuaianperioritas_heder.notrans=penyesesuaianperioritas_rinci.notrans and penyesesuaianperioritas_rinci.koderek50='".$_GET[koderek50]."'
and year(penyesesuaianperioritas_heder.tgltrans)='".$_SESSION["anggaran_tahun"]."' and penyesesuaianperioritas_heder.kodekegiatan='".$_GET[kodekegiatan]."'
	");

	$i=1;
?>
<br />

<table class="table table-hover table-bordered table table-striped" id="dataTables-example">
		<thead>
			<tr>
				<th>USULAN </th>
				<th>KODE REKENING 108</th>
				<th>URAIAN 108</th>
				<th>KODE REKENING 50</th>
				<th>URAIAN 50</th>
				<th>JUMLAH</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php while($rs=$sql->fetch_object()){ ?>
			<tr>
				<td><?php echo $rs->usulan;?></td>
				<td><?php echo $rs->koderek108;?></td>
				<td><?php echo $rs->uraian108;?></td>
				<td><?php echo $rs->koderek50;?></td>
				<td><?php echo $rs->uraian50;?></td>
				<td><?php echo rpzx($rs->total);?></td>
				<td><a href="javascript:void(0)" onclick="tingkat3('<?php echo $_GET['kodekegiatan'];?>')" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> Back </a></td>
			</tr>
			<?php
				$i++;
				}
			?>
		</tbody>
</table>
<?php include("../../close.php"); ?>