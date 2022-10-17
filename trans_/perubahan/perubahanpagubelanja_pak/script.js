function formpenetapanpagu(notrans){ 
	jfloading("sub_konten");
	$.get("trans_/perubahan/perubahanpagubelanja_pak/form.php",{notrans:notrans},
		function(result){ 
			$("#sub_konten").html(result);
			//fungsikomplet();
			$( '#nilaiperubahan' ).mask('000,000,000,000.00', {reverse: true});
			$( '#nilairupiah' ).mask('000,000,000,000.00', {reverse: true});
		}
	);
}

async function datapenetapanpagu_revisi1(){ 
	jfloading("sub_konten");
	await $.get("trans_/perubahan/perubahanpagubelanja_pak/datapenetapanpagu.php",
		function(result){
			$("#sub_konten").html(result);
			jfdata_table(); 
		}
	);
	await $.getJSON("trans_/perubahan/perubahanpagubelanja_pak/getPaguByKegiatan.php",function(result){ 
		warna = "";
		//if(result.sisaPagu<1){
			warna = `style='font-color:red;'`;
		//}
		$("#contentPagu").html(`
			<b ${warna}>
				<br>TOTAL Pendapatan SETELAH PERUBAHAN : ${result.pendapatanPerubahanrp}
				<br>TOTAL PAGU : ${result.totalpagurp}
				<br>SISA PENDAPATAN : ${result.sisarp}
			</b>
		`);
	});
}

function simpanperubahan(){ 
    
	noperubahan=document.form.noperubahan.value;
	notrans=document.form.notransawal.value;
	kodekegiatanblud=document.form.kodekegiatanblud.value; 
	kegiatanblud=document.form.kegiatanblud.value;
	nilairupiah=document.form.nilairupiah.value;
	kode1=document.form.kode1.value;
	kode2=document.form.kode2.value;
	kode3=document.form.kode3.value;
	organisasi_nama=document.form.organisasi_nama.value;
	nilaiperubahan=document.form.nilaiperubahan.value;
	
	if(kodekegiatanblud==''){
		swal("Gagal..!!!", "KEGIATAN BELUM DI ISI ATAU KEGIATAN BELUM TERDAFTAR....!!!", "error");
	}else if(nilairupiah==''){
		swal("Gagal..!!!", "NILAI RUPIAH HARUS DI ISI..!!!", "error");
	}else if(nilaiperubahan==''){
		swal("Gagal..!!!", "PERUBAHAN TIDAK BOLEH KOSONG...!!!", "error");
	}else{ 
		$.get('trans_/perubahan/perubahanpagubelanja_pak/simpan.php',{noperubahan:noperubahan,notrans:notrans,kodekegiatanblud:kodekegiatanblud,kegiatanblud:kegiatanblud,nilairupiah:nilairupiah,
		kode1:kode1,kode2:kode2,kode3:kode3,organisasi_nama:organisasi_nama,nilaiperubahan:nilaiperubahan},
			function(result){ 
				var update = new Array();
				update = result.split('|');
				if(result.indexOf('|' != -1)) { 
					if(update[0]=="OK"){ 
						swal("OK..!!", "DATA SUDAH DISIMPAN...", "success");
						//document.form.notrans.value=update[1];
						datapenetapanpagu_revisi1();
					}else{
						swal("Gagal..!!!", result, "error");
					}
				}
			}
		);  
	}
}

function dataperubahanpenetapanpagu_pak(){ 
	jfloading("sub_konten");
	$.get("trans_/perubahan/perubahanpagubelanja_pak/dataperubahanpenetapanpagu.php",
		function(result){
			$("#sub_konten").html(result);
			jfdata_table(); 
		}
	);
}

function cariselisih(){ 
	
	nilaiperubahan=document.form.nilaiperubahan.value; 
	nilairupiah=document.form.nilairupiah.value;
	$.get("trans_/perubahan/perubahanpagubelanja_pak/selisih.php",{nilaiperubahan:nilaiperubahan,nilairupiah:nilairupiah},function(result){  
		var update = new Array(); 
		update = result.split('|'); 
		if(result.indexOf('|' != -1)) { 
			document.form.selisih.value=update[1];
		}
	});
}

function formperubahanpagu(noperubahan,x){ 
	jfloading("sub_konten");
	$.get("trans_/perubahan/perubahanpagubelanja_pak/formperubahanpagu.php",{noperubahan:noperubahan,x:x},
		function(result){ 
			$("#sub_konten").html(result);
			//fungsikomplet();
			$( '#nilaiperubahan' ).mask('000,000,000,000.00', {reverse: true});
		}
	);
}

function datahistoryperubahan(){ 
	jfloading("sub_konten");
	$.get("trans_/perubahan/perubahanpagubelanja_pak/datahistoryperubahan.php",
		function(result){
			$("#sub_konten").html(result);
			jfdata_table(); 
		}
	);
}

function hapus_perubahan_pagu(noperubahan,notrans){  
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
				$.get("trans_/perubahan/perubahanpagubelanja_pak/hapus_perubahan.php",{noperubahan:noperubahan,notrans:notrans},
					function(result){ 
						var update = new Array();
						update = result.split('|');
						if(result.indexOf('|' != -1)) { 
							if(update[0]=="OK"){  
								swal("OK..!!", "DATA SUDAH TERHAPUS...", "success");
								dataperubahanpenetapanpagu_pak();
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
	//jfloading("sub_konten");
	$.get("trans_/perubahan/perubahanpagubelanja_pak/kunci.php",{notrans:notrans},function(result){ 
			var update = new Array();
			update = result.split('|');
			if(result.indexOf('|' != -1)) { 
				if(update[0]=="OK"){  
					swal("OK..!!", "DATA SUDAH TERKUNCI...", "success");
					datapenetapanpagu_revisi1();	
				}else{
					swal("Gagal..!!!", result, "error");
				}
			}
		}
	);
}

function bukakunci(notrans){
	//jfloading("sub_konten");
	$.get("trans_/perubahan/perubahanpagubelanja_pak/bukakunci.php",{notrans:notrans},function(result){ 
			var update = new Array();
			update = result.split('|');
			if(result.indexOf('|' != -1)) { 
				if(update[0]=="OK"){  
					swal("OK..!!", "KUNCI SUDAH DIBUKA...!!!", "success");
					datapenetapanpagu_revisi1();	
				}else{
					swal("Gagal..!!!", result, "error");
				}
			}
		}
	);
}
