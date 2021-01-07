<?php

include 'header.php';

//Belirli veriyi seçme işlemi
$profilSor=$db->prepare("SELECT * FROM profiles");
$profilSor->execute();


?>


<!-- page content -->
<div class="right_col" role="main">
  <div class="">

    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Profil Listeleme <small>,

              <?php

              if (@$_GET['sil']=="ok") {?>

              <b style="color:green;">İşlem Başarılı...</b>

            <?php } elseif (@$_GET['sil']=="no") {?>

              <b style="color:red;">İşlem Başarısız...</b>

              <?php }

              ?>


            </small></h2>
            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>


            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">


            <!-- Div İçerik Başlangıç -->

            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>Sıra No</th>
                  <th>Profil Id</th>
                  <th>Ad Soyad</th>
                  <th>İlgi Alanları</th>
                  <th>Web Sitesi</th>
                  <th>Kullanıcı Id</th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>

              <tbody>

                <?php
                $no = 1;
                while($profilCek=$profilSor->fetch(PDO::FETCH_ASSOC)) {?>


                <tr>
                  <td class="text-center">
                    <?php echo $no; $no++; ?>
                  </td>
                  <td class="text-center"><?php echo $profilCek['profile_id'] ?></td>
                  <td><?php echo $profilCek['profile_name'] ?></td>
                  <td class="text-center"><?php echo $profilCek['profile_info'] ?></td>
                  <td class="text-center"><?php echo $profilCek['profile_website'] ?></td>
                  <td class="text-center"><?php echo $profilCek['user'] ?></td>
                  <td><center><a href="profil-duzenle.php?profile_id=<?php echo $profilCek['profile_id']; ?>"><button class="btn btn-primary btn-xs">Düzenle</button></a></center></td>
                  <td><center><a href="../netting/adminislem.php?profile_id=<?php echo $profilCek['profile_id']; ?>&profilsil=ok"><button class="btn btn-danger btn-xs">Sil</button></a></center></td>
                </tr>



                <?php  }?>




              </tbody>
            </table>

            <!-- Div İçerik Bitişi -->


          </div>
        </div>
      </div>
    </div>




  </div>
</div>
<!-- /page content -->

<?php include 'footer.php'; ?>
