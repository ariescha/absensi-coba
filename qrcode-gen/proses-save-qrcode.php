<?php 
    error_reporting(0);
    ini_set('display_errors', TRUE);
    ini_set('display_startup_errors', TRUE);
    session_start();

    include_once("../../../config/config.php");
    include_once("../../../config/fungsi_indotgl.php");  
    include_once("../../../library/buildquery.php");


    $post = $_REQUEST;
    if(!$_SESSION['niklogin']){
      echo json_encode(['code'=>0, 'msg'=>'Session anda habis']);
      die();
    }

    $query = "";
   
   
    date_default_timezone_set("Asia/Bangkok");
    $nama_lokasi =  $post['nama_lokasi'];
    $longitude = $post['longitude'];
    $latitude = $post['latitude'];
    $created_date = date('Y-m-d H:i:sa');
    
    $notes = null;
    

    if($post!=""){
     
        $query.=" insert into saved_qrcode_list ( lokasi_absensi,longitude,latitude,tanggal ) 
        values('$nama_lokasi','$longitude','$latitude','$created_date') ";
      
    }
    $ex = mysql_query($query);
    header("location: /mydata-trx/modul/absensi-dev/qrcode-gen/qrcode-generator.php");
    ?>	

