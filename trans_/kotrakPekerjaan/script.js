function formkontrakpekerjaan(nokontrak){
	jfloading("sub_konten");
	$.get("trans_/kotrakPekerjaan/formkontrakpekerjaan.php",{nokontrak:nokontrak},
		function(result){
			$("#sub_konten").html(result);
			gridrinci(nokontrak);
			$("#pptk").select2({
			});
			$("#perusahaan").select2({
			  tags: true
			});
			fungsikomplet();
			$( '#volumepermintaanpanjar' ).mask('000,000,000,000.00', {reverse: true});
			$( '#hargapermintaanpanjar' ).mask('000,000,000,000.00', {reverse: true});
			$( '#nilai' ).mask('000,000,000,000.00', {reverse: true});
			$( '#nilaikontrak' ).mask('000,000,000,000.00', {reverse: true});
			if(nokontrak != undefined){
				mati();
			}			
		}
	);
}

function fungsikomplet(){
	pptk=document.form.pptk.value;
	$("#kegiatanblud").autocomplete({
		serviceUrl:'trans_/kotrakPekerjaan/autobykegiatanblud.php?pptk='+pptk,
		type: "GET",
			onSelect: function (suggestion) {
				$('#kegiatanblud').val(suggestion.kegiatanblud);
				$('#kodekegiatanblud').val(suggestion.kodekegiatanblud);
				
				$("#uraianpekerjaanx").autocomplete({
					serviceUrl:'trans_/kotrakPekerjaan/autobyuraianpekerjaan.php?pptk='+pptk+'&kodekegiatanblud='+suggestion.kodekegiatanblud,
					type: "GET",
						onSelect: function (suggestion) {
							$('#koderek50').val(suggestion.koderek50);
							$('#uraianpekerjaanx').val(suggestion.uraian50);
							$('#nilaikegiatan').val(suggestion.nilai);
						}

				});
			}

	});
		   
}

