<?php include("../../conn.php"); ?>
<?php
	// $sql=$conn->query("select nonpdls as nonpd,tglnpdls as tgl,triwulan as triwulan,pptk as pptk,program as program,kegiatan as kegiatan,kegiatanblud as kegiatanblud,'LS' as ket 
						// from npdls_heder where nonpdls='".$_GET['nonpd']."'
						// union all
						// select nonpdpanjar as nonpd,tglnpdpanjar as tgl,triwulan as triwulan,pptk as pptk,program as program,kegiatan as kegiatan,kegiatanblud as kegiatanblud,'PANJAR' as ket 
						// from npdpanjar_heder where nonpdpanjar='".$_GET['nonpd']."'");
	// $rs=$sql->fetch_object();
	// $tgl=out_tanggal("-",$rs->tgl);
?>
<script  src="calendar.js"></script>
<html>          
<div class="col-md-12 col-sm-12 col-xs-12">
    <form name="form" id="demo-form2" class="form-horizontal form-label-left" onSubmit="return false;">
	<input type="hidden" name="jenis" id="jenis" value="<?php echo $_GET['jenis'];?>">
		<div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
            <label class="control-label">NO TRANSAKSI SILPA</label>
            <input type="text" class="form-control" name="notrans" id="notrans" readonly="yes" />
        </div>
		<div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
            <label class="control-label">TANGGAL</label>
            <input type="text" class="form-control" name="tgl" id="tgl" value="<?php echo date("d/m/Y");?>"/>
        </div>
		<div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
            <label class="control-label">TAHUN SILPA</label> 
            <input type="text" class="form-control" name="thnsilpa" id="thnsilpa" value="<?php echo date("Y");?>"/>
        </div>
		<div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
            <label class="control-label">NOMINAL</label>
            <input type="text" class="form-control" name="nominal" id="nominal"/>
        </div>
		<div class="form-group">
			<div class="col-md-3 col-sm-3 col-xs-1 ">
			<label class="control-label"></label> 
			   <input type="button" name="tsimpan" class="btn btn-success btn-block" id="tsimpan" value="SIMPAN" size="20" onClick="simpansilpa();">
			</div>
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
					<div id="grid_nilai"></div>
				</div>
			</div>
		</div> 
	</div>
</div>	
</html>
<?php include("../../close.php"); ?>
