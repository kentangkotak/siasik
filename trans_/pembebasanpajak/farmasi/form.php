<?php include("../../../conn.php"); ?>
<?php
	$sql=$conn->query("select * from bebaspajak_heder where nopenerimaan='".$_GET['nopenerimaan']."' ");
	$rs=$sql->fetch_object();
	$tglnpdls=out_tanggal("-",$rs->tglnpdls);
?>
<script  src="calendar.js"></script>
<html>          
<div class="col-md-12 col-sm-12 col-xs-12">
    <form name="form" id="demo-form2" class="form-horizontal form-label-left" onSubmit="return false;">
		<div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
            <label class="control-label">NO PENERIMAAN</label>
            <input type="text" class="form-control" name="nopenerimaan" id="nopenerimaan" value="<?php echo $_GET['nopenerimaan'];?>"/>
        </div>
		<div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
            <label class="control-label">NO FAKTUR</label>
            <input type="text" class="form-control" name="nofaktur" id="nofaktur" value="<?php echo $rs->nofaktur;?>"/>
        </div>
		<div class="col-md-3 col-sm-3 col-xs-1 ">
			<label class="control-label">&nbsp;</label> 
			<input type="button" name="tsimpan" class="btn btn-success btn-block" id="tsimpan" value="CARI" size="20" onClick="carifaktur();">
		</div>
	</form>
</div>
<div class="x_content">
	<div class="" role="tabpanel" data-example-id="togglable-tabs">
	  <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
	    <li class="active"><a href="#tab_content1" id="home-tab" data-toggle="tab">KETERANGAN FAKTUR</a></li>
	  </ul>
		<div id="myTabContent" class="tab-content">
			<div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
				<div class="col-md-12 col-sm-12 col-xs-12">
				<div id="grid_nilai"></div>
				</div>
			</div>
		</div> 
	</div>
</div>		
</html>
<?php include("../../../close.php"); ?>
