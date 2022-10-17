function formpenetapanpagu(notrans,x){ 
	jfloading("sub_konten");
	$.get("trans_/penetapanpagu/form.php",{notrans:notrans,x:x},
		function(result){ 
			$("#sub_konten").html(result);
			fungsikomplet();
		}
	);
}

function datapenetapanpagu(){ 
	jfloading("sub_konten");
	$.get("trans_/penetapanpagu/datapenetapanpagu.php",
		function(result){
			$("#sub_konten").html(result);
			jfdata_table(); 
		}
	);
}


function fungsikomplet(){  
	$("#kegiatanblud").autocomplete({
		serviceUrl:'trans_/penetapanpagu/autobykodekegiatanblud.php',
		type: "GET",
		    onSelect: function (suggestion) {
		    	$('#kodekegiatanblud').val(suggestion.no);
				$('#kegiatanblud').val(suggestion.nomenklatur);
				$('#kode1').val(suggestion.organisasi_kode1);
				$('#kode2').val(suggestion.organisasi_kode2);
				$('#kode3').val(suggestion.organisasi_kode3);
				$('#organisasi_nama').val(suggestion.organisasi_nama);
				
				document.form.nilairupiah.focus();
		    }
	});
	$("#uraian").autocomplete({
		serviceUrl:'trans_/penetapanpagu/autobyuraian.php',
		type: "GET",
		    onSelect: function (suggestion) {
		    	$('#uraian').val(suggestion.uraian);
				$('#koderekeningblud').val(suggestion.koderekeningblud);
		    }
			
	});
}

