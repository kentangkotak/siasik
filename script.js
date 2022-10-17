function angka(objek) {
	objek = typeof(objek) != 'undefined' ? objek : 0;
	a = objek.value;
	b = a.replace(/[^\d]/g,"");
	c = "";
	panjang = b.length;
	j = 0;
	for (i = panjang; i > 0; i--) {
		j = j + 1;
		if (((j % 3) == 1) && (j != 1)) {
		c = b.substr(i-1,1) + "." + c;
		} else {
			c = b.substr(i-1,1) + c;
		}
	}
	objek.value = c;
}
function angkax(objek) {
	a = objek;
	b = a.replace(/[^\d]/g,"");
	c = "";
	panjang = b.length;
	j = 0;
	for (i = panjang; i > 0; i--) {
		j = j + 1;
		if (((j % 3) == 1) && (j != 1)) {
		c = b.substr(i-1,1) + "." + c;
		} else {
			c = b.substr(i-1,1) + c;
		}
	}
	return c;
}

function currency(object){	
	object.value = object.value.toString().replace(/(?<!\..*)(\d)(?=(?:\d{3})+(?:\.|$))/g, '$1.');
}

function rupiahKoma(objek){
	bilangan = objek.value;
	var	number_string = bilangan.toString(),
	split	= number_string.split(','),
	sisa 	= split[0].length % 3,
	rupiah 	= split[0].substr(0, sisa),
	ribuan 	= split[0].substr(sisa).match(/\d{1,3}/gi);
		
	if (ribuan) {
		separator = sisa ? '.' : '';
		rupiah += separator + ribuan.join('.');
	}
	rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
	objek.value = rupiah;
}

function selectCombo(theSel,text){
	for(i=theSel.length-1; i>=0; i--){
		if(theSel.options[i].value==text){ theSel.selectedIndex=i }
	}
}
function clearCombo(theSel){
  for(i=theSel.length-1; i>=0; i--){
	theSel.options[i] = null;
  }
}
function appendCombo(theSel,newText, newValue){
  if (theSel.length == 0) {
    var newOpt1 = new Option(newText, newValue);
    theSel.options[0] = newOpt1;
    theSel.selectedIndex = 0;
  } else if (theSel.selectedIndex != -1) {
    var selText = new Array();
    var selValues = new Array();
    var selIsSel = new Array();
    var newCount = -1;
    var newSelected = -1;
    var i;
    for(i=0; i<theSel.length; i++)
    {
      newCount++;
      selText[newCount] = theSel.options[i].text;
      selValues[newCount] = theSel.options[i].value;
      selIsSel[newCount] = theSel.options[i].selected;

      if (newCount == theSel.selectedIndex) {
        newCount++;
        selText[newCount] = newText;
        selValues[newCount] = newValue;
        selIsSel[newCount] = false;
        newSelected = newCount - 1;
      }
    }
    for(i=0; i<=newCount; i++)
    {
      var newOpt = new Option(selText[i], selValues[i]);
      theSel.options[i] = newOpt;
      theSel.options[i].selected = selIsSel[i];
    }
  }
}
function jfdata_table(){
	$('#dataTables-example').DataTable({
		responsive: true,
		retrieve: true
	});
}

function jfdata_table2(){
	$('#dataTables-example2').DataTable({
		responsive: true,
		retrieve: true
	});
}

function jfdata_tablex(){ 
	$('#dataTables-examplex').DataTable({ 
		responsive: true,
		paging: true,
		scrollY: 400,
		dom: 'Bfrtip',
			buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
	}); 
}

function jfreal_time(){
	$.get("tanggal.php",
		function(result){
			$("#tanggal").html(result);
		}
	);
	setTimeout("jfreal_time()",1000);
}
function jfloading(layout){
	$("#"+layout).html("<img src='images/ld.gif' width='70'>");
}

