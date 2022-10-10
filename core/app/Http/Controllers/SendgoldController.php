<?php

namespace App\Http\Controllers;

use App\Models\sendgold;
use App\Http\Controllers\Controller;
use App\Models\alamat;
use App\Models\Gold;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\Reader\Xls\Color\BIFF5;

class SendgoldController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\sendgold  $sendgold
     * @return \Illuminate\Http\Response
     */
    public function show(sendgold $sendgold)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\sendgold  $sendgold
     * @return \Illuminate\Http\Response
     */
    public function edit(sendgold $sendgold)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\sendgold  $sendgold
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, sendgold $sendgold)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\sendgold  $sendgold
     * @return \Illuminate\Http\Response
     */
    public function destroy(sendgold $sendgold)
    {
        //
    }

    public function goldDelivery(Request $request){
        // dd($request->all());

        $user = Auth::user();
        $gold = Gold::where('id',$request->gid)->first();
        $alamat = alamat::where('id', $request->alamat)->first();
        $prod = Product::where('id',$gold->prod_id)->first();

        // dd(($prod->weight * $request->qty)/1000);

        if (!$alamat->kode_pos) {
            # code...
            $notify[] = ['error', 'Incomplete address, please complete the recipient`s address first'];
            return redirect()->back()->withNotify($notify);
        }

        if ($request->qty > $gold->qty ) {
            # code...
            $notify[] = ['error', 'The qty you input exceeds the amount of gold you have'];
            return redirect()->back()->withNotify($notify);
        }

        $sg = new sendgold();
        $sg->trx = getTrx();
        $sg->user_id = $user->id;
        $sg->alamat = $alamat->alamat;
        $sg->nama_penerima = $alamat->nama_penerima;
        $sg->no_telp_penerima = $alamat->no_telp;
        $sg->kode_pos = $alamat->kode_pos;
        $sg->gold_id = $request->gid;
        $sg->qty = $request->qty;
        $sg->status = 2;
        // $sg->save();
        

        $options = [
            'cache_wsdl'     => WSDL_CACHE_NONE,
            'trace'          => 1,
            'stream_context' => stream_context_create(
                [
                    'ssl' => [
                        'verify_peer'       => false,
                        'verify_peer_name'  => false,
                        'allow_self_signed' => true
                    ]
                ]
            )
        ];

        try {
        $wsdl="http://api.rpxholding.com/wsdl/rpxwsdl.php?wsdl";
        libxml_disable_entity_loader(false);
        $client = new \SoapClient($wsdl,$options);
        $username = env('USER_RPX');
        $password  = env('PASS_RPX');
        $format = 'json';

        
            $result = $client->getRatesPostalCode($username,$password,env('POSCODE_RPX'),$alamat->kode_pos,'RGP',($prod->weight * $request->qty)/1000,'0',$format);
            $response = json_decode($result,true);
            // dd($response);
            if (!$response) {
                # code...
                $notify[] = ['error', 'Invalid destination address'];
                return redirect()->back()->withNotify($notify);
            }else{
                // dd((int)$response['RPX']['DATA']['PRICE'] - 20000);
                $sg->ongkir = (int)$response['RPX']['DATA']['PRICE'] - 20000;
                if($user->balance < $sg->ongkir){
                    $notify[] = ['error', 'Your balance is not enough for postage payment'];
                    return redirect()->back()->withNotify($notify);
                }else{

                    $user->balance -= $sg->ongkir;
                    $user->save();

                    $sg->save();
                    $notify[] = ['success', 'Gold delivery request is successful, please wait for confirmation.'];
                    return redirect()->back()->withNotify($notify);
                }
            }
        }
        catch ( \Exception $e ) {
            // echo $e->getMessage();
            $notify[] = ['error', $e->getMessage()];
            return redirect()->back()->withNotify($notify);
        }
        

        // $notify[] = ['success', 'Gold delivery request is successful, please wait for confirmation.'];
        // return redirect()->back()->withNotify($notify);
    }

}
