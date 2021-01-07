<?php include 'header.php';

$profilSor=$db->prepare("SELECT * FROM profiles WHERE profile_id=:id");
$profilSor->execute(array(
  'id'=>$_GET['profile_id']
));


$profilCek=$profilSor->fetch(PDO::FETCH_ASSOC);

?>

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">

            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Profil Düzenleme İşlemleri <small>,

                      <?php
                        if (@$_GET['durum']=="ok") {?>
                          <b style="color:green;"> İşlem Başarılı...</b>

                        <?php }elseif (@$_GET['durum']=="no") {?>
                          <b style="color:red;"> İşlem Başarısız...</b>
                        <?php } ?>




                    </small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>


                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form action="../netting/adminislem.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Profil Id</label>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input disabled value="<?php echo $profilCek['profile_id']; ?>" type="number" id="first-name"  required="required" class="form-control col-md-7 col-xs-12" >
                        </div>
                      </div>


                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Ad Soyad<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input  value="<?php echo $profilCek['profile_name']; ?>" type="text" id="first-name" name="profile_name" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">İlgi Alanları<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input value="<?php echo $profilCek['profile_info']; ?>" type="text" id="first-name" name="profile_info" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Web Sitesi<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input value="<?php echo $profilCek['profile_website']; ?>" type="text"  id="first-name" name="profile_website" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kullanıcı Id<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input disabled value="<?php echo $profilCek['user']; ?>" type="text"  id="first-name" name="user" required="required"  class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>


                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">

                          <button name="adminProfilDuzenle" type="submit" class="btn btn-success">Güncelle</button>
                          <input  name="profile_id" type="hidden" value="<?php echo $profilCek['profile_id']; ?>" type="number" id="first-name"  required="required" class="form-control col-md-7 col-xs-12">

                        </div>
                      </div>


                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

        <?php include 'footer.php'; ?>
