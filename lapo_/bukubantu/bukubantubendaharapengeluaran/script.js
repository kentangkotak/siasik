function formbukubantubendaharapengeluaran(){ 
	jfloading("sub_konten"); 
	$.get("lapo_/bukubantu/bukubantubendaharapengeluaran/formbukubantu.php",
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
		$.get("lapo_/bukubantu/bukubantubendaharapengeluaran/bukubantu.php",{tgl:tgl,tglx:tglx},
			function(result){
				$("#grid_laporan").html(result);
				jfdata_table(); 
			}
		);
}

function formbukubantubendaharapengeluarankas(){ 
	jfloading("sub_konten"); 
	$.get("lapo_/bukubantu/bukubantubendaharapengeluaran/formbukubantukas.php",
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

function caribukubantukas(){  
	tgl=document.form.tgl.value;
	tglx=document.form.tglx.value;
	jfloading("grid_laporan");
		$.get("lapo_/bukubantu/bukubantubendaharapengeluaran/bukubantukas.php",{tgl:tgl,tglx:tglx},
			function(result){
				$("#grid_laporan").html(result);
				jfdata_table(); 
			}
		);
}

function formbukubantuls(){ 
	jfloading("sub_konten"); 
	$.get("lapo_/bukubantu/bukubantubendaharapengeluaran/formbukubantuls.php",
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
		$.get("lapo_/bukubantu/bukubantubendaharapengeluaran/bukubantuls.php",{tgl:tgl,tglx:tglx},
			function(result){
				$("#grid_laporan").html(result);
				jfdata_table(); 
			}
		);
}

function formbukubantupanjar(){ 
	jfloading("sub_konten"); 
	$.get("lapo_/bukubantu/bukubantubendaharapengeluaran/formbukubantupanjar.php",
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
		$.get("lapo_/bukubantu/bukubantubendaharapengeluaran/bukubantupanjar.php",{tgl:tgl,tglx:tglx},
			function(result){
				$("#grid_laporan").html(result);
				jfdata_table(); 
			}
		);
}

function formbukubantupajak(){ 
	jfloading("sub_konten"); 
	$.get("lapo_/bukubantu/bukubantubendaharapengeluaran/formbukubantupajak.php",
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

function caribukubantupajak(){  
	tgl=document.form.tgl.value;
	tglx=document.form.tglx.value;
	jfloading("grid_laporan");
		$.get("lapo_/bukubantu/bukubantubendaharapengeluaran/bukubantupajak.php",{tgl:tgl,tglx:tglx},
			function(result){
				$("#grid_laporan").html(result);
				jfdata_table(); 
			}
		);
}