function simpankontrakPekerja(){ 
    
	nokontrak=document.form.nokontrak.value; 
	perusahaan=document.form.perusahaan.value; 
	tglmulaikontrak=document.form.tglmulaikontrak.value; 
	tglakhirkontrak=document.form.tglakhirkontrak.value;
	tgltrans=document.form.tgltrans.value; 
	pptk=document.form.pptk.value; 
	program=document.form.program.value;
	kegiatan=document.form.kegiatan.value; 
	kodekegiatanblud=document.form.kodekegiatanblud.value;
	kegiatanblud=document.form.kegiatanblud.value;
	//koderek50=document.form.koderek50.value;
	//uraianpekerjaan=document.form.uraianpekerjaan.value;
	//nilaikegiatan=document.form.nilaikegiatan.value;
	nilaikontrak=document.form.nilaikontrak.value;
	
//	idpprini=document.form_rinci.idpprini.value;
//	nopp=document.form_rinci.nopp.value;
//	nousulan=document.form_rinci.nousulan.value;
//	itembelanja=document.form_rinci.itembelanja.value;
//	volume=document.form_rinci.volume.value;
//	satuan=document.form_rinci.satuan.value;
//	harga=document.form_rinci.harga.value;
//	total=document.form_rinci.total.value;
//	sisaanggaran=document.form_rinci.sisaanggaran.value;
//	volumepermintaanpanjar=document.form_rinci.volumepermintaanpanjar.value;
//	hargapermintaanpanjar=document.form_rinci.hargapermintaanpanjar.value;
//	nofaktur=document.form_rinci.nofaktur.value;
//	keterangan=document.form_rinci.keterangan.value;
//	nilai=document.form_rinci.nilai.value;
//	satuanbaru=document.form_rinci.satuanbaru.value;
		
	if(perusahaan==''){
		swal("Gagal..!!!", "PERUSAHAAN TIDAK BOLEH KOSONG....!!!", "error");
	}else if(pptk==''){
		swal("Gagal..!!!", "PPTK TIDAK BOLEH KOSONG ATAU PPTK BELUM TERDAFTAR....!!!", "error");
	}else if(program==''){
		swal("Gagal..!!!", "PROGRAM TIDAK BOLEH KOSONG....!!!", "error");
	}else if(kegiatan==''){
		swal("Gagal..!!!", "KEGIATAN TIDAK BOLEH KOSONG ATAU USULAN BELUM TERDAFTAR....!!!", "error");
	}else if(kodekegiatanblud==''){
		swal("Gagal..!!!", "KODE KEGIATAN BLUD TIDAK BOLEH KOSONG....!!!", "error");
	}else if(kegiatanblud==''){
		swal("Gagal..!!!", "KEGIATAN BLUD TIDAK BOLEH KOSONG....!!!", "error");
	//}else if(uraianpekerjaan==''){
	//	swal("Gagal..!!!", "URAIANPEKERJAAN TIDAK BOLEH KOSONG....!!!", "error");
	//}else if(nilaikegiatan==''){
	//	swal("Gagal..!!!", "NILAI KEGIATAN TIDAK BOLEH KOSONG....!!!", "error");
	}else if(nilaikontrak==''){
		swal("Gagal..!!!", "NILAI KONTRAK TIDAK BOLEH KOSONG....!!!", "error");
//	}else if(volumepermintaanpanjar==''){
//		swal("Gagal..!!!", "VOLUME PERMINTAAN TIDAK BOLEH KOSONG....!!!", "error");
//	}else if(hargapermintaanpanjar==''){
//		swal("Gagal..!!!", "HARGA PERMINTAAN TIDAK BOLEH KOSONG....!!!", "error");
//	}else if(nofaktur==''){
//		swal("Gagal..!!!", "NOFAKTUR TIDAK BOLEH KOSONG....!!!", "error");
//	}else if(nilai==''){
//		swal("Gagal..!!!", "NILAI TIDAK BOLEH KOSONG....!!!", "error");
	}else{
		//clearrinci();
		$.get('trans_/kotrakPekerjaan/simpan.php',{nokontrak:nokontrak,perusahaan:perusahaan, tglmulaikontrak:tglmulaikontrak,tglakhirkontrak:tglakhirkontrak,tgltrans:tgltrans,pptk:pptk, 
			program:program,kegiatan:kegiatan,kodekegiatanblud:kodekegiatanblud,kegiatanblud:kegiatanblud,nilaikontrak:nilaikontrak },
			function(result){ 
				var update = new Array();
				update = result.split('|'); 
				if(result.indexOf('|' != -1)) { 
					if(update[0]=="OK"){ 
						swal("OK..!!", "DATA SUDAH DISIMPAN...", "success");
						document.form.nokontrak.value=update[1];
						//gridrinci(update[1]);
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
	document.form.nokontrak.disabled=true; 
	document.form.perusahaan.disabled=true; 
	document.form.tglmulaikontrak.disabled=true; 
	document.form.tglakhirkontrak.disabled=true;
	document.form.tgltrans.disabled=true; 
	document.form.pptk.disabled=true; 
	document.form.program.disabled=true;
	document.form.kegiatan.disabled=true; 
	document.form.kodekegiatanblud.disabled=true;
	document.form.kegiatanblud.disabled=true;
	//document.form.uraianpekerjaan.disabled=true;
	//document.form.nilaikegiatan.disabled=true;
	document.form.nilaikontrak.disabled=true;
}

function clearrinci(){
	document.form_rinci.idpprini.value='';
	document.form_rinci.nopp.value='';
	document.form_rinci.nousulan.value='';
	document.form_rinci.itembelanja.value='';
	document.form_rinci.volume.value='';
	document.form_rinci.satuan.value='';
	document.form_rinci.harga.value='';
	document.form_rinci.total.value='';
	document.form_rinci.sisaanggaran.value='';
	document.form_rinci.volumepermintaanpanjar.value='';
	document.form_rinci.hargapermintaanpanjar.value='';
	document.form_rinci.nofaktur.value='';
	document.form_rinci.keterangan.value='';
	document.form_rinci.nilai.value='';
}

async function gridrinci(nokontrak){  
	jfloading("grid_nilai");
	await $.get("trans_/kotrakPekerjaan/gridrinci.php",{nokontrak:nokontrak},
		function(result){ 
			$("#grid_nilai").html(result); 
			jfdata_table(); 
		}
	);
	
	kodekegiatan=document.form.kodekegiatanblud.value;
	await $.getJSON("trans_/kotrakPekerjaan/getPaguByKegiatan.php",{nokontrak:nokontrak},function(result){ 
		warna = "";
		if(result.sisaPagu<1){
			warna = `style='font-color:red;'`;
		}
		$("#contentPagu").html(`
			<b ${warna}>
				<br>Total Nilai : ${result.totalrincirp}
				<br>
			</b>
		`);
	});	 
}


function datakontrakpekerjaan(){
	jfloading("sub_konten");
	$.get("trans_/kotrakPekerjaan/datakontrakpekerjaan.php",
		function(result){
			$("#sub_konten").html(result);
			jfdata_table(); 
		}
	);
}

function hapus_rinci(id,nokontrak){
	jfloading("grid_nilai");
	$.get("trans_/kotrakPekerjaan/hapus_rinci.php",{id:id,nokontrak:nokontrak},function(result){ 
			var update = new Array();
			update = result.split('|');
			if(result.indexOf('|' != -1)) { 
				if(update[0]=="OK"){  
					swal("OK..!!", "DATA SUDAH DIHAPUS...", "success");
					gridrinci(nokontrak);	
				}else{
					swal("Gagal..!!!", result, "error");
					gridrinci(nokontrak);
				}
			}
		}
	);
}

function hapusHeader(nokontrak){  
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
				$.get("trans_/kotrakPekerjaan/hapusHeader.php",{nokontrak:nokontrak},function(result){ 
						var update = new Array();
						update = result.split('|');
						if(result.indexOf('|' != -1)) { 
							if(update[0]=="OK"){  
								swal("OK..!!", "DATA SUDAH TERHAPUS...", "success");
								datakontrakpekerjaan();
							}else{
								swal("Gagal..!!!", result, "error");
							}
						}
					}
				);
			}
	});
	
}

function kunci(nokontrak){
	jfloading("sub_konten");
	$.get("trans_/kotrakPekerjaan/kunci.php",{nokontrak:nokontrak},function(result){ 
			var update = new Array();
			update = result.split('|');
			if(result.indexOf('|' != -1)) { 
				if(update[0]=="OK"){  
					swal("OK..!!", "DATA SUDAH TERKUNCI...", "success");
					datakontrakpekerjaan();	
				}else{
					swal("Gagal..!!!", result, "error");
				}
			}
		}
	);
}

function bukakunci(nokontrak){
	jfloading("sub_konten");
	$.get("trans_/kotrakPekerjaan/bukakunci.php",{nokontrak:nokontrak},function(result){ 
			var update = new Array();
			update = result.split('|');
			if(result.indexOf('|' != -1)) { 
				if(update[0]=="OK"){  
					swal("OK..!!", "KUNCI SUDAH DIBUKA...", "success");
					datakontrakpekerjaan();	
				}else{
					swal("Gagal..!!!", result, "error");
				}
			}
		}
	);
}


function pilihcaribelanja(usulan,jumlahacc,satuan,harga,notrans,nousulan,idpp,total,sisa){
	document.form_rinci.itembelanja.value=usulan;
	document.form_rinci.volume.value=jumlahacc; 
	document.form_rinci.satuan.value=satuan;
	document.form_rinci.harga.value=harga;
	document.form_rinci.nilai.value=total;
	document.form_rinci.sisaanggaran.value=sisa;
	document.form_rinci.volumepermintaanpanjar.value=jumlahacc;
	document.form_rinci.hargapermintaanpanjar.value=harga;
	document.form_rinci.total.value=total;
	document.form_rinci.nopp.value=notrans;
	document.form_rinci.idpprini.value=idpp; 
	document.form_rinci.nousulan.value=nousulan;
	document.form_rinci.satuanbaru.value=satuan;
	$.fancybox.close();
}

function carikegiatanblud(){
	pptk=document.form.pptk.value;
	var update = new Array();
	update = pptk.split('|');
	pptk.indexOf('|' != -1);
	kodepptk=update[0];
	$.fancybox({
		'href'			:'trans_/kotrakPekerjaan/carikegiatanblud.php?kodepptk='+kodepptk,
		'overlayOpacity':0,
		'opacity'		: true,
		'transitionIn'	: 'elastic',
		'type'			: 'ajax'
	});
}

function pilihkegiatanblud(kodekegiatanblud,kegiatanblud){ 
	document.form.kodekegiatanblud.value=kodekegiatanblud; 
	document.form.kegiatanblud.value=kegiatanblud; 
	$.fancybox.close();
}
