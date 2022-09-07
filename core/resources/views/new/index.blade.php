<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>MicroGold | Indonesia Emas 2045</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{asset('assets/new')}}/img/fav.png" rel="icon">
  <link href="{{asset('assets/new')}}/img/fav.png" rel="apple-touch-icon">
  <link rel="apple-touch-icon" sizes="57x57" href="{{asset('assets/new')}}/img/apple-icon-57x57.png">
  <link rel="apple-touch-icon" sizes="60x60" href="{{asset('assets/new')}}/img/apple-icon-60x60.png">
  <link rel="apple-touch-icon" sizes="72x72" href="{{asset('assets/new')}}/img/apple-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="76x76" href="{{asset('assets/new')}}/img/apple-icon-76x76.png">
  <link rel="apple-touch-icon" sizes="114x114" href="{{asset('assets/new')}}/img/apple-icon-114x114.png">
  <link rel="apple-touch-icon" sizes="120x120" href="{{asset('assets/new')}}/img/apple-icon-120x120.png">
  <link rel="apple-touch-icon" sizes="144x144" href="{{asset('assets/new')}}/img/apple-icon-144x144.png">
  <link rel="apple-touch-icon" sizes="152x152" href="{{asset('assets/new')}}/img/apple-icon-152x152.png">
  <link rel="apple-touch-icon" sizes="180x180" href="{{asset('assets/new')}}/img/apple-icon-180x180.png">
  <link rel="icon" type="image/png" sizes="192x192"  href="{{asset('assets/new')}}/img/android-icon-192x192.png">
  <link rel="icon" type="image/png" sizes="32x32" href="{{asset('assets/new')}}/img/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="96x96" href="{{asset('assets/new')}}/img/favicon-96x96.png">
  <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/new')}}/img/favicon-16x16.png">
  <link rel="manifest" href="{{asset('assets/new')}}/img/manifest.json">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="{{asset('assets/new')}}/img/ms-icon-144x144.png">
  <meta name="theme-color" content="#ffffff">

  @include('partials.seo')
  <!-- Google Fonts -->
  {{--
  <link
    href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
    rel="stylesheet"> --}}

  {{--
  <link href="http://db.onlinewebfonts.com/c/060e116a70e3096c52db16f61aaab194?family=Sofia+Pro+Regular" rel="stylesheet"
    type="text/css" /> --}}

  <style>
    @font-face {
      font-family: "Sofia Pro Regular";
      src: url("{{asset('assets/new')}}/font/@font-face/060e116a70e3096c52db16f61aaab194.eot");
      /* IE9*/
      src: url("{{asset('assets/new')}}/font/@font-face/060e116a70e3096c52db16f61aaab194.eot?#iefix") format("embedded-opentype"),
      /* IE6-IE8 */
      url("{{asset('assets/new')}}/font/@font-face/060e116a70e3096c52db16f61aaab194.woff2") format("woff2"),
      /* chrome、firefox */
      url("{{asset('assets/new')}}/font/@font-face/060e116a70e3096c52db16f61aaab194.woff") format("woff"),
      /* chrome、firefox */
      url("{{asset('assets/new')}}/font/@font-face/060e116a70e3096c52db16f61aaab194.ttf") format("truetype"),
      /* chrome、firefox、opera、Safari, Android, iOS 4.2+*/
      url("{{asset('assets/new')}}/font/@font-face/060e116a70e3096c52db16f61aaab194.svg#Sofia Pro Regular") format("svg");
      /* iOS 4.1- */
    }
  </style>
  <!-- Vendor CSS Files -->
  <link href="{{asset('assets/new')}}/vendor/aos/aos.css" rel="stylesheet">
  <link href="{{asset('assets/new')}}/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="{{asset('assets/new')}}/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="{{asset('assets/new')}}/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="{{asset('assets/new')}}/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="{{asset('assets/new')}}/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="{{asset('assets/new')}}/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"
    integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="{{asset('assets/new')}}/css/style.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css">

  <!-- =======================================================
  * Template Name: Bootslander - v4.7.2
  * Template URL: https://bootstrapmade.com/bootslander-free-bootstrap-landing-page-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
  <style>
    @media screen and (max-width: 900px) {
      #tagline {
        padding-top: 50px
      }
    }

    .owl-prev {
      width: 15px;
      height: 100px;
      position: absolute;
      top: 40%;
      margin-left: -20px;
      display: block !important;
      border: 0px solid black;
    }

    .owl-next {
      width: 15px;
      height: 100px;
      position: absolute;
      top: 40%;
      right: -25px;
      display: block !important;
      border: 0px solid black;
    }

    .owl-prev i,
    .owl-next i {
      transform: scale(1, 6);
      color: #ccc;
    }
  </style>
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center header-transparent">
    <div class="container d-flex align-items-center justify-content-between">

      <div class="logo">
        {{-- <h1><a href="index.html"><span>microgold</span></a></h1> --}}
        <!-- Uncomment below if you prefer to use an image logo -->
        <a href="index.html"><img src="{{asset('assets/new')}}/img/logo.png" alt="" class="img-fluid"></a>
      </div>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="#hero">Beranda</a></li>
          <li><a class="nav-link scrollto" href="#produk">Produk</a></li>
          <li><a class="nav-link scrollto" href="#about">Tentang</a></li>
          <li><a class="nav-link scrollto" href="#faq">FAQ</a></li>
          {{-- <li><a class="nav-link scrollto" href="#team">Team</a></li>
          <li><a class="nav-link scrollto" href="#pricing">Pricing</a></li>
          <li class="dropdown"><a href="#"><span>Drop Down</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="#">Drop Down 1</a></li>
              <li class="dropdown"><a href="#"><span>Deep Drop Down</span> <i class="bi bi-chevron-right"></i></a>
                <ul>
                  <li><a href="#">Deep Drop Down 1</a></li>
                  <li><a href="#">Deep Drop Down 2</a></li>
                  <li><a href="#">Deep Drop Down 3</a></li>
                  <li><a href="#">Deep Drop Down 4</a></li>
                  <li><a href="#">Deep Drop Down 5</a></li>
                </ul>
              </li>
              <li><a href="#">Drop Down 2</a></li>
              <li><a href="#">Drop Down 3</a></li>
              <li><a href="#">Drop Down 4</a></li>
            </ul>
          </li> --}}
          @if (!Auth::check())
          <li><a class="nav-link scrollto" href="{{route('user.login')}}">Login | Register</a></li>
          @else

          <li><a class="nav-link scrollto" href="{{url('/user/dashboard')}}">Dashboard</a></li>
          @endif
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->


  <!-- ======= Hero Section ======= -->
  <section id="hero">

    <div class="container">
      <div class="row justify-content-between">
        <div class="col-lg-8 pt-5 pt-lg-0 order-2 order-lg-1 d-flex align-items-center">
          <div data-aos="zoom-out">
            <h1 style="color: black">INDONESIA EMAS <span style="color: black">2045</span></h1>
            {{-- <h1>Semua orang bisa punya <span>Emas</span></h1> --}}
            <h2 style="color: black">Semua orang bisa punya emas <br>
              SIMPAN EMAS | JUAL EMAS | NETWORK EMAS | BISNIS EMAS</h2>
            {{-- <h2>Microgold menyediakan emas bersertifikat dengan ukuran 0.01 gram, 0,02 gram, 0,05 gram dan 0,1
              gram.</h2> --}}
            <div class="text-center text-lg-start row col-12 col-md-6">
              <div class="col-6 col-md-6">
                <a href="{{url('/login')}}" class="btn-get-started w-100 text-center scrollto">Login</a>
              </div>
              <div class="col-6 col-md-6">
                <a href="{{url('/register')}}" class="btn-get-started w-100 text-center scrollto">Register</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 order-1 order-lg-2 hero-img" data-aos="zoom-out" data-aos-delay="300">
          <img src="{{asset('assets/new')}}/img/hero-img4.png" class="img-fluid animated" alt="">
          {{-- <img src="{{asset('assets/new')}}/img/brosure-01.jpg" class="img-fluid animated" alt=""> --}}
          {{-- <img src="{{asset('assets/new')}}/img/brosure-01-cutout.png" class="img-fluid animated" alt=""> --}}
        </div>
      </div>
      <div data-aos="zoom-out" class="row">
        <div class="col-md-6 col-12">
          <p style="color: black;" id="tagline">Simpan dan tabung emas Anda, ketika sudah terakumulasi sejumlah 5 gram, Anda bisa tukarkan dengan emas Logam mulia bersertifikat ANTAM.</p>
          <p style="color: black;" id="tagline">Microgold adalah produk dari PT SAKA BHUMI AURUM.</p>
          <br>
          <button onclick="window.open(`{{asset('assets/new')}}/PPT_Microgold.pdf`)" class="btn-get-started"> Download Marketing Plan </button>
        </div>
      </div>
    </div>

    <svg class="hero-waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
      viewBox="0 24 150 28 " preserveAspectRatio="none">
      <defs>
        <path id="wave-path" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z">
      </defs>
      <g class="wave1">
        <use xlink:href="#wave-path" x="50" y="3" fill="rgba(255,255,255, .1)">
      </g>
      <g class="wave2">
        <use xlink:href="#wave-path" x="50" y="0" fill="rgba(255,255,255, .2)">
      </g>
      <g class="wave3">
        <use xlink:href="#wave-path" x="50" y="9" fill="#fff">
      </g>
    </svg>

  </section><!-- End Hero -->

  <section id="produk" class="team">
    <div class="container">

      <div class="section-title" data-aos="fade-up">
        <h2>Produk</h2>
        <p>Produk Kami</p>
        <h5>Microgold menyediakan emas bersertifikat dengan ukuran 0.01 gram, 0,02 gram, 0,05 gram dan 0,1 gram.</h5>
      </div>
      <div class="row">
        <div class="owl-carousel">
          @foreach ($prod as $item)
              
          
          <div class="item" style="padding: 20px;">
            <div class="member" data-aos="zoom-in" data-aos-delay="400">
              <div class="pic"><img src="{{ getImage('assets/images/product/'. $item->image,  null, true)}}" class="img-fluid" alt="Image {{$item->name}}"></div>
              <div class="member-info">
                <h4>{{$item->name}}</h4>
                <p>{{$item->weight}} gram</p>
                <p>Rp. {{nb($item->price)}}</p>

              </div>
            </div>
          </div>
          @endforeach
        </div>


      </div>

    </div>
  </section><!-- End Team Section -->

  <section id="about" class="about" style="background: #f5f5f5;">
    <div class="container pt-3">

      <div class="">


        <div class="row icon-boxes align-items-stretch justify-content-center pb-5" data-aos="fade-left">
          <h3>Pentingnya Investasi Emas Untuk Masa Depan</h3>
          <p>Emas merupakan logam mulai dengan karakteristik yang stabil, tidak berubah zat, tidak beroksidasi di udara normal, dan mengandung unsur murni. Emas biasanya digunakan sebagai koleksi atau investasi.</p>

          <div class="col-xl-6">
            <div class="icon-box" data-aos="zoom-in" data-aos-delay="100">
              <div class="icon"><i class="bx bx-lock"></i></div>
              <h4 class="title"><a href="">Aman</a></h4>
              <p class="description">Emas dinilai sangat aman untuk dijadikan sebagai instrumen investasi. Jika kita memiliki uang dan hanya disimpan ditabungan, maka uang tersebut bisa perlahan menghilang. Hal tersebut dikarenakan adanya biaya administrasi, pajak, suku bunga, dan biaya lain-lain.</p>
            </div>
  
            <div class="icon-box" data-aos="zoom-in" data-aos-delay="200">
              <div class="icon"><i class="bx bx-shield"></i></div>
              <h4 class="title"><a href="">Terlindungi</a></h4>
              <p class="description">Inflasi dan deflasi merupakan masalah klasik yang sudah ada sejak dahulu kala. Dua kondisi ini bisa membuat nilai aset menurun. Maka dari itu, salah satu cara untuk mencegah hal tersebut yaitu dengan berinvestasi pada instrumen investasi, salah satunya emas.</p>
            </div>
  
            <div class="icon-box" data-aos="zoom-in" data-aos-delay="300">
              <div class="icon"><i class='bx bx-donate-blood'></i></div>
              <h4 class="title"><a href="">Mudah Dicairkan</a></h4>
              <p class="description">Likuiditas yang tinggi menjadi salah satu alasan banyak orang berminat investasi emas. Instrumen investasi lainnya bisanya memerlukan waktu lebih dari satu hari saat hendak dicairkan.</p>
            </div>
          </div>
          <div class="col-xl-6">
            <div class="icon-box" data-aos="zoom-in" data-aos-delay="100">
            <div class="icon"><i class='bx bx-line-chart' ></i></div>
            <h4 class="title"><a href="">Menguntungkan</a></h4>
            <p class="description">Harga emas yang stabil bahkan cenderung meningkat, membuat banyak orang lebih memilih investasi emas dibandingkan instrumen investasi lain. Emas juga diketahui sangat cocok untuk disimpan dalam jangka menengah atau panjang.</p>
          </div>

          <div class="icon-box" data-aos="zoom-in" data-aos-delay="200">
            <div class="icon"><i class='bx bx-street-view'></i></div>
            <h4 class="title"><a href="">Resiko Rendah</a></h4>
            <p class="description">Alasan investasi emas lainnya yaitu karena risikonya rendah. Emas diketahui tidak memiliki nilai penyusutan. Nilai emas untuk jangka pendek memang berfluktuasi, namun untuk jangka panjang nilainya cenderung meningkat.</p>
          </div>

          <div class="icon-box" data-aos="zoom-in" data-aos-delay="300">
            <div class="icon"><i class='bx bx-bar-chart-alt-2' ></i></div>
            <h4 class="title"><a href="">Harga Stabil</a></h4>
            <p class="description">Manfaat emas dalam bidang investasi lainnya yaitu memiliki harga yang stabil. Emas memiliki risiko lebih rendah, keamanan ketat, dan keuntungan yang lebih besar dibandingkan instrumen investasi lainnya. Harganya yang stabil membuat emas menjadi instrumen investasi yang menguntungkan.</p>
          </div>
        </div>
         
          

        </div>
      </div>

    </div>
  </section><!-- End About Section -->
  <section id="faq" class="faq section-bg" style="background: #ffffff;">
    <div class="container">

      <div class="section-title" data-aos="fade-up">
        <h2>F.A.Q</h2>
        <p>Frequently Asked Questions</p>
      </div>

      <div class="faq-list">
        <ul>
          <li data-aos="fade-up" style="background: #f5f5f5;"> 
            <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" class="collapse" data-bs-target="#faq-list-1">Apa Itu Microgold ?<i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
            <div id="faq-list-1" class="collapse show" data-bs-parent=".faq-list">
              <p>
                Microgold adalah produsen dan penjual produk emas dengan ukuran micro : 0,01 gram, 0,02 gram, 0,05 gram, 0,1 gram. Fine gold 999 bersertifikat.

