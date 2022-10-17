function datausulan(){ 
	jfloading("sub_konten");
	$.get("perencanaan/musrenbang/datausulan.php",
		function(result){
			$("#sub_konten").html(result);
			jfdata_table(); 
		}
	);
}

function dataterverif(){ 
	jfloading("sub_konten");
	$.get("perencanaan/musrenbang/dataterverif.php",
		function(result){
			$("#sub_konten").html(result);
			jfdata_table(); 
		}
	);
}

function formrencana(noverif){  
	jfloading("sub_konten");
	$.get("perencanaan/diklat/form.php",{noverif:noverif},
		function(result){ 
			$("#sub_konten").html(result);
			$("#tabs").tabs();
			$('.select2').select2();
		}
	);
}

function simpan_rencana(){ 
	
	noverif=document.form.noverif.value; 
	nousulan=document.form.nousulan.value;
	koderuangan=document.form.koderuangan.value;
	tahun=document.form.tahun.value;
	kodeusulan=document.form.kodeusulan.value;
	jumlah=document.form.jumlah.value;
	keterangan=document.form.keterangan.value; 
	cito=document.form.cito.value;
	tglperencanaan=document.form.tglperencanaan.value; 
	keteranganx=document.form.keteranganx.value; 
	
	if(noverif==''){
		swal("Gagal..!!!", "NO. Verivikasi Kenapa Kosong...???", "error");
	}else if(nousulan==''){
		swal("Gagal..!!!", "No. Usulan Kenapa Kosong...???", "error");
	}else if(koderuangan==''){
		swal("Gagal..!!!", "Ruangan Kenapa Kosong...???", "error");
	}else if(tahun==''){
		swal("Gagal..!!!", "Tahun Kenapa Kosong...???", "error");
	}else if(kodeusulan==''){
		swal("Gagal..!!!", "Usulan Harus Diisi..!!!", "error");
	}else if(tglperencanaan==''){
		swal("Gagal..!!!", "Tanggal Perencanaan Harus Diisi..!!!", "error");
	}else{
		$.get("perencanaan/musrenbang/simpan.php",{noverif:noverif,nousulan:nousulan,koderuangan:koderuangan,tahun:tahun,kodeusulan:kodeusulan,jumlah:jumlah,keterangan:keterangan,cito:cito,tglperencanaan:tglperencanaan,keteranganx:keteranganx},function(result){  
				var update = new Array();
				update = result.split('|');
				if(result.indexOf('|' != -1)) { 
					if(update[0]=="OK"){ 
						swal("OK..!!", "DATA SUDAH DISIMPAN...", "success");
					}else{
						swal("Gagal..!!!", result, "error");
					}
				}
			}
		);
	}
}

