<?php
ob_start();
session_start();

include 'baglan.php';

/* SIGNUP */

if (isset($_POST['btnKayitOl'])) {
  $signupMail = htmlspecialchars($_POST['signupMail']);
  $signupPassword = htmlspecialchars($_POST['signupPassword']);
  $signupPasswordAgain =htmlspecialchars($_POST['signupPasswordAgain']);

  $verification_code = rand(0,10000) . rand(0,10000);
  $account_state = "0";

  if ($signupPassword == $signupPasswordAgain) {

    if (strlen($signupPassword) >= 6) {

      $kullanicisor=$db->prepare("SELECT * FROM users where user_mail=:mail ");
      $kullanicisor->execute(array(
        'mail' => $signupMail
      ));
      $kullanici_sorgu = $kullanicisor -> rowCount();

      if ($kullanici_sorgu == 0 ) {

        $kullanici_kaydet = $db->prepare("INSERT INTO users SET
          user_mail=:user_mail,
          user_password=:user_password,
          verification_code=:verification_code,
          account_state=:account_state
        ");
        $kayıt=$kullanici_kaydet->execute(array(
          'user_mail'=> $signupMail,
          'user_password'=> $signupPassword,
          'verification_code'=> $verification_code,
          'account_state'=> $account_state,
        ));

        if ($kayıt) {
          $_SESSION['user_mail'] = $signupMail;

          $to = $signupMail;
           $subject = "CoDev Software Hesap Aktiflestirme";
           $text =  "Hesabınızı aktifleştirmek için dogrulama kodunu uygulamadaki gerekli alana yapıştırınız.\n\nDogrulama kodunuz: " ."$verification_code";
           $from = "From: codevsoftware@gmail.com";
           mail($to,$subject,$text,$from);




          header("Location:../../verification.php?mail=$signupMail");
        }else {
          header("Location:../../signup.php?durum=basarisiz");
        }


      }else {
        header("Location:../../signup.php?durum=mevcutkullanici");
      }


    }else {
      header("Location:../../signup.php?durum=eksiksifre");
    }

  }else {
    header("Location:../../signup.php?durum=eslesmeyensifre");
  }


/* VERİFİCATİON */

}

if (isset($_POST['btnHesapDogrula'])) {
  $new_state = "1";
  $verificationCode = $_POST['verification_code'];



    $kullanicisor=$db->prepare("SELECT * FROM users where user_mail=:mail ");
    $kullanicisor->execute(array(
      'mail' => $_SESSION['user_mail']
    ));
    $kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC);
    $dogrulamaKodu = $kullanicicek['verification_code'];


    if ($_POST['verification_code'] == $dogrulamaKodu) {


      $kullaniciAl=$db->prepare("UPDATE users SET
        account_state=:account_state
        WHERE user_mail=:user_mail");

      $dogrula = $kullaniciAl->execute(array(
        ":account_state"=>$new_state,
        "user_mail" => $_SESSION['user_mail']
      ));



      if ($dogrula) {
        $_SESSION['user_id'] = $kullanicicek['user_id'];
        header("Location:../../createprofile.php");
        exit;
      }else {
        header("Location:../../verification.php?durum=basarisiz");
      }

    }else {
      header("Location:../../verification.php?durum=eslesmeyenkod");
    }


}

/* LOGIN */

if (isset($_POST['btnGirisYap'])) {
  $loginMail = $_POST['loginMail'];
  $loginPassword = $_POST['loginPassword'];

  $kullanicisor=$db->prepare("SELECT * FROM users where user_mail=:mail ");
  $kullanicisor->execute(array(
    'mail' => $loginMail
  ));
  $kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC);
  $kullanici_sorgu = $kullanicisor -> rowCount();

  if ($kullanici_sorgu != 0) {

      if ($loginPassword == $kullanicicek['user_password']) {
        $_SESSION['user_mail'] = $loginMail;
        $_SESSION['user_id'] = $kullanicicek['user_id'];



        if ($kullanicicek['account_state'] == "0") {
          header("Location:../../verification.php");
        }else {
          $profilsor=$db->prepare("SELECT * FROM profiles WHERE user=:user_id");
          $profilsor->execute(array(
            'user_id' => $_SESSION['user_id']
          ));
          $profil_sorgu = $profilsor -> rowCount();

          if ($profil_sorgu != 0) {
            header("Location:../../index.php");
          }else {
            header("Location:../../createprofile.php");
          }
        }




      }else {
        header("Location:../../login.php?durum=eslesmeyensifre");
      }

    }else {
      header("Location:../../login.php?durum=eslesmeyenmail");}



}

