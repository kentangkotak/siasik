<div id='cariusulancontent'>
<?php include "../../conn.php";?>
<?php			
	$conn_simrs = new mysqli("192.168.11.1","admin","alam01989sa","rs");				
	$tahunlalu= $_SESSION["anggaran_tahun"] - 1;

	$usulantxt='';
	if(isset($_GET['usulantxt']))
		$usulantxt=$_GET['usulantxt'];

    $sql=$conn_simrs->query("select nopenerimaan,nofaktur,suplier,tglfaktur,tgljatuhtempo,round(diskon),sum(subtotal) as totalbelumppn,round(sum(subtotal)*pajakppn/100,2) as ppn,
round(sum(subtotal)+sum(subtotal)*pajakppn/100,2) as total from(
          select rs81.rs1 as nopenerimaan,rs81.rs5 as nofaktur,rs89.rs2 as suplier,rs81.rs11 as tglfaktur,rs81.rs9 as tgljatuhtempo,round(rs81.rs13,2) as pajakppn,
          rs82.rs2 as kode,rs32.rs2 as obat,if(rs82.rs3>0,rs82.rs3,rs82.rs4) as jumlah,rs82.rs11 as satuan,rs82.rs8 as diskon,if(rs82.rs3>0,rs82.rs3*rs82.rs14,
          rs82.rs4*rs82.rs14) as subtotal
          from rs32,rs81,rs82,rs89
          where rs81.rs1=rs82.rs1 and rs82.rs2=rs32.rs1 and rs81.rs3=rs89.rs1 and rs81.rs19=''
		  and rs81.rs21<>'2'
		  and rs81.rs3='".$_GET['kodemapingrs']."') 
		  as xxx where nopenerimaan like '%".$usulantxt."%' group by nopenerimaan");
$i=1;
?>
<input type='text' name='cariusulantxt' id='cariusulantxt'>
<input type="button" value="Cari" onclick='cariusulan();'>
<table class="table table-hover table-bordered table table-striped" id="dataTables-example">
	<thead>
		<tr>
			<th>No.</th>
			<th>NO PENERIMAAN</th>
			<th>NO FAKTUR</th>
			<th>SUPPLIER</th>
			<th>TGL FAKTUR</th>
			<th>TGL JATUH TEMPOE</th>
			<th>TOTAL BELUM PPN</th>
			<th>PPN</th>
			<th>TOTAL</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php while($rs=$sql->fetch_object()){ ?>
		<tr>
			<td><?php echo $i; ?></td>
			<td><?php echo $rs->nopenerimaan; ?></td>
			<td><?php echo $rs->nofaktur; ?></td>
			<td><?php echo $rs->suplier; ?></td>
			<td><?php echo $rs->tglfaktur; ?></td>
			<td><?php echo $rs->tgljatuhtempo; ?></td>
			<td align="right" nowrap="nowrap"><?php echo rp($rs->totalbelumppn); ?></td>
			<td align="right"><?php echo rp($rs->ppn); ?></td>
			<td align="right"><?php echo rp($rs->total); ?></td>
			<td><input type="button" value="PILIH" onclick="pilihfakturpenerimaan('<?php echo $rs->nopenerimaan;?>','<?php echo $rs->nofaktur;?>','<?php echo $rs->diskon; ?>',
			'<?php echo rpz($rs->total); ?>','<?php echo out_tanggal("-",$rs->tglfaktur);?>','<?php echo out_tanggal("-",$rs->tgljatuhtempo);?>','<?php echo $rs->diskon;?>','<?php echo rpz($rs->totalbelumppn);?>');"></td>
		</tr>
		<?php $i++; } ?>
	</tbody>
</table>	
<script>
	function cariusulan(){
		usulantxt = document.querySelector('#cariusulantxt').value;
		kodemapingrs = document.querySelector('#kodemapingrs').value;
		$.get('trans_/serahterimapekerjaan/carinofaktur.php',{
			usulantxt:usulantxt,
			kodemapingrs:kodemapingrs,
		},
		function(rs){ 
			document.querySelector('#cariusulancontent').innerHTML = rs;
		});
	}
</script>
<?php include "../../close.php";?>
</div>