<style>
    .cardGems {
        background-image: url("{{ asset('assets/bg-ayam.jpg') }}");
        background-repeat: no-repeat;
        background-size: 100% 100%;

    }

    .cardGems {
        /* Set width and height for the card */
        width: 300px;
        /* Adjust the value as needed */
        height: 200px;
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
@if (checkGems())
    <div class="mb-3 d-flex justify-content-center shing">
        <div class="card b-radius--10 3 d-flex justify-content-center mb-3">
            <div class="card-body cardGems">
                <div class="text-view-info shadow-text">
                    <h4 class="bold-text text-light">Ayamku.</h4>
                    <h1 class="display-5 text-light bold-text"> {{ auth()->user()->xgems ? '0' : '350.000' }}GEMS</h1>
                </div>
            </div>
            <div class="card-footer">
                @if (auth()->user()->xgems)
                    <form action="{{ env('AYAMKU_URL') . 'register-post-masterplan' }}" method="post" target="_blank">
                        <input type="hidden" name="username" id="" value="{{ auth()->user()->username }}">
                        <input type="hidden" name="username" id="" value="{{ auth()->user()->username }}">
                        <button class="btn btn-warning btn-block" type="submit">
                            <i class="menu-icon las la-sign-in-alt"></i> Login Ayamku</button>
                    </form>
                @elseif(!auth()->user()->xgems && checkxgems())
                    <form action="{{ route('user.register.ayamku') }}" method="post">
                        @csrf
                        <button class="btn btn-warning btn-block" type="submit">
                            <i class="menu-icon las la-sign-in-alt"></i> Buat Akun & Convert Gems</button>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endif
