function dataperioritasperubahan(){
	jfloading("sub_konten");
	$.get("trans_/pergeseran/perubahanrincianbelanja/datapenentuanperioritas.php",
		function(result){
			$("#sub_konten").html(result);
			jfdata_table(); 
		}
	);
}

function formpenentuanperioritas(notrans,kodekegiatanblud){
	jfloading("sub_konten");
	$.get("trans_/pergeseran/perubahanrincianbelanja/formgrid_perubahan_rincian_belanja.php",{notrans:notrans},
		function(result){
			$("#sub_konten").html(result);
			gridrinci(notrans,kodekegiatanblud);
			if(notrans != undefined){  
				matix(); 
			}
			fungsikomplet(); 
			$("#usulan").autocomplete({
				serviceUrl:'trans_/pergeseran/perubahanrincianbelanja/autobyusulanprioritas.php?kodekegiatan='+$("#kodekegiatan").val(),
				type: "GET",
					onSelect: function (suggestion) {
						$('#usulan').val(suggestion.usulan);
						$('#volume').val(suggestion.volume);
						$('#harga').val(suggestion.harga);
						$('#nilai').val(suggestion.nilai);
						$('#nousulan').val(suggestion.nousulan);
						$('#satuan').val(suggestion.satuan);
						
						document.form_rinci.uraianrek108.focus();
					}
					
			});
		}
	);
}

async function gridrinci(notrans,kodekegiatanblud){ 
	jfloading("grid_nilai");
	await $.get("trans_/pergeseran/perubahanrincianbelanja/gridrinci.php",{notrans:notrans,kodekegiatanblud:kodekegiatanblud},
		function(result){ 
			$("#grid_nilai").html(result); 
			jfdata_table(); 
		}
	);
	
	kodekegiatan=document.form.kodekegiatan.value;
	await $.getJSON("trans_/pergeseran/perubahanrincianbelanja/getPaguByKegiatan.php",{kodekegiatan:kodekegiatan},function(result){ 
		warna = "";
		if(result.sisaPagu<1){
			warna = `style='font-color:red;'`;
		}
		$("#contentPagu").html(`
			<b ${warna}>
				<br>PAGU AWAL : ${result.paguawal}
				<br>TOTAL RINCIAN PAGU : ${result.pagurinci}
				<br>SISA: ${result.sisa}
				<br>
			</b>
		`);
	});	 
}

function edit_usulan(id,notrans,usulan,volume,satuan,harga,pagu,koderek50,idpp,nousulan,koderek108,uraian108,uraian50){ 	 alert(uraian50)	
	document.form_rincix.satuan.value=satuan;
	document.form_rincix.usulan.value=usulan;
	document.form_rincix.nousulan.value=nousulan; 
	document.form_rincix.volume.value=volume;
	document.form_rincix.harga.value=harga;
	//document.form_rincix.nilai.value=pagu;
	document.form_rincix.koderek108.value=koderek108; 
	document.form_rincix.uraianrek108.value=uraian108; 
	document.form_rincix.koderek50.value=koderek50;
	document.form_rincix.uraianrek50.value=uraian50;
	document.form_rincix.idpp.value=idpp;
	//document.form_rincix.belanja.value=totalbelanja;
	document.form_rincix.totalanggaran.value=pagu;
	
	document.form_rincix.satuan.disabled=true;
	document.form_rincix.usulan.disabled=true;
	document.form_rincix.nousulan.disabled=true; 
	document.form_rincix.volume.disabled=true;
	document.form_rincix.harga.disabled=true;
	document.form_rincix.nilai.disabled=true;
	document.form_rincix.koderek108.disabled=true;
	document.form_rincix.uraianrek108.disabled=true; 
	document.form_rincix.koderek50.disabled=true;
	document.form_rincix.uraianrek50.disabled=true;
	document.form_rincix.idpp.disabled=true;
	
	document.getElementById('carirekening108').style.visibility='hidden';
	document.getElementById('carirekening50').style.visibility='hidden';
}

function hasilbaru(){  
	
	volumebaru=document.form_rincix.volumebaru.value; 
	hargabaru=document.form_rincix.hargabaru.value;
	$.get("trans_/pergeseran/perubahanrincianbelanja/hasilbaru.php",{volumebaru:volumebaru,hargabaru:hargabaru},function(result){  
		var update = new Array(); 
		update = result.split('|'); 
		if(result.indexOf('|' != -1)) {
			document.form_rincix.totalbaru.value=update[0];
			//document.form_rincix.selisih.value=update[1];
		}
	});
}

function selisih(){
	//document.form_rinci.totalbaru.value=document.form_rinci.volumebaru.value*document.form_rinci.hargabaru.value;
	document.form_rinci.selisih.value=document.form_rinci.totalbaru.value-(document.form_rinci.harga.value*document.form_rinci.volume.value);
}

