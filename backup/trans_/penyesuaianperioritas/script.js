function dataperioritas(){
	jfloading("sub_konten");
	$.get("trans_/penyesuaianperioritas/dataperioritas.php",
		function(result){
			$("#sub_konten").html(result);
			jfdata_table(); 
		}
	);
}

function formpenentuanperioritas(notrans){
	jfloading("sub_konten");
	$.get("trans_/penyesuaianperioritas/formpenentuanperioritas.php",{notrans,notrans},
		function(result){
			$("#sub_konten").html(result);
			gridrinci(notrans);
			if(notrans != undefined){  
				matix(); 
			}
			fungsikomplet(); 
			$("#usulan").autocomplete({
				serviceUrl:'trans_/penyesuaianperioritas/autobyusulanprioritas.php?kodekegiatan='+$("#kodekegiatan").val(),
				type: "GET",
					onSelect: function (suggestion) {
						$('#usulan').val(suggestion.usulan);
						$('#volume').val(suggestion.volume);
						$('#harga').val(suggestion.harga);
						$('#nilai').val(suggestion.nilai);
						$('#nousulan').val(suggestion.nousulan);
						
						document.form_rinci.jumlahacc.focus();
					}
					
			});
		}
	);
}

function matix(){ 
	document.form.pptk.disabled=true;
	document.form.namabidang.disabled=true;
	document.form.kegiatan.disabled=true;
	document.form.tgltrans.disabled=true;
	document.form.ruangyangusul.disabled=true;
}

function datapenentuanperioritas(){
	jfloading("sub_konten");
	$.get("trans_/penyesuaianperioritas/datapenentuanperioritas.php",
		function(result){
			$("#sub_konten").html(result);
			jfdata_table(); 
		}
	);
}


function fungsikomplet(){  
	$("#namabidang").autocomplete({
		serviceUrl:'trans_/penyesuaianperioritas/autobykodebidang.php',
		type: "GET",
		    onSelect: function (suggestion) {
		    	$('#kodebidang').val(suggestion.kodeorganisasi);
				$('#namabidang').val(suggestion.nama);
				$('#kodebidangx').val(suggestion.kode);
				
		    }

	});
	$("#uraianrek50").autocomplete({
		serviceUrl:'trans_/penyesuaianperioritas/auto50.php',
		type: "GET",
		    onSelect: function (suggestion) {
		    	$('#uraianrek50').val(suggestion.uraian);
				$('#koderek50').val(suggestion.kode);
		    }
	});
	$("#uraianrek108").autocomplete({
		serviceUrl:'trans_/penyesuaianperioritas/auto108.php',
		type: "GET",
		    onSelect: function (suggestion) {
		    	$('#uraianrek108').val(suggestion.uraian108);
				$('#koderek108').val(suggestion.kode108);
				$('#uraianrek50').val(suggestion.blud_uraian);
				$('#koderek50').val(suggestion.kode50);
		    }
	});
	$("#pptk").autocomplete({
		serviceUrl:'trans_/penyesuaianperioritas/autobypptk.php',
		type: "GET",
		    onSelect: function (suggestion) {
		    	$('#kodepptk').val(suggestion.nip);
				$('#pptk').val(suggestion.nama);
				$('#kodebidang').val(suggestion.kodebagian);
				$('#namabidang').val(suggestion.bagian);
				$('#kodebidangx').val(suggestion.kodebidangx);
				
				$("#kegiatan").autocomplete({
					serviceUrl:'trans_/penyesuaianperioritas/autobykegiatan.php?nip='+suggestion.nip,
					type: "GET",
						onSelect: function (suggestion) {
							$('#kegiatan').val(suggestion.kegiatan);
							$('#kodekegiatan').val(suggestion.kodekegiatan);
							
							$("#usulan").autocomplete({
								serviceUrl:'trans_/penyesuaianperioritas/autobyusulanprioritas.php?kodekegiatan='+suggestion.kodekegiatan,
								type: "GET",
									onSelect: function (suggestion) {
										$('#usulan').val(suggestion.usulan);
										$('#volume').val(suggestion.volume);
										$('#harga').val(suggestion.harga);
										$('#nilai').val(suggestion.nilai);
										$('#nousulan').val(suggestion.nousulan);
										
										document.form_rinci.jumlahacc.focus();
									}
									
							});
						}

				});
							
		    }

	});
}

function gridrinci(notrans){ 
	jfloading("grid_nilai");
	$.get("trans_/penyesuaianperioritas/gridrinci.php",{notrans:notrans},
		function(result){ 
			$("#grid_nilai").html(result); 
			jfdata_table(); 
		}
	);
}

