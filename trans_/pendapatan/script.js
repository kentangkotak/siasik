function formpendapatan(notrans) {
	jfloading("sub_konten");
	$.get("trans_/pendapatan/form.php", { notrans: notrans },
		function (result) {
			$("#sub_konten").html(result);
			fungsikomplet();
			$('#nilairupiah').mask('000,000,000,000.00', { reverse: true });
			$.get("trans_/pendapatan/getjumlahpendapatanpertahun.php", function (result) {
				$("#jumlkunjungan").html(result);
			});
			if (notrans != undefined) {
				document.form.bidang.disabled = true;
				document.form.uraian.disabled = true;
			}
		}
	);
}

function datapendapatan() {
	jfloading("sub_konten");
	$.get("trans_/pendapatan/datapendapatan.php",
		function (result) {
			$("#sub_konten").html(result);
			jfdata_table();
		}
	);
}


function fungsikomplet() {
	$("#koderekeningblud").autocomplete({
		serviceUrl: 'trans_/pendapatan/autobyakunblud.php',
		type: "GET",
		onSelect: function (suggestion) {
			$('#koderekeningblud').val(suggestion.koderekening);
			$('#uraian').val(suggestion.uraian);
		}

	})
	$("#uraian").autocomplete({
		serviceUrl: 'trans_/pendapatan/autobyuraian.php',
		minLength: 0,
		type: "GET",
		onSelect: function (suggestion) {
			$('#uraian').val(suggestion.uraian);
			$('#koderekeningblud').val(suggestion.koderekening);
			$('#map79').val(suggestion.mappingrs);
			$('#kode79').val(suggestion.kode79);
			$('#uraian79').val(suggestion.uraian79);
		}
	});
}

function gridpeserta(notrans) {
	jfloading("grid_nilai");
	$.get("trans_/pendapatan/gridpeserta.php", { notrans: notrans },
		function (result) {
			$("#grid_nilai").html(result);
			jfdata_table();
		}
	);
}

function simpanpendapatan() {

	notrans = document.form.notrans.value;
	bidang = document.form.bidang.value;
	koderekeningblud = document.form.koderekeningblud.value;
	uraian = document.form.uraian.value;
	nilairupiah = document.form.nilairupiah.value;
	map79 = document.form.map79.value;
	kode79 = document.form.kode79.value;
	uraian79 = document.form.uraian79.value;

	if (bidang == '') {
		swal("Gagal..!!!", "BIDANG HARUS DIPILIH..!!!", "error");
	} else if (koderekeningblud == '') {
		swal("Gagal..!!!", "KODE REKENING Harus Diisi..!!!", "error");
	} else if (uraian == '') {
		swal("Gagal..!!!", "URAIAN Harus Diisi..!!!", "error");
	} else if (nilairupiah == '') {
		swal("Gagal..!!!", "NILAI RUPIAHJ Harus Diisi..!!!", "error");
	} else if (map79 == '') {
		swal("Gagal..!!!", "MAAF DATA PENDAPATAN INI BELUM TERMAPING...!!!", "error");
	} else {
		$.get('trans_/pendapatan/simpan.php', { notrans: notrans, bidang: bidang, koderekeningblud: koderekeningblud, uraian: uraian, nilairupiah: nilairupiah, map79: map79, kode79: kode79, uraian79: uraian79 },
			function (result) {
				var update = new Array();
				update = result.split('|');
				if (result.indexOf('|' != -1)) {
					if (update[0] == "OK") {
						swal("OK..!!", "DATA SUDAH DISIMPAN...", "success");
						document.form.notrans.value = update[1];
						formpendapatan();
						//clearrinci();
						//gridpeserta(update[1]);	
					} else {
						swal("Gagal..!!!", result, "error");
					}
				}
			}
		);
	}
}

function closeMessage() {
	$.fancybox.close();
}

function mati() {
	document.form.notrans.disabled = true;
	document.form.namax.disabled = true;
	document.form.jenispelatihan.disabled = true;
	document.form.tempat.disabled = true;
	document.form.kategori.disabled = true;
	document.form.penyelenggara.disabled = true;
	document.form.tglmulai.disabled = true;
	document.form.tglsurat.disabled = true;
	document.form.tglselesai.disabled = true;
	document.form.nosurat.disabled = true;
	document.form.jam.disabled = true;
}

function clearrinci() {
	document.form_rinci.nip.value = '';
	document.form_rinci.namapegawai.value = '';
	document.form_rinci.nosttp.value = '';
	document.form_rinci.koderuangan.value = '';
	document.form_rinci.kategoripegawai.value = '';
	document.form_rinci.ruangan.value = '';
	document.form_rinci.kategoripeg.value = '';
	document.form_rinci.kodejabatan.value = '';
	document.form_rinci.kodependidikan.value = '';
	document.form_rinci.kodegolruang.value = '';
	document.form_rinci.kodestatpegawai.value = '';
	document.form_rinci.jabatan.value = '';
	document.form_rinci.pendidikan.value = '';
	document.form_rinci.golruang.value = '';
	document.form_rinci.statpeg.value = '';
}

