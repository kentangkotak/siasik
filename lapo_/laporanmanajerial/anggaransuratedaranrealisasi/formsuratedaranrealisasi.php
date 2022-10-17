<?php include("../../../conn.php"); ?>
<html>          
<div class="col-md-12 col-sm-12 col-xs-12">
    <form name="form" id="demo-form2" class="form-horizontal form-label-left" onSubmit="return false;">
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
			<label class="control-label">TAHUN</label>
			<select name="thn" id="thn" class="form-control" tabindex="3">
					<?php for($x=(date("Y"));$x<=(date("Y"));$x++){ ?>
					<option value="<?php echo $x ; ?>" <?php if (date("Y")==$x) echo "selected" ;?>><?php echo $x ;?></option>
					<?php } ?>
			</select>
		</div>
          <div class="form-group">
            <div class="col-md-3 col-sm-3 ">
			<label class="control-label">&nbsp </label>
               <input type="button" name="cari" class="btn btn-success btn-block" id="cari" value="CARI" size="20" onClick="carilaporansuratedaranrealisasi();">
            </div>
          </div>
    </form>            
</div>
<div class="x_content">
	<div class="" role="tabpanel" data-example-id="togglable-tabs">
	  <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
	    <li class="active"><a href="#tab_content1" id="home-tab" data-toggle="tab">LAPORAN MANAJERIAL ANGGARAN SURAT EDARAN & REALISASI</a></li>
	  </ul>
		<div id="myTabContent" class="tab-content">
			<div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
			<div id="grid_laporan"></div>
		</div>
	</div>
</div>
</html>
<?php include("../../../close.php"); ?>	