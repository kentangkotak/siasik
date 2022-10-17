<?php include("../../conn.php"); ?>
<script  src="calendar.js"></script>

<html>          
<div class="col-md-12 col-sm-12 col-xs-12">
    <form name="form" id="demo-form2" class="form-horizontal form-label-left" onSubmit="return false;">
<!--	<input type="hidden" name="kodepptk" id="kodepptk"> -->
        <div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
			<label class="control-label">TANGGAL AWAL</label>
			<input type="text" class="form-control" name="tgl" id="tgl" value="<?php echo date('d/m/Y');?>" />
		</div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
			<label class="control-label">TANGGAL AKHIR</label>
			<input type="text" class="form-control" name="tglx" id="tglx" value="<?php echo date('d/m/Y');?>" />
		</div>
	<!--	<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">PPTK</label>
				<a href="javascript:void(0);" onclick="caripptk();"><img src="images/search.gif" border="0" width="13px" /></a>
            <input type="text" class="form-control" name="pptk" id="pptk" value="<?php echo $rs->pptk;?>" />
        </div>-->
          <div class="form-group">
            <div class="col-md-3 col-sm-3 ">
			<label class="control-label">&nbsp </label>
               <input type="button" name="cari" class="btn btn-success btn-block" id="cari" value="CARI" size="20" onClick="caribukubantuls();">
            </div>
          </div>
    </form>            
</div>
<div class="x_content">
	<div class="" role="tabpanel" data-example-id="togglable-tabs">
	  <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
	    <li class="active"><a href="#tab_content1" id="home-tab" data-toggle="tab">LAPORAN BUKU BANTU LS PPK</a></li>
	  </ul>
		<div id="myTabContent" class="tab-content">
			<div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
			<div id="grid_laporan"></div>
		</div>
	</div>
</div>
</html>
<?php include("../../close.php"); ?>
