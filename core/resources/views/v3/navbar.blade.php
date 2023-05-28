  <header class="header_1" id="header">
      <div class="container">
          <div class="row align-items-center">
              <div class="col-lg-3 col-md-3">
                  <div class="logo">
                      <a href="{{ url('/') }}"><img src="{{ asset('assets/images/favicon-new.png') }}" alt=""
                              style="max-width: 300px;-webkit-filter: drop-shadow(5px 5px 5px #222);
  filter: drop-shadow(5px 5px 5px #222);"></a>
                  </div>
              </div>
              <div class="col-lg-9 col-md-9">
                  <nav class="mainmenu MenuInRight text-right">
                      <a href="javascript:void(0);" class="mobilemenu d-md-none d-lg-none d-xl-none">
                          <span></span>
                          <span></span>
                          <span></span>
                      </a>
                      <ul>
                          <li><a href="#home">Home</a></li>
                          <li><a href="#product">Product</a></li>
                          <li><a href="#contact">Contact</a></li>
                          {{-- <hr>
                          <li><a href="#">Login</a></li> --}}
                          <li><a href="{{ url('/login') }}" class="text-primary btn btn-light btn-block">Sign
                                  In</a></li>
                      </ul>
                  </nav>
              </div>
              {{-- <div class="col-lg-2 col-md-2">
                  <nav class="mainmenu MenuInRight text-right">
                      <ul>
                          <li><a href="{{ url('build') }}">Login</a></li>
                      </ul>
                  </nav>
              </div> --}}
          </div>
      </div>
  </header>
