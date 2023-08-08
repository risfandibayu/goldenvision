  <!--== Start Atribute Navigation ==-->
  <div class="attr-nav hidden-xs sm-display-none">
      <ul class="social-media-dark social-top">
          <li><a href="{{ url('login') }}">Login</a></li>
      </ul>
  </div>
  <!--== End Atribute Navigation ==-->

  <!--== Start Header Navigation ==-->
  <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu"> <i
              class="tr-icon ion-android-menu"></i> </button>
      <div class="logo"> <a href="index.html"> <img class="logo logo-display"
                  src="{{ asset('') }}assets/images/logo-new.png" alt=""> <img class="logo logo-scrolled"
                  src="{{ asset('') }}assets/images/logo-new.png" alt=""> </a> </div>
  </div>
  <!--== End Header Navigation ==-->
  <div class="collapse navbar-collapse" id="navbar-menu">
      <ul class="nav navbar-nav navbar-center" data-in="fadeIn" data-out="fadeOut">
          <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Home</a>
          </li>
          <li class="dropdown"><a href="#benefit" class="dropdown-toggle" data-toggle="dropdown">Benefit</a>
          </li>
          <li class="dropdown"><a href="#about" class="dropdown-toggle" data-toggle="dropdown">Tentang</a>
          </li>
          {{-- <li class="dropdown"><a href="#faq" class="dropdown-toggle" data-toggle="dropdown">FAQ</a> --}}
          </li>
      </ul>
  </div>
