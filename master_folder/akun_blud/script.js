function data_akun_blud(){  
	jfloading("sub_konten");
	$.get("master_folder/akun_blud/akunblud.php",
		function(result){ 
			$("#sub_konten").html(result);
			$('.select2').select2();
			jfdata_table(); 
		}
	);
}


function tingkat2(akun){ 
	jfloading("sub_konten");
	$.get("master_folder/akun_blud/akunblud2.php",{akun:akun},
		function(result){ 
			$("#sub_konten").html(result);
			jfdata_table(); 
		}
	);
}

function tingkat3(akun,kelompok){
	jfloading("sub_konten");
	$.get("master_folder/akun_blud/akunblud3.php",{akun:akun,kelompok:kelompok},
		function(result){ 
			$("#sub_konten").html(result);
			jfdata_table(); 
		}
	);
}

function tingkat4(akun,kelompok,jenis){
	jfloading("sub_konten");
	$.get("master_folder/akun_blud/akunblud4.php",{akun:akun,kelompok:kelompok,jenis:jenis},
		function(result){ 
			$("#sub_konten").html(result);
			jfdata_table(); 
		}
	);
}

function tingkat5(akun,kelompok,jenis,objectx){
	jfloading("sub_konten");
	$.get("master_folder/akun_blud/akunblud5.php",{akun:akun,kelompok:kelompok,jenis:jenis,objectx:objectx},
		function(result){ 
			$("#sub_konten").html(result);
			jfdata_table(); 
		}
	);
}

function tingkat6(akun,kelompok,jenis,objectx,rincian){
	jfloading("sub_konten");
	$.get("master_folder/akun_blud/akunblud6.php",{akun:akun,kelompok:kelompok,jenis:jenis,objectx:objectx,rincian:rincian},
		function(result){ 
			$("#sub_konten").html(result);
			jfdata_table(); 
		}
	);
}

function tingkat7(akun,kelompok,jenis,objectx,rincian,subrincian){
	jfloading("sub_konten");
	$.get("master_folder/akun_blud/akunblud7.php",{akun:akun,kelompok:kelompok,jenis:jenis,objectx:objectx,rincian:rincian,subrincian:subrincian},
		function(result){ 
			$("#sub_konten").html(result);
			jfdata_table(); 
		}
	);
}

function simpankegiatan_permendagri_50(){ 

	kode=document.form.kode.value;
	namaperusahaan=document.form.namaperusahaan.value;
	alamatperusahaan=document.form.alamatperusahaan.value;
	teleponperusahaan=document.form.teleponperusahaan.value;
	npwp=document.form.npwp.value;
	norek=document.form.norek.value;
	cp=document.form.cp.value;
		
	if(namaperusahaan==''){
		swal("Gagal..!!!", "NAMA PERUSAHAAN Harus Diisi..!!!", "error");
	}else if(alamatperusahaan==''){
		swal("Gagal..!!!", "ALAMAT PERUSAHAAN Harus Diisi..!!!", "error");
	}else if(teleponperusahaan==''){
		swal("Gagal..!!!", "TELEPON PERUSAHAAN Harus Diisi..!!!", "error");
	}else if(npwp==''){
		swal("Gagal..!!!", "NPWP Harus Diisi..!!!", "error");
	}else if(norek==''){
		swal("Gagal..!!!", "NO. REKENING Harus Diisi..!!!", "error");
	}else if(cp==''){
		swal("Gagal..!!!", "CONTACT PERSON Harus Diisi..!!!", "error");
	}else{
		$.get("master_folder/kegiatan_permendagri_50/simpankegiatan_permendagri_50.php",{kode:kode,namaperusahaan:namaperusahaan,alamatperusahaan:alamatperusahaan,teleponperusahaan:teleponperusahaan,
		npwp:npwp,norek:norek,cp:cp},function(result){ 
			var update = new Array();
			update = result.split('|');
			if(result.indexOf('|' != -1)) { 
				if(update[0]=="OK"){  
					swal("OK..!!", "DATA SUDAH DISIMPAN...", "success");
					//gridpeserta(notrans);	
				}else{
					swal("Gagal..!!!", result, "error");
				}
			}
		});
	}  
}

function hapusbagian(id){
	swal({
	  title: "PERINGATAN",
	  text: "Apakah Anda Yakin Akan Menghapus Data ini?",
	  type: "warning",
	  showCancelButton: true,
	  confirmButtonClass: "btn-danger",
	  confirmButtonText: "Ya, hapus ini!",
	  cancelButtonText: "Tidak!",
	  closeOnConfirm: false
	},
	function(isConfirm){
		if(isConfirm==true){
			$.get("master_folder/bagian/hapusbagian.php",{id:id},
				function(result){ 
					if(result=="OK"){
	  					swal("TERHAPUS!", "Data Sudah Terhapus", "success");
						listbagian();
					}else{
						swal("GAGAL", result, "error");
					}
				}
			);
		}
	});
}