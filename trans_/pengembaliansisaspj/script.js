function formpengembaliansisaspjpanjar(nopengembaliansisapanjar){ 
	jfloading("sub_konten");
	$.get("trans_/pengembaliansisaspj/formpengembaliansisaspjpanjar.php",{nopengembaliansisapanjar:nopengembaliansisapanjar},
		function(result){
			$("#sub_konten").html(result);
			fungsikomplet();
			gridrinci(nopengembaliansisapanjar);
			if(nopengembaliansisapanjar != undefined){
				mati();
				document.form_rinci.rincianbelanja.focus();
			}
			
			koderek50=document.form_rinci.koderek50.value;
			kodekegiatanblud=document.form.kodekegiatanblud.value;
			$("#rincianbelanja").autocomplete({
			serviceUrl:'trans_/pengembaliansisaspj/autobyrincianbelanja.php?kodekegiatanblud='+kodekegiatanblud,
			type: "GET",
					onSelect: function (suggestions) {
						$('#rincianbelanja').val(suggestions.rincianbelanja50);
						$('#koderek50').val(suggestions.koderek50);
						document.form_rinci.itembelanja.focus();
						
						
						$("#itembelanja").autocomplete({
							serviceUrl:'trans_/pengembaliansisaspj/autobyitembelanja.php?koderek50='+suggestions.koderek50+'&kodekegiatanblud='+kodekegiatanblud,
							type: "GET",
								onSelect: function (suggestions) {
									$('#itembelanja').val(suggestions.itembelanja);
									$('#volume').val(suggestions.volume);
									$('#satuan').val(suggestions.satuan);
									$('#harga').val(suggestions.harga);
									$('#nopp').val(suggestions.nopp);
									$('#nousulan').val(suggestions.nousulan);
									$('#jumlahanggaran').val(suggestions.total);
									$('#idspj').val(suggestions.id);
									$('#jumlahanggaran').val(suggestions.jumlahanggaran);
									$('#jumlahpenerimaanpanjar').val(suggestions.jumlahpenerimaanpanjar);
									$('#jumlahbelanjapanjar').val(suggestions.jumlahbelanjapanjar);
									$('#sisapanjar').val(suggestions.sisapanjar);
									//document.form_rinci.jumlahbelanjapanjar.focus();
								}
						});							
					}
			});
		}
	);
}

function fungsikomplet(){  
	$("#nospjpanjar").autocomplete({
		serviceUrl:'trans_/pengembaliansisaspj/autobynospjpanjar.php',
		type: "GET",
		    onSelect: function (suggestion) {
		    	$('#nospjpanjar').val(suggestion.nospjpanjar);
				$('#kodepptk').val(suggestion.kodepptk);
				$('#pptk').val(suggestion.namapptk);
				$('#program').val(suggestion.program);
				$('#kegiatan').val(suggestion.kegiatan);
				$('#kodekegiatanblud').val(suggestion.kodekegiatanblud);
				$('#kegiatanblud').val(suggestion.kegiatanblud);
				
				$("#rincianbelanja").autocomplete({
				serviceUrl:'trans_/pengembaliansisaspj/autobyrincianbelanja.php?kodekegiatanblud='+suggestion.kodekegiatanblud,
				type: "GET",
						onSelect: function (suggestions) {
							$('#rincianbelanja').val(suggestions.rincianbelanja50);
							$('#koderek50').val(suggestions.koderek50);
							document.form_rinci.itembelanja.focus();
							
							$("#itembelanja").autocomplete({
								serviceUrl:'trans_/pengembaliansisaspj/autobyitembelanja.php?koderek50='+suggestions.koderek50+'&kodekegiatanblud='+suggestion.kodekegiatanblud,
								type: "GET",
									onSelect: function (suggestions) {
										$('#itembelanja').val(suggestions.itembelanja);
										$('#volume').val(suggestions.volume);
										$('#satuan').val(suggestions.satuan);
										$('#harga').val(suggestions.harga);
										$('#nopp').val(suggestions.nopp);
										$('#nousulan').val(suggestions.nousulan);
										$('#jumlahanggaran').val(suggestions.total);
										$('#idspj').val(suggestions.id);
										$('#jumlahanggaran').val(suggestions.jumlahanggaran);
										$('#jumlahpenerimaanpanjar').val(suggestions.jumlahpenerimaanpanjar);
										$('#jumlahbelanjapanjar').val(suggestions.jumlahbelanjapanjar);
										$('#sisapanjar').val(suggestions.sisapanjar);
										//document.form_rinci.jumlahbelanjapanjar.focus();
									}
							});							
						}
				});
		}
	});
}