function gridpeserta(notrans){  
	jfloading("grid_nilai");
	$.get("trans_/penetapanpagu/gridpeserta.php",{notrans:notrans},
		function(result){ 
			$("#grid_nilai").html(result); 
			jfdata_table(); 
		}
	);
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
	x=document.form.x.value;
	
	if(kodekegiatanblud==''){
		swal("Gagal..!!!", "KEGIATAN BELUM DI ISI ATAU KEGIATAN BELUM TERDAFTAR....!!!", "error");
	}else if(nilairupiah==''){
		swal("Gagal..!!!", "NILAI RUPIAH HARUS DI ISI..!!!", "error");
	}else{
		$.get('trans_/penetapanpagu/simpan.php',{notrans:notrans,kodekegiatanblud:kodekegiatanblud,kegiatanblud:kegiatanblud,nilairupiah:nilairupiah,
		kode1:kode1,kode2:kode2,kode3:kode3,organisasi_nama:organisasi_nama,x:x},
			function(result){ 
				var update = new Array();
				update = result.split('|');
				if(result.indexOf('|' != -1)) { 
					if(update[0]=="OK"){ 
						swal("OK..!!", "DATA SUDAH DISIMPAN...", "success");
						document.form.notrans.value=update[1];
						formpenetapanpagu();
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

function mati(){
	document.form.notrans.disabled=true;
	document.form.namax.disabled=true;
	document.form.jenispelatihan.disabled=true;
	document.form.tempat.disabled=true;
	document.form.kategori.disabled=true;
	document.form.penyelenggara.disabled=true;
	document.form.tglmulai.disabled=true;
	document.form.tglsurat.disabled=true;
	document.form.tglselesai.disabled=true;
	document.form.nosurat.disabled=true;
	document.form.jam.disabled=true;	
}

function clearrinci(){
	document.form_rinci.nip.value='';
	document.form_rinci.namapegawai.value='';
	document.form_rinci.nosttp.value='';
	document.form_rinci.koderuangan.value='';
	document.form_rinci.kategoripegawai.value='';
	document.form_rinci.ruangan.value='';
	document.form_rinci.kategoripeg.value='';
	document.form_rinci.kodejabatan.value='';
	document.form_rinci.kodependidikan.value='';
	document.form_rinci.kodegolruang.value='';
	document.form_rinci.kodestatpegawai.value='';
	document.form_rinci.jabatan.value='';
	document.form_rinci.pendidikan.value='';
	document.form_rinci.golruang.value='';
	document.form_rinci.statpeg.value='';
}

function lihat_depan(notransx,nip,filex){ 
	window.open('potos_folder/'+notransx+'/'+nip+'/'+filex,'','height=700,width=850,scrollbars=yes,resizable=yes');
}

function lihat_belakang(notransx,nip,files){ 
	window.open('potos_folder/'+notransx+'/'+nip+'/'+files,'','height=700,width=850,scrollbars=yes,resizable=yes');
}

function hapus_rinci(notrans,nip,filenya){
	jfloading("grid_nilai");
	$.get("trans_/penetapanpagu/hapus_rinci.php",{notrans:notrans,nip:nip,filenya:filenya},function(result){ 
			var update = new Array();
			update = result.split('|');
			if(result.indexOf('|' != -1)) { 
				if(update[0]=="OK"){  
					swal("OK..!!", "DATA SUDAH DIHAPUS...", "success");
					gridpeserta(notrans);	
				}else{
					swal("Gagal..!!!", result, "error");
					gridpeserta(notrans);
				}
			}
		}
	);
}

function batal(){
	notrans=document.form.notrans.value;
	jfloading("sub_konten");
	$.get("trans_/penetapanpagu/batal.php",{notrans:notrans},function(result){ 
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

function simpangambar(nip,notrans){ 
    
	$.fancybox({
		'href'			:'loading.php',
		'overlayOpacity':0,
		'opacity'		: true,
		'transitionIn'	: 'elastic',
		'type'			: 'ajax',
		'showCloseButton':false,
		//'hideOnContentClick':true
	});
	$.ajax({ 
		url: "trans_/penetapanpagu/simpangambar.php?notrans="+notrans, 
		type: "POST",
		data:  new FormData(document.getElementById('formgambar'+nip)),
		contentType: false,
		cache: false,
		processData:false,
		success: function(resultx){ 
			//$.fancybox.close();
			var updatex = new Array();
			updatex = resultx.split('|');
			if(resultx.indexOf('|' != -1)) {
				if(updatex[0]=="OK"){
					swal("OK..!!", "DATA SUDAH DISIMPAN...", "success");
					gridpeserta(notrans);
					closeMessage();
				}else{ 
					swal("Gagal..!!!", resultx, "error");
					closeMessage();
				}
			}
		},
		error: function(){}
	});  
}

function simpannosttp(nip,notrans){ 
	nosttp=document.getElementById('nosttp'+nip).value; 
	
	$.get('trans_/penetapanpagu/simpansttp.php',{notrans:notrans,nip:nip,nosttp:nosttp},
		function(result){  
			var update = new Array();
			update = result.split('|');
			if(result.indexOf('|' != -1)) { 
				if(update[0]=="OK"){ 
					swal("OK..!!", "DATA SUDAH DISIMPAN...", "success");
					gridpeserta(notrans);	
				}else{
					swal("Gagal..!!!", result, "error");
				}
			}
		}
	);  
}

function hapus(notrans){
	if(confirm("apakah yakin data akan dihapus?")){
		$.get("trans_/penetapanpagu/hapus.php",{notrans:notrans},function(result){ 
			if(result=="OK"){
				datapenetapanpagu();
			}
			else{
				swal("GAGAL", result, "error");
			}
		});
	}
}

function kunci(notrans){
	jfloading("sub_konten");
	$.get("trans_/penetapanpagu/kunci.php",{notrans:notrans},function(result){ 
			var update = new Array();
			update = result.split('|');
			if(result.indexOf('|' != -1)) { 
				if(update[0]=="OK"){  
					swal("OK..!!", "DATA SUDAH TERKUNCI...", "success");
					datapenetapanpagu();	
				}else{
					swal("Gagal..!!!", result, "error");
				}
			}
		}
	);
}

function bukakunci(notrans){
	jfloading("sub_konten");
	$.get("trans_/penetapanpagu/bukakunci.php",{notrans:notrans},function(result){ 
			var update = new Array();
			update = result.split('|');
			if(result.indexOf('|' != -1)) { 
				if(update[0]=="OK"){  
					swal("OK..!!", "KUNCI TELAH DIBUKA...", "success");
					datapenetapanpagu();	
				}else{
					swal("Gagal..!!!", result, "error");
				}
			}
		}
	);
}