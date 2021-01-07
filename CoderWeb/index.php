<?php include 'header.php';

$kategorisor=$db->prepare("SELECT * FROM category");
$kategorisor->execute();



?>



<input type="text" name="" value="">

    <!-- HEADER SECTION-->
    <section>
      <header id="headerSection">
      <div class="overlay">
        <div class="container">
          <div class="row text-center ">
            <div class="col my-auto">
              <h1 class="text-white">CoDev Software ile Yazılım Dünyasına Adım Atın</h1>
              <p class=" text-white">Kaydını gerçekleştir, profilini oluştur ve paylaşımlarına başla.</p>
              <a href="#software"><button id="btn-start" class="scroll-down"  type="button" name="button"></button></a>
            </div>
          </div>
        </div>
      </div>
    </header>
    </section>





    <!-- CHOOSE LANGUAGE SECTION -->
    <section id="software" class="bg-img">
      <div class="container pt-4">
        <div class="row">
          <div class="col text-center pt-5 font-weight-bold text-white txt">
            <hr>
            -- Kategori Seçin --
            <hr>
          </div>
        </div>
        <div class="row">

            <?php

            while ($kategoricek=$kategorisor->fetch(PDO::FETCH_ASSOC)) {

              $category = mb_strtoupper($kategoricek['category_name']);
              $categorysor = $db -> prepare("SELECT * FROM posts WHERE post_category = '$category' ");
              $categorysor -> execute();
              $categoryCount = $categorysor -> rowCount();

              ?>

              <div class="col-md-4 col-lg-3 col-6 mb-3">
                <a href="post.php?kategori=<?php echo $kategoricek['category_name']; ?>" class="text-decoration-none text-dark">
              <div class="card  rounded text-center">
                <div class="card-block">
                  <img src="categorypictures/<?php echo $kategoricek['category_picture']; ?>" class="img-fluid rounded my-4 ">
                  <h4><?php echo $kategoricek['category_name']; ?></h4>
                  <h6 class="text-muted">

                    <?php echo $categoryCount . " Gönderi"; ?>
                </h6>

                </div>
                </a>
              </div>
              </div>

            <?php } ?>

        </div>
      </div>

    </section>



    <!--Section: Contact v.2-->
<section id="contact" class=" py-5 contact-bg">
  <div class="container rounded bg-img">
    <div class="row d-flex my-5">
      <div class="col-12 text-white font-weight-bold">
        <!--Section heading-->
        <h2 class="h1-responsive font-weight-bold text-center my-4">İletişime Geçin</h2>
        <!--Section description-->
        <p class="text-center w-responsive mx-auto mb-5">CoDev Software ile iletişime geçmek için aşağıdaki formu doldurup göndermeniz yetrli.</p>

        <div class="row">

            <!--Grid column-->
            <div class="col-md-12 mb-md-0 mb-5">
                <form id="contact-form" action="admin/netting/mail.php" role="form" method="post">

                    <!--Grid row-->
                    <div class="row">

                        <!--Grid column-->
                        <div class="col-md-6 mt-3">
                            <div class="md-form mb-0">
                                <label for="name" class="">Ad Soyad</label>
                                <input type="text" required="" id="name" name="mailName" class="form-control">
                            </div>
                        </div>

                        <!--Grid column-->

                        <!--Grid column-->

                        <div class="col-md-6 mt-3">
                            <div class="md-form mb-0">
                              <label for="email" class="">Mail Adresi</label>
                              <input type="text" required id="email" name="emailAdress" class="form-control">
                            </div>
                        </div>
                        <!--Grid column-->

                    </div>
                    <!--Grid row-->

                    <!--Grid row-->
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="md-form mb-0">
                              <label for="subject" class="">Konu</label>
                                <input type="text" required id="subject" name="mailSubject" class="form-control">
                            </div>
                        </div>
                    </div>
                    <!--Grid row-->

                    <!--Grid row-->
                    <br>
                    <div class="row">

                        <!--Grid column-->
                        <div class="col-md-12">

                            <div class="md-form">
                                <label for="message">Mesajınız</label>
                                <textarea type="text" required id="message" name="mailMessage" rows="2" class="form-control md-textarea"></textarea>
                                <br>
                            </div>

                        </div>
                    </div>
                    <!--Grid row-->



                <div class="text-center text-md-center">
                    <button class="btn btn-light mb-2" type="submit" name="msgButton">Gönder</button>
                </div>
                <div class="status"></div>
            </div>

            </form>
            <!--Grid column-->




        </div>
      </div>
    </div>
  </div>
</section>
<!--Section: Contact v.2-->


<?php include 'footer.php'; ?>
