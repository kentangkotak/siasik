function datapengusulanx(){
	jfloading("sub_konten");
	$.get("trans_/pengusulan/datapengusulan.php",
		function(result){
			$("#sub_konten").html(result);
			jfdata_table(); 
		}
	);
}

function datapengusulanxz(){
	jfloading("sub_konten");
	$.get("trans_/pengusulan/datapengusulanxz.php",
		function(result){
			$("#sub_konten").html(result);
			jfdata_table(); 
		}
	);
}


function viewrinci(kode){  
	$.fancybox({
		'href'			:'trans_/pengusulan/datapengusulan_rinci.php?kode='+kode,
		'overlayOpacity':0,
		//'opacity'		: true,
		//'transitionIn'	: 'elastic',
		'type'			: 'ajax',
		//'z-index'		: '-1'
	});
}


function simpanpagu(){ 
    
	notrans=document.form.notrans.value;
	kodekegiatanblud=document.form.kodekegiatanblud.value;
	kegiatanblud=document.form.kegiatanblud.value;
	nilairupiah=document.form.nilairupiah.value;
	kode1=document.form.kode1.value;
	kode2=document.form.kode2.value;
	kode3=document.form.kode3.value;
	organisasi_nama=document.form.organisasi_nama.value;
	
	if(kodekegiatanblud==''){
		swal("Gagal..!!!", "KEGIATAN BELUM DI ISI ATAU KEGIATAN BELUM TERDAFTAR....!!!", "error");
	}else if(nilairupiah==''){
		swal("Gagal..!!!", "NILAI RUPIAH HARUS DI ISI..!!!", "error");
	}else{
		$.get('trans_/pengusulan/simpan.php',{notrans:notrans,kodekegiatanblud:kodekegiatanblud,kegiatanblud:kegiatanblud,nilairupiah:nilairupiah,
		kode1:kode1,kode2:kode2,kode3:kode3,organisasi_nama:organisasi_nama},
			function(result){ 
				var update = new Array();
				update = result.split('|');
				if(result.indexOf('|' != -1)) { 
					if(update[0]=="OK"){ 
						swal("OK..!!", "DATA SUDAH DISIMPAN...", "success");
						document.form.notrans.value=update[1];
						formpengusulan();
					}else{
						swal("Gagal..!!!", result, "error");
					}
				}
			}
		);  
	}
}

function closeMessage(){
	$.fancybox.close();
}

function batal(){
	notrans=document.form.notrans.value;
	jfloading("sub_konten");
	$.get("trans_/pengusulan/batal.php",{notrans:notrans},function(result){ 
			var update = new Array();
			update = result.split('|');
			if(result.indexOf('|' != -1)) { 
				if(update[0]=="OK"){  
					swal("OK..!!", "PELATIHAN SUDAH DIBATALKAN...", "success");
					formpelaksanaanx();	
				}else{
					swal("Gagal..!!!", result, "error");
				}
			}
		}
	);
}

function formpengusulanhonor(notrans){
	jfloading("sub_konten");
	$.get("trans_/pengusulan/formpengusulanhonor.php",{notrans:notrans},
		function(result){
			$("#sub_konten").html(result);
			fungsikomplet();
			if(notrans != undefined){
				mati();
			}
			gridrinci(notrans);
		}
	);
}

function fungsikomplet(){  
	$("#kegiatan").autocomplete({
		serviceUrl:'trans_/pengusulan/autobykegiatan.php',
		type: "GET",
		    onSelect: function (suggestion) {
		    	$('#kegiatan').val(suggestion.nomenklatur);
				$('#kodekegiatan').val(suggestion.no);
				$('#kodebagian').val(suggestion.kodebagian);
				$('#organisasi_nama').val(suggestion.organisasi_nama);	
				$('#kode50').val(suggestion.kode50);
				$('#uraian').val(suggestion.uraian);				
		    }

	});
}

