function laporanrealisasibelanjamodal(){ 
	
	tgl=document.form.tgl.value;
	tglx=document.form.tglx.value;
	$.get("lapo_/realisasibelanjamodal/laporanrealisasibelanjamodal.php",{tgl:tgl,tglx:tglx},
		function(result){ 
			$("#grid_nilai").html(result);
			jfdata_tablex(); 
		}
	);
}

function formrealisasibelanjamodal(){ 
	jfloading("sub_konten");
	$.get("lapo_/realisasibelanjamodal/formrealisasibelanjamodal.php",
		function(result){
			$("#sub_konten").html(result);
			jfdata_tablex();
			$('#tgl').datetimepicker({
				format: 'DD/MM/YYYY'
			});
			$('#tglx').datetimepicker({
				format: 'DD/MM/YYYY'
			});
		}
	);
}

function ExportToExcel_laporanLRA() {
  var htmltable = document.getElementById('excel_repot_laporanLRA');
  var html = htmltable.outerHTML;
  window.open('data:application/vnd.ms-excel,' + encodeURIComponent(html));
}

function caribagian(){
	$.fancybox({
		'href'			:'lapo_/laporanlra/caribagian.php',
		'overlayOpacity':0,
		'opacity'		: true,
		'transitionIn'	: 'elastic',
		'type'			: 'ajax'
	});
}

function pilihbidang(kodebidang,bidang){ 
	document.form.kodebidang.value=kodebidang;
	document.form.bidang.value=bidang;
	document.form.kodekegiatanblud.value='';
	document.form.kegiatanblud.value='';
	$.fancybox.close();
}

function carikegiatan(){
	kodebidang=document.form.kodebidang.value;
	if(kodebidang == ''){
		swal("Gagal..!!!", 'ANDA HARUS PILIH BIDANG TERLEBIH DAHULU....!!!', "error");
	}else{
		$.fancybox({
			'href'			:'lapo_/laporanlra/carikegiatan.php?kodebidang='+kodebidang,
			'overlayOpacity':0,
			'opacity'		: true,
			'transitionIn'	: 'elastic',
			'type'			: 'ajax'
		});
	}
}

function pilihkegiatan(kodekegiatan,numenklatur){ 
	document.form.kodekegiatanblud.value=kodekegiatan;
	document.form.kegiatanblud.value=numenklatur;
	$.fancybox.close();
}
