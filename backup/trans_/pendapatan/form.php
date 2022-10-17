<?php include("../../conn.php"); ?>
<script  src="calendar.js"></script>
<html>          
<div class="col-md-12 col-sm-12 col-xs-12">
    <form name="form" id="demo-form2" class="form-horizontal form-label-left" onSubmit="return false;">
	<input type="hidden" name="notrans" id="notrans">
	<input type="hidden" name="koderekeningblud" id="koderekeningblud">
	<input type="hidden" name="map79" id="map79">
        <div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">BIDANG/BAGIAN</label>
            <select class="select2_single form-control" tabindex="-1" name="bidang" id="bidang">
            <option value="">-Pilih-</option>
            <?php
                $sql=$conn->query("select * from organisasi where kode4='' and kode3<>''");
                while($rs=$sql->fetch_object()){
            ?>
                <option value="<?php echo $rs->nama;?>"><?php echo $rs->nama;?></option>
            <?php }?>
            </select>
        </div>
		 <div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">URAIAN REKENING BLUD</label>
            <input type="text" class="form-control" name="uraian" id="uraian" />
        </div> 
        <div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">NILAI RUPIAH</label>
            <input type="text" class="form-control" name="nilairupiah" id="nilairupiah" onblur="angka(this);" onkeyup="angka(this);" />
        </div>
		<div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
            <label class="control-label"> </label>
			<input type="button" name="tsimpan" class="btn btn-success btn-block" id="tsimpan" value="SIMPAN"  onClick="simpanpendapatan();">
        </div>
    </form>            
</div>
<table cellpadding="0" border="0" cellspacing="0" width="100%">
	<tr valign="top">
		<td style="font-family:Verdana;color:#000000;font-weight:bold;text-align:center;color:red;text-decoration:underline;background-color:#CCCCCC;">JUMLAH PENDAPATAN</td>
		<td rowspan="2"><a href="" onClick="closebar(); return false"><img src="images/Deletex.ico" border="0" width="20" /></a></td>
	</tr>
	<tr>
		<td style="font-family:Verdana;"><div id="jumlkunjungan"></div></td>
	</tr>
</table>
</html>
<?php include("../../close.php"); ?>
