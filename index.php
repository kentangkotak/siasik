<?php include("conn.php"); ?>
<!DOCTYPE html>
<html lang="en"  style="height:100%">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" href="images/logors.png" type="image/ico" />

    <title>.::Sistem Informasi Akuntansi & Keuangan RSUD dr. UOBK Mohamad Saleh</title>
	
	<link href="fitur_export/buttons.dataTables.min.css" rel="stylesheet">	
    <!-- Bootstrap -->
    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<link rel="stylesheet" href="css/all.min.css">
	<link rel="stylesheet" href="style.css">
    <link href="vendors/nprogress/nprogress.css" rel="stylesheet">
    <link href="vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <link href="vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <link href="vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <link href="vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <link href="vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css" rel="stylesheet">
    <link href="vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
    <link href="vendors/select2/dist/css/select2.min.css" rel="stylesheet">
    <link href="vendors/switchery/dist/switchery.min.css" rel="stylesheet">
    <link href="vendors/starrr/dist/starrr.css" rel="stylesheet">
    <link href="sweetalert/sweetalert.css" rel="stylesheet" type="text/css">
    <!--<link rel="stylesheet" type="text/css" href="fancybox/jquery.fancybox-1.3.4.css" media="screen" />-->
	<link rel="stylesheet" type="text/css" href="button_css.css" media="screen" />
	<link rel="stylesheet" href="fancybox/source/jquery.fancybox.css?v=2.1.7" type="text/css" media="screen" />
	<link rel="stylesheet" href="fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" type="text/css" media="screen" />
	<link rel="stylesheet" href="fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen" />
	<!--<link rel="stylesheet" type="text/css" href="fancybox/jquery.fancybox.css?v=2.1.7" media="screen" />
	<link href="vendors/pnotify/dist/pnotify.css" rel="stylesheet">
    <link href="vendors/pnotify/dist/pnotify.buttons.css" rel="stylesheet">
	<link href="vendors/pnotify/dist/pnotify.nonblock.css" rel="stylesheet"> -->
	
	<link href="../build/css/custom.min.css" rel="stylesheet">

    <link href="build/css/custom.min.css" rel="stylesheet">
    <script type="text/javascript">
      <?php if(!isset($_SESSION["anggaran_kodeuser"])){ ?>
      document.location="login.php";
	  //document.location="xxx.php";
	   <?php } ?>
      //dashboard();
    </script>
    
  </head>

  <body  style="height:100%">
    <div class="container body"  style="height:100%">
	  <!--<div data-component="navbar">
		<nav class="navbar p-0 fixed-top">-->
		  <div class="header" style="z-index:998">
			<table border="0" class="hdrtbl" ><tr>
			<td width="100px" align="center"><img src="images/pemkot_header.png"></td>
			<td align="center">
			<img src="images/Logo_cnt.png"  height="88px">
			</td>
			<td width="100px" align="center"><img src="images/rs_header.png"></td>
			</tr>
			</table>
			<div class="header_bot"></div>
		  </div>
		 <!--</nav>
	  </div> --><!-- END TOP NAVBAR -->
	  
      <div class="main_container"  style="height:100%">
	  
	  <div data-component="sidebar">
		  <div class="sidebar">
		  <ul class="list-group flex-column d-inline-block first-menu">
			<?php if(strpos($_SESSION['anggaran_menu'],"|MASTER|")!==false){ ?>
                  <li class="list-group-item px-1 py-6"><a><i class="fa fa-book-open" aria-hidden="true"><span class="ml-2 align-middle">Master </span></i></a>
                    <ul class="list-group flex-column d-inline-block submenu">
						<li class="list-group-item px-2 py-1 "><a>Kegiatan</a>
						  <ul class="list-group flex-column d-inline-block sub-submenu">
							<span class="arrow"></span>
							<li class="list-group-item px-2 py-1 "><a  href="javascript:void(0)" onClick="kegiatan_blud();">Kegiatan BLUD </a></li>
							<li class="list-group-item px-2 py-1 "><a  href="javascript:void(0)" onClick="kemendagri50c();">Kegiatan Permendagri 50 Perencanaan Pembangunan </a></li>
							<!--<li class="list-group-item px-2 py-1 "><a href="javascript:void(0)" onClick="kemendagri50e();">Kegiatan Permendagri 50 Fungsi </a></li>-->
						  </ul>
						</li>
						<li class="list-group-item px-2 py-1 "><a>Akun</a>
						  <ul class="list-group flex-column d-inline-block sub-submenu">
							<span class="arrow" style="top:118px;"></span>
							<li class="list-group-item px-2 py-1 "><a href="javascript:void(0)" onClick="akunblud();">Akun BLUD </a></li>
							<li class="list-group-item px-2 py-1 "><a href="javascript:void(0)" onClick="akun_permendagri50();">Akun Permendagri 50 </a></li>
							<li class="list-group-item px-2 py-1 "><a href="javascript:void(0)" onClick="akun_permendagri79();">Akun Permendagri 79 </a></li>
							<li class="list-group-item px-2 py-1 "><a href="javascript:void(0)" onClick="akun_psap13();">Akun PSAP 13 </a></li>
							<li class="list-group-item px-2 py-1 "><a href="javascript:void(0)" onClick="akun_permendagri108();">Akun Permendagri 108 </a></li>
						  </ul>
						</li>
						<li class="list-group-item px-2 py-1 "><a>Mapping</a>
						  <ul class="list-group flex-column d-inline-block sub-submenu">
							<span class="arrow" style="top:145px;"></span>
							<li class="list-group-item px-2 py-1 "><a href="javascript:void(0)" onClick="mapingkegiatanbludkepemkot();">Mapping Kegiatan BLUDK Pemkot </a></li>
							<!--<li><a href="javascript:void(0)" onClick="namapelatihan();">Mapping Akun BLUD ke Permendagri 50 </a></li>-->
							<li class="list-group-item px-2 py-1 "><a href="javascript:void(0)" onClick="mapping_blud_79();">Mapping Akun BLUD ke Permendagri 79 </a></li>
							<li class="list-group-item px-2 py-1 "><a href="javascript:void(0)" onClick="mapping_blud_psap13();">Mapping Akun BLUD ke SAP 13 </a></li>
							<li class="list-group-item px-2 py-1 "><a href="javascript:void(0)" onClick="mapping_108_blud();">Mapping Permendagri 108 ke Akun BLUD </a></li>
							<!--<li class="list-group-item px-2 py-1 "><a href="javascript:void(0)" onClick="namapelatihan();">Mapping PPTK Kegiatan  </a></li>-->
							<!--<li class="list-group-item px-2 py-1 "><a href="javascript:void(0)" onClick="namapelatihan();">Mapping KEGIATAN ke Organisasi</a></li>-->
							<li class="list-group-item px-2 py-1 "><a href="javascript:void(0)" onClick="mappingpptkkegiatan();">Mapping PPTK Kegiatan </a></li>
						  </ul>
						</li>
							<li class="list-group-item px-2 py-1 "><a href="javascript:void(0)" onClick="organisasi();">Organisasi Anggaran </a></li>
							<li class="list-group-item px-2 py-1 "><a href="javascript:void(0)" onClick="satuanBarang();">Satuan Barang </a></li>
							<li class="list-group-item px-2 py-1 "><a href="javascript:void(0)" onClick="pihakketiga();">Pihak Ketiga </a></li>
							<li class="list-group-item px-2 py-1 "><a href="javascript:void(0)" onClick="pptk();">PPTK </a></li>
					</ul>
                  </li>
				  <?php }?>	
				  <?php if(strpos($_SESSION['anggaran_menu'],"|PENYUSUNAN|")!==false){ ?>
                  <li class="list-group-item px-1 py-6"><a><i class="fa fa-swatchbook" aria-hidden="true"><span class="ml-2 align-middle">Penyusunan </span></i></a>
                    <ul class="list-group flex-column d-inline-block submenu">
							<?php if(strpos($_SESSION['anggaran_submenu'],"|PENDAPATAN|")!==false){ ?>
							  <li class="list-group-item px-2 py-1 "><a href="javascript:void(0)" onClick="pendapatan();">Pendapatan </a></li>
							<?php }?>
							  <li class="list-group-item px-2 py-1 "><a href="javascript:void(0)" onClick="penetapanpagu();">Penetapan Pagu </a></li>
							  <li class="list-group-item px-2 py-1 "><a href="javascript:void(0)" onClick="pengusulan();">Pengusulan </a></li>
							  <li class="list-group-item px-2 py-1 "><a href="javascript:void(0)" onClick="penyesuaianperioritas();">Penyesuaian Perioritas </a></li>
							  <li class="list-group-item px-2 py-1 "><a href="javascript:void(0)" onClick="penetapananggaran();">Penetapan Anggaran </a></li>
                    </ul>
                  </li>
				  <?php }?>
				  <?php if(strpos($_SESSION['anggaran_menu'],"|FARMASI|")!==false){ ?>
					<li class="list-group-item px-1 py-6"><a><i class="fa fa-medkit" aria-hidden="true"><span class="ml-2 align-middle">Farmasi </span></i></a>
					<ul class="list-group flex-column d-inline-block submenu">
                      <?php if(strpos($_SESSION['anggaran_submenu'],"|PEMBEBASAN PAJAK FARMASI|")!==false){ ?>
					  <li class="list-group-item px-2 py-1 "><a href="javascript:void(0)" onClick="pembebasanpajakfarmasi();">Pembebasan Pajak Faktur </a></li>
					  <?php }?>
					</ul>
				  <?php }?>
				   <?php if(strpos($_SESSION['anggaran_menu'],"|VERIF MASUK PPK|")!==false){ ?>
					<li class="list-group-item px-1 py-6"><a><i class="fa fa-retweet" aria-hidden="true"><span class="ml-2 align-middle">Pendapatan </span></i></a>
					<ul class="list-group flex-column d-inline-block submenu">
                      <?php if(strpos($_SESSION['anggaran_submenu'],"|SURAT TANDA SETORAN|")!==false){ ?>
					  <li class="list-group-item px-2 py-1 "><a href="javascript:void(0)" onClick="setoransts();">Surat Tanda Setoran</a></li>
					  <?php }?>
					</ul>
				  <?php }?>	
				  <?php if(strpos($_SESSION['anggaran_menu'],"|PANJAR|")!==false){ ?>
                  <li class="list-group-item px-1 py-6"><a><i class="fa fa-money-bill-wave" aria-hidden="true"><span class="ml-2 align-middle">Panjar</span></i></a>
                    <ul class="list-group flex-column d-inline-block submenu">
					  <li class="list-group-item px-2 py-1 "><a>SPP</a>
					 <ul class="list-group flex-column d-inline-block sub-submenu">
						<span class="arrow"></span>
						<?php if(strpos($_SESSION['anggaran_submenu'],"|SPP|")!==false){ ?>
						  <li class="list-group-item px-2 py-1 "><a href="javascript:void(0)" onClick="menuspp();">SPP UP</a></li>
						<?php }?>
						<?php if(strpos($_SESSION['anggaran_submenu'],"|VERIF SPP|")!==false){ ?>
						  <li class="list-group-item px-2 py-1 "><a href="javascript:void(0)" onClick="menuverifspp();">Verif SPP </a></li>
						<?php }?>
					 </ul>
					</li>
					<?php if(strpos($_SESSION['anggaran_submenu'],"|SPM|")!==false){ ?>
					  <li class="list-group-item px-2 py-1 "><a href="javascript:void(0)" onClick="menuspm();">SPM </a></li>
					<?php }?>
					  <li class="list-group-item px-2 py-1"><a>NPD</a>
						 <ul class="list-group flex-column d-inline-block sub-submenu">
							<span class="arrow"  style="top:145px;"></span>
							<?php if(strpos($_SESSION['anggaran_submenu'],"|NPD PANJAR|")!==false){ ?>
							  <li class="list-group-item px-2 py-1 "><a href="javascript:void(0)" onClick="npdPanjar();">NPD Panjar </a></li>
							<?php }?>
							<?php if(strpos($_SESSION['anggaran_submenu'],"|VERIF NPD PANJAR|")!==false){ ?>
							  <li class="list-group-item px-2 py-1 "><a href="javascript:void(0)" onClick="verifnpdPanjar();">Verif NPD Panjar </a></li>
							<?php }?>
						 </ul>
						</li>
					<?php if(strpos($_SESSION['anggaran_submenu'],"|NPK PANJAR|")!==false){ ?>
					  <li class="list-group-item px-2 py-1 "><a href="javascript:void(0)" onClick="npkpanjar();">NPK Panjar</a></li>
					<?php }?>
					  <li class="list-group-item px-2 py-1"><a>Pergeseran Kas</a>
						 <ul class="list-group flex-column d-inline-block sub-submenu">
							<span class="arrow"  style="top:205px;"></span>
							<?php if(strpos($_SESSION['anggaran_submenu'],"|PERGESERAN KAS|")!==false){ ?>
							  <li class="list-group-item px-2 py-1 "><a href="javascript:void(0)" onClick="pergeseran_kas();">Pergeseran Kas </a></li>
							<?php }?>
							<?php if(strpos($_SESSION['anggaran_submenu'],"|VERIF PERGESERAN KAS|")!==false){ ?>
							  <li class="list-group-item px-2 py-1 "><a href="javascript:void(0)" onClick="verif_pergeseran_kas();">Verif Pergeseran Kas </a></li>
							<?php }?>
						 </ul>
						</li>
					<?php if(strpos($_SESSION['anggaran_submenu'],"|NOTA PANJAR|")!==false){ ?>
					  <li class="list-group-item px-2 py-1 "><a href="javascript:void(0)" onClick="notapanjar();">Nota Panjar</a></li>
					<?php }?>
					  <li class="list-group-item px-2 py-1 "><a>SPJ Panjar</a>
						 <ul class="list-group flex-column d-inline-block sub-submenu">
							<span class="arrow"  style="top:260px;"></span>
							<?php if(strpos($_SESSION['anggaran_submenu'],"|SPJ PANJAR|")!==false){ ?>
							  <li class="list-group-item px-2 py-1 "><a href="javascript:void(0)" onClick="spjpanjar();">SPJ Panjar</a></li>
							<?php }?>
							<?php if(strpos($_SESSION['anggaran_submenu'],"|VERIF SPJ PANJAR|")!==false){ ?>
							  <li class="list-group-item px-2 py-1 "><a href="javascript:void(0)" onClick="verifspjpanjar();">Verif SPJ Panjar</a></li>
							<?php }?>
						 </ul>
						</li>
					 <li class="list-group-item px-2 py-1 "><a>Pengembalian</a>
						 <ul class="list-group flex-column d-inline-block sub-submenu">
							<span class="arrow" style="top:290px;"></span>
							<?php if(strpos($_SESSION['anggaran_submenu'],"|PENGEMBALIAN PANJAR|")!==false){ ?>
							  <li class="list-group-item px-2 py-1 "><a href="javascript:void(0)" onClick="pengembalianpanjar();">Pengembalian Panjar</a></li>
							<?php }?>
							<?php if(strpos($_SESSION['anggaran_submenu'],"|PENGEMBALIAN SISA SPJ PANJAR|")!==false){ ?>
							  <li class="list-group-item px-2 py-1 "><a href="javascript:void(0)" onClick="pengembaliansisaspj();">Pengembalian Sisa SPJ Panjar</a></li>
							<?php }?>
						 </ul>
						</li>
					
					<?php if(strpos($_SESSION['anggaran_submenu'],"|GU|")!==false){ ?>
					  <li class="list-group-item px-2 py-1 "><a href="javascript:void(0)" onClick="guu();">SPP GU</a></li>
					<?php }?>
					 </ul>
                  </li>
				  <?php }?>	
				  <?php if(strpos($_SESSION['anggaran_menu'],"|LS|")!==false){ ?>
				  <li class="list-group-item px-1 py-6"><a><i class="fa fa-credit-card" aria-hidden="true"><span class="ml-2 align-middle">LS </span></i></a>
                  <ul class="list-group flex-column d-inline-block submenu">
					<?php if(strpos($_SESSION['anggaran_submenu'],"|KONTRAK PENGERJAAN|")!==false){ ?>
					  <li class="list-group-item px-2 py-1 "><a href="javascript:void(0)" onClick="kotrakPekerjaan();">Kontrak Pengerjaan </a></li>
					<?php }?>
					<?php if(strpos($_SESSION['anggaran_submenu'],"|SERAH TERIMA PEKERJAAN|")!==false){ ?>
					  <li class="list-group-item px-2 py-1 "><a href="javascript:void(0)" onClick="serahterimapekerjaan();">Serah Terima Pekerjaan</a></li>
					<?php }?>
					<?php if(strpos($_SESSION['anggaran_submenu'],"|NPD LS|")!==false){ ?>
					  <li class="list-group-item px-2 py-1 "><a href="javascript:void(0)" onClick="npdls();">NPD LS</a></li>
					<?php }?>
					<?php if(strpos($_SESSION['anggaran_submenu'],"|VERIF NPD LS|")!==false){ ?>
					  <li class="list-group-item px-2 py-1 "><a href="javascript:void(0)" onClick="verifnpdls();">Verif NPD LS</a></li>
					<?php }?>
					<?php if(strpos($_SESSION['anggaran_submenu'],"|NPK LS|")!==false){ ?>
					  <li class="list-group-item px-2 py-1 "><a href="javascript:void(0)" onClick="npkls();">NPK LS</a></li>
					<?php }?>
					<?php if(strpos($_SESSION['anggaran_submenu'],"|PENCAIRAN LS|")!==false){ ?>
					  <li class="list-group-item px-2 py-1 "><a href="javascript:void(0)" onClick="pencairanls();">Pencairan LS</a></li>
					<?php }?>
                    </ul>
                  </li>
				  <?php }?>
				  <?php if(strpos($_SESSION['anggaran_menu'],"|CONTRA POST|")!==false){ ?>
					<li class="list-group-item px-1 py-6"><a><i class="fa fa-cloud" href="javascript:void(0)" onClick="contrapost();"><span class="ml-2 align-middle">Contra Post</span></i></a></li>
				  <?php }?>
				  <?php if(strpos($_SESSION['anggaran_menu'],"|PERGESERAN|")!==false){ ?>
                  <li class="list-group-item px-1 py-6"><a><i class="fa fa-exchange-alt" aria-hidden="true"><span class="ml-2 align-middle">Pergeseran </span></i></a>
                    <ul class="list-group flex-column d-inline-block submenu">
							  <li class="list-group-item px-2 py-1 "><a href="javascript:void(0)" onClick="paguindikatif();">Pergeseran Pendapatan</a></li>
						
							  <li class="list-group-item px-2 py-1 "><a href="javascript:void(0)" onClick="perubahanpagubelanja();">Pergeseran Pagu Kegiatan </a></li>
										
							  <li class="list-group-item px-2 py-1 "><a href="javascript:void(0)" onClick="perubahanrincianbelanja();">Pergeseran Rincian Belanja</a></li>
					
					</ul>
                  </li>
				  <?php }?>
				  <?php if(strpos($_SESSION['anggaran_menu'],"|PERUBAHAN|")!==false){ ?>
                  <li class="list-group-item px-1 py-6"><a><i class="fa fa-link" aria-hidden="true"><span class="ml-2 align-middle">Perubahan </span></i></a>
                    <ul class="list-group flex-column d-inline-block submenu">
						<?php if(strpos($_SESSION['anggaran_submenu'],"|SILPA|")!==false){ ?>
							  <li class="list-group-item px-2 py-1 "><a href="javascript:void(0)" onClick="silpa();">Silpa</a></li>
						<?php }?>
						<?php if(strpos($_SESSION['anggaran_submenu'],"|PENDAPATAN PAK|")!==false){ ?>
							  <li class="list-group-item px-2 py-1 "><a href="javascript:void(0)" onClick="paguindikatif_pak();">Pendapatan P.A.K</a></li>
						<?php }?>
						<?php if(strpos($_SESSION['anggaran_submenu'],"|PERUBAHAN PAGU KEGIATAN PAK|")!==false){ ?>
							  <li class="list-group-item px-2 py-1 "><a href="javascript:void(0)" onClick="perubahanpagubelanja_pak();">Perubahan Pagu Kegiatan P.A.K</a></li>
						<?php }?>
						<?php if(strpos($_SESSION['anggaran_submenu'],"|PERUBAHAN RINCIAN BELANJA|")!==false){ ?>
							  <li class="list-group-item px-2 py-1 "><a href="javascript:void(0)" onClick="perubahanpagubelanjarinci_pak();">Perubahan Rincian Belanja P.A.K</a></li>
						<?php }?>
						<!--	  <li class="list-group-item px-2 py-1 "><a href="javascript:void(0)" onClick="perubahanrincianbelanja_pak();">Pergeseran Setelah P.A.K</a></li>-->
                    </ul>
                  </li>
				  <?php }?>
				  <?php if(strpos($_SESSION['anggaran_menu'],"|PENATA USAHAAN|")!==false){ ?>
                  <li class="list-group-item px-1 py-6"><a><i class="fa fa-desktop" aria-hidden="true"><span class="ml-2 align-middle">Penata Usahaan </span></i></a>
                  <ul class="list-group flex-column d-inline-block submenu">
					  <li class="list-group-item px-2 py-1 "><a href="javascript:void(0)" onClick="msp3b();">SP3B </a></li>
                      <li class="list-group-item px-2 py-1 "><a href="javascript:void(0)" onClick="jurnalumum();">Jurnal Umum </a></li>
					<!--  <li class="list-group-item px-2 py-1 "><a href="javascript:void(0)" onClick="lapRekapPenyesuaianPerioritas();">Rekap Penyesuaian Perioritas </a></li>
					  <li class="list-group-item px-2 py-1 "><a href="javascript:void(0)" onClick="laporanrba();">Laporan RBA (Rencana Bisnis Anggaran)</a></li>
					  <li class="list-group-item px-2 py-1 "><a href="javascript:void(0)" onClick="laporanrka();">Laporan RKA (Rencana Kerja Dan Anggaran) </a></li>
					  <li class="list-group-item px-2 py-1 "><a href="javascript:void(0)" onClick="laporanlra();">Laporan LRA (Laporan Realisasi Anggaran) </a></li>
					  <li class="list-group-item px-2 py-1 "><a href="javascript:void(0)" onClick="laporanbku();">Laporan BKU (Laporan Buku Kas Umum) </a></li>-->
                    </ul>
				  <?php }?>	
				  <?php if(strpos($_SESSION['anggaran_menu'],"|LAPORAN|")!==false){ ?>
                  <li class="list-group-item px-1 py-6"><a><i class="fa fa-sticky-note" aria-hidden="true"><span class="ml-2 align-middle">Laporan </span></i></a>
                  <ul class="list-group flex-column submenu" style="overflow: scroll; height :80%;">
					  <?php if(strpos($_SESSION['anggaran_submenu'],"|REKAP PENGUSULAN|")!==false){ ?>
						<li class="list-group-item px-2 py-1 "><a href="javascript:void(0)" onClick="lapRekapPengusulan();">Rekap Pengusulan </a></li>
					  <?php }?>
					  <?php if(strpos($_SESSION['anggaran_submenu'],"|REKAP PENYESUAIAN PERIORITAS|")!==false){ ?>
						<li class="list-group-item px-2 py-1 "><a href="javascript:void(0)" onClick="lapRekapPenyesuaianPerioritas();">Rekap Penyesuaian Perioritas </a></li>
					  <?php }?>
					  <?php if(strpos($_SESSION['anggaran_submenu'],"|LAPORAN RBA|")!==false){ ?>
					    <li class="list-group-item px-2 py-1 "><a href="javascript:void(0)" onClick="laporanrba();">Laporan RBA (Rencana Bisnis Anggaran)</a></li>
					  <?php }?>
					  <?php if(strpos($_SESSION['anggaran_submenu'],"|LAPORAN RKA|")!==false){ ?>
						<li class="list-group-item px-2 py-1 "><a href="javascript:void(0)" onClick="laporanrka();">Laporan RKA (Rencana Kerja Dan Anggaran) </a></li>
					  <?php }?>
					  <?php if(strpos($_SESSION['anggaran_submenu'],"|LAPORAN LRA|")!==false){ ?>
					    <li class="list-group-item px-2 py-1 "><a href="javascript:void(0)" onClick="laporanlra();">Laporan LRA (Laporan Realisasi Anggaran) </a></li>
					  <?php }?>
					  <?php if(strpos($_SESSION['anggaran_submenu'],"|LAPORAN PENGAJUAN KEGIATAN|")!==false){ ?>
					    <li class="list-group-item px-2 py-1 "><a href="javascript:void(0)" onClick="laporanpengajuankegiatan();">Laporan Pengajuan Kegiatan</a></li>
					  <?php }?>
					  <?php if(strpos($_SESSION['anggaran_submenu'],"|LAPORAN BKU|")!==false){ ?>
					    <li class="list-group-item px-2 py-1 "><a href="javascript:void(0)" >Laporan BKU </a>
							<ul class="list-group flex-column d-inline-block sub-submenu">
							<span class="arrow"></span>
							<li class="list-group-item px-2 py-1 "><a  href="javascript:void(0)" onClick="formbkuppk();">BKU PPK </a></li>
							<li class="list-group-item px-2 py-1 "><a  href="javascript:void(0)" onClick="laporanbku();">BKU Bendahara Pengeluaran</a></li>
							<li class="list-group-item px-2 py-1 "><a  href="javascript:void(0)" onClick="formbkupptk();">BKU PPTK </a></li>
							<!--<li class="list-group-item px-2 py-1 "><a href="javascript:void(0)" onClick="kemendagri50e();">Kegiatan Permendagri 50 Fungsi </a></li>-->
						  </ul>
						</li>
					  <?php }?>
					  <?php if(strpos($_SESSION['anggaran_submenu'],"|BUKU BANTU|")!==false){ ?>
					    <li class="list-group-item px-2 py-1 "><a href="javascript:void(0)" >Buku Bantu</a>
							<ul class="list-group flex-column d-inline-block sub-submenu">
								<span class="arrow"></span>
								<li class="list-group-item px-2 py-1 "><a  href="javascript:void(0)" onClick="formbukubantuppkx();">Buku Bantu Bank PPK </a></li>
								<li class="list-group-item px-2 py-1 "><a  href="javascript:void(0)" onClick="formbukubantubendaharapengeluaranx();">Buku Bantu Bendahara Pengeluaran</a></li>
								<li class="list-group-item px-2 py-1 "><a  href="javascript:void(0)" onClick="formbukubantukaspptk();">Buku Bantu Kas PPTK </a></li>
								<!--<li class="list-group-item px-2 py-1 "><a href="javascript:void(0)" onClick="kemendagri50e();">Kegiatan Permendagri 50 Fungsi </a></li>-->
						    </ul>
						</li>
					  <?php }?>
					  <?php if(strpos($_SESSION['anggaran_submenu'],"|LAPORAN MANAJERIAL|")!==false){ ?>
					    <li class="list-group-item px-2 py-1 "><a href="javascript:void(0)" >Laporan Manajerial</a>
							<ul class="list-group flex-column d-inline-block sub-submenu">
								<span class="arrow"></span>
								<li class="list-group-item px-2 py-1 "><a  href="javascript:void(0)" onClick="anggaransuratedaran();">Anggaran Surat Edaran </a></li>
								<li class="list-group-item px-2 py-1 "><a  href="javascript:void(0)" onClick="anggaransuratedaranrealisasi();">Anggaran & Realisasi Surat Edaran</a></li>
								<li class="list-group-item px-2 py-1 "><a  href="javascript:void(0)" onClick="anggaranperkegiatan();">Anggaran Perkegiatan </a></li>
								<li class="list-group-item px-2 py-1 "><a  href="javascript:void(0)" onClick="anggarandanrealisasipptkegiatan();">Anggaran & Realisasi PPTK Kegiatan </a></li>
								<li class="list-group-item px-2 py-1 "><a  href="javascript:void(0)" onClick="realisasipermekanismebelanja();">Realisasi Permekanisme Belanja </a></li>
								<li class="list-group-item px-2 py-1 "><a  href="javascript:void(0)" onClick="anggarandanrealisasiper108();">Anggaran & Realisasi Per108</a></li>
								<li class="list-group-item px-2 py-1 "><a  href="javascript:void(0)" onClick="anggaranrealisasiper50();">Anggaran & Realisasi Per50</a></li>
								<li class="list-group-item px-2 py-1 "><a  href="javascript:void(0)" onClick="cashflow();">Cash Flow </a></li>
						    </ul>
						</li>
					  <?php }?>
					  <?php if(strpos($_SESSION['anggaran_submenu'],"|LAPORAN REALISASI BELANJA MODAL|")!==false){ ?>
						<li class="list-group-item px-2 py-1 "><a href="javascript:void(0)" onClick="realisasibelanjamodal();">Laporan Realisasi Belanja Modal</a></li>
					  <?php }?>
					  <?php if(strpos($_SESSION['anggaran_submenu'],"|LAPORAN RINCIAN NPK|")!==false){ ?>
						<li class="list-group-item px-2 py-1 "><a href="javascript:void(0)" onClick="rinciannpk();">Laporan Rincian NPK</a></li>
					  <?php }?>
					</ul>
				  <?php }?>	
                  </li>  
                  <li class="list-group-item px-1 py-6"><a><i class="fa fa-tools" aria-hidden="true"><span class="ml-2 align-middle">Setting </span></i></a>
                  <ul class="list-group flex-column d-inline-block submenu">
                      <li class="list-group-item px-2 py-1 "><a href="javascript:void(0)" onClick="settingLog();">Log</a></li>
                    </ul>
                  </li>  
				  <li class="list-group-item px-1 py-6"><a href="sign_out.php"><i class="fa fa-sign-out-alt" aria-hidden="true"><span class="ml-2 align-middle">Logout </span></i></a>
                  </li>   				  
		  </ul> <!-- /.first-menu -->
		</div> <!-- /.sidebar -->
		</div>
		<div class="wp-content"  style="height:100%">
		  <div class="container-fluid">
			<div id="page-wrapper">
			<center><img src="images/anime.gif" height="100%"></center>
			</div>
		  </div>
		</div>
		
        <!--<footer>
          <hr width="50%" align="center">
          <div align="center">
            Copyright © dr. Mohamad Saleh Kota Probolinggo. All rights reserved.1366x768
          </div>
        </footer>-->
        <!-- /footer content -->
      </div>
	  
    </div>	
  </body>
