<?php
include 'header.php';


$postsor = $db->prepare("SELECT * FROM posts WHERE post_category=:category ORDER BY post_id DESC");
$postsor ->execute(array(
  'category' => $_GET['kategori']
));





?>

<section id="posticon" class="mt-5 bg-img pt-5 fixed-top text-white" style="z-index:1">
  <div class="container-fluid">

    <div class="row d-flex justify-content-between">

      <div class="col col-md-2  d-flex">
        <a href="index.php#software"><button type="button" class="btn transparent " name="button"><img src="images/backBtn.png"  alt=""></button></a>
      </div>

      <div class="col col-md-6 justify-content-center my-auto d-flex ">
        <h3 class=""><?php echo $_GET['kategori']; ?></h3>
      </div>

      <div class="col col-md-2  d-flex">
      </div>

    </div>



  </div>
</section>

<section id="post" class="bg-img pt-5 mt-5 min-vh-100">
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

                      $kategori = $_GET['kategori'];
                    if (@$starCount > 0 ) {?>
                      <a href="admin/netting/islem.php?kategori=<?php echo $kategori; ?>&begenme=<?php echo $postcek['post_id']; ?>"><img src="images/star.png" class=" img-fluid post-icons hover" alt="" ></a>


                <?php  }else {    ?>


                    <a href="admin/netting/islem.php?kategori=<?php echo $kategori; ?>&begen=<?php echo $postcek['post_id']; ?>" ><img src="images/empty_star.png" class=" img-fluid post-icons hover" alt="" ></a>

            <?php  } } else { ?>
                        <a href="#" ><img src="images/empty_star.png" class=" img-fluid post-icons hover" alt="" ></a>
          <?php } ?>

            <a href="comment.php?post=<?php echo $postcek['post_id']; ?>&kategori=<?php echo $_GET['kategori']; ?>" ><img src="images/comment.png" class=" img-fluid post-icons hover" alt="" ></a>

          <?php if (isset($_SESSION['user_id'])) {

            $savedsor = $db -> prepare("SELECT * FROM saved WHERE post_id =:p_id and user_id=:u_id");
            @$savedsor -> execute(array(
              'p_id' => $postcek['post_id'],
              'u_id' => $_SESSION['user_id']
            ));
            $savedCount = $savedsor->rowCount();

            $kategori = $_GET['kategori'];

            if (@$savedCount > 0 ) {?>

                <a href="admin/netting/islem.php?kategori=<?php echo $kategori; ?>&kaydetme=<?php echo $postcek['post_id']; ?>" ><img src="images/saved.png" class=" img-fluid post-icons hover" alt="" ></a>


        <?php  }else {    ?>

                <a href="admin/netting/islem.php?kategori=<?php echo $kategori; ?>&kaydet=<?php echo $postcek['post_id']; ?>" ><img src="images/save.png" class=" img-fluid post-icons hover" alt="" ></a>

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