function dashboard(){ 
	jfloading("page-wrapper");
	$.get("dashboard/dashboard/index.php",
		function(result){ 
			$("#page-wrapper").html(result);
			//listsiswa();
		}
	);
}

function satuanBarang(){ 
	jfloading("page-wrapper");
	$.get("master_folder/satuan/index.php",
		function(result){
			$("#page-wrapper").html(result);
			listSatuan();
		}
	);
}

function pihakketiga(){ 
	jfloading("page-wrapper");
	$.get("master_folder/pihakketiga/index.php",
		function(result){
			$("#page-wrapper").html(result);
			listpihakketiga();
		}
	);
}

function kemendagri50c(){ 
	jfloading("page-wrapper");
	$.get("master_folder/kegiatan_permendagri_50/index.php",
		function(result){
			$("#page-wrapper").html(result);
			list_perencanaan_pembagunan();
		}
	);
}

function kemendagri50e(){ 
	jfloading("page-wrapper");
	$.get("master_folder/kegiatan_permendagri_50e/index.php",
		function(result){
			$("#page-wrapper").html(result);
			list_klasifikasi();
		}
	);
}

function akunblud(){ 
	jfloading("page-wrapper");
	$.get("master_folder/akun_blud/index.php",
		function(result){
			$("#page-wrapper").html(result);
			data_akun_blud();
		}
	);
}

function penyelenggara(){ 
	jfloading("page-wrapper");
	$.get("master_folder/penyelenggara/index.php",
		function(result){
			$("#page-wrapper").html(result);
			form();
		}
	);
}

function mapingkegiatanbludkepemkot(){ 
	jfloading("page-wrapper");
	$.get("master_folder/mapingkegiatanbludkepemkot/index.php",
		function(result){
			$("#page-wrapper").html(result);
			datamapping();
		}
	);
}

function pendapatan(){ 
	jfloading("page-wrapper");
	$.get("trans_/pendapatan/index.php",
		function(result){
			$("#page-wrapper").html(result);
			formpendapatan();
		}
	);
}

function penetapanpagu(){ 
	jfloading("page-wrapper");
	$.get("trans_/penetapanpagu/index.php",
		function(result){
			$("#page-wrapper").html(result);
			formpenetapanpagu();
		}
	);
}

function mappingpptkkegiatan(){ 
	jfloading("page-wrapper");
	$.get("master_folder/mappingpptkkegiatan/index.php",
		function(result){
			$("#page-wrapper").html(result);
			datamapingpptkkegiatan();
		}
	);
}

function pengusulan(){ 
	jfloading("page-wrapper");
	$.get("trans_/pengusulan/index.php",
		function(result){
			$("#page-wrapper").html(result);
			datapengusulanhonor();
		}
	);
}

function penyesuaianperioritas(){ 
	jfloading("page-wrapper");
	$.get("trans_/penyusunan/penyesuaianperioritas/index.php",
		function(result){
			$("#page-wrapper").html(result);
			datapenentuanperioritas();
		}
	);
}

function formbiayapendidikan(){ 
	jfloading("page-wrapper");
	$.get("master_folder/pendidikan/index.php",
		function(result){
			$("#page-wrapper").html(result);
			listpendidikan();
		}
	);
}

function pembiayaan(){ 
	jfloading("page-wrapper");
	$.get("eks/pembiayaan/index.php",
		function(result){
			$("#page-wrapper").html(result);
			listpendidikan();
		}
	);
}

//==========================ARIF==================================================
function organisasi(){ 
	jfloading("page-wrapper");
	$.get("master_folder/organisasi/index.php",
		function(result){
			$("#page-wrapper").html(result);
			list();
		}
	);
}

function kegiatan_blud(){ 
	jfloading("page-wrapper");
	$.get("master_folder/kegiatan_blud/index.php",
		function(result){
			$("#page-wrapper").html(result);
			list();
		}
	);
}

function akun_permendagri50(){ 
	jfloading("page-wrapper");
	$.get("master_folder/akun_permendagri50/index.php",
		function(result){
			$("#page-wrapper").html(result);
			list();
		}
	);
}

