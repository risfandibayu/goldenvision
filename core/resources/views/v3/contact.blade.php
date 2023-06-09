   <footer class="footer" id="contact">
       <div class="container">
           <div class="row">
               <div class="col-lg-4 col-md-6">
                   <aside class="widget about_widgets">
                       {{-- <p>+62 818-809-808</p> --}}
                       <p>official@masterplan.co.id</p>
                       <span>Ruko Mulyosari Tengah <br> Blok 95 J No.5 Jl. Mulyosari tengah, Kalisari, Kec. Mulyorejo
                           <br>
                           Kota
                           Surabaya, Jawa Timur <br>
                           60112</span>
                   </aside>
               </div>
               <div class="col-lg-8 col-md-12">
                   <aside class="widget subscribe_widgets">
                       <h3>Dapatkan Informasi Terbaru Dari Kami</h3>
                       {{-- <form action="#" method="post"> --}}
                       <input type="email" placeholder="Email address" name="email" />
                       <input type="text" placeholder="Phone no." name="phone" />
                       <input type="submit" id="btnSub" value="Subscribe now">
                       {{-- </form> --}}
                   </aside>
               </div>
           </div>
       </div>
   </footer>

   @push('script')
       <script>
           $('#btnSub').on('click', function(e) {
               console.log('test');
               window.location.reload()
           });
       </script>
   @endpush
