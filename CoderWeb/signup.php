<?php

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

    <title>Codev Software Kayıt Ol</title>
  </head>
  <body>
    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    <main class="d-flex align-items-center min-vh-100 py-3 py-md-0 bg-img">
    <div class="container">
      <div class="card login-card">
        <div class="row no-gutters">
          <div class="col-md-5">
            <img src="images/login.jpg" alt="login" class="login-card-img">
          </div>
          <div class="col-md-7 text-center">
            <div class="card-body">
              <div class="brand-wrapper">
                <img src="images/logo1.png" alt="logo" class="logo" style="height:250px;width:250px;">
                <h2>CoDev Software</h2>
              </div>
              <p class="login-card-description">Kayıt Ol</p>
              <form action="admin/netting/islem.php" class="m-auto" method="post">
                  <div class="form-group">
                    <label for="email" class="sr-only">Mail Adresi</label>
                    <input type="email" name="signupMail" id="email" required="" class="form-control" placeholder="Mail Adresiniz">
                  </div>
                  <div class="form-group mb-4">
                    <label for="password" class="sr-only">Şifre</label>
                    <input type="password" name="signupPassword" id="password" required="" class="form-control" placeholder="Şifre">
                  </div>
                  <div class="form-group mb-4">
                    <label for="password" class="sr-only">Şifre Tekrar</label>
                    <input type="password" name="signupPasswordAgain" id="password" required="" class="form-control" placeholder="Şifre Tekrar">
                  </div>

                  <?php if (@$_GET['durum'] == "eslesmeyensifre"){?>
                    <div class="alert alert-danger">
                      <strong>Hata!</strong> Şifreniz eşleşmiyor
                    </div>
                  <?php } elseif (@$_GET['durum'] == "eksiksifre") {?>
                    <div class="alert alert-danger">
                      <strong>Hata!</strong> Şifreniz en az 6 karakterden oluşmalıdır
                    </div>
                  <?php } elseif (@$_GET['durum'] == "basarisiz") {?>
                    <div class="alert alert-danger">
                      <strong>Hata!</strong> Kayıt işlemi gerçekleştirilemedi
                    </div>
                  <?php }  elseif (@$_GET['durum'] == "mevcutkullanici") {?>
                    <div class="alert alert-danger">
                      <strong>Hata!</strong> Mevcut kullanıcı
                    </div>
                  <?php } ?>


                  <input name="btnKayitOl" id="login" class="btn btn-block login-btn mb-4" type="submit" value="Kayıt Ol">
                </form>

                <p class="login-card-footer-text">Heasabınız var mı? <a href="login.php" class="text-reset">Giriş Yap</a></p>
                <p class=""> <a href="index.php">Vazgeç ve Siteye Dön</a></p>
                  <p class=""> <a href="index.php">CoDev Software</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>




</body>
</html>
