<?php include("../../conn.php"); ?>
<?php
	$sql=$conn->query("select * from pergeseranTheder where notrans='".$_GET['notrans']."' ");
	$rs=$sql->fetch_object();
?>
<script  src="calendar.js"></script>
<html>          
<div class="col-md-12 col-sm-12 col-xs-12">
    <form name="form" id="demo-form2" class="form-horizontal form-label-left" onSubmit="return false;">
		<input type="hidden" class="form-control" name="batas" id="batas"/>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">NO TRANSAKSI</label>
            <input type="text" class="form-control" name="notrans" id="notrans" readonly="yes" value="<?php echo $_GET['notrans'];?>" />
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">TANGGAL TRANSAKSI</label>
            <input type="text" class="form-control" name="tgltrans" id="tgltrans" value="<?php if($_GET['notrans']==''){ echo date('d/m/Y');}else{ echo $rs->tgltrans;} ?>" onClick="return getCalendar(document.form.tgltrans);" />
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">JENIS</label> 
            <select class="select2_single form-control" tabindex="-1" name="jenis" id="jenis" onchange="caribatas(this.value)" value="Refresh">
			<option value="" >--- PILIH SALAH SATU ---</option>
            <option value="1" <?php if($rs->jenis=="Bank Ke Kas"){ echo "selected"; }?>>Bank Bendahara Pengeluaran Ke Kas Bendahara Pengeluaran</option>
			<option value="2" <?php if($rs->jenis=="Kas Ke Bank"){ echo "selected"; }?>>Kas Bendahara Pengeluaran Ke Bank Bendahara Pengeluaran</option>
		<!--	<option value="3" <?php if($rs->jenis=="Bank Bendahara Penerimaan Ke Kas BLUD"){ echo "selected"; }?>>Bank Bendahara Penerimaan Ke Kas BLUD</option>
			<option value="4" <?php if($rs->jenis=="Kas BLUD Ke Bank Bendahara Pengeluaran"){ echo "selected"; }?>>Kas BLUD Ke Bank Bendahara Pengeluaran</option>-->
            </select>
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">BATAS PERGESERAN</label>
            <input type="text" class="form-control" name="batasx" id="batasx" readonly="yes"/>
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">NO. REKENING & BANK</label>
             <select class="select2_single form-control" tabindex="-1" name="norek" id="norek">
            <option value="">-Pilih-</option>
            <?php
                $sqlx=$conn->query("select * from masterRekBank where flag=''");
                while($rsx=$sqlx->fetch_object()){
            ?>
                <option value="<?php echo $rsx->kodeRek.'|'.$rsx->bank.'|'.$rsx->kodebank;?>" <?php if($rs->norekening==$rsx->kodeRek){ echo "selected"; }?>><?php echo $rsx->kodeRek.' ( '.$rsx->bank.' )';?></option>
            <?php }?>
            </select>
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
<div class="col-md-12 col-sm-12 col-xs-12">
   <form name="form_rinci" id="form_rinci" class="form-horizontal form-label-left" onSubmit="return false;">
   <input type="hidden" name="nonpd" id="nonpd"/>
        <div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
            <label class="control-label">NO TRANSAKSI</label> 
			<span id="lokasilaka_content" style="visibility:hidden;">
			<a href="javascript:void(0);" onclick="carinpk();"><img src="images/search.gif" name="gambar" id="gambar" border="0" width="15" /></a>
			</span>
            <input type="text" class="form-control" name="nonpk" id="nonpk" />
        </div>
		 <div class="form-group col-md-6 col-xs-6 col-sm-3 col-lg-6">
            <label class="control-label">KETERANGAN</label> 
            <input type="text" class="form-control" name="keterangan" id="keterangan" onkeypress="if(event.keyCode==13){ document.form_rinci.tsimpan.focus()}"/>
        </div>		
		 <div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
            <label class="control-label">NILAI</label> 
            <input type="text" class="form-control" name="totalnpk" id="totalnpk"/>
        </div>
        
          <div class="form-group">
            <div class="col-md-3 col-sm-3 col-xs-1 ">
               <input type="button" name="tsimpan" class="btn btn-success btn-block" id="tsimpan" value="SIMPAN" size="20" onClick="simpanpergeseran();">
            </div>
          </div>
    </form>
</div>  
<div id="grid_nilai"></div>         
</html>
<?php include("../../close.php"); ?>
