 @if (auth()->user()->emas)
     <div class="card b-radius--10">
         <div class="card-gold-view cardImage">
             <div class="text-view text-center">
                 {{ goldNum() }}
             </div>
         </div>

         <div class="card-footer">
             <button class="btn btn-warning btn-block" data-toggle="modal" data-target="#tarikEmas">
                 <i class="menu-icon las la-wallet"></i> Tarik
                 Emas</button>
         </div>
     </div>
 @endif
 <div class="modal fade" id="tarikEmas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Withdraw Bonus Gold</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <form method="POST" action="{{ route('user.terikEmas.post') }}">
                     @csrf
                     <div class="container col-md-12">
                         <table class="table table-borderless">
                             <tbody>
                                 <tr>
                                     <td>Total User</td>
                                     <td>{{ emas25()['same'] }}</td>
                                 </tr>
                                 @if (emas25()['status'])
                                     <tr>
                                         <td>Total User WD</td>
                                         <td>{{ emas25()['totuser'] }}</td>
                                     </tr>
                                     <tr>
                                         <td>User Staging</td>
                                         <td>{{ emas25()['sisa'] }}</td>
                                     </tr>
                                     <tr>
                                         <td>Emas /gr</td>
                                         <td>Rp {{ nb($goldBonus) }}</td>
                                     </tr>
                                     <tr>
                                         <td>Total Gold</td>
                                         <td>{{ emas25()['gold'] . ' gr' }}</td>
                                     </tr>


                                     <tr>
                                         <td colspan="2">----------------------------------------------------</td>
                                     </tr>
                                     <tr>
                                         <td>Harga Total</td>
                                         <td>Rp {{ nb($goldBonus * emas25()['gold']) }}</td>
                                     </tr>
                                     <tr>
                                         <td>Platform Fee (5%)</td>
                                         <td>Rp {{ nb(($goldBonus * emas25()['gold'] * 5) / 100) }}</td>
                                     </tr>
                                     <tr>
                                         <th>Total</th>
                                         <th>
                                             {{ nb($goldBonus * emas25()['gold'] - $goldBonus * emas25()['gold'] * 0.05) }}
                                         </th>
                                     </tr>
                                 @else
                                     <tr>
                                         <td>User Kurang</td>
                                         <td>{{ emas25()['minus'] }}</td>
                                     </tr>
                                     <tr>
                                         <td>Include ID</td>
                                         <td>[
                                             @foreach (emas25()['userId'] as $id)
                                                 {{ $id . ',' }}
                                             @endforeach
                                             ]
                                         </td>
                                     </tr>
                                 @endif
                             </tbody>
                         </table>
                     </div>
                     @if (emas25()['status'])
                         <div class="row mt-4">
                             <div class="col-12 text-sm-center">
                                 <input type="hidden" name="total"
                                     value="{{ $goldBonus * emas25()['gold'] - $goldBonus * emas25()['gold'] * 0.05 }}">
                                 <button type="submit" class="btn btn-warning btn-block">Transfer to
                                     Balance
                                     Rp
                                     {{ nb($goldBonus * emas25()['gold'] - $goldBonus * emas25()['gold'] * 0.05) }}
                                     <i class="me-2 fas fa-arrow-right"></i></button>
                             </div>
                         </div>
                     @endif
                 </form>
             </div>
         </div>
     </div>
 </div>
