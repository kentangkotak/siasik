<br/>     
	<div class="col-md-12 col-sm-12 col-xs-12">
		<form name="form" id="demo-form2" class="form-horizontal form-label-left" onSubmit="return false;">
			<div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
				<select name="thn" id="thn" class="form-control" tabindex="3">
						<?php for($x=(date("Y")-1);$x<=(date("Y")+1);$x++){ ?>
						<option value="<?php echo $x ; ?>" <?php if (date("Y")==$x) echo "selected" ;?>><?php echo $x ;?></option>
						<?php } ?>
				</select>
			</div>
			<div class="form-group col-md-3 col-xs-3 col-sm-3 col-lg-3">
				<input type="button" name="tsimpan" class="btn btn-success btn-block" id="tsimpan" value="LIHAT"  onClick="lihatrekappendapatan();">
			</div>
		</form>            
	</div>
	<div id="grid_laporan"></div>