<?php 
	  include_once("../../config/config.php");
    include_once("../../config/fungsi_indotgl.php");  
    include_once("../../library/buildquery.php");
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

  </head>
<body>

<div class="layout-wrapper layout-content-navbar layout-without-menu">
      <div class="layout-container">
         <!-- Menu -->

         
        <!-- / Menu -->
        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

          <nav
            class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
            id="layout-navbar"
          >
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm" ></i>
              </a>
            </div>

            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
              
                <div class="navbar-nav align-items-center">
                    <div class="nav-item d-flex align-items-center">
                        <b>ABSENSI KARYAWAN JMTO</b>
                    </div>
                </div>
              <ul class="navbar-nav flex-row align-items-center ms-auto">
                <!-- Place this tag where you want the button to render. -->
                

                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                      <img src="assets/img/foto.jpg" alt class="w-px-40 h-auto rounded-circle" />
                    </div>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                      <a class="dropdown-item" href="">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar avatar-online">
                              <img src="assets/img/foto.jpg" alt class="w-px-40 h-auto rounded-circle" />
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <span class="fw-semibold d-block"><?php echo $namalengkap ?></span>
                            <small class="text-muted">Karyawan</small>
                          </div>
                        </div>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="../../mainmenu.php">
                        <i class="bx bx-exit me-2"></i>
                        <span class="align-middle">Kembali ke Main Menu</span>
                      </a>
                    </li>
                  </ul>
                </li>
                <!--/ User -->
              </ul>
            </div>
          </nav>

          <!-- / Navbar -->
          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
             
              <div class="row"  id="card-qrcode-generator">
                <div class="col-lg-12 mb-4 order-0">
                  <div class="card" style="display:show">
                    <div class="d-flex align-items-end row">
                      <div class="col-sm-8">
                        <div class="card-body">
                          <h4 class="card-title text-primary">Data QR Code</h4>
                          <?php
                          $sqlTableQRCodeLast = mysql_query("select * from saved_qrcode_list order by qr_id desc limit 1");
                          $dataTableQRCodeLast = mysqli_fetch_array($sqlTableQRCodeLast);
                          ?>
                          <form id="form-qrcode-generator" action="proses-save-qrcode.php" method="POST">
                          <div class="row mb-3">
                              <label class="col-sm-4 col-form-label" for="nama_lokasi">Lokasi Absensi</label>
                              <div class="col-sm-8">
                                  <input type="text" 
                                    id="nama_lokasi"
                                    name="nama_lokasi"
                                    class="form-control" 
                                    placeholder="Isikan nama lokasi absensi" 
                                    required
                                  >
                              </div>
                            </div>
                            <div class="row mb-3">
                              <label class="col-sm-4 col-form-label" for="longitude">Longitude</label>
                              <div class="col-sm-8">
                                  <input type="text"
                                    id="longitude"
                                    name="longitude"
                                    class="form-control" 
                                    placeholder="Isikan longitude lokasi"
                                    required
                                  >
                              </div>
                            </div>
                            <div class="row mb-3">
                              <label class="col-sm-4 col-form-label" for="latitude">Latitude</label>
                              <div class="col-sm-8">
                                  <input type="text" 
                                    id="latitude"
                                    name="latitude"
                                    class="form-control"
                                    placeholder="Isikan latitude lokasi"
                                    required
                                  >
                              </div>
                            </div>
                            <div class="row mb-3" style="display:none" id="hasil-qr-code">
                                <label class="col-sm-4 col-form-label" for="hasil-qrcode">Hasil</label>
                                <div class="col-sm-8">
                                    <div id="qrcode"></div>
                                </div>
                            </div>
                            <div class="row justify-content-end" id="button-generate">
                              
                                    <div class="col-sm-10">
                                    </div>
                                    <div class="col-sm-3">
                                        <button type="button" class="btn btn-sm btn-primary" onClick="qrcodeGenerate()">Generate</button>
                                    </div>
                                </div>
                                <div class="row justify-content-end" id="button-reset-print" style="display:none">
                                    <div class="col-sm-10">
                                    </div>
                                    <div class="col-sm-1">
                                        <button type="button" class="btn btn-sm btn-warning" onClick="resetForm()">Reset</button>
                                    </div>
                                    <div class="col-sm-1">
                                        <button type="button" class="btn btn-sm btn-success" onClick="printForm(<?php echo $dataTableQRCodeLast['qr_id']?>)">Print</button>
                                    </div>
                                </div>
                            </div>
                          </form>
                          

                        </div>
                      </div>
                      
                      </div>
                  </div>
                    </div>
                  </div>
              <hr class="my-5" />
             
          <div class="row"  id="table">
            <div class="col-lg-12 mb-4 order-0">
                  <!-- Hoverable Table rows -->
            <div class="card">
              <div class="card-header">
                <h4 class="title">Data QR Code</h4>
                <h6 class="sub-title">Berikut adalah rekapitulasi kehadiranmu selama 7 hari terakhir.</h6>
              </div>
              
              <div class="table-responsive text-nowrap">
                <table class="table table-hover">
                  <thead>

                    <tr style="text-align:center">
                      <th>No</th>
                      <th>Tanggal</th>
                      <th>Lokasi Absensi</th>
                      <th>Latitude</th>
                      <th>Longitude</th>
                      <th>file</th>
                    </tr>
                  </thead>
                  <tbody class="table-border-bottom-0">
                  <?php 
                  $sqlTableQRCode = mysql_query("select * from saved_qrcode_list");

                  $counter = 1;
                  while ($dataTableQRCode = mysqli_fetch_array($sqlTableQRCode)){

                    echo "<tr style='text-align:center'>"; 
                    echo "<td><i class='fab fa-angular fa-lg text-danger me-3'></i>".$counter."</td>";
                    echo "<td>".$dataTableQRCode['tanggal']."</td>";
                    echo "<td>".$dataTableQRCode['lokasi_absensi']."</td>";
                    echo "<td>".$dataTableQRCode['latitude']."</td>";
                    echo "<td>".$dataTableQRCode['longitude']."</td>";
                    echo "<td><button class='btn btn-sm btn-warning' onclick='printFile(".$dataTableQRCode['qr_id'].")'><i class='bx bx-printer bx-sm'></i>Print</button</td>";
                      
                    echo "</tr>";
                    $counter = $counter+1;
                  }

                    ?>
                  </tbody>
                </table>
              </div>
            </div>
            <!--/ Hoverable Table rows -->
                </div>
              </div>
            </div>
            <!-- Modal scan -->
            <div class="modal fade" id="modal-check-in" aria-labelledby="modalToggleLabel" tabindex="-1" style="display: none" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header">
                        <div class="modal-title"><h5>SCAN BARCODE</h5></div>
                      </div>
                        <div class="modal-body">
                          <div style="width: 500px" id="qr-reader"></div>
                         
                          </div>
                        </div>
                    </div>
                </div>
