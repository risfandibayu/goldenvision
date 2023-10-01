<div class="row mb-4">
    <div class="col-lg-12">
        @if (typeClaimGold(auth()->user()) == 'weekly' && !checkClaimDailyWeekly(auth()->user()))
            <div class="alert alert-success alert-dismissible fade show p-3" role="alert">
                <strong>Hey {{ Auth::user()->fullname }}!</strong> &nbsp; Kamu tidak dapat lagi malakukan claim daily
                gold karena sudah mencapai 100x claim atau sudah withdrawl daily gold
            </div>
        @endif
        @if (checkClaimDailyWeekly(auth()->user()))
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Check-In To Get Bonus Gold</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('user.new-daily-checkin') }}" method="post">
                                @csrf

                                @if (checkClaimDailyWeekly(auth()->user()) == 'weekly')
                                    <strong>Hey {{ Auth::user()->fullname }}! &emsp;</strong> <br>
                                    <div>
                                        Kamu Sudah Check-In Emas Selama 100 Hari Nih Sekarang Kamu Bisa Claim Weekly
                                        Gold.
                                        <strong>
                                            Claim
                                            Gold
                                            Mingguan Kamu Disini</strong>
                                        &nbsp;
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                                @if (checkClaimDailyWeekly(auth()->user()) == 'daily')
                                    <p class=" h6"> Hey {{ Auth::user()->fullname }}! <br> <br> Click the
                                        button below to get your
                                        {{ checkClaimDailyWeekly(auth()->user()) }} gold.</p>
                                @endif
                                <div class="row mt-4">
                                    <div class="col-12 text-sm-center">
                                        <button type="submit" class="btn btn-primary btn-block">Check-In <i
                                                class="me-2 fas fa-arrow-right"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="alert alert-warning alert-dismissible fade show p-3" role="alert">
                <strong>Hey {{ Auth::user()->fullname }}!</strong> &nbsp; Check-In and get your 0.005 Gram
                {{ typeClaimGold(auth()->user()) }} gold
                right
                now.
                &nbsp; <a href="#" class="alert-link" data-toggle="modal" data-target="#exampleModal">CHECK
                    IN</a>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if (checkWdGold(auth()->user()))
            <div class="alert alert-success alert-dismissible fade show p-3 text-center" role="alert"
                data-toggle="modal" data-target="#modalWdPin">
                <strong>Hey {{ Auth::user()->fullname }}! &emsp;</strong> <br>
                <div>Kamu Sudah Check-In Emas Selama {{ withdrawGold()['notif'] }} Nih Sebanyak
                    {{ nbk(withdrawGold()['user_gold']) ?? '' }} Gram,
                    Sekarang emas itu bisa di withdraw loh. <br> >>Click Disini<< <button type="button" class="close"
                        data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                </div>
            </div>
        @endif

    </div>
</div>
{{-- modal transfer 2 pin --}}
<div class="modal fade" id="modalWdPin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Withdraw Dalam Integrasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('user.withdraw.gold') }}">
                @csrf
                <div class="modal-body">
                    <div class="ceter-ico mb-3" class="text-center">
                        <center> <img src="{{ asset('assets/warn.gif') }}" alt="warning-ico"></center>
                    </div>
                    <div class="text-center">
                        Tarik Emas sedang dilakukan integrasi terhadap Payment Gateway, silahkan menunggu atau Konversi
                        menjadi Repeat Order Produk (2 PIN).
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning btn-block" data-dismiss="modal">Tunggu
                        Integrasi</button>


                    <input type="hidden" name="type" id="" value="pin">
                    <button type="submit" class="btn btn-primary btn-block">Konversi (2 PIN)</button>

                </div>
            </form>
        </div>
    </div>
</div>

{{-- modal wd daily gold --}}
<div class="modal fade" id="modalWd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <h6>Total Emas: {{ withdrawGold()['user_gold'] }}</h6>
                        <h6>Harga Emas /Gram: Rp {{ nb(withdrawGold()['gold_today']) }}</h6>
                        <h6>Platform Fee: 5%</h6>

                        <h6>-----------------------------------------------</h6>
                        <h6>Harga Total: Rp
                            {{ nb(withdrawGold()['harga_total']) }}</h6>
                        <h6>Platform Fee: Rp {{ nb(withdrawGold()['platform_fee']) }}</h6>
                        <strong>Total:
                            {{ nb(withdrawGold()['total_wd']) }}</strong>

                    </div>
                    <div class="row mt-4">
                        <div class="col-12 text-sm-center">
                            <input type="hidden" name="total" value="{{ withdrawGold()['total_wd'] }}">
                            <input type="hidden" name="type" value="{{ withdrawGold()['type'] }}"
                                id="">
                            <button type="submit" class="btn btn-primary btn-block">Transfer to
                                Balance
                                Rp
                                {{ nb(withdrawGold()['total_wd']) }}
                                <i class="me-2 fas fa-arrow-right"></i></button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