</html>
<script src="script.js"></script>
<script src="vendors/jquery/dist/jquery.min.js"></script>
<script src="vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script>
<script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="vendors/fastclick/lib/fastclick.js"></script>
<script src="vendors/nprogress/nprogress.js"></script>
<script src="vendors/Chart.js/dist/Chart.min.js"></script>
<script src="vendors/gauge.js/dist/gauge.min.js"></script>
<script src="vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
<script src="vendors/iCheck/icheck.min.js"></script>
<script src="vendors/skycons/skycons.js"></script>
<script src="vendors/Flot/jquery.flot.js"></script>
<script src="vendors/Flot/jquery.flot.pie.js"></script>
<script src="vendors/Flot/jquery.flot.time.js"></script>
<script src="vendors/Flot/jquery.flot.stack.js"></script>
<script src="vendors/Flot/jquery.flot.resize.js"></script>
<script src="vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
<script src="vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
<script src="vendors/flot.curvedlines/curvedLines.js"></script>
<script src="vendors/DateJS/build/date.js"></script>
<script src="vendors/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
<script src="vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
<script src="vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
<script src="vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
<script src="vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
<script src="vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
<script src="vendors/jszip/dist/jszip.min.js"></script>
<script src="vendors/pdfmake/build/pdfmake.min.js"></script>
<script src="vendors/pdfmake/build/vfs_fonts.js"></script>
<script src="build/js/custom.min.js"></script>
<script src="sweetalert/sweetalert.min.js"></script>
<script src="sweetalert/sweetalert-dev.js"></script>

