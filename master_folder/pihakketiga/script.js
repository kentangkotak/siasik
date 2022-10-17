function formpihakketiga(kode){  
	jfloading("sub_konten");
	$.get("master_folder/pihakketiga/formpihakketiga.php",{kode:kode},
		function(result){ 
			$("#sub_konten").html(result);
			$('.select2').select2();
			fungsikomplet();
		}
	);
}

function fungsikomplet(){
	$("#namasuplier").autocomplete({
		serviceUrl:'master_folder/pihakketiga/autobynamasuplier.php',
		type: "GET",
			onSelect: function (suggestions) {
				$('#kodemapingrs').val(suggestions.kode);
				$('#namasuplier').val(suggestions.nama);
			}
			
	});	
}

function listpihakketiga(){  
	jfloading("sub_konten");
	$.get("master_folder/pihakketiga/listpihakketiga.php",
		function(result){ 
			$("#sub_konten").html(result);
			$('.select2').select2();
			jfdata_table(); 
		}
	);
}

function simpanpihakketiga(){ 

	kode=document.form.kode.value;
	namaperusahaan=document.form.namaperusahaan.value;
	alamatperusahaan=document.form.alamatperusahaan.value;
	teleponperusahaan=document.form.teleponperusahaan.value;
	npwp=document.form.npwp.value;
	norek=document.form.norek.value;
	cp=document.form.cp.value;
	namabank=document.form.namabank.value;
	kodemapingrs=document.form.kodemapingrs.value;
	namasuplier=document.form.namasuplier.value;
		
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
	}else if(namabank==''){
		swal("Gagal..!!!", "NAMA BANK Harus Diisi..!!!", "error");
	}else{
		$.get("master_folder/pihakketiga/simpanpihakketiga.php",{kode:kode,namaperusahaan:namaperusahaan,alamatperusahaan:alamatperusahaan,teleponperusahaan:teleponperusahaan,
		npwp:npwp,norek:norek,cp:cp,namabank:namabank,kodemapingrs:kodemapingrs,namasuplier:namasuplier},function(result){ 
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

function hapuspihakketiga(id){
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
			$.get("master_folder/pihakketiga/hapuspihakketiga.php",{id:id},
				function(result){ 
					if(result=="OK"){
	  					swal("TERHAPUS!", "Data Sudah Terhapus", "success");
						listpihakketiga();
					}else{
						swal("GAGAL", result, "error");
					}
				}
			);
		}
	});
}