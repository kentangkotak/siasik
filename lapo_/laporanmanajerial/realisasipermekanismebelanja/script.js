function formrealisasipermekanismebelanja(){
	jfloading("sub_konten"); 
	$.get("lapo_/laporanmanajerial/realisasipermekanismebelanja/form.php",
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

function lihathasilrealisasi(){ 
	tgl=document.form.tgl.value;
	tglx=document.form.tglx.value;	
	jfloading("grid_laporan");
		$.get("lapo_/laporanmanajerial/realisasipermekanismebelanja/lihathasilrealisasi.php",{tgl:tgl,tglx:tglx},
			function(result){
				$("#grid_laporan").html(result);
				jfdata_table(); 
			}
		);
}
