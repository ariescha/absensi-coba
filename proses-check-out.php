<?php 
    error_reporting(0);
    ini_set('display_errors', TRUE);
    ini_set('display_startup_errors', TRUE);
    session_start();

    include_once("../../config/config.php");
    include_once("../../config/fungsi_indotgl.php");  
    include_once("../../library/buildquery.php");


    if(!$_SESSION['niklogin']){
        echo json_encode(['code'=>0, 'msg'=>'Session anda habis']);
        die();
    }
    $nik = $_SESSION['niklogin'];
    $sqlTableAbsensiLast = mysql_query("select * from trx_absensi where nik='$nik' order by id desc limit 1");
    $dataTableAbsensiLast = mysql_fetch_array($sqlTableAbsensiLast);
    $absensiId = $dataTableAbsensiLast['id'];

    // print_r($_POST);

    if ($dataTableAbsensiLast['status_checkin']==1){
        header("location: /mydata/modul/absen-dev/dashboard-absensi.php");
    }else{
        date_default_timezone_set("Asia/Bangkok");
        $checkoutLocation = $_POST['lokasi_check_out'];
        $checkoutTime = date('Y-m-d H:i:s');
        $lat_checkout = $_POST['latitude_check_out'];
        $long_checkout = $_POST['longitude_check_out'];

        $query = "UPDATE trx_absensi SET lat_check_out='$lat_checkout', long_check_out='$long_checkout', check_out_location='$checkoutLocation', check_out='$checkoutTime', updated_at='$checkoutTime', status_checkin=1 WHERE id='$absensiId'";

        $ex = mysql_query($query);
        header("location: /mydata/modul/absen-dev/dashboard-absensi.php");
    }
?>