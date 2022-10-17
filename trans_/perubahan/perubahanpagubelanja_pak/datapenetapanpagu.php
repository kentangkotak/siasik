<?php include("../../../conn.php"); ?>
<?php
if($_SESSION['anggaran_level'] == 'SUPER'){
	$sql=$conn->query("select notrans,kegiatanblud,total,tahun,flag from(
							select notrans,kegiatanblud,total,tahun,'BELUM' as flag 
							from penetapan_pagu 
							where tahun='".$_SESSION["anggaran_tahun"]."' and perubahan='' and perubahan_pak=''
							union all
							select notransawal as notrans,kegiatanblud,perubahan as total,tahun,'SUDAH' as flag  
							from perubahanpagu 
							where tahun='".$_SESSION["anggaran_tahun"]."' and statusperubahan='1' and statusperubahan_pak=''
							union all
							select notransawal as notrans,kegiatanblud,perubahan as total,tahun,'SUDAH P.A.K' as flag  
							from perubahanpagu_pak 
							where tahun='".$_SESSION["anggaran_tahun"]."' and statusperubahan='1')
						as wew order by notrans");
}else{
	$sql=$conn->query("select notrans,kegiatanblud,total,tahun,flag from(
							select notrans,kegiatanblud,total,tahun,'BELUM' as flag 
							from penetapan_pagu 
							where tahun='".$_SESSION["anggaran_tahun"]."' and perubahan='' and perubahan_pak='' and 
							namaorganisasi='".$_SESSION["anggaran_ruangan"]."'
							union all
							select notransawal as notrans,kegiatanblud,perubahan as total,tahun,'SUDAH' as flag  
							from perubahanpagu 
							where tahun='".$_SESSION["anggaran_tahun"]."' and statusperubahan='1' and statusperubahan_pak='' and 
							namaorganisasi='".$_SESSION["anggaran_ruangan"]."' 
							union all
							select notransawal as notrans,kegiatanblud,perubahan as total,tahun,'SUDAH P.A.K' as flag  
							from perubahanpagu_pak
							where tahun='".$_SESSION["anggaran_tahun"]."' and statusperubahan='1' 
							namaorganisasi='".$_SESSION["anggaran_ruangan"]."' )
						as wew order by notrans");
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
				<th>NILAI</th>
				<th>TAHUN</th>
				<th>STATUS PERUBAHAN</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php while($rs=$sql->fetch_object()){ ?>
			<tr>
				<td><?php echo $i; ?></td>
				<td><?php echo $rs->notrans; ?></td>
				<td><?php echo $rs->kegiatanblud; ?></td>
				<td align="right"><?php echo rp($rs->total); ?></td>
				<td><?php echo $rs->tahun; ?></td>
				<td><?php echo $rs->flag; ?></td>
				<td>
					<a href="javascript:void(0)" onclick="formpenetapanpagu('<?php echo $rs->notrans; ?>','1')"><img src="images/edit.png" width="20" height="20"></a>
				</td>
			</tr>
			<?php
				$i++;
				}
			?>
		</tbody>
	</table>
<?php include("../../../close.php"); ?>