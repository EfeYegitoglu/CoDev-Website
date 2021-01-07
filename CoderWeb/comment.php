<?php
include 'header.php';



  $commentsor = $db->prepare("SELECT * FROM comments WHERE post_id=:id ORDER BY comment_id DESC");
  $commentsor ->execute(array(
    'id' => $_GET['post']
  ));




?>

<section id="posticon" class="mt-5 bg-img pt-5 fixed-top text-white" style="z-index:1">
  <div class="container-fluid">

    <div class="row d-flex justify-content-between">

      <div class="col col-md-2  d-flex">
        <a href="post.php?kategori=<?php echo $_GET['kategori']; ?>"><button type="button" class="btn transparent " name="button"><img src="images/backBtn.png"  alt=""></button></a>
      </div>

      <div class="col col-md-6 justify-content-center my-auto d-flex ">
        <h3>Yorumlar</h3>
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




      while ($commentCek = $commentsor->fetch(PDO::FETCH_ASSOC)) {

        $profilal=$db->prepare("SELECT * FROM profiles WHERE user=:user_id");
        $profilal->execute(array(
          'user_id' => $commentCek['user_id']
        ));

        $profil_sorgu = $profilal -> rowCount();
        if ($profil_sorgu != 0) {
          $profilalcek=$profilal->fetch(PDO::FETCH_ASSOC);
        } ?>


        <!-- Card Projects -->
        <div class="col-12 col-md-6 pt-2">
            <div class="card">


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



                  <div class=" d-flex mx-2 p-2">
                    <p class=""><?php echo $commentCek['comment_text']; ?></hp>
                  </div>



            </div>
        </div>



      <?php  }
      ?>




    </div>
  </div>
</section>




<section id="posticon" class="mt-5 bg-img pt-5 fixed-bottom text-white" style="z-index:1">

  <div class="container-fluid">
    <div class="row">
      <div class="col-9 col-md-10">
        <form class="" action="admin/netting/islem.php?post=<?php echo $_GET['post']; ?>&kategori=<?php echo $_GET['kategori']; ?>" method="post">
          <input type="text" name="c" class="w-100 p-3 mb-3" placeholder="Yorum Gir..." required>
      </div>
      <div class="col col-md-2 ">
            <input type="submit" class="btn btn-success mx-auto my-auto d-flex" name="b" value="Gönder">
          </form>
      </div>
    </div>
  </div>











</section>
