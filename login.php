<?php include("conn.php"); ?>
<?php //session_start(); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>.::PROGRAM KEUANGAN::.</title>
	<link rel="icon" href="images/logors.png" />
	
   <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="vendors/nprogress/nprogress.css" rel="stylesheet">
    <link href="vendors/animate.css/animate.min.css" rel="stylesheet">
    <link href="sweetalert/sweetalert.css" rel="stylesheet" type="text/css">
	 <!-- <link href="build/css/custom.min.css" rel="stylesheet">-->
	<link rel="stylesheet" type="text/css" href="css/styles.css" />
    <script type="text/javascript">
      function login(){
        tusername=document.frm_login.tusername.value;
        tpass=document.frm_login.tpass.value;
		thn=document.frm_login.thn.value;
        if(tusername==""){
          swal("Gagal..!!!", "User Name Tidak Boleh Kosong...!!!", "error");
          document.frm_login.tusername.focus();
        }else if(tpass==""){
          swal("Gagal..!!!", "Password Tidak Boleh Kosong...!!!", "error");
          document.frm_login.tpass.focus();
        }else{
          $.get("sign_in.php",{tusername:tusername,tpass:tpass,thn:thn},
            function(result){ 
              if(result=="OK"){
                $.get("cekpass.php",{tusername:tusername},
                  function(result){ 
                    if(result=="OC"){
                      document.location="gantipass.php";
                    }else{
                      document.location="index.php";
                    }
                  }
                );
              }else{
                swal("Gagal..!!!", result, "error");
                document.frm_login.tusername.focus();
              }
            }
          );
        }
      }
      <?php if(isset($_SESSION["anggaran_kodeuser"])){ ?>
      document.location="index.php";
      <?php } ?>
      
      function formdaftar(){ 
        document.location="daffolder/index.php";
      }
    </script>
  </head>

  <body class="login">
    <div class="container">
		<header>
			<img src="images/Logo.png">
			<div class="support-note">
				<span class="note-ie">Sorry, only modern browsers.</span>
			</div>
		</header>
		<a class="hiddenanchor" id="signin"></a>
		<section class="main">
				<form class="login_form" id="frm_login" name="frm_login" onSubmit="return false;">
					<table border="0"><tr><td colspan="2">
					<h1><span class="log-in">Log in</span></h1>
					</td></tr>
					<tr><td width="77%">
					<p>
						<label for="login"><i class="icon-user"></i>Username</label>
						<input type="text" class="form-control" placeholder="Username" name="tusername" id="tusername" onKeyPress="if(event.keyCode==13){document.frm_login.tpass.focus();}" />
						<label for="password"><i class="icon-lock"></i>Password</label>
						<input type="password" class="form-control showpassword" placeholder="Password" name="tpass" id="tpass" type="password" onKeyPress="if(event.keyCode==13){document.frm_login.tsign_in.focus();}" />
						<label for="login"><i class="icon-th"></i></i>Tahun</label>
						<select name="thn" class="form-control" tabindex="3">
						<?php for($x=(date("Y")-1);$x<=(date("Y")+1);$x++){ ?>
						<option value="<?php echo $x ; ?>" <?php if (date("Y")==$x) echo "selected" ;?>><?php echo $x ;?></option>
						<?php } ?>
						</select>
					</p></td>
					<td><table><tr><td><button type="submit" name="tsign_in" id="tsign_in" value="Login" onclick="login();" >
							<i class="icon-arrow-right"></i>
							<span>Sign in</span>
							</button></td></tr>
							
						</table></td></tr>
					</table>
				</form>​​
		</section>
		<footer>
		<table width="300"><tr align="center"><td>
		<h3><strong>Copyright © dr. Mohamad Saleh Kota Probolinggo <br />All rights reserved.1366x768</strong></h3>
		</td></tr></table>
		</footer>
    </div>
  </body>
</html>
<script src="vendors/jquery/dist/jquery.min.js"></script>
<script src="sweetalert/sweetalert.min.js"></script>
<script src="sweetalert/sweetalert-dev.js"></script>





