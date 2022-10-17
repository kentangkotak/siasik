function formguu(nosppgu){
	jfloading("sub_konten");
	$.get("trans_/guu/formguu.php",{nosppgu:nosppgu},
		function(result){
			$("#sub_konten").html(result);
			fungsikomplet();
			gridrinci(nosppgu);
			if(nosppgu != undefined){
				mati();
			}
			$( '#jumlahpengeluaran' ).mask('000,000,000,000.00', {reverse: true});
			$( '#nilai' ).mask('000,000,000,000.00', {reverse: true});
		}
	);
}

function fungsikomplet(){
	$("#bendaharapengeluaran").autocomplete({
		serviceUrl:'trans_/guu/autobybendahara.php',
		type: "GET",
			onSelect: function (suggestions) {
				$('#bendaharapengeluaran').val(suggestions.nama);
				$('#kodebendaharapengeluaran').val(suggestions.kode);
				document.form.jumlahpengeluaran.focus();
			}
	});
	$("#namabank").autocomplete({
		serviceUrl:'trans_/guu/autobybank.php',
		type: "GET",
			onSelect: function (suggestions) {
				$('#namabank').val(suggestions.bank);
				$('#kodebank').val(suggestions.kode);
				$('#norekening').val(suggestions.koderek);
				document.form_rinci.nospj.focus();
			}
	});
	$("#nospj").autocomplete({
		serviceUrl:'trans_/guu/autobyspj.php',
		type: "GET",
			onSelect: function (suggestions) {
				$('#nospj').val(suggestions.nospjpanjar);
				$('#tglspj').val(suggestions.tglspjpanjar);
				$('#kegiatan').val(suggestions.kegiatan);
				$('#kodekegiatanblud').val(suggestions.kodekegiatanblud);
				$('#kegiatanblud').val(suggestions.kegiatanblud);
				$('#nilai').val(suggestions.jumlah);
				document.form_rinci.nospj.focus();
			}
	});
}

function simpanguu(){  
    
	nosppgu=document.form.nosppgu.value; 
	tglsppgu=document.form.tglsppgu.value; 
	triwulan=document.form.triwulan.value;
	kodebendaharapengeluaran=document.form.kodebendaharapengeluaran.value;
	bendaharapengeluaran=document.form.bendaharapengeluaran.value;
	jumlahpengeluaran=document.form.jumlahpengeluaran.value;
	kodebank=document.form.kodebank.value;
	namabank=document.form.namabank.value;
	norekening=document.form.norekening.value; 
	
	nospj=document.form_rinci.nospj.value;
	tglspj=document.form_rinci.tglspj.value;
	kegiatan=document.form_rinci.kegiatan.value;
	kodekegiatanblud=document.form_rinci.kodekegiatanblud.value;
	kegiatanblud=document.form_rinci.kegiatanblud.value;
	nilai=document.form_rinci.nilai.value; 
		
	if(triwulan==''){
		swal("Gagal..!!!", "TRIWULAN HARUS DIISI....!!!", "error");
	}else if(kodebendaharapengeluaran==''){
		swal("Gagal..!!!", "BENDAHARA TIDAK BOLEH KOSONG....!!!", "error");
	}else if(bendaharapengeluaran==''){
		swal("Gagal..!!!", "BENDAHARA TIDAK BOLEH KOSONG....!!!", "error");
	}else if(jumlahpengeluaran==''){
		swal("Gagal..!!!", "JUMLAH PENGELUARAN TIDAK BOLEH KOSONG ATAU KEGIATAN BLUD BELUM TERDAFTAR....!!!", "error");
	}else if(namabank==''){
		swal("Gagal..!!!", "NAMA BANK TIDAK BOLEH KOSONG ATAU KEGIATAN BLUD BELUM TERDAFTAR....!!!", "error");
	}else if(nospj==''){
		swal("Gagal..!!!", "NO. SPJ TIDAK BOLEH KOSONG....!!!", "error");
	}else if(nilai==''){
		swal("Gagal..!!!", "NILAI TIDAK BOLEH KOSONG...!!", "error");
	}else{
		clearrinci();
		$.get('trans_/guu/simpan.php',{nosppgu:nosppgu,
				tglsppgu:tglsppgu,
				triwulan:triwulan,
				kodebendaharapengeluaran:kodebendaharapengeluaran,
				bendaharapengeluaran:bendaharapengeluaran,
				jumlahpengeluaran:jumlahpengeluaran,kodebank:kodebank,
				namabank:namabank,norekening:norekening,nospj:nospj,tglspj:tglspj,kegiatan:kegiatan,kodekegiatanblud:kodekegiatanblud,kegiatanblud:kegiatanblud,
				nilai:nilai},
			function(result){ 
				var update = new Array();
				update = result.split('|'); 
				if(result.indexOf('|' != -1)) { 
					if(update[0]=="OK"){ 
						swal("OK..!!", "DATA SUDAH DISIMPAN...", "success");
						document.form.nosppgu.value=update[1];
						gridrinci(update[1]);
						mati();
					}else{
						swal("Gagal..!!!", result, "error");
					}
				}
			}
		);  
	}
}

