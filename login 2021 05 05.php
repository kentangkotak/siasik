<?php include("conn.php"); ?>
<?php //session_start(); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>.::PROGRAM KEUANGAN::.</title>

    <link href="vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="vendors/nprogress/nprogress.css" rel="stylesheet">
    <link href="vendors/animate.css/animate.min.css" rel="stylesheet">
    <link href="sweetalert/sweetalert.css" rel="stylesheet" type="text/css">

    <link href="build/css/custom.min.css" rel="stylesheet">
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
      <?php if(isset($_SESSION["silat_username"])){ ?>
      document.location="index.php";
      <?php } ?>
      
      function formdaftar(){ 
        document.location="daffolder/index.php";
      }
    </script>
  </head>

  <body class="login">
    <div>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            <form id="frm_login" name="frm_login" onSubmit="return false;">
              <h1>KEUANGAN</h1>
              <div>
                <input type="text" class="form-control" placeholder="Username" name="tusername" id="tusername" onKeyPress="if(event.keyCode==13){document.frm_login.tpass.focus();}" />
              </div>
              <div>
                <input type="password" class="form-control" placeholder="Password" name="tpass" id="tpass" type="password" onKeyPress="if(event.keyCode==13){document.frm_login.tsign_in.focus();}" />
              </div>
			  <div>
				<select name="thn" class="form-control" tabindex="3">
						<?php for($x=(date("Y")-3);$x<=(date("Y"));$x++){ ?>
						<option value="<?php echo $x ; ?>" <?php if (date("Y")==$x) echo "selected" ;?>><?php echo $x ;?></option>
						<?php } ?>
				</select>
			  </div>
			  <br/>
              <div>
                <input type="button" name="tsign_in" id="tsign_in" class="btn btn-success" value="Login" onclick="login();" />
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <div class="clearfix"></div>
                <br />

                <div>
                  <h1> SISTEM INFORMASI MANAJEMEN KEUANGAN</h1>
                  <p>Copyright © dr. Mohamad Saleh Kota Probolinggo. All rights reserved.1366x768</p>
                </div>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </body>
</html>
<script src="vendors/jquery/dist/jquery.min.js"></script>
<script src="sweetalert/sweetalert.min.js"></script>
<script src="sweetalert/sweetalert-dev.js"></script>
   




