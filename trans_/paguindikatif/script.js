function datapendapatan(){ 
	jfloading("sub_konten");
	$.get("trans_/paguindikatif/datapendapatan.php",
		function(result){
			$("#sub_konten").html(result);
			jfdata_table(); 
		}
	);
}

function formperubahan(notrans){ 
	jfloading("sub_konten");
	$.get("trans_/paguindikatif/formperubahan.php",{notrans:notrans},
		function(result){
			$("#sub_konten").html(result);
			$( '#nilaiperubahan' ).mask('000,000,000,000.00', {reverse: true});
		}
	);
}

function simpanperubahan(){ 
    
	notransawal=document.form.notransawal.value;
	noperubahan=document.form.noperubahan.value;
	koderekeningblud=document.form.koderekeningblud.value;
	map79=document.form.map79.value;
	kode79=document.form.kode79.value;
	bidang=document.form.bidang.value;
	uraian=document.form.uraian.value;
	nilairupiah=document.form.nilairupiah.value;
	nilaiperubahan=document.form.nilaiperubahan.value;
		
	if(notransawal == ''){
		swal("Gagal..!!!", "TIDAK ADA TRANSAKSI INI SEBELUMNYA...!!!", "error");
	}else if(bidang==''){
		swal("Gagal..!!!", "BIDANG HARUS DIPILIH..!!!", "error");
	}else if(koderekeningblud==''){
		swal("Gagal..!!!", "KODE REKENING Harus Diisi..!!!", "error");
	}else if(uraian==''){
		swal("Gagal..!!!", "URAIAN Harus Diisi..!!!", "error");
	}else if(nilairupiah==''){
		swal("Gagal..!!!", "NILAI RUPIAHJ Harus Diisi..!!!", "error");
	}else{
		$.get('trans_/paguindikatif/simpan.php',{notransawal:notransawal,noperubahan:noperubahan,bidang:bidang,koderekeningblud:koderekeningblud,uraian:uraian,nilairupiah:nilairupiah,map79:map79,kode79:kode79,nilaiperubahan:nilaiperubahan},
			function(result){ 
				var update = new Array();
				update = result.split('|');
				if(result.indexOf('|' != -1)) { 
					if(update[0]=="OK"){ 
						swal("OK..!!", "DATA SUDAH DISIMPAN...", "success");
						document.form.noperubahan.value=update[1];
						dataperubahan();
						//clearrinci();
						//gridpeserta(update[1]);	
					}else{
						swal("Gagal..!!!", result, "error");
					}
				}
			}
		);  
	}
}

function dataperubahan(){ 
	jfloading("sub_konten");
	$.get("trans_/paguindikatif/dataperubahan.php",
		function(result){
			$("#sub_konten").html(result);
			jfdata_table(); 
		}
	);
}

function cariselisih(){ 
	
	nilaiperubahan=document.form.nilaiperubahan.value; 
	nilairupiah=document.form.nilairupiah.value;
	$.get("trans_/paguindikatif/selisih.php",{nilaiperubahan:nilaiperubahan,nilairupiah:nilairupiah},function(result){  
		var update = new Array(); 
		update = result.split('|'); 
		if(result.indexOf('|' != -1)) { 
			document.form.selisih.value=update[1];
		}
	});
}

function hapus_perubahan(notrans){  
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
				$.get("trans_/paguindikatif/hapus_perubahan.php",{notrans:notrans},
					function(result){ 
						var update = new Array();
						update = result.split('|');
						if(result.indexOf('|' != -1)) { 
							if(update[0]=="OK"){  
								swal("OK..!!", "DATA SUDAH TERHAPUS...", "success");
								dataperubahan();
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

function kunci(notrans){
	jfloading("sub_konten");
	$.get("trans_/paguindikatif/kunci.php",{notrans:notrans},function(result){ 
			var update = new Array();
			update = result.split('|');
			if(result.indexOf('|' != -1)) { 
				if(update[0]=="OK"){  
					swal("OK..!!", "DATA SUDAH TERKUNCI...", "success");
					datapendapatan();	
				}else{
					swal("Gagal..!!!", result, "error");
					datapendapatan();	
				}
			}
		}
	);
}

function bukakunci(notrans){
	jfloading("sub_konten");
	$.get("trans_/paguindikatif/bukakunci.php",{notrans:notrans},function(result){ 
			var update = new Array();
			update = result.split('|');
			if(result.indexOf('|' != -1)) { 
				if(update[0]=="OK"){  
					swal("OK..!!", "DATA SUDAH TERKUNCI...", "success");
					datapendapatan();	
				}else{
					swal("Gagal..!!!", result, "error");
					datapendapatan();	
				}
			}
		}
	);
}