/*CREATE PROFİLE*/

if (isset($_POST['btnProfilOlustur'])) {
  $createName = $_POST['createName'];
  $createInfo = $_POST['createInfo'];
  $createWeb = $_POST['createWeb'];

  $kullanicisor=$db->prepare("SELECT * FROM users where user_mail=:mail ");
  $kullanicisor->execute(array(
    'mail' => $_SESSION['user_mail']
  ));
  $kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC);
  $userId = $kullanicicek['user_id'];

  $profilOlustur=$db->prepare("INSERT INTO profiles SET
    profile_picture=:profile_picture,
    profile_picture_url=:profile_picture_url,
    profile_name=:profile_name,
    profile_info=:profile_info,
    profile_website=:profile_website,
    user=:user
  ");

  $olustur = $profilOlustur->execute(array(
    'profile_picture' => "",
    'profile_picture_url' => "",
    'profile_name' => $createName,
    'profile_info' => $createInfo,
    'profile_website' => $createWeb,
    'user' => $userId
  ));

  if ($olustur) {
    $_SESSION['user_id'] = $userId;
    header("Location:../../index.php");
  }else {
    header("Location:../../createprofile.php?durum=basarisiz");
  }

}

if (isset($_POST['btnCikisYap'])) {
  session_destroy();
  header("Location:../../login.php");
}

/* VERIFICATIN BACK */
if (isset($_POST['btnHesapYokEt'])) {

  $hesapYokEt=$db->prepare("DELETE FROM users WHERE user_mail=:mail");
  $hesapYokEdildi=$hesapYokEt->execute(array(
    'mail' => $_SESSION['user_mail']
  ));
  if ($hesapYokEdildi) {
    session_destroy();
    header("Location:../../login.php?durum=hesapsilindi");
  }


}

/* STAR */

