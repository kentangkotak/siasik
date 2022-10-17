<?php include("../../conn.php"); ?>
<?php
	$sql=$conn->query("select spjpanjar_heder.nospjpanjar as nospjpanjar,spjpanjar_heder.tglspjpanjar as tglspjpanjar,spjpanjar_heder.notapanjar as notapanjar,spjpanjar_heder.namapptk as pptk,
						spjpanjar_heder.program as program,spjpanjar_heder.kegiatan as kegiatan,spjpanjar_heder.kegiatanblud as kegiatanblud,spjpanjar_heder.pihakketiga as pihakketiga,
						spjpanjar_heder.kodepptk as kodepptk,spjpanjar_heder.kodepihakketiga as kodepihakketiga,spjpanjar_heder.kodekegiatanblud as kodekegiatanblud,
						spjpanjar_heder.keterangan as keterangan,spjpanjar_rinci.jumlahpenerimaanpanjar as jumlahpenerimaanpanjar,round(sum(spjpanjar_rinci.jumlahbelanjapanjar),2) as total
						from spjpanjar_heder left join spjpanjar_rinci
						on spjpanjar_heder.nospjpanjar=spjpanjar_rinci.nospjpanjar where year(spjpanjar_heder.tglspjpanjar)='".$_SESSION["anggaran_tahun"]."' and 
						spjpanjar_heder.nospjpanjar='".$_GET['nospjpanjar']."'
						group by spjpanjar_heder.nospjpanjar ");
	$rs=$sql->fetch_object();
	$tglspjpanjar=out_tanggal("-",$rs->tglspjpanjar);
	
	$sqlsaldo=$conn->query("select sum(notapanjar_rinci.total) as total
						from notapanjar_heder,notapanjar_rinci
						where notapanjar_rinci.nonotapanjar=notapanjar_heder.nonotapanjar and notapanjar_heder.nonotapanjar='".$rs->notapanjar."' ");
	$rssaldo=$sqlsaldo->fetch_object();
	$saldo=$rssaldo->total;
?>
<script  src="calendar.js"></script>
<html>          
<div class="col-md-12 col-sm-12 col-xs-12">
    <form name="form" id="demo-form2" class="form-horizontal form-label-left" onSubmit="return false;">
	<input type="hidden" name="kodepptk" id="kodepptk" value="<?php echo $rs->kodepptk;?>"/>
	<input type="hidden" name="kodekegiatanblud" id="kodekegiatanblud" value="<?php echo $rs->kodekegiatanblud;?>" />
	<input type="hidden" name="kodepihakketiga" id="kodepihakketiga" value="<?php echo $rs->kodepihakketiga;?>"/>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">NO SPJ PANJAR</label>
            <input type="text" class="form-control" name="nospjpanjar" id="nospjpanjar" readonly="yes" value="<?php echo $_GET['nospjpanjar'];?>" />
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">TANGGAL SPJ PANJAR</label>
            <input type="text" class="form-control" name="tglspjpanjar" id="tglspjpanjar" value="<?php if($_GET['nospjpanjar']==''){ echo date('d/m/Y');}else{ echo $tglspjpanjar;} ;?>" onClick="return getCalendar(document.form.tglspjpanjar);" />
        </div>
		<div class="form-group col-md-10 col-xs-10 col-sm-10 col-lg-10">
            <label class="control-label">NOTA PANJAR</label>
			<span id="carinotapanjar" style="visibility:visible;">
				<a href="javascript:void(0);" onclick="carinotapanjar();"><img src="images/search.gif" border="0" width="13px" /></a>
			</span>
            <input type="text" class="form-control" name="notapanjar" id="notapanjar" readonly="yes" value="<?php echo $rs->notapanjar;?>">
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">PPTK</label>
            <input type="text" class="form-control" name="pptk" id="pptk" readonly="yes" value="<?php echo $rs->pptk ;?>"/>
        </div> 
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">PROGRAM</label>
            <input type="text" class="form-control" name="program" readonly="yes" id="program" value="<?php echo $rs->program ;?>">
        </div>		
        <div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">KEGIATAN</label>
            <input type="text" class="form-control" name="kegiatan" readonly="yes" id="kegiatan" value="<?php echo $rs->kegiatan ;?>">
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">KEGIATAN BLUD</label>
            <input type="text" class="form-control" name="kegiatanblud" readonly="yes" id="kegiatanblud" value="<?php echo $rs->kegiatanblud ;?>">
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">PIHAK KETIGA</label>
            <input type="text" class="form-control" name="pihakketiga" id="pihakketiga" value="<?php echo $rs->pihakketiga;?>">
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">KETERANGAN</label>
            <input type="text" class="form-control" name="keterangan" id="keterangan" value="<?php echo $rs->keterangan;?>" onkeypress="if(event.keyCode==13){ document.form_rinci.rincianbelanja.focus();}">
        </div>
    </form>            
</div>
<div class="x_content">
	<div class="" role="tabpanel" data-example-id="togglable-tabs">
	  <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
		<li class="active"><a href="#tab_content1" id="home-tab" data-toggle="tab">RINCI</a></li>
		<li><a href="#tab_content2" id="profile-tab" data-toggle="tab">PAJAK</a></li>
	  </ul>
	</div>
</div>
<div id="myTabContent" class="tab-content">
    <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
		<div class="col-md-12 col-sm-12 col-xs-12">
		   <form name="form_rinci" id="form_rinci" class="form-horizontal form-label-left" onSubmit="return false;">
				<input type="hidden" name="koderek50" id="koderek50" />
				<input type="hidden" name="iditembelanjanpd" id="iditembelanjanpd"/>
				<input type="hidden" name="volume" id="volume" />
				<input type="hidden" name="satuan" id="satuan" />
				<input type="hidden" name="harga" id="harga" />
				<input type="hidden" name="nopp" id="nopp" />
				<input type="hidden" name="nousulan" id="nousulan" />
				<input type="hidden" name="nonpdpanjar" id="nonpdpanjar" />
				<input type="hidden" name="koderek108" id="koderek108" />
				<input type="hidden" name="sisasaldo" id="sisasaldo" />
				<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
					<label class="control-label">RINCIAN BELANJA</label>
					<input type="text" class="form-control" name="rincianbelanja" id="rincianbelanja" readonly="yes"/>
				</div>
				<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
					<label class="control-label">ITEM BELANJA</label>
					<a href="javascript:void(0);" onclick="cariitembelanja();"><img src="images/search.gif" border="0" width="13px" /></a>
					<input type="text" class="form-control" name="itembelanja" id="itembelanja" readonly="yes"/>
				</div>
				<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
					<label class="control-label">JUMLAH</label> 
					<input type="text" class="form-control" name="jumlahanggaran" id="jumlahanggaran" readonly="yes"/>
				</div>
				<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
					<label class="control-label">JUMLAH PENERIMAAN PANJAR</label> 
					<input type="text" class="form-control" name="jumlahpenerimaanpanjar" id="jumlahpenerimaanpanjar" value="<?php echo rpz($saldo);?>" readonly="yes"/>
				</div>
				<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
					<label class="control-label">JUMLAH BELANJA PANJAR</label> 
					<input type="text" class="form-control" name="jumlahbelanjapanjar" id="jumlahbelanjapanjar" onkeyup="hasil(this.value);" onkeydown="hasil(this.value);" />
				</div>
				<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
					<label class="control-label">SISA PANJAR</label> 
					<input type="text" class="form-control" name="sisapanjar" id="sisapanjar" readonly="yes"/>
				</div>
				  <div class="form-group">
					<div class="col-md-3 col-sm-3 col-xs-1 ">
					   <input type="button" name="tsimpan" class="btn btn-success btn-block" id="tsimpan" value="SIMPAN" size="20" onClick="simpanspjpanjaar();">
					</div>
				  </div>
			</form>       
			<div id="grid_nilai"></div>
		</div>
	</div>
	<div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
	<?php
		$sqlpajak=$conn->query("select * from spjpanjar_pajak where nospjpanjar='".$_GET['nospjpanjar']."' ");
		$rspajak=$sqlpajak->fetch_object();
	?>
	<div class="col-md-12 col-sm-12 col-xs-12">
		<form name="form_pajak" id="demo-form2" class="form-horizontal form-label-left" onSubmit="return false;">
			<input type="hidden" name="nospjpanjar" id="nospjpanjar" value="<?php echo $_GET['nospjpanjar'];?>"/>
			<input type="hidden" name="koderek" id="koderek" value="21010501001"/>
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
				   <input type="button" name="tsimpan" class="btn btn-success btn-block" id="tsimpan" value="SIMPAN" size="20" onClick="simpanspjpanjaarpajak();">
				</div>
			 </div>		
		</form>
		<div id="grid_pajak"></div>
	</div> 
	
	</div>
</div>
</html>
<?php include("../../close.php"); ?>
