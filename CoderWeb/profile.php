<?php include 'header.php';

if (isset($_SESSION['user_id'])) {
  $kullanicisor = $db->prepare("SELECT * FROM profiles WHERE user=:id");
  $kullanicisor->execute(array(
    'id' => $_SESSION['user_id']
  ));
  $kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC);

  $postCountSor = $db ->prepare("SELECT * FROM posts WHERE user_id=:id");
  $postCountSor ->execute(array(
    'id' => $_SESSION['user_id']
  ));
  $postCount = $postCountSor->rowCount();

  $commentCountSor = $db ->prepare("SELECT * FROM comments WHERE user_id=:id");
  $commentCountSor ->execute(array(
    'id' => $_SESSION['user_id']
  ));
  $commentCount = $commentCountSor->rowCount();

  $postsor = $db->prepare("SELECT * FROM posts WHERE user_id=:id");
  $postsor ->execute(array(
    'id' => $_SESSION['user_id']
  ));

}



?>

<section id="profile" class=" mt-5 pt-5 text-white bg-img">
  <div class="container">
    <div class="row">
      <div class="col-xs-12 col-md-4 text-center">
        <div class="card-block">
          <?php if (!empty($profilcek['profile_picture'])){?>

                <img src="http://codevsoftware.tk/coderapp/profileimages/<?php echo $profilcek['profile_picture'] . ".jpg";  ?>" class="img-fluid rounded-circle my-4 profile-pic">

        <?php } else {?>
            <img src="images/empty_profile_img.png" class="img-fluid rounded-circle my-4 profile-pic">
      <?php } ?>



          <h2><?php echo $kullanicicek['profile_name']; ?></h2>
        </div>
      </div>
      <div class="col-xs-12 col-md-8  text-center d-flex justify-content-center">
        <div class="container  my-auto">
          <div class="row">
            <div class="col-5  py-4">
              <div class="row d-flex justify-content-center">
                <h3><?php echo $postCount; ?></h3>
              </div>
              <div class="row d-flex justify-content-center">
                <h3>Gönderi</h3>
              </div>

            </div>
            <div class="col-2 d-flex justify-content-center ">
              <div class="ver-line my-auto mx-auto bg-secondary">

              </div>
            </div>
            <div class="col-5  py-4">
              <div class="row d-flex justify-content-center">
                <h3><?php echo $commentCount; ?></h3>
              </div>
              <div class="row d-flex justify-content-center">
                <h3>Cevap</h3>
              </div>
            </div>
          </div>
          <div class="row  pt-2 mb-2">
            <div class="col">
              <h4><?php echo $kullanicicek['profile_info']; ?></h4>
            </div>
          </div>
          <div class="row pt-2">
            <div class="col">
              <a href="http://www.codevsoftware.tk/" style="color:white;"><h6><?php echo $kullanicicek['profile_website']; ?></h6></a>

            </div>
          </div>
          <div class="row">
            <div class="col-md-4 col-xs-12 mt-2 ">
              <a href="editprofile.php"><button  class="btn py-2 btn-block btn-primary text-white font-weight-bold"  type="button" name="button">Profili Düzenle</button></a>
            </div>
            <div class="col-md-4 col-xs-12 mt-2">
              <a href="saved.php"><button  class="btn py-2 btn-block btn-success text-white font-weight-bold"  type="button" name="button">Kaydedilenler</button></a>
            </div>
            <div class="col-md-4 col-xs-12 mt-2">
              <form class="" action="admin/netting/islem.php" method="post">
                <input  class="btn py-2 btn-block btn-danger text-white font-weight-bold"  type="submit" name="btnCikisYap" value="Çıkış Yap">
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>