function simpanpengembaliansisapanjar(){ 
    
	kodepptk=document.form.kodepptk.value;
	kodekegiatanblud=document.form.kodekegiatanblud.value;
	nopengembaliansisapanjar=document.form.nopengembaliansisapanjar.value;
	tglpengembaliansisapanjar=document.form.tglpengembaliansisapanjar.value;
	nospjpanjar=document.form.nospjpanjar.value;
	pptk=document.form.pptk.value;
	program=document.form.program.value;
	kegiatan=document.form.kegiatan.value;
	kegiatanblud=document.form.kegiatanblud.value;

	koderek50=document.form_rinci.koderek50.value;
	rincianbelanja=document.form_rinci.rincianbelanja.value;
	itembelanja=document.form_rinci.itembelanja.value;
	idspj=document.form_rinci.idspj.value; 
	nopp=document.form_rinci.nopp.value; 
	nousulan=document.form_rinci.nousulan.value; 
	volume=document.form_rinci.volume.value;
	satuan=document.form_rinci.satuan.value;
	harga=document.form_rinci.harga.value;
	jumlahanggaran=document.form_rinci.jumlahanggaran.value;
	jumlahpenerimaanpanjar=document.form_rinci.jumlahpenerimaanpanjar.value;
	jumlahbelanjapanjar=document.form_rinci.jumlahbelanjapanjar.value;
	sisapanjar=document.form_rinci.sisapanjar.value;
	nonpdpanjar=document.form_rinci.nonpdpanjar.value;
	
	if(pptk == ''){ 
		swal("Gagal..!!!", "PPTK KEGIATAN BELUM TERDAFTAR....!!!", "error");
	}else if(nospjpanjar==''){
		swal("Gagal..!!!", "NOTA PANJAR HARUS DI ISI..!!!", "error");
	}else if(program==''){
		swal("Gagal..!!!", "PROGRAM HARUS DI ISI..!!!", "error");
	}else if(kegiatan==''){
		swal("Gagal..!!!", "PROGRAM HARUS DI ISI..!!!", "error");
	}else if(kegiatanblud==''){
		swal("Gagal..!!!", "KEGIATAN BLUD HARUS DI ISI..!!!", "error");
	}else if(rincianbelanja==''){
		swal("Gagal..!!!", "RINCIAN BELANJA HARUS DI ISI..!!!", "error");
	}else if(itembelanja==''){
		swal("Gagal..!!!", "ITEM BELANJA HARUS DI ISI..!!!", "error");
	}else if(jumlahbelanjapanjar==''){
		swal("Gagal..!!!", "JUMLAH BELANJA PANJAR BLUD HARUS DI ISI..!!!", "error");
	}else if(sisapanjar==''){
		swal("Gagal..!!!", "SISA PANJAR HARUS DI ISI..!!!", "error");
	}else{
		clearrinci();
		$.get('trans_/pengembaliansisaspj/simpan.php',{kodepptk:kodepptk,
			kodekegiatanblud:kodekegiatanblud,
			nopengembaliansisapanjar:nopengembaliansisapanjar,
			tglpengembaliansisapanjar:tglpengembaliansisapanjar,
			nospjpanjar:nospjpanjar,
			pptk:pptk,
			program:program,
			kegiatan:kegiatan,
			kegiatanblud:kegiatanblud,
			koderek50:koderek50,
			rincianbelanja:rincianbelanja,
			itembelanja:itembelanja,
			idspj:idspj, 
			nopp:nopp, 
			nousulan:nousulan, 	
			volume:volume,
			satuan:satuan,
			harga:harga,
			jumlahanggaran:jumlahanggaran,
			jumlahpenerimaanpanjar:jumlahpenerimaanpanjar,
			jumlahbelanjapanjar:jumlahbelanjapanjar,
			sisapanjar:sisapanjar,nonpdpanjar:nonpdpanjar},
			function(result){
				var update = new Array();
				update = result.split('|');
				if(result.indexOf('|' != -1)) { 
					if(update[0]=="OK"){ 
						swal("OK..!!", "DATA SUDAH DISIMPAN...", "success");
						document.form.nopengembaliansisapanjar.value=update[1];
						gridrinci(update[1]);
						mati();
						document.form_rinci.rincianbelanja.focus();
					}else{
						swal("Gagal..!!!", result, "error");
					}
				}
			}
		);  
	}
}

