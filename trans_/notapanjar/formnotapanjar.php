<?php include("../../conn.php"); ?>
<?php
	$sql=$conn->query("select * from notapanjar_heder where nonotapanjar='".$_GET['nonotapanjar']."' ");
	$rs=$sql->fetch_object();
	$tglnotapanjar=out_tanggal("-",$rs->tglnotapanjar);
?>
<script  src="calendar.js"></script>
<html>          
<div class="col-md-12 col-sm-12 col-xs-12">
    <form name="form" id="demo-form2" class="form-horizontal form-label-left" onSubmit="return false;">
		<input type="hidden" name="kodepptk" id="kodepptk" onChange="fungsikomplet(this.value);" value="<?php echo $rs->kodepptk;?>"/>
		<input type="hidden" name="kodekegiatanblud" id="kodekegiatanblud" onChange="fungsikomplet(this.value);" value="<?php echo $rs->kodekegiatanblud;?>"/>
		<input type="hidden" name="kodebidang" id="kodebidang" onChange="fungsikomplet(this.value);" value="<?php echo $rs->kodebidang;?>"/>
		<input type="hidden" name="bidang" id="bidang" onChange="fungsikomplet(this.value);" value="<?php echo $rs->bidang;?>"/>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">NO NOTA PANJAR</label>
            <input type="text" class="form-control" name="nonotapanjar" id="nonotapanjar" readonly="yes" value="<?php echo $_GET['nonotapanjar'];?>" />
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">TANGGAL NOTA PANJAR</label>
            <input type="text" class="form-control" name="tglnotapanjar" id="tglnotapanjar" value="<?php if($_GET['nonotapanjar']==''){ echo date('d/m/Y');}else{ echo $tglnotapanjar;} ;?>" onClick="return getCalendar(document.form.tglnotapanjar);" />
        </div>
		<div class="form-group col-md-10 col-xs-10 col-sm-10 col-lg-10">
            <label class="control-label">NO. NPD</label>
			<span id="carinonpd" style="visibility:visible;">
				<a href="javascript:void(0);" onclick="carinonpd();"><img src="images/search.gif" border="0" width="13px"/></a>
			</span>
            <input type="text" class="form-control" name="nonpd" id="nonpd" value="<?php echo $rs->nonpd;?>" readonly="yes"/>
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">TRIWULAN</label>
             <select name="triwulan" id="triwulan" class="form-control" readonly="yes">
                <option value="">-</option>
                <option value="TRIWULAN 1"<?php if($rs->triwulan=='TRIWULAN 1'){ echo "selected"; }?>>TRIWULAN 1</option>
				<option value="TRIWULAN 2"<?php if($rs->triwulan=='TRIWULAN 2'){ echo "selected"; }?>>TRIWULAN 2</option>
				<option value="TRIWULAN 3"<?php if($rs->triwulan=='TRIWULAN 3'){ echo "selected"; }?>>TRIWULAN 3</option>
				<option value="TRIWULAN 4"<?php if($rs->triwulan=='TRIWULAN 4'){ echo "selected"; }?>>TRIWULAN 4</option>
            </select>
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">PPTK</label> 
            <input type="text" class="form-control" name="pptk" id="pptk" value="<?php echo $rs->pptk;?>" readonly="yes"/>
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">PROGRAM</label> 
            <input type="text" class="form-control" name="program" id="program" readonly="yes" value="PROGRAM PENUNJANG URUSAN PEMERINTAH DAERAH KABUPATEN/KOTA" />
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">KEGIATAN</label> 
            <input type="text" class="form-control" name="kegiatan" id="kegiatan" readonly="yes" value="PELAYANAN DAN PENUNJANG PELAYANAN BLUD" />
        </div>		
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">KEGIATAN BLUD</label> 
            <input type="text" class="form-control" name="kegiatanblud" id="kegiatanblud" readonly="yes" value="<?php echo $rs->kegiatanblud;?>"/>
        </div>
    </form>            
</div>
<div class="col-md-12 col-sm-12 col-xs-12">
   <form name="form_rinci" id="form_rinci" class="form-horizontal form-label-left" onSubmit="return false;">
		<input type="hidden" name="koderek50" id="koderek50" onChange="fungsikomplet(this.value);"  value="<?php echo $rs->koderek50;?>"/>
		<input type="hidden" name="nopp" id="nopp" />
		<input type="hidden" name="nousulan" id="nousulan" />
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">RINCIAN BELANJA</label> 
            <input type="text" class="form-control" name="rincianbelanja" readonly="yes" id="rincianbelanja" value="<?php echo $rs->rincianbelanja50;?>" />
        </div>
		 <div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">TOTAL</label> 
            <input type="text" class="form-control" name="total" id="total" readonly="yes"/>
        </div>
         <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-3 col-sm-3 col-xs-1 ">
			<label class="control-label"></label> 
               <input type="button" name="tsimpan" class="btn btn-success btn-block" id="tsimpan" value="SIMPAN" size="20" onClick="simpannotapanjar();">
            </div>
			<!--<div class="col-md-3 col-sm-3 col-xs-1 ">
               <input type="button" name="batal" class="btn btn-success btn-block" id="batal" value="HAPUS TRANSAKSI" size="20" onClick="hapustransaksi();">
            </div>-->
          </div>
    </form>
</div>                
<div id="grid_nilai"></div>
</html>
<?php include("../../close.php"); ?>
