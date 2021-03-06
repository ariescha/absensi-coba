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

    print_r($post);
    $query = "";

    $shift = $post['jadwal_shift'];
    $checkin_start_time_sched = null;
    $checkin_end_time_sched = null;
    $checkout_time_sched = null;

    $jadwalShift = mysql_query("select * from absen_jadwal");
    $arrayShift = [];
    while ($jadwalShiftFetch = mysql_fetch_array($jadwalShift)){
      $arrayCurrentShift = [];
      array_push($arrayCurrentShift, $jadwalShiftFetch['code']);
      array_push($arrayCurrentShift, $jadwalShiftFetch['start']);
      array_push($arrayCurrentShift, $jadwalShiftFetch['end']);
      array_push($arrayShift, $arrayCurrentShift);
    }
    
    //non operasional
    if ($shift == null){
      $shift = $arrayShift[0][0];
      $checkin_start_time_sched = $arrayShift[0][1];
      $checkin_end_time_sched = $arrayShift[0][1];
      $checkout_time_sched = $arrayShift[0][2];
    }
    
    //operasional
    else{
      if ($shift=='05:00'){
        $shift = $arrayShift[1][0];
        $checkin_start_time_sched = $arrayShift[1][1];
        $checkin_end_time_sched = $arrayShift[1][1];
        $checkout_time_sched = $arrayShift[1][2];
      }else if ($shift=='13:00'){
        $shift = $arrayShift[2][0];
        $checkin_start_time_sched = $arrayShift[2][1];
        $checkin_end_time_sched = $arrayShift[2][1];
        $checkout_time_sched = $arrayShift[2][2];
      } else{
        $shift = $arrayShift[3][0];
        $checkin_start_time_sched = $arrayShift[3][1];
        $checkin_end_time_sched = $arrayShift[3][1];
        $checkout_time_sched = $arrayShift[3][2];
      }
    }

    date_default_timezone_set("Asia/Bangkok");
    $nik =  $post['nik_karyawan'];
    $nama = $post['nama_lengkap_karyawan'];
    if(isset($post['alasan_terlambat'])){
      $late_reason = $post['alasan_terlambat'];
    }else{
      $late_reason = null;
    }
    $tgl_absence = date('Y-m-d');
    $checkin_time = date('Y-m-d H:i:sa');
    $checkin_location = $post['lokasi_perangkat'];
    $checkout_location = null;
    $status_checkin = 0;
    $reason = null;
    $notes = null;
    $status_attendance = "Hadir";

    //new variable
    $nominal = null;
    $status = null;
    $status_by = null;
    $foto_in = null;
    $foto_out = null;
    $created_at = $checkin_time;
    $updated_at = $checkin_time;
    $created_by = $nik;
    $updated_by = $nik;

    $long_checkin = $post['longitude-check-in'];
    $lat_checkin = $post['latitude-check-in'];

    // echo $long_checkin;
    // echo $lat_checkin;

    if($post!=""){
      if($post['jenis_operasional'] == 'Operasional'){  
        $query.=" insert into trx_absensi ( nik, 
                                            date_absence, 
                                            check_in_time_start_schedule,
                                            check_in_time_end_schedule,
                                            check_out_time_schedule,
                                            check_in,                                      
                                            check_in_location,
                                            check_out_location,
                                            status_checkin,
                                            reason,
                                            late_reason,
                                            location_work,
                                            shift,
                                            description,
                                            nominal,
                                            status,                                        
                                            status_by,
                                            foto_in,
                                            foto_out,
                                            created_at,
                                            updated_at,
                                            created_by,
                                            updated_by,
                                            status_attendance,
                                            lat_check_in,
                                            long_check_in ) 
        values('$nik',
                '$tgl_absence',
                '$checkin_start_time_sched',
                '$checkin_end_time_sched',
                '$checkout_time_sched',
                '$checkin_time',               
                '$checkin_location',
                '$checokut_location',
                '$status_checkin',
                '$reason',
                '$late_reason',
                'Operasional',
                '$shift',
                '$notes',
                '$nominal',
                '$status',               
                '$status_by',
                '$foto_in',
                '$foto_out',
                '$created_at',
                '$updated_at', 
                '$created_by',
                '$updated_by',
                '$status_attendance',
                '$lat_checkin',
                '$long_checkin') ";       
      } else{
        // echo 'masukkkkk';
        if ($post['wfo_wfa'] == 'wfa'){          
          $query.=" insert into trx_absensi ( nik, 
                                              date_absence, 
                                              check_in_time_start_schedule,
                                              check_in_time_end_schedule,
                                              check_out_time_schedule,
                                              check_in,                                         
                                              check_in_location,
                                              check_out_location,
                                              status_checkin,
                                              reason,
                                              late_reason,
                                              location_work,
                                              shift,
                                              description,
                                              nominal,
                                              status,      
                                              status_by,
                                              foto_in,
                                              foto_out,
                                              created_at,
                                              updated_at,
                                              created_by,
                                              updated_by,
                                              status_attendance,
                                              lat_check_in,
                                              long_check_in ) 
              values('$nik',
                      '$tgl_absence',
                      '$checkin_start_time_sched',
                      '$checkin_end_time_sched',
                      '$checkout_time_sched',
                      '$checkin_time',      
                      '$checkin_location',
                      '$checokut_location',
                      '$status_checkin',
                      '$reason',
                      '$late_reason',
                      'WFA',
                      '$shift',
                      '$notes',
                      '$nominal',
                      '$status',   
                      '$status_by',
                      '$foto_in',
                      '$foto_out',
                      '$created_at',
                      '$updated_at', 
                      '$created_by',
                      '$updated_by',
                      '$status_attendance',
                      '$lat_checkin',
                      '$long_checkin') ";
        }else{  
          // echo '3333333';  
          $query.=" insert into trx_absensi ( nik, 
                                            date_absence, 
                                            check_in_time_start_schedule,
                                            check_in_time_end_schedule,
                                            check_out_time_schedule,
                                            check_in,                                      
                                            check_in_location,
                                            check_out_location,
                                            status_checkin,
                                            reason,
                                            late_reason,
                                            location_work,
                                            shift,
                                            description,
                                            nominal,
                                            status,                                        
                                            status_by,
                                            foto_in,
                                            foto_out,
                                            created_at,
                                            updated_at,
                                            created_by,
                                            updated_by,
                                            status_attendance,
                                            lat_check_in,
                                            long_check_in ) 
        values('$nik',
                '$tgl_absence',
                '$checkin_start_time_sched',
                '$checkin_end_time_sched',
                '$checkout_time_sched',
                '$checkin_time',               
                '$checkin_location',
                '$checokut_location',
                '$status_checkin',
                '$reason',
                '$late_reason',
                'WFO',
                '$shift',
                '$notes',
                '$nominal',
                '$status',               
                '$status_by',
                '$foto_in',
                '$foto_out',
                '$created_at',
                '$updated_at', 
                '$created_by',
                '$updated_by',
                '$status_attendance',
                '$lat_checkin',
                '$long_checkin') "; 
        
        }
      }
    }
  $ex = mysql_query($query);
  header("location: /mydata/modul/absen-dev/dashboard-absensi.php");	
?>