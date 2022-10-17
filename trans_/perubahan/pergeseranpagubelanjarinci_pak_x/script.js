function dataperioritasperubahan_revisi1_x(){
	jfloading("sub_konten");
	$.get("trans_/perubahan/pergeseranpagubelanjarinci_pak_x/datapenentuanperioritas.php",
		function(result){
			$("#sub_konten").html(result);
			jfdata_table(); 
		}
	);
}

function formpenentuanperioritas(notrans){
	jfloading("sub_konten");
	$.get("trans_/perubahan/pergeseranpagubelanjarinci_pak_x/formpenentuanperioritas.php",{notrans:notrans},
		function(result){
			$("#sub_konten").html(result);
			gridrinci(notrans);
			if(notrans != undefined){  
				matix(); 
			}
			fungsikomplet(); 
			$("#usulan").autocomplete({
				serviceUrl:'trans_/perubahan/pergeseranpagubelanjarinci_pak_x/autobyusulanprioritas.php?kodekegiatan='+$("#kodekegiatan").val(),
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

async function gridrinci(notrans){ 
	jfloading("grid_nilai");
	await $.get("trans_/perubahan/pergeseranpagubelanjarinci_pak_x/gridrinci.php",{notrans:notrans},
		function(result){ 
			$("#grid_nilai").html(result); 
			jfdata_table(); 
		}
	);
	
	kodekegiatan=document.form.kodekegiatan.value;
	await $.getJSON("trans_/perubahan/pergeseranpagubelanjarinci_pak_x/getPaguByKegiatan.php",{kodekegiatan:kodekegiatan},function(result){ 
		warna = "";
		if(result.sisaPagu<1){
			warna = `style='font-color:red;'`;
		}
		$("#contentPagu").html(`
			<b ${warna}>
				<br>Pagu Awal : ${result.paguawalRp}
				<br>Pagu Setelah Perubahan : ${result.paguRp}
				<br>Total Prioritas : ${result.totalPrioritasrp}
				<br>Sisa : ${result.sisaPagurp}
				<br>
			</b>
		`);
	});	 
}

function edit_usulan(id,notrans,x){ 
	//notrans=document.form.nonpd.value; 
	$.fancybox({
		'href'			:'trans_/perubahan/pergeseranpagubelanjarinci_pak_x/formgrid_perubahan_rincian_belanja.php?id='+id+'&notrans='+notrans+'&x='+x,
		'overlayOpacity':0,
		'opacity'		: true,
		'transitionIn'	: 'elastic',
		'type'			: 'ajax'
	});
}

function hasilbaru(){  
	
	volumebaru=document.form_rincix.volumebaru.value; 
	hargabaru=document.form_rincix.hargabaru.value;
	nilai=document.form_rincix.nilai.value;
	$.get("trans_/perubahan/pergeseranpagubelanjarinci_pak_x/hasilbaru.php",{volumebaru:volumebaru,hargabaru:hargabaru,nilai:nilai},function(result){  
		var update = new Array(); 
		update = result.split('|'); 
		if(result.indexOf('|' != -1)) { 
			document.form_rincix.totalbaru.value=update[0];
			document.form_rincix.selisih.value=update[1];
		}
	});
}

function selisih(){
	//document.form_rinci.totalbaru.value=document.form_rinci.volumebaru.value*document.form_rinci.hargabaru.value;
	document.form_rinci.selisih.value=document.form_rinci.totalbaru.value-(document.form_rinci.harga.value*document.form_rinci.volume.value);
}

function simpanperubahanpagubelanjax(){ 
    
	notrans=document.form2.notrans.value;
	noperubahan=document.form2.noperubahan.value;
	tglperubahan=document.form2.tglperubahan.value;
	kodebidang=document.form2.kodebidang.value; 
	kodepptk=document.form2.kodepptk.value; 
	kodekegiatan=document.form2.kodekegiatan.value; 
	namabidang=document.form2.namabidang.value; 
	pptk=document.form2.pptk.value; 
	tgltrans=document.form2.tgltrans.value;
	kegiatan=document.form2.kegiatan.value;
	ruangyangusul=document.form2.ruangyangusul.value; 
	
	
	usulan=document.form_rincix.usulan.value; 
	nousulan=document.form_rincix.nousulan.value;
	volume=document.form_rincix.volume.value;
	harga=document.form_rincix.harga.value; 
	nilai=document.form_rincix.nilai.value; 
	koderek108=document.form_rincix.koderek108.value;
	uraianrek108=document.form_rincix.uraianrek108.value; 
	koderek50=document.form_rincix.koderek50.value;
	uraianrek50=document.form_rincix.uraianrek50.value;
	idpp=document.form_rincix.idpp.value;
	satuan=document.form_rincix.satuan.value; 
	hargabaru=document.form_rincix.hargabaru.value;
	volumebaru=document.form_rincix.volumebaru.value;
	status_x=document.form_rincix.status_x.value; 
		
	if(kodebidang==''){
		swal("Gagal..!!!", "BAGIAN TIDAK BOLEH KOSONG ATAU BAGIAN BELUM TERDAFTAR....!!!", "error");
	}else if(kodepptk==''){
		swal("Gagal..!!!", "PPTK TIDAK BOLEH KOSONG ATAU PPTK BELUM TERDAFTAR....!!!", "error");
	}else if(tgltrans==''){
		swal("Gagal..!!!", "TANGGAL TIDAK BOLEH KOSONG....!!!", "error");
	}else if(ruangyangusul==''){
		swal("Gagal..!!!", "RUANG YANG MENGUSULKAN HARUS DIISI....!!!", "error");
	}else if(usulan==''){
		swal("Gagal..!!!", "USULAN TIDAK BOLEH KOSONG ATAU USULAN BELUM TERDAFTAR....!!!", "error");
	}else if(koderek50==''){
		swal("Gagal..!!!", "REKENING 50 TIDAK BOLEH KOSONG ATAU USULAN BELUM TERDAFTAR....!!!", "error");
	}else if(harga==''){
		swal("Gagal..!!!", "HARGA TIDAK BOLEH KOSONG....!!!", "error");
	}else if(kegiatan==''){
		swal("Gagal..!!!", "KEGIATAN TIDAK BOLEH KOSONG....!!!", "error");
	}else{
		//clearrincix();
		$.get('trans_/perubahan/pergeseranpagubelanjarinci_pak_x/simpan.php',{noperubahan:noperubahan,tglperubahan:tglperubahan,notrans:notrans,kodebidang:kodebidang,kodepptk:kodepptk,kodekegiatan:kodekegiatan,namabidang:namabidang,pptk:pptk,
		tgltrans:tgltrans,kegiatan:kegiatan,ruangyangusul:ruangyangusul,usulan:usulan,volume:volume,harga:harga,nilai:nilai,koderek108:koderek108,uraianrek108:uraianrek108,
		koderek50:koderek50,uraianrek50:uraianrek50,nousulan:nousulan,satuan:satuan,idpp:idpp,hargabaru:hargabaru,volumebaru:volumebaru,status_x:status_x},
			function(result){ 
				var update = new Array();
				update = result.split('|'); 
				if(result.indexOf('|' != -1)) { 
					if(update[0]=="OK"){ 
						swal("OK..!!", "DATA SUDAH DISIMPAN...", "success");
						//document.form.noperubahan.value=update[1];
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
	$.get("trans_/perubahan/pergeseranpagubelanjarinci_pak_x/datapergeseranpagu.php",
		function(result){
			$("#sub_konten").html(result);
			jfdata_table(); 
		}
	);
}

function datahistorypergeseranpagu(){
	jfloading("sub_konten");
	$.get("trans_/perubahan/pergeseranpagubelanjarinci_pak_x/datahistorypergeseranpagu.php",
		function(result){
			$("#sub_konten").html(result);
			jfdata_table(); 
		}
	);
}

function formpenentuanperioritasx(noperubahan,notrans){
	jfloading("sub_konten");
	$.get("trans_/perubahan/pergeseranpagubelanjarinci_pak_x/formpenentuanperioritasx.php",{noperubahan:noperubahan,notrans:notrans},
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
	await $.get("trans_/perubahan/pergeseranpagubelanjarinci_pak_x/gridrinciperubahan.php",{noperubahan:noperubahan},
		function(result){ 
			$("#grid_nilai_perubahan").html(result); 
			jfdata_table(); 
		}
	);
	
	//kodekegiatan=document.form.kodekegiatan.value;
	//await $.getJSON("trans_/perubahan/pergeseranpagubelanjarinci_pak_x/getPaguByKegiatan.php",{kodekegiatan:kodekegiatan},function(result){ 
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
	$.get("trans_/perubahan/pergeseranpagubelanjarinci_pak_x/kunci.php",{id:id},function(result){ 
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
	$.get("trans_/perubahan/pergeseranpagubelanjarinci_pak_x/bukakunci.php",{id:id},function(result){ 
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
				$.get("trans_/perubahan/pergeseranpagubelanjarinci_pak_x/hapus_perubahan.php",{id:id,idpp:idpp},
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

