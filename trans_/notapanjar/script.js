function formnotapanjar(nonotapanjar){ 
	jfloading("sub_konten");
	$.get("trans_/notapanjar/formnotapanjar.php",{nonotapanjar:nonotapanjar},
		function(result){
			$("#sub_konten").html(result);
			fungsikomplet();
			gridrinci(nonotapanjar);
			if(nonotapanjar != undefined){
				mati();
			}
			$("#rincianbelanja").autocomplete({
				serviceUrl:'trans_/notapanjar/autobyrincianbelanja.php?nonpd='+$("#nonpd").val(),
				type: "GET",
					onSelect: function (suggestions) {
						$('#rincianbelanja').val(suggestions.rincianbelanja50);
						$('#koderek50').val(suggestions.koderek50);
						$('#total').val(suggestions.total);
					}
					
			});
		}
	);
}

function fungsikomplet(){
	$("#pptk").autocomplete({
		serviceUrl:'trans_/notapanjar/autobypptk.php',
		type: "GET",
		    onSelect: function (suggestion) {
		    	$('#kodepptk').val(suggestion.nip);
				$('#pptk').val(suggestion.nama);
				$('#bidang').val(suggestion.bidang);
				$('#kodebidang').val(suggestion.kodebidang);
				
				$("#kegiatanblud").autocomplete({
					serviceUrl:'trans_/notapanjar/autobykegiatan.php?nip='+suggestion.nip,
					type: "GET",
						onSelect: function (suggestions) {
							$('#kegiatanblud').val(suggestions.kegiatan);
							$('#kodekegiatanblud').val(suggestions.kodekegiatan);
							
						}

				});
							
		    }

	});
	$("#nonpd").autocomplete({
		serviceUrl:'trans_/notapanjar/autobysumbernpd.php',
		type: "GET",
			onSelect: function (suggestions) {
				$('#nonpd').val(suggestions.nonpdpanjar);
				$('#triwulan').val(suggestions.triwulan);
				$('#kodepptk').val(suggestions.kodepptk);
				$('#pptk').val(suggestions.pptk);
				$('#kodekegiatanblud').val(suggestions.kodekegiatanblud);
				$('#kegiatanblud').val(suggestions.kegiatanblud);
				$('#kodebidang').val(suggestions.kodebidang);
				$('#bidang').val(suggestions.bidang);
				$('#rincianbelanja').val(suggestions.rincianbelanja50);
				$('#koderek50').val(suggestions.koderek50);
				$('#nopp').val(suggestions.nopp);
				$('#nousulan').val(suggestions.nousulan);
				$('#total').val(suggestions.total);
				
				$("#rincianbelanja").autocomplete({
					serviceUrl:'trans_/notapanjar/autobyrincianbelanja.php?nonpd='+suggestions.nonpdpanjar,
					type: "GET",
						onSelect: function (suggestions) {
							$('#rincianbelanja').val(suggestions.rincianbelanja50);
							$('#koderek50').val(suggestions.koderek50);
							$('#total').val(suggestions.total);
						}
						
				});
			}
			
	});
		   
}

function simpannotapanjar(){ 
    
	nonotapanjar=document.form.nonotapanjar.value; 
	tglnotapanjar=document.form.tglnotapanjar.value; 
	triwulan=document.form.triwulan.value; 
	nonpd=document.form.nonpd.value;
	kodepptk=document.form.kodepptk.value; 
	pptk=document.form.pptk.value; 
	program=document.form.program.value;
	kegiatan=document.form.kegiatan.value;
	kodekegiatanblud=document.form.kodekegiatanblud.value;
	kegiatanblud=document.form.kegiatanblud.value;
	kodebidang=document.form.kodebidang.value;
	bidang=document.form.bidang.value;
	
	koderek50=document.form_rinci.koderek50.value;
	rincianbelanja=document.form_rinci.rincianbelanja.value;
	total=document.form_rinci.total.value;
	
	if(tglnotapanjar==''){
		swal("Gagal..!!!", "TANGGAL TIDAK BOLEH KOSONG....!!!", "error");
	}else if(triwulan==''){
		swal("Gagal..!!!", "TRIWULAN TIDAK BOLEH KOSONG....!!!", "error");
	}else if(nonpd==''){
		swal("Gagal..!!!", "NO NPD TIDAK BOLEH KOSONG....!!!", "error");
	}else if(kodepptk==''){
		swal("Gagal..!!!", "PPTK TIDAK BOLEH KOSONG ATAU PPTK BELUM TERDAFTAR....!!!", "error");
	}else if(pptk==''){
		swal("Gagal..!!!", "PPTK TIDAK BOLEH KOSONG ATAU PPTK BELUM TERDAFTAR....!!!", "error");
	}else if(kodekegiatanblud==''){
		swal("Gagal..!!!", "KEGIATAN BLUD TIDAK BOLEH KOSONG ATAU KEGIATAN BLUD BELUM TERDAFTAR....!!!", "error");
	}else if(kegiatanblud==''){
		swal("Gagal..!!!", "KEGIATAN BLUD TIDAK BOLEH KOSONG ATAU KEGIATAN BLUD BELUM TERDAFTAR....!!!", "error");
	}else if(koderek50==''){
		swal("Gagal..!!!", "RINCIAN BELANJA TIDAK BOLEH KOSONG ATAU RINCIAN BELANJA BELUM TERDAFTAR....!!!", "error");
	}else if(rincianbelanja==''){
		swal("Gagal..!!!", "RINCIAN BELANJA TIDAK BOLEH KOSONG ATAU RINCIAN BELANJA BELUM TERDAFTAR....!!!", "error");
	}else{
		clearrinci();
		$.get('trans_/notapanjar/simpan.php',{nonotapanjar:nonotapanjar, 
				tglnotapanjar:tglnotapanjar, 
				triwulan:triwulan,
				nonpd:nonpd,
				kodepptk:kodepptk, 
				pptk:pptk, 
				program:program,
				kegiatan:kegiatan,
				kodekegiatanblud:kodekegiatanblud,
				kegiatanblud:kegiatanblud,
				koderek50:koderek50,
				rincianbelanja:rincianbelanja,
				total:total,kodebidang:kodebidang,bidang:bidang},
			function(result){ 
				var update = new Array();
				update = result.split('|'); 
				if(result.indexOf('|' != -1)) { 
					if(update[0]=="OK"){ 
						swal("OK..!!", "DATA SUDAH DISIMPAN...", "success");
						document.form.nonotapanjar.value=update[1];
						gridrinci(update[1]);
						mati();
						clearrincix();
					}else{
						swal("Gagal..!!!", result, "error");
					}
				}
			}
		);  
	}
}

