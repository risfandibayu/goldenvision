@if (auth()->user()->status)
    <!-- Modal -->
    <div class="modal" id="staticBackdrop" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Limited Dream With Masterplan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="d-flex justify-content-center">
                                <img src="{{ asset('assets/rew.png') }}" style="width: 300px" alt="">
                            </div>

                            <div class="container">

                                <div class="text-center">
                                    <br>
                                    <h3 class="">Promo September Ceria</h3>
                                    <br>
                                    <h4 class="">Challenge 1</h4>
                                    <h6 class="">
                                        23 Kiri - 23 Kanan mendapatkan reward Hp Ekslusif dalam 30 hari pencapaian.
                                    </h6>
                                    <br>
                                    <h4 class="">Challenge 2</h4>
                                    <h6 class="">
                                        75 Kiri - 75 Kanan mendapatkan reward Trip Bangkok dalam 60 hari pencapaian.
                                    </h6>
                                    <br>
                                    <h4 class="">Challenge 3</h4>
                                    <h6 class="">
                                        350 Kiri - 350 Kanan mendapatkan reward Mobil dalam 90 hari pencapaian.
                                    </h6>
                                    <br>
                                    <h6 class=""><span class="text-danger">**</span> Berlaku untuk semua
                                        Member Lama maupun
                                        Member Baru
                                        Masterplan.

                                        Perhitungan poin akan dilakukan poin baru dalam Reward Challenge tersebut.

                                        Jika dalam periode Challenge tidak tercapai, maka poin tidak di reset dan
                                        dapat dilanjutkan untuk challenge berikutnya.</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="modal" id="staticBackdrop" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content row">
                <form action="{{ route('user.serialnum') }}" method="POST">
                    @csrf
                    <div class="modal-header ">
                        <h5 class="modal-title ">Limited Dream With Masterplan</h5>
                        <button type="button" class="close " data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">
                                <h3 class="">&times;</h3>
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

                                    <div class="text-center">
                                        <br>
                                        <h3 class="">Promo September Ceria</h3>
                                        <br>
                                        <h4 class="">Challenge 1</h4>
                                        <h6 class="">
                                            23 Kiri - 23 Kanan mendapatkan reward Hp Ekslusif dalam 30 hari pencapaian.
                                        </h6>
                                        <br>
                                        <h4 class="">Challenge 2</h4>
                                        <h6 class="">
                                            75 Kiri - 75 Kanan mendapatkan reward Trip Bangkok dalam 60 hari pencapaian.
                                        </h6>
                                        <br>
                                        <h4 class="">Challenge 3</h4>
                                        <h6 class="">
                                            350 Kiri - 350 Kanan mendapatkan reward Mobil dalam 90 hari pencapaian.
                                        </h6>
                                        <br>
                                        <h6 class=""><span class="text-danger">**</span> Berlaku untuk semua
                                            Member Lama maupun
                                            Member Baru
                                            Masterplan.

                                            Perhitungan poin akan dilakukan poin baru dalam Reward Challenge tersebut.

                                            Jika dalam periode Challenge tidak tercapai, maka poin tidak di reset dan
                                            dapat dilanjutkan untuk challenge berikutnya.</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div> --}}
@endif
