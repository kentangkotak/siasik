function formnpdls(nonpdls,nokontrak,serahterimapekerjaan,koderek50,kodekegiatan){
	jfloading("sub_konten");
	$.get("trans_/npdls/formnpdls.php",{nonpdls:nonpdls},
		function(result){
			$("#sub_konten").html(result);
			$( '#pph21' ).mask('000,000,000,000.00', {reverse: true});
			$( '#pph22' ).mask('000,000,000,000.00', {reverse: true});
			$( '#pph23' ).mask('000,000,000,000.00', {reverse: true});
			$( '#pph25' ).mask('000,000,000,000.00', {reverse: true});
			$( '#pasal4' ).mask('000,000,000,000.00', {reverse: true});
			$( '#ppnpusat' ).mask('000,000,000,000.00', {reverse: true});
			$( '#utangpajakdaerah' ).mask('000,000,000,000.00', {reverse: true});
			$('#tglnpd').datetimepicker({
				format: 'DD/MM/YYYY',
			});
			fungsikomplet();
			gridrinci(nonpdls);
			grid_pajak(nonpdls);
			if(nonpdls != undefined){
				mati();
			}
			if(serahterimapekerjaan == 1){ 
				//$("#itembelanja").autocomplete({
				//serviceUrl:'trans_/npdls/autobyitembelanjaserahterima.php?nokontrak='+nokontrak,
				//type: "GET",
				//	onSelect: function (suggestions) {
				//		$('#nopenerimaan').val(suggestions.nopenerimaan);
				//		$('#itembelanja').val(suggestions.keterangan);
				//		$('#nilai').val(suggestions.nilai);
				//		$('#idserahterima_rinci').val(suggestions.idserahterima_rinci);
				//		document.form.hargapermintaanpanjar.focus();
				//	}	
				//});
				if(kodekegiatan == 45){ 
					document.getElementById('cariitembelanja').style.visibility='visible';
					document.getElementById('cariitembelanjax').style.visibility='hidden';
				}else{
					document.getElementById('cariitembelanja').style.visibility='hidden';
					document.getElementById('cariitembelanjax').style.visibility='visible';
				}
			}else{
				
				$("#itembelanja").autocomplete({
					serviceUrl:'trans_/npdls/autobyitembelanja.php?koderek50='+koderek50+'&kodekegiatan='+kodekegiatan,
					type: "GET",
						onSelect: function (suggestions) {
							$('#itembelanja').val(suggestions.usulan);
							$('#nopenerimaan').val(suggestions.nopenerimaan);
							$('#nilai').val(suggestions.total);
							$('#idserahterima_rinci').val(suggestions.idserahterima_rinci);
							document.form_rinci.volumepermintaanpanjar.focus();
						}
						
				});
				if(kodekegiatan == 45){
					document.getElementById('cariitembelanja').style.visibility='visible';
					document.getElementById('cariitembelanjax').style.visibility='hidden';
					document.form_rinci.nominalpembayaran.disabled=false;
				}else{
					document.getElementById('cariitembelanja').style.visibility='hidden';
					document.getElementById('cariitembelanjax').style.visibility='visible';
					document.form_rinci.nominalpembayaran.disabled=true;
				}
			}
			
			$( '#biayatransfer' ).mask('000,000,000,000.00', {reverse: true});
			$( '#nilai' ).mask('000,000,000,000.00', {reverse: false});
			$( '#volumepermintaanpanjar' ).mask('000,000,000,000.00', {reverse: true});
			$( '#hargapermintaanpanjar' ).mask('000,000,000,000.00', {reverse: true});
			$( '#nominalpembayaran' ).mask('000,000,000,000.00', {reverse: true});
			
			document.form.totalpermintaanpanjar.value=vatotalpermintaanpanjarr
		}
	);
}

