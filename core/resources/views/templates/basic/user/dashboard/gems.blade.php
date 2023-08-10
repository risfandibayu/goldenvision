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
        <div class="card b-radius--10 3 d-flex justify-content-center mb-3" style=" width: 300px; height: 200px;">
            <div class="card-body cardGems">
                <div class="text-view-info shadow-text">
                    <h4 class="bold-text text-light">Ayamku.</h4>
                    <h1 class="display-5 text-light bold-text">350.000 GEMS</h1>
                </div>
            </div>
            {{-- <div class="card-footer">
            <button class="btn btn-warning btn-block" data-toggle="modal" data-target="#tarikEmas">
                <i class="menu-icon las la-wallet"></i> Tarik
                Emas</button>
        </div> --}}
        </div>
    </div>
@endif
