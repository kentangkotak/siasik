<?php include("../../conn.php"); ?>
<?php
	$sql=$conn->query("select * from serahterima_heder where noserahterimapekerjaan='".$_GET['noserahterimapekerjaan']."'");
	$rs=$sql->fetch_object();
	
	$tglmulaikontrak=out_tanggal("-",$rs->tglmulaikontrak);
	$tglakhirkontrak=out_tanggal("-",$rs->tglakhirkontrak);
	$tgltrans=out_tanggal("-",$rs->tgltrans);
?>
<script  src="calendar.js"></script>
<html>          
<div class="col-md-12 col-sm-12 col-xs-12">
    <form name="form" id="demo-form2" class="form-horizontal form-label-left" onSubmit="return false;">
	<input type="hidden" name="kodekegiatanblud" id="kodekegiatanblud" value="<?php echo $rs->kodekegiatanblud ;?>">
	<input type="hidden" name="kodepihakketiga" id="kodepihakketiga" value="<?php echo $rs->kodepihakketiga ;?>">
	<input type="hidden" name="kodepptk" id="kodepptk" value="<?php echo $rs->kodepptk ;?>">
	<input type="hidden" name="kodemapingrs" id="kodemapingrs" value="<?php echo $rs->kodemapingrs ;?>">
	<input type="hidden" name="namasuplier" id="namasuplier" value="<?php echo $rs->namasuplier ;?>">
	<!--<input type="hidden" name="koderek50" id="koderek50" value="<?php echo $rs->kode50 ;?>">
	<input type="hidden" name="nilaikegiatan" id="nilaikegiatan" value="<?php echo rpz($rs->nilaikegiatan) ;?>">-->
	<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">NO. SERAH TERIMA PEKERJAAN</label>
			 <input type="text" class="form-control" name="noserahterimapekerjaan" readonly="yes" id="noserahterimapekerjaan" value="<?php echo $_GET['noserahterimapekerjaan'] ;?>">
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">NO. KONTRAK PEKERJAAN</label>
			<a href="javascript:void(0);" onclick="carikontrak();"><img src="images/search.gif" border="0" width="15" /></a>
            <input type="text" class="form-control" name="nokontrak" id="nokontrak" value="<?php echo $rs->nokontrak ;?>" readonly="yes">
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">PERUSAHAAN</label>
			 <input type="text" class="form-control" name="namaperusahaan" readonly="yes" id="namaperusahaan" value="<?php echo $rs->namaperusahaan ;?>">
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">TANGGAL MULAI KONTRAK</label>
            <input type="text" class="form-control" name="tglmulaikontrak" readonly="yes" id="tglmulaikontrak" value="<?php if($_GET['noserahterimapekerjaan']==''){ echo date('d/m/Y');}else{ echo $tglmulaikontrak;} ;?>" />
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">TANGGAL AKHIR KONTRAK</label>
            <input type="text" class="form-control" name="tglakhirkontrak" readonly="yes" id="tglakhirkontrak" value="<?php if($_GET['noserahterimapekerjaan']==''){ echo date('d/m/Y');}else{ echo $tglakhirkontrak;} ;?>" />
        </div> 
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">TANGGAL SERAH TERIMA</label>
            <input type="text" class="form-control" name="tgltrans" id="tgltrans" value="<?php if($_GET['noserahterimapekerjaan']==''){ echo date('d/m/Y');}else{ echo $tgltrans;} ;?>"/>
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">PPTK</label>
            <input type="text" class="form-control" name="namapptk" readonly="yes" id="namapptk" value="<?php echo $rs->namapptk ;?>">
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">PROGRAM</label>
            <input type="text" class="form-control" name="program" id="program" readonly="yes" value="<?php if($_GET['noserahterimapekerjaan']==''){ echo "PROGRAM PENUNJANG URUSAN PEMERINTAH DAERAH KABUPATEN/KOTA";}else{ echo $rs->program;};?> "/>
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">KEGIATAN</label>
            <input type="text" class="form-control" name="kegiatan" id="kegiatan" readonly="yes" value="<?php if($_GET['noserahterimapekerjaan']==''){ echo "PELAYANAN DAN PENUNJANG PELAYANAN BLUD";}else{ echo $rs->kegiatan;};?>"/>
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">KEGIATAN BLUD</label>
            <input type="text" class="form-control" name="kegiatanblud" id="kegiatanblud" value="<?php echo $rs->kegiatanblud ;?>" readonly="yes"/>
        </div>
		<!--<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">URAIAN PEKERJAAN</label>
            <input type="text" class="form-control" name="uraianpekerjaan" id="uraianpekerjaanx" value="<?php echo $rs->uraianpekerjaan ;?>" readonly="yes"/>
        </div>-->
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">NILAI KONTRAK</label>
            <input type="text" class="form-control" name="nilaikontrak" id="nilaikontrak" value="<?php echo rpz($rs->totalpermintaanls) ;?>" readonly="yes"/>
        </div>
	  </div>
    </form>            
