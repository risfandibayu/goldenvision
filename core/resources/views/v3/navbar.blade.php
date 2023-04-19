  <header class="header_1" id="header">
      <div class="container">
          <div class="row align-items-center">
              <div class="col-lg-3 col-md-3">
                  <div class="logo">
                      <a href="{{ url('/') }}"><img src="{{ asset('assets/counter/images/logo-new.png') }}"
                              alt="" style="max-width: 300px"></a>
                  </div>
              </div>
              <div class="col-lg-7 col-md-7">
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
                          <li><a href="{{ url('/build') }}">Login</a></li>
                      </ul>
                  </nav>
              </div>
              <div class="col-lg-2 col-md-2 hidden-xs">
                  <nav class="mainmenu MenuInRight text-right">


                      <ul>
                          <li><a href="{{ url('build') }}">Login</a></li>
                      </ul>
                  </nav>
              </div>
          </div>
      </div>
  </header>
