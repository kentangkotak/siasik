function ExportToExcel_laporanRekapPengusulan() {
  var htmltable = document.getElementById('excel_repot_laporanRekapPengusulan');
  var html = htmltable.outerHTML;
  window.open('data:application/vnd.ms-excel,' + encodeURIComponent(html));
}

function formrekapitulasi(){ 
	jfloading("sub_konten");
	$.get("lapo_/laporanrba/form.php",
		function(result){
			$("#sub_konten").html(result);
		}
	);
}



function formrekapbelanja(){ 
	jfloading("sub_konten");
	$.get("lapo_/laporanrba/lihatrekapbelanja.php",
		function(result){
			$("#sub_konten").html(result);
			fungsikomplet();
		}
	);
}

function ExportToExcel_rbabelanja() {
  var htmltable = document.getElementById('excel_repot_rbabelanja');
  var html = htmltable.outerHTML;
  window.open('data:application/vnd.ms-excel,' + encodeURIComponent(html));
}

function ExportToExcel_rbarekapitulasi() {
  var htmltable = document.getElementById('excel_repot_rekapitulasi');
  var html = htmltable.outerHTML;
  window.open('data:application/vnd.ms-excel,' + encodeURIComponent(html));
}

function lihatbidang(kode50){ 
	$.fancybox({
		'href'			:'lapo_/laporanrba/lihatbidangyangmenganggarkan.php?kode50='+kode50,
		'overlayOpacity':0,
		'opacity'		: true,
		'transitionIn'	: 'elastic',
		'type'			: 'ajax'
	});
}