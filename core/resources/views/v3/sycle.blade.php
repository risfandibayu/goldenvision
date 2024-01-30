<section class="commonSection" id="bonus">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="sec_title">Bonus Sycle Nasional</h2>
                <p class="sec_desc">Bonus Cycle Nasional (Rp 625.000) Dibayar Setiap Tanggal 1 (Berulang)</p>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-3 col-md-6">
                <div class="singleTeam text-center">
                    <img src="{{ getImage('assets/images/user/profile/' . $atas->user->image, null, true) }}"
                        alt="{{ $atas->user->username }} Profile"
                        style="border: 5px solid#0b60b048; background-color: #0b60b048; border-radius: 15px">
                    <h4>{{ $atas->user->username }}</h4>
                    <p>{{ $atas->user->no_bro }}</p>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-md-3">
                <div class="">
                    <div class="singleTeam text-center">
                        <img src="{{ getImage('assets/images/user/profile/' . $c1->user->image, null, true) }}"
                            alt="{{ $c1->user->username }} Profile"
                            style="border: 5px solid#0b60b048; background-color: #0b60b048; border-radius: 15px">
                        <h4>{{ $c1->user->username }}</h4>
                        <p>{{ $c1->user->no_bro }}</p>
                    </div>
                </div>
                <div class="row">
                    <ul class="list-group col-md-12">
                        @for ($i = 1; $i <= 4; $i++)
                            <li class="list-group-item {{ $c1[$i] != null ? 'active' : '' }}" aria-current="true">
                                {{ $c1[$i] != null ? $c1[$i]->username : '#' . $i . ' Investor' }} <br>
                                {{ $c1[$i] != null ? $c1[$i]->no_bro : 'Slot Kosong' }}
                            </li>
                        @endfor
                    </ul>
                </div>
            </div>
            <div class="col-md-3">
                <div class="">
                    <div class="singleTeam text-center">
                        <img src="{{ getImage('assets/images/user/profile/' . $c2->user->image, null, true) }}"
                            alt="{{ $c2->user->username }} Profile"
                            style="border: 5px solid#0b60b048; background-color: #0b60b048; border-radius: 15px">
                        <h4>{{ $c2->user->username }}</h4>
                        <p>{{ $c2->user->no_bro }}</p>
                    </div>
                </div>
                <div class="row">
                    <ul class="list-group col-md-12">
                        @for ($i = 1; $i <= 4; $i++)
                            <li class="list-group-item {{ $c2[$i] != null ? 'active' : '' }}" aria-current="true">
                                {{ $c2[$i] != null ? $c2[$i]->username : '#' . $i . ' Investor' }} <br>
                                {{ $c2[$i] != null ? $c2[$i]->no_bro : 'Slot Kosong' }}
                            </li>
                        @endfor
                    </ul>
                </div>
            </div>
            <div class="col-md-3">
                <div class="">
                    <div class="singleTeam text-center">
                        <img src="{{ getImage('assets/images/user/profile/' . $c3->user->image, null, true) }}"
                            alt="{{ $c3->user->username }} Profile"
                            style="border: 5px solid#0b60b048; background-color: #0b60b048; border-radius: 15px">
                        <h4>{{ $c3->user->username }}</h4>
                        <p>{{ $c3->user->no_bro }}</p>
                    </div>
                </div>
                <div class="row">
                    <ul class="list-group col-md-12">
                        @for ($i = 1; $i <= 4; $i++)
                            <li class="list-group-item {{ $c3[$i] != null ? 'active' : '' }}" aria-current="true">
                                {{ $c3[$i] != null ? $c3[$i]->username : '#' . $i . ' Investor' }} <br>
                                {{ $c3[$i] != null ? $c3[$i]->no_bro : 'Slot Kosong' }}
                            </li>
                        @endfor
                    </ul>
                </div>
            </div>
            <div class="col-md-3">
                <div class="">
                    <div class="singleTeam text-center">
                        <img src="{{ getImage('assets/images/user/profile/' . $c4->user->image, null, true) }}"
                            alt="{{ $c4->user->username }} Profile"
                            style="border: 5px solid#0b60b048; background-color: #0b60b048; border-radius: 15px">
                        <h4>{{ $c4->user->username }}</h4>
                        <p>{{ $c4->user->no_bro }}</p>
                    </div>
                </div>
                <div class="row">
                    <ul class="list-group col-md-12">
                        @for ($i = 1; $i <= 4; $i++)
                            <li class="list-group-item {{ $c4[$i] != null ? 'active' : '' }}" aria-current="true">
                                {{ $c4[$i] != null ? $c4[$i]->username : '#' . $i . ' Investor' }} <br>
                                {{ $c4[$i] != null ? $c4[$i]->no_bro : 'Slot Kosong' }}
                            </li>
                        @endfor
                    </ul>
                </div>
            </div>


            {{-- @for ($i = 1; $i <= 4; $i++)
                @php
                    $image = $downline[$i] != null ? $downline[$i]->image : 'image.jpg';
                @endphp
                <div class="col-lg-3 col-md-6">
                    <div class="singleTeam text-center">
                        <img src="{{ getImage('assets/images/user/profile/' . $image, null, true) }}" alt=""
                            style="border-radius: 15px;float: left; width:  100px;height: 100px;object-fit: cover; 
                                {{ $downline[$i] == null ? 'border: 5px solid #9595965b; background-color: #9595965b' : 'border: 5px solid #0b60b048; background-color: #0b60b048' }}
                                ">
                        <h4>{{ $downline[$i] != null ? $downline[$i]->username : '#' . $i . ' Investor' }}</h4>
                        <p>{{ $downline[$i] != null ? $downline[$i]->no_bro : 'Slot Kosong' }}</p>
                    </div>
                </div>
            @endfor --}}
        </div>
    </div>
</section>
