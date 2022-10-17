<?php include("../../conn.php"); ?>
 <br/>       
<div class="col-md-12 col-sm-12 col-xs-12">
    <form name="form" id="demo-form2" class="form-horizontal form-label-left" onSubmit="return false;">
	<input type="hidden" name="kodebidang" id="kodebidang" >
	<input type="hidden" name="kodekegiatanblud" id="kodekegiatanblud" >
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
			<label class="control-label">TANGGAL AWAL</label>
			<input type="text" class="form-control" name="tgl" id="tgl" value="<?php echo date('d/m/Y');?>" />
		</div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
			<label class="control-label">TANGGAL AKHIR</label>
			<input type="text" class="form-control" name="tglx" id="tglx" value="<?php echo date('d/m/Y');?>" />
		</div>
		<div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
			<label class="control-label"></label>
			<input type="button" name="tsimpan" class="btn btn-success btn-block" id="tsimpan" value="LIHAT"  onClick="laporanrinciannpk();">
	    </div>
    </form>     
</div>
<div class="x_content">
	<div class="" role="tabpanel" data-example-id="togglable-tabs">
	  <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
	    <li class="active"><a href="#tab_content1" id="home-tab" data-toggle="tab">REPORT</a></li>
	  </ul>
		<div id="myTabContent" class="tab-content">
			<div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div id="grid_nilaixx"></div>
				</div>
			</div>
		</div> 
	</div>
</div>		
<?php include("../../close.php"); ?>
