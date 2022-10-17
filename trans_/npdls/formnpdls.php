<?php include("../../conn.php"); ?>
<?php
	$sql=$conn->query("select * from npdls_heder where nonpdls='".$_GET['nonpdls']."' ");
	$rs=$sql->fetch_object();
	$tglnpdls=out_tanggal("-",$rs->tglnpdls);
?>
<script  src="calendar.js"></script>
<html>          
<div class="col-md-12 col-sm-12 col-xs-12">
    <form name="form" id="demo-form2" class="form-horizontal form-label-left" onSubmit="return false;">
		<input type="hidden" name="kodepptk" id="kodepptk" onchange="serahterima(this.value);" value="<?php echo $rs->kodepptk;?>"/>
		<input type="hidden" name="kodekegiatanblud" id="kodekegiatanblud" onchange="serahterima(this.value);" value="<?php echo $rs->kodekegiatanblud;?>"/>
		<input type="hidden" name="kodebidang" id="kodebidang" value="<?php echo $rs->kodebidang;?>"/>
		<input type="hidden" name="bidang" id="bidang" value="<?php echo $rs->bidang;?>"/>
		<input type="hidden" name="kodepenerima" id="kodepenerima" value="<?php echo $rs->kodepenerima;?>"/>
		<input type="hidden" name="noserahterima" id="noserahterima" value="<?php echo $rs->noserahterima;?>"/>
		<input type="hidden" name="triwulan" id="triwulan" value="<?php echo $rs->triwulan;?>"/>
		<!--<input type="hidden" name="koderek50" id="koderek50" value="<?php echo $rs->koderek50heder;?>"/>-->
		<div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
            <label class="control-label">NO NPD</label>
            <input type="text" class="form-control" name="nonpd" id="nonpd" readonly="yes" value="<?php echo $_GET['nonpdls'];?>" />
        </div>
		<div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
            <label class="control-label">TANGGAL NPD</label>
            <input type="text" class="form-control" name="tglnpd" id="tglnpd" value="<?php if($_GET['nonpdls']==''){ echo date('d/m/Y');}else{ echo $tglnpdls;} ;?>" />
        </div>
<!--	<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">TRIWULAN</label>
             <select name="triwulan" id="triwulan" class="form-control">
                <option value="">-</option>
                <option value="TRIWULAN 1"<?php if($rs->triwulan=='TRIWULAN 1'){ echo "selected"; }?>>TRIWULAN 1</option>
				<option value="TRIWULAN 2"<?php if($rs->triwulan=='TRIWULAN 2'){ echo "selected"; }?>>TRIWULAN 2</option>
				<option value="TRIWULAN 3"<?php if($rs->triwulan=='TRIWULAN 3'){ echo "selected"; }?>>TRIWULAN 3</option>
				<option value="TRIWULAN 4"<?php if($rs->triwulan=='TRIWULAN 4'){ echo "selected"; }?>>TRIWULAN 4</option>
            </select>
        </div>-->
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">SERAH TERIMA PEKERJAAN</label>
             <select name="serahterimapekerjaan" id="serahterimapekerjaan" class="form-control" onchange="serahterima(this.value);" >
                <option value="">-</option>
                <option value="1"<?php if($rs->serahterimapekerjaan=='1'){ echo "selected"; }?>>YA</option>
				<option value="2"<?php if($rs->serahterimapekerjaan=='2'){ echo "selected"; }?>>TIDAK</option>
            </select>
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">PPTK</label>
			<span id="caripptk" style="visibility:hidden;">
				<a href="javascript:void(0);" onclick="caripptk();"><img src="images/search.gif" border="0" width="13px" /></a>
			</span>
            <input type="text" class="form-control" name="pptk" id="pptk" value="<?php echo $rs->pptk;?>" />
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">PROGRAM</label> 
            <input type="text" class="form-control" name="program" id="program" readonly="yes" value="<?php echo $rs->program;?>"/>
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">NO. KONTRAK</label>
			<span id="lokasilaka_content" style="visibility:hidden;">
				<a href="javascript:void(0);" onclick="carinokontrak();"><img src="images/search.gif" border="0" width="13px" /></a>
			</span>
            <input type="text" class="form-control" name="nokontrak" id="nokontrak" value="<?php echo $rs->nokontrak;?>"/>
        </div>		
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">KEGIATAN</label>
            <input type="text" class="form-control" name="kegiatan" id="kegiatan" value="<?php echo $rs->kegiatan;?>"/>
        </div>		
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">KEGIATAN BLUD</label> 
			<!--<span id="carikegiatanblud" style="visibility:hidden;">
				<a href="javascript:void(0);" onclick="carikegiatanblud();"><img src="images/search.gif" border="0" width="13px" /></a>
			</span>-->
            <input type="text" class="form-control" name="kegiatanblud" id="kegiatanblud" value="<?php echo $rs->kegiatanblud;?>"/>
        </div>
		<!--<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">RINCIAN BELANJA</label>
			<span id="caririncianbelanja" style="visibility:hidden;">
				<a href="javascript:void(0);" onclick="caririncianbelanja();"><img src="images/search.gif" border="0" width="13px" /></a>
			</span>
            <input type="text" class="form-control" name="rincianbelanja" id="rincianbelanja" value="<?php echo $rs->uraian50;?>"/>
        </div>-->
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">PENERIMA</label>
			<span id="caripenerima" style="visibility:hidden;">
				<a href="javascript:void(0);" onclick="caripenerima();"><img src="images/search.gif" border="0" width="13px" /></a>
			</span>
            <input type="text" class="form-control" name="penerima" id="penerima" value="<?php echo $rs->penerima;?>" readonly="yes"/>
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">BANK</label> 
            <input type="text" class="form-control" name="bank" id="bank" value="<?php echo $rs->bank;?>" readonly="yes"/>
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">REKENING</label> 
            <input type="text" class="form-control" name="rekening" id="rekening" value="<?php echo $rs->rekening;?>" readonly="yes"/>
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">NPWP</label> 
            <input type="text" class="form-control" name="npwp" id="npwp" value="<?php echo $rs->npwp;?>" readonly="yes"/>
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">KETERANGAN</label> 
            <input type="text" class="form-control" name="keterangan" id="keterangan" value="<?php echo $rs->keterangan;?>"/>
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">BIAYA TRANSFER</label> 
            <input type="text" class="form-control" name="biayatransfer" id="biayatransfer" value="<?php echo $rs->biayatransfer;?>"/>
        </div>
    </form>            
