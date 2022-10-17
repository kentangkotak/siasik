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
            <label class="control-label">NO PENCAIRAN</label>
            <input type="text" class="form-control" name="nopencairan" id="nopencairan" readonly="yes"/>
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">TANGGAL PINDAH BUKU</label>
            <input type="text" class="form-control" name="tglpindahbuku" id="tglpindahbuku" value="<?php echo date('d/m/Y');?>" onClick="return getCalendar(document.form.tglpindahbuku);" />
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">TANGGAL PENCAIRAN</label>
            <input type="text" class="form-control" name="tglpencairan" id="tglpencairan" value="<?php echo date('d/m/Y');?>" onClick="return getCalendar(document.form.tglpencairan);" />
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">NO NPK LS</label>
            <input type="text" class="form-control" name="nonpk" id="nonpk" readonly="yes" value="<?php echo $_GET['nonpk'];?>" />
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">TANGGAL NPK LS</label>
            <input type="text" class="form-control" name="tglnpk" id="tglnpk" value="<?php if($_GET['nonpk']==''){ echo date('d/m/Y');}else{ echo $tglnpk;} ;?>" onClick="return getCalendar(document.form.tglnpk);" />
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">AKUN</label> 
            <input type="text" class="form-control" name="akun" id="akun" value="Akun BLUD" readonly="yes" />
        </div>
		<div class="col-md-3 col-sm-3 col-xs-1 ">
			<label class="control-label"></label> 
               <input type="button" name="tsimpan" class="btn btn-success btn-block" id="tsimpan" value="PENCAIRAN" size="20" onClick="cairkan();">
            </div>
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
<div class="ln_solid"></div>            
<div id="grid_nilai"></div>
</html>
<?php include("../../close.php"); ?>