function akun_psap13(){ 
	jfloading("page-wrapper");
	$.get("master_folder/akun_psap13/index.php",
		function(result){
			$("#page-wrapper").html(result);
			list();
		}
	);
}

function akun_permendagri108(){ 
	jfloading("page-wrapper");
	$.get("master_folder/akun_permendagri108/index.php",
		function(result){
			$("#page-wrapper").html(result);
			list();
		}
	);
}

function akun_permendagri79(){ 
	jfloading("page-wrapper");
	$.get("master_folder/akun_permendagri79/index.php",
		function(result){
			$("#page-wrapper").html(result);
			list();
		}
	);
}

function mapping_blud_79(){ 
	jfloading("page-wrapper");
	$.get("master_folder/mapping_blud_79/index.php",
		function(result){
			$("#page-wrapper").html(result);
			data_akun_blud();
		}
	);
}

function mapping_blud_psap13(){ 
	jfloading("page-wrapper");
	$.get("master_folder/mapping_blud_psap13/index.php",
		function(result){
			$("#page-wrapper").html(result);
			data_akun_blud();
		}
	);
}

function mapping_108_blud(){ 
	jfloading("page-wrapper");
	$.get("master_folder/mapping_108_blud/index.php",
		function(result){
			$("#page-wrapper").html(result);
			list();
		}
	);
}


function pptk(){ 
	jfloading("page-wrapper");
	$.get("master_folder/pptk/index.php",
		function(result){
			$("#page-wrapper").html(result);
			datapptk();
		}
	);
}

function penetapananggaran(){ 
	jfloading("page-wrapper");
	$.get("trans_/penetapananggaran/index.php",
		function(result){
			$("#page-wrapper").html(result);
			datapenempatan_anggaran();
		}
	);
}

function menuspp(){ 
	jfloading("page-wrapper");
	$.get("trans_/panjar/spp/index.php",
		function(result){
			$("#page-wrapper").html(result);
			formsppup();
		}
	);
}

function menuverifspp(){ 
	jfloading("page-wrapper");
	$.get("trans_/verifspm/index.php",
		function(result){
			$("#page-wrapper").html(result);
			dataspp_siap_up();
		}
	);
}

function menuspm(){ 
	jfloading("page-wrapper");
	$.get("trans_/menuspm/index.php",
		function(result){
			$("#page-wrapper").html(result);
			dataspp_spp_ter();
		}
	);
}

function lapRekapPengusulan(){ 
	jfloading("page-wrapper");
	$.get("lapo_/lapRekapPengusulan/index.php",
		function(result){
			$("#page-wrapper").html(result);
			laporanRekapPengusulan();
		}
	);
}

function lapRekapPenyesuaianPerioritas(){ 
	jfloading("page-wrapper");
	$.get("lapo_/lapRekapPenyesuaianPerioritas/index.php",
		function(result){
			$("#page-wrapper").html(result);
			laporanRekapPenyesuaianPerioritas();
		}
	);
}

function settingLog(){ 
	jfloading("page-wrapper");
	$.get("setting/loging/index.php",
		function(result){
			$("#page-wrapper").html(result);
			dataLog();
		}
	);
}

function pergeseran_kas(){ 
	jfloading("page-wrapper");
	$.get("trans_/pergeseran_kas/index.php",
		function(result){
			$("#page-wrapper").html(result);
			dataPergeseranKas();
		}
	);
}

function npdPanjar(){ 
	jfloading("page-wrapper");
	$.get("trans_/npdPanjar/index.php",
		function(result){
			$("#page-wrapper").html(result);
			datanpdpanjar();
		}
	);
}

function kotrakPekerjaan(){ 
	jfloading("page-wrapper");
	$.get("trans_/kotrakPekerjaan/index.php",
		function(result){
			$("#page-wrapper").html(result);
			datakontrakpekerjaan();
		}
	);
}

