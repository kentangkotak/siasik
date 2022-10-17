function formpelaksanaanx(notrans){ 
	jfloading("sub_konten");
	$.get("eks/pelaksanaannon/formx.php",{notrans:notrans},
		function(result){
			$("#sub_konten").html(result);
			fungsikomplet();
			gridpeserta(notrans);
			if(notrans!=undefined){
				mati();
			}				
			$('.select2').select2();
		}
	);
}

function datapelaksanaannon(){ 
	jfloading("sub_konten");
	$.get("eks/pelaksanaannon/datapelaksanaannon.php",
		function(result){
			$("#sub_konten").html(result);
			jfdata_table(); 
		}
	);
}


function fungsikomplet(){  
	$("#nip").autocomplete({
		serviceUrl:'eks/pelaksanaannon/autobynippeg.php',
		type: "GET",
		    onSelect: function (suggestion) {
		    	$('#nip').val(suggestion.data);
				$('#namapegawai').val(suggestion.nama);
				$('#koderuangan').val(suggestion.koderuangan);
				$('#ruangan').val(suggestion.ruangan);
				$('#kategoripegawai').val(suggestion.kategoripegawai);
				$('#kategoripeg').val(suggestion.namakategori);
				$('#kodejabatan').val(suggestion.kodejabatan);
				$('#kodependidikan').val(suggestion.kodependidikan);
				$('#kodegolruang').val(suggestion.kodegolruang);
				$('#kodestatpegawai').val(suggestion.kodestatpegawai);
				$('#jabatan').val(suggestion.jabatan);
				$('#pendidikan').val(suggestion.pendidikan);
				$('#golruang').val(suggestion.golruang);
				$('#statpeg').val(suggestion.jenispegawai);
				document.form_rinci.nosttp.focus();
		    }

	});
	$("#namapegawai").autocomplete({
		serviceUrl:'eks/pelaksanaannon/autobynamapeg.php',
		type: "GET",
		    onSelect: function (suggestion) {
		    	$('#namapegawai').val(suggestion.data);
				$('#nip').val(suggestion.nip);
				$('#koderuangan').val(suggestion.koderuangan);
				$('#ruangan').val(suggestion.ruangan);
				$('#kategoripegawai').val(suggestion.kategoripegawai);
				$('#kategoripeg').val(suggestion.namakategori);
				$('#kodejabatan').val(suggestion.kodejabatan);
				$('#kodependidikan').val(suggestion.kodependidikan);
				$('#kodegolruang').val(suggestion.kodegolruang);
				$('#kodestatpegawai').val(suggestion.kodestatpegawai);
				$('#jabatan').val(suggestion.jabatan);
				$('#pendidikan').val(suggestion.pendidikan);
				$('#golruang').val(suggestion.golruang);
				$('#statpeg').val(suggestion.jenispegawai);
				document.form_rinci.nosttp.focus();
		    }

	});
}

function gridpeserta(notrans){  
	jfloading("grid_nilai");
	$.get("eks/pelaksanaannon/gridpeserta.php",{notrans:notrans},
		function(result){ 
			$("#grid_nilai").html(result); 
			jfdata_table(); 
		}
	);
}

function simpan(){ 
    
	notrans=document.form.notrans.value;
	namax=document.form.namax.value;
	jenispelatihan=document.form.jenispelatihan.value;
	tempat=document.form.tempat.value;
	kategori=document.form.kategori.value;
	penyelenggara=document.form.penyelenggara.value;
	tglmulai=document.form.tglmulai.value;
	tglsurat=document.form.tglsurat.value;
	tglselesai=document.form.tglselesai.value;
	nosurat=document.form.nosurat.value;
	jam=document.form.jam.value;
	
	koderuangan=document.form_rinci.koderuangan.value;
	ruangan=document.form_rinci.ruangan.value;
	kategoripegawai=document.form_rinci.kategoripegawai.value;
	kategoripeg=document.form_rinci.kategoripeg.value;
	kodejabatan=document.form_rinci.kodejabatan.value;
	jabatan=document.form_rinci.jabatan.value;
	jabatan=document.form_rinci.jabatan.value;
	kodependidikan=document.form_rinci.kodependidikan.value;
	pendidikan=document.form_rinci.pendidikan.value;
	kodegolruang=document.form_rinci.kodegolruang.value;
	golruang=document.form_rinci.golruang.value;
	kodestatpegawai=document.form_rinci.kodestatpegawai.value;
	statpeg=document.form_rinci.statpeg.value;
	nip=document.form_rinci.nip.value;
	nama=document.form_rinci.namapegawai.value;
	
	if(namax==''){
		swal("Gagal..!!!", "Nama Usulan Secara Surat Harus Diisi..!!!", "error");
	}else if(jenispelatihan==''){
		swal("Gagal..!!!", "Jenis Pelatihan Harus Diisi..!!!", "error");
	}else if(tempat==''){
		swal("Gagal..!!!", "Tempat Pelatihan Harus Diisi..!!!", "error");
	}else if(kategori==''){
		swal("Gagal..!!!", "Kategori Harus Diisi..!!!", "error");
	}else if(penyelenggara==''){
		swal("Gagal..!!!", "Penyelenggara Harus Diisi..!!!", "error");
	}else if(nosurat==''){
		swal("Gagal..!!!", "No. SURAT Harus Diisi..!!!", "error");
	}else if(jam==''){
		swal("Gagal..!!!", "JAM Harus Diisi..!!!", "error");
	}else if(document.form_rinci.nip.value==''){
		swal("Gagal..!!!", "NIP/NIK Harus Diisi..!!!", "error");
	}else if(document.form_rinci.namapegawai.value==''){
		swal("Gagal..!!!", "Nama Pegawai Harus Diisi..!!!", "error");
	}else if(nip==''){
		swal("Gagal..!!!", "No. SURAT Harus Diisi..!!!", "error");
	}else{
		$.get('eks/pelaksanaannon/simpan.php',{notrans:notrans,jenispelatihan:jenispelatihan,tempat:tempat,kategori:kategori,penyelenggara:penyelenggara,tglmulai:tglmulai,tglselesai:tglselesai,tglsurat:tglsurat,jam:jam,nosurat:nosurat,namax:namax,
		koderuangan:koderuangan,ruangan:ruangan,jabatan:jabatan,pendidikan:pendidikan,golruang:golruang,statpeg:statpeg,kategoripeg:kategoripeg,kategoripegawai:kategoripegawai,kodejabatan:kodejabatan,kodependidikan:kodependidikan,
		kodegolruang:kodegolruang,kodestatpegawai:kodestatpegawai,nip:nip},
			function(result){ 
				var update = new Array();
				update = result.split('|');
				if(result.indexOf('|' != -1)) { 
					if(update[0]=="OK"){ 
						swal("OK..!!", "DATA SUDAH DISIMPAN...", "success");
						document.form.notrans.value=update[1];
						mati();
						clearrinci();
						gridpeserta(update[1]);	
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
	$.get("eks/pelaksanaannon/hapus_rinci.php",{notrans:notrans,nip:nip,filenya:filenya},function(result){ 
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
	$.get("eks/pelaksanaannon/batal.php",{notrans:notrans},function(result){ 
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
		url: "eks/pelaksanaannon/simpangambar.php?notrans="+notrans, 
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
	
	$.get('eks/pelaksanaannon/simpansttp.php',{notrans:notrans,nip:nip,nosttp:nosttp},
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