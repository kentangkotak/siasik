async function datapendapatan(){ 
	jfloading("sub_konten");
	await $.get("trans_/pergeseran/paguindikatif/datapendapatan.php",
		function(result){
			$("#sub_konten").html(result);
			jfdata_table(); 
		}
	);
	//kodekegiatan=document.form.kodekegiatan.value;
	await $.getJSON("trans_/pergeseran/paguindikatif/getPaguByKegiatan.php",function(result){ 
		warna = "";
		//if(result.sisaPagu<1){
			warna = `style='font-color:red;'`;
		//}
		$("#contentPagu").html(`
			<b ${warna}>
				<br>TOTAL PENDAPATAN : ${result.pendapatanAwalrp}
				<br>TOTAL PENDAPATAN SETELAH PERGESERAN : ${result.pendapatanPerubahanrp}
				<br>TOTAL PENDAPATAN YANG BISA DIGESER : ${result.sisarp} 
			</b>
		`);
	});
}

function formperubahan(notrans){ 
	jfloading("sub_konten");
	$.get("trans_/pergeseran/paguindikatif/formperubahan.php",{notrans:notrans},
		function(result){
			$("#sub_konten").html(result);
			$( '#nilaibaru' ).mask('000,000,000,000.00', {reverse: true});
			$( '#selisih' ).mask('000,000,000,000.00', {reverse: true});
			document.form.nilaibaru.focus();
		}
	);
}

function simpanperubahan(){ 
    
	notransawal=document.form.notrans.value;
	koderekeningblud=document.form.koderekeningblud.value;
	map79=document.form.map79.value;
	kode79=document.form.kode79.value;
	bidang=document.form.bidang.value;
	uraian=document.form.uraian.value;
	nilairupiah=document.form.nilairupiah.value;
	nilaiperubahan=document.form.nilaibaru.value;
	selisih=document.form.nilaibaru.value;
	//operator=document.form.operator.value;
		
	if(notransawal == ''){
		swal("Gagal..!!!", "TIDAK ADA TRANSAKSI INI SEBELUMNYA...!!!", "error");
	}else if(bidang==''){
		swal("Gagal..!!!", "BIDANG HARUS DIPILIH..!!!", "error");
	}else if(koderekeningblud==''){
		swal("Gagal..!!!", "KODE REKENING Harus Diisi..!!!", "error");
	}else if(uraian==''){
		swal("Gagal..!!!", "URAIAN Harus Diisi..!!!", "error");
	}else if(nilairupiah==''){
		swal("Gagal..!!!", "NILAI RUPIAH Harus Diisi..!!!", "error");
	// }else if(operator==''){
		// swal("Gagal..!!!", "OPERATOR Harus Diisi..!!!", "error");
	}else if(nilaiperubahan==''){
		swal("Gagal..!!!", "NILAI BARU Harus Diisi..!!!", "error");
	}else{
		$.get('trans_/pergeseran/paguindikatif/simpan.php',{notransawal:notransawal,bidang:bidang,koderekeningblud:koderekeningblud,uraian:uraian,nilairupiah:nilairupiah,map79:map79,kode79:kode79,nilaiperubahan:nilaiperubahan,nilaiperubahan:nilaiperubahan},
			function(result){ 
				var update = new Array();
				update = result.split('|');
				if(result.indexOf('|' != -1)) { 
					if(update[0]=="OK"){ 
						swal("OK..!!", "DATA SUDAH DISIMPAN...", "success");
						datapendapatan();
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
	$.get("trans_/pergeseran/paguindikatif/dataperubahan.php",
		function(result){
			$("#sub_konten").html(result);
			jfdata_table(); 
		}
	);
}

function cariselisih(){ 
	
	nilaiperubahan=document.form.nilaibaru.value; 
	nilairupiah=document.form.nilairupiah.value;
	$.get("trans_/pergeseran/paguindikatif/selisih.php",{nilaiperubahan:nilaiperubahan,nilairupiah:nilairupiah},function(result){  
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
				$.get("trans_/pergeseran/paguindikatif/hapus_perubahan.php",{notrans:notrans},
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
	$.get("trans_/pergeseran/paguindikatif/kunci.php",{notrans:notrans},function(result){ 
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
	$.get("trans_/pergeseran/paguindikatif/bukakunci.php",{notrans:notrans},function(result){ 
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