</div>
<div class="x_content">
	<div class="" role="tabpanel" data-example-id="togglable-tabs">
	  <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
		<li class="active"><a href="#tab_content1" id="home-tab" data-toggle="tab">RINCIAN REKENING 50</a></li>
		
		<li><a href="#tab_content2" id="profile-tab" data-toggle="tab">RINCIAN NOPENERIMAAN GUDANG FARMASI</a></li>
		
	  </ul>	
		<div id="myTabContent" class="tab-content">
			<div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<form name="form50" id="form50" class="form-horizontal form-label-left" onSubmit="return false;">
						<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
							<label class="control-label">KODE REKENING 50</label>
							<a href="javascript:void(0);" onclick="carirekening50();">
							<img src="images/search.gif" border="0" width="13px" /></a>
							<input type="text" class="form-control" name="kode50" id="kode50" readonly="yes"/>
						</div>
						<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
							<label class="control-label">URAIAN KODE REKENING 50</label>
							<input type="text" class="form-control" name="uraian50" id="uraian50" readonly="yes"/>
						</div>
					    <div class="form-group">
							<div class="col-md-3 col-sm-3 col-xs-1 ">
							   <input type="button" name="tsimpan" class="btn btn-success btn-block" id="tsimpan" value="SIMPAN" size="20" onClick="simpanserahterima50();">
							</div>
					    </div>
					</form>
					<div id="grid_50"></div>
				</div>
			</div>
			<div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
				
					<form name="form_rinci" id="form_rinci" class="form-horizontal form-label-left" onSubmit="return false;">
						<div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
							<label class="control-label">NO PENERIMAAN</label>
							<a href="javascript:void(0);" onclick="carinofaktur();">
							<span id="lokasilaka_content" style="visibility:visible;">
							<img src="images/search.gif" border="0" width="13px" /></a>
							</span>
							<input type="text" class="form-control" name="nopenerimaan" id="nopenerimaan" readonly="yes"/>
						</div>
						<div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
							<label class="control-label">NO FAKTUR</label>
							<input type="text" class="form-control" name="nofaktur" id="nofaktur" readonly="yes"/>
						</div>
						<div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
							<label class="control-label">TANGGAL FAKTUR</label>
							<input type="text" class="form-control" name="tanggalfaktur" id="tanggalfaktur" readonly="yes"/>
						</div>
						<div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
							<label class="control-label">TANGGAL JATUH TEMPO FAKTUR</label>
							<input type="text" class="form-control" name="tanggaljatuhtempo" id="tanggaljatuhtempo" readonly="yes"/>
						</div>
						<div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
							<label class="control-label">DISKON</label> 
							<input type="text" class="form-control" name="diskon" id="diskon" readonly="yes"/>
						</div>
						<div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
							<label class="control-label">TOTAL SEBELUM PPN</label> 
							<input type="text" class="form-control" name="totalbelumppn" id="totalbelumppn" readonly="yes"/>
						</div>
						<div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
							<label class="control-label">TAGIHAN PENERIMAAN</label> 
							<input type="text" class="form-control" name="tagihanpenerimaan" id="tagihanpenerimaan" readonly="yes"/>
						</div>
						<div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
							<label class="control-label">TAGIHAN FAKTUR</label> 
							<input type="text" class="form-control" name="tagihanfaktur" id="tagihanfaktur"/>
						</div>
						  <div class="form-group">
							<div class="col-md-3 col-sm-3 col-xs-1 ">
							   <input type="button" name="tsimpan" class="btn btn-success btn-block" id="tsimpan" value="SIMPAN" size="20" onClick="simpanserahterima();">
							</div>
						  </div>
					</form>
					<div id="grid_nilai"></div>
				
			</div>
		</div>
	</div>
</div>

</html>
<?php include("../../close.php"); ?>
