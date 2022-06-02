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
    $sqlTableAbsensiLast = mysql_query("select * from absensi_checkin where nik='$nik' order by absensi_id desc limit 1");
    $dataTableAbsensiLast = mysqli_fetch_array($sqlTableAbsensiLast);
    $absensiId = $dataTableAbsensiLast['absensi_id'];

    if ($dataTableAbsensiLast['status_checkin']==1){
        header("location: /mydata/modul/checkin_dev/dashboard-absensi.php");
    }else{
        date_default_timezone_set("Asia/Bangkok");
        $checkoutLocation = null;
        $checkoutTime = date('Y-m-d H:i:s');

        $query = "UPDATE absensi_checkin SET checkout_location='$checkoutLocation', checkout_time='$checkoutTime', status_checkin=1 WHERE absensi_id='$absensiId'";

        $ex = mysql_query($query);
        header("location: /mydata/modul/checkin_dev/dashboard-absensi.php");
    }
?>