function fungsikomplet(){
	$("#pptk").autocomplete({
		serviceUrl:'trans_/npdls/autobypptk.php',
		type: "GET",
		    onSelect: function (suggestion) {
		    	$('#kodepptk').val(suggestion.nip);
				$('#pptk').val(suggestion.nama);
				$('#bidang').val(suggestion.bidang);
				$('#kodebidang').val(suggestion.kodebidang);
				//document.form.serahterimapekerjaan.focus();
				//document.form.serahterimapekerjaan.value='';
				
				$("#kegiatanblud").autocomplete({
					serviceUrl:'trans_/npdls/autobykegiatan.php?nip='+suggestion.nip,
					type: "GET",
						onSelect: function (suggestions) {
							$('#kegiatanblud').val(suggestions.kegiatan);
							$('#kodekegiatanblud').val(suggestions.kodekegiatan);
							document.form_rinci.rincianbelanja.focus();
							
							$("#rincianbelanja").autocomplete({
								serviceUrl:'trans_/npdls/autobyrincianbelanja.php?kodekegiatan='+suggestions.kodekegiatan,
								type: "GET",
									onSelect: function (suggestions) {
										$('#rincianbelanja').val(suggestions.uraian50);
										$('#koderek50').val(suggestions.koderek50);
										document.form_rinci.itembelanja.focus();
										
										kodekegiatan=document.form.kodekegiatanblud.value;
										$("#itembelanja").autocomplete({
											serviceUrl:'trans_/npdls/autobyitembelanja.php?koderek50='+suggestions.koderek50+'&kodekegiatan='+kodekegiatan,
											type: "GET",
												onSelect: function (suggestions) {
													$('#itembelanja').val(suggestions.usulan);
													$('#nopenerimaan').val(suggestions.nopenerimaan);
													$('#nilai').val(suggestions.total);
													$('#idserahterima_rinci').val(suggestions.idserahterima_rinci);
													document.form_rinci.volumepermintaanpanjar.focus();
												}
												
										});
										
										
									}
									
							});
							
						}

				});
							
		    }

	});
	$("#penerima").autocomplete({
		serviceUrl:'trans_/npdls/autobypenerima.php',
		type: "GET",
			onSelect: function (suggestions) {
				$('#kodepenerima').val(suggestions.kode);
				$('#penerima').val(suggestions.nama);
				$('#bank').val(suggestions.bank);
				$('#rekening').val(suggestions.norek);
				$('#npwp').val(suggestions.npwp);
				document.form.hargapermintaanpanjar.focus();
			}
			
	});	
}