function clearrinci(){
	document.form_rinci.koderek50.value='';
	document.form_rinci.rincianbelanja.value='';
	document.form_rinci.itembelanja.value='';
	document.form_rinci.idspj.value=''; 
	document.form_rinci.nopp.value=''; 
	document.form_rinci.nousulan.value=''; 
	document.form_rinci.volume.value='';
	document.form_rinci.satuan.value='';
	document.form_rinci.harga.value='';
	document.form_rinci.jumlahanggaran.value='';
	document.form_rinci.jumlahpenerimaanpanjar.value='';
	document.form_rinci.jumlahbelanjapanjar.value='';
	document.form_rinci.sisapanjar.value='';
}

function mati(){
	document.form.tglpengembaliansisapanjar.disabled=true;
	document.form.nospjpanjar.disabled=true;
}

function gridrinci(nopengembaliansisapanjar){ 
	jfloading("grid_nilai");
	$.get("trans_/pengembaliansisaspj/gridrinci.php",{nopengembaliansisapanjar:nopengembaliansisapanjar},
		function(result){ 
			$("#grid_nilai").html(result); 
			jfdata_table(); 
		}
	);
}

function datapengembaliansisaspjpanjar(){ 
	jfloading("sub_konten");
	$.get("trans_/pengembaliansisaspj/datapengembaliansisaspjpanjar.php",
		function(result){ 
			$("#sub_konten").html(result); 
			jfdata_table(); 
		}
	);
}

