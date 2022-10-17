function dataperubahanrincianbelanja() {
	jfloading("sub_konten");
	$.get("trans_/perubahan/perubahan_rincian_belanja_pak/dataperubahanrincianbelanja.php",
		function (result) {
			$("#sub_konten").html(result);
			jfdata_table();
		}
	);
}

function formperubahanrincianbelanja(notrans) {
	jfloading("sub_konten");
	$.get("trans_/perubahan/perubahan_rincian_belanja_pak/formperubahanrincianbelanja.php", { notrans: notrans },
		function (result) {
			$("#sub_konten").html(result);
			$('#harga').mask('000,000,000,000.00', { reverse: true });
			fungsikomplet();
			if (notrans != undefined) {
				mati();
			}
			gridrinci(notrans);
			document.form_rinci.bidangPengusul.disabled = true;
		}
	);
}

function fungsikomplet() {
	$("#kegiatan").autocomplete({
		serviceUrl: 'trans_/perubahan/perubahan_rincian_belanja_pak/autobykegiatan.php',
		type: "GET",
		onSelect: function (suggestion) {
			$('#kegiatan').val(suggestion.nomenklatur);
			$('#kodekegiatan').val(suggestion.no);
			$('#kodebagian').val(suggestion.kodebagian);
			$('#organisasi_nama').val(suggestion.organisasi_nama);
			$('#kode50').val(suggestion.kode50);
			$('#uraian').val(suggestion.uraian);
		}

	});
}

function datapengusulanxz() {
	jfloading("sub_konten");
	$.get("trans_/perubahan/perubahan_rincian_belanja_pak/datapengusulanxz.php",
		function (result) {
			$("#sub_konten").html(result);
			jfdata_table();
		}
	);
}


function viewrinci(kode) {
	$.fancybox({
		'href': 'trans_/pengusulan/datapengusulan_rinci.php?kode=' + kode,
		'overlayOpacity': 0,
		//'opacity'		: true,
		//'transitionIn'	: 'elastic',
		'type': 'ajax',
		//'z-index'		: '-1'
	});
}


