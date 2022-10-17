<?php include("../../conn.php"); ?>
<?php
	$sql=$conn->query("select * from usulanHonor_h where notrans='".$_GET['notrans']."'");
	$rs=$sql->fetch_object();
	$tanggaltrans=out_tanggal("-",$rs->tglTransaksi);
?>
<script  src="calendar.js"></script>
<html>          
<div class="col-md-12 col-sm-12 col-xs-12">
    <form name="form" id="demo-form2" class="form-horizontal form-label-left" onSubmit="return false;">
	<input type="hidden" name="kodekegiatan" id="kodekegiatan" value="<?php echo $rs->kodeKegiatan ;?>" />
	<input type="hidden" name="kodebagian" id="kodebagian" value="<?php echo $rs->kodebagian ;?>"/>
	<input type="hidden" name="organisasi_nama" id="organisasi_nama" value="<?php echo $rs->organisasi_nama ;?>"/>
	<input type="hidden" name="kode50" id="kode50" value="<?php echo $rs->kode50 ;?>"/>
	<input type="hidden" name="uraian" id="uraian" value="<?php echo $rs->uraian ;?>"/>
	<input type="hidden" name="koderuang" id="koderuang" value="<?php echo $_SESSION["anggaran_koderuangan"];?>" />
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">NO USULAN</label>
            <input type="text" class="form-control" name="notrans" id="notrans" readonly="yes" value="<?php echo $_GET['notrans'];?>" />
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">RUANGAN</label>
            <input type="text" class="form-control" name="ruangan" readonly="yes" id="ruangan" value="<?php echo $_SESSION["anggaran_ruangan"];?>">
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">TANGGAL TRANSAKSI</label>
            <input type="text" class="form-control" name="tgltrans" id="tgltrans" value="<?php if($_GET['notrans']==''){ echo date('d/m/Y');}else{ echo $tanggaltrans;} ;?>" onClick="return getCalendar(document.form.tgltrans);" />
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">KEGIATAN</label>
            <input type="text" class="form-control" name="kegiatan" id="kegiatan" value="<?php echo $rs->kegiatan ;?>"/>
        </div>  
        <div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
        <input type="button" name="tsimpan" class="btn btn-success btn-block" id="tsimpan" value="CEK PAGU" size="20" onClick="getPaguByKegiatan(document.form.kodekegiatan.value);">
        </div>  
    </form>            
</div>
<div class="col-md-12 col-sm-12 col-xs-12">
   <form name="form_rinci" id="form_rinci" class="form-horizontal form-label-left" onSubmit="return false;">
        <div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">RINCIAN</label> 
            <input type="text" class="form-control" name="keterangan" id="keterangan" />
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">VOLUME</label> 
            <input type="text" class="form-control" name="volume" id="volume" onblur="angka(this);" onkeyup="angka(this);"/>
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">SATUAN</label> 
            <select class="select2_single form-control" tabindex="-1" name="satuan" id="satuan">
            <option value="">-Pilih-</option>
            <?php
				$conn_musrenbang = new mysqli("localhost","admin","alam02018sa","musrenbang");
                $sqlx=$conn_musrenbang->query("select * from rs9 order by rs1");
                while($rsx=$sqlx->fetch_object()){
            ?>
                <option value="<?php echo $rsx->rs1;?>" ><?php echo $rsx->rs1;?></option>
            <?php }?>
            </select>
        </div>
        <div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">BIDANG PENGUSUL</label>
            <select name="bidangPengusul" id="bidangPengusul" class="form-control">
                <option value="">-</option>
                <?php
                    $organisasi_sql=$conn->query("select * from organisasi where kode3 is not null and (hidden is null or hidden='') and kode4='';");
                    while($organisasi_rs=$organisasi_sql->fetch_object()){
                ?>
                <option value="<?php echo $organisasi_rs->id.'|'.$organisasi_rs->nama; ?>" <?php if($_SESSION["anggaran_ruangan"]==$organisasi_rs->nama){ echo "selected"; }?>><?php echo $organisasi_rs->nama; ?></option>
                <?php } ?>
            </select>
        </div>
		
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">HARGA</label> 
            <input type="text" class="form-control" name="harga" id="harga" onblur="angka(this);" onkeyup="angka(this);"/>
        </div>
         <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-3 col-sm-3 col-xs-1 ">
               <input type="button" name="tsimpan" class="btn btn-success btn-block" id="tsimpan" value="SIMPAN" size="20" onClick="simpantranskegiatan();">
            </div>
			<!--<div class="col-md-3 col-sm-3 col-xs-1 ">
               <input type="button" name="batal" class="btn btn-success btn-block" id="batal" value="HAPUS TRANSAKSI" size="20" onClick="hapustransaksi();">
            </div>-->
          </div>
    </form>
</div>                
<div id="grid_nilai"></div>
</html>
<?php include("../../close.php"); ?>
