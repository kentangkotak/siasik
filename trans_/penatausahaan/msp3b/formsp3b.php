<?php include("../../../conn.php"); ?>
<?php
	$sqlx=$conn->query("select * from jurnalumum_heder where nobukti='".$_GET['nobukti']."'");
	$rsx=$sqlx->fetch_object();
	$tanggal=out_tanggal("-",$rsx->tanggal);
?>
<script  src="calendar.js"></script>         
<div class="col-md-12 col-sm-12 col-xs-12">
    <form name="form" id="demo-form2" class="form-horizontal form-label-left" onSubmit="return false;">
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">NOMOR</label>
            <input type="text" class="form-control" readonly="yes" name="nomor" id="nomor" value="<?php echo $_GET['nomor'] ;?>">
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">TANGGAL</label>
            <input type="text" class="form-control" name="tanggal" id="tanggal" value="<?php if($_GET['nobukti']==''){ echo date('d/m/Y');}else{ echo $tanggal;} ;?>"/>
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">BULAN REALISASI</label>
           <input type="text" class="form-control" name="bulantahun" id="bulantahun" value="<?php if($_GET['nobukti']==''){ echo date('m/Y');}else{ echo $bulan;} ;?>"/>
        </div>
		<div class="col-md-3 col-sm-3 col-xs-1">
			<label class="control-label">&nbsp;</label> 
			<input type="button" name="tsimpan" class="btn btn-success btn-block" id="tsimpan" value="SIMPAN" size="20" onClick="simpansp3b();">
		</div>
    </form>            
</div>
<div class="x_content">
	<div class="" role="tabpanel" data-example-id="togglable-tabs">
	  <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
	    <li class="active"><a href="#tab_content1" id="home-tab" data-toggle="tab">RINCI</a></li>
	  </ul>
		<div id="myTabContent" class="tab-content">
			<div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div id="grid_sp3b"></div>
				</div>
			</div>
		</div> 
	</div>
</div>
<?php include("../../../close.php"); ?>