function hapus_rinci(id,nopengembaliansisapanjar,idspj){ 
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
				$.get("trans_/pengembaliansisaspj/hapus_rinci.php",{id:id,nopengembaliansisapanjar:nopengembaliansisapanjar,idspj:idspj},
					function(result){ 
						var update = new Array();
						update = result.split('|');
						if(result.indexOf('|' != -1)) { 
							if(update[0]=="OK"){  
								swal("OK..!!", "DATA SUDAH TERHAPUS...", "success");
								gridrinci(nopengembaliansisapanjar);
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

function kunci(nospjpanjar){
	jfloading("sub_konten");
	$.get("trans_/pengembaliansisaspj/kunci.php",{nospjpanjar:nospjpanjar},function(result){ 
			var update = new Array();
			update = result.split('|');
			if(result.indexOf('|' != -1)) { 
				if(update[0]=="OK"){  
					swal("OK..!!", "DATA SUDAH TERKUNCI...", "success");
					datapengembaliansisaspjpanjar();	
				}else{
					swal("Gagal..!!!", result, "error");
				}
			}
		}
	);
}

function bukakunci(nospjpanjar){
	jfloading("sub_konten");
	$.get("trans_/pengembaliansisaspj/bukakunci.php",{nospjpanjar:nospjpanjar},function(result){ 
			var update = new Array();
			update = result.split('|');
			if(result.indexOf('|' != -1)) { 
				if(update[0]=="OK"){  
					swal("OK..!!", "DATA SUDAH TERKUNCI...", "success");
					datapengembaliansisaspjpanjar();	
				}else{
					swal("Gagal..!!!", result, "error");
				}
			}
		}
	);
}

function hapusHeader(nopengembaliansisapanjar,nospjpanjar){  
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
				$.get("trans_/pengembaliansisaspj/hapus_heder.php",{nopengembaliansisapanjar:nopengembaliansisapanjar,nospjpanjar:nospjpanjar},
					function(result){ 
						var update = new Array();
						update = result.split('|');
						if(result.indexOf('|' != -1)) { 
							if(update[0]=="OK"){  
								swal("OK..!!", "DATA SUDAH TERHAPUS...", "success");
								datanpdls();
							}else{
								swal("Gagal..!!!", result, "error");
							}
						}
					}
				);
			}
	});
	
}

function carinonpdpanjar(){
	$.fancybox({
		'href'			:'trans_/pengembaliansisaspj/carinonpdpanjar.php',
		'overlayOpacity':0,
		'opacity'		: true,
		'transitionIn'	: 'elastic',
		'type'			: 'ajax'
	});
	document.getElementById('caririncianbelanja').style.visibility='hidden';
}

function bersihkan(){
	document.form_rinci.koderek50.value='';
	document.form_rinci.rincianbelanja.value='';
	document.form_rinci.itembelanja.value='';
	document.form_rinci.idspj.value=''; 
	document.form_rinci.nopp.value=''; 
	document.form_rinci.nousulan.value=''; 
	document.form_rinci.volume.value='';
	document.form_rinci.satuan.value='';
	document.form_rinci.harga.value='';
	document.form_rinci.jumlahanggaran.value='';
	document.form_rinci.jumlahpenerimaanpanjar.value='';
	document.form_rinci.jumlahbelanjapanjar.value='';
	document.form_rinci.sisapanjar.value='';
}

function pilihspjpanjar(nospjpanjar,notapanjar,kodepptk,pptk,program,kegiatan,kodekegiatanblud,kegiatanblud){
	document.form.nospjpanjar.value=nospjpanjar;
	document.form.notapanjar.value=notapanjar;
	document.form.kodepptk.value=kodepptk;
	document.form.pptk.value=pptk;
	document.form.program.value=program;
	document.form.kegiatan.value=kegiatan;
	document.form.kodekegiatanblud.value=kodekegiatanblud;
	document.form.kegiatanblud.value=kegiatanblud; 
	bersihkan();
	$.fancybox.close();
}

function cariitembelanja(){
	notapanjar=document.form.notapanjar.value; 
	$.fancybox({
		'href'			:'trans_/pengembaliansisaspj/cariitembelanja.php?notapanjar='+notapanjar,
		'overlayOpacity':0,
		'opacity'		: true,
		'transitionIn'	: 'elastic',
		'type'			: 'ajax'
	});
}

function pilihitembelanja(itembelanja,volume,satuan,hargapermintaanpanjar,nopp,nousulan,id,
	nonpdpanjar,total,koderek50,rincianbelanja50,sisasaldo,awal,beli){
	document.form_rinci.itembelanja.value=itembelanja;
	document.form_rinci.rincianbelanja.value=rincianbelanja50;
	document.form_rinci.koderek50.value=koderek50;
	document.form_rinci.idspj.value=id;
	document.form_rinci.volume.value=volume;
	document.form_rinci.satuan.value=satuan;
	document.form_rinci.harga.value=hargapermintaanpanjar;
	document.form_rinci.nopp.value=nopp;
	document.form_rinci.nousulan.value=nousulan;
	document.form_rinci.nonpdpanjar.value=nonpdpanjar;
	document.form_rinci.jumlahanggaran.value=awal;
	document.form_rinci.jumlahpenerimaanpanjar.value=total;
	document.form_rinci.jumlahbelanjapanjar.value=beli;
	document.form_rinci.satuan.value=satuan;
	document.form_rinci.sisapanjar.value=sisasaldo;
	$.fancybox.close();
}

function carinonpdpanjar(){
	$.fancybox({
		'href'			:'trans_/pengembaliansisaspj/carinonpdpanjar.php',
		'overlayOpacity':0,
		'opacity'		: true,
		'transitionIn'	: 'elastic',
		'type'			: 'ajax'
	});
}