function simpanpagu() {

	notrans = document.form.notrans.value;
	kodekegiatanblud = document.form.kodekegiatanblud.value;
	kegiatanblud = document.form.kegiatanblud.value;
	nilairupiah = document.form.nilairupiah.value;
	kode1 = document.form.kode1.value;
	kode2 = document.form.kode2.value;
	kode3 = document.form.kode3.value;
	organisasi_nama = document.form.organisasi_nama.value;

	if (kodekegiatanblud == '') {
		swal("Gagal..!!!", "KEGIATAN BELUM DI ISI ATAU KEGIATAN BELUM TERDAFTAR....!!!", "error");
	} else if (nilairupiah == '') {
		swal("Gagal..!!!", "NILAI RUPIAH HARUS DI ISI..!!!", "error");
	} else {
		$.get('trans_/perubahan/perubahan_rincian_belanja_pak/simpan.php', {
			notrans: notrans, kodekegiatanblud: kodekegiatanblud, kegiatanblud: kegiatanblud, nilairupiah: nilairupiah,
			kode1: kode1, kode2: kode2, kode3: kode3, organisasi_nama: organisasi_nama
		},
			function (result) {
				var update = new Array();
				update = result.split('|');
				if (result.indexOf('|' != -1)) {
					if (update[0] == "OK") {
						swal("OK..!!", "DATA SUDAH DISIMPAN...", "success");
						document.form.notrans.value = update[1];
						formpengusulan();
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

function batal() {
	notrans = document.form.notrans.value;
	jfloading("sub_konten");
	$.get("trans_/perubahan/perubahan_rincian_belanja_pak/batal.php", { notrans: notrans }, function (result) {
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


function simpantranskegiatan() {

	notrans = document.form.notrans.value;
	ruangan = document.form.ruangan.value;
	tgltrans = document.form.tgltrans.value;
	koderuang = document.form.koderuang.value;
	kodekegiatan = document.form.kodekegiatan.value;
	kodebagian = document.form.kodebagian.value;
	organisasi_nama = document.form.organisasi_nama.value;
	kode50 = document.form.kode50.value;
	uraian = document.form.uraian.value;
	kegiatan = document.form.kegiatan.value;

	keterangan = document.form_rinci.usulan.value;
	volume = document.form_rinci.volume.value;
	harga = document.form_rinci.harga.value;
	satuan = document.form_rinci.satuan.value;
	bidangPengusul = document.form_rinci.bidangPengusul.value;
	idpp = document.form_rinci.idpp.value;
	paguterakhir = document.form_rinci.paguterakhir.value;
	realisasi = document.form_rinci.realisasi.value;
	sisaanggaran = document.form_rinci.sisaanggaran.value;
	npdbelumcair = document.form_rinci.npdbelumcair.value;
	pagualokasi = document.form_rinci.pagualokasi.value;

	koderek50 = document.form_rinci.koderek50.value;
	uraian50 = document.form_rinci.uraian50.value;
	koderek108 = document.form_rinci.koderek108.value;
	uraian108 = document.form_rinci.uraian108.value;

	if (koderuang == '') {
		swal("Gagal..!!!", "RUANGAN TIDAK BOLEH KOSONG ATAU RUANGAN BELUM TERDAFTAR....!!!", "error");
	} else if (ruangan == '') {
		swal("Gagal..!!!", "RUANGAN TIDAK BOLEH KOSONG ATAU RUANGAN BELUM TERDAFTAR....!!!", "error");
	} else if (tgltrans == '') {
		swal("Gagal..!!!", "TANGGAL TIDAK BOLEH KOSONG....!!!", "error");
	} else if (kodekegiatan == '') {
		swal("Gagal..!!!", "KEGIATAN TIDAK BOLEH KOSONG ATAU KEGIATAN BELUM TERDAFTAR....!!!", "error");
	} else if (kegiatan == '') {
		swal("Gagal..!!!", "KEGIATAN TIDAK BOLEH KOSONG ATAU KEGIATAN BELUM TERDAFTAR....!!!", "error");
	} else if (keterangan == '') {
		swal("Gagal..!!!", "KETERANGAN TIDAK BOLEH KOSONG....!!!", "error");
	} else if (volume == '') {
		swal("Gagal..!!!", "JUMLAH YANG DIACC DARI MUSRENBANG TIDAK BOLEH KOSONG....!!!", "error");
	} else if (harga == '') {
		swal("Gagal..!!!", "HARGA TIDAK BOLEH KOSONG....!!!", "error");
	} else if (bidangPengusul == '') {
		swal("Gagal..!!!", "BIDANG PENGUSUL TIDAK BOLEH KOSONG....!!!", "error");
	} else if (koderek50 == '') {
		swal("Gagal..!!!", "KODE REKENING 50 TIDAK BOLEH KOSONG/BELUM TERDAFTAR....!!!", "error");
	} else if (uraian50 == '') {
		swal("Gagal..!!!", "KODE REKENING 50 TIDAK BOLEH KOSONG/BELUM TERDAFTAR....!!!", "error");
		// }else if(koderek108==''){
		// swal("Gagal..!!!", "KODE REKENING 108 TIDAK BOLEH KOSONG/BELUM TERDAFTAR....!!!", "error");
		// }else if(uraian108==''){
		// swal("Gagal..!!!", "KODE REKENING 108 TIDAK BOLEH KOSONG/BELUM TERDAFTAR....!!!", "error");
	} else {
		$.get('trans_/perubahan/perubahan_rincian_belanja_pak/simpan.php', {
			satuan: satuan, bidangPengusul: bidangPengusul, notrans: notrans, ruangan: ruangan, tgltrans: tgltrans, koderuang: koderuang, kodekegiatan: kodekegiatan, kegiatan: kegiatan, keterangan: keterangan,
			volume: volume, harga: harga, kodebagian: kodebagian, organisasi_nama: organisasi_nama, kode50: kode50, uraian: uraian, idpp: idpp, paguterakhir: paguterakhir, realisasi: realisasi, sisaanggaran: sisaanggaran,
			npdbelumcair: npdbelumcair, pagualokasi: pagualokasi, koderek50: koderek50, uraian50: uraian50, koderek108: koderek108, uraian108: uraian108
		},
			function (result) {
				var update = new Array();
				update = result.split('|');
				if (result.indexOf('|' != -1)) {
					if (update[0] == "OK") {
						clearrinciwew();
						swal("OK..!!", "DATA SUDAH DISIMPAN...", "success");
						document.form.notrans.value = update[1];
						gridrinci(update[1]);
						document.form_rinci.usulan.disabled = false;
					} else {
						swal("Gagal..!!!", result, "error");
					}
				}
			}
		);
	}
}

function mati() {
	document.form.tgltrans.disabled = true;
	document.form.kegiatan.disabled = true;
}

function clearrinci() {

	document.form_rinci.keterangan.value = '';
	document.form_rinci.volume.value = '';
	document.form_rinci.harga.value = '';
}

async function gridrinci(notrans) {
	jfloading("grid_nilai");
	await $.get("trans_/perubahan/perubahan_rincian_belanja_pak/gridrinci.php", { notrans: notrans },
		function (result) {
			$("#grid_nilai").html(result);
			jfdata_table();
		}
	);

	kodekegiatan = document.form.kodekegiatan.value;
	await $.getJSON("trans_/perubahan/perubahan_rincian_belanja_pak/getPaguByKegiatan.php", { kodekegiatan: kodekegiatan }, function (result) {
		warna = "";
		if (result.sisaPagu < 1) {
			warna = `style='font-color:red;'`;
		}
		$("#contentPagu").html(`
			<b ${warna}>
				<br>Pagu : ${result.paguRp}
				<br>Total Usualan : ${result.totalUsulanRp}
				<br>Sisa : ${result.sisaPaguRp}
				<br>
			</b>
		`);
	});
}

function datapengusulanhonor() {
	jfloading("sub_konten");
	$.get("trans_/pengusulan/datapengusulanhonor.php",
		function (result) {
			$("#sub_konten").html(result);
			jfdata_table();
		}
	);
}

function hapus_rinci(id, notrans) {
	jfloading("grid_nilai");
	$.get("trans_/perubahan/perubahan_rincian_belanja_pak/hapus_rinci.php", { id: id, notrans: notrans }, function (result) {
		var update = new Array();
		update = result.split('|');
		if (result.indexOf('|' != -1)) {
			if (update[0] == "OK") {
				swal("OK..!!", "DATA SUDAH DIHAPUS...", "success");
				gridrinci(notrans);
			} else {
				swal("Gagal..!!!", result, "error");
				gridrinci(notrans);
			}
		}
	}
	);
}

function hapustransaksi() {
	notrans = document.form.notrans.value;
	jfloading("sub_konten");
	$.get("trans_/perubahan/perubahan_rincian_belanja_pak/hapustransaksi.php", { notrans: notrans }, function (result) {
		var update = new Array();
		update = result.split('|');
		if (result.indexOf('|' != -1)) {
			if (update[0] == "OK") {
				swal("OK..!!", "DATA SUDAH DIHAPUS...", "success");
				datapengusulanhonor();
			} else {
				swal("Gagal..!!!", result, "error");
				datapengusulanhonor();
			}
		}
	}
	);
}

function hapusHeader(notrans) {
	if (confirm("apakah yakin data akan dihapus?")) {
		$.get("trans_/perubahan/perubahan_rincian_belanja_pak/hapusHeader.php", { notrans: notrans }, function (result) {
			if (result == "OK") {
				dataperubahanrincianbelanja();
			}
			else {
				swal("GAGAL", result, "error");
			}
		});
	}
}

function getPaguByKegiatan(kodekegiatan) {
	$.getJSON("trans_/perubahan/perubahan_rincian_belanja_pak/getPaguByKegiatan.php", { kodekegiatan: kodekegiatan }, function (result) {
		if (result.sisaPagu > 0) {
			swal("Sisa pagu : " + result.sisaPaguRp, "", "success");
		}
		else {
			swal("Sisa pagu : " + result.sisaPaguRp, "", "error");
		}
	});
}

function kunci(notrans) {
	jfloading("sub_konten");
	$.get("trans_/perubahan/perubahan_rincian_belanja_pak/kunci.php", { notrans: notrans }, function (result) {
		var update = new Array();
		update = result.split('|');
		if (result.indexOf('|' != -1)) {
			if (update[0] == "OK") {
				swal("OK..!!", "DATA SUDAH TERKUNCI...", "success");
				dataperubahanrincianbelanja();
			} else {
				swal("Gagal..!!!", result, "error");
			}
		}
	}
	);
}

function bukakunci(notrans) {
	jfloading("sub_konten");
	$.get("trans_/perubahan/perubahan_rincian_belanja_pak/bukakunci.php", { notrans: notrans }, function (result) {
		var update = new Array();
		update = result.split('|');
		if (result.indexOf('|' != -1)) {
			if (update[0] == "OK") {
				swal("OK..!!", "KUNCI TELAH DIBUKA...", "success");
				dataperubahanrincianbelanja();
			} else {
				swal("Gagal..!!!", result, "error");
			}
		}
	}
	);
}

function caririncianbelanja() {
	//clearrinci();
	kodekegiatan = document.form.kodekegiatan.value;
	if (kodekegiatan == '') {
		swal("Gagal..!!!", 'MAAF KEGIATAN HARUS DIISI...!!!', "error");
	} else {
		$.fancybox({
			'href': 'trans_/perubahan/perubahan_rincian_belanja_pak/caririncianbelanja.php?kodekegiatan=' + kodekegiatan,
			'overlayOpacity': 0,
			'opacity': true,
			'transitionIn': 'elastic',
			'type': 'ajax'
		});
	}
}

function pilihrincianbelanja(idpp, usulan, paguterakhir, realisasi, sisaanggaran, npdbelumcair, pagualokasi, koderek50, uraian50, koderek108, uraian108) {
	document.form_rinci.idpp.value = idpp;
	document.form_rinci.usulan.value = usulan;
	document.form_rinci.paguterakhir.value = paguterakhir;
	document.form_rinci.realisasi.value = realisasi;
	document.form_rinci.npdbelumcair.value = npdbelumcair;
	document.form_rinci.pagualokasi.value = pagualokasi;
	document.form_rinci.sisaanggaran.value = sisaanggaran;
	document.form_rinci.koderek50.value = koderek50;
	document.form_rinci.uraian50.value = uraian50;
	document.form_rinci.koderek108.value = koderek108;
	document.form_rinci.uraian108.value = uraian108;

	document.form_rinci.usulan.disabled = true;
	closeMessage();

}

function clearrinciwew() {
	document.form_rinci.usulan.value = '';
	document.form_rinci.volume.value = '';
	document.form_rinci.harga.value = '';
	document.form_rinci.satuan.value = '';
	document.form_rinci.idpp.value = '';
	document.form_rinci.paguterakhir.value = '';
	document.form_rinci.realisasi.value = '';
	document.form_rinci.sisaanggaran.value = '';
	document.form_rinci.npdbelumcair.value = '';
	document.form_rinci.pagualokasi.value = '';
	document.form_rinci.koderek50.value = '';
	document.form_rinci.uraian50.value = '';
	document.form_rinci.koderek108.value = '';
	document.form_rinci.uraian108.value = '';
}

function carirekening50() {
	$.fancybox({
		'href': 'trans_/perubahan/perubahan_rincian_belanja_pak/carirekening50.php',
		'overlayOpacity': 0,
		'opacity': true,
		'transitionIn': 'elastic',
		'closeBtn': true,
		'openEffect': 'elastic',
		'type': 'ajax'
	});
}

function carirekening108() {
	$.fancybox({
		'href': 'trans_/perubahan/perubahan_rincian_belanja_pak/carirekening108.php',
		'overlayOpacity': 0,
		'opacity': true,
		'transitionIn': 'elastic',
		'closeBtn': true,
		'openEffect': 'elastic',
		'type': 'ajax'
	});
}
function pilihrekening50(kode50, uraian50) {
	document.form_rinci.koderek50.value = kode50;
	document.form_rinci.uraian50.value = uraian50;
	closeMessage();
}

function pilihrekening108(kode108, uraian108) {
	document.form_rinci.koderek108.value = kode108;
	document.form_rinci.uraian108.value = uraian108;
	closeMessage();
}

function kunciPak(thn) {
	//alert(thn)
	jfloading("sub_konten");
	$.get("trans_/perubahan/perubahan_rincian_belanja_pak/kunciPak.php", { thn: thn }, function (result) {
		var update = new Array();
		update = result.split('|');
		if (result.indexOf('|' != -1)) {
			if (update[0] == "OK") {
				$.get("trans_/perubahan/perubahan_rincian_belanja_pak/kunciPakPagu.php", { thn: thn }, function (resultx) {
					var updatex = new Array();
					updatex = resultx.split('|');
					if (resultx.indexOf('|' != -1)) {
						if (updatex[0] == "OK") {
							$.get("trans_/perubahan/perubahan_rincian_belanja_pak/kunciPakRincianPagu.php", { thn: thn }, function (resultxx) {
								var updatexx = new Array();
								updatexx = resultxx.split('|');
								if (resultxx.indexOf('|' != -1)) {
									if (updatexx[0] == "OK") {
										dataperubahanrincianbelanja();
									} else {
										swal("Gagal..!!!", resultxx, "error");
									}
								}
							});
						} else {
							swal("Gagal..!!!", resultx, "error");
						}
					}
				});
			} else {
				swal("Gagal..!!!", result, "error");
			}
		}
	});
}