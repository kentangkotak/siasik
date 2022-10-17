<?php include("../../conn.php"); ?>
 <br/>       
<div class="col-md-12 col-sm-12 col-xs-12">
    <form name="form" id="demo-form2" class="form-horizontal form-label-left" onSubmit="return false;">
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <select class="form-control" name="kodekegiatanblud" id="kodekegiatanblud">
            <?php
				if($_SESSION["anggaran_level"] == 'SUPER'){
					$sqlx=$conn->query("select * FROM mappingpptkkegiatan where tahun='".$_SESSION["anggaran_tahun"]."'");
				}else if($_SESSION["anggaran_level"] == 'PPTK'){
					$sqlx=$conn->query("select * FROM mappingpptkkegiatan where tahun='".$_SESSION["anggaran_tahun"]."' 
										and kodebidang='".$_SESSION['anggaran_koderuangan']."'");
				}else{
					$sqlx=$conn->query("select * FROM mappingpptkkegiatan where tahun='".$_SESSION["anggaran_tahun"]."' 
										and kodepptk='".$_SESSION['anggaran_pptk']."'");
				}               
                while($rsx=$sqlx->fetch_object()){
            ?>
                <option value="<?php echo $rsx->kodekegiatan.'|'.$rsx->kegiatan.'|'.$rsx->kodepptk.'|'.$rsx->namapptk?>"><?php echo $rsx->kegiatan;?></option>
            <?php }?>
            </select>
        </div>
		<div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
			<select name="bln" class="form-control" tabindex="3">
					<?php for($bln=1;$bln<=12;$bln++){ ?>
						<option value="<?php echo $bln ; ?>" <?php if (date("m")==$bln) echo "selected" ;?>><?php echo bulan($bln) ;?></option>
					<?php } ?>
			</select>
	    </div>
        <div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
			<select name="thn" id="thn" class="form-control" tabindex="3">
					<option value="<?php echo $_SESSION["anggaran_tahun"]; ?>"><?php echo $_SESSION["anggaran_tahun"] ;?></option>
			</select>
	    </div>
		<div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
			<input type="button" name="tsimpan" class="btn btn-success btn-block" id="tsimpan" value="LIHAT"  onClick="lihatreport();">
	    </div>
		<div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
			<input type="button" name="tsimpan" class="btn btn-success btn-block" id="tsimpan" value="CETAK"  onClick="cetakreport();">
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
					<div id="grid_nilai"></div>
				</div>
			</div>
		</div> 
	</div>
</div>		
<?php include("../../close.php"); ?>