function simpantranskegiatan(){ 
    
	notrans=document.form.notrans.value; 
	ruangan=document.form.ruangan.value; 
	tgltrans=document.form.tgltrans.value; 
	koderuang=document.form.koderuang.value;	
	kodekegiatan=document.form.kodekegiatan.value;
	kodebagian=document.form.kodebagian.value;
	organisasi_nama=document.form.organisasi_nama.value;
	kode50=document.form.kode50.value;
	uraian=document.form.uraian.value;
	kegiatan=document.form.kegiatan.value;
	
	keterangan=document.form_rinci.keterangan.value;
	volume=document.form_rinci.volume.value;
	harga=document.form_rinci.harga.value; 
	satuan=document.form_rinci.satuan.value; 
	bidangPengusul=document.form_rinci.bidangPengusul.value;
	
	if(koderuang==''){
		swal("Gagal..!!!", "RUANGAN TIDAK BOLEH KOSONG ATAU RUANGAN BELUM TERDAFTAR....!!!", "error");
	}else if(ruangan==''){
		swal("Gagal..!!!", "RUANGAN TIDAK BOLEH KOSONG ATAU RUANGAN BELUM TERDAFTAR....!!!", "error");
	}else if(tgltrans==''){
		swal("Gagal..!!!", "TANGGAL TIDAK BOLEH KOSONG....!!!", "error");
	}else if(kodekegiatan==''){
		swal("Gagal..!!!", "KEGIATAN TIDAK BOLEH KOSONG ATAU KEGIATAN BELUM TERDAFTAR....!!!", "error");
	}else if(kegiatan==''){
		swal("Gagal..!!!", "KEGIATAN TIDAK BOLEH KOSONG ATAU KEGIATAN BELUM TERDAFTAR....!!!", "error");
	}else if(keterangan==''){
		swal("Gagal..!!!", "KETERANGAN TIDAK BOLEH KOSONG....!!!", "error");
	}else if(volume==''){
		swal("Gagal..!!!", "JUMLAH YANG DIACC DARI MUSRENBANG TIDAK BOLEH KOSONG....!!!", "error");
	}else if(harga==''){
		swal("Gagal..!!!", "HARGA TIDAK BOLEH KOSONG....!!!", "error");
	}else if(bidangPengusul==''){
		swal("Gagal..!!!", "BIDANG PENGUSUL TIDAK BOLEH KOSONG....!!!", "error");
	}else{
		$.get('trans_/pengusulan/simpan.php',{satuan:satuan,bidangPengusul:bidangPengusul,notrans:notrans,ruangan:ruangan,tgltrans:tgltrans,koderuang:koderuang,kodekegiatan:kodekegiatan,kegiatan:kegiatan,keterangan:keterangan,
				volume:volume,harga:harga,kodebagian:kodebagian,organisasi_nama:organisasi_nama,kode50:kode50,uraian:uraian},
			function(result){ 
				var update = new Array();
				update = result.split('|');
				if(result.indexOf('|' != -1)) { 
					if(update[0]=="OK"){ 
						swal("OK..!!", "DATA SUDAH DISIMPAN...", "success");
						document.form.notrans.value=update[1];
						gridrinci(update[1]);
						mati();
						clearrinci();
					}else{
						swal("Gagal..!!!", result, "error");
					}
				}
			}
		);  
	}
}

function mati(){
	document.form.tgltrans.disabled=true;
	document.form.kegiatan.disabled=true;
}

function clearrinci(){

	document.form_rinci.keterangan.value='';
	document.form_rinci.volume.value='';
	document.form_rinci.harga.value='';
}

async function gridrinci(notrans){  
	jfloading("grid_nilai");
	await $.get("trans_/pengusulan/gridrinci.php",{notrans:notrans},
		function(result){ 
			$("#grid_nilai").html(result); 
			jfdata_table(); 
		}
	);

	kodekegiatan=document.form.kodekegiatan.value;
	await $.getJSON("trans_/pengusulan/getPaguByKegiatan.php",{kodekegiatan:kodekegiatan},function(result){ 
		warna = "";
		if(result.sisaPagu<1){
			warna = `style='font-color:red;'`;
		}
		$("#contentPagu").html(`
			<b ${warna}>
				<br>Pagu : ${result.paguRp}
				<br>Total Usualan : ${result.totalUsulanRp}
				<br>Sisa : ${result.sisaPaguRp}
				<br>
			</b>
		`);
	});	 
}

function datapengusulanhonor(){
	jfloading("sub_konten");
	$.get("trans_/pengusulan/datapengusulanhonor.php",
		function(result){
			$("#sub_konten").html(result);
			jfdata_table(); 
		}
	);
}

function hapus_rinci(id,notrans){
	jfloading("grid_nilai");
	$.get("trans_/pengusulan/hapus_rinci.php",{id:id,notrans:notrans},function(result){ 
			var update = new Array();
			update = result.split('|');
			if(result.indexOf('|' != -1)) { 
				if(update[0]=="OK"){  
					swal("OK..!!", "DATA SUDAH DIHAPUS...", "success");
					gridrinci(notrans);	
				}else{
					swal("Gagal..!!!", result, "error");
					gridrinci(notrans);
				}
			}
		}
	);
}

function hapustransaksi(){
	notrans=document.form.notrans.value; 
	jfloading("sub_konten");
	$.get("trans_/pengusulan/hapustransaksi.php",{notrans:notrans},function(result){ 
			var update = new Array();
			update = result.split('|');
			if(result.indexOf('|' != -1)) { 
				if(update[0]=="OK"){  
					swal("OK..!!", "DATA SUDAH DIHAPUS...", "success");
					datapengusulanhonor();
				}else{
					swal("Gagal..!!!", result, "error");
					datapengusulanhonor();
				}
			}
		}
	);
}

function hapusHeader(notrans){
	if(confirm("apakah yakin data akan dihapus?")){
		$.get("trans_/pengusulan/hapusHeader.php",{notrans:notrans},function(result){ 
			if(result=="OK"){
				datapengusulanhonor();
			}
			else{
				swal("GAGAL", result, "error");
			}
		});
	}
}

function getPaguByKegiatan(kodekegiatan){
	$.getJSON("trans_/pengusulan/getPaguByKegiatan.php",{kodekegiatan:kodekegiatan},function(result){ 
		if(result.sisaPagu>0){
			swal("Sisa pagu : "+result.sisaPaguRp,"", "success");
		}
		else{
			swal("Sisa pagu : "+result.sisaPaguRp, "", "error");
		}
	});	
}