function simpannpdls(){ 
    
	nonpd=document.form.nonpd.value; 
	tglnpd=document.form.tglnpd.value; 
	triwulan=document.form.triwulan.value; 
	serahterimapekerjaan=document.form.serahterimapekerjaan.value;
	kodepptk=document.form.kodepptk.value; 
	pptk=document.form.pptk.value; 
	triwulan=document.form.triwulan.value; 
	program=document.form.program.value; 
	nokontrak=document.form.nokontrak.value;
	kegiatan=document.form.kegiatan.value;
	kodekegiatanblud=document.form.kodekegiatanblud.value; 
	kegiatanblud=document.form.kegiatanblud.value;
	kodebidang=document.form.kodebidang.value;
	bidang=document.form.bidang.value; 
	kodepenerima=document.form.kodepenerima.value;
	penerima=document.form.penerima.value;
	bank=document.form.bank.value;
	rekening=document.form.rekening.value;
	npwp=document.form.npwp.value; 
	keterangan=document.form.keterangan.value;
	biayatransfer=document.form.biayatransfer.value; 
	noserahterima=document.form.noserahterima.value; 	
	
	koderek50=document.form_rinci.koderek50.value; 
	rincianbelanja=document.form_rinci.rincianbelanja.value;
	
	itembelanja=document.form_rinci.itembelanja.value;
	nousulan=document.form_rinci.nousulan.value;
	idserahterima_rinci=document.form_rinci.idserahterima_rinci.value;
	nopenyesuaianprioritas=document.form_rinci.nopenyesuaianprioritas.value;
	volume=document.form_rinci.volume.value;
	satuan=document.form_rinci.satuan.value; 
 	harga=document.form_rinci.harga.value;
	total=document.form_rinci.total.value;
	sisaanggaran=document.form_rinci.sisaanggaran.value;
	volumepermintaanpanjar=document.form_rinci.volumepermintaanpanjar.value;
	hargapermintaanpanjar=document.form_rinci.hargapermintaanpanjar.value;
	nilai=document.form_rinci.totalpermintaanpanjar.value;
	kode108=document.form_rinci.kode108.value;
	uraian108=document.form_rinci.uraian108.value;
	totalpermintaanpanjar=document.form_rinci.totalpermintaanpanjar.value;
	nominalpembayaran=document.form_rinci.nominalpembayaran.value;
		
	if(serahterimapekerjaan==''){
		swal("Gagal..!!!", "SERAH TERIMAH PEKERJAAN TIDAK BOLEH KOSONG....!!!", "error");
	}else if(kodepptk==''){
		swal("Gagal..!!!", "PPTK TIDAK BOLEH KOSONG ATAU PPTK BELUM TERDAFTAR....!!!", "error");
	}else if(pptk==''){
		swal("Gagal..!!!", "PPTK TIDAK BOLEH KOSONG ATAU PPTK BELUM TERDAFTAR....!!!", "error");
	}else if(kodekegiatanblud==''){
		swal("Gagal..!!!", "KEGIATAN BLUD TIDAK BOLEH KOSONG ATAU KEGIATAN BLUD BELUM TERDAFTAR....!!!", "error");
	}else if(kegiatanblud==''){
		swal("Gagal..!!!", "KEGIATAN BLUD TIDAK BOLEH KOSONG ATAU KEGIATAN BLUD BELUM TERDAFTAR....!!!", "error");
	}else if(koderek50==''){
		swal("Gagal..!!!", "RINCIAN BELANJA TIDAK BOLEH KOSONG ATAU RINCIAN BELANJA BELUM TERDAFTAR....!!!", "error");
	}else if(rincianbelanja==''){
		swal("Gagal..!!!", "RINCIAN BELANJA TIDAK BOLEH KOSONG ATAU RINCIAN BELANJA BELUM TERDAFTAR....!!!", "error");
	}else if(itembelanja==''){
		swal("Gagal..!!!", "ITEM BELANJA TIDAK BOLEH KOSONG....!!!", "error");
	}else if(volumepermintaanpanjar==''){
		swal("Gagal..!!!", "VOLUME PERMINTAAN TIDAK BOLEH KOSONG....!!!", "error");
	}else if(hargapermintaanpanjar==''){
		swal("Gagal..!!!", "HARGA PERMINTAAN TIDAK BOLEH KOSONG....!!!", "error");
	}else if(nilai==''){
		swal("Gagal..!!!", "TOTAL PERMINTAAN PANJAR TIDAK BOLEH KOSONG....!!!", "error");
	}else if(penerima==''){
		swal("Gagal..!!!", "PENERIMA TIDAK BOLEH KOSONG....!!!", "error");
	}else{
		clearrinci();
		// $.get('trans_/npdls/getPaguByKegiatan.php',{kodekegiatanblud:kodekegiatanblud},function(resultx){
			// var update = new Array();
			// updatex = resultx.split('|'); 
			// if(resultx.indexOf('|' != -1)) { 
				// if(updatex[0]=="OK"){ 
					$.get('trans_/npdls/simpan.php',{nonpd:nonpd,tglnpd:tglnpd,triwulan:triwulan,serahterimapekerjaan:serahterimapekerjaan,kodepptk:kodepptk,pptk:pptk,triwulan:triwulan, 
							program:program,nokontrak:nokontrak,kegiatan:kegiatan,kodekegiatanblud:kodekegiatanblud,kegiatanblud:kegiatanblud,kodebidang:kodebidang,bidang:bidang,
							kodepenerima:kodepenerima,penerima:penerima,bank:bank,rekening:rekening,npwp:npwp,keterangan:keterangan,biayatransfer:biayatransfer,koderek50:koderek50,
							rincianbelanja:rincianbelanja,itembelanja:itembelanja,volume:volume,
							satuan:satuan,harga:harga,total:total,volumepermintaanpanjar:volumepermintaanpanjar,hargapermintaanpanjar:hargapermintaanpanjar,nilai:nilai,sisaanggaran:sisaanggaran,
							noserahterima:noserahterima,nousulan:nousulan,idserahterima_rinci:idserahterima_rinci,
							nopenyesuaianprioritas:nopenyesuaianprioritas,kode108:kode108,uraian108:uraian108,totalpermintaanpanjar:totalpermintaanpanjar,nominalpembayaran:nominalpembayaran},
						function(result){ 
							var update = new Array();
							update = result.split('|'); 
							if(result.indexOf('|' != -1)) { 
								if(update[0]=="OK"){ 
									swal("OK..!!", "DATA SUDAH DISIMPAN...", "success");
									document.form.nonpd.value=update[1];
									gridrinci(update[1]);
									document.getElementById('lokasilaka_content').style.visibility='hidden';
									mati();
									//clearrincix();
									//nopdx=update[1];
									//$.get("trans_/npdls/getjumlahnpdls.php",{nonpdls:nopdx},function(result){
										//$("#contentPagu").html(result);
									//});
								}else{
									swal("Gagal..!!!", result, "error");
								}
							}
						}
					);
				// }else{
					// swal("Gagal..!!!", resultx, "error");
				// }
			// }
		// });		
	}
}

async function gridrinci(nonpd){ 
	jfloading("grid_nilai");
	await $.get("trans_/npdls/gridrinci.php",{nonpd:nonpd},
		function(result){ 
			$("#grid_nilai").html(result); 
			jfdata_table(); 
		}
	);
}

function mati(){
	
	document.form.nonpd.disabled=true; 
	//document.form.rincianbelanja.disabled=true; 	
	document.form.tglnpd.disabled=true; 
	document.form.triwulan.disabled=true; 
	document.form.serahterimapekerjaan.disabled=true; 
	document.form.pptk.disabled=true; 
	document.form.triwulan.disabled=true; 
	document.form.program.disabled=true;
	document.form.nokontrak.disabled=true;
	document.form.kegiatan.disabled=true;
	document.form.kegiatanblud.disabled=true;
	document.form.penerima.disabled=true;
	document.form.bank.disabled=true;
	document.form.rekening.disabled=true;
	document.form.npwp.disabled=true;
	document.form.keterangan.disabled=true;
	document.form.biayatransfer.disabled=true; 
}

