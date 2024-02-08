<div class="row mb-none-30">
    {{-- <div class="col-xl-3 col-lg-4 col-sm-6 mb-30 text-center text-center">
        <div class="dashboard-w1  h-100 w-100 bg--gradi-51 b-radius--10 box-shadow">
            <div class="icon">
                <i class="las la-gem"></i>
            </div>
            <div class="details">
                <div class="numbers">
                    <span class="amount">{{ nbk(userGold()['total']) }}</span>
                    <span class="currency-sign">Gram</span>
                </div>
                <div class="desciption">
                    <span class="text--small font-weight-bold">Equal To <span
                            class="badge badge-danger">{{ nb(userGold()['equal']) }}
                            IDR</span>
                    </span>
                </div>
                <div class="desciption">
                    <span class="text--small ">{{ nbk(userGold()['daily']) }} gr
                        Daily</span>
                    |
                    <span class="text--small ">{{ nbk(userGold()['weekly']) }} gr
                        Weekly</span>
                </div>
            </div>
            <br>
            <a href="{{ route('user.report.gold') }}"
                class="btn btn-sm btn-block text--small bg--white text--black box--shadow3 mt-3">@lang('View All')</a>
        </div>
    </div> --}}
    <div class="col-xl-6 col-lg-6 col-sm-12 mb-30 text-center">

        <div class="dashboard-w1 h-100 w-100 bg--15 b-radius--10 box-shadow">

            <div class="icon">
                <i class="la la-github"></i>
                {{-- <h1>M1</h1> --}}
            </div>
            <div class="details justify-content-end">
                <div class="numbers">
                    {{-- <div class="btn btn-danger" style="width: 10px">
                        M1
                    </div> --}}
                    <span class="amount">Selamat Datang, {{ auth()->user()->username }}</span>
                </div>
                <div class="desciption">
                    <span class="text--small">Account Status: <i class="fas fa-check"></i> Active</span>
                </div>
            </div>
            <br>
            <div class="input-group">
                <input type="text" aria-label="Last name"
                    class="form-control {{ auth()->user()->no_bro != null ? 'is-valid' : 'is-invalid' }}" value="BINARY"
                    readonly>
                <input type="text" aria-label="First name"
                    class="form-control {{ auth()->user()->userExtra->is_gold ? 'is-valid' : 'is-invalid' }}"
                    value="POWER LINE" readonly>

            </div>
        </div>
    </div>

    <div class="col-xl-3 col-lg-4 col-sm-6 mb-30 text-center">
        <div class="dashboard-w1 h-100 w-100 bg--success b-radius--10 box-shadow">
            <div class="icon">
                <i class="las la-wallet"></i>
            </div>
            <div class="details">
                <div class="numbers">
                    <span class="amount">0</span>
                    {{-- <span class="amount">{{ nb(getAmount(auth()->user()->balance)) }}</span> --}}
                    <span class="currency-sign">{{ $general->cur_text }}</span>
                </div>
                <div class="desciption">
                    <span class="text--small">@lang('Current Balance')</span>
                </div>
            </div>
            <br>
            <a href="{{ route('user.report.transactions') }}"
                class="btn btn-sm btn-block text--small bg--white text--black box--shadow3 mt-3">@lang('View All')</a>
            {{-- <button class="btn btn-primary">Convert Saldo to PIN</button> --}}
        </div>
    </div>

    <div class="col-xl-3 col-lg-4 col-sm-6 mb-30 text-center">
        <div class="dashboard-w1 h-100 w-100 bg--gradi-13 b-radius--10 box-shadow">
            <div class="icon">
                <i class="la la-product-hunt"></i>

            </div>
            <div class="details">
                <div class="numbers">
                    <span class="amount">{{ auth()->user()->pin }}</span>
                    <span class="currency-sign">{{ 'PIN' }}</span>
                </div>
                <div class="desciption">
                    <span class="text--small">@lang('Active Pin')</span>
                </div>
            </div>
            <br>
            <a href="{{ route('user.pins.PinDeliveriyLog') }}"
                class="btn btn-sm text--small bg--white btn-block text--black box--shadow3 mt-3">@lang('View All')</a>
        </div>
    </div>

    {{-- <div class="col-xl-3 col-lg-4 col-sm-6 mb-30 text-center">
        <div class="dashboard-w1 bg--10 b-radius--10 box-shadow">
            <div class="icon">
                <i class="las la-cloud-download-alt"></i>
            </div>
            <div class="details">
                <div class="numbers">
                    <span class="amount">{{ nb(getAmount($totalWithdraw)) }}</span>
                    <span class="currency-sign">{{ $general->cur_text }}</span>
                </div>
                <div class="desciption">
                    <span class="text--small">@lang('Total Withdraw')</span>
                </div>
            </div>
            <br>
            <a href="{{ route('user.report.withdraw') }}"
                class="btn btn-sm text--small bg--white btn-block text--black box--shadow3 mt-3">@lang('View All')</a>
        </div>
    </div> --}}
    <div class="col-xl-3 col-lg-4 col-sm-6 mb-30 text-center">
        <div class="dashboard-w1 bg--teal b-radius--10 box-shadow">
            <div class="icon">
                <i class="las la-check"></i>
            </div>
            <div class="details">
                <div class="numbers">
                    <span class="amount">{{ $completeWithdraw }}</span>
                </div>
                <div class="desciption">
                    <span class="text--small">@lang('Complete Withdraw')</span>
                </div>
            </div>
            <br>
            <a href="{{ route('user.report.withdraw') }}?type=complete"
                class="btn btn-sm text--small bg--white btn-block text--black box--shadow3 mt-3">@lang('View All')</a>
        </div>
    </div>

    <div class="col-xl-3 col-lg-4 col-sm-6 mb-30 text-center">
        <div class="dashboard-w1 bg--warning b-radius--10 box-shadow">
            <div class="icon">
                <i class="las la-spinner"></i>
            </div>
            <div class="details">
                <div class="numbers">
                    <span class="amount">{{ $pendingWithdraw }}</span>
                </div>
                <div class="desciption">
                    <span class="text--small">@lang('Wating Withdraw')</span>
                </div>
            </div>
            <br>
            <a href="{{ route('user.report.withdraw') }}?type=complete"
                class="btn btn-sm text--small bg--white btn-block text--black box--shadow3 mt-3">@lang('View All')</a>
        </div>
    </div>

    {{-- <div class="col-xl-3 col-lg-4 col-sm-6 mb-30 text-center">
        <div class="dashboard-w1 bg--danger b-radius--10 box-shadow">
            <div class="icon">
                <i class="las la-ban"></i>
            </div>
            <div class="details">
                <div class="numbers">
                    <span class="amount">{{ $rejectWithdraw }}</span>
                </div>
                <div class="desciption">
                    <span class="text--small">@lang('Reject Withdraw')</span>
                </div>
            </div>
            <br>
            <a href="{{ route('user.report.withdraw') }}?type=reject"
                class="btn btn-sm text--small bg--white btn-block text--black box--shadow3 mt-3">@lang('View All')</a>
        </div>
    </div> --}}


    <div class="col-xl-3 col-lg-4 col-sm-6 mb-30 text-center">
        <div class="dashboard-w1 bg--info b-radius--10 box-shadow">
            <div class="icon">
                <i class="fa fa-tree"></i>
            </div>
            <div class="details">
                <div class="numbers">
                    <span class="amount">0</span>
                    {{-- <span class="amount">{{ nb(getAmount(auth()->user()->total_binary_com)) }}</span> --}}
                    <span class="currency-sign">{{ $general->cur_text }}</span>
                </div>
                <div class="desciption">
                    <span class="text--small">@lang('Total Binary Commission')</span>
                </div>
            </div>
            <br>
            <a href="{{ route('user.report.binaryCom') }}"
                class="btn btn-sm text--small bg--white btn-block text--black box--shadow3 mt-3">@lang('View All')</a>
        </div>
    </div>
    <div class="col-xl-3 col-lg-4 col-sm-6 mb-30 text-center">
        <div class="dashboard-w1 bg--12 b-radius--10 box-shadow">
            <div class="icon">
                <i class="las la-money-bill"></i>
            </div>
            <div class="details">
                <div class="numbers">
                    <span class="amount">0</span>
                    {{-- <span class="amount">{{ nb(getAmount(auth()->user()->total_ref_com)) }}</span> --}}
                    <span class="currency-sign">{{ $general->cur_text }}</span>
                </div>
                <div class="desciption">
                    <span class="text--small">@lang('Total Bonus Sponsor')</span>
                </div>
            </div>
            <br>
            <a href="{{ route('user.report.refCom') }}"
                class="btn btn-sm text--small bg--white btn-block text--black box--shadow3 mt-3">@lang('View All')</a>
        </div>
    </div>

    <div class="col-xl-3 col-lg-4 col-sm-6 mb-30 text-center">
        <div class="dashboard-w1 bg--success b-radius--10 box-shadow">
            <div class="icon">
                <i class="fa fa-tree"></i>
            </div>
            <div class="details">
                <div class="numbers">
                    <span class="amount">0</span>
                    {{-- class="amount">{{ nb(getAmount(auth()->user()->total_binary_com + auth()->user()->total_ref_com)) }}</span> --}}
                    <span class="currency-sign">{{ $general->cur_text }}</span>
                </div>
                <div class="desciption">
                    <span class="text--small">@lang('Total Bonus All')</span>
                </div>
            </div>
            <br>
            <a href="{{ route('user.report.binaryCom') }}"
                class="btn btn-sm text--small bg--white btn-block text--black box--shadow3 mt-3">@lang('View All')</a>
        </div>
    </div>
    <div class="col-xl-3 col-lg-4 col-sm-6 mb-30 text-center">
        <div class="dashboard-w1 bg--15 b-radius--10 box-shadow">
            <div class="icon">
                <i class="fa fa-arrow-circle-left"></i>
            </div>
            <div class="details">
                <div class="numbers">
                    <span class="amount">{{ auth()->user()->userExtra->left }} :
                        {{ auth()->user()->userExtra->right }}</span>
                </div>
                <div class="desciption">
                    <span class="text--small">@lang('Total Left : Total Right')</span>
                </div>
            </div>
            <br>
            <a href="{{ route('user.my.tree') }}"
                class="btn btn-sm text--small bg--white btn-block text--black box--shadow3 mt-3">@lang('View All')</a>
        </div>
    </div>

    <div class="col-xl-3 col-lg-4 col-sm-6 mb-30 text-center">
        <div class="dashboard-w1 bg--gradi-10 b-radius--10 box-shadow">
            <div class="icon">
                <i class="las la-users"></i>
            </div>
            <div class="details">
                <div class="numbers">
                    <span class="amount">{{ $total_ref }}</span>
                </div>
                <div class="desciption">
                    <span class="text--small">@lang('Direct Referral')</span>
                </div>
            </div>
            <br>
            <a href="{{ route('user.my.referral') }}"
                class="btn btn-sm text--small bg--white btn-block text--black box--shadow3 mt-3">@lang('View All')</a>
        </div>
    </div>
    <div class="col-xl-3 col-lg-4 col-sm-6 mb-30 text-center">
        <div class="dashboard-w1 bg--cyan b-radius--10 box-shadow">
            <div class="icon">
                <i class="las la-money-bill-wave"></i>
            </div>
            <div class="details">
                <div class="numbers">
                    <span class="amount">{{ nb(getAmount(auth()->user()->total_invest)) }}</span>
                    <span class="currency-sign">{{ $general->cur_text }}</span>
                </div>
                <div class="desciption">
                    <span class="text--small">@lang('Total Order')</span>
                </div>
            </div>
            <br>
            <a href="{{ route('user.report.invest') }}"
                class="btn btn-sm text--small bg--white btn-block text--black box--shadow3 mt-3">@lang('View All')</a>
        </div>
    </div>
</div>
