<?php include("../../conn.php"); ?>
<?php
	$sql=$conn->query("select * from npkls_heder where nonpk='".$_GET['nonpk']."' ");
	$rs=$sql->fetch_object();
	$tglnpk=out_tanggal("-",$rs->tglnpk);
?>
<script  src="calendar.js"></script>
<html>          
<div class="col-md-12 col-sm-12 col-xs-12">
    <form name="form" id="demo-form2" class="form-horizontal form-label-left" onSubmit="return false;">
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">NO NPK LS</label>
            <input type="text" class="form-control" name="nonpk" id="nonpk" value="<?php echo $_GET['nonpk'];?>" readonly="yes"/>
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">TANGGAL NPK LS</label>
            <input type="text" class="form-control" name="tglnpk" id="tglnpk" value="<?php if($_GET['nonpk']==''){ echo date('d/m/Y');}else{ echo $tglnpk;} ;?>" onClick="return getCalendar(document.form.tglnpk);" />
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">AKUN</label> 
            <input type="text" class="form-control" name="akun" id="akun" value="Akun BLUD" readonly="yes" />
        </div>
    </form>            
</div>
<div class="x_content">
	<div class="" role="tabpanel" data-example-id="togglable-tabs">
	  <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
		<li class="active"><a href="#tabs-0">RINCIAN</a></li>	
	  </ul>
	</div>
</div>
<div class="col-md-12 col-sm-12 col-xs-12">
   <form name="form_rinci" id="form_rinci" class="form-horizontal form-label-left" onSubmit="return false;">
		<input type="hidden" name="kodekegiatanblud" id="kodekegiatanblud" />
		<div class="form-group col-md-12 col-xs-12 col-sm-12 col-lg-12">
            <label class="control-label">NO NPD LS</label>
			<span id="lokasilaka_content" style="visibility:visible;">
				<a href="javascript:void(0);" onclick="carinpdls();"><img src="images/search.gif" border="0" width="13px" /></a>
			</span>
            <input type="text" class="form-control" name="nonpdls" id="nonpdls" readonly="yes"/>
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">TANGGAL NPD LS</label> 
            <input type="text" class="form-control" name="tglnpd" id="tglnpd" readonly="yes"/>
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">KEGIATAN</label> 
            <input type="text" class="form-control" name="kegiatan" id="kegiatan" readonly="yes"/>
        </div>
        <div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">KEGIATAN BLUD</label> 
            <input type="text" class="form-control" name="kegiatanblud" id="kegiatanblud" readonly="yes"/>
        </div>
		 <div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">TOTAL</label> 
            <input type="text" class="form-control" name="total" id="total" readonly="yes"/>
        </div>
          <div class="form-group">
            <div class="col-md-3 col-sm-3 col-xs-1 ">
			<label class="control-label"></label> 
               <input type="button" name="tsimpan" class="btn btn-success btn-block" id="tsimpan" value="SIMPAN" size="20" onClick="simpannpkls();">
            </div>
			<div class="col-md-3 col-sm-3 col-xs-1 ">
			<label class="control-label"></label> 
               <input type="button" name="tsimpan" class="btn btn-success btn-block" id="tsimpan" value="CETAK" size="20" onClick="cetaknpkls();">
            </div>
          </div>
    </form>
</div>               
<div id="grid_nilai"></div>
</html>
<?php include("../../close.php"); ?>
