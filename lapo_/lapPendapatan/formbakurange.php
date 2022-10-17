<?php include("../../fungsi.php"); ?>


<html>   
<br/>  
	<div class="col-md-12 col-sm-12 col-xs-12">
		<form name="form" id="demo-form2" class="form-horizontal form-label-left" onSubmit="return false;">
			<div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
				 <label class="control-label">Dari</label>
				 <input type="text" class="form-control" name="tgldari" id="tgldari" value="<?php echo date('d/m/Y');?>"/>
			</div>
			<div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
				 <label class="control-label">Sampai</label>
				 <input type="text" class="form-control" name="tglsampai" id="tglsampai" value="<?php echo date('d/m/Y');?>"/>
			</div></br>
			<div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
				<label class="control-label"></label>	
				<input type="button" name="tsimpan" class="btn btn-success btn-block" id="tsimpan" value="LIHAT"  onClick="lihatbku();">
			</div>
		</form>            
	</div>
	<div id="grid_laporan"></div>
</html>
<script>
function jfloading(layout){
	$("#"+layout).html("<img src='../../images/ld.gif' width='70'>");
}

function jfdata_table(){
	$('#dataTables-example').DataTable({
		responsive: true,
		retrieve: true
	});
}

function lihatbku(){ 
	jfloading("grid_laporan");
	bln=document.form.bln.value;
	thn=document.form.thn.value; 
		$.get("lihatbku.php",{bln:bln,thn:thn},function(result){
				$("#grid_laporan").html(result);
			}
		);
}

</script>
