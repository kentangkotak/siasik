function formpenetapanpagu(notrans,x){ 
	jfloading("sub_konten");
	$.get("trans_/perubahan/perubahanpagu_pak/form.php",{notrans:notrans,x:x},
		function(result){ 
			$("#sub_konten").html(result);
			$( '#nilairupiah' ).mask('000,000,000,000.00', {reverse: true});
			fungsikomplet();
		}
	);
}

function datapenetapanpagu(){ 
	jfloading("sub_konten");
	$.get("trans_/perubahan/perubahanpagu_pak/datapenetapanpagu.php",
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
		$.get('trans_/perubahan/perubahanpagu_pak/simpan.php',{notrans:notrans,kodekegiatanblud:kodekegiatanblud,kegiatanblud:kegiatanblud,nilairupiah:nilairupiah,
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
	$.get("trans_/perubahan/perubahanpagu_pak/kunci.php",{notrans:notrans},function(result){ 
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
	$.get("trans_/perubahan/perubahanpagu_pak/bukakunci.php",{notrans:notrans},function(result){ 
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