function dataserahterimah(){ 
	jfloading("sub_konten");
	$.get("trans_/serahterimapekerjaan/dataserahterimah.php",
		function(result){ 
			$("#sub_konten").html(result); 
			jfdata_table(); 
		}
	);
}

function formserahterima(noserahterimapekerjaan,kodekegiatanblud){
	jfloading("sub_konten");
	$.get("trans_/serahterimapekerjaan/formserahterima.php",{noserahterimapekerjaan:noserahterimapekerjaan},
		function(result){
			$("#sub_konten").html(result);
			fungsikomplet();
			$('#tgltrans').datetimepicker({
				format: 'DD/MM/YYYY'
			});
			$('#tanggalfaktur').datetimepicker({
				format: 'DD/MM/YYYY'
			});
			$('#tanggaljatuhtempo').datetimepicker({
				format: 'DD/MM/YYYY'
			});
			$( '#nilai' ).mask('000,000,000,000.00', {reverse: true});
			$( '#volumepermintaanpanjar' ).mask('000,000,000,000.00', {reverse: true});
			$( '#tagihanpenerimaan' ).mask('000,000,000,000.00', {reverse: true});
			$( '#tagihanfaktur' ).mask('000,000,000,000.00', {reverse: true});
			$( '#diskon' ).mask('000,000,000,000.00', {reverse: true});
			$( '#totalbelumppn' ).mask('000,000,000,000.00', {reverse: true});
			$( '#tagihanfaktur' ).mask('000,000,000,000.00', {reverse: true});
			gridrinci(noserahterimapekerjaan);
			gridrinci50(noserahterimapekerjaan);
			
			if(noserahterimapekerjaan != undefined){
				mati();
				//if(kodekegiatanblud == 20){
					//matikan();
					//document.getElementById('jika_trans_farmasi').style.visibility='visible';
				//	document.getElementById('lokasilaka_content').style.visibility='visible';
				//	document.getElementById('jika_trans_farmasixxx').style.visibility='hidden';
				//}else{
					//document.getElementById('jika_trans_farmasi').style.visibility='hidden';
				//	document.getElementById('lokasilaka_content').style.visibility='hidden';
				//	document.getElementById('jika_trans_farmasixxx').style.visibility='visible';
				//}
			}
		}
	);	
}

function fungsikomplet(){
	$("#nokontrak").autocomplete({
		serviceUrl:'trans_/serahterimapekerjaan/autobynokontrak.php',
		type: "GET",
			onSelect: function (suggestion) {
				$('#nokontrak').val(suggestion.nokontrak);
				$('#koderek50').val(suggestion.kode50);
				$('#kodekegiatanblud').val(suggestion.kodekegiatanblud);
				$('#namaperusahaan').val(suggestion.namaperusahaan);
				$('#tglmulaikontrak').val(suggestion.tglmulaikontrak);
				$('#tglakhirkontrak').val(suggestion.tglakhirkontrak);
				//$('#tgltrans').val(suggestion.tgltrans);
				$('#namapptk').val(suggestion.namapptk);
				$('#program').val(suggestion.program);
				$('#kegiatan').val(suggestion.kegiatan);
				$('#kegiatanblud').val(suggestion.kegiatanblud);
				$('#uraianpekerjaanx').val(suggestion.uraianpekerjaan);
				$('#nilaikegiatan').val(suggestion.nilaikegiatan);
				$('#kodepihakketiga').val(suggestion.kodeperusahaan);
				$('#kodepptk').val(suggestion.kodepptk);
				$('#kodeid').val(suggestion.kodeid);
				document.form.tgltrans.disabled=true;
				document.form.nokontrak.disabled=true;
			}

	});
		   
}

