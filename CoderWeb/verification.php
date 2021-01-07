<?php
ob_start();
session_start();

include 'admin/netting/baglan.php';



?>

<!doctype html>
<html lang="tr">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css" >

    <!-- JS -->
    <script type="text/javascript" src="js/js.js">

    </script>


    <!-- FontsAwesome CSS -->
   <link rel="stylesheet" href="css/all.css" type="text/css" >
   <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>img[alt="www.000webhost.com"]{display:none}</style>

    <title>CoDev Software Hesap Doğrulama</title>
  </head>
  <body>
    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    <main class="d-flex align-items-center min-vh-100 py-3 py-md-0 bg-img">
    <div class="container">
      <div class="card login-card text-center">
        <div class="row no-gutters">
          <div class="col">
            <br>
            <div class="brand-wrapper">
              <img src="images/logo1.png" alt="logo" class="logo" style="height:200px;">

            </div>
            <p class="login-card-description"><?php echo $_SESSION['user_mail']; ?></p>
            <p class="login-card-description">Mail Adresinize Gelen Doğrulama Kodunu Giriniz</p>
          </div>
        </div>
        <div class="row no-gutters">
          <div class="col">

            <form action="admin/netting/islem.php" class="m-auto" method="post">
                <div class="form-group">

                  <input type="text" name="verification_code" required="" type="number" class="py-4 form-control text-center" placeholder="Doğrulama Kodu">

                <?php if (@$_GET['durum'] == "basarisiz") {?>
                  <div class="alert alert-danger">
                    <strong>Hata!</strong> Doğrulama gerçekleştirilemedi
                  </div>
                <?php }elseif (@$_GET['durum'] == "eslesmeyenkod") {?>
                  <div class="alert alert-danger">
                    <strong>Hata!</strong> Doğrulama kodu eşleşmiyor
                  </div>
                <?php } ?>

                </div>

                <div class="row">
                  <div class="col-12 col-md-6">
                    <input name="btnHesapDogrula"  class="btn btn-block login-btn " type="submit" value="Doğrula">
                  </div>
                  <div class="col-12 col-md-6">
                    <input name="btnHesapYokEt"  class="btn btn-block login-btn mb-4" type="submit" value="Geri">
                  </div>
                </div>


              </form>
          </div>
        </div>
      </div>

    </div>
  </main>




</body>
</html>
