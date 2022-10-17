function formnpkls(nonpk){
	jfloading("sub_konten");
	$.get("trans_/npkls/formnpkls.php",{nonpk:nonpk},
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
		serviceUrl:'trans_/npkls/autobykegiatanblud.php',
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
	$("#nonpdls").autocomplete({
		serviceUrl:'trans_/npkls/autobynonpdls.php',
		type: "GET",
			onSelect: function (suggestions) {
				$('#nonpdls').val(suggestions.nonpdls);
				$('#tglnpd').val(suggestions.tglnpdls);
				$('#kegiatan').val(suggestions.kegiatan);
				$('#kegiatanblud').val(suggestions.kegiatanblud);
				$('#kodekegiatanblud').val(suggestions.kodekegiatanblud);
				$('#total').val(suggestions.total);
				document.form.kegiatanblud.disabled=true;
			}

	});
}

function simpannpkls(){ 
    
	nonpk=document.form.nonpk.value; 
	tglnpk=document.form.tglnpk.value; 
	akun=document.form.akun.value; 
	
	kodekegiatanblud=document.form_rinci.kodekegiatanblud.value;
	nonpdls=document.form_rinci.nonpdls.value;
	tglnpd=document.form_rinci.tglnpd.value;
	kegiatan=document.form_rinci.kegiatan.value;
	kegiatanblud=document.form_rinci.kegiatanblud.value;
	total=document.form_rinci.total.value;
		
	if(tglnpk==''){
		swal("Gagal..!!!", "TANGGAL HARUS DIISI....!!!", "error");
	// }else if(nonpk==''){
		// swal("Gagal..!!!", "NO. NPK TIDAK BOLEH KOSONG....!!!", "error");
	}else if(nonpdls==''){
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
		$.get('trans_/npkls/simpan.php',{nonpk:nonpk,
				tglnpk:tglnpk,
				akun:akun,
				kodekegiatanblud:kodekegiatanblud,
				nonpdls:nonpdls,
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
	document.form_rinci.nonpdls.value='';
	document.form_rinci.tglnpd.value='';
	document.form_rinci.kegiatan.value='';
	document.form_rinci.kegiatanblud.value='';
	document.form_rinci.total.value='';
}

async function gridrinci(nonpk){ 
	jfloading("grid_nilai");
	await $.get("trans_/npkls/gridrinci.php",{nonpk:nonpk},
		function(result){ 
			$("#grid_nilai").html(result); 
			jfdata_table(); 
		}
	);
	await $.getJSON("trans_/npkls/getnpktotal.php",{nonpk:nonpk},function(result){ 
		warna = "";
		//if(result.sisaPagu<1){
			warna = `style='font-color:red;'`;
		//}
		$("#contentPagu").html(`
			<b ${warna}>
				<br>Total : ${result.totalrinci}
			</b>
		`);
	});	 
}

function datanpkls(){ 
	jfloading("sub_konten");
	$.get("trans_/npkls/datanpkls.php",
		function(result){ 
			$("#sub_konten").html(result); 
			jfdata_table(); 
		}
	);
}

function kunci(nonpk){
	jfloading("sub_konten");
	$.get("trans_/npkls/kunci.php",{nonpk:nonpk},function(result){ 
			var update = new Array();
			update = result.split('|');
			if(result.indexOf('|' != -1)) { 
				if(update[0]=="OK"){  
					swal("OK..!!", "DATA SUDAH TERKUNCI...", "success");
					datanpkls();	
				}else{
					swal("Gagal..!!!", result, "error");
				}
			}
		}
	);
}

function bukakunci(nonpk){
	jfloading("sub_konten");
	$.get("trans_/npkls/bukakunci.php",{nonpk:nonpk},function(result){ 
			var update = new Array();
			update = result.split('|');
			if(result.indexOf('|' != -1)) { 
				if(update[0]=="OK"){  
					swal("OK..!!", "DATA SUDAH TERKUNCI...", "success");
					datanpkls();	
				}else{
					swal("Gagal..!!!", result, "error");
					datanpkls();
				}
			}
		}
	);
}

function hapus_rinci(id,nonpk,nonpdls,kegiatan,kodekegiatanblud,total){  
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
				$.get("trans_/npkls/hapus_rinci.php",{id:id,nonpk:nonpk,nonpdls:nonpdls,kegiatan:kegiatan,kodekegiatanblud:kodekegiatanblud,total:total},
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

function hapusHeader(nonpk){  
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
				$.get("trans_/npkls/hapus_heder.php",{nonpk:nonpk},
					function(result){ 
						var update = new Array();
						update = result.split('|');
						if(result.indexOf('|' != -1)) { 
							if(update[0]=="OK"){  
								swal("OK..!!", "DATA SUDAH TERHAPUS...", "success");
								datanpkls();
							}else{
								swal("Gagal..!!!", result, "error");
							}
						}
					}
				);
			}
	});
	
}

function carinpdls(){
	$.fancybox({
		'href'			:'trans_/npkls/carinpdls.php',
		'overlayOpacity':0,
		'opacity'		: true,
		'transitionIn'	: 'elastic',
		'type'			: 'ajax'
	});
}

function pilihnpdls(nonpdls,tglnpdls,kegiatan,kodekegiatanblud,kegiatanblud,total){
	document.form_rinci.kodekegiatanblud.value=kodekegiatanblud;
	document.form_rinci.nonpdls.value=nonpdls;
	document.form_rinci.tglnpd.value=tglnpdls;
	document.form_rinci.kegiatan.value=kegiatan;
	document.form_rinci.kegiatanblud.value=kegiatanblud;
	document.form_rinci.total.value=total;
	$.fancybox.close();
}

function cetaknpkls(){ 
	nonpk=document.form.nonpk.value;
	if(nonpk==""){
		swal("Gagal..!!!", "APA YANG AKAN ANDA CETAK...???", "error");
	}else{
		window.open('trans_/npkls/cetaknpkls.php?nonpk='+nonpk,'','height=700,width=800,scrollbars=yes,resizable=yes');
	}
}