function simpanperubahanrincianbelanja(){ 
    
	notrans=document.form.notrans.value; 
	noperubahan=document.form.noperubahan.value; 
	kodebidang=document.form.kodebidang.value;
	namabidang=document.form.namabidang.value;
	kodepptk=document.form.kodepptk.value;
	pptk=document.form.pptk.value;
	kodekegiatan=document.form.kodekegiatan.value;
	kegiatan=document.form.kegiatan.value;
		
	usulan=document.form_rincix.usulan.value; 
	nousulan=document.form_rincix.nousulan.value; 
	volume=document.form_rincix.volume.value;
	harga=document.form_rincix.harga.value;
	//nilai=document.form_rincix.nilai.value;
	volumebaru=document.form_rincix.volumebaru.value;
	hargabaru=document.form_rincix.hargabaru.value;
	totalbaru=document.form_rincix.totalbaru.value; 
	//selisih=document.form_rincix.selisih.value;
	koderek108=document.form_rincix.koderek108.value;
	uraianrek108=document.form_rincix.uraianrek108.value; 
	koderek50=document.form_rincix.koderek50.value;
	uraianrek50=document.form_rincix.uraianrek50.value;
	idpp=document.form_rincix.idpp.value;
	satuan=document.form_rincix.satuan.value;
	//saldopagu=document.form_rincix.saldopagu.value;
	//operator=document.form_rincix.operator.value; 
	tglperubahan=document.form_rincix.tglperubahan.value;
	//belanja=document.form_rincix.belanja.value;
	totalanggaran=document.form_rincix.totalanggaran.value;
		
	if(usulan==''){
		swal("Gagal..!!!", "USULAN TIDAK BOLEH KOSONG ATAU USULAN BELUM TERDAFTAR....!!!", "error");
	}else if(satuan==''){
		swal("Gagal..!!!", "SATUAN TIDAK BOLEH KOSONG ATAU USULAN BELUM TERDAFTAR....!!!", "error");
	// }else if(saldopagu==''){
		// swal("Gagal..!!!", "SALDO TIDAK BOLEH KOSONG ATAU USULAN BELUM TERDAFTAR....!!!", "error");
	// }else if(koderek50==''){
		swal("Gagal..!!!", "REKENING 50 TIDAK BOLEH KOSONG ATAU USULAN BELUM TERDAFTAR....!!!", "error");
	}else if(harga==''){
		swal("Gagal..!!!", "HARGA TIDAK BOLEH KOSONG....!!!", "error");
	}else if(volumebaru==''){
		swal("Gagal..!!!", "VOLUME BARU TIDAK BOLEH KOSONG....!!!", "error");
	}else if(hargabaru==''){
		swal("Gagal..!!!", "HARGA BARU TIDAK BOLEH KOSONG....!!!", "error");
	}else if(totalbaru==''){
		swal("Gagal..!!!", "TOTAL BARU TIDAK BOLEH KOSONG....!!!", "error");
//	}else if(selisih==''){
//		swal("Gagal..!!!", "SELISIH TIDAK BOLEH KOSONG....!!!", "error");
	// }else if(operator==''){
		// swal("Gagal..!!!", "OPERATOR TIDAK BOLEH KOSONG....!!!", "error");
	}else{
		bersihkanform();
		$.get('trans_/pergeseran/perubahanrincianbelanja/simpan.php',{notrans:notrans,noperubahan:noperubahan,tglperubahan:tglperubahan,usulan:usulan,volume:volume,harga:harga,koderek108:koderek108,uraianrek108:uraianrek108,
		koderek50:koderek50,uraianrek50:uraianrek50,nousulan:nousulan,satuan:satuan,volumebaru:volumebaru,hargabaru:hargabaru,totalbaru:totalbaru,kodebidang:kodebidang,
		namabidang:namabidang,kodepptk:kodepptk,pptk:pptk,kodekegiatan:kodekegiatan,kegiatan:kegiatan,idpp:idpp,totalanggaran:totalanggaran},
			function(result){ 
				var update = new Array();
				update = result.split('|'); 
				if(result.indexOf('|' != -1)) { 
					if(update[0]=="OK"){ 
						swal("OK..!!", "DATA SUDAH DISIMPAN...", "success");
						gridrinci(notrans);
						$.fancybox.close();
					}else{
						swal("Gagal..!!!", result, "error");
					}
				}
			}
		);  
	}
}

function datapergeseranpagu(){
	jfloading("sub_konten");
	$.get("trans_/pergeseran/perubahanrincianbelanja/datapergeseranpagu.php",
		function(result){
			$("#sub_konten").html(result);
			jfdata_table(); 
		}
	);
}

function datahistorypergeseranpagu(){
	jfloading("sub_konten");
	$.get("trans_/pergeseran/perubahanrincianbelanja/datahistorypergeseranpagu.php",
		function(result){
			$("#sub_konten").html(result);
			jfdata_table(); 
		}
	);
}

