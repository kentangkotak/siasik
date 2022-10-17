function formpendapatan(notrans) {
	jfloading("sub_konten");
	$.get("trans_/perubahan/paguindikatif_pak/form.php", { notrans: notrans },
		function (result) {
			$("#sub_konten").html(result);
			fungsikomplet();
			$('#nilairupiah').mask('000,000,000,000.00', { reverse: true });
			$.get("trans_/perubahan/paguindikatif_pak/getjumlahpendapatanpertahun.php", function (result) {
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
	$.get("trans_/perubahan/paguindikatif_pak/datapendapatan.php",
		function (result) {
			$("#sub_konten").html(result);
			jfdata_table();
		}
	);
}


function fungsikomplet() {
	$("#koderekeningblud").autocomplete({
		serviceUrl: 'trans_/perubahan/paguindikatif_pak/autobyakunblud.php',
		type: "GET",
		onSelect: function (suggestion) {
			$('#koderekeningblud').val(suggestion.koderekening);
			$('#uraian').val(suggestion.uraian);
		}

	})
	$("#uraian").autocomplete({
		serviceUrl: 'trans_/perubahan/paguindikatif_pak/autobyuraian.php',
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
		$.get('trans_/perubahan/paguindikatif_pak/simpan.php', { notrans: notrans, bidang: bidang, koderekeningblud: koderekeningblud, uraian: uraian, nilairupiah: nilairupiah, map79: map79, kode79: kode79, uraian79, uraian79 },
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

function hapus(notrans) {
	if (confirm("apakah yakin data akan dihapus?")) {
		$.get("trans_/perubahan/paguindikatif_pak/hapus.php", { notrans: notrans }, function (result) {
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
			$.get("trans_/perubahan/paguindikatif_pak/kunci.php", { notrans: notrans },
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