<?php include("conn.php"); ?>
<!DOCTYPE html>
<html lang="en" style="height:100%">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="icon" href="images/logors.png" type="image/ico" />

    <title>Sistem Informasi Anggaran RSUD dr. Mohamad Saleh</title>
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
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
    <link rel="stylesheet" type="text/css" href="fancybox/jquery.fancybox-1.3.4.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="button_css.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="fancybox/jquery.fancybox.css?v=2.1.7" media="screen" />

    <link href="build/css/custom.min.css" rel="stylesheet">
    <script type="text/javascript">
      <?php if(!isset($_SESSION["anggaran_kodeuser"])){ ?>
      document.location="login.php";
	   <?php } ?>
      //dashboard();
    </script>
    
  </head>

  <body  style="height:100%">
    <div class="container body" style="height:100%">
	  <!--<div data-component="navbar">
		<nav class="navbar p-0 fixed-top">-->
		  <div class="header" style="z-index:998">
			<table border="0" class="hdrtbl" ><tr>
			<td width="250px"></td>
			<td width="85%" class="rpthdr" align="right">
			<img src="images/Logo.png"  width="190px" height="50px">
			<h2><strong>RSUD dr. Mohamad Saleh</strong></h2></td>
			</tr>
			</table>
			<div class="header_bot"></div>
		  </div>
		 <!--</nav>
	  </div> --><!-- END TOP NAVBAR -->
	  
      <div class="main_container" style="height:100%">
	  
	  <div data-component="sidebar">
		  <div class="sidebar"  style="height:100%">
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
							  <li class="list-group-item px-2 py-1 "><a href="javascript:void(0)" onClick="penetapanpagu();">Pagu Kegiatan </a></li>
							  <li class="list-group-item px-2 py-1 "><a href="javascript:void(0)" onClick="pengusulan();">Pengusulan </a></li>
							  <li class="list-group-item px-2 py-1 "><a href="javascript:void(0)" onClick="penyesuaianperioritas();">Penyesuaian Perioritas </a></li>
							  <li class="list-group-item px-2 py-1 "><a href="javascript:void(0)" onClick="penetapananggaran();">Penetapan Anggaran </a></li>
                    </ul>
                  </li>
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
				  <?php if(strpos($_SESSION['anggaran_menu'],"|PERUBAHAN|")!==false){ ?>
                  <li class="list-group-item px-1 py-6"><a><i class="fa fa-exchange-alt" aria-hidden="true"><span class="ml-2 align-middle">Pergeseran </span></i></a>
                    <ul class="list-group flex-column d-inline-block submenu">
							  <li class="list-group-item px-2 py-1 "><a href="javascript:void(0)" onClick="paguindikatif();">Pendapatan</a></li>
							  <li class="list-group-item px-2 py-1 "><a href="javascript:void(0)" onClick="perubahanpagubelanja();">Pergeseran Pagu Kegiatan </a></li>
							  <li class="list-group-item px-2 py-1 "><a href="javascript:void(0)" onClick="perubahanrincianbelanja();">Pergeseran Rincian Belanja</a></li>
                    </ul>
                  </li>
				  <?php }?>
				  <?php if(strpos($_SESSION['anggaran_menu'],"|PERUBAHAN|")!==false){ ?>
                  <li class="list-group-item px-1 py-6"><a><i class="fa fa-exchange-alt" aria-hidden="true"><span class="ml-2 align-middle">Perubahan </span></i></a>
                    <ul class="list-group flex-column d-inline-block submenu">
							  <li class="list-group-item px-2 py-1 "><a href="javascript:void(0)" onClick="paguindikatif_pak();">Pendapatan</a></li>
							  <li class="list-group-item px-2 py-1 "><a href="javascript:void(0)" onClick="perubahanpagubelanja_pak();">Perubahan Pagu Kegiatan </a></li>
							  <li class="list-group-item px-2 py-1 "><a href="javascript:void(0)" onClick="perubahanpagubelanjarinci_pak();">Perubahan Rincian Belanja</a></li>
							  <li class="list-group-item px-2 py-1 "><a href="javascript:void(0)" onClick="perubahanrincianbelanja_pak();">Pergeseran Setelah P.A.K</a></li>
                    </ul>
                  </li>
				  <?php }?>
				  <?php if(strpos($_SESSION['anggaran_menu'],"|LAPORAN|")!==false){ ?>
                  <li class="list-group-item px-1 py-6"><a><i class="fa fa-sticky-note" aria-hidden="true"><span class="ml-2 align-middle">Laporan </span></i></a>
                  <ul class="list-group flex-column d-inline-block submenu">
                      <li class="list-group-item px-2 py-1 "><a href="javascript:void(0)" onClick="lapRekapPengusulan();">Rekap Pengusulan </a></li>
					  <li class="list-group-item px-2 py-1 "><a href="javascript:void(0)" onClick="lapRekapPenyesuaianPerioritas();">Rekap Penyesuaian Perioritas </a></li>
					  <li class="list-group-item px-2 py-1 "><a href="javascript:void(0)" onClick="laporanrba();">Laporan RBA (Rencana Bisnis Anggaran)</a></li>
					  <li class="list-group-item px-2 py-1 "><a href="javascript:void(0)" onClick="laporanrla();">Laporan LRA (Laporan Realisasi Anggaran) </a></li>
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
		
		<div class="wp-content">
		  <div class="container-fluid">
			<div id="page-wrapper">
			<center><img src="images/anime.gif" width="100%"></center>
			</div>
		  </div>
		</div>
		
        <div class="footer">
          <hr width="50%" align="center">
          <div align="center">
            Copyright © dr. Mohamad Saleh Kota Probolinggo. All rights reserved.1366x768
          </div>
        </div>
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
<script type="text/javascript" src="fancybox/jquery.fancybox.pack.js?v=2.1.7"></script>
<script type="text/javascript" src="fancybox/jquery.fancybox.js?v=2.1.7"></script>
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