function verifnpdPanjar(){ 
	jfloading("page-wrapper");
	$.get("trans_/verifnpdpanjar/index.php",
		function(result){
			$("#page-wrapper").html(result);
			dataverifnpdPanjar();
		}
	);
}

function npkpanjar(){ 
	jfloading("page-wrapper");
	$.get("trans_/npkpanjar/index.php",
		function(result){
			$("#page-wrapper").html(result);
			datanpkpanjar();
		}
	);
}

function notapanjar(){ 
	jfloading("page-wrapper");
	$.get("trans_/notapanjar/index.php",
		function(result){
			$("#page-wrapper").html(result);
			datanotapanjar();
		}
	);
}

function spjpanjar(){ 
	jfloading("page-wrapper");
	$.get("trans_/spjpanjar/index.php",
		function(result){
			$("#page-wrapper").html(result);
			dataspjpanjar();
		}
	);
}

function verifspjpanjar(){ 
	jfloading("page-wrapper");
	$.get("trans_/verifspjpanjar/index.php",
		function(result){
			$("#page-wrapper").html(result);
			dataspjpanjar();
		}
	);
}

function pengembaliansisaspj(){ 
	jfloading("page-wrapper");
	$.get("trans_/pengembaliansisaspj/index.php",
		function(result){
			$("#page-wrapper").html(result);
			datapengembaliansisaspjpanjar();
		}
	);
}

function pengembalianpanjar(){ 
	jfloading("page-wrapper");
	$.get("trans_/pengembalianpanjar/index.php",
		function(result){
			$("#page-wrapper").html(result);
			datapengembalianpanjar();
		}
	);
}

function serahterimapekerjaan(){ 
	jfloading("page-wrapper");
	$.get("trans_/serahterimapekerjaan/index.php",
		function(result){
			$("#page-wrapper").html(result);
			dataserahterimah();
		}
	);
}

function npdls(){ 
	jfloading("page-wrapper");
	$.get("trans_/npdls/index.php",
		function(result){
			$("#page-wrapper").html(result);
			datanpdls();
		}
	);
}

function verifnpdls(){
	jfloading("page-wrapper");
	$.get("trans_/verifnpdls/index.php",
		function(result){
			$("#page-wrapper").html(result);
			datanpdlsbelumterverif();
		}
	);	
}

function npkls(){
	jfloading("page-wrapper");
	$.get("trans_/npkls/index.php",
		function(result){
			$("#page-wrapper").html(result);
			datanpkls();
		}
	);	
}

function guu(){
	jfloading("page-wrapper");
	$.get("trans_/guu/index.php",
		function(result){
			$("#page-wrapper").html(result);
			dataguu();
		}
	);	
}

function verif_pergeseran_kas(){
	jfloading("page-wrapper");
	$.get("trans_/verif_pergeseran_kas/index.php",
		function(result){
			$("#page-wrapper").html(result);
			data_sudah_terverif();
		}
	);	
}

function pencairanls(){
	jfloading("page-wrapper");
	$.get("trans_/pencairanls/index.php",
		function(result){
			$("#page-wrapper").html(result);
			datanpkls();
		}
	);	
}

function laporanrba(){ 
	jfloading("page-wrapper");
	$.get("lapo_/laporanrba/index.php",
		function(result){
			$("#page-wrapper").html(result);
			formrekapskpd();
		}
	);
}

function laporanlra(){ 
	jfloading("page-wrapper");
	$.get("lapo_/laporanlra/index.php",
		function(result){
			$("#page-wrapper").html(result);
			reportlra();
		}
	);
}

function paguindikatif(){
	jfloading("page-wrapper");
	$.get("trans_/pergeseran/paguindikatif/index.php",
		function(result){
			$("#page-wrapper").html(result);
			datapendapatan();
		}
	);	
}

function perubahanpagubelanja(){
	jfloading("page-wrapper");
	$.get("trans_/pergeseran/perubahanpagubelanja/index.php",
		function(result){
			$("#page-wrapper").html(result);
			datapenetapanpagu();
		}
	);	
}