<script src="vendors/moment/min/moment.min.js"></script>
<script src="vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
<script src="vendors/jquery.hotkeys/jquery.hotkeys.js"></script>
<script src="vendors/google-code-prettify/src/prettify.js"></script>  
<script src="vendors/jquery.tagsinput/src/jquery.tagsinput.js"></script>
<script src="vendors/switchery/dist/switchery.min.js"></script>
<script src="vendors/select2/dist/js/select2.full.min.js"></script>
<script src="vendors/autosize/dist/autosize.min.js"></script>
<script src="vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script>
<script type="text/javascript" src="fancybox/lib/jquery.mousewheel.pack.js"></script>
<script type="text/javascript" src="fancybox/source/jquery.fancybox.pack.js?v=2.1.7"></script>
<script type="text/javascript" src="fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
<script type="text/javascript" src="fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>
<script type="text/javascript" src="fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>
<!--<script src="vendors/pnotify/dist/pnotify.js"></script>
<script src="vendors/pnotify/dist/pnotify.buttons.js"></script>
<script src="vendors/pnotify/dist/pnotify.nonblock.js"></script> -->

<!--<script type="text/javascript" src="fitur_export/jquery.dataTables.min.js"></script>-->
<script type="text/javascript" src="fitur_export/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="fitur_export/jszip.min.js"></script>
<script type="text/javascript" src="fitur_export/pdfmake.min.js"></script>
<script type="text/javascript" src="fitur_export/vfs_fonts.js"></script>
<script type="text/javascript" src="fitur_export/buttons.html5.min.js"></script>
<script type="text/javascript" src="fitur_export/buttons.print.min.js"></script>
<!--<script type="text/javascript" src="fancybox/jquery.fancybox.pack.js?v=2.1.7"></script>
<script type="text/javascript" src="fancybox/jquery.fancybox.js?v=2.1.7"></script>-->
<script src="jquery.mask.js"></script>
<script src="vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
<script language="JavaScript">
// function autorefreshzz(){
//   timer_out=document.getElementById("timer_out").value;
//   $.get("menit.php",{timer_out:timer_out},function(result){
//     var tanggal = result.split("|");
//     $("#tgl_server").html(tanggal[0]);
//     var tgl = tanggal[0].split(" ");
//     var jams = tgl[1].split(":");
//     var jam=parseFloat(jams[0]);
//     var menit=parseFloat(jams[1]);
//     //alert(tanggal[1])
//     if(tanggal[1]==""){ document.location="login.php"; }

//   });

//   //document.getElementById('xtime').innerHTML=time;
//   tick=setTimeout("autorefreshzz()",30000);
// }
// autorefreshzz();
</script>

<?php include("close.php"); ?>
