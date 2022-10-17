function dataperioritasperubahan(){
	jfloading("sub_konten");
	$.get("trans_/perubahanpagubelanjarinci/datapenentuanperioritas.php",
		function(result){
			$("#sub_konten").html(result);
			jfdata_table(); 
		}
	);
}

function formpenentuanperioritas(notrans){
	jfloading("sub_konten");
	$.get("trans_/perubahanpagubelanjarinci/formperubahanpagubelanjarincis.php",{notrans,notrans},
		function(result){
			$("#sub_konten").html(result);
			$( '#volume' ).mask('000,000,000,000.00', {reverse: true});
			$( '#harga' ).mask('000,000,000,000.00', {reverse: true});
			gridriperubahan(notrans);
		}
	);
}


async function gridriperubahan(noperubahan){ 
	jfloading("grid_nilai");
	await $.get("trans_/perubahanpagubelanjarinci/gridriperubahan.php",{noperubahan:noperubahan},
		function(result){
			$("#grid_nilai").html(result); 
			jfdata_table(); 
		}
	);
	
	kodekegiatan=document.form.kodekegiatan.value;
	await $.getJSON("trans_/perubahanpagubelanjarinci/getPaguByKegiatan.php",{kodekegiatan:kodekegiatan},function(result){ 
		warna = "";
		if(result.sisaPagu<1){
			warna = `style='font-color:red;'`;
		}
		$("#contentPagu").html(`
			<b ${warna}>
				<br>Pagu : ${result.paguRp}
				<br>Total Usulan : ${result.totalUsulanRp}
				<br>Sisa Pagu : ${result.sisaPaguRp}
				<br>Perubahan : ${result.perubahan}
				<br>
			</b>
		`);
	});	 
}

function cari108(){
	$.fancybox({
		'href'			:'trans_/perubahanpagubelanjarinci/cari108.php',
		'overlayOpacity':0,
		'opacity'		: true,
		'transitionIn'	: 'elastic',
		'type'			: 'ajax'
	});
}

function pilih108(kode108,uraian){ 
	
	document.form_rinci.uraianrek108.value=uraian;
	document.form_rinci.koderek108.value=kode108;
	$.fancybox.close();
}

function cari50(){
	$.fancybox({
		'href'			:'trans_/perubahanpagubelanjarinci/cari50.php',
		'overlayOpacity':0,
		'opacity'		: true,
		'transitionIn'	: 'elastic',
		'type'			: 'ajax'
	});
}

function pilih50(kode50,uraian50){
	
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
		$.get('trans_/perubahanpagubelanjarinci/simpan.php',{noperubahan:noperubahan,tglperubahan:tglperubahan,notrans:notrans,kodebidang:kodebidang,kodepptk:kodepptk,kodekegiatan:kodekegiatan,namabidang:namabidang,pptk:pptk,
		tgltrans:tgltrans,kegiatan:kegiatan,ruangyangusul:ruangyangusul,usulan:usulan,volume:volume,harga:harga,nilai:nilai,koderek108:koderek108,uraianrek108:uraianrek108,
		koderek50:koderek50,uraianrek50:uraianrek50,nousulan:nousulan,satuan:satuan},
			function(result){ 
				var update = new Array();
				update = result.split('|'); 
				if(result.indexOf('|' != -1)) { 
					if(update[0]=="OK"){ 
						swal("OK..!!", "DATA SUDAH DISIMPAN...", "success");
						document.form.noperubahan.value=update[1];
						gridriperubahan(update[1]);
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
	$.get("trans_/perubahanpagubelanjarinci/dataperubahanpagurinci.php",
		function(result){
			$("#sub_konten").html(result);
			jfdata_table(); 
		}
	);
}