if (isset($_GET['begen'])) {
  $postBegen = $db ->prepare("INSERT INTO stars SET
    post_id=:p_id,
    user_id=:u_id
  ");

  $begen = $postBegen -> execute(array(
    'p_id' => $_GET['begen'],
    'u_id' => $_SESSION['user_id']
  ));

  if ($begen) {
    $kategori = $_GET['kategori'];
    header("Location:../../post.php?kategori=$kategori&begenDurum=ok");
  }else {
    header("Location:../../post.php?kategori=$kategori&begenDurum=no");
  }
}


if (isset($_GET['begenme'])) {
  $postBegenme = $db ->prepare("DELETE FROM stars WHERE
    post_id=:p_id and
    user_id=:u_id
  ");

  $begenme = $postBegenme -> execute(array(
    'p_id' => $_GET['begenme'],
    'u_id' => $_SESSION['user_id']
  ));

  if ($begenme) {
    $kategori = $_GET['kategori'];
    header("Location:../../post.php?kategori=$kategori&begenmeDurum=ok");
  }else {
    header("Location:../../post.php?kategori=$kategori&begenmeDurum=no");
  }
}

/* SAVED */

if (isset($_GET['kaydet'])) {
  $postKaydet = $db ->prepare("INSERT INTO saved SET
    post_id=:p_id,
    user_id=:u_id
  ");

  $kaydet = $postKaydet -> execute(array(
    'p_id' => $_GET['kaydet'],
    'u_id' => $_SESSION['user_id']
  ));

  if ($kaydet) {
    $kategori = $_GET['kategori'];
    header("Location:../../post.php?kategori=$kategori&kaydetDurum=ok");
  }else {
    header("Location:../../post.php?kategori=$kategori&kaydetDurum=no");
  }
}

if (isset($_GET['kaydetme'])) {
  $postKatdetme = $db ->prepare("DELETE FROM saved WHERE
    post_id=:p_id and
    user_id=:u_id
  ");

  $kaydetme = $postKatdetme -> execute(array(
    'p_id' => $_GET['kaydetme'],
    'u_id' => $_SESSION['user_id']
  ));

  if ($kaydetme) {
    $kategori = $_GET['kategori'];
    header("Location:../../post.php?kategori=$kategori&kaydetmeDurum=ok");
  }else {
    header("Location:../../post.php?kategori=$kategori&kaydetmeDurum=no");
  }
}

/* begenme profil*/

if (isset($_GET['pbegen'])) {
  $postBegen = $db ->prepare("INSERT INTO stars SET
    post_id=:p_id,
    user_id=:u_id
  ");

  $begen = $postBegen -> execute(array(
    'p_id' => $_GET['pbegen'],
    'u_id' => $_SESSION['user_id']
  ));

  if ($begen) {
    $kategori = $_GET['kategori'];
    header("Location:../../profile.php?pbegenDurum=ok");
  }else {
    header("Location:../../profile.php?pbegenDurum=no");
  }
}

if (isset($_GET['pbegenme'])) {
  $postBegenme = $db ->prepare("DELETE FROM stars WHERE
    post_id=:p_id and
    user_id=:u_id
  ");

  $begenme = $postBegenme -> execute(array(
    'p_id' => $_GET['pbegenme'],
    'u_id' => $_SESSION['user_id']
  ));

  if ($begenme) {
    $kategori = $_GET['kategori'];
    header("Location:../../profile.php?pbegenmeDurum=ok");
  }else {
    header("Location:../../profile.php?pbegenmeDurum=no");
  }
}

if (isset($_GET['pkaydet'])) {
  $postKaydet = $db ->prepare("INSERT INTO saved SET
    post_id=:p_id,
    user_id=:u_id
  ");

  $kaydet = $postKaydet -> execute(array(
    'p_id' => $_GET['pkaydet'],
    'u_id' => $_SESSION['user_id']
  ));

  if ($kaydet) {
    $kategori = $_GET['kategori'];
    header("Location:../../profile.php?pkaydetDurum=ok");
  }else {
    header("Location:../../profile.php?pkaydetDurum=no");
  }
}

if (isset($_GET['pkaydetme'])) {
  $postKatdetme = $db ->prepare("DELETE FROM saved WHERE
    post_id=:p_id and
    user_id=:u_id
  ");

  $kaydetme = $postKatdetme -> execute(array(
    'p_id' => $_GET['pkaydetme'],
    'u_id' => $_SESSION['user_id']
  ));

  if ($kaydetme) {
    $kategori = $_GET['kategori'];
    header("Location:../../profile.php?pkaydetmeDurum=ok");
  }else {
    header("Location:../../profile.php?pkaydetmeDurum=no");
  }
}

/* SAVED STAR SAVED PAGE*/

if (isset($_GET['kbegen'])) {
  $postBegen = $db ->prepare("INSERT INTO stars SET
    post_id=:p_id,
    user_id=:u_id
  ");

  $begen = $postBegen -> execute(array(
    'p_id' => $_GET['kbegen'],
    'u_id' => $_SESSION['user_id']
  ));

  if ($begen) {
    $kategori = $_GET['kategori'];
    header("Location:../../saved.php?pbegenDurum=ok");
  }else {
    header("Location:../../saved.php?pbegenDurum=no");
  }
}

if (isset($_GET['kbegenme'])) {
  $postBegenme = $db ->prepare("DELETE FROM stars WHERE
    post_id=:p_id and
    user_id=:u_id
  ");

  $begenme = $postBegenme -> execute(array(
    'p_id' => $_GET['kbegenme'],
    'u_id' => $_SESSION['user_id']
  ));

  if ($begenme) {
    $kategori = $_GET['kategori'];
    header("Location:../../saved.php?pbegenmeDurum=ok");
  }else {
    header("Location:../../saved.php?pbegenmeDurum=no");
  }
}

if (isset($_GET['kkaydet'])) {
  $postKaydet = $db ->prepare("INSERT INTO saved SET
    post_id=:p_id,
    user_id=:u_id
  ");

  $kaydet = $postKaydet -> execute(array(
    'p_id' => $_GET['kkaydet'],
    'u_id' => $_SESSION['user_id']
  ));

  if ($kaydet) {
    $kategori = $_GET['kategori'];
    header("Location:../../saved.php?pkaydetDurum=ok");
  }else {
    header("Location:../../saved.php?pkaydetDurum=no");
  }
}

if (isset($_GET['kkaydetme'])) {
  $postKatdetme = $db ->prepare("DELETE FROM saved WHERE
    post_id=:p_id and
    user_id=:u_id
  ");

  $kaydetme = $postKatdetme -> execute(array(
    'p_id' => $_GET['kkaydetme'],
    'u_id' => $_SESSION['user_id']
  ));

  if ($kaydetme) {
    $kategori = $_GET['kategori'];
    header("Location:../../saved.php?pkaydetmeDurum=ok");
  }else {
    header("Location:../../saved.php?pkaydetmeDurum=no");
  }
}



/*if (isset($_SESSION['c'])) {
  $postId = $_GET['post'];
  $kategori = $_GET['kategori'];
  $commentText = $_SESSION['b'];

  $commentKaydet = $db -> prepare("INSERT INTO comments SET
    post_id=:post_id,
    comment_text=:comment_text,
    user_id=:user_id
  ");

  $paylas = $commentKaydet -> execute(array(
    'post_id' => $postId,
    'comment_text' => $commentText,
    'user_id' => $_SESSION['user_id']
  ));

  if ($paylas) {
    header("Location:../../comment.php?post=$postId&kategori=$kategori&comment=yes");
  }else {
    header("Location:../../comment.php?post=$postId&kategori=$kategori&comment=no");
  }
}else {
  echo "vnfdilkvnfilkvn";
}*/



/*if (isset($_SESSION['btnProfilGuncelle'])) {

  $pName = $_SESSION['editName'];
  $pInfo = $_SESSION['editName'];
  $pWeb = $_SESSION['editName'];

  $profilal=$db->prepare("UPDATE profiles SET
    profile_name=:profile_name,
    profile_info=:profile_info,
    profile_website=:profile_website
    WHERE user={$_SESSION['user_id']}");

  $guncelle = $profilal->execute(array(
    'profile_name'=>$pName,
    'profile_info'=>$pInfo,
    'profile_website'=>$pWeb
  ));

  if ($guncelle) {
    header("Location:../../editprofile.php");
  }

}else {
  echo "dsfccfvzcszvcdsfv";
}*/

/*if (isset($_SESSION['btnPostShare'])) {

    $shareTitle = $_SESSION['shareTitle'];
    $shareExplanatione = $_SESSION['shareExplanation'];
    $category = $_SESSION['categoryName;'];

    $postKaydet = $db ->prepare("INSERT INTO posts SET
      user_id=:user_id,
      post_picture_one=:post_picture_one,
      post_picture_one_url=:post_picture_one_url,
      post_picture_two=:post_picture_two,
      post_picture_two_url=:post_picture_two_url,
      post_picture_three=:post_picture_three,
      post_picture_three_url=:post_picture_three_url,
      post_title=:post_title,
      post_explanation=:post_explanation,
      post_category=:post_category
    ");

    $kaydet = $postKaydet -> execute(array(
      'user_id' => $_SESSION['user_id'],
      'post_picture_one' => "",
      'post_picture_one_url' => "",
      'post_picture_two' => "",
      'post_picture_two_url' => "",
      'post_picture_three' => "",
      'post_picture_three_url' => "",
      'post_title' =>$shareTitle,
      'post_explanation' => $shareExplanatione,
      'post_category' => $category
    ));

    if ($kaydet) {
      header("Location:../../index.php?pkaydetDurum=ok");
    }else {
      header("Location:../../index.php?pkaydetDurum=no");
    }

}*/




?>
