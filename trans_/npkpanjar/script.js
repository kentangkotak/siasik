function formnpkpanjar(nonpk){
	jfloading("sub_konten");
	$.get("trans_/npkpanjar/formnpkpanjar.php",{nonpk:nonpk},
		function(result){
			$("#sub_konten").html(result);
			fungsikomplet();
			gridrinci(nonpk); 
			if(nonpk != undefined){
				document.form.tglnpk.disabled=true;
			}
		}
	);
}

function fungsikomplet(){
	$("#kegiatanblud").autocomplete({
		serviceUrl:'trans_/npkpanjar/autobykegiatanblud.php',
		type: "GET",
			onSelect: function (suggestions) {
				$('#nonpd').val(suggestions.nonpdpanjar);
				$('#kegiatanblud').val(suggestions.kegiatanblud);
				$('#kodekegiatanblud').val(suggestions.kodekegiatanblud);
				$('#tglnpd').val(suggestions.tglnpdpanjar);
				$('#kegiatan').val(suggestions.kegiatan);
				$('#total').val(suggestions.total);
				document.form.nonpd.disabled=true;
			}
	});
	$("#nonpd").autocomplete({
		serviceUrl:'trans_/npkpanjar/autobynonpd.php',
		type: "GET",
			onSelect: function (suggestions) {
				$('#nonpd').val(suggestions.nonpdpanjar);
				$('#tglnpd').val(suggestions.tglnpdpanjar);
				$('#kegiatan').val(suggestions.kegiatan);
				$('#kegiatanblud').val(suggestions.kegiatanblud);
				$('#kodekegiatanblud').val(suggestions.kodekegiatanblud);
				$('#total').val(suggestions.total);
				document.form.kegiatanblud.disabled=true;
			}

	});
}

function simpannpkpanjar(){ 
    
	nonpk=document.form.nonpk.value; 
	tglnpk=document.form.tglnpk.value; 
	akun=document.form.akun.value; 
	
	kodekegiatanblud=document.form_rinci.kodekegiatanblud.value;
	nonpd=document.form_rinci.nonpd.value;
	tglnpd=document.form_rinci.tglnpd.value;
	kegiatan=document.form_rinci.kegiatan.value;
	kegiatanblud=document.form_rinci.kegiatanblud.value;
	total=document.form_rinci.total.value;
		
	if(tglnpk==''){
		swal("Gagal..!!!", "TANGGAL HARUS DIISI....!!!", "error");
	}else if(nonpd==''){
		swal("Gagal..!!!", "NO. NPD TIDAK BOLEH KOSONG....!!!", "error");
	}else if(tglnpd==''){
		swal("Gagal..!!!", "TGL NPD TIDAK BOLEH KOSONG....!!!", "error");
	}else if(kodekegiatanblud==''){
		swal("Gagal..!!!", "KEGIATAN BLUD TIDAK BOLEH KOSONG ATAU KEGIATAN BLUD BELUM TERDAFTAR....!!!", "error");
	}else if(kegiatanblud==''){
		swal("Gagal..!!!", "KEGIATAN BLUD TIDAK BOLEH KOSONG ATAU KEGIATAN BLUD BELUM TERDAFTAR....!!!", "error");
	}else if(kegiatan==''){
		swal("Gagal..!!!", "KEGIATAN TIDAK BOLEH KOSONG....!!!", "error");
	}else if(total==''){
		swal("Gagal..!!!", "TOTAL KEGIATAN TIDAK BOLEH KOSONG...!!", "error");
	}else{
		clearrinci();
		$.get('trans_/npkpanjar/simpan.php',{nonpk:nonpk,
				tglnpk:tglnpk,
				akun:akun,
				kodekegiatanblud:kodekegiatanblud,
				nonpd:nonpd,
				tglnpd:tglnpd,
				kegiatan:kegiatan,
				kegiatanblud:kegiatanblud,
				total:total},
			function(result){ 
				var update = new Array();
				update = result.split('|'); 
				if(result.indexOf('|' != -1)) { 
					if(update[0]=="OK"){ 
						swal("OK..!!", "DATA SUDAH DISIMPAN...", "success");
						document.form.nonpk.value=update[1];
						gridrinci(update[1]);
						document.form.tglnpk.disabled=true;
					}else{
						swal("Gagal..!!!", result, "error");
					}
				}
			}
		);  
	}
}

function clearrinci(){
	document.form_rinci.kodekegiatanblud.value='';
	document.form_rinci.nonpd.value='';
	document.form_rinci.tglnpd.value='';
	document.form_rinci.kegiatan.value='';
	document.form_rinci.kegiatanblud.value='';
	document.form_rinci.total.value='';
}

