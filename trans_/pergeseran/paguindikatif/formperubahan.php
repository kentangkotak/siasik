<?php include("../../../conn.php"); ?>
<script  src="calendar.js"></script>
<?php
	$sqlx=$conn->query("select anggaran_pendapatan.id as id,anggaran_pendapatan.notrans as notrans,anggaran_pendapatan.bidang as bidang,
						anggaran_pendapatan.koderekeningblud as koderekeningblud,anggaran_pendapatan.uraian_rekening as uraian_rekening,
						t_tampung_pendapatan.pagu as nilai,anggaran_pendapatan.map79 as map79,anggaran_pendapatan.kode79 as kode79,
						anggaran_pendapatan.tahun as tahun
						from anggaran_pendapatan,t_tampung_pendapatan where anggaran_pendapatan.tahun='".$_SESSION["anggaran_tahun"]."' 
						and anggaran_pendapatan.notrans='".$_GET['notrans']."'
						and t_tampung_pendapatan.notrans=anggaran_pendapatan.notrans");
	$rsx=$sqlx->fetch_object();
	
	// $sqlsisauang=$conn->query("select sum(nilai) as total from t_tampung where tgl='".$_SESSION["anggaran_tahun"]."'");
	// $rssisauang=$sqlsisauang->fetch_object();
	// $sisauang=$rssisauang->total;
?>
<html>          
<div class="col-md-12 col-sm-12 col-xs-12">
    <form name="form" id="demo-form2" class="form-horizontal form-label-left" onSubmit="return false;">
	<input type="hidden" name="notrans" id="notrans" value="<?php echo $_GET['notrans'];?>">
	<input type="hidden" name="koderekeningblud" id="koderekeningblud" value="<?php echo $rsx->koderekeningblud;?>">
	<input type="hidden" name="map79" id="map79" value="<?php echo $rsx->map79;?>">
	<input type="hidden" name="kode79" id="kode79" value="<?php echo $rsx->kode79;?>">
        <div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">BIDANG/BAGIAN</label>
            <select class="select2_single form-control" tabindex="-1" name="bidang" id="bidang" disabled="disabled">
            <option value="">-Pilih-</option>
            <?php
                $sql=$conn->query("select * from organisasi where kode4='' and kode3<>''");
                while($rs=$sql->fetch_object()){
            ?>
                <option value="<?php echo $rs->nama;?>" <?php if($rs->nama==$rsx->bidang){ echo "selected"; }?>><?php echo $rs->nama;?></option>
            <?php }?>
            </select>
        </div>
		 <div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">URAIAN REKENING BLUD</label>
            <input type="text" class="form-control" name="uraian" id="uraian" value="<?php echo $rsx->uraian_rekening;?>" readonly="yes"/>
        </div> 
        <div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">NILAI PENDAPATAN</label>
            <input type="text" class="form-control" name="nilairupiah" id="nilairupiah" value="<?php echo rpz($rsx->nilai);?>" readonly="yes"/>
        </div>
		<!--<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">SISA PENDAPATAN KESELUARUAN</label>
            <input type="text" class="form-control" name="sisapendapatan" id="sisapendapatan" value="<?php echo rpz($sisauang);?>" readonly="yes"/>
        </div>-->
		<!--<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">OPERATOR</label>
            <select class="select2_single form-control" tabindex="-1" name="operator" id="operator">
            <option value="">-Pilih-</option>
                <option value="TAMBAH" >TAMBAH</option>
				<option value="KURANG" >KURANG</option>
            </select>
        </div>-->
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">NILAI PERGESERAN</label>
            <input type="text" class="form-control" onKeyPress="if(event.keyCode==13){document.form.tsimpan.focus();" name="nilaibaru" id="nilaibaru" onkeyup="cariselisih();" onkeydown="cariselisih();" />
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">SELISIH</label>
            <input type="text" class="form-control" name="selisih" id="selisih" readonly="yes"/>
        </div>
		<div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
            <label class="control-label"> </label>
			<input type="button" name="tsimpan" class="btn btn-success btn-block" id="tsimpan" value="SIMPAN"  onClick="simpanperubahan();">
        </div>
    </form>            
</div>
</html>
<?php include("../../../close.php"); ?>
