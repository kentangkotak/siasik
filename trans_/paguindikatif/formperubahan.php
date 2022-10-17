<?php include("../../conn.php"); ?>
<script  src="calendar.js"></script>
<?php
	$sqlx=$conn->query("select * from anggaran_pendapatan where notrans='".$_GET['notrans']."'");
	$rsx=$sqlx->fetch_object();
?>
<html>          
<div class="col-md-12 col-sm-12 col-xs-12">
    <form name="form" id="demo-form2" class="form-horizontal form-label-left" onSubmit="return false;">
	<input type="hidden" name="notransawal" id="notransawal" value="<?php echo $_GET['notrans'];?>">
	<input type="hidden" name="noperubahan" id="noperubahan">
	<input type="hidden" name="koderekeningblud" id="koderekeningblud" value="<?php echo $rsx->koderekeningblud;?>">
	<input type="hidden" name="map79" id="map79" value="<?php echo $rsx->map79;?>">
	<input type="hidden" name="kode79" id="kode79" value="<?php echo $rsx->kode79;?>">
        <div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">BIDANG/BAGIAN</label>
            <select class="select2_single form-control" tabindex="-1" name="bidang" id="bidang" readonly="yes">
            <option value="">-Pilih-</option>
            <?php
                $sql=$conn->query("select * from organisasi where kode4='' and kode3<>''");
                while($rs=$sql->fetch_object()){
            ?>
                <option value="<?php echo $rs->nama;?>" <?php if($rsx->bidang == $rs->nama){ echo "selected"; } ?>><?php echo $rs->nama;?></option>
            <?php }?>
            </select>
        </div>
		 <div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">URAIAN REKENING BLUD</label>
            <input type="text" class="form-control" name="uraian" id="uraian" value="<?php echo $rsx->uraian_rekening;?>" readonly="yes"/>
        </div> 
        <div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">ANGGARAN</label>
            <input type="text" class="form-control" name="nilairupiah" id="nilairupiah" readonly="yes" onblur="angka(this);" onkeyup="angka(this);" value="<?php echo rpx($rsx->nilai);?>"/>
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">PERUBAHAN</label>
            <input type="text" class="form-control" name="nilaiperubahan" id="nilaiperubahan"  onkeyup="cariselisih(this.value);" onkeydown="cariselisih(this.value);"/>
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">SELISIH</label>
            <input type="text" class="form-control" name="selisih" id="selisih" readonly="yes"  onblur="angka(this);" onkeyup="angka(this);"/>
        </div>
		<div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
            <label class="control-label"> </label>
			<input type="button" name="tsimpan" class="btn btn-success btn-block" id="tsimpan" value="SIMPAN"  onClick="simpanperubahan();">
        </div>
    </form>            
</div>
</html>
<?php include("../../close.php"); ?>
