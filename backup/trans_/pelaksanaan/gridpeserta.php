<?php include("../../conn.php"); ?>
<?php
	
		$sql=$conn->query("select rs33.rs1 as notrans,rs33.rs4 as nip,pegawai.nama as nama,rs33.rs10 as nosttp,
							rs33.rs8 as filex,rs33.rs9 as files
						from rs32,rs33,pegawai
						where rs32.rs1=rs33.rs1 and rs33.rs4=pegawai.nip and rs32.rs1='".$_GET['notrans']."' ");
	
	$i=1;
?>
<br />
<table class="table table-hover table-bordered table table-striped" id="dataTables-example">
		<thead>
			<tr>
				<th>No.</th>
				<th>NIP </th>
				<th>NAMA </th>
				<th>No. STTP </th>
				<th>FILES </th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php while($rs=$sql->fetch_object()){ $notransx=str_replace("/",".",$rs->notrans)?>
			<tr>
				<td><?php echo $i; ?></td>
				<td><?php echo $rs->nip; ?></td>
				<td nowrap="nowrap"><?php echo $rs->nama; ?></td>
				<?php if($rs->nosttp==''){ ;?>
					<td><input type="text" name="nosttp<?php echo $rs->nip;?>" id="nosttp<?php echo $rs->nip;?>"> 
					<input type="button" name="simpan" class="btn btn-success" id="simpan" value="UPDATE" width="10" height="10" onClick="simpannosttp('<?php echo $rs->nip;?>','<?php echo $rs->notrans; ?>');"></td>
				<?php }else{ ?>
					<td><?php echo $rs->nosttp; ?></td>
				<?php } ?>
				<?php if($rs->filex==''){ ;?>
					<td><form name="formgambar<?php echo $rs->nip;?>" id="formgambar<?php echo $rs->nip;?>" onSubmit="return false;">
						<input type="hidden" name="notrans" id="notrans" value="<?php echo $notransx; ?>">
						<input type="hidden" name="nip" id="nip" value="<?php echo $rs->nip; ?>">
						<input type="file" id="foto" name="foto" accept="image/*"> <input type="button" name="tsimpan" class="btn btn-success" id="tsimpan" value="UPDATE" width="10" height="10" onClick="simpangambar('<?php echo $rs->nip;?>','<?php echo $rs->notrans; ?>');"></form>
					</td>
				<?php }else{ ?>
					<td><a href="javascript:void(0)" onclick="lihat_depan('<?php echo $notransx; ?>','<?php echo $rs->nip; ?>','<?php echo $rs->filex; ?>')"><?php echo $rs->filex; ?></a></td>
				<?php } ?>
				<td><a href="javascript:void(0)" onclick="hapus_rinci('<?php echo $rs->notrans; ?>','<?php echo $rs->nip; ?>','<?php echo $rs->filex; ?>')"><img src="images/hapus.png" width="20" height="20"></a></td>
			</tr>
			<?php
				$i++;
				}
			?>
		</tbody>
	</table>
<?php include("../../close.php"); ?>