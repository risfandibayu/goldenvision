 <div class="row mb-4">
     <div class="col-lg-12">
         @if ($checkDaily_days < 100 && auth()->user()->userExtra->d_gold != 1)
             @if (\App\Models\User::canClaimDailyGold(Auth::id()))
                 <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                     aria-hidden="true">
                     <div class="modal-dialog">
                         <div class="modal-content">
                             <div class="modal-header">
                                 <h5 class="modal-title" id="exampleModalLabel">Check-In To Get Bonus Gold</h5>
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                     <span aria-hidden="true">&times;</span>
                                 </button>
                             </div>
                             <div class="modal-body">
                                 <form action="{{ route('user.daily-checkin') }}" method="post">
                                     @csrf
                                     <p class="text-center h5">Click the button below to get your daily gold.</p>
                                     <div class="row mt-4">
                                         <div class="col-12 text-sm-center">
                                             <button type="submit" class="btn btn-warning btn-block">Check-In <i
                                                     class="me-2 fas fa-arrow-right"></i></button>
                                         </div>
                                     </div>
                                 </form>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="alert alert-warning alert-dismissible fade show p-3" role="alert">
                     <strong>Hey {{ Auth::user()->fullname }}!</strong> &nbsp; Check-In and get your 0.005 Gram gold
                     right
                     now.
                     &nbsp; <a href="#" class="alert-link" data-toggle="modal" data-target="#exampleModal">CHECK
                         IN</a>
                     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
             @endif
         @else
             @if ($checkDaily_days >= 100)
                 {{-- @dd(chekWeeklyClaim()) --}}
                 @if (chekWeeklyClaim(auth()->user()->id))
                     <div class="alert alert-success alert-dismissible fade show p-3 text-center" role="alert"
                         data-toggle="modal" data-target="#modalWeek">
                         <strong>Hey {{ Auth::user()->fullname }}! &emsp;</strong> <br>
                         <div>
                             Kamu Sudah Check-In Emas Selama 100 Hari Nih Sekarang Kamu Bisa Claim Weekly Gold. <strong>
                                 Claim
                                 Gold
                                 Mingguan Kamu Disini</strong>
                             &nbsp;
                             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                 <span aria-hidden="true">&times;</span>
                             </button>
                         </div>
                     </div>
                 @endif
                 <div class="modal fade" id="modalWeek" tabindex="-1" aria-labelledby="exampleModalLabel"
                     aria-hidden="true">
                     <div class="modal-dialog">
                         <div class="modal-content">
                             <div class="modal-header">
                                 <h5 class="modal-title" id="exampleModalLabel">Check-In To Get Bonus Gold</h5>
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                     <span aria-hidden="true">&times;</span>
                                 </button>
                             </div>
                             <div class="modal-body">
                                 <form action="{{ route('user.weekly-checkin') }}" method="post">
                                     @csrf
                                     <p class="text-center h5">Click the button below to get your Weekly Gold.</p>
                                     <div class="row mt-4">
                                         <div class="col-12 text-sm-center">
                                             <button type="submit" class="btn btn-warning btn-block">Check-In <i
                                                     class="me-2 fas fa-arrow-right"></i></button>
                                         </div>
                                     </div>
                                 </form>
                             </div>
                         </div>
                     </div>
                 </div>
             @endif

             @if (!auth()->user()->wd_gold && auth()->user()->userExtra->is_gold)
                 <div class="modal fade" id="modalWd" tabindex="-1" aria-labelledby="exampleModalLabel"
                     aria-hidden="true">
                     <div class="modal-dialog">
                         <div class="modal-content">
                             <div class="modal-header">
                                 <h5 class="modal-title" id="exampleModalLabel">Withdraw Bonus Gold</h5>
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                     <span aria-hidden="true">&times;</span>
                                 </button>
                             </div>
                             <div class="modal-body">
                                 <form method="POST" action="{{ route('user.withdraw.gold') }}">
                                     @csrf
                                     <div class="container col-md-8">
                                         <h6>Total Emas: {{ $checkDaily->gold ?? '' }}</h6>
                                         <h6>Harga Emas /Gram: Rp {{ $goldBonus }}</h6>
                                         <h6>Platform Fee: 5%</h6>

                                         <h6>-----------------------------------------------</h6>
                                         <h6>Harga Total: Rp {{ nb($goldBonus * $checkDaily_gold) }}</h6>
                                         <h6>Platform Fee: Rp {{ nb(($goldBonus * $checkDaily_gold * 5) / 100) }}</h6>
                                         <strong>Total:
                                             {{ nb($goldBonus * $checkDaily_gold - ($goldBonus * $checkDaily_gold * 5) / 100) }}</strong>

                                     </div>
                                     <div class="row mt-4">
                                         <div class="col-12 text-sm-center">
                                             <input type="hidden" name="total"
                                                 value="{{ $goldBonus * $checkDaily_gold - ($goldBonus * $checkDaily_gold * 5) / 100 }}">
                                             <button type="submit" class="btn btn-warning btn-block">Transfer to
                                                 Balance
                                                 Rp
                                                 {{ nb($goldBonus * $checkDaily_gold - ($goldBonus * $checkDaily_gold * 5) / 100) }}
                                                 <i class="me-2 fas fa-arrow-right"></i></button>
                                         </div>
                                     </div>
                                 </form>

                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="alert alert-success alert-dismissible fade show p-3 text-center" role="alert"
                     data-toggle="modal" data-target="#modalWd">
                     <strong>Hey {{ Auth::user()->fullname }}! &emsp;</strong> <br>
                     <div>Kamu Sudah Check-In Emas Selama
                         {{ $checkDaily_days ?? '' }} Hari Nih Sebanyak {{ nbk($checkDaily_gold) ?? '' }} Gram,
                         Sekarang emas itu bisa di withdraw loh. <br> >>Click Disini<< <button type="button"
                             class="close" data-dismiss="alert" aria-label="Close">
                             <span aria-hidden="true">&times;</span>
                             </button>
                     </div>
                 </div>
             @endif

             @if (!auth()->user()->address_check)
                 <a href="{{ url('user/profile-setting') }}">
                     <div class="alert alert-warning alert-dismissible fade show p-3 h6" role="alert">
                         Perhatian,
                         terdapat perubahan kebijakan perusahaan terkait data alamat
                         pelanggan. <br>
                         Segera perbaharui alamat pada akun anda demi menghindari kesalahan
                         pengiriman dan pendataan. <br>
                         Terima kasih~.
                         <br>
                         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                             <span aria-hidden="true">&times;</span>
                         </button>
                     </div>
                 </a>
             @endif

             {{-- @if (\App\Models\User::canClaimWeeklyGold(Auth::id()))
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Check-In To Get Bonus Gold</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('user.weekly-checkin') }}" method="post">
                                    @csrf
                                    <p class="text-center h5">Click the button below to get your weekly gold.</p>
                                    <div class="row mt-4">
                                        <div class="col-12 text-sm-center">
                                            <button type="submit" class="btn btn-warning btn-block">Check-In <i
                                                    class="me-2 fas fa-arrow-right"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="alert alert-warning alert-dismissible fade show p-3" role="alert">
                    <strong>Hey {{ Auth::user()->fullname }}!</strong> &nbsp; Check-In and get your 0.005gr gold right now.
                    &nbsp; <a href="#" class="alert-link" data-toggle="modal" data-target="#exampleModal">CHECK
                        IN</a>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif --}}
         @endif
     </div>
 </div>