function simpanserahterima(){
    
	noserahterimapekerjaan=document.form.noserahterimapekerjaan.value; 
	nokontrak=document.form.nokontrak.value; 
	kodepihakketiga=document.form.kodepihakketiga.value;
	namaperusahaan=document.form.namaperusahaan.value;
	kodemapingrs=document.form.kodemapingrs.value;
	namasuplier=document.form.namasuplier.value; 
	tglmulaikontrak=document.form.tglmulaikontrak.value; 
	tglakhirkontrak=document.form.tglakhirkontrak.value;
	tgltrans=document.form.tgltrans.value;
	kodepptk=document.form.kodepptk.value;	
	namapptk=document.form.namapptk.value; 
	program=document.form.program.value;
	kegiatan=document.form.kegiatan.value; 
	kodekegiatanblud=document.form.kodekegiatanblud.value;
	kegiatanblud=document.form.kegiatanblud.value;
	/*
	koderek50=document.form.koderek50.value;
	uraianpekerjaan=document.form.uraianpekerjaan.value;
	nilaikegiatan=document.form.nilaikegiatan.value;
	*/
	nilaikontrak=document.form.nilaikontrak.value;	
	
	nopenerimaan=document.form_rinci.nopenerimaan.value; 
	nofaktur=document.form_rinci.nofaktur.value;
	diskon=document.form_rinci.diskon.value;
	tagihanpenerimaan=document.form_rinci.tagihanpenerimaan.value;
	tagihanfaktur=document.form_rinci.tagihanfaktur.value; 
	tanggalfaktur=document.form_rinci.tanggalfaktur.value;
	tanggaljatuhtempo=document.form_rinci.tanggaljatuhtempo.value; 
	totalbelumppn=document.form_rinci.totalbelumppn.value;
	
		
	if(namaperusahaan==''){
		swal("Gagal..!!!", "PERUSAHAAN TIDAK BOLEH KOSONG....!!!", "error");
	}else if(namapptk==''){
		swal("Gagal..!!!", "PPTK TIDAK BOLEH KOSONG ATAU PPTK BELUM TERDAFTAR....!!!", "error");
	}else if(program==''){
		swal("Gagal..!!!", "PROGRAM TIDAK BOLEH KOSONG....!!!", "error");
	}else if(kegiatan==''){
		swal("Gagal..!!!", "KEGIATAN TIDAK BOLEH KOSONG ATAU USULAN BELUM TERDAFTAR....!!!", "error");
	}else if(kodekegiatanblud==''){
		swal("Gagal..!!!", "KODE KEGIATAN BLUD TIDAK BOLEH KOSONG....!!!", "error");
	}else if(kegiatanblud==''){
		swal("Gagal..!!!", "KEGIATAN BLUD TIDAK BOLEH KOSONG....!!!", "error");
	/*
	}else if(uraianpekerjaan==''){
		swal("Gagal..!!!", "URAIANPEKERJAAN TIDAK BOLEH KOSONG....!!!", "error");
	}else if(nilaikegiatan==''){
		swal("Gagal..!!!", "NILAI KEGIATAN TIDAK BOLEH KOSONG....!!!", "error");
	*/
	}else if(nofaktur==''){
		swal("Gagal..!!!", "NOFAKTUR TIDAK BOLEH KOSONG....!!!", "error");
	}else{
		clearrinci();
		$.get('trans_/serahterimapekerjaan/simpan.php',{noserahterimapekerjaan:noserahterimapekerjaan,nokontrak:nokontrak,kodepihakketiga:kodepihakketiga,namaperusahaan:namaperusahaan,
	kodemapingrs:kodemapingrs,namasuplier:namasuplier,tglmulaikontrak:tglmulaikontrak,tglakhirkontrak:tglakhirkontrak,kodepptk:kodepptk,namapptk:namapptk,tgltrans:tgltrans,
	program:program,kegiatan:kegiatan,kodekegiatanblud:kodekegiatanblud,kegiatanblud:kegiatanblud,
	tanggaljatuhtempo:tanggaljatuhtempo,totalbelumppn:totalbelumppn,tanggalfaktur:tanggalfaktur,nilaikontrak:nilaikontrak,
	nopenerimaan:nopenerimaan,nofaktur:nofaktur,diskon:diskon,tagihanpenerimaan:tagihanpenerimaan,tagihanfaktur:tagihanfaktur},
			function(result){ 
				var update = new Array();
				update = result.split('|'); 
				if(result.indexOf('|' != -1)) { 
					if(update[0]=="OK"){ 
						swal("OK..!!", "DATA SUDAH DISIMPAN...", "success");
						document.form.noserahterimapekerjaan.value=update[1];
						gridrinci(update[1]);
						mati();
					}else{
						swal("Gagal..!!!", result, "error");
					}
				}
			}
		);  
	}
}

function clearrinci(){
	
	document.form_rinci.nopenerimaan.value='';
	document.form_rinci.nofaktur.value='';
	document.form_rinci.diskon.value='';
	document.form_rinci.tagihanpenerimaan.value='';
	document.form_rinci.tagihanfaktur.value='';
	document.form_rinci.totalbelumppn.value='';
}

