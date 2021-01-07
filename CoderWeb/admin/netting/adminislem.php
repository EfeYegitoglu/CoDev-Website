<?php
session_start();

include 'baglan.php';

/*ADMIN GİRİŞ*/

if (isset($_POST['admingiris'])) {
  $adminMail = $_POST['adminMail'];
  $adminPassword = $_POST['adminPassword'];

  $adminsor=$db->prepare("SELECT * FROM admin WHERE admin_mail=:adminMail and admin_password=:adminPassword and admin_state=:state");
  $adminsor->execute(array(
    'adminMail'=>$adminMail,
    'adminPassword'=>$adminPassword,
    'state'=> 1
  ));
  $adminSorgu = $adminsor -> rowCount();
  $admincek=$adminsor->fetch(PDO::FETCH_ASSOC);

  if ($adminSorgu > 0) {
    $_SESSION['admin_id']=$admincek['admin_id'];
    header("Location:../adminpanel/index.php");
  }else {
    header("Location:../adminpanel/login.php?durum=no");
  }

}

/*ADMİN KULANICI DÜZENLE*/

if (isset($_POST['adminKullaniciDuzenle'])) {
  $kullanici_id = $_POST['user_id'];

  $adminKduzenle = $db->prepare("UPDATE users SET
    user_mail=:mail,
    verification_code=:vc,
    account_state=:state
    WHERE user_id={$_POST['user_id']}");

  $adminkduzenle = $adminKduzenle->execute(array(
    'mail'=>$_POST['user_mail'],
    'vc' => $_POST['verification_code'],
    'state' => $_POST['account_state']
  ));

  if ($adminkduzenle) {

		Header("Location:../adminpanel/kullanici-duzenle.php?kullanici_id=$kullanici_id&durum=ok");

	} else {

		Header("Location:../adminpanel/kullanici-duzenle.php?kullanici_id=$kullanici_id&durum=no");
	}

}

/*ADMİN KULLANICI SİL*/

if ($_GET['kullanicisil']=="ok") {
  $sil=$db->prepare("DELETE FROM users WHERE user_id=:id");
  $kontrol=$sil->execute(array(
    'id'=>$_GET['kullanici_id']
  ));

  if ($kontrol) {
    header("Location:../adminpanel/kullanici.php?sil=ok");
  }else {
    header("Location:../adminpanel/kullanici.php?sil=no");
  }
}

/*ADMİN PROFİL DÜZENLE*/

if (isset($_POST['adminProfilDuzenle'])) {
  $profil_id = $_POST['profile_id'];

  $adminPduzenle = $db->prepare("UPDATE profiles SET
    profile_name=:name,
    profile_info=:info,
    profile_website=:website
    WHERE profile_id={$_POST['profile_id']}");

  $adminpduzenle = $adminPduzenle->execute(array(
    'name'=>$_POST['profile_name'],
    'info' => $_POST['profile_info'],
    'website' => $_POST['profile_website']
  ));

  if ($adminpduzenle) {

		Header("Location:../adminpanel/profil-duzenle.php?profile_id=$profil_id&durum=ok");

	} else {

		Header("Location:../adminpanel/profil-duzenle.php?profile_id=$profil_id&durum=no");
	}

}


if ($_GET['profilsil']=="ok") {
  $sil=$db->prepare("DELETE FROM profiles WHERE profile_id=:id");
  $kontrol=$sil->execute(array(
    'id'=>$_GET['profile_id']
  ));

  if ($kontrol) {
    header("Location:../adminpanel/profil.php?sil=ok");
  }else {
    header("Location:../adminpanel/profil.php?sil=no");
  }
}


?>
