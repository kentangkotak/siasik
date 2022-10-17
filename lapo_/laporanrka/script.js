function rkapendapatan(){ 
	jfloading("sub_konten");
	$.get("lapo_/laporanrka/lihatrkapendapatan.php",
		function(result){
			$("#sub_konten").html(result);
		}
	);
}

function ExportToExcel_laporanRekapPengusulan() {
  var htmltable = document.getElementById('excel_repot_laporanRekapPengusulan');
  var html = htmltable.outerHTML;
  window.open('data:application/vnd.ms-excel,' + encodeURIComponent(html));
}

function formrekapitulasi(){ 
	jfloading("sub_konten");
	$.get("lapo_/laporanrba/lihatrekapskpdx.php",
		function(result){
			$("#sub_konten").html(result);
			fungsikomplet();
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
