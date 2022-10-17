<?php include("../../conn.php"); ?>
<?php
	$sql=$conn->query("select koderek50,rincianbelanja,itembelanja,nominal,nominalcontrapost,idpp from(
	select npdls_rinci.koderek50 as koderek50,npdls_rinci.rincianbelanja as rincianbelanja,npdls_rinci.itembelanja as itembelanja,
npdls_rinci.nominalpembayaran as nominal,'' as nominalcontrapost,npdls_rinci.idserahterima_rinci as idpp
from npdls_heder,npdls_rinci where npdls_rinci.nonpdls=npdls_heder.nonpdls and npdls_rinci.nonpdls='".$_GET['nonpd']."'
union all
select npdpanjar_rinci.koderek50 as koderek50,npdpanjar_rinci.rincianbelanja50 as rincianbelanja,npdpanjar_rinci.itembelanja as itembelanja,
npdpanjar_rinci.totalpermintaanpanjar as nominal,'' as nominalcontrapost,npdpanjar_rinci.idpp as idpp
from npdpanjar_heder,npdpanjar_rinci where npdpanjar_rinci.nonpdpanjar=npdpanjar_heder.nonpdpanjar and npdpanjar_heder.nonpdpanjar='".$_GET['nonpd']."'
) as xxx group by idpp,nominal");
$i=1;
?>
<form name="formrinci" id="demo-form2" class="form-horizontal form-label-left" onSubmit="return false;">
	<table class="table table-hover table-bordered table table-striped">
			<thead>
				<tr>
					<th>No.</th>
					<th>KODE REKENING BELANJA </th>
					<th>RINCIAN BELANJA </th>
					<th>ITEM BELANJA</th>
					<th>NOMINAL PEMBAYARAN</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php while($rs=$sql->fetch_object()){ ?>
				<tr>
					<td><?php echo $i; ?></td>
					<td><?php echo $rs->koderek50; ?></td>
					<td><?php echo $rs->rincianbelanja; ?></td>
					<td><?php echo $rs->itembelanja; ?></td>
					<td align="right"><?php echo rpzx($rs->nominal); ?></td>
					<td nowrap>	<input type="text" name="nominal_<?php echo $i; ?>" id="nominal_<?php echo $i; ?>"/> 
								<input type="button" name="tsimpan" class="btn btn-success" id="tsimpan" value="SIMPAN" size="10" 
								onClick="simpancontrapost('<?php echo $rs->koderek50;?>','<?php echo $rs->rincianbelanja; ?>',
								'<?php echo $rs->itembelanja; ?>','<?php echo $i; ?>','<?php echo $rs->idpp; ?>');"></td>
				</tr>
				<?php $i++; $subtotal=$subtotal+$rs->nominal; $subtotalx=$subtotalx+$rs->totalls;}
				?>
				<tr>
					<td colspan="4" align="right">SUBTOTAL</td>
					<td align="right"><?php echo rpzx($subtotal); ?></td>
					<td></td>
				</tr>
			</tbody>
	</table>
</form>
<?php include("../../close.php"); ?>