Pembeli produk microgold  bisa menyimpan emas ukuran micro yang nanti bisa di tukar dengan emas antam 5 gram yang akan dimasukkan ke rekening dinaran.
              </p>
            </div>
          </li>

          <li data-aos="fade-up" data-aos-delay="100" style="background: #f5f5f5;">
            <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-2" class="collapsed">Apa itu Mitra Microgold ? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
            <div id="faq-list-2" class="collapse" data-bs-parent=".faq-list">
              <p>
                Mitra microgold adalah reseller yang akan memperoleh harga khusus jika membeli produk
              </p>
            </div>
          </li>

          <li data-aos="fade-up" data-aos-delay="200" style="background: #f5f5f5;">
            <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-3" class="collapsed">Bagaimana Cara Jika Saya Ingin Bergabung ? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
            <div id="faq-list-3" class="collapse" data-bs-parent=".faq-list">
              <p>
                Klik menu “Registrasi” dan masukan data sesuai kolom yang tersedia dan buat password akun Anda.
                Microgold akan mengirimkan OTP melalui E-mail yang telah didaftarkan.
<br>
<br>
                <strong>Selamat kamu telah berhasil bergabung bersama Microgold.</strong>
<br>
<br>
                Silahkan Login menggunakan  email dan password yang telah Anda daftarkan.

              </p>
            </div>
          </li>

          <li data-aos="fade-up" data-aos-delay="300" style="background: #f5f5f5;">
            <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-4" class="collapsed">Mengapa Saya Harus Melakukan Verifikasi Akun Saya ? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
            <div id="faq-list-4" class="collapse" data-bs-parent=".faq-list">
              <p>
                Seluruh pemilik akun Microgold harus melewati proses E-KYC guna perlindungan konsumen dan sebagai upaya komitmen Microgold dalam penerapan program APUPPT, sehingga Microgold memberlakukan kebijakan hanya Pengguna yang telah ter-verifikasi yang dapat melakukan deposit untuk pembelian paket Microgold.

                Bagian ini tidak berlaku bagi yang sudah menjadi member dinaran.
              </p>
            </div>
          </li>

          <li data-aos="fade-up" data-aos-delay="400" style="background: #f5f5f5;">
            <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-5" class="collapsed">Bagaimana Caranya Melakukan Verifikasi Akun Dinaran Saya ? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
            <div id="faq-list-5" class="collapse" data-bs-parent=".faq-list">
              <p>
                Setelah kamu berhasil melakukan registrasi maka kamu dapat mengajukan permohonan verifikasi akun kamu.
                <br><br>
                <strong>
                  Berikut langkah-langkah Permohonan Verifikasi Akun :
                </strong>
              </p>
              <p>
                •	Login akun kamu
                <br>
                •	Klik tombol verifikasi pada kotak berwarna biru bertuliskan “Verify Now” di halaman akun Microgold Anda. <br>
                • Isi seluruh data sesuai kolom yang tersedia serta upload foto dokumen pendukung dengan benar lalu Klik “Save Change”.  <br>
                •	Proses verifikasi Selesai. <br>
                •	Admin akan membantu proses verifikasi akun kamu. <br>
                •	Tunggu hingga status dalam kotak berubah menjadi “Verified”. <br>
                •	Kamu akan menerima notifikasi melalui email untuk status permohonan verifikasi kamu. <br>
                •	Pihak Microgold berhak melakukan penolakan apabila terdapat ketidaksesuaian data dengan memberitahukan alasan penolakannya. <br>
                •	Kamu dapat mengajukan permohonan ulang kembali setelah melakukan perbaikan data hingga akun kamu berhasil di verifikasi oleh pihak Microgold. <br>
                •	Kamu baru bisa melakukan deposit dan pembelian setelah status akun kamu terverifikasi. <br>

              </p>
            </div>
          </li>

          <li data-aos="fade-up" data-aos-delay="500" style="background: #f5f5f5;">
            <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-6" class="collapsed">Berapa Minimum Deposit Awal Di Microgold? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
            <div id="faq-list-6" class="collapse" data-bs-parent=".faq-list">
              <p>
                Untuk Deposit awal kamu bisa mulai dari Rp. 2.890.000 untuk harga 1 paket Microgold. Untuk deposit berikutnya tidak ada nilai minimum deposit.
                <br><br>
                <strong>
                  Berikut langkah-langkah pengisian deposit :
                </strong>
              </p>
              <p>
                •	Login Akun kamu dan pastikan akun kamu sudah dilakukan verifikasi.<br>
                •	Klik Deposit Now pada halaman dashboard Microgold Anda.<br>
                •	Masukan jumlah deposit yang diinginkan lalu klik Submit.<br>
                •	Anda akan melihat Payment Preview Anda, jika sudah sesuai Klik Confirm Deposit.<br>
                •	Anda akan melihat Deposit Confirm Anda.<br>
                •	Lakukan pembayaran sesuai nominal yang tertera.<br>
                •	Lakukan pembayaran hanya ke rekening PT.SHAKA BUMI AURUM.<br>
                •	Upload bukti transfer pada halaman deposit confirm.<br>
                •	Lakukan pembayaran sesuai nominal yang tertera sesuai batas waktu yang telah ditentukan.<br>
                •	Klik kolom Pay Now jika sudah sesuai.<br>
                •	Mohon ditunggu, Deposit kamu akan di cek dan di approve oleh tim Microgold.<br>
                •	Saldo deposit kamu akan masuk jika sudah di approve oleh tim Microgold. <br>
                •	Cek Saldo deposit pada akun Microgold kamu jika. <br>
                <br><br>
                Jika terdapat kesalahan maupun kendala silahkan hubungi Customer Care Microgold.

              </p>
            </div>
          </li>

          <li data-aos="fade-up" data-aos-delay="600" style="background: #f5f5f5;">
            <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-7" class="collapsed">Bagaimana Caranya Melakukan Transaksi Pembelian Paket Mitra Microgold ? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
            <div id="faq-list-7" class="collapse" data-bs-parent=".faq-list">
              <p>
                Setelah kamu berhasil melakukan verifikasi akun kamu dan melakukan deposit, maka kamu sudah dapat membeli 1 atau lebih paket Microgold.
                <br><br>
                <strong>Berikut langkah-langkah Pasang dan Atur Pohon :</strong>

              </p>
              <p>
              •	Login Akun kamu dan pastikan akun kamu sudah dilakukan verifikasi. <br>
              •	Klik Plan pada halaman dashboard Microgold Anda. <br>
              •	Klik Subscribe. <br>
              •	Masukan jumlah BRO yang Anda beli. <br>
              •	Masukan BRO dari Upline Anda. <br>
              •	Pilih posisi Anda Kanan/kiri.<br>
              •	Klik Subsribe. <br> 
              •	Selamat Anda sudah bisa langsung pasang dan atur pohon Anda. <br>
              •	Klik menu Manage User jika Anda membeli lebih dari 1 BRO. <br>

              </p>
            </div>
          </li>

          <li data-aos="fade-up" data-aos-delay="700" style="background: #f5f5f5;">
            <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-8" class="collapsed">Alur Pembayaran Komisi  <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
            <div id="faq-list-8" class="collapse" data-bs-parent=".faq-list">
              <p>
                •	Mitra wajib punya akun Dinaran. <br>
                •	Komisi dibayarkan melalui akun Dinaran milik mitra. <br>
                •	Perhitungan komisi dilakukan setiap hari selasa s/d selasa minggu berikkutnya pukul 24.00. <br>
                •	Komisi dibayarkan setiap hari Rabu jam 12.00 siang ke rekening Dinaran. <br>

              </p>
            </div>
          </li>

          <li data-aos="fade-up" data-aos-delay="800" style="background: #f5f5f5;">
            <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-9" class="collapsed">Cara Merefer Dengan No Upline Dan Nomor Bro Kanan Kirinya <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
            <div id="faq-list-9" class="collapse" data-bs-parent=".faq-list">
              <p>
                •	Upline cukup memberikan nomor BRO miliknya kecalon downline. <br>
                •	Calon downline otomatis akan langsung berada di bawahnya
              </p>
            </div>
          </li>

          <li data-aos="fade-up" data-aos-delay="900" style="background: #f5f5f5;">
            <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-10" class="collapsed">Cara Membeli Emas Retail Dan Memesan Customized <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
            <div id="faq-list-10" class="collapse" data-bs-parent=".faq-list">
              <p>
                Pembelian emas retil baru bisa di 1 oktober melalui website.
              </p>
            </div>
          </li>

          <li data-aos="fade-up" data-aos-delay="1000" style="background: #f5f5f5;">
            <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-11" class="collapsed">Cara Menukar Emas Sertifikat Dengan Emas Antam 5 Gram <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
            <div id="faq-list-11" class="collapse" data-bs-parent=".faq-list">
              <p>
                Tukar emas microgold anda minimal 5gr
              </p>
            </div>
          </li>


        </ul>
      </div>

    </div>
  </section><!-- End F.A.Q Section -->
  <!-- ======= Footer ======= -->
  <footer id="footer" style="background-color: #212A51">

    <div class="container">
      <div class="copyright" style="    border-top: white;">
        Copyright &copy; 2022 <strong><span>MicroGold</span></strong>. All Rights Reserved
      </div>
      {{-- <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/bootslander-free-bootstrap-landing-page-template/ -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div> --}}
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="{{asset('assets/new')}}/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="{{asset('assets/new')}}/vendor/aos/aos.js"></script>
  <script src="{{asset('assets/new')}}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="{{asset('assets/new')}}/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="{{asset('assets/new')}}/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="{{asset('assets/new')}}/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="{{asset('assets/new')}}/js/main.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/owl.carousel.js"></script>
  <script>
    $(document).ready(function() {
 
 $(".owl-carousel").owlCarousel({

     autoPlay: 3000,
     items : 3,
     itemsDesktop : [1199,3],
     itemsDesktopSmall : [979,3],
     center: true,
     nav:true,
     navText : ['<i class="fa fa-angle-left" aria-hidden="true"></i>','<i class="fa fa-angle-right" aria-hidden="true"></i>'],
     loop:true,
     responsive: {
        0:{
            items:2,
            nav:true
        },
        600:{
            items:3,
            nav:true
        },
        1000:{
            items:5,
            nav:true,
        }
     }
    
    
     
     
     

 });

});
  </script>
      @include('partials.plugins')
</body>

</html>