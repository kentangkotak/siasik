<?php include("../../conn.php"); ?>
<?php
	$sql=$conn->query("select nonpdls as nonpd,tglnpdls as tgl,triwulan as triwulan,pptk as pptk,program as program,kegiatan as kegiatan,kegiatanblud as kegiatanblud,'LS' as ket 
						from npdls_heder where nonpdls='".$_GET['nonpd']."'
						union all
						select nonpdpanjar as nonpd,tglnpdpanjar as tgl,triwulan as triwulan,pptk as pptk,program as program,kegiatan as kegiatan,kegiatanblud as kegiatanblud,'PANJAR' as ket 
						from npdpanjar_heder where nonpdpanjar='".$_GET['nonpd']."'");
	$rs=$sql->fetch_object();
	$tgl=out_tanggal("-",$rs->tgl);
?>
<script  src="calendar.js"></script>
<html>          
<div class="col-md-12 col-sm-12 col-xs-12">
    <form name="form" id="demo-form2" class="form-horizontal form-label-left" onSubmit="return false;">
	<input type="hidden" name="jenis" id="jenis" value="<?php echo $_GET['jenis'];?>">
		<div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
            <label class="control-label">NO NPD</label>
            <input type="text" class="form-control" name="nonpd" id="nonpd" readonly="yes" value="<?php echo $_GET['nonpd'];?>" />
        </div>
		<div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
            <label class="control-label">TANGGAL NPD</label>
            <input type="text" class="form-control" name="tglnpd" id="tglnpd" value="<?php if($_GET['nonpd']==''){ echo date('d/m/Y');}else{ echo $tgl;} ;?>" readonly="yes" />
        </div>
		<div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
            <label class="control-label">TRIWULAN</label>
             <select name="triwulan" id="triwulan" class="form-control" disabled="disabled">
                <option value="">-</option>
                <option value="TRIWULAN 1"<?php if($rs->triwulan=='TRIWULAN 1'){ echo "selected"; }?>>TRIWULAN 1</option>
				<option value="TRIWULAN 2"<?php if($rs->triwulan=='TRIWULAN 2'){ echo "selected"; }?>>TRIWULAN 2</option>
				<option value="TRIWULAN 3"<?php if($rs->triwulan=='TRIWULAN 3'){ echo "selected"; }?>>TRIWULAN 3</option>
				<option value="TRIWULAN 4"<?php if($rs->triwulan=='TRIWULAN 4'){ echo "selected"; }?>>TRIWULAN 4</option>
            </select>
        </div>
		<div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
            <label class="control-label">PPTK</label>
			<span id="caripptk" style="visibility:hidden;">
				<a href="javascript:void(0);" onclick="caripptk();"><img src="images/search.gif" border="0" width="13px" /></a>
			</span>
            <input type="text" class="form-control" name="pptk" id="pptk" value="<?php echo $rs->pptk;?>" readonly="yes"/>
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">PROGRAM</label> 
            <input type="text" class="form-control" name="program" id="program" readonly="yes" value="<?php echo $rs->program;?>"/>
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">KEGIATAN</label>
            <input type="text" class="form-control" name="kegiatan" id="kegiatan" value="<?php echo $rs->kegiatan;?>" readonly="yes"/>
        </div>		
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">KEGIATAN BLUD</label> 
			<!--<span id="carikegiatanblud" style="visibility:hidden;">
				<a href="javascript:void(0);" onclick="carikegiatanblud();"><img src="images/search.gif" border="0" width="13px" /></a>
			</span>-->
            <input type="text" class="form-control" name="kegiatanblud" id="kegiatanblud" value="<?php echo $rs->kegiatanblud;?>" readonly="yes"/>
        </div>
		<div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
            <label class="control-label">TANGGAL CONTRA POST</label>
            <input type="text" class="form-control" name="tglcontrapost" id="tglcontrapost" onClick="return getCalendar(document.form.tglcontrapost);" value="<?php echo date('d/m/Y'); ?>" />
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
