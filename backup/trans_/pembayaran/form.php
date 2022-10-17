<?php include("../../conn.php"); ?>
<script  src="calendar.js"></script>
<html>          
<div class="col-md-12 col-sm-12 col-xs-12">
    <form name="form" id="demo-form2" class="form-horizontal form-label-left" onSubmit="return false;">
        <input type="hidden" name="notrans" id="notrans" />
        <div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">KODE REKENING</label>
            <input type="text" class="form-control" name="koderekening" id="koderekening" onKeyPress="if(event.keyCode==13){document.form.untukpembayaran.focus();}" />
        </div>
        <div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">UNTUK PEMBAYARAN</label> 
            <input name="untukpembayaran" id="untukpembayaran" class="form-control" type="text" onKeyPress="if(event.keyCode==13){document.form.nominal.focus();}" onKeyUp="this.value = this.value.toUpperCase()"/>
        </div>
		<div class="col-md-6 col-sm-6 col-xs-6 ">
			 <label class="control-label">NOMINAL</label>
			 <input name="nominal" id="nominal" class="form-control" type="text" onKeyPress="if(event.keyCode==13){document.form.untuk.focus();}" />
		</div>
		<div class="col-md-6 col-sm-6 col-xs-6 ">
			 <label class="control-label">UNTUK</label>
			 <input name="untuk" id="untuk" class="form-control" type="text" onKeyPress="if(event.keyCode==13){document.form.tsimpan.focus();}" onKeyUp="this.value = this.value.toUpperCase()"/>
		</div>
		<div class="col-md-6 col-sm-6 col-xs-6 ">
			<label class="control-label"></label>
            <input type="button" name="tsimpan" class="btn btn-success btn-block" id="tsimpan" value="BAYAR" size="20" onClick="simpanbayar();">
         </div>
    </form>            
</div>
</html>
<?php include("../../close.php"); ?>