@if ($promo->count() >= 1 || $reward->count() >= 1)
    <div class="card card-header-actions">
        <div class="container text-center my-3">
            <div class="row mx-auto my-auto">
                <div id="recipeCarousel1" class="carousel slide w-100" data-ride="carousel">
                    <div class="carousel-inner w-100" role="listbox">
                        @foreach ($promo as $i => $item)
                            <div class="carousel-item @if ($item->id == 5) active @endif">
                                <div class="col-md-12">
                                    <div class="bonus">
                                        <div class="card-body bg--gradi-8 h5 ">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <img class="card-img-top"
                                                        src="{{ getImage('assets/images/reward/' . $item->images, null, true) }}"
                                                        alt="Bonus reward {{ $item->reward }}"
                                                        style="height: 200px;width: 400px">
                                                </div>
                                                <div class="col-md-8">
                                                    <b class="text-center"> Bonus Sepesial
                                                        {{ $item->id == 4 ? ' Bulan Ini' : ' Sampai Bulan Juli' }}</b>
                                                    <br><br>
                                                    <h4 class="text-justify text-light">
                                                        Untuk mitra usaha yang telah memenuhi
                                                        kualifikasi
                                                        penjualan
                                                        produk {{ $item['kiri'] }} kiri dan {{ $item['kanan'] }}
                                                        kanan,
                                                        akan
                                                        mendapatkan
                                                        kesempatan reward {{ $item['reward'] }}
                                                        {{ $item['equal'] != 0 ? 'atau uang unai senilai Rp ' . nb($item['equal']) : '' }}
                                                        segera tingkatkan
                                                        penjualan anda dan raih kesuksesan bersama!!
                                                    </h4>
                                                    <br>
                                                    <b class="mt-5 text-center"> Total penjualan kamu saat ini
                                                        {{ $p_kiri - 3 <= 0 ? 0 : $p_kiri - 3 }} :
                                                        {{ $p_kanan - 3 <= 0 ? 0 : $p_kanan - 3 }}</b>
                                                </div>
                                            </div>
                                        </div>
                                        @if (auth()->user()->userExtra->is_gold)
                                            @if (cekReward($item->id) == true)
                                                <div class="card-footer">
                                                    <div class="input-group">
                                                        <button class="btn btn-primary btn-block" disabled>Already
                                                            Claim
                                                            Bonus</button>

                                                    </div>
                                                </div>
                                            @else
                                                <div class="card-footer">
                                                    <form action="{{ route('user.claim-reward') }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="type"
                                                            value="{{ $item['id'] }}">
                                                        <div class="input-group">
                                                            @if ($item['equal'] == 0)
                                                                <button class="btn btn-primary btn-block">Claim
                                                                    Bonus</button>
                                                            @else
                                                                <input type="submit"
                                                                    class="form-control bg-primary form-control-lg"
                                                                    name="claim" value="{{ $item['reward'] }}">
                                                                <input type="submit"
                                                                    class="form-control bg-primary form-control-lg"
                                                                    aria-label="Large" name="claim"
                                                                    value="{{ $item['equal'] }}">
                                                            @endif

                                                        </div>
                                                    </form>
                                                </div>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        {{-- @dd(auth()->user()->userExtra->p_right) --}}
                        @foreach ($reward as $i => $item)
                            @if (auth()->user()->userExtra->left >= $item->kiri && auth()->user()->userExtra->right >= $item->kanan)
                                <div class="carousel-item ">
                                    <div class="col-md-12">
                                        <div class="bonus">
                                            <div class="card-body bg--gradi-10 h5 ">

                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <img class="card-img-top"
                                                            src="{{ getImage('assets/images/reward/' . $item->images, null, true) }}"
                                                            alt="Bonus reward {{ $item->reward }}"
                                                            style="height: 200px;width: 400px">
                                                    </div>
                                                    <div class="col-md-8 text-center">
                                                        <b> Bonus Sepesial
                                                            {{ $item->reward }}</b>
                                                        <br><br>
                                                        <h4 class="text-justify text-light">
                                                            Untuk mitra usaha yang telah memenuhi
                                                            kualifikasi
                                                            penjualan
                                                            produk {{ $item['kiri'] }} kiri dan
                                                            {{ $item['kanan'] }}
                                                            kanan,
                                                            akan
                                                            mendapatkan
                                                            kesempatan reward {{ $item['reward'] }}
                                                            {{ $item['equal'] != 0 ? 'atau uang unai senilai Rp ' . nb($item['equal']) : '' }}
                                                            segera tingkatkan
                                                            penjualan anda dan raih kesuksesan bersama!!
                                                        </h4>
                                                        <br>
                                                        <b class="mt-5 text-center"> Total penjualan kamu saat ini
                                                            {{ $p_kiri }} :
                                                            {{ $p_kanan }}</b>
                                                    </div>
                                                </div>

                                            </div>
                                            @if (auth()->user()->userExtra->is_gold)
                                                @if (cekReward($item->id) == true)
                                                    <button class="btn btn-primary btn-block" disabled>Alredy Claim
                                                        Reward</button>
                                                @else
                                                    <div class="card-footer">
                                                        <form action="{{ route('user.claim-reward') }}" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="type"
                                                                value="{{ $item['id'] }}">
                                                            <div class="input-group">
                                                                @if ($item['equal'] == 0)
                                                                    <button class="btn btn-primary btn-block">Claim
                                                                        Reward</button>
                                                                @else
                                                                    <input type="submit"
                                                                        class="form-control bg-primary form-control-lg"
                                                                        name="claim" value="{{ $item['reward'] }}">
                                                                    <input type="submit"
                                                                        class="form-control bg-primary form-control-lg"
                                                                        aria-label="Large" name="claim"
                                                                        value="{{ $item['equal'] }}">
                                                                @endif

                                                            </div>
                                                        </form>
                                                    </div>
                                                @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <a class="carousel-control-prev w-auto" href="#recipeCarousel1" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon bg-dark border border-dark rounded-circle"
                            aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next w-auto" href="#recipeCarousel1" role="button" data-slide="next">
                        <span class="carousel-control-next-icon bg-dark border border-dark rounded-circle"
                            aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>

    </div>