function perubahanrincianbelanja(){
	jfloading("page-wrapper");
	$.get("trans_/pergeseran/perubahanrincianbelanja/index.php",
		function(result){
			$("#page-wrapper").html(result);
			dataperioritasperubahan();
		}
	);	
}

function perubahanpagubelanjarinci(){
	jfloading("page-wrapper");
	$.get("trans_/perubahanpagubelanjarinci/index.php",
		function(result){
			$("#page-wrapper").html(result);
			dataperioritasperubahan();
		}
	);	
}

function paguindikatif_pak(){
	jfloading("page-wrapper");
	$.get("trans_/perubahan/paguindikatif_pak/index.php",
		function(result){
			$("#page-wrapper").html(result);
			datapendapatan();
		}
	);	
}

function perubahanpagubelanja_pak(){
	jfloading("page-wrapper");
	$.get("trans_/perubahan/perubahanpagu_pak/index.php",
		function(result){
			$("#page-wrapper").html(result);
			datapenetapanpagu();
		}
	);	
}

function perubahanpagubelanjarinci_pak(){
	jfloading("page-wrapper");
	$.get("trans_/perubahan/perubahan_rincian_belanja_pak/index.php",
		function(result){
			$("#page-wrapper").html(result);
			dataperubahanrincianbelanja();
		}
	);	
}

function perubahanrincianbelanja_pak(){
	jfloading("page-wrapper");
	$.get("trans_/perubahan/pergeseranpagubelanjarinci_pak_x/index.php",
		function(result){
			$("#page-wrapper").html(result);
			dataperioritasperubahan_revisi1_x();
		}
	);	
}

function jurnalumum(){
	jfloading("page-wrapper");
	$.get("trans_/penatausahaan/jurnalumum/index.php",
		function(result){
			$("#page-wrapper").html(result);
			datajurnalumumx();
		}
	);	
}

function laporanrka(){ 
	jfloading("page-wrapper");
	$.get("lapo_/laporanrka/index.php",
		function(result){
			$("#page-wrapper").html(result);
			rkapendapatan(); 
		}
	);
}

function laporanbku(){
	jfloading("page-wrapper");
	$.get("lapo_/laporanbku_pengeluaran/index.php",
		function(result){
			$("#page-wrapper").html(result);
			formbkupengeluaran(); 
		}
	);
}

function laporanpengajuankegiatan(){ 
	jfloading("page-wrapper");
	$.get("lapo_/laporanpengajuankegiatan/index.php",
		function(result){
			$("#page-wrapper").html(result);
			formcaripengajuankegiatan(); 
		}
	);
}

function pembebasanpajakfarmasi(){ 
	jfloading("page-wrapper");
	$.get("trans_/pembebasanpajak/farmasi/index.php",
		function(result){
			$("#page-wrapper").html(result);
			datapembebasanpajak(); 
		}
	);
}

function contrapost(){ 
	jfloading("page-wrapper");
	$.get("trans_/contrapost/index.php",
		function(result){
			$("#page-wrapper").html(result);
			datacontrapost(); 
		}
	);
}

function formbkuppk(){ 
	jfloading("page-wrapper");
	$.get("lapo_/bkuppk/index.php",
		function(result){
			$("#page-wrapper").html(result);
			formbkuppkxxx(); 
		}
	);
}

function formbkupptk(){ 
	jfloading("page-wrapper");
	$.get("lapo_/bkupptk/index.php",
		function(result){
			$("#page-wrapper").html(result);
			formbkupptk(); 
		}
	);
}

function setoransts(){ 
	jfloading("page-wrapper");
	$.get("trans_/pendapatan_daribill/sts/index.php",
		function(result){
			$("#page-wrapper").html(result);
			datastsbelumterverif(); 
		}
	);
}

