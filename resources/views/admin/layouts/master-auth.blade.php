<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Auth | Permata</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ asset('assets/template/admin') }}/img/favicon.png" rel="icon">
  <link href="{{ asset('assets/template/admin') }}/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('assets/template/admin') }}/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="{{ asset('assets/template/admin') }}/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="{{ asset('assets/template/admin') }}/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="{{ asset('assets/template/admin') }}/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="{{ asset('assets/template/admin') }}/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="{{ asset('assets/template/admin') }}/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="{{ asset('assets/template/admin') }}/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ asset('assets/template/admin') }}/css/style.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Sep 18 2023 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->

  <style>
    .overlay {
      position: fixed;
      display: none;
      width: 100%;
      height: 100%;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: rgba(0, 0, 0, 0.5);
      z-index: 2;
      cursor: pointer;
    }

    .overlay .overlay-content {
      position: absolute;
      top: 50%;
      left: 50%;
      font-size: 50px;
      color: white;
      transform: translate(-50%, -50%);
      -ms-transform: translate(-50%, -50%);
    }

    .overlay .overlay-content .overlay-loader {
      width: 48px;
      height: 48px;
      display: block;
      margin: 15px auto;
      position: relative;
      color: #FFF;
      box-sizing: border-box;
      animation: rotation 1s linear infinite;
    }

    .overlay .overlay-content .overlay-loader::after,
    .overlay .overlay-content .overlay-loader::before {
      content: '';
      box-sizing: border-box;
      position: absolute;
      width: 24px;
      height: 24px;
      top: 50%;
      left: 50%;
      transform: scale(0.5) translate(0, 0);
      background-color: #FFF;
      border-radius: 50%;
      animation: animloader 1s infinite ease-in-out;
    }

    .overlay .overlay-content .overlay-loader::before {
      background-color: #4154f1;
      transform: scale(0.5) translate(-48px, -48px);
    }

    @keyframes rotation {
      0% {
        transform: rotate(0deg);
      }

      100% {
        transform: rotate(360deg);
      }
    }

    @keyframes animloader {
      50% {
        transform: scale(1) translate(-50%, -50%);
      }
    }
  </style>
</head>

<body>
    <div class="overlay" id="overlay">
        <div class="overlay-content">
          <div class="overlay-loader"></div>
        </div>
    </div>

    @yield('content')

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{ asset('assets/template/admin') }}/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="{{ asset('assets/template/admin') }}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="{{ asset('assets/template/admin') }}/vendor/chart.js/chart.umd.js"></script>
  <script src="{{ asset('assets/template/admin') }}/vendor/echarts/echarts.min.js"></script>
  <script src="{{ asset('assets/template/admin') }}/vendor/quill/quill.min.js"></script>
  <script src="{{ asset('assets/template/admin') }}/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="{{ asset('assets/template/admin') }}/vendor/tinymce/tinymce.min.js"></script>
  <script src="{{ asset('assets/template/admin') }}/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('assets/template/admin') }}/js/main.js"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

  @include('universal_foot.toastr-foot')
  @include('universal_foot.index')

  @stack('scripts')
</body>

</html>