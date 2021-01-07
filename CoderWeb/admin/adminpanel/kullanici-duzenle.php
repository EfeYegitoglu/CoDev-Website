<?php include 'header.php';

$userSor=$db->prepare("SELECT * FROM users WHERE user_id=:id");
$userSor->execute(array(
  'id'=>$_GET['kullanici_id']
));


$userCek=$userSor->fetch(PDO::FETCH_ASSOC);

?>

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">

            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Kullanıcı Düzenleme İşlemleri <small>,

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
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kullanıcı Id</label>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input disabled value="<?php echo $userCek['user_id']; ?>" type="number" id="first-name"  required="required" class="form-control col-md-7 col-xs-12" >
                        </div>
                      </div>


                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Kullanıcı Mail<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input  value="<?php echo $userCek['user_mail']; ?>" type="text" id="first-name" name="user_mail" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Doğrulama Kodu<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input value="<?php echo $userCek['verification_code']; ?>" type="text" id="first-name" name="verification_code" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Hesap Durumu<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input value="<?php echo $userCek['account_state']; ?>" type="text"  id="first-name" name="account_state" required="required"  class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>


                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">

                          <button name="adminKullaniciDuzenle" type="submit" class="btn btn-success">Güncelle</button>
                          <input type="hidden" value="<?php echo $userCek['user_id']; ?>" type="number" id="first-name"  required="required" class="form-control col-md-7 col-xs-12" name="user_id">
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
