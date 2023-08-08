@if (auth()->user()->gold_no == null)
    <!-- Modal -->

    <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content row" style="background-color: #606060">
                <form action="{{ route('user.serialnum') }}" method="POST">
                    @csrf
                    <div class="modal-header text-white">
                        <h5 class="modal-title text-white">Limited Dream With Masterplan</h5>
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">
                                <h3 class="text-white">&times;</h3>
                            </span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="d-flex justify-content-center">
                                    <img src="{{ asset('assets/rew.png') }}" style="width: 300px" alt="">
                                </div>

                                <div class="container">
                                    <h5 class="text-light">
                                        <br><br>
                                        Exclusive Promo Reward periode 1 Juli 2023 sampai dengan 30 September 2023.
                                        <br>
                                        Akumulasi pembelanjaan produk 350 kiri : 350 kanan (private/group)
                                        <br>
                                        <strong>(Komitment Ayla + Bangkok + HP senilai 1.5jt)</strong>
                                        <span class="text-warning">*Komitmen Ayla terbatas hanya untuk 10 unit</span>
                                        <br><br>
                                        Note : <br>
                                        Berlaku untuk member lama melanjutkan poin promo ke program promo baru.
                                        <br>
                                        Dan selamat bagi member yang sudah menerima reward program promo periode bulan
                                        April
                                        - Juni 2023
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endif
