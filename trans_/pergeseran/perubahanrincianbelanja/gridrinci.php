<?php include("../../../conn.php"); ?>
<?php

	$sql=$conn->query("select id,notrans,usulan,satuan,koderek50,kodeblud,pagu,idpp,nousulan,volume,harga,koderek108,uraian50,round(sum(kali)) as kali,uraian108 from(   
    select penyesesuaianperioritas_rinci.id as id,penyesesuaianperioritas_rinci.notrans as notrans,penyesesuaianperioritas_rinci.usulan as usulan,
	penyesesuaianperioritas_rinci.satuan as satuan,
	penyesesuaianperioritas_rinci.koderek50 as koderek50,penyesesuaianperioritas_heder.kodekegiatan as kodeblud,
	t_tampung.pagu as pagu,t_tampung.idpp as idpp,penyesesuaianperioritas_rinci.nousulan as nousulan,t_tampung.volume as volume,t_tampung.harga as harga,
	penyesesuaianperioritas_rinci.koderek108 as koderek108,
	penyesesuaianperioritas_rinci.uraian108 as uraian108,penyesesuaianperioritas_rinci.uraian50 as uraian50,'' as kali
	from penyesesuaianperioritas_rinci,penyesesuaianperioritas_heder,t_tampung
	where penyesesuaianperioritas_rinci.notrans='".$_GET['notrans']."' and t_tampung.idpp=penyesesuaianperioritas_rinci.id
	and penyesesuaianperioritas_rinci.notrans=penyesesuaianperioritas_heder.notrans
    union all
	select tbl.*,count(tbl.id) as kali from(select perubahanrincianbelanja.idpp as id,perubahanrincianbelanja.notrans as nogtrans,perubahanrincianbelanja.usulan as usulan,
	perubahanrincianbelanja.satuan as satuan,
	perubahanrincianbelanja.koderek50 as koderek50,perubahanrincianbelanja.kodekegiatanblud as kodeblud,
	t_tampung.pagu as pagu,t_tampung.idpp as idpp,perubahanrincianbelanja.nousulan as nousulan,t_tampung.volume as volume,t_tampung.harga as harga,
	perubahanrincianbelanja.koderek108 as koderek108,
	perubahanrincianbelanja.uraian108 as uraian108,perubahanrincianbelanja.uraian50 as uraian50
	from perubahanrincianbelanja,t_tampung
	where perubahanrincianbelanja.notrans='".$_GET['notrans']."' and t_tampung.idpp=perubahanrincianbelanja.idpp order by id ) as tbl
    group by tbl.idpp) as wew group by idpp order by usulan");
	$i=1;
?>
<div id="contentPagu"></div>
<table class="table table-hover table-bordered table table-striped" id="dataTables-example">
		<thead>
			<tr>
				<th>No.</th>
				<th>USULAN </th>
				<th>VOLUME</th>
				<th>HARGA</th>
				<th>TOTAL</th>
				<th>JUMLAH PERGESERAN</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php while($rs=$sql->fetch_object()){ 
			?>
			<tr>
				<td><?php echo $i; ?></td>
				<td ><?php echo $rs->usulan; ?></td>
				<td align="right"><?php echo round($rs->volume).' '.$rs->satuan; ?></td>
				<td align="right"><?php echo rp($rs->harga); ?></td>
				<td align="right"><?php echo rp($rs->pagu); ?></td>
				<td align="right"><?php echo round($rs->kali); ?> KALI GESER</td>
				<td>
				<a href="javascript:void(0)" onclick="edit_usulan('<?php echo $rs->id; ?>','<?php echo $rs->notrans; ?>',
				'<?php echo $rs->usulan; ?>','<?php echo $rs->volume; ?>','<?php echo $rs->satuan; ?>','<?php echo rpz($rs->harga); ?>',
				'<?php echo rpz($rs->pagu); ?>','<?php echo $rs->koderek50; ?>',
				'<?php echo $rs->idpp; ?>','<?php echo $rs->nousulan; ?>','<?php echo $rs->koderek108; ?>','<?php echo $rs->uraian108; ?>',
				'<?php echo $rs->uraian50; ?>')"><img src="images/edit.png" width="20" height="20"></a>
				</td>
			</tr>
			<?php
				$i++;
				}
			?>
		</tbody>
	</table>
<?php include("../../../close.php"); ?>