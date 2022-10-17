function form_perencanaan_pembangunan(x,x1,x2,x3,x4){  
	jfloading("sub_konten");
	$.get("master_folder/kegiatan_permendagri_50/form.php",{x:x,x1:x1,x2:x2,x3:x3,x4:x4},
		function(result){ 
			$("#sub_konten").html(result);
			$('.select2').select2();
			if(x == 1){
				document.getElementById("urusan").readOnly = true;
				document.getElementById("bidangurusan").readOnly = true;
				document.getElementById("program").readOnly = true;
				document.getElementById("kegiatan").readOnly = true; 
				document.getElementById("sub_kegiatan").readOnly = true; 
			}else if(x == 2){
				document.getElementById("urusan").readOnly = true;
				document.getElementById("bidangurusan").readOnly = true;
				document.getElementById("program").readOnly = true;
				document.getElementById("kegiatan").readOnly = true; 
				document.getElementById("sub_kegiatan").readOnly = true; 
			}else if(x == 3){
				document.getElementById("urusan").readOnly = true;
				document.getElementById("bidangurusan").readOnly = true;
				document.getElementById("program").readOnly = true;
				document.getElementById("kegiatan").readOnly = true; 
				document.getElementById("sub_kegiatan").readOnly = true; 
			}else if(x == 4){
				document.getElementById("urusan").readOnly = true;
				document.getElementById("bidangurusan").readOnly = true;
				document.getElementById("program").readOnly = true;
				document.getElementById("kegiatan").readOnly = true; 
				document.getElementById("sub_kegiatan").readOnly = true; 
			}else if(x == 5){
				document.getElementById("urusan").readOnly = true;
				document.getElementById("bidangurusan").readOnly = true;
				document.getElementById("program").readOnly = true;
				document.getElementById("kegiatan").readOnly = true; 
				document.getElementById("sub_kegiatan").readOnly = true; 
			}
		}
	);
}

function list_perencanaan_pembagunan(){  
	jfloading("sub_konten");
	$.get("master_folder/kegiatan_permendagri_50/list_perencanaan_pembagunan.php",
		function(result){ 
			$("#sub_konten").html(result);
			$('.select2').select2();
			jfdata_table(); 
		}
	);
}


function tingkat2(urusan){ 
	jfloading("sub_konten");
	$.get("master_folder/kegiatan_permendagri_50/list_perencanaan_pembagunan_2.php",{urusan:urusan},
		function(result){ 
			$("#sub_konten").html(result);
			jfdata_table(); 
		}
	);
}

function tingkat3(urusan,bidang_urusan){
	jfloading("sub_konten");
	$.get("master_folder/kegiatan_permendagri_50/list_perencanaan_pembagunan_3.php",{urusan:urusan,bidang_urusan:bidang_urusan},
		function(result){ 
			$("#sub_konten").html(result);
			jfdata_table(); 
		}
	);
}

function tingkat4(urusan,bidang_urusan,program){
	jfloading("sub_konten");
	$.get("master_folder/kegiatan_permendagri_50/list_perencanaan_pembagunan_4.php",{urusan:urusan,bidang_urusan:bidang_urusan,program:program},
		function(result){ 
			$("#sub_konten").html(result);
			jfdata_table(); 
		}
	);
}

function tingkat5(urusan,bidang_urusan,program,kegiatan){
	jfloading("sub_konten");
	$.get("master_folder/kegiatan_permendagri_50/list_perencanaan_pembagunan_5.php",{urusan:urusan,bidang_urusan:bidang_urusan,program:program,kegiatan:kegiatan},
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
