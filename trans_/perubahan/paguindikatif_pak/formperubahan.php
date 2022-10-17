<?php include("../../../conn.php"); ?>
<script  src="calendar.js"></script>
<?php
	$sqlx=$conn->query("select id,notrans,bidang,koderekeningblud,uraian_rekening,nilai,map79,kode79,tahun from(
	select anggaran_pendapatan.id as id,anggaran_pendapatan.notrans as notrans,anggaran_pendapatan.bidang as bidang,
						anggaran_pendapatan.koderekeningblud as koderekeningblud,anggaran_pendapatan.uraian_rekening as uraian_rekening,
						t_tampung_pendapatan.saldo as nilai,anggaran_pendapatan.map79 as map79,anggaran_pendapatan.kode79 as kode79,
						anggaran_pendapatan.tahun as tahun
						from anggaran_pendapatan,t_tampung_pendapatan where anggaran_pendapatan.tahun='".$_SESSION["anggaran_tahun"]."' 
						and anggaran_pendapatan.notrans='".$_GET['notrans']."'
						and t_tampung_pendapatan.notrans=anggaran_pendapatan.notrans
						union all
						select perubahan.id as id,perubahan.notrans as notrans,perubahan.bidang as bidang,
						perubahan.koderekeningblud as koderekeningblud,perubahan.uraian_rekening as uraian_rekening,
						t_tampung_pendapatan.saldo as nilai,perubahan.map79 as map79,perubahan.kode79 as kode79,
						perubahan.tahun as tahun
						from perubahan,t_tampung_pendapatan where perubahan.tahun='".$_SESSION["anggaran_tahun"]."' 
						and perubahan.notrans='".$_GET['notrans']."'
						and t_tampung_pendapatan.notrans=perubahan.notrans group by perubahan.notrans) 
						as wew
						");
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
            <select class="select2_single form-control" tabindex="-1" name="bidang" id="bidang">
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
            <input type="text" class="form-control" name="uraian" id="uraian" value="<?php echo $rsx->uraian_rekening;?>"/>
        </div> 
        <div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">ANGGARAN</label>
            <input type="text" class="form-control" name="nilairupiah" id="nilairupiah" readonly="yes" value="<?php echo rpx($rsx->nilai);?>"/>
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">OPERATOR</label>
            <select class="select2_single form-control" tabindex="-1" name="operator" id="operator">
            <option value="">-Pilih-</option>
                <option value="TAMBAH" >TAMBAH</option>
				<option value="KURANG" >KURANG</option>
            </select>
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">PERUBAHAN</label>
            <input type="text" class="form-control" name="nilaiperubahan" id="nilaiperubahan"/>
        </div>
		<!--<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">SELISIH</label>
            <input type="text" class="form-control" name="selisih" id="selisih" readonly="yes"/>
        </div>-->
		<div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
            <label class="control-label"> </label>
			<input type="button" name="tsimpan" class="btn btn-success btn-block" id="tsimpan" value="SIMPAN"  onClick="simpanperubahan();">
        </div>
    </form>            
</div>
</html>
<?php include("../../../close.php"); ?>