</html>
            <script type="text/javascript">
               
            </script>
             <footer class="content-footer footer bg-footer-theme">
              <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                <div class="mb-2 mb-md-0">
                  ©
                  <script>
                    document.write(new Date().getFullYear());
                  </script>
                  , IT Jasa Marga Tollroad Operator
                  <a href="https://themeselection.com" target="_blank" class="footer-link fw-bolder">ThemeSelection</a>
                </div>
                
              </div>
            </footer>
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

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
    <script type="text/javascript" src="https://unpkg.com/qr-code-styling@1.5.0/lib/qr-code-styling.js"></script>

    <script type="text/javascript">

        //API LOCATION ADDRESS DEVICE + LATITUDE DEVICE + LONGITUDE DEVICE
          const Http = new XMLHttpRequest();

          function check_display_operasional(){
            if(document.getElementById('operasional').checked == true && document.getElementById('non-operasional').checked == false){
              //Karyawan Operasional, menampilkan radio button shift
              document.getElementById('display_wfo_wfh').style = "display:none";
              document.getElementById('display_shift').style = "display:show";
              document.getElementById('display_wfo_wfh').required = false;
              document.getElementById('display_shift').required = true;

            }else if(document.getElementById('operasional').checked == false && document.getElementById('non-operasional').checked == true){
              //Karyawan Non Operasional, menampilkan radio button wfo/wfh
              document.getElementById('display_wfo_wfh').style = "display:show";
              document.getElementById('display_shift').style = "display:none";
              document.getElementById('display_wfo_wfh').required = true;
              document.getElementById('display_shift').required = false;
            }
          }
          
          function check_in_check(){
            if(document.getElementById('operasional').checked == true && document.getElementById('non-operasional').checked == false){
              //Karyawan operasional, munculin modal scanner
              if(document.getElementById('jadwal_shift').value !== ""){
                  $('#modal-check-in').modal('show'); 
                }else{
                  alert('Mohon isi jadwal shift anda!')
                }
            }else if(document.getElementById('operasional').checked == false && document.getElementById('non-operasional').checked == true){
              if(document.getElementById('wfo').checked == true && document.getElementById('wfh').checked == false ){
                //Karyawan non operasional wfo, munculin modal scanner
                
                  $('#modal-check-in').modal('show'); 
                
              }
              else if(document.getElementById('wfo').checked == false && document.getElementById('wfh').checked == true ){
                //Karyawan non operasional wfH, langsung submit form
                console.log('form-check-in-submit');
                document.getElementById('form-check-in').submit();
              }
            
            }else{
              alert('Mohon isi status karyawan operasional/non');
            }
          }
        function getApiLocationAddress(currentPosition) {
          //URL API
          var bdcApi = "https://api.bigdatacloud.net/data/reverse-geocode-client";
           
            navigator.geolocation.getCurrentPosition(
            (position) => {
                bdcApi = bdcApi
                    + "?latitude=" + position.coords.latitude
                    + "&longitude=" + position.coords.longitude
                    + "&localityLanguage=id";
                    getApi(bdcApi);
                    
            },
            (err) => { getApi(bdcApi); },
            {
                enableHighAccuracy: true,
                timeout: 5000,
                maximumAge: 0
            });

          //PROCESS GET API
            function getApi(bdcApi) {
              Http.open("GET", bdcApi);
              Http.send();
              Http.onreadystatechange = function () {
                  if (this.readyState == 4 && this.status == 200) {
                      console.log(this.responseText);
              //PARSE TO JSON AND CHANGE POSITION ARRAY
                      const resultParse = JSON.parse(this.responseText);
                      var arrayAddress = [];
                      for (var i = resultParse.localityInfo.administrative.length-1, l = 0; i >= l; i--) {
                          var obj = resultParse.localityInfo.administrative[i];
                          arrayAddress.push(obj.name);
                      }

              //change position kelurahan and RW
                      function arraymove(arr, fromIndex, toIndex) {
                          var element = arr[fromIndex];
                          arr.splice(fromIndex, 1);
                          arr.splice(toIndex, 0, element);
                          return arr;
                      }
                      var arrayAddressFinal = arraymove(arrayAddress, 0, 1);

              //return to view
              document.getElementById('lokasi_perangkat').innerHTML = arrayAddressFinal.join(", ");
                  }
              };
            }
          }
        
          $(document).ready(function(){
            // we call the function
            var today = new Date();
            var dd = String(today.getDate()).padStart(2, '0');
            var mm = String(today.getMonth() + 1); //January is 0!
            var yyyy = today.getFullYear();
            const monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni",
              "Juli", "Agustus", "September", "Oktober", "November", "Desember"
            ];
            today = dd + ' ' + monthNames[mm] + ' ' + yyyy;
            document.getElementById('tanggal-check-in').value = today;

            getApiLocationAddress();

            document.getElementById('display_wfo_wfh').style = "display:none";
            document.getElementById('display_shift').style = "display:none";
            
            
          });

        
        //FUNCTION CALCULATE DISTANCE DEVICE AND QR (SELISIH)
        function calculateDistance(currentPosition, strDecodedText){
          let lat1 = currentPosition.coords.latitude;
          let long1 = currentPosition.coords.longitude;
          var radius = 6371; // Radius of the earth in km
          var dLat = deg2rad(strDecodedText[0]-lat1);  // deg2rad below
          var dLong = deg2rad(strDecodedText[1]-long1); 

          var a = Math.sin(dLat/2) * Math.sin(dLat/2) + Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(strDecodedText[0])) * Math.sin(dLong/2) * Math.sin(dLong/2); 
          var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a)); 
          var resultFinal = radius * c; // Distance in km
          if(resultFinal <= 2){
            document.getElementById('form-check-in').submit();
          }else{
            alert('Lokasi anda terlalu jauh dari kantor');
          }
        }
        function deg2rad(deg) {
          return deg * (Math.PI/180)
        }

        //scanner function (UTAMA)
        function onScanSuccess(decodedText, decodedResult) {
            console.log(`Code scanned = ${decodedText}`, decodedResult);
          
          navigator.geolocation.getCurrentPosition(function(position) {
            var currentPosition = position;
            //CALL API LOCATION ADDRESS DEVICE + LATITUDE DEVICE + LONGITUDE DEVICE
            getApiLocationAddress(currentPosition);

            //SPLIT RESULT READ QR
            let strDecodedText = decodedText;
            strDecodedText = strDecodedText.split(";");
            document.getElementById('nama_kantor').value = strDecodedText[2];
            //CALCULATE DISTANCE DEVICE WITH QR (SELISIH)
            calculateDistance(currentPosition, strDecodedText);

            html5QrcodeScanner.clear();
          });

        }

        var html5QrcodeScanner = new Html5QrcodeScanner("qr-reader", { fps: 10, qrbox: 250});
        html5QrcodeScanner.render(onScanSuccess);
       
            var qrcode = new QRCodeStyling({
                width: 300,
                height: 300,
                type: "svg",
                data: "wdedwdeeeefreefr",
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

        function qrcodeGenerate (){
            
            var nama_lokasi = document.getElementById('nama_lokasi').value;
            var longitude = document.getElementById('longitude').value;
            var latitude = document.getElementById('latitude').value;
            document.getElementById('nama_lokasi').readOnly=true;
            document.getElementById('longitude').readOnly=true;
            document.getElementById('latitude').readOnly=true;
            qrcode.update({data : latitude+';'+longitude+';'+nama_lokasi});
            qrcode.append(document.getElementById("qrcode"));
            document.getElementById('hasil-qr-code').style = "display:show";
            document.getElementById('button-reset-print').style = "display:show";
            document.getElementById('button-generate').style = "display:none";
            
        }
        function resetForm(){
            document.getElementById('nama_lokasi').readOnly=false;
            document.getElementById('longitude').readOnly=false;
            document.getElementById('latitude').readOnly=false;
            document.getElementById('hasil-qr-code').style = "display:none";
            document.getElementById('button-reset-print').style = "display:none";
            document.getElementById('button-generate').style = "display:show";
        }
        function printForm(id){
          var idnext = id+1;
          document.getElementById('form-qrcode-generator').submit();
          window.open("print-qrcode.php?id="+idnext, '_blank');
          
        }
        function printFile(id){
          window.open("print-qrcode.php?id="+id, '_blank');
        }
    </script>
  </body>
</html>
