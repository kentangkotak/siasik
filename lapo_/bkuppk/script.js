function formbkuppkxxx(){ 
	jfloading("sub_konten"); 
	$.get("lapo_/bkuppk/formbkuppk.php",
		function(result){ 
			$("#sub_konten").html(result);
			$('#tgl').datetimepicker({
				format: 'DD/MM/YYYY'
			});
			$('#tglx').datetimepicker({
				format: 'DD/MM/YYYY'
			});
		}
	);
}

function cariall(){  
	tgl=document.form.tgl.value;
	tglx=document.form.tglx.value;
	jfloading("grid_laporan");
		$.get("lapo_/bkuppk/bkuppk.php",{tgl:tgl,tglx:tglx},
			function(result){
				$("#grid_laporan").html(result);
				jfdata_table(); 
			}
		);
}

