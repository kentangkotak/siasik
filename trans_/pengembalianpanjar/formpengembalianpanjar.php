<?php include("../../conn.php"); ?>
<?php
	$sql=$conn->query("select pengembalianpanjar_heder.*,pengembalianpanjar_rinci.jumlahpenerimaanpanjar as jumlahpenerimaanpanjar,pengembalianpanjar_rinci.sisapanjar as sisapanjar 
						from pengembalianpanjar_heder left join pengembalianpanjar_rinci on pengembalianpanjar_heder.nopengembalianpanjar=pengembalianpanjar_rinci.nopengembalianpanjar 
						where pengembalianpanjar_heder.nopengembalianpanjar='".$_GET['nopengembalianpanjar']."' ");
	$rs=$sql->fetch_object();
	$tglpengembalianpanjar=out_tanggal("-",$rs->tglpengembalianpanjar);
?>
<script  src="calendar.js"></script>
<html>          
<div class="col-md-12 col-sm-12 col-xs-12">
    <form name="form" id="demo-form2" class="form-horizontal form-label-left" onSubmit="return false;">
	<input type="hidden" name="kodepptk" id="kodepptk" value="<?php echo $rs->kodepptk;?>"/>
	<input type="hidden" name="kodekegiatanblud" id="kodekegiatanblud" value="<?php echo $rs->kodekegiatanblud;?>" />
	<input type="hidden" name="kodepihakketiga" id="kodepihakketiga" value="<?php echo $rs->kodepihakketiga;?>"/>
	<input type="hidden" name="nonpdpanjar" id="nonpdpanjar" value="<?php echo $rs->nonpdpanjar;?>"/>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">NO PENGEMBALIAN PANJAR</label>
            <input type="text" class="form-control" name="nopengembalianpanjar" id="nopengembalianpanjar" readonly="yes" value="<?php echo $_GET['nopengembalianpanjar'];?>" />
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">TANGGAL PENGEMBALIAN PANJAR</label>
            <input type="text" class="form-control" name="tglpengembalianpanjar" id="tglpengembalianpanjar" value="<?php if($_GET['nopengembalianpanjar']==''){ echo date('d/m/Y');}else{ echo $tglpengembalianpanjar;} ;?>" onClick="return getCalendar(document.form.tglpengembalianpanjar);" />
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">NOTA PANJAR</label>
			<span id="caripptk">
				<a href="javascript:void(0);" onclick="carinotapanjar();"><img src="images/search.gif" border="0" width="13px" /></a>
			</span>
            <input type="text" class="form-control" name="notapanjar" id="notapanjar" value="<?php echo $rs->notapanjar;?>">
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
		<li class="active"><a href="#tabs-0">RINCIAN</a></li>	
	  </ul>
	</div>
</div>
<div id="tabs-0">
	   <form name="form_rinci" id="form_rinci" class="form-horizontal form-label-left" onSubmit="return false;">
			<input type="hidden" name="koderek50" id="koderek50" />
			<input type="hidden" name="idnpdpanjar" id="idnpdpanjar" />
			<input type="hidden" name="volume" id="volume" />
			<input type="hidden" name="satuan" id="satuan" />
			<input type="hidden" name="harga" id="harga" />
			<input type="hidden" name="nopp" id="nopp" />
			<input type="hidden" name="nousulan" id="nousulan" />
			<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
				<label class="control-label">RINCIAN BELANJA</label>
				<span id="caripptk">
					<a href="javascript:void(0);" onclick="caririncianbelanja();"><img src="images/search.gif" border="0" width="13px" /></a>
				</span>
				<input type="text" class="form-control" name="rincianbelanja" id="rincianbelanja" />
			</div>
			<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
				<label class="control-label">ITEM BELANJA</label> 
				<input type="text" class="form-control" name="itembelanja" id="itembelanja" />
			</div>
			<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
				<label class="control-label">JUMLAH PERMINTAAN NPD</label> 
				<input type="text" class="form-control" name="jumlahanggaran" id="jumlahanggaran" readonly="yes"/>
			</div>
			<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
				<label class="control-label">JUMLAH PENERIMAAN PANJAR</label> 
				<input type="text" class="form-control" name="jumlahpenerimaanpanjar" id="jumlahpenerimaanpanjar" value="<?php echo rpz($rs->jumlahpenerimaanpanjar);?>" readonly="yes"/>
			</div>
			<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
				<label class="control-label">JUMLAH BELANJA PANJAR</label> 
				<input type="text" class="form-control" name="jumlahbelanjapanjar" id="jumlahbelanjapanjar" value="0" readonly="yes" onkeypress="if(event.keyCode==13){ document.form_rinci.sisapanjar.focus(); }" />
			</div>
			<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
				<label class="control-label">SISA PANJAR</label> 
				<input type="text" class="form-control" name="sisapanjar" id="sisapanjar" readonly="yes" value="<?php echo rpz($rs->jumlahpenerimaanpanjar);?>" />
			</div>
			 <div class="ln_solid"></div>
			  <div class="form-group">
				<div class="col-md-3 col-sm-3 col-xs-1 ">
				   <input type="button" name="tsimpan" class="btn btn-success btn-block" id="tsimpan" value="SIMPAN" size="20" onClick="simpanpengembalianpanjar();">
				</div>
				<!--<div class="col-md-3 col-sm-3 col-xs-1 ">
				   <input type="button" name="batal" class="btn btn-success btn-block" id="batal" value="HAPUS TRANSAKSI" size="20" onClick="hapustransaksi();">
				</div>-->
			  </div>
		</form>
	</div>                
	<div id="grid_nilai"></div>
</div>
</html>
<?php include("../../close.php"); ?>
