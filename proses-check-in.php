<?php 
  error_reporting(0);
  ini_set('display_errors', TRUE);
  ini_set('display_startup_errors', TRUE);
  session_start();

  include_once("../../config/config.php");
  include_once("../../config/fungsi_indotgl.php");  
  include_once("../../library/buildquery.php");
  // echo 'a'; die();

  $post = $_REQUEST;
  if(!$_SESSION['niklogin']){
    echo json_encode(['code'=>0, 'msg'=>'Session anda habis']);
    die();
  }
  $query = "";
  print_r($post);

    date_default_timezone_set("Asia/Bangkok");
    $nik =  $_POST['nik'];
    $nama = $post['nama_lengkap_karyawan'];
    $grade = null;
    $subgrade = null;
    $jab = null;
    $kd_jab = null;
    $posisi = null;
    $unit = null;
    $seksi = null;
    $departemen = null;
    $kd_comp = null;
    $tgl_absence = date('Y-m-d');
    $checkin_start_time_sched = null;
    $checkin_end_time_sched = null;
    $checkin_time = date('Y-m-d H:i:s');
    $late_reason = null;
    $checkin_location = $_POST['checkin_location'];
    $checkout_location = $_POST['checkout_location'];
    $lokasi_kerja = $_POST['lokasi_kerja'];
    $shift = $_POST['shift'];
    $notes = $_POST['notes'];

  if($post!=""){
      if($post['jenis_operasional'] == 'Operasional'){
        $query.=" insert into absensi ( nik,nama,grade,subgrade,jab,kd_jab,posisi,unit,seksi,departemen,kd_comp,tgl_absence,checkin_start_time_sched,checkin_end_time_sched,checkin_time,checkout_time_sched,checkout_time,late_reason,checkin_location,checkout_location,lokasi_kerja,shift,notes ) 
        values('$nik','$nama','$grade','$subgrade','$jab','$kd_jab','$posisi','$unit','$seksi','$departemen','$kd_comp','$tgl_absence','$checkin_start_time_sched','$checkin_end_time_sched','$checkin_time','$checkout_time_sched','$checkout_time','$late_reason','$checkin_location','$checokut_location','$lokasi_kerja','$shift','$notes') ";
      } else{
        $query.=" insert into absensi ( nik,nama,grade,subgrade,jab,kd_jab,posisi,unit,seksi,departemen,kd_comp,tgl_absence,checkin_start_time_sched,checkin_end_time_sched,checkin_time,checkout_time_sched,checkout_time,late_reason,checkin_location,checkout_location,lokasi_kerja,shift,notes ) 
        values('$nik','$nama','$grade','$subgrade','$jab','$kd_jab','$posisi','$unit','$seksi','$departemen','$kd_comp','$tgl_absence','$checkin_start_time_sched','$checkin_end_time_sched','$checkin_time','$checkout_time_sched','$checkout_time','$late_reason','$checkin_location','$checokut_location','$lokasi_kerja','$shift','$notes') ";
      }
  }
  $ex = mysql_query($query);

  ?>
