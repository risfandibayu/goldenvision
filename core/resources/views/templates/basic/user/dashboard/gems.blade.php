<style>
    .cardGems {
        background-image: url("{{ asset('assets/bg-ayam.jpg') }}");
        background-repeat: no-repeat;
        background-size: 100% 100%;

    }

    .cardGems {
        /* Set width and height for the card */
        /* width: 300px; */
        /* Adjust the value as needed */
        height: 220px;
        /* Adjust the value as needed */

        /* Add some styling to make it look like a card */
        border-radius: 10px;
        background-color: #f0f0f0;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .bold-text {
        font-weight: bold;
    }

    .text-view-info {
        margin-top: 5rem;
    }

    .shadow-text {
        /* Set the shadow color, horizontal offset, vertical offset, and blur radius */
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
    }
</style>
@if (checkGems() || auth()->user()->xgems)
    <div class="mb-3 d-flex justify-content-center shing">
        <div class="card b-radius--10 3 d-flex justify-content-center mb-3">
            <div class="card-body cardGems">
                <div class="text-view-info shadow-text">
                    <h4 class="bold-text text-light">Ayamku.</h4>
                    <h2 class=" text-light bold-text"> {{ auth()->user()->xgems ? '0' : nb(tarikGems()['gems']) }} GEMS
                    </h2>
                </div>
            </div>
            <div class="card-footer text-center">
                @if (auth()->user()->xgems)
                    <form action="{{ route('user.login.ayamku') }}" method="get" target="_blank">
                        <input type="hidden" name="username" id=""
                            value="{{ auth()->user()->username == 'masterplan01' ? 'bozgems' : auth()->user()->username }}">
                        <span>Klik tombol dibawah untuk login Game Ayamku</span>
                        <button class="btn btn-warning btn-block" type="submit">
                            <i class="menu-icon las la-sign-in-alt"></i> Login Ayamku</button>
                    </form>
                    <br>
                    {{-- @dd(demoUrl()); --}}
                    <input type="hidden" id="urlDemo" value="{{ demoUrl() }}">
                    <span>Klik tombol dibawah untuk Salin Link/URL dan Tempel kan link tersebut untuk menyebarkan
                        game</span>
                    <button class="btn btn-info btn-block btnCopy" type="button" onclick="copyCode()">
                        <i class="menu-icon las la-sign-in-alt"></i>Share Demo Account</button>
                @elseif(!auth()->user()->xgems && checkxgems())
                    <form action="{{ route('user.register.ayamku') }}" method="post">
                        @csrf
                        <button class="btn btn-info btn-block" type="submit">
                            <i class="menu-icon las la-sign-in-alt"></i> Buat Akun & Convert Gems</button>
                    </form>
                @endif
                <br>

                {{-- <form action="{{ route('user.login.ayamku') }}" method="get" target="_blank">
                    <input type="hidden" name="username" id=""
                        value="{{ auth()->user()->username . '_demo' }}">
                    <input type="hidden" name="url" id="">
                    <button class="btn btn-warning btn-block" type="submit">
                        <i class="menu-icon las la-sign-in-alt"></i>Share Demo Account</button>
                </form> --}}

            </div>

        </div>
    </div>
@endif

@push('script')
    <script>
        function copyCode() {
            var text = $('#urlDemo').val();
            copyToClipboard(text);
            alert('DEMO URL Copied.')
        }

        function copyToClipboard(text) {
            var tempInput = $("<input>");
            $("body").append(tempInput);
            tempInput.val(text).select();
            document.execCommand("copy");
            tempInput.remove();
        }
    </script>
@endpush
