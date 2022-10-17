<?php include("../../conn.php"); ?>
<html>          
<div class="col-md-12 col-sm-12 col-xs-12">
    <form name="form_pajak" id="demo-form2" class="form-horizontal form-label-left" onSubmit="return false;">
		<input type="hidden" name="nonpd" id="nonpd" value="<?php echo $_GET['nonpd'];?>"/>
		<input type="hidden" name="koderek" id="koderek" value="21010501001"/>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">PAJAK UTANG PPH 21</label>
            <input type="text" class="form-control" name="pph21" id="pph21" onkeyup="angka()"/>
        </div> 
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">PAJAK UTANG PPH 22</label>
            <input type="text" class="form-control" name="pph22" id="pph22"/>
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">PAJAK UTANG PPH 23</label>
            <input type="text" class="form-control" name="pph23" id="pph23"/>
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">PAJAK UTANG PPH 25</label>
            <input type="text" class="form-control" name="pph25" id="pph25"/>
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">Utang Pajak Pasal 4 Ayat 2</label>
            <input type="text" class="form-control" name="pasal4" id="pasal4"/>
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">Utang PPN Pusat</label>
            <input type="text" class="form-control" name="ppnpusat" id="ppnpusat"/>
        </div>
		<div class="form-group col-md-6 col-xs-6 col-sm-6 col-lg-6">
            <label class="control-label">Utang Pajak Daerah</label>
            <input type="text" class="form-control" name="utangpajakdaerah" id="utangpajakdaerah"/>
        </div>
		<div class="form-group">
            <div class="col-md-3 col-sm-3 col-xs-1 ">
               <input type="button" name="tsimpan" class="btn btn-success btn-block" id="tsimpan" value="SIMPAN" size="20" onClick="simpannpdlspajak();">
            </div>
         </div>		
    </form>            
</div> 

        
          
         
</html>
<?php include("../../close.php"); ?>
