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
            <label class="control-label">NO. BUKTI</label>
            <input type="text" class="form-control" name="nobukti" id="nobukti" value="<?php echo $_GET['nobukti'] ;?>">
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">TANGGAL</label>
            <input type="text" class="form-control" name="tanggal" id="tanggal" value="<?php if($_GET['nobukti']==''){ echo date('d/m/Y');}else{ echo $tanggal;} ;?>"/>
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">KETERANGAN</label>
            <textarea class="form-control" rows="3" name="keterangan" id="keterangan"><?php echo $rsx->keterangan; ?></textarea>
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
				   <form name="form_rinci" id="form_rinci" class="form-horizontal form-label-left" onSubmit="return false;">
						<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
							<label class="control-label">PSAP 13</label>
							<a href="javascript:void(0);" onclick="caripsap();"><img src="images/search.gif" border="0" width="13px" /></a>
							<input type="text" class="form-control" name="psap13" id="psap13" readonly="yes"/>
						</div>
						<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
							<label class="control-label">URAIAN PSAP 13</label>
							<a href="javascript:void(0);" onclick="caripsapx();"><img src="images/search.gif" border="0" width="13px" /></a>
							<input type="text" class="form-control" name="uraianpsap13" id="uraianpsap13" readonly="yes" />
						</div>
						<div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
							<label class="control-label">DEBET/KREDIT</label>
							<select class="form-control" name="debitkredit" id="debitkredit">
								<option value="">-Pilih-</option>
								<option value="DEBET">DEBET</option>
								<option value="KREDIT">KREDIT</option>
							</select>
						</div>
						<div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
							<label class="control-label">JUMLAH</label>
							<input type="text" class="form-control" name="jumlah" id="jumlah"/>
						</div>
						<?php if($rsx->verif == ''){;?>
						<div class="col-md-3 col-sm-3 col-xs-1">
							<label class="control-label">&nbsp</label> 
							<input type="button" name="tsimpan" class="btn btn-success btn-block" id="tsimpan" value="SIMPAN" size="20" onClick="simpanjurnalumum();">
						</div>
						<div class="col-md-3 col-sm-3 col-xs-1">
							<label class="control-label">&nbsp</label> 
							<input type="button" name="verif" class="btn btn-success btn-block" id="verif" value="VERIF" size="20" onClick="verijurnalumum();">
						</div>	
						<?php }else{?>
						<div class="col-md-3 col-sm-3 col-xs-1">
							<label class="control-label">&nbsp</label> 
							<input type="button" name="batalverif" class="btn btn-success btn-block" id="batalverif" value="BATAL VERIF" size="20" onClick="batalverifverijurnalumum();">
						</div>
						<?php }?>
					</form>
					<div id="grid_nilai"></div>
				</div>
			</div>
		</div> 
	</div>
</div>
<?php include("../../../close.php"); ?>
