<?php
ob_start();
session_start();
include 'admin/netting/baglan.php';


if (isset($_SESSION['user_mail'])) {
  $kullanicisor=$db->prepare("SELECT * FROM users where user_mail=:mail ");
  $kullanicisor->execute(array(
    'mail' => $_SESSION['user_mail']
  ));
  $kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC);

  if ($kullanicicek != "1") {

  }


  $profilsor=$db->prepare("SELECT * FROM profiles WHERE user=:user_id");
  $profilsor->execute(array(
    'user_id' => $_SESSION['user_id']
  ));
  $profil_sorgu = $profilsor -> rowCount();
  if ($profil_sorgu != 0) {
    $profilcek=$profilsor->fetch(PDO::FETCH_ASSOC);
  }






}





?>

<!doctype html>
<html lang="tr">
  <head>
    <link rel="icon" href="images/logo1.png" type="image/x-icon">
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
   <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <style>img[alt="www.000webhost.com"]{display:none}</style>

    <title>CoDev Software</title>

  </head>
  <body>
    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <script src="js/smooth-scroll.min.js"></script>
    <script>
	     var scroll = new SmoothScroll('a[href*="#"]');
     </script>


       <!--<a href="profile.php"class="material-icons floating-btn bg-primary d-flex text-decoration-none text-white ">add</a>-->


    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-md  bg-img fixed-top " >
      <div class="container ">
        <a href="index.php" class="navbar-brand">

          <img src="images/logo1.png" alt="Logo" style="height:60px;">
        </a>
        <a href="index.php" class="text-decoration-none"><h2 class="text-white ">CoDev</h2></a>
        <button class="navbar-toggler custom-toggler" data-toggle="collapse" data-target="#nvbCollapse">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="nvbCollapse">
          <?php if (@$kullanicicek['account_state'] == 1 && @$profil_sorgu != 0) {?>

          <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle display-5 text-center" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <?php echo @$profilcek['profile_name']; ?>
                  <?php if (!empty($profilcek['profile_picture'])){?>
                  <img src="<?php echo $profilcek['profile_picture_url']; ?>" class="dropdown-card-img rounded-circle ml-2">
                  <?php } else {?>
                      <img src="images/empty_profile_img.png" class="dropdown-card-img rounded-circle ml-2">
                      <?php } ?>
                </a>

              <div class="dropdown-menu  text-center " id="navbarDropdown">
                            <div class="crad-block">
                              <form action="admin/netting/islem.php" method="post">


                              <a href="share.php"><button  class="btn btn-success mx-auto nav-btn btn-block text-white font-weight-bold"  type="button" name="button">Paylaşım Yap</button></a>
                              <div class="dropdown-divider"></div>
                              <a href="profile.php"><button  class="btn btn-primary mx-auto nav-btn text-white btn-block font-weight-bold"  type="button" name="button">Profile Git</button></a>
                              <div class="dropdown-divider"></div>
                              <a href="index.php#contact"><button  class="btn btn-warning mx-auto nav-btn text-white btn-block font-weight-bold"  type="button" name="button">İletişime Geç</button></a>
                              <div class="dropdown-divider"></div>

                              <button  class="btn btn-danger mx-auto nav-btn text-white btn-block font-weight-bold"  type="submit" name="btnCikisYap">Güvenli Çıkış</button>

                              </form>
                            </div>
                          </div>
            </li>
          </ul>
        <?php } else {?>
          <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
              <a href="login.php"><button  class="btn btn-success mx-auto nav-btn btn-block text-white font-weight-bold"  type="button" name="button">Giriş Yap</button></a>
            </li>
          </ul>
      <?php }?>
        </div>

      </div>

    </nav>
