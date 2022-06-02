<?php 
	  include_once("config/config.php");
    session_start();

    $namalengkap = $_SESSION['namalengkap'];	
    $nik = $_SESSION['niklogin'];
    ?>
<!DOCTYPE html>

<!-- =========================================================
* Sneat - Bootstrap 5 HTML Admin Template - Pro | v1.0.0
==============================================================

* Product Page: https://themeselection.com/products/sneat-bootstrap-html-admin-template/
* Created by: ThemeSelection
* License: You must have a valid license purchased in order to legally use the theme for your project.
* Copyright ThemeSelection (https://themeselection.com)

=========================================================
 -->
<!-- beautify ignore:start -->
<html
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Absensi Karyawan JMTO</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="assets/img/fingerprint.png" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <link rel="stylesheet" href="assets/vendor/libs/apex-charts/apex-charts.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="assets/vendor/js/helpers.js"></script>
    <script src="assets/js/qrcode.min.js"></script>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="assets/js/config.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.10.0.min.js"></script>
    <script src="html5-qrcode.min.js"></script>
    <style>
        @media print {

        body {
        margin: 0;
        color: #000;
        background-color: #fff;
        }
        .kuning {
            background-color: red !important; 
        }
        }
    </style>
  </head>
<body>

<div class="layout-wrapper layout-content-navbar layout-without-menu">
      <div class="layout-container">
         <!-- Menu -->

         
        <!-- / Menu -->
        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

          
            

          <!-- / Navbar -->
          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
             
              <div class="row"  id="card-qrcode-generator">
                <div class="col-lg-12 mb-4 order-0">
                  <div class="card" style="display:show">
                    <div class="d-flex align-items-end row">
                        <div class="card-header">
                              <img src="assets/img/logo-jasa-marga.jpg" alt="" style="width=110px;height:45px;">
                              <img src="assets/img/logo-jmto.png" alt="" style="width=100px;height:40px;">

                        </div>
                        <div class="card-body">
                            <div class="card-title">
                                <center>
                                    <h1 class="text-primary"><b>Scan QR Code</b><h1>
                                    <h4>Scan kode QR untuk checkin absensi karyawan</h4>
                                    <div id="qrcode"></div><br>
                                    <h4 class="text-primary"><b>Kantor Pusat Jasa Marga</b></h4>
                                </center>
                                </div>
                            <div class="kuning">
                                <center><h4 class="text-primary"><b>CARA SCAN QR CODE</b></h4></div></center>
                            </div>
                        </div>
                      </div>
                      
                      </div>
                  </div>
                    </div>
                  </div>
            <script type="text/javascript" src="https://unpkg.com/qr-code-styling@1.5.0/lib/qr-code-styling.js"></script>
             
            <script type="text/javascript">
            
               var qrcode = new QRCodeStyling({
                    width: 300,
                    height: 300,
                    type: "svg",
                    data: "Kantor Pusat Jasa Marga;0290382323;9139183",
                    image: "assets/img/logo-jmto.png",
                    dotsOptions: {
                        color: "#104d9f",
                        type: "rounded"
                    },
                    backgroundOptions: {
                        color: "#e9ebee",
                    },
                    imageOptions: {
                        crossOrigin: "anonymous",
                        margin: 0
                    }
                });
                qrcode.append(document.getElementById("qrcode"));
                window.print();
            </script>
             
    

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="assets/vendor/libs/jquery/jquery.js"></script>
    <script src="assets/vendor/libs/popper/popper.js"></script>
    <script src="assets/vendor/js/bootstrap.js"></script>
    <script src="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="assets/vendor/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="assets/js/dashboards-analytics.js"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    
    <script type="text/javascript">

       
    </script>
  </body>
</html>