function mati(){

	tglsppgu=document.form.tglsppgu.disabled=true; 
	triwulan=document.form.triwulan.disabled=true;
	bendaharapengeluaran=document.form.bendaharapengeluaran.disabled=true;
	jumlahpengeluaran=document.form.jumlahpengeluaran.disabled=true;
	namabank=document.form.namabank.disabled=true;
}

function clearrinci(){
	document.form_rinci.nospj.value='';
	document.form_rinci.tglspj.value='';
	document.form_rinci.kegiatan.value='';
	document.form_rinci.kodekegiatanblud.value='';
	document.form_rinci.kegiatanblud.value='';
	document.form_rinci.nilai.value='';
}

function gridrinci(nosppgu){ 
	jfloading("grid_nilai");
	$.get("trans_/guu/gridrinci.php",{nosppgu:nosppgu},
		function(result){ 
			$("#grid_nilai").html(result); 
			jfdata_table(); 
		}
	);
}

function dataguu(){ 
	jfloading("sub_konten");
	$.get("trans_/guu/dataguu.php",
		function(result){ 
			$("#sub_konten").html(result); 
			jfdata_table(); 
		}
	);
}

function kunci(nosppgu){
	jfloading("sub_konten");
	$.get("trans_/guu/kunci.php",{nosppgu:nosppgu},function(result){ 
			var update = new Array();
			update = result.split('|');
			if(result.indexOf('|' != -1)) { 
				if(update[0]=="OK"){  
					swal("OK..!!", "DATA SUDAH TERKUNCI...", "success");
					dataguu();	
				}else{
					swal("Gagal..!!!", result, "error");
				}
			}
		}
	);
}

function bukakunci(nosppgu){
	jfloading("sub_konten");
	$.get("trans_/guu/bukakunci.php",{nosppgu:nosppgu},function(result){ 
			var update = new Array();
			update = result.split('|');
			if(result.indexOf('|' != -1)) { 
				if(update[0]=="OK"){  
					swal("OK..!!", "KUNCI SUDAH TERBUKA...", "success");
					dataguu();	
				}else{
					swal("Gagal..!!!", result, "error");
				}
			}
		}
	);
}

function hapus_rinci(id,nosppgu,nospj){  
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
				$.get("trans_/guu/hapus_rinci.php",{nosppgu:nosppgu,id:id,nospj:nospj},
					function(result){ 
						var update = new Array();
						update = result.split('|');
						if(result.indexOf('|' != -1)) { 
							if(update[0]=="OK"){  
								swal("OK..!!", "DATA SUDAH TERHAPUS...", "success");
								gridrinci(nosppgu);
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

function hapusHeader(nosppgu){  
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
				$.get("trans_/guu/hapus_heder.php",{nosppgu:nosppgu},
					function(result){ 
						var update = new Array();
						update = result.split('|');
						if(result.indexOf('|' != -1)) { 
							if(update[0]=="OK"){  
								swal("OK..!!", "DATA SUDAH TERHAPUS...", "success");
								dataguu();
							}else{
								swal("Gagal..!!!", result, "error");
							}
						}
					}
				);
			}
	});
	
}