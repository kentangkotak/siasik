function formanggarandanrealisasiper108(){
	jfloading("sub_konten"); 
	$.get("lapo_/laporanmanajerial/anggarandanrealisasiper108/form.php",
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

function lihathasilanggarandanrealisasiper108(){ 
	tgl=document.form.tgl.value;
	tglx=document.form.tglx.value;	
	jfloading("grid_laporan");
		$.get("lapo_/laporanmanajerial/anggarandanrealisasiper108/lihathasilanggarandanrealisasiper108.php",{tgl:tgl,tglx:tglx},
			function(result){
				$("#grid_laporan").html(result);
				jfdata_table(); 
			}
		);
}