function gridrinci(nonotapanjar){ 
	jfloading("grid_nilai");
	$.get("trans_/notapanjar/gridrinci.php",{nonotapanjar:nonotapanjar},
		function(result){ 
			$("#grid_nilai").html(result); 
			jfdata_table(); 
		}
	);
}

function mati(){
	
	document.form.tglnotapanjar.disabled=true;
	document.form.nonpd.disabled=true;
	document.getElementById('carinonpd').style.visibility='hidden';
}

function clearrinci(){
	document.form_rinci.rincianbelanja.value='';
	document.form_rinci.total.value='';
}

function datanotapanjar(){ 
	jfloading("sub_konten");
	$.get("trans_/notapanjar/datanotapanjar.php",
		function(result){ 
			$("#sub_konten").html(result); 
			jfdata_table(); 
		}
	);
}


function hapus_rinci(id,nonotapanjar){  
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
				$.get("trans_/notapanjar/hapus_rinci.php",{id:id,nonotapanjar:nonotapanjar},
					function(result){ 
						var update = new Array();
						update = result.split('|');
						if(result.indexOf('|' != -1)) { 
							if(update[0]=="OK"){  
								swal("OK..!!", "DATA SUDAH TERHAPUS...", "success");
								gridrinci(nonotapanjar);
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

function hapusHeader(nonotapanjar){  
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
				$.get("trans_/notapanjar/hapus_heder.php",{nonotapanjar:nonotapanjar},
					function(result){ 
						var update = new Array();
						update = result.split('|');
						if(result.indexOf('|' != -1)) { 
							if(update[0]=="OK"){  
								swal("OK..!!", "DATA SUDAH TERHAPUS...", "success");
								datanotapanjar();
							}else{
								swal("Gagal..!!!", result, "error");
							}
						}
					}
				);
			}
	});
	
}

function kunci(nonotapanjar){
	jfloading("sub_konten");
	$.get("trans_/notapanjar/kunci.php",{nonotapanjar:nonotapanjar},function(result){ 
			var update = new Array();
			update = result.split('|');
			if(result.indexOf('|' != -1)) { 
				if(update[0]=="OK"){  
					swal("OK..!!", "DATA SUDAH TERKUNCI...", "success");
					datanotapanjar();	
				}else{
					swal("Gagal..!!!", result, "error");
				}
			}
		}
	);
}

function bukakunci(nonotapanjar){
	jfloading("sub_konten");
	$.get("trans_/notapanjar/bukakunci.php",{nonotapanjar:nonotapanjar},function(result){ 
			var update = new Array();
			update = result.split('|');
			if(result.indexOf('|' != -1)) { 
				if(update[0]=="OK"){  
					swal("OK..!!", "DATA SUDAH TERKUNCI...", "success");
					datanotapanjar();	
				}else{
					swal("Gagal..!!!", result, "error");
				}
			}
		}
	);
}

function carinonpd(){
	$.fancybox({
		'href'			:'trans_/notapanjar/carinonpd.php',
		'overlayOpacity':0,
		'opacity'		: true,
		'transitionIn'	: 'elastic',
		'type'			: 'ajax'
	});
}

function pilihnonpdpanjar(nonpdpanjar,kodepptk,pptk,kodekegiatanblud,kegiatanblud,total,kodebidang,bidang,koderek50,rincianbelanja50,nopp,nousulan,triwulan){ 
	document.form.nonpd.value=nonpdpanjar;
	document.form.kodepptk.value=kodepptk;
	document.form.pptk.value=pptk;
	document.form.kodekegiatanblud.value=kodekegiatanblud; 
	document.form.kegiatanblud.value=kegiatanblud;
	document.form.kodebidang.value=kodebidang;
	document.form.bidang.value=bidang;
	document.form.triwulan.value=triwulan;
	document.form_rinci.koderek50.value=koderek50;
	document.form_rinci.rincianbelanja.value=rincianbelanja50; 
	document.form_rinci.nopp.value=nopp;
	document.form_rinci.nousulan.value=nousulan;
	document.form_rinci.total.value=total; 
	$.fancybox.close();
	
}
