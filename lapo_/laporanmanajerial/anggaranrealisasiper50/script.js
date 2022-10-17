function formanggarandanrealisasiper50(){
	jfloading("sub_konten"); 
	$.get("lapo_/laporanmanajerial/anggaranrealisasiper50/form.php",
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

function lihathasilanggarandanrealisasiper50(){ 
	tgl=document.form.tgl.value;
	tglx=document.form.tglx.value;	
	jfloading("grid_laporan");
		$.get("lapo_/laporanmanajerial/anggaranrealisasiper50/lihathasilanggarandanrealisasiper50.php",{tgl:tgl,tglx:tglx},
			function(result){
				$("#grid_laporan").html(result);
				jfdata_table(); 
			}
		);
}