</div>
<div class="x_content">
	<div class="" role="tabpanel" data-example-id="togglable-tabs">
	  <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
	    <li class="active"><a href="#tab_content1" id="home-tab" data-toggle="tab">RINCI</a></li>
		<li><a href="#tab_content2" id="profile-tab" data-toggle="tab">PAJAK</a></li>
	  </ul>
		<div id="myTabContent" class="tab-content">
			<div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
				<div class="col-md-12 col-sm-12 col-xs-12">
		 
				   <form name="form_rinci" id="form_rinci" class="form-horizontal form-label-left" onSubmit="return false;">
				   <input type="hidden" name="idserahterima_rinci" id="idserahterima_rinci"/>
				   <input type="hidden" name="nousulan" id="nousulan"/>
				   <input type="hidden" name="nopenyesuaianprioritas" id="nopenyesuaianprioritas"/>
				   <input type="hidden" name="kode108" id="kode108"/>
				   <input type="hidden" name="uraian108" id="uraian108"/>
				   <input type="hidden" name="koderek50" id="koderek50" />
						<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
							<label class="control-label">RINCIAN BELANJA</label>
							<a href="javascript:void(0);" onclick="caririncianbelanja();"><img src="images/search.gif" border="0" width="13px" /></a>
							<input type="text" class="form-control" name="rincianbelanja" id="rincianbelanja" readonly="yes"/>
						</div>
						<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
							<label class="control-label">ITEM BELANJA</label>
							<span id="cariitembelanja" style="visibility:hidden;">	
								<a href="javascript:void(0);" onclick="cariitembelanja();"><img src="images/search.gif" border="0" width="13px" /></a>
							</span>
							<span id="cariitembelanjax" style="visibility:hidden;">	
								<a href="javascript:void(0);" onclick="cariitembelanjanonfarmasi();"><img src="images/search.gif" border="0" width="13px" /></a>
							</span>
							<input type="text" class="form-control" name="itembelanja" id="itembelanja" readonly="yes" />
						</div>
						<div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
							<label class="control-label">VOLUME</label> 
							<input type="text" class="form-control" name="volume" id="volume" readonly="yes" />
						</div>
						 <div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
							<label class="control-label">SATUAN</label> 
							<input type="text" class="form-control" name="satuan" id="satuan" readonly="yes" />
						</div>
						<div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
							<label class="control-label">HARGA ANGGARAN</label> 
							<input type="text" class="form-control" name="harga" id="harga" readonly="yes" />
						</div>		
						<div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
							<label class="control-label">TOTAL ANGGARAN</label> 
							<input type="text" class="form-control" name="total" id="total" readonly="yes"/>
						</div>
						<div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
							<label class="control-label">SISA ANGGARAN</label> 
							<input type="text" class="form-control" name="sisaanggaran" id="sisaanggaran" readonly="yes"/>
						</div>
						<div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
							<label class="control-label">VOLUME PERMINTAAN </label>
							<!--<span id="volumebaru" style="visibility:hidden;">
								<a href="javascript:void(0);" onclick="carivolumedisim();"><img src="images/search.gif" border="0" width="13px" /></a>
							</span> -->
							<input type="text" class="form-control" name="volumepermintaanpanjar" onkeyup="hasil(this.value);" onkeydown="hasil(this.value);" id="volumepermintaanpanjar" onkeypress="if(event.keyCode==13){ document.form_rinci.hargapermintaanpanjar.focus();}">
						</div>
						<div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
							<label class="control-label">HARGA PERMINTAAN </label> 
							<input type="text" class="form-control" name="hargapermintaanpanjar" onkeyup="hasil(this.value);" onkeydown="hasil(this.value);" id="hargapermintaanpanjar" onkeypress="if(event.keyCode==13){ document.form_rinci.tsimpan.focus(); }" />
						</div>
						<div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
							<label class="control-label">TOTAL PERMINTAAN </label>
							<input type="text" class="form-control" name="totalpermintaanpanjar" id="totalpermintaanpanjar" readonly="yes" />
						</div>
						<div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
							<label class="control-label">NOMINAL PEMBAYARAN </label>
							<input type="text" class="form-control" name="nominalpembayaran" id="nominalpembayaran"/>
						</div>
						  <div class="form-group">
							<div class="col-md-3 col-sm-3 col-xs-1 ">
							<label class="control-label"></label> 
							   <input type="button" name="tsimpan" class="btn btn-success btn-block" id="tsimpan" value="SIMPAN" size="20" onClick="simpannpdls();">
							</div>
							<div class="col-md-3 col-sm-3 col-xs-1 ">
							<label class="control-label"></label> 
							   <input type="button" name="tsimpan" class="btn btn-success btn-block" id="tsimpan" value="CETAK" size="20" onClick="cetaknpdls();">
							</div>
						</div>
					</form>
					<div id="grid_nilai"></div>
				</div>
			</div>
			<div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
                <?php
					$sqlpajak=$conn->query("select * from npdls_pajak where nonpdls='".$_GET['nonpdls']."' ");
					$rspajak=$sqlpajak->fetch_object();
				?>
				<div class="col-md-12 col-sm-12 col-xs-12">
					<form name="form_pajak" id="demo-form2" class="form-horizontal form-label-left" onSubmit="return false;">
						<input type="hidden" name="nospjpanjar" id="nospjpanjar" value="<?php echo $_GET['nospjpanjar'];?>"/>
						<input type="hidden" name="koderek" id="koderek" value="2.1.01.05.01.001"/>
						<div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
							<label class="control-label">PAJAK UTANG PPH 21</label>
							<input type="text" class="form-control" name="pph21" id="pph21" onkeyup="angka()"/>
						</div> 
						<div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
							<label class="control-label">PAJAK UTANG PPH 22</label>
							<input type="text" class="form-control" name="pph22" id="pph22"/>
						</div>
						<div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
							<label class="control-label">PAJAK UTANG PPH 23</label>
							<input type="text" class="form-control" name="pph23" id="pph23"/>
						</div>
						<div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
							<label class="control-label">PAJAK UTANG PPH 25</label>
							<input type="text" class="form-control" name="pph25" id="pph25"/>
						</div>
						<div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
							<label class="control-label">Utang Pajak Pasal 4 Ayat 2</label>
							<input type="text" class="form-control" name="pasal4" id="pasal4"/>
						</div>
						<div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
							<label class="control-label">Utang PPN Pusat</label>
							<input type="text" class="form-control" name="ppnpusat" id="ppnpusat"/>
						</div>
						<div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
							<label class="control-label">Utang Pajak Daerah</label>
							<input type="text" class="form-control" name="utangpajakdaerah" id="utangpajakdaerah"/>
						</div>
						<div class="form-group">
							<div class="col-md-3 col-sm-3 col-xs-1 ">
							   <input type="button" name="tsimpan" class="btn btn-success btn-block" id="tsimpan" value="SIMPAN" size="20" onClick="simpannpdlspajak();">
							   <input type="button" name="tsimpan" class="btn btn-success btn-block" id="tsimpan" value="EDIT" size="20" onClick="editnpdls('<?php echo $_GET['nonpdls'];?>');">
							   <input type="button" name="tsimpan" class="btn btn-success btn-block" id="tsimpan" value="HAPUS" size="20" onClick="hapuspajaknpdls('<?php echo $_GET['nonpdls'];?>');">
							</div>
						 </div>		
					</form>
					<div id="grid_pajak"></div>
				</div>
            </div>
		</div> 
	</div>
</div>		
</html>
<?php include("../../close.php"); ?>