function formpenentuanperioritasx(noperubahan,notrans){
	jfloading("sub_konten");
	$.get("trans_/pergeseran/perubahanrincianbelanja/formpenentuanperioritasx.php",{noperubahan:noperubahan,notrans:notrans},
		function(result){
			$("#sub_konten").html(result);
			gridrinciperubahan(noperubahan);
			if(notrans != undefined){  
				matix(); 
			}
		}
	);
}

async function gridrinciperubahan(noperubahan){ 
	jfloading("grid_nilai_perubahan");
	await $.get("trans_/pergeseran/perubahanrincianbelanja/gridrinciperubahan.php",{noperubahan:noperubahan},
		function(result){ 
			$("#grid_nilai_perubahan").html(result); 
			jfdata_table(); 
		}
	);
	
	//kodekegiatan=document.form.kodekegiatan.value;
	//await $.getJSON("trans_/pergeseran/perubahanrincianbelanja/getPaguByKegiatan.php",{kodekegiatan:kodekegiatan},function(result){ 
	//	warna = "";
	//	if(result.sisaPagu<1){
	//		warna = `style='font-color:red;'`;
	//	}
	//	$("#contentPagu").html(`
	//		<b ${warna}>
	//			<br>Pagu : ${result.paguRp}
	//			<br>Total Prioritas : ${result.totalPrioritasRp}
	//			<br>Sisa : ${result.sisaPaguPrioritasRp}
	//			<br>
	//		</b>
	//	`);
	//});	 
}

function kunci(id,notrans){
	//jfloading("sub_konten");
	$.get("trans_/pergeseran/perubahanrincianbelanja/kunci.php",{id:id},function(result){ 
			var update = new Array();
			update = result.split('|');
			if(result.indexOf('|' != -1)) { 
				if(update[0]=="OK"){  
					swal("OK..!!", "DATA SUDAH TERKUNCI...", "success");
					formpenentuanperioritas(notrans)
				}else{
					swal("Gagal..!!!", result, "error");
				}
			}
		}
	);
}

function bukakunci(id,notrans){
	//jfloading("sub_konten");
	$.get("trans_/pergeseran/perubahanrincianbelanja/bukakunci.php",{id:id},function(result){ 
			var update = new Array();
			update = result.split('|');
			if(result.indexOf('|' != -1)) { 
				if(update[0]=="OK"){  
					swal("OK..!!", "KUNCI SUDAH TERBUKA...", "success");
					formpenentuanperioritas(notrans)
				}else{
					swal("Gagal..!!!", result, "error");
				}
			}
		}
	);
}

function hapus_perubahan_rincianbelanja(id,idpp){  
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
				$.get("trans_/pergeseran/perubahanrincianbelanja/hapus_perubahan.php",{id:id,idpp:idpp},
					function(result){ 
						var update = new Array();
						update = result.split('|');
						if(result.indexOf('|' != -1)) { 
							if(update[0]=="OK"){  
								swal("OK..!!", "DATA SUDAH TERHAPUS...", "success");
								dataperioritasperubahan();
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

function carirekening108(){ 
	$.fancybox({
		'href'			: 'trans_/pergeseran/perubahanrincianbelanja/carirekening108.php',
		'overlayOpacity': 0,
		'opacity'		: true,
		'transitionIn'	: 'elastic',
		'closeBtn'		: true,
		'openEffect'	: 'elastic',
		'type'			: 'ajax'
	});
}

function closeMessage(){
	$.fancybox.close();
}

function pilihrekening108(kode,uraian){ 
	document.form_rincix.koderek108.value=kode;
	document.form_rincix.uraianrek108.value=uraian;
	closeMessage();
}

function carirekening50(){ 
	$.fancybox({
		'href'			: 'trans_/pergeseran/perubahanrincianbelanja/carirekening50.php',
		'overlayOpacity': 0,
		'opacity'		: true,
		'transitionIn'	: 'elastic',
		'closeBtn'		: true,
		'openEffect'	: 'elastic',
		'type'			: 'ajax'
	});
}

function pilihrekening50(kode,uraian){ 
	document.form_rincix.koderek50.value=kode;
	document.form_rincix.uraianrek50.value=uraian;
	closeMessage();
}

function bersihkanform(){
	document.form_rincix.usulan.value='';
	document.form_rincix.nousulan.value=''; 
	document.form_rincix.volume.value='0.00';
	document.form_rincix.harga.value='0.00';
	document.form_rincix.totalanggaran.value='0.00';
	document.form_rincix.volumebaru.value='0.00';
	document.form_rincix.hargabaru.value='0.00';
	document.form_rincix.totalbaru.value='0.00'; 
	//document.form_rincix.selisih.value='';
	document.form_rincix.koderek108.value='';
	document.form_rincix.uraianrek108.value=''; 
	document.form_rincix.koderek50.value='';
	document.form_rincix.uraianrek50.value='';
	document.form_rincix.idpp.value='';
	document.form_rincix.satuan.value='';
	//document.form_rincix.operator.value='';
}

