<?php
session_start();


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

    <title>CoDev Profil Oluştur</title>
  </head>
  <body>
    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>


    <section id="createprofile" class="bg-img min-vh-100">
      <div class="container">





        <div class="row">
          <div class="col text-center ">
            <div class="card-body">

              <div class="row">
                <div class="col text-center d-flex justify-content-center text-white ">
                  <h2 class="font-weight-bold">Profilini Oluştur</h2>
                </div>
              </div>

              <div class="row">
                <div class="col">
                  <div class="">
                      <img src="images/empty_profile_img.png" class="create-profile-photo mt-3 rounded-circle">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col text-center d-flex justify-content-center">
                    <a href="#" class="text-white text-decoration-none font-weight-bold py-2"><h5>Profil Fotoğrafı Seç</h5></a>
                </div>
              </div>

              <form action="admin/netting/islem.php" class="m-auto " method="post">
                  <div class="form-group profile-plain mx-auto mt-3">
                    <label for="text" class="text-white font-weight-bold d-flex justify-content-start">Ad Soyad</label>
                    <input type="text" name="createName" id="email" required="" class="form-control p-4 " placeholder="Ad Soyad (Zorunlu Alan)">
                  </div>
                  <div class="form-group  profile-plain mx-auto  my-4">
                    <label for="text" class="text-white font-weight-bold d-flex justify-content-start">MailAdresi</label>
                    <input type="text" disabled="disabled"  id="password"   class="form-control p-4" value="<?php echo $_SESSION['user_mail']; ?>">
                  </div>
                  <div class="form-group  profile-plain mx-auto my-4">
                    <label for="text" class="text-white font-weight-bold d-flex justify-content-start">İlgi Alanları</label>
                    <input type="text" name="createInfo" id="password" required="" class="form-control p-4" placeholder="İlgi Alanları (Zorunlu Alan)">
                  </div>
                  <div class="form-group  profile-plain mx-auto">
                    <label for="text" class="text-white font-weight-bold d-flex justify-content-start">Web Siteniz</label>
                    <input type="text" name="createWeb" id="password" class="form-control p-4" placeholder="Web Siteniz (Mevcut ise)">
                  </div>

                  <?php if (@$_GET['durum'] == "basarisiz"){?>
                    <div class="alert alert-danger">
                      <strong>Hata!</strong> Profiliniz oluşturulamadı
                    </div>
                  <?php } ?>


                  <input name="btnProfilOlustur" id="login" class="btn mx-auto  py-2 profile-plain font-weight-bold btn-block btn-primary login-btn mt-4" type="submit" value="Profilini Oluştur">
                </form>


            </div>
          </div>
        </div>


      </div>
    </section>



</body>
</html>
