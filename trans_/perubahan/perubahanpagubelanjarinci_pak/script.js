function dataperioritasperubahan_revisi1(){
	jfloading("sub_konten");
	$.get("trans_/perubahan/perubahanpagubelanjarinci_pak/datapenentuanperioritas.php",
		function(result){
			$("#sub_konten").html(result);
			jfdata_table(); 
		}
	);
}

function formpenentuanperioritas(notrans){
	jfloading("sub_konten");
	$.get("trans_/perubahan/perubahanpagubelanjarinci_pak/formperubahanpagubelanjarincis.php",{notrans,notrans},
		function(result){
			$("#sub_konten").html(result);
			$( '#volume' ).mask('000,000,000,000.00', {reverse: true});
			$( '#harga' ).mask('000,000,000,000.00', {reverse: true});
			gridriperubahan(notrans);
		}
	);
}


async function gridriperubahan(notrans){ 
	jfloading("grid_nilai");
	await $.get("trans_/perubahan/perubahanpagubelanjarinci_pak/gridriperubahan.php",{notrans:notrans},
		function(result){ 
			$("#grid_nilai").html(result); 
			jfdata_table(); 
		}
	);
	
	kodekegiatan=document.form.kodekegiatan.value;
	await $.getJSON("trans_/perubahan/perubahanpagubelanjarinci_pak/getPaguByKegiatan.php",{kodekegiatan:kodekegiatan},function(result){ 
		warna = "";
		if(result.sisaPagu<1){
			warna = `style='font-color:red;'`;
		}
		$("#contentPagu").html(`
			<b ${warna}>
				<br>Pagu Awal : ${result.paguawalRp}
				<br>Pagu Setelah Perubahan : ${result.paguRp}
				<br>Pagu Setelah P.A.K : ${result.pagupakRp}
				<br>Total Prioritas : ${result.totalPrioritasrp}
				<br>Sisa : ${result.sisaPagurp}
				<br>
			</b>
		`);
	});
}

function cari108(){
	$.fancybox({
		'href'			:'trans_/perubahan/perubahanpagubelanjarinci_pak/cari108.php',
		'overlayOpacity':0,
		'opacity'		: true,
		'transitionIn'	: 'elastic',
		'type'			: 'ajax'
	});
}

function pilihrekening108(kode108,uraian){ 
	
	document.form_rinci.uraianrek108.value=uraian;
	document.form_rinci.koderek108.value=kode108;
	$.fancybox.close();
}

function cari50(){
	$.fancybox({
		'href'			:'trans_/perubahan/perubahanpagubelanjarinci_pak/cari50.php',
		'overlayOpacity':0,
		'opacity'		: true,
		'transitionIn'	: 'elastic',
		'type'			: 'ajax'
	});
}

function pilihrekening50(kode50,uraian50){
	
	document.form_rinci.koderek50.value=kode50;
	document.form_rinci.uraianrek50.value=uraian50;
	$.fancybox.close();
}

function simpanperubahanpagubelanja(){ 
    
	notrans=document.form.notrans.value;
	noperubahan=document.form.noperubahan.value;
	tglperubahan=document.form.tglperubahan.value;
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
	//jumlahacc=document.form_rinci.jumlahacc.value;
	satuan=document.form_rinci.satuan.value;
	status_x=document.form_rinci.status_x.value;
		
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
		clearrincix();
		$.get('trans_/perubahan/perubahanpagubelanjarinci_pak/simpan.php',{noperubahan:noperubahan,tglperubahan:tglperubahan,notrans:notrans,kodebidang:kodebidang,kodepptk:kodepptk,kodekegiatan:kodekegiatan,namabidang:namabidang,pptk:pptk,
		tgltrans:tgltrans,kegiatan:kegiatan,ruangyangusul:ruangyangusul,usulan:usulan,volume:volume,harga:harga,nilai:nilai,koderek108:koderek108,uraianrek108:uraianrek108,
		koderek50:koderek50,uraianrek50:uraianrek50,nousulan:nousulan,satuan:satuan,status_x:status_x},
			function(result){ 
				var update = new Array();
				update = result.split('|'); 
				if(result.indexOf('|' != -1)) { 
					if(update[0]=="OK"){ 
						swal("OK..!!", "DATA SUDAH DISIMPAN...", "success");
						//document.form.noperubahan.value=update[1];
						gridriperubahan(notrans);
					}else{
						swal("Gagal..!!!", result, "error");
					}
				}
			}
		);  
	}
}