<section id="post" class="bg-img pt-5 min-vh-100">
  <div class="container-fluid mt-5">
    <div class="row">

      <?php




      while ($postcek = $postsor->fetch(PDO::FETCH_ASSOC)) {

        $profilal=$db->prepare("SELECT * FROM profiles WHERE user=:user_id");
        $profilal->execute(array(
          'user_id' => $postcek['user_id']
        ));

        $profil_sorgu = $profilal -> rowCount();
        if ($profil_sorgu != 0) {
          $profilalcek=$profilal->fetch(PDO::FETCH_ASSOC);
        } ?>


        <!-- Card Projects -->
        <div class="col-12 col-md-6 pt-2">
            <div class="card">
              <?php if (empty($postcek['post_picture_one']) && empty($postcek['post_picture_two']) && empty($postcek['post_picture_three'])){?>


            <?php } else { ?>


              <div class="card-image d-flex justify-content-center flex-column">

                    <img src="images/j.jpg" class="img-fluid" alt="">

                </div>

                  <?php  } ?>

                <div>
                  <div class="row">
                    <div class="col-10   d-flex justify-content-start d-flex align-items-center">

                      <a href="profile.php">

                          <?php if (!empty($profilalcek['profile_picture'])){?>
                              <img src="<?php echo $profilalcek['profile_picture_url']; ?>" class="rounded-circle img-fluid post-pp ml-2 my-1"></a>

                      <?php }else {?>
                          <img src="images/cardimg.jpg" class="rounded-circle img-fluid post-pp ml-2 my-1"></a>
                              <?php } ?>

                      <a href="profile.php" class="text-decoration-none text-dark d-flex my-auto ml-2"><h6 class="post-card-user card-title "><?php echo $profilalcek['profile_name']; ?></h6></a>

                    </div>
                    <div class="col-2  d-flex justify-content-end align-items-center">
                      <a href="#"><img src="images/3dot.png" class=" img-fluid post-threedot hover mr-2" alt="" ></a>

                    </div>

                  </div>
                  </div>

                  <div class=" d-flex mx-2 my-1">
                    <h4 class=""><?php echo $postcek['post_title']; ?></h4>
                  </div>

                  <div class=" d-flex mx-2 ">
                    <p class=""><?php echo $postcek['post_explanation']; ?></hp>
                  </div>


                <div class="card-action d-flex justify-content-around">
                  <?php
                  if (isset($_SESSION['user_id'])) {


                    $starsor = $db -> prepare("SELECT * FROM stars WHERE post_id =:p_id and user_id=:u_id");
                    @$starsor -> execute(array(
                      'p_id' => $postcek['post_id'],
                      'u_id' => $_SESSION['user_id']
                    ));
                    $starCount = $starsor->rowCount();


                    if (@$starCount > 0 ) {?>
                      <a href="admin/netting/islem.php?pbegenme=<?php echo $postcek['post_id']; ?>"><img src="images/star.png" class=" img-fluid post-icons hover" alt="" ></a>


                <?php  }else {    ?>


                    <a href="admin/netting/islem.php?pbegen=<?php echo $postcek['post_id']; ?>" ><img src="images/empty_star.png" class=" img-fluid post-icons hover" alt="" ></a>

            <?php  } } else { ?>
                        <a href="#" ><img src="images/empty_star.png" class=" img-fluid post-icons hover" alt="" ></a>
          <?php } ?>

            <a href="#" ><img src="images/comment.png" class=" img-fluid post-icons hover" alt="" ></a>

          <?php if (isset($_SESSION['user_id'])) {

            $savedsor = $db -> prepare("SELECT * FROM saved WHERE post_id =:p_id and user_id=:u_id");
            @$savedsor -> execute(array(
              'p_id' => $postcek['post_id'],
              'u_id' => $_SESSION['user_id']
            ));
            $savedCount = $savedsor->rowCount();


            if (@$savedCount > 0 ) {?>

                <a href="admin/netting/islem.php?pkaydetme=<?php echo $postcek['post_id']; ?>" ><img src="images/saved.png" class=" img-fluid post-icons hover" alt="" ></a>


        <?php  }else {    ?>

                <a href="admin/netting/islem.php?pkaydet=<?php echo $postcek['post_id']; ?>" ><img src="images/save.png" class=" img-fluid post-icons hover" alt="" ></a>

      <?php   } } else { ?>
          <a href="#" ><img src="images/save.png" class=" img-fluid post-icons hover" alt="" ></a>
    <?php  } ?>




                </div>
            </div>
        </div>



      <?php  }
      ?>




    </div>
  </div>
</section>
