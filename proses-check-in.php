<?php 
    error_reporting(0);
    ini_set('display_errors', TRUE);
    ini_set('display_startup_errors', TRUE);
    session_start();

    include_once("../../config/config.php");
    include_once("../../config/fungsi_indotgl.php");  
    include_once("../../library/buildquery.php");


    $post = $_REQUEST;
    if(!$_SESSION['niklogin']){
      echo json_encode(['code'=>0, 'msg'=>'Session anda habis']);
      die();
    }

    //PLAN UNTUK GET DARI TABLE LAIN UNTUK ADD DATA KE TABLE ABSENSI_CHECKIN
    // $nikKaryawan = $post['nik_karyawan'];
    // $sqlTableAbsensi = mysql_query("select * from karyawan where nik='$nikKaryawan'");
    // $dataTableAbsensi = mysqli_fetch_array($sqlTableAbsensi);    
    // print_r ($dataTableAbsensi); 
    // echo $dataTableAbsensi[0]['jabatan'];


    $query = "";


    date_default_timezone_set("Asia/Bangkok");
    $nik =  $post['nik_karyawan'];
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
    $checkin_location = $post['lokasi_perangkat'];
    $checkout_location = null;
    $lokasi_kerja = $post['nama_kantor'];
    $shift = $post['jadwal_shift'];
    $notes = null;

    if($post!=""){
      if($post['jenis_operasional'] == 'Operasional'){
        $query.=" insert into absensi_checkin ( nik,nama,grade,subgrade,jab,kd_jab,posisi,unit,seksi,departemen,kd_comp,tgl_absence,checkin_start_time_sched,checkin_end_time_sched,checkin_time,checkout_time_sched,checkout_time,late_reason,checkin_location,checkout_location,lokasi_kerja,shift,notes, status_checkin ) 
        values('$nik','$nama','$grade','$subgrade','$jab','$kd_jab','$posisi','$unit','$seksi','$departemen','$kd_comp','$tgl_absence','$checkin_start_time_sched','$checkin_end_time_sched','$checkin_time','$checkout_time_sched','$checkout_time','$late_reason','$checkin_location','$checokut_location','$lokasi_kerja','$shift','$notes', 0) ";
      } else{
        $query.=" insert into absensi_checkin ( nik,nama,grade,subgrade,jab,kd_jab,posisi,unit,seksi,departemen,kd_comp,tgl_absence,checkin_start_time_sched,checkin_end_time_sched,checkin_time,checkout_time_sched,checkout_time,late_reason,checkin_location,checkout_location,lokasi_kerja,shift,notes, status_checkin ) 
        values('$nik','$nama','$grade','$subgrade','$jab','$kd_jab','$posisi','$unit','$seksi','$departemen','$kd_comp','$tgl_absence','$checkin_start_time_sched','$checkin_end_time_sched','$checkin_time','$checkout_time_sched','$checkout_time','$late_reason','$checkin_location','$checokut_location','$lokasi_kerja','$shift','$notes', 0) ";
      }
    }
  // echo $query;
  $ex = mysql_query($query);
  header("location: /mydata/modul/checkin_dev/dashboard-absensi.php");	

?>