@endif



<div class="container text-center my-3">
    <h5 class="font-weight-light font-weight-bold">User Claim Reward</h5>
    <div class="row mx-auto my-auto">
        <div id="recipeCarousel" class="carousel slide w-100" data-ride="carousel">
            <div class="carousel-inner w-100" role="listbox">
                @foreach ($ure as $item => $value)
                    <div class="carousel-item @if ($item == 0) active @endif">
                        <div class="col-md-4">
                            <div class="card card-body d-flex justify-content-center" style="min-height: 20rem;">
                                <div style="width:100%; text-align:center">
                                    {{-- <img src="https://mirror-api-playground.appspot.com/links/filoli-spring-fling.jpg"
                                                    style="width:50%; height:50%;"> --}}
                                    <img class="img-fluid imgUser"
                                        src="{{ getImage('assets/images/user/profile/' . $value->user->image, null, true) }}">
                                </div>

                                <h5 class="card-title mt-2 mb-n1">
                                    {{-- @if ($value->user->firstname)
                                                    {{ ucwords($value->user->firstname . ' ' . $value->user->lastname) }}
                                                @else
                                                   
                                                @endif --}}
                                    {{ $value->user->no_bro }}
                                </h5>
                                {{-- <span class="text-sencondary">{{ $value->user->username }}</span> --}}
                                <p class="card-text">{{ $value->reward->reward }} </p>
                                <p class="card-text">{!! $value->details()['is_gold']
                                    ? '<span class="badge rounded-pill badge-warning">Gold</span>'
                                    : '<span class="badge rounded-pill badge-secondary">Silver</span>' !!}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <a class="carousel-control-prev w-auto" href="#recipeCarousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon bg-dark border border-dark rounded-circle"
                    aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next w-auto" href="#recipeCarousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon bg-dark border border-dark rounded-circle"
                    aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
</div>