function simpanpenentuanprioritas(){ 
    
	notrans=document.form.notrans.value; 
	kodebidang=document.form.kodebidang.value; 
	kodepptk=document.form.kodepptk.value; 
	kodekegiatan=document.form.kodekegiatan.value;
	namabidang=document.form.namabidang.value; 
	pptk=document.form.pptk.value; 
	tgltrans=document.form.tgltrans.value;
	kegiatan=document.form.kegiatan.value;
	ruangyangusul=document.form.ruangyangusul.value;
	
	
	usulan=document.form_rinci.usulan.value;
	nousulan=document.form_rinci.nousulan.value;
	volume=document.form_rinci.volume.value;
	harga=document.form_rinci.harga.value;
	nilai=document.form_rinci.nilai.value;
	koderek108=document.form_rinci.koderek108.value;
	uraianrek108=document.form_rinci.uraianrek108.value;
	koderek50=document.form_rinci.koderek50.value;
	uraianrek50=document.form_rinci.uraianrek50.value;
	jumlahacc=document.form_rinci.jumlahacc.value;
		
	if(kodebidang==''){
		swal("Gagal..!!!", "BAGIAN TIDAK BOLEH KOSONG ATAU BAGIAN BELUM TERDAFTAR....!!!", "error");
	}else if(kodepptk==''){
		swal("Gagal..!!!", "PPTK TIDAK BOLEH KOSONG ATAU PPTK BELUM TERDAFTAR....!!!", "error");
	}else if(tgltrans==''){
		swal("Gagal..!!!", "TANGGAL TIDAK BOLEH KOSONG....!!!", "error");
	}else if(usulan==''){
		swal("Gagal..!!!", "USULAN TIDAK BOLEH KOSONG ATAU USULAN BELUM TERDAFTAR....!!!", "error");
	}else if(jumlahacc==''){
		swal("Gagal..!!!", "JUMLAH YANG DIACC DARI MUSRENBANG TIDAK BOLEH KOSONG....!!!", "error");
	}else if(harga==''){
		swal("Gagal..!!!", "HARGA TIDAK BOLEH KOSONG....!!!", "error");
	}else if(kegiatan==''){
		swal("Gagal..!!!", "KEGIATAN TIDAK BOLEH KOSONG....!!!", "error");
	}else{
		$.get('trans_/penyesuaianperioritas/simpan.php',{notrans:notrans,kodebidang:kodebidang,kodepptk:kodepptk,kodekegiatan:kodekegiatan,namabidang:namabidang,pptk:pptk,
		tgltrans:tgltrans,kegiatan:kegiatan,ruangyangusul:ruangyangusul,usulan:usulan,volume:volume,harga:harga,nilai:nilai,koderek108:koderek108,uraianrek108:uraianrek108,
		koderek50:koderek50,uraianrek50:uraianrek50,jumlahacc:jumlahacc,nousulan:nousulan},
			function(result){ 
				var update = new Array();
				update = result.split('|'); 
				if(result.indexOf('|' != -1)) { 
					if(update[0]=="OK"){ 
						swal("OK..!!", "DATA SUDAH DISIMPAN...", "success");
						document.form.notrans.value=update[1];
						gridrinci(update[1]);
						matix();
						clearrincix();
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

function mati(){
	document.form.notrans.disabled=true;
	document.form.kodebidang.disabled=true;
	document.form.kodebidangx.disabled=true;
	document.form.kodepptk.disabled=true;
	document.form.namabidang.disabled=true;
	document.form.pptk.disabled=true;
	document.form.tgltrans.disabled=true;
}

function clearrincix(){
	document.form_rinci.nilai.value='';
	document.form_rinci.koderek50.value='';
	document.form_rinci.uraianrek50.value='';
	document.form_rinci.nousulan.value='';
	document.form_rinci.usulan.value='';
	document.form_rinci.volume.value='';
	document.form_rinci.harga.value='';
	document.form_rinci.koderek108.value='';
	document.form_rinci.uraianrek108.value='';
	document.form_rinci.jumlahacc.value='';
}

function hapus_rinci(id,notrans,notransmusrenbang,kodeusulan,koderuanganusulan){  
	swal({
	  title: "APAKAH ANDA AKAN MENGHAPUS DATA INI...?",
	  text: "TEKAN OK JIKA IYA",
	  type: "info",
	  showCancelButton: true,
	  closeOnConfirm: true,
	  showLoaderOnConfirm: true
	}, function (dismiss) { 
			if(dismiss==true){
				$.get("trans_/penyesuaianperioritas/hapus_rinci.php",{id:id,notrans:notrans,notransmusrenbang:notransmusrenbang,kodeusulan:kodeusulan,koderuanganusulan:koderuanganusulan},
					function(result){ 
						var update = new Array();
						update = result.split('|');
						if(result.indexOf('|' != -1)) { 
							if(update[0]=="OK"){  
								swal("OK..!!", "DATA SUDAH TERHAPUS...", "success");
								gridrinci(notrans);
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


function hapustransaksi(){  
	swal({
	  title: "APAKAH ANDA AKAN MENGHAPUS DATA INI...?",
	  text: "TEKAN OK JIKA IYA",
	  type: "info",
	  showCancelButton: true,
	  closeOnConfirm: true,
	  showLoaderOnConfirm: true
	}, function (dismiss) { 
			if(dismiss==true){
				notrans=document.form.notrans.value;
				$.get("trans_/penyesuaianperioritas/hapustransaksi.php",{notrans:notrans},
					function(result){ 
						var update = new Array();
						update = result.split('|');
						if(result.indexOf('|' != -1)) { 
							if(update[0]=="OK"){  
								swal("OK..!!", "DATA SUDAH TERHAPUS...", "success");
								datapenentuanperioritas();
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

function hapusHeader(notrans){
	if(confirm("apakah yakin data akan dihapus?")){
		$.get("trans_/pengusulan/hapustransaksi.php",{notrans:notrans},function(result){ 
			if(result=="OK"){
				datapengusulanhonor();
			}
			else{
				swal("GAGAL", result, "error");
			}
		});
	}
}