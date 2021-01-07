<?php
include 'header.php';

$kategorisor = $db ->prepare("SELECT *FROM category");
$kategorisor ->execute();


?>

<section id="createprofile" class="bg-img mt-5 pt-5 min-vh-100">
  <div class="container">





    <div class="row">
      <div class="col text-center ">
        <div class="card-body">

          <div class="row">
            <div class="col text-center d-flex justify-content-center text-white ">
              <h2 class="font-weight-bold">Gönderi Paylaş</h2>
            </div>
          </div>

          <div class="row">
            <div class="col">
              <div class="">

                    <img src="images/select_image.png" class="create-profile-photo mt-3 rounded">

              </div>
            </div>

            <div class="col">
              <div class="">

                <img src="images/select_image.png" class="create-profile-photo mt-3 rounded">

              </div>
            </div>

            <div class="col">
              <div class="">

                <img src="images/select_image.png" class="create-profile-photo mt-3 rounded">

              </div>
            </div>


          </div>

          <div class="row">
            <div class="col text-center d-flex justify-content-center">
                <a href="#" class="text-white text-decoration-none font-weight-bold py-2"><h5>Fotoğraf Seç</h5></a>
            </div>
            <div class="col text-center d-flex justify-content-center">
                <a href="#" class="text-white text-decoration-none font-weight-bold py-2"><h5>Fotoğraf Seç</h5></a>
            </div>
            <div class="col text-center d-flex justify-content-center">
                <a href="#" class="text-white text-decoration-none font-weight-bold py-2"><h5>Fotoğraf Seç</h5></a>
            </div>
          </div>

          <form action="admin/netting/islem.php" class="m-auto " method="post">
              <div class="form-group profile-plain mx-auto mt-3">
                <label for="text" class="text-white font-weight-bold d-flex justify-content-start">Konu Başlığı</label>
                <input type="text" name="shareTitle" id="email" required="" class="form-control p-4 " placeholder="Zorunlu Alan">
              </div>
              <div class="form-group  profile-plain mx-auto my-4">
                <label for="text" class="text-white font-weight-bold d-flex justify-content-start">Konu İçeriği</label>
                <input type="text" name="shareExplanation" id="password" required="" class="form-control p-4" placeholder="Zorunlu Alan">
              </div>
              <select class="rounded p-2 bg-light" name="categoryName">
                <?php
                  while ($kategoricek = $kategorisor -> fetch(PDO::FETCH_ASSOC)) {

                    $category = mb_strtoupper($kategoricek['category_name']);
                    ?>



                    <option value="<?php echo $category; ?>"><?php echo $category ?></option>

                <?php  } ?>
              </select>





              <input name="btnPostShare" id="login" class="btn mx-auto  py-2 profile-plain font-weight-bold btn-block btn-primary login-btn mt-4" type="submit" value="Gönderi Paylaş">
            </form>


        </div>
      </div>
    </div>


  </div>
</section>