function lihat_depan(notransx, nip, filex) {
	window.open('potos_folder/' + notransx + '/' + nip + '/' + filex, '', 'height=700,width=850,scrollbars=yes,resizable=yes');
}

function lihat_belakang(notransx, nip, files) {
	window.open('potos_folder/' + notransx + '/' + nip + '/' + files, '', 'height=700,width=850,scrollbars=yes,resizable=yes');
}

function hapus_rinci(notrans, nip, filenya) {
	jfloading("grid_nilai");
	$.get("trans_/pendapatan/hapus_rinci.php", { notrans: notrans, nip: nip, filenya: filenya }, function (result) {
		var update = new Array();
		update = result.split('|');
		if (result.indexOf('|' != -1)) {
			if (update[0] == "OK") {
				swal("OK..!!", "DATA SUDAH DIHAPUS...", "success");
				gridpeserta(notrans);
			} else {
				swal("Gagal..!!!", result, "error");
				gridpeserta(notrans);
			}
		}
	}
	);
}

function batal() {
	notrans = document.form.notrans.value;
	jfloading("sub_konten");
	$.get("trans_/pendapatan/batal.php", { notrans: notrans }, function (result) {
		var update = new Array();
		update = result.split('|');
		if (result.indexOf('|' != -1)) {
			if (update[0] == "OK") {
				swal("OK..!!", "PELATIHAN SUDAH DIBATALKAN...", "success");
				formpelaksanaanx();
			} else {
				swal("Gagal..!!!", result, "error");
			}
		}
	}
	);
}

function simpangambar(nip, notrans) {

	$.fancybox({
		'href': 'loading.php',
		'overlayOpacity': 0,
		'opacity': true,
		'transitionIn': 'elastic',
		'type': 'ajax',
		'showCloseButton': false,
		//'hideOnContentClick':true
	});
	$.ajax({
		url: "trans_/pendapatan/simpangambar.php?notrans=" + notrans,
		type: "POST",
		data: new FormData(document.getElementById('formgambar' + nip)),
		contentType: false,
		cache: false,
		processData: false,
		success: function (resultx) {
			//$.fancybox.close();
			var updatex = new Array();
			updatex = resultx.split('|');
			if (resultx.indexOf('|' != -1)) {
				if (updatex[0] == "OK") {
					swal("OK..!!", "DATA SUDAH DISIMPAN...", "success");
					gridpeserta(notrans);
					closeMessage();
				} else {
					swal("Gagal..!!!", resultx, "error");
					closeMessage();
				}
			}
		},
		error: function () { }
	});
}

function simpannosttp(nip, notrans) {
	nosttp = document.getElementById('nosttp' + nip).value;

	$.get('trans_/pendapatan/simpansttp.php', { notrans: notrans, nip: nip, nosttp: nosttp },
		function (result) {
			var update = new Array();
			update = result.split('|');
			if (result.indexOf('|' != -1)) {
				if (update[0] == "OK") {
					swal("OK..!!", "DATA SUDAH DISIMPAN...", "success");
					gridpeserta(notrans);
				} else {
					swal("Gagal..!!!", result, "error");
				}
			}
		}
	);
}

function hapus(notrans) {
	if (confirm("apakah yakin data akan dihapus?")) {
		$.get("trans_/pendapatan/hapus.php", { notrans: notrans }, function (result) {
			if (result == "OK") {
				datapendapatan();
			}
			else {
				swal("GAGAL", result, "error");
			}
		});
	}
}

function kunci(notrans, garis) {
	swal({
		title: "PERINGATAN",
		text: "Apakah Anda Yakin Akan Mengunci Data ini?",
		type: "warning",
		showCancelButton: true,
		confirmButtonClass: "btn-danger",
		confirmButtonText: "Ya, Kunci ini!",
		cancelButtonText: "Tidak!",
		closeOnConfirm: false
	}, function (dismiss) {
		if (dismiss == true) {
			$.get("trans_/pendapatan/kunci.php", { notrans: notrans },
				function (result) {
					if (result == "OK") {
						setTimeout(function () {
							swal("TRANSAKSI SUDAH TERKUNCI!");
							//$('#'+garis).html('<img src="images/keyxx.png" width="20" height="20">');
							datapendapatan();
						}, 2000);
					} else {
						swal(result);
					}
				});
		}
	});
}

function bukakunci(notrans, garis) {
	swal({
		title: "PERINGATAN",
		text: "Apakah Anda Yakin Akan Membuka Kunci Data ini?",
		type: "warning",
		showCancelButton: true,
		confirmButtonClass: "btn-danger",
		confirmButtonText: "Ya, Buka Kunci ini!",
		cancelButtonText: "Tidak!",
		closeOnConfirm: false
	}, function (dismiss) {
		if (dismiss == true) {
			$.get("trans_/pendapatan/bukakunci.php", { notrans: notrans },
				function (result) {
					if (result == "OK") {
						setTimeout(function () {
							swal("TRANSAKSI SUDAH TERBUKA!");
							//$('#'+garis).html('<img src="images/keyxx.png" width="20" height="20">');
							datapendapatan();
						}, 2000);
					} else {
						swal(result);
					}
				});
		}
	});
}