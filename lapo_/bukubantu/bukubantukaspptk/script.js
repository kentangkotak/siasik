function formbukubantukaspptkxz(){ 
	jfloading("sub_konten"); 
	$.get("lapo_/bukubantu/bukubantukaspptk/formbukubantu.php",
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

function caribukubantu(){  
	tgl=document.form.tgl.value;
	tglx=document.form.tglx.value;
	jfloading("grid_laporan");
		$.get("lapo_/bukubantu/bukubantukaspptk/bukubantu.php",{tgl:tgl,tglx:tglx},
			function(result){
				$("#grid_laporan").html(result);
				jfdata_table(); 
			}
		);
}

function formbukubantupptkls(){ 
	jfloading("sub_konten"); 
	$.get("lapo_/bukubantu/bukubantukaspptk/formbukubantupptkls.php",
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

function caribukubantuls(){  
	tgl=document.form.tgl.value;
	tglx=document.form.tglx.value;
	jfloading("grid_laporan");
		$.get("lapo_/bukubantu/bukubantukaspptk/caribukubantuls.php",{tgl:tgl,tglx:tglx},
			function(result){
				$("#grid_laporan").html(result);
				jfdata_table(); 
			}
		);
}

function formbukubantupptkpanjar(){ 
	jfloading("sub_konten"); 
	$.get("lapo_/bukubantu/bukubantukaspptk/formbukubantupptkpanjar.php",
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

function caribukubantupanjar(){  
	tgl=document.form.tgl.value;
	tglx=document.form.tglx.value;
	jfloading("grid_laporan");
		$.get("lapo_/bukubantu/bukubantukaspptk/caribukubantupanjar.php",{tgl:tgl,tglx:tglx},
			function(result){
				$("#grid_laporan").html(result);
				jfdata_table(); 
			}
		);
}