function clearrinci(){
	//document.form_rinci.koderek50.value='';
	//document.form_rinci.rincianbelanja.value='';
	document.form_rinci.itembelanja.value='';
	//document.form_rinci.nopenerimaan.value='';
	//document.form_rinci.idserahterima_rinci.value='';
	document.form_rinci.nominalpembayaran.value='';
	document.form_rinci.volume.value='';
	document.form_rinci.satuan.value=''; 
 	document.form_rinci.harga.value='';
	document.form_rinci.total.value='';
	document.form_rinci.sisaanggaran.value='';
	document.form_rinci.volumepermintaanpanjar.value='';
	document.form_rinci.hargapermintaanpanjar.value='';
	document.form_rinci.totalpermintaanpanjar.value='';
}

function datanpdls(){ 
	jfloading("sub_konten");
	$.get("trans_/npdls/datanpdpls.php",
		function(result){ 
			$("#sub_konten").html(result); 
			jfdata_table(); 
		}
	);
}


function hapus_rinci(id,nonpdls,idserahterima_rinci,kodekegiatanblud,koderek108,nokontrak){  
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
				$.get("trans_/npdls/hapus_rinci.php",{id:id,nonpdls:nonpdls,idserahterima_rinci:idserahterima_rinci,kodekegiatanblud:kodekegiatanblud,koderek108:koderek108,nokontrak:nokontrak},
					function(result){ 
						var update = new Array();
						update = result.split('|');
						if(result.indexOf('|' != -1)) { 
							if(update[0]=="OK"){  
								swal("OK..!!", "DATA SUDAH TERHAPUS...", "success");
								gridrinci(nonpdls);
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

function hapusHeader(nonpdls,nokontrak){  
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
				$.get("trans_/npdls/hapus_heder.php",{nonpdls:nonpdls,nokontrak:nokontrak},
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

function kunci(nonpdls){
	jfloading("sub_konten");
	$.get("trans_/npdls/kunci.php",{nonpdls:nonpdls},function(result){ 
			var update = new Array();
			update = result.split('|');
			if(result.indexOf('|' != -1)) { 
				if(update[0]=="OK"){  
					swal("OK..!!", "DATA SUDAH TERKUNCI...", "success");
					datanpdls();	
				}else{
					swal("Gagal..!!!", result, "error");
				}
			}
		}
	);
}

function bukakunci(nonpdls){
	jfloading("sub_konten");
	$.get("trans_/npdls/bukakunci.php",{nonpdls:nonpdls},function(result){ 
			var update = new Array();
			update = result.split('|');
			if(result.indexOf('|' != -1)) { 
				if(update[0]=="OK"){  
					swal("OK..!!", "DATA SUDAH TERKUNCI...", "success");
					datanpdls();	
				}else{
					swal("Gagal..!!!", result, "error");
					datanpdls();
				}
			}
		}
	);
}

function hasil(){ 
	hargapermintaanpanjar=document.form_rinci.hargapermintaanpanjar.value;
	volumepermintaanpanjar=document.form_rinci.volumepermintaanpanjar.value; 
	
	$.get("trans_/npdls/hasil.php",{hargapermintaanpanjar:hargapermintaanpanjar,volumepermintaanpanjar:volumepermintaanpanjar},function(result){  
			document.form_rinci.totalpermintaanpanjar.value=result;
			document.form_rinci.nominalpembayaran.value=result;				
			}
	);
}

function serahterima(x){
	kodepptk=document.form.kodepptk.value;
	
	if(x == 1){
		document.getElementById('caripenerima').style.visibility='hidden';
		document.getElementById('cariitembelanjax').style.visibility='hidden';
		document.getElementById('cariitembelanja').style.visibility='hidden';
		//document.getElementById('caririncianbelanja').style.visibility='hidden';
		//document.getElementById('carikegiatanblud').style.visibility='hidden';
		document.getElementById('caripptk').style.visibility='hidden';
		document.getElementById('lokasilaka_content').style.visibility='visible';
		
		document.form.serahterimapekerjaan.disabled=true;
		document.form.pptk.disabled=true;
		document.form.kegiatanblud.disabled=true;
		document.form.penerima.disabled=true;
		document.form.bank.disabled=true;
		document.form.rekening.disabled=true;
		document.form.npwp.disabled=true;
		document.form.nokontrak.disabled=true;
		document.form.kegiatan.disabled=true;
		document.form.rincianbelanja.disabled=true;
		
		document.form_rinci.rincianbelanja.disabled=true;
		document.form_rinci.itembelanja.disabled=true;
		document.form_rinci.volume.disabled=true;
		document.form_rinci.satuan.disabled=true;
		document.form_rinci.harga.disabled=true;
		document.form_rinci.total.disabled=true;
		document.form_rinci.sisaanggaran.disabled=true;
		document.form_rinci.volumepermintaanpanjar.disabled=true;
		document.form_rinci.hargapermintaanpanjar.disabled=true;
		document.form_rinci.totalpermintaanpanjar.disabled=true;
		document.form_rinci.satuanbaru.disabled=true;
		document.form_rinci.totaltagihanfaktur.disabled=true;
		document.getElementById('totaltagihanfakturx').style.visibility='visible';
		
		$("#kegiatan").autocomplete({
			serviceUrl:'trans_/npdls/autobykegiatanserahterima.php?kodepptk='+kodepptk,
			type: "GET",
				onSelect: function (suggestions) {
					$('#kegiatan').val(suggestions.kegiatan);
					$('#program').val(suggestions.program);
					$('#kodekegiatanblud').val(suggestions.kodekegiatanblud);
					$('#kegiatanblud').val(suggestions.kegiatanblud);
					$('#kodepenerima').val(suggestions.kodepihakketiga);
					$('#penerima').val(suggestions.perusahaan);
					$('#bank').val(suggestions.bank);
					$('#rekening').val(suggestions.norek);
					$('#npwp').val(suggestions.npwp);
					$('#nokontrak').val(suggestions.nokontrak);
					$('#koderek50').val(suggestions.koderek50);
					$('#rincianbelanja').val(suggestions.uraianpekerjaan);
					document.form.pptk.disabled=true;
					document.form.serahterimapekerjaan.disabled=true;
					document.form.triwulan.disabled=true;
					document.form.nokontrak.disabled=true;
					document.form.kegiatan.disabled=true;
					document.form.kegiatanblud.disabled=true;
					document.form.tglnpd.disabled=true;
					document.form_rinci.rincianbelanja.disabled=true;
					//document.form_rinci.nilai.disabled=true;
					document.form.keterangan.focus();
					
					$("#itembelanja").autocomplete({
						serviceUrl:'trans_/npdls/autobyitembelanjaserahterima.php?nokontrak='+suggestions.nokontrak,
						type: "GET",
							onSelect: function (suggestions) {
								$('#nopenerimaan').val(suggestions.nopenerimaan);
								$('#itembelanja').val(suggestions.keterangan);
								$('#nilai').val(suggestions.nilai);
								$('#idserahterima_rinci').val(suggestions.idserahterima_rinci);
								document.form.hargapermintaanpanjar.focus();
							}	
					});
				}
				
		});
		$("#nokontrak").autocomplete({
			serviceUrl:'trans_/npdls/autobynokontrakserahterima.php?kodepptk='+kodepptk,
			type: "GET",
				onSelect: function (suggestions) {
					$('#kegiatan').val(suggestions.kegiatan);
					$('#program').val(suggestions.program);
					$('#kodekegiatanblud').val(suggestions.kodekegiatanblud);
					$('#kegiatanblud').val(suggestions.kegiatanblud);
					$('#kodepenerima').val(suggestions.kodepihakketiga);
					$('#penerima').val(suggestions.perusahaan);
					$('#bank').val(suggestions.bank);
					$('#rekening').val(suggestions.norek);
					$('#npwp').val(suggestions.npwp);
					$('#nokontrak').val(suggestions.nokontrak);
					$('#koderek50').val(suggestions.koderek50);
					$('#rincianbelanja').val(suggestions.uraianpekerjaan);
					document.form.pptk.disabled=true;
					document.form.serahterimapekerjaan.disabled=true;
					document.form.triwulan.disabled=true;
					document.form.nokontrak.disabled=true;
					document.form.kegiatan.disabled=true;
					document.form.kegiatanblud.disabled=true;
					document.form.tglnpd.disabled=true;
					document.form_rinci.rincianbelanja.disabled=true;
					//document.form_rinci.nilai.disabled=true;
					document.form.keterangan.focus();
					
					$("#itembelanja").autocomplete({
						serviceUrl:'trans_/npdls/autobyitembelanjaserahterima.php?nokontrak='+suggestions.nokontrak,
						type: "GET",
							onSelect: function (suggestions) {
								$('#nopenerimaan').val(suggestions.nopenerimaan);
								$('#itembelanja').val(suggestions.keterangan);
								$('#nilai').val(suggestions.nilai);
								$('#idserahterima_rinci').val(suggestions.idserahterima_rinci);
								document.form.hargapermintaanpanjar.focus();
							}
							
					});
					
			}
		});	   
	}else{
		document.getElementById('caripenerima').style.visibility='visible';
		document.getElementById('cariitembelanjax').style.visibility='visible';
		//document.getElementById('caririncianbelanja').style.visibility='visible';
		//document.getElementById('carikegiatanblud').style.visibility='visible';
		document.getElementById('caripptk').style.visibility='visible';
		document.getElementById('cariitembelanja').style.visibility='hidden';
		document.form.serahterimapekerjaan.disabled=true;
		document.form.nokontrak.disabled=true;
		document.form.kegiatan.disabled=true;
		document.form.program.value='PROGRAM PENUNJANG URUSAN PEMERINTAH DAERAH KABUPATEN/KOTA';
		document.form.kegiatan.value='PELAYANAN DAN PENUNJANG PELAYANAN BLUD';
		document.form.pptk.disabled=true;
		document.form.kegiatanblud.disabled=true;
		document.form.rincianbelanja.disabled=true;
		document.form.triwulan.disabled=true;
		
		document.form.penerima.disabled=false;
		document.form.bank.disabled=false;
		document.form.rekening.disabled=false;
		document.form.npwp.disabled=false;
		document.form_rinci.rincianbelanja.disabled=false;
		document.form_rinci.nilai.disabled=false;
		
	}
}

function tambahpajak(){
	nonpd=document.form.nonpd.value; 
	$.fancybox({
		'href'			:'trans_/npdls/tambahpajak.php?nonpd='+nonpd,
		'overlayOpacity':0,
		'opacity'		: true,
		'transitionIn'	: 'elastic',
		'type'			: 'ajax'
	});
}


function simpannpdlspajak(){ 
    
	nonpd=document.form.nonpd.value; 
	pph21=document.form_pajak.pph21.value; 
	pph22=document.form_pajak.pph22.value;
	pph23=document.form_pajak.pph23.value;
	pph25=document.form_pajak.pph25.value;
	pasal4=document.form_pajak.pasal4.value;
	ppnpusat=document.form_pajak.ppnpusat.value;
	utangpajakdaerah=document.form_pajak.utangpajakdaerah.value;
	koderekening=document.form_pajak.koderek.value;
	
		clearpajak();
		$.get('trans_/npdls/simpanpajak.php',{nonpd:nonpd,pph21:pph21,pph22:pph22,pph23:pph23,pph25:pph25,pasal4:pasal4,ppnpusat:ppnpusat, 
				utangpajakdaerah:utangpajakdaerah,koderekening:koderekening},
			function(result){ 
				var update = new Array();
				update = result.split('|'); 
				if(result.indexOf('|' != -1)) { 
					if(update[0]=="OK"){ 
						swal("OK..!!", "DATA SUDAH DISIMPAN...", "success");
						grid_pajak(nonpd); 
						//$.fancybox.close();
					}else{
						swal("Gagal..!!!", result, "error");
					}
				}
			}
		);  
}

function cariitembelanja(){
	kodekegiatanblud=document.form.kodekegiatanblud.value;
	koderek50=document.form_rinci.koderek50.value;
	$.fancybox({
		'href'			:'trans_/npdls/cariitembelanja.php?kodekegiatanblud='+kodekegiatanblud+'&koderek50='+koderek50,
		'overlayOpacity':0,
		'opacity'		: true,
		'transitionIn'	: 'elastic',
		'type'			: 'ajax'
	});
}

function pilih(kode108,jenisobat,jumlahtotalx,jumlah){
	kodepptk=document.form.kodepptk.value;
	koderek50=document.form.koderek50.value;
	kodekegiatanblud=document.form.kodekegiatanblud.value;
		$.get('trans_/npdls/caripenetapananggaran.php',{kodepptk:kodepptk,kode108:kode108,koderek50:koderek50,kodekegiatanblud:kodekegiatanblud},
		function(result){ var update = new Array();
			update = result.split('|'); 
			if(result.indexOf('|' != -1)) { 
				document.form_rinci.volume.value=update[0];
				document.form_rinci.satuan.value=update[1];
				document.form_rinci.harga.value=update[2]; 
				document.form_rinci.total.value=update[3];
				document.form_rinci.totaltagihanfaktur.value=jumlahtotalx;
				document.form_rinci.itembelanja.value=jenisobat; 
				document.form_rinci.volumepermintaanpanjar.value=jumlah;
				document.form_rinci.totalpermintaanpanjar.value=jumlahtotalx;
				document.form_rinci.hargapermintaanpanjar.value=1; 	
				$.fancybox.close();
			}
		}); 
}

function carinokontrak(){
	//kodepptk=document.form.kodepptk.value;
	$.fancybox({
		'href'			:'trans_/npdls/carinokontrak.php',
		'overlayOpacity':0,
		'opacity'		: true,
		'transitionIn'	: 'elastic',
		'type'			: 'ajax'
	});
}

function pilihserahterimapekerjaan(noserahterimapekerjaan,nokontrak,program,kegiatan,namaperusahaan,kodekegiatanblud,kegiatanblud,uraianpekerjaan,koderek50,bank,norek,npwp,nopp,
kodepihakketiga,itembelanja,idrinci,volume,satuan,harga,totalls,volumepermintaanls,hargapermintaanls,totalpermintaanls,satuanbaru,tagihanfaktur,kodepptk,namapptk,
kodebagian,bagian){ 
	
	document.form.noserahterima.value=noserahterimapekerjaan;
	document.form.kodepptk.value=kodepptk;
	document.form.kodebidang.value=kodebagian; 
	document.form.bidang.value=bagian; 	
	document.form.pptk.value=namapptk;
	document.form.program.value=program; 
	document.form.nokontrak.value=nokontrak; 
	document.form.kegiatan.value=kegiatan;
	document.form.kodekegiatanblud.value=kodekegiatanblud;
	document.form.kegiatanblud.value=kegiatanblud;
	document.form.kodepenerima.value=kodepihakketiga;
	document.form.penerima.value=namaperusahaan;
	document.form.bank.value=bank;
	document.form.rekening.value=norek;
	document.form.npwp.value=npwp;
	
	/*document.form.koderek50.value=koderek50;
	document.form.rincianbelanja.value=uraianpekerjaan;*/
	
	if(kodekegiatanblud == 45){
		document.getElementById('cariitembelanja').style.visibility='visible';
		document.getElementById('cariitembelanjax').style.visibility='hidden';
		document.form_rinci.nominalpembayaran.disabled=false;
	}else{
		document.getElementById('cariitembelanja').style.visibility='hidden';
		document.getElementById('cariitembelanjax').style.visibility='visible';
		document.form_rinci.nominalpembayaran.disabled=true;
	}
	$.fancybox.close();
}

function cariitembelanjanonfarmasi(){
	kodekegiatanblud=document.form.kodekegiatanblud.value;
	koderek50=document.form_rinci.koderek50.value;
	$.fancybox({
		'href'			:'trans_/npdls/cariitembelanjanonfarmasi.php?kodekegiatanblud='+kodekegiatanblud+'&koderek50='+koderek50,
		'overlayOpacity':0,
		'opacity'		: true,
		'transitionIn'	: 'elastic',
		'type'			: 'ajax'
	});
}

function pilihitembelanjanonfarmasi(usulan,jumlahacc,satuan,harga,total,notrans,nousulan,idpp,total,sisa,koderek108,uraian108,x){ 
	
	document.form_rinci.itembelanja.value=usulan;
	document.form_rinci.volume.value=jumlahacc;
	document.form_rinci.satuan.value=satuan;
	document.form_rinci.harga.value=harga;
	document.form_rinci.total.value=total;
	document.form_rinci.nopenyesuaianprioritas.value=notrans;
	document.form_rinci.nousulan.value=nousulan;
	document.form_rinci.idserahterima_rinci.value=idpp;
	document.form_rinci.sisaanggaran.value=sisa;
	document.form_rinci.kode108.value=koderek108;
	document.form_rinci.uraian108.value=uraian108;
	if(x == 1){ 
		generetetotal(koderek108);
	}
	
	$.fancybox.close();
}

function caripptk(){
	$.fancybox({
		'href'			:'trans_/npdls/caripptk.php',
		'overlayOpacity':0,
		'opacity'		: true,
		'transitionIn'	: 'elastic',
		'type'			: 'ajax'
	});
	document.getElementById('caripptk').style.visibility='hidden';
}

function pilihpptk(kodepptk,nama,kodebidang,bidang,kodekegiatan,kegiatan){ 
	
	document.form.kodepptk.value=kodepptk;
	document.form.pptk.value=nama;
	document.form.kodebidang.value=kodebidang;
	document.form.bidang.value=bidang;
	document.form.kodekegiatanblud.value=kodekegiatan;
	document.form.kegiatanblud.value=kegiatan;
	$.fancybox.close();
}

function carikegiatanblud(){
	kodekegiatanblud=document.form.kodekegiatanblud.value;
	$.fancybox({
		'href'			:'trans_/npdls/carikegiatanblud.php?kodekegiatanblud='+kodekegiatanblud,
		'overlayOpacity':0,
		'opacity'		: true,
		'transitionIn'	: 'elastic',
		'type'			: 'ajax'
	});
	//document.getElementById('carikegiatanblud').style.visibility='hidden';
}

function pilihkegiatanblud(kodekegiatan,kegiatan){ 
	
	document.form.kodekegiatanblud.value=kodekegiatan;
	document.form.kegiatanblud.value=kegiatan;
	
	$.fancybox.close();
}

function caririncianbelanja(){
	clearrinci();
	serahterimapekerjaan=document.form.serahterimapekerjaan.value;
	noserahterima=document.form.noserahterima.value;
	kodekegiatanblud=document.form.kodekegiatanblud.value;
	$.fancybox({
		'href'			:'trans_/npdls/caririncianbelanja.php?kodekegiatanblud='+kodekegiatanblud+'&noserahterima='+noserahterima+'&serahterimapekerjaan='+serahterimapekerjaan,
		'overlayOpacity':0,
		'opacity'		: true,
		'transitionIn'	: 'elastic',
		'type'			: 'ajax'
	});
	document.getElementById('caririncianbelanja').style.visibility='hidden';
}

function pilihrincianbelanja(koderek50,uraian50){ 
	
	document.form_rinci.koderek50.value=koderek50;
	document.form_rinci.rincianbelanja.value=uraian50;
	
	$.fancybox.close();
}

function caripenerima(){
	$.fancybox({
		'href'			:'trans_/npdls/caripenerima.php',
		'overlayOpacity':0,
		'opacity'		: true,
		'transitionIn'	: 'elastic',
		'type'			: 'ajax'
	});
	document.getElementById('caripenerima').style.visibility='hidden';
}

function pilihpihakketiga(kode,nama,alamat,telepon,npwp,norek,bank,cp,kodemapingrs,namasuplier){ 
	
	document.form.kodepenerima.value=kode;
	document.form.penerima.value=nama;
	document.form.bank.value=bank;
	document.form.rekening.value=norek;
	document.form.npwp.value=npwp;
	
	$.fancybox.close();
}

function generetetotal(koderek108){
	nokontrak=document.form.nokontrak.value;
	$.get('trans_/npdls/cariserahterimakontrak.php',{nokontrak:nokontrak,koderek108:koderek108},
		function(result){ var update = new Array();
			update = result.split('|'); 
			if(result.indexOf('|' != -1)) { 
				if(update[0]=="OK"){ 
					document.form_rinci.volumepermintaanpanjar.value=update[1];
					document.form_rinci.hargapermintaanpanjar.value='0';
					document.form_rinci.totalpermintaanpanjar.value=update[2];
					document.form_rinci.nominalpembayaran.value=update[2];
					document.form_rinci.volumepermintaanpanjar.disabled=true;
					document.form_rinci.hargapermintaanpanjar.disabled=true;
					document.form_rinci.totalpermintaanpanjar.disabled=true;
				}else{
					swal("Gagal..!!!", result, "error");
					document.form_rinci.itembelanja.value='';
					document.form_rinci.volume.value='';
					document.form_rinci.satuan.value='';
					document.form_rinci.harga.value='';
					document.form_rinci.total.value='';
					document.form_rinci.nopenyesuaianprioritas.value='';
					document.form_rinci.nousulan.value='';
					document.form_rinci.idserahterima_rinci.value='';
					document.form_rinci.sisaanggaran.value='';
					document.form_rinci.kode108.value='';
					document.form_rinci.uraian108.value='';
				}
			}
		}); 
}

function grid_pajak(nonpd){
	jfloading("grid_nilai");
	$.get("trans_/npdls/grid_pajak.php",{nonpd:nonpd},
		function(result){ 
			$("#grid_pajak").html(result); 
			jfdata_table(); 
		}
	);
}

function editnpdls(nonpdls){ 
	$.get('trans_/npdls/editnpdls.php',{nonpdls:nonpdls},
		function(result){ var update = new Array();
			update = result.split('|'); 
			if(result.indexOf('|' != -1)) { 
				document.form_pajak.pph21.value=update[1];
				document.form_pajak.pph22.value=update[2];
				document.form_pajak.pph23.value=update[3];
				document.form_pajak.pph25.value=update[4];
				document.form_pajak.pasal4.value=update[5];
				document.form_pajak.ppnpusat.value=update[6];
				document.form_pajak.utangpajakdaerah.value=update[7];
			}
		}); 
}

function clearpajak(){
	document.form_pajak.pph21.value='';
	document.form_pajak.pph22.value='';
	document.form_pajak.pph23.value='';
	document.form_pajak.pph25.value='';
	document.form_pajak.pasal4.value='';
	document.form_pajak.ppnpusat.value='';
	document.form_pajak.utangpajakdaerah.value='';
}

function hapuspajaknpdls(nonpdls){  
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
				$.get("trans_/npdls/hapuspajak.php",{nonpdls:nonpdls},
					function(result){ 
						var update = new Array();
						update = result.split('|');
						if(result.indexOf('|' != -1)) { 
							if(update[0]=="OK"){  
								swal("OK..!!", "DATA SUDAH TERHAPUS...", "success");
								grid_pajak(nonpdls);
							}else{
								swal("Gagal..!!!", result, "error");
							}
						}
					}
				);
			}
	});
	
}

function cetaknpdls(){ 
	nonpdls=document.form.nonpd.value;
	if(nonpdls==""){
		swal("Gagal..!!!", "APA YANG AKAN ANDA CETAK...???", "error");
	}else{
		window.open('trans_/npdls/cetaknpdls.php?nonpdls='+nonpdls,'','height=700,width=800,scrollbars=yes,resizable=yes');
	}
}