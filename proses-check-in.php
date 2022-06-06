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
    // print_r($post);


    $query = "";

    $shift = $post['jadwal_shift'];
    $checkin_start_time_sched = null;
    $checkin_end_time_sched = null;
    $checkout_time_sched = null;

    $jadwalShift = mysql_query("select * from absen_jadwal");
    $arrayShift = [];
    while ($jadwalShiftFetch = mysqli_fetch_array($jadwalShift)){
      $arrayCurrentShift = [];
      array_push($arrayCurrentShift, $jadwalShiftFetch['title']);
      array_push($arrayCurrentShift, $jadwalShiftFetch['start']);
      array_push($arrayCurrentShift, $jadwalShiftFetch['end']);
      array_push($arrayShift, $arrayCurrentShift);
    }
    
    //non operasional
    if ($shift == null){
      $shift = 'Non Operasional ';
      $checkin_start_time_sched = $arrayShift[0][1];
      $checkin_end_time_sched = $arrayShift[0][1];
      $checkout_time_sched = $arrayShift[0][2];
    }
    
    //operasional
    else{
      if ($shift=='Shift 1'){
        $checkin_start_time_sched = $arrayShift[2][1];
        $checkin_end_time_sched = $arrayShift[2][1];
        $checkout_time_sched = $arrayShift[2][2];
      }else if ($shift=='Shift 2'){
        $checkin_start_time_sched = $arrayShift[3][1];
        $checkin_end_time_sched = $arrayShift[3][1];
        $checkout_time_sched = $arrayShift[3][2];
      } else{
        $checkin_start_time_sched = $arrayShift[4][1];
        $checkin_end_time_sched = $arrayShift[4][1];
        $checkout_time_sched = $arrayShift[4][2];
      }
    }
    // echo $checkin_start_time_sched;
    // echo $checkin_end_time_sched;
    // echo $checkout_time_sched;

    date_default_timezone_set("Asia/Bangkok");
    $nik =  $post['nik_karyawan'];
    echo $nik;
    $nama = $post['nama_lengkap_karyawan'];
    $tgl_absence = date('Y-m-d');
    $checkin_time = date('Y-m-d H:i:sa');
    $late_reason = null;
    $checkin_location = $post['lokasi_perangkat'];
    $checkout_location = null;
    $lokasi_kerja = $post['nama_kantor'];
    $status_attendance = 0;
    $reason = null;
    $notes = null;

    //new variable
    $nominal = null;
    $status = null;
    $status_at = null;
    $status_by = null;
    $foto_in = null;
    $foto_out = null;
    $created_at = $checkin_time;
    $updated_at = $checkin_time;
    $created_by = $nik;
    $updated_by = $nik;



    if($post!=""){
      if($post['jenis_operasional'] == 'Operasional'){  
        $query.=" insert into trx_absensi ( nik, 
                                            date_absence, 
                                            check_in_time_start_schedule,
                                            check_in_time_end_schedule,
                                            check_out_time_schedule,
                                            check_in,
                                            check_out,
                                            check_in_location,
                                            check_out_location,
                                            status_attendance,
                                            reason,
                                            late_reason,
                                            location_work,
                                            shift,
                                            description,

                                            nominal,
                                            status,
                                            status_at,
                                            status_by,
                                            foto_in,
                                            foto_out,
                                            created_at,
                                            updated_at,
                                            created_by,
                                            updated_by ) 
        values('$nik',
                '$tgl_absence',
                '$checkin_start_time_sched',
                '$checkin_end_time_sched',
                '$checkout_time_sched',
                '$checkin_time',
                '$checkout_time',
                '$checkin_location',
                '$checokut_location',
                '$status_attendance',
                '$reason',
                '$late_reason',
                '$lokasi_kerja',
                '$shift',
                '$notes',
                '$nominal',
                '$status',
                '$status_at',
                '$status_by',
                '$foto_in',
                '$foto_out',
                '$created_at',
                '$updated_at', 
                '$created_by',
                '$updated_by') ";
        
        
      } else{
        if ($post['wfo_wfh'] == 'wfh'){          
          $query.=" insert into trx_absensi ( nik, 
                                              date_absence, 
                                              check_in_time_start_schedule,
                                              check_in_time_end_schedule,
                                              check_out_time_schedule,
                                              check_in,
                                              check_out,
                                              check_in_location,
                                              check_out_location,
                                              status_attendance,
                                              reason,
                                              late_reason,
                                              location_work,
                                              shift,
                                              description,
                                              nominal,
                                              status,
                                              status_at,
                                              status_by,
                                              foto_in,
                                              foto_out,
                                              created_at,
                                              updated_at,
                                              created_by,
                                              updated_by ) 
              values('$nik',
                      '$tgl_absence',
                      '$checkin_start_time_sched',
                      '$checkin_end_time_sched',
                      '$checkout_time_sched',
                      '$checkin_time',
                      '$checkout_time',
                      '$checkin_location',
                      '$checokut_location',
                      '$status_attendance',
                      '$reason',
                      '$late_reason',
                      '$checkin_location',
                      'WFH_$shift',
                      '$notes',
                      '$nominal',
                      '$status',
                      '$status_at',
                      '$status_by',
                      '$foto_in',
                      '$foto_out',
                      '$created_at',
                      '$updated_at', 
                      '$created_by',
                      '$updated_by') ";
        }else{
        
          $query.=" insert into trx_absensi ( nik, 
                                              date_absence, 
                                              check_in_time_start_schedule,
                                              check_in_time_end_schedule,
                                              check_out_time_schedule,
                                              check_in,
                                              check_out,
                                              check_in_location,
                                              check_out_location,
                                              status_attendance,
                                              reason,
                                              late_reason,
                                              location_work,
                                              shift,
                                              description,
                                              nominal,
                                              status,
                                              status_at,
                                              status_by,
                                              foto_in,
                                              foto_out,
                                              created_at,
                                              updated_at,
                                              created_by,
                                              updated_by ) 
              values('$nik',
                      '$tgl_absence',
                      '$checkin_start_time_sched',
                      '$checkin_end_time_sched',
                      '$checkout_time_sched',
                      '$checkin_time',
                      '$checkout_time',
                      '$checkin_location',
                      '$checokut_location',
                      '$status_attendance',
                      '$reason',
                      '$late_reason',
                      '$lokasi_kerja',
                      'WFO_$shift',
                      '$notes',
                      '$nominal',
                      '$status',
                      '$status_at',
                      '$status_by',
                      '$foto_in',
                      '$foto_out',
                      '$created_at',
                      '$updated_at', 
                      '$created_by',
                      '$updated_by') ";
        
        }
      }
    }
  // echo $query;
  $ex = mysql_query($query);
  header("location: /mydata-trx/modul/absensi-dev/dashboard-absensi.php");	

?>