function simpanperubahanpagubelanjax(){ 
    
	notrans=document.form.notrans.value;
	noperubahan=document.form.noperubahan.value;
	tglperubahan=document.form.tglperubahan.value;
	kodebidang=document.form.kodebidang.value; 
	kodepptk=document.form.kodepptk.value; 
	kodekegiatan=document.form.kodekegiatan.value; 
	namabidang=document.form.namabidang.value; 
	pptk=document.form.pptk.value; 
	tgltrans=document.form.tgltrans.value;
	kegiatan=document.form.kegiatan.value;
	ruangyangusul=document.form.ruangyangusul.value; 
	
	
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
		clearrincix();
		$.get('trans_/perubahan/perubahanpagubelanjarinci_pak/simpan.php',{noperubahan:noperubahan,tglperubahan:tglperubahan,notrans:notrans,kodebidang:kodebidang,kodepptk:kodepptk,kodekegiatan:kodekegiatan,namabidang:namabidang,pptk:pptk,
		tgltrans:tgltrans,kegiatan:kegiatan,ruangyangusul:ruangyangusul,usulan:usulan,volume:volume,harga:harga,nilai:nilai,koderek108:koderek108,uraianrek108:uraianrek108,
		koderek50:koderek50,uraianrek50:uraianrek50,nousulan:nousulan,satuan:satuan,idpp:idpp,hargabaru:hargabaru,volumebaru:volumebaru,status_x:status_x},
			function(result){ 
				var update = new Array();
				update = result.split('|'); 
				if(result.indexOf('|' != -1)) { 
					if(update[0]=="OK"){ 
						swal("OK..!!", "DATA SUDAH DISIMPAN...", "success");
						//document.form.noperubahan.value=update[1];
						gridriperubahan(notrans);
						$.fancybox.close();
					}else{
						swal("Gagal..!!!", result, "error");
					}
				}
			}
		);  
	}
}

function clearrincix(){
	document.form_rinci.usulan.value=''; 
	document.form_rinci.nousulan.value='';
	document.form_rinci.volume.value='';
	document.form_rinci.harga.value='';
	document.form_rinci.nilai.value=''; 
	document.form_rinci.koderek108.value='';
	document.form_rinci.uraianrek108.value='';
	document.form_rinci.koderek50.value='';
	document.form_rinci.uraianrek50.value='';
	//jumlahacc=document.form_rinci.jumlahacc.value;
	document.form_rinci.satuan.value=''; 
}

function dataperubahanpagurinci(){
	jfloading("sub_konten");
	$.get("trans_/perubahan/perubahanpagubelanjarinci_pak/dataperubahanpagurinci.php",
		function(result){
			$("#sub_konten").html(result);
			jfdata_table(); 
		}
	);
}

function edit_usulan(id,notrans,x){ 
	//notrans=document.form.nonpd.value; 
	$.fancybox({
		'href'			:'trans_/perubahan/perubahanpagubelanjarinci_pak/formgrid_perubahan_rincian_belanja.php?id='+id+'&notrans='+notrans+'&x='+x,
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
	$.get("trans_/pergeseran/perubahanrincianbelanja/hasilbaru.php",{volumebaru:volumebaru,hargabaru:hargabaru,nilai:nilai},function(result){  
		var update = new Array(); 
		update = result.split('|'); 
		if(result.indexOf('|' != -1)) { 
			document.form_rincix.totalbaru.value=update[0];
			document.form_rincix.selisih.value=update[1];
		}
	});
}