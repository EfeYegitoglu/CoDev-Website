<?php
include 'header.php';

if (isset($_SESSION['user_id'])) {
  $profilsor = $db -> prepare("SELECT * FROM profiles WHERE user=:id");
  $profilsor -> execute(array(
    'id' => $_SESSION['user_id']
  ));

  $profilcek=$profilsor->fetch(PDO::FETCH_ASSOC);
}


?>


<section id="createprofile" class="bg-img mt-5 pt-5 min-vh-100">
  <div class="container">





    <div class="row">
      <div class="col text-center ">
        <div class="card-body">

          <div class="row">
            <div class="col text-center d-flex justify-content-center text-white ">
              <h2 class="font-weight-bold">Profili Düzenle</h2>
            </div>
          </div>

          <div class="row">
            <div class="col">
              <div class="">
                <?php if (!empty($profilcek['profile_picture'])){ ?>
                    <img src="http://codevsoftware.tk/coderapp/profileimages/<?php echo $profilcek['profile_picture'] . ".jpg";  ?>" class="create-profile-photo mt-3 rounded-circle">
              <?php  } else { ?>
                    <img src="images/empty_profile_img.png" class="create-profile-photo mt-3 rounded-circle">
              <?php   } ?>



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
                <input type="text" name="editName" id="email" required="" class="form-control p-4 " value="<?php echo $profilcek['profile_name'];?>">
              </div>
              <div class="form-group  profile-plain mx-auto  my-4">
                <label for="text" class="text-white font-weight-bold d-flex justify-content-start">MailAdresi</label>
                <input type="text" disabled="disabled"  id="password"   class="form-control p-4" value="<?php echo $_SESSION['user_mail']; ?>">
              </div>
              <div class="form-group  profile-plain mx-auto my-4">
                <label for="text" class="text-white font-weight-bold d-flex justify-content-start">İlgi Alanları</label>
                <input type="text" name="editInfo" id="password" required="" class="form-control p-4" value="<?php echo $profilcek['profile_info'];?>">
              </div>
              <div class="form-group  profile-plain mx-auto">
                <label for="text" class="text-white font-weight-bold d-flex justify-content-start">Web Siteniz</label>
                <input type="text" name="editWeb" id="password" class="form-control p-4" placeholder="Web Siteniz (Mevcut ise)" value="<?php echo @$profilcek['profile_name'];?>">
              </div>

              


              <input name="btnProfilGuncelle" id="login" class="btn mx-auto  py-2 profile-plain font-weight-bold btn-block btn-primary login-btn mt-4" type="submit" value="Profilini Güncelle">
            </form>


        </div>
      </div>
    </div>


  </div>
</section>