function mati(){
	document.form.tgltrans.disabled=true; 
	document.form.nokontrak.disabled=true; 
}

async function gridrinci(noserahterimapekerjaan){ 
	jfloading("grid_nilai");
	await $.get("trans_/serahterimapekerjaan/gridrinci.php",{noserahterimapekerjaan:noserahterimapekerjaan},
		function(result){ 
			$("#grid_nilai").html(result); 
			jfdata_table2(); 
		}
	);
	await $.getJSON("trans_/serahterimapekerjaan/gettotalserahterimapekerjaan.php",{noserahterimapekerjaan:noserahterimapekerjaan},function(result){ 
		warna = "";
		//if(result.sisaPagu<1){
			warna = `style='font-color:red;'`;
		//}
		$("#contentPagu").html(`
			<b ${warna}>
				<br>Total : ${result.totalrinci}
			</b>
		`);
	});	 
}

function hapus_rinci(id,noserahterimapekerjaan,nopenerimaan){ 
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
				$.get("trans_/serahterimapekerjaan/hapus_rinci.php",{id:id,noserahterimapekerjaan:noserahterimapekerjaan,nopenerimaan:nopenerimaan},
					function(result){  
						var update = new Array();
						update = result.split('|');
						if(result.indexOf('|' != -1)) { 
							if(update[0]=="OK"){  
								swal("OK..!!", "DATA SUDAH TERHAPUS...", "success");
								gridrinci(noserahterimapekerjaan);
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

function kunci(noserahterimapekerjaan){
	jfloading("sub_konten");
	$.get("trans_/serahterimapekerjaan/kunci.php",{noserahterimapekerjaan:noserahterimapekerjaan},function(result){ 
			var update = new Array();
			update = result.split('|');
			if(result.indexOf('|' != -1)) { 
				if(update[0]=="OK"){  
					swal("OK..!!", "DATA SUDAH TERKUNCI...", "success");
					dataserahterimah();	
				}else{
					swal("Gagal..!!!", result, "error");
				}
			}
		}
	);
}

function bukakunci(noserahterimapekerjaan){
	jfloading("sub_konten");
	$.get("trans_/serahterimapekerjaan/bukakunci.php",{noserahterimapekerjaan:noserahterimapekerjaan},function(result){ 		
		var updatex = new Array();
		update = result.split('|');
		if(result.indexOf('|' != -1)) { 
			if(update[0]=="OK"){  
				swal("OK..!!", "KUNCI SUDAH DIBUKA...", "success");
				dataserahterimah();
			}else{
				swal("Gagal..!!!", result, "error");
				dataserahterimah();
			}
		}			
	});
	
}

function caririncianbelanja(){
	kodekegiatanblud=document.form.kodekegiatanblud.value;
	$.fancybox({
		'href'			:'trans_/serahterimapekerjaan/caririncianbelanja.php?kodekegiatanblud='+kodekegiatanblud,
		'overlayOpacity':0,
		'opacity'		: true,
		'transitionIn'	: 'elastic',
		'type'			: 'ajax'
	});
}

function pilihrekening50(koderek50,uraian50){
	document.form50.kode50.value=koderek50; 
	document.form50.uraian50.value=uraian50; 
	$.fancybox.close();
}

function cariitembelanja(){
	kodekegiatanblud=document.form.kodekegiatanblud.value;
	koderek50=document.form_rinci.koderek50.value;
	$.fancybox({
		'href'			:'trans_/serahterimapekerjaan/cariitembelanja.php?kodekegiatanblud='+kodekegiatanblud+'&koderek50='+koderek50,
		'overlayOpacity':0,
		'opacity'		: true,
		'transitionIn'	: 'elastic',
		'type'			: 'ajax'
	});
}

function pilihcariitembelanja(usulan,jumlahacc,satuan,harga,notrans,nousulan,idpp,total,sisa){ 
	document.form_rinci.itembelanja.value=usulan; 
	document.form_rinci.volume.value=jumlahacc; 
	document.form_rinci.satuan.value=satuan;
	document.form_rinci.harga.value=harga;
	document.form_rinci.nopenerimaan.value=notrans;
	document.form_rinci.idserahterima_rinci.value=idpp; 
	document.form_rinci.nousulan.value=nousulan;
	document.form_rinci.total.value=total;
	document.form_rinci.volumepermintaanpanjar.value=jumlahacc;
	document.form_rinci.hargapermintaanpanjar.value=harga;
	document.form_rinci.nilai.value=total;
	document.form_rinci.sisaanggaran.value=sisa;
	$.fancybox.close();
}

function hasil(){
	hargapermintaanpanjar=document.form_rinci.hargapermintaanpanjar.value;
	volumepermintaanpanjar=document.form_rinci.volumepermintaanpanjar.value; 
	
	$.get("trans_/serahterimapekerjaan/hasil.php",{hargapermintaanpanjar:hargapermintaanpanjar,volumepermintaanpanjar:volumepermintaanpanjar},function(result){  
			document.form_rinci.nilai.value=result;		
			}
	);
}

function carikontrak(){
	nokontrak=document.form.nokontrak.value;
	if(nokontrak == ''){
		$.fancybox({
			'href'			:'trans_/serahterimapekerjaan/carikontrak.php',
			'overlayOpacity':0,
			'opacity'		: true,
			'transitionIn'	: 'elastic',
			'type'			: 'ajax'
		});
	}else{
		swal("Gagal..!!!", "JIKA AKAN MENCARI KONTRAK BARU KLIK MENU FORM SERAH TERIMA PEKERJAAN", "error");
	}
}

function pilihkontrak(kodekegiatanblud,kodeperusahaan,kodepptk,kodemapingrs,namasuplier,kode50,nokontrak,namaperusahaan,tglmulaikontrak,tglakhirkontrak,
namapptk,program,kegiatan,kegiatanblud,uraianpekerjaan,nilaikontrak,nilaikegiatan){ 
	document.form.kodekegiatanblud.value=kodekegiatanblud;
	document.form.kodemapingrs.value=kodemapingrs;
	document.form.namasuplier.value=namasuplier;	
	document.form.kodepihakketiga.value=kodeperusahaan; 
	document.form.kodepptk.value=kodepptk;
	document.form.nokontrak.value=nokontrak;
	document.form.namaperusahaan.value=namaperusahaan; 
	document.form.tglmulaikontrak.value=tglmulaikontrak;
	document.form.tglakhirkontrak.value=tglakhirkontrak;
	//document.form.tgltrans.value=tgltrans;
	document.form.namapptk.value=namapptk; 
	document.form.program.value=program;
	document.form.kegiatan.value=kegiatan; 
	document.form.kegiatanblud.value=kegiatanblud; 
	document.form.nilaikontrak.value=nilaikontrak;
	/*
	document.form.uraianpekerjaan.value=uraianpekerjaan;
	document.form.koderek50.value=kode50;
	document.form.nilaikegiatan.value=nilaikegiatan;
	document.form_rinci.rincianbelanja.value=rincianbelanja;
	*/	
	
	if(kodekegiatanblud == 20){
		//matikan();
		//document.getElementById('jika_trans_farmasi').style.visibility='visible'; 
		document.getElementById('lokasilaka_content').style.visibility='visible'; 
		//document.getElementById('jika_trans_farmasixxx').style.visibility='hidden'; 
	}else{
		//hidupkan();
		//document.getElementById('jika_trans_farmasi').style.visibility='hidden';
		document.getElementById('lokasilaka_content').style.visibility='hidden';
		//document.getElementById('profile-tab').style.visibility='hidden';
	}
	$.fancybox.close();
}

function matikan(){
	document.getElementById('lokasilaka_content').style.visibility='visible';
	document.form_rinci.nopenerimaan.disabled=true; 
	document.form_rinci.nofaktur.disabled=true;
	document.form_rinci.diskon.disabled=true;
	document.form_rinci.tagihanpenerimaan.disabled=true;
	//document.form_rinci.tagihanfaktur.disabled=true; 
	document.form_rinci.tanggalfaktur.disabled=true;
	document.form_rinci.tanggaljatuhtempo.disabled=true; 
	document.form_rinci.totalbelumppn.disabled=true;
}

function hidupkan(){
	document.getElementById('lokasilaka_content').style.visibility='hidden';
	document.form_rinci.nopenerimaan.disabled=false; 
	document.form_rinci.nofaktur.disabled=false;
	document.form_rinci.diskon.disabled=false;
	document.form_rinci.tagihanpenerimaan.disabled=false;
	document.form_rinci.tagihanfaktur.disabled=false; 
	document.form_rinci.tanggalfaktur.disabled=false;
	document.form_rinci.tanggaljatuhtempo.disabled=false; 
	document.form_rinci.totalbelumppn.disabled=false;
}

function carinofaktur(){
	kodemapingrs=document.form.kodemapingrs.value;
	$.fancybox({
		'href'			:'trans_/serahterimapekerjaan/carinofaktur.php?kodemapingrs='+kodemapingrs,
		'overlayOpacity':0,
		'opacity'		: true,
		'transitionIn'	: 'elastic',
		'type'			: 'ajax'
	});
}

function pilihfakturpenerimaan(nopenerimaan,nofaktur,diskon,total,tanggalfaktur,tgljatuhtempo,diskon,totalbelumppn,kodeidrinci){
	$.get("trans_/serahterimapekerjaan/caribebaspajak.php",{nopenerimaan:nopenerimaan},
		function(result){ 
			var update = new Array();
			update = result.split('|');
			if(result.indexOf('|' != -1)) { 
				if(update[0]=="OK"){  
					document.form_rinci.nopenerimaan.value=update[1]; 
					document.form_rinci.nofaktur.value=update[2]; 
					//document.form_rinci.satuan.value=satuan;
					document.form_rinci.diskon.value=update[7];
					document.form_rinci.tagihanpenerimaan.value=update[10];
					document.form_rinci.tagihanfaktur.value=update[10]; 
					document.form_rinci.tanggalfaktur.value=update[5];
					document.form_rinci.tanggaljatuhtempo.value=update[6];
					document.form_rinci.totalbelumppn.value=update[8];
				}else{
					document.form_rinci.nopenerimaan.value=nopenerimaan; 
					document.form_rinci.nofaktur.value=nofaktur; 
					//document.form_rinci.satuan.value=satuan;
					document.form_rinci.diskon.value=diskon;
					document.form_rinci.tagihanpenerimaan.value=total;
					document.form_rinci.tagihanfaktur.value=total; 
					document.form_rinci.tanggalfaktur.value=tanggalfaktur;
					document.form_rinci.tanggaljatuhtempo.value=tgljatuhtempo;
					document.form_rinci.totalbelumppn.value=totalbelumppn;
				}
			}
		}
	);
	$.fancybox.close();
}

function hapusHeader(noserahterimapekerjaan,nokontrak){  
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
				$.get("trans_/serahterimapekerjaan/hapus_heder.php",{noserahterimapekerjaan:noserahterimapekerjaan,nokontrak:nokontrak},
					function(result){ 
						var update = new Array();
						update = result.split('|');
						if(result.indexOf('|' != -1)) { 
							if(update[0]=="OK"){  
								swal("OK..!!", "DATA SUDAH TERHAPUS...", "success");
								dataserahterimah();
							}else{
								swal("Gagal..!!!", result, "error");
							}
						}
					}
				);
			}
	});
	
}

function simpanserahterima50(){
    
	noserahterimapekerjaan=document.form.noserahterimapekerjaan.value; 
	nokontrak=document.form.nokontrak.value; 
	kodepihakketiga=document.form.kodepihakketiga.value;
	namaperusahaan=document.form.namaperusahaan.value;
	kodemapingrs=document.form.kodemapingrs.value;
	namasuplier=document.form.namasuplier.value; 
	tglmulaikontrak=document.form.tglmulaikontrak.value; 
	tglakhirkontrak=document.form.tglakhirkontrak.value;
	tgltrans=document.form.tgltrans.value;
	kodepptk=document.form.kodepptk.value;	
	namapptk=document.form.namapptk.value; 
	program=document.form.program.value;
	kegiatan=document.form.kegiatan.value; 
	kodekegiatanblud=document.form.kodekegiatanblud.value;
	kegiatanblud=document.form.kegiatanblud.value;
	nilaikontrak=document.form.nilaikontrak.value;

	koderek50=document.form50.kode50.value; 
	uraianpekerjaan=document.form50.uraian50.value;	
		
	if(namaperusahaan==''){
		swal("Gagal..!!!", "PERUSAHAAN TIDAK BOLEH KOSONG....!!!", "error");
	}else if(namapptk==''){
		swal("Gagal..!!!", "PPTK TIDAK BOLEH KOSONG ATAU PPTK BELUM TERDAFTAR....!!!", "error");
	}else if(program==''){
		swal("Gagal..!!!", "PROGRAM TIDAK BOLEH KOSONG....!!!", "error");
	}else if(kegiatan==''){
		swal("Gagal..!!!", "KEGIATAN TIDAK BOLEH KOSONG ATAU USULAN BELUM TERDAFTAR....!!!", "error");
	}else if(kodekegiatanblud==''){
		swal("Gagal..!!!", "KODE KEGIATAN BLUD TIDAK BOLEH KOSONG....!!!", "error");
	}else if(kegiatanblud==''){
		swal("Gagal..!!!", "KEGIATAN BLUD TIDAK BOLEH KOSONG....!!!", "error");
	}else if(nilaikontrak==''){
		swal("Gagal..!!!", "NILAI KONTRAK TIDAK BOLEH KOSONG....!!!", "error");
	}else if(nilaikontrak==0.00){
		swal("Gagal..!!!", "NILAI KONTRAK TIDAK BOLEH 0 ....!!!", "error");
	}else if(koderek50==''){
		swal("Gagal..!!!", "KODE REKENING 50 TIDAK BOLEH KOSONG....!!!", "error");
	}else if(uraianpekerjaan==''){
		swal("Gagal..!!!", "URAIAN REKENING 50 TIDAK BOLEH KOSONG ATAU PPTK BELUM TERDAFTAR....!!!", "error");
	}else{
		clearrinci50();
		$.get('trans_/serahterimapekerjaan/simpanserahterima50.php',{noserahterimapekerjaan:noserahterimapekerjaan,
		nokontrak:nokontrak,
		kodepihakketiga:kodepihakketiga,
		namaperusahaan:namaperusahaan,
		kodemapingrs:kodemapingrs,
		namasuplier:namasuplier,
		tglmulaikontrak:tglmulaikontrak,
		tglakhirkontrak:tglakhirkontrak,
		kodepptk:kodepptk,
		namapptk:namapptk,
		tgltrans:tgltrans,
		program:program,
		kegiatan:kegiatan,
		kodekegiatanblud:kodekegiatanblud,
		kegiatanblud:kegiatanblud,
		koderek50:koderek50,
		uraianpekerjaan:uraianpekerjaan,
		nilaikontrak:nilaikontrak,
		},
			function(result){ 
				var update = new Array();
				update = result.split('|'); 
				if(result.indexOf('|' != -1)) { 
					if(update[0]=="OK"){ 
						swal("OK..!!", "DATA SUDAH DISIMPAN...", "success");
						document.form.noserahterimapekerjaan.value=update[1];
						gridrinci50(update[1]);
						mati();
					}else{
						swal("Gagal..!!!", result, "error");
					}
				}
			}
		);  
	}
}

function clearrinci50(){
	document.form50.kode50.value=''; 
	document.form50.uraian50.value='';
}

function view_detail_rinci_faktur(nopenerimaan){ 
	$.fancybox({
		'href'			:'trans_/serahterimapekerjaan/view_detail_rinci.php?nopenerimaan='+nopenerimaan,
		'overlayOpacity':0,
		'opacity'		: true,
		'transitionIn'	: 'elastic',
		'type'			: 'ajax'
	});
}

function carirekening50(){
	kodekegiatanblud=document.form.kodekegiatanblud.value;
	$.fancybox({
		'href'			:'trans_/serahterimapekerjaan/carirekening50.php?kodekegiatanblud='+kodekegiatanblud,
		'overlayOpacity':0,
		'opacity'		: true,
		'transitionIn'	: 'elastic',
		'type'			: 'ajax'
	});
}

function gridrinci50(noserahterimapekerjaan){ 
	jfloading("grid_50");
	$.get("trans_/serahterimapekerjaan/gridrinci50.php",{noserahterimapekerjaan:noserahterimapekerjaan},
		function(result){ 
			$("#grid_50").html(result); 
			jfdata_table(); 
		});
}

function hapus_rekekning50(id,noserahterimapekerjaan,kodeblud){ 
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
				$.get("trans_/serahterimapekerjaan/hapus_rekekning50.php",{id:id,noserahterimapekerjaan:noserahterimapekerjaan,kodeblud:kodeblud},
					function(result){  
						var update = new Array();
						update = result.split('|');
						if(result.indexOf('|' != -1)) { 
							if(update[0]=="OK"){  
								swal("OK..!!", "DATA SUDAH TERHAPUS...", "success");
								gridrinci50(noserahterimapekerjaan);
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