function gridrinci(nonpk){ 
	jfloading("grid_nilai");
	$.get("trans_/npkpanjar/gridrinci.php",{nonpk:nonpk},
		function(result){ 
			$("#grid_nilai").html(result); 
			jfdata_table(); 
		}
	);
}

function datanpkpanjar(){ 
	jfloading("sub_konten");
	$.get("trans_/npkpanjar/datanpkpanjar.php",
		function(result){ 
			$("#sub_konten").html(result); 
			jfdata_table(); 
		}
	);
}

function kunci(nonpk){
	jfloading("sub_konten");
	$.get("trans_/npkpanjar/kunci.php",{nonpk:nonpk},function(result){ 
			var update = new Array();
			update = result.split('|');
			if(result.indexOf('|' != -1)) { 
				if(update[0]=="OK"){  
					swal("OK..!!", "DATA SUDAH TERKUNCI...", "success");
					datanpkpanjar();	
				}else{
					swal("Gagal..!!!", result, "error");
				}
			}
		}
	);
}

function bukakunci(nonpk){
	jfloading("sub_konten");
	$.get("trans_/npkpanjar/bukakunci.php",{nonpk:nonpk},function(result){ 
			var update = new Array();
			update = result.split('|');
			if(result.indexOf('|' != -1)) { 
				if(update[0]=="OK"){  
					swal("OK..!!", "DATA SUDAH TERKUNCI...", "success");
					datanpkpanjar();	
				}else{
					swal("Gagal..!!!", result, "error");
				}
			}
		}
	);
}

function hapus_rinci(id,nonpk,nonpd,kegiatan,kodekegiatanblud){  
	swal({
	  title: "PERINGATAN",
	  text: "Apakah Anda Yakin Akan Menghapus Data ini?",
	  type: "warning",
	  showCancelButton: true,
	  confirmButtonClass: "btn-danger",
	  confirmButtonText: "Ya, hapus ini!",
	  cancelButtonText: "Tidak!",
	  closeOnConfirm: false
	}, function (dismiss) { 
			if(dismiss==true){
				$.get("trans_/npkpanjar/hapus_rinci.php",{id:id,nonpk:nonpk,nonpd:nonpd,kegiatan:kegiatan,kodekegiatanblud:kodekegiatanblud},
					function(result){ 
						var update = new Array();
						update = result.split('|');
						if(result.indexOf('|' != -1)) { 
							if(update[0]=="OK"){  
								swal("OK..!!", "DATA SUDAH TERHAPUS...", "success");
								gridrinci(nonpk);
							}else{
								//alert(result);
								swal("Gagal..!!!", result, "error");
							}
						}
					}
				);
			}
	});
	
}

function hapusHeader(nonpk,nonpd){  
	swal({
	  title: "PERINGATAN",
	  text: "Apakah Anda Yakin Akan Menghapus Data ini?",
	  type: "warning",
	  showCancelButton: true,
	  confirmButtonClass: "btn-danger",
	  confirmButtonText: "Ya, hapus ini!",
	  cancelButtonText: "Tidak!",
	  closeOnConfirm: false
	}, function (dismiss) { 
			if(dismiss==true){
				$.get("trans_/npkpanjar/hapus_heder.php",{nonpk:nonpk,nonpd:nonpd},
					function(result){ 
						var update = new Array();
						update = result.split('|');
						if(result.indexOf('|' != -1)) { 
							if(update[0]=="OK"){  
								swal("OK..!!", "DATA SUDAH TERHAPUS...", "success");
								datanpkpanjar();
							}else{
								swal("Gagal..!!!", result, "error");
							}
						}
					}
				);
			}
	});
	
}

function carinonpdpanjar(){
	$.fancybox({
		'href'			:'trans_/npkpanjar/carinonpdpanjar.php',
		'overlayOpacity':0,
		'opacity'		: true,
		'transitionIn'	: 'elastic',
		'type'			: 'ajax'
	});
}

function pilih(nonpdpanjar,kodekegiatanblud,tglnpdpanjar,kegiatan,kegiatanblud,total){ 
	document.form_rinci.kodekegiatanblud.value=kodekegiatanblud;
	document.form_rinci.nonpd.value=nonpdpanjar;
	document.form_rinci.tglnpd.value=tglnpdpanjar;
	document.form_rinci.kegiatan.value=kegiatan;
	document.form_rinci.kegiatanblud.value=kegiatanblud;
	document.form_rinci.total.value=total;
	$.fancybox.close();
}

function cetaknpkpanjar(){ 
	nonpk=document.form.nonpk.value;
	if(nonpk==""){
		swal("Gagal..!!!", "APA YANG AKAN ANDA CETAK...???", "error");
	}else{
		window.open('trans_/npkpanjar/cetaknpkpanjar.php?nonpk='+nonpk,'','height=700,width=800,scrollbars=yes,resizable=yes');
	}
}