function formbukubantuppkx(){ 
	jfloading("page-wrapper");
	$.get("lapo_/bukubantu/bukubantuppk/index.php",
		function(result){
			$("#page-wrapper").html(result);
			formbukubantuppk(); 
		}
	);
}

function formbukubantubendaharapengeluaranx(){ 
	jfloading("page-wrapper");
	$.get("lapo_/bukubantu/bukubantubendaharapengeluaran/index.php",
		function(result){
			$("#page-wrapper").html(result);
			formbukubantubendaharapengeluaran(); 
		}
	);
}


function formbukubantukaspptk(){ 
	jfloading("page-wrapper");
	$.get("lapo_/bukubantu/bukubantukaspptk/index.php",
		function(result){
			$("#page-wrapper").html(result);
			formbukubantukaspptkxz(); 
		}
	);
}

function anggaranperkegiatan(){ 
	jfloading("page-wrapper");
	$.get("lapo_/laporanmanajerial/anggaranperkegiatan/index.php",
		function(result){
			$("#page-wrapper").html(result);
			formanggaranperkegiatan();
		}
	);
}

function anggaransuratedaran(){ 
	jfloading("page-wrapper");
	$.get("lapo_/laporanmanajerial/anggaransuratedaran/index.php",
		function(result){
			$("#page-wrapper").html(result);
			formsuratedaran();
		}
	);
}

function cashflow(){ 
	jfloading("page-wrapper");
	$.get("lapo_/laporanmanajerial/cashflow/index.php",
		function(result){
			$("#page-wrapper").html(result);
			formcashflow();
		}
	);
}

function anggaransuratedaranrealisasi(){ 
	jfloading("page-wrapper");
	$.get("lapo_/laporanmanajerial/anggaransuratedaranrealisasi/index.php",
		function(result){
			$("#page-wrapper").html(result);
			formsuratedaranrealisasi();
		}
	);
}

function anggarandanrealisasipptkegiatan(){ 
	jfloading("page-wrapper");
	$.get("lapo_/laporanmanajerial/anggarandanrealisasipptkegiatan/index.php",
		function(result){
			$("#page-wrapper").html(result);
			formanggarandanrealisasipptkkegiatan();
		}
	);
}

function realisasipermekanismebelanja(){ 
	jfloading("page-wrapper");
	$.get("lapo_/laporanmanajerial/realisasipermekanismebelanja/index.php",
		function(result){
			$("#page-wrapper").html(result);
			formrealisasipermekanismebelanja();
		}
	);
}

function anggarandanrealisasiper108(){ 
	jfloading("page-wrapper");
	$.get("lapo_/laporanmanajerial/anggarandanrealisasiper108/index.php",
		function(result){
			$("#page-wrapper").html(result);
			formanggarandanrealisasiper108();
		}
	);
}

function anggaranrealisasiper50(){ 
	jfloading("page-wrapper");
	$.get("lapo_/laporanmanajerial/anggaranrealisasiper50/index.php",
		function(result){
			$("#page-wrapper").html(result);
			formanggarandanrealisasiper50();
		}
	);
}

function realisasibelanjamodal(){ 
	jfloading("page-wrapper");
	$.get("lapo_/realisasibelanjamodal/index.php",
		function(result){
			$("#page-wrapper").html(result);
			formrealisasibelanjamodal();
		}
	);
}

function rinciannpk(){ 
	jfloading("page-wrapper");
	$.get("lapo_/rinciannpk/index.php",
		function(result){
			$("#page-wrapper").html(result);
			formrinciannpk();
		}
	);
}

function msp3b(){ 
	jfloading("page-wrapper");
	$.get("trans_/penatausahaan/msp3b/index.php",
		function(result){
			$("#page-wrapper").html(result);
			datasp3b();
		}
	);
}

function silpa(){ 
	jfloading("page-wrapper");
	$.get("trans_/perubahan/silpa/index.php",
		function(result){
			$("#page-wrapper").html(result);
			forminputsilpa();
		}
	);
}

