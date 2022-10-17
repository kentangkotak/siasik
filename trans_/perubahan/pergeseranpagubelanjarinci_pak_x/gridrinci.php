<?php include("../../../conn.php"); ?>
<?php
	$sql=$conn->query("select id,notrans,nousulan,usulan,volume,satuan,harga,nilai,flagberubah from(
							   select id,notrans,nousulan,usulan,volume,satuan,harga,nilai,'BELUM' as flagberubah 
							   from penyesesuaianperioritas_rinci
							   where statusperubahan='' and statusperubahan_pak='' and statusperubahan_pak_x='' and
							   notrans='".$_GET['notrans']."'
							   union all
							   select idpp as id,notrans,nousulan,usulan,volumebaru as volume,satuan,hargabaru as harga,totalbaru as nilai,'SUDAH' as flagberubah 
							   from perubahanrincianbelanja
							   where statusperubahan='1' and statusperubahan_pak='' and statusperubahan_pak_x='' and 
							   notrans='".$_GET['notrans']."'
							   union all
							   select id,notrans,nousulan,usulan,volumebaru as volume,satuan,hargabaru as harga,totalbaru as nilai,'wew' as flagberubah 
							   from perubahanrincianbelanja_pak
							   where statusperubahan='1' and notrans='".$_GET['notrans']."' and statusperubahan_pak_x=''
							   union all
							   select id,notrans,nousulan,usulan,volumebaru as volume,satuan,hargabaru as harga,totalbaru as nilai,'wew_x' as flagberubah 
							   from perubahanrincianbelanja_pak_x
							   where statusperubahan='1' and notrans='".$_GET['notrans']."'
						) as wew order by usulan");
	$i=1;
?>
<div id="contentPagu"></div>
<table class="table table-hover table-bordered table table-striped" id="dataTables-example">
		<thead>
			<tr>
				<th>No.</th>
				<th>USULAN </th>
				<th>VOLUME </th>
				<th>HARGA</th>
				<th>TOTAL</th>
				<th>STATUS PERUBAHAN</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php while($rs=$sql->fetch_object()){ ?>
			<tr>
				<td><?php echo $i; ?></td>
				<td><?php echo $rs->usulan; ?></td>
				<td><?php echo $rs->volume.' ( '.$rs->satuan; ?> )</td>
				<td><?php echo rp($rs->harga); ?></td>
				<td><?php echo rp($rs->nilai); ?></td>
			<td><?php if($rs->flagberubah == "wew"){ 
							echo "SUDAH P.A.K";
					  }else if($rs->flagberubah == "wew_x"){
						  echo "SUDAH PERUBAHAN P.A.K";
					  }else{ 
						echo $rs->flagberubah;
					  } ?></td>
				<td>
				<a href="javascript:void(0)" onclick="edit_usulan('<?php echo $rs->id; ?>','<?php echo $rs->notrans; ?>','<?php echo $rs->flagberubah; ?>')"><img src="images/edit.png" width="20" height="20"></a>
				</td>
			</tr>
			<?php
				$i++;
				}
			?>
		</tbody>
	</table>
<?php include("../../../close.php"); ?>