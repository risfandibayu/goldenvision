<?php

namespace App\Http\Controllers;

use App\Models\corder;
use App\Models\GeneralSetting;
use App\Models\Gold;
use App\Models\Product;
use App\Models\User;
use App\Models\UserExtra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    //
    public function productIndex(){
        $data['page_title'] = "Product";
        if (auth()->user()->plan_id != 0) {
            # code...
            $data['product'] = Product::where('status',1)->where('is_reseller',1)->where('is_custom','!=',1)->get();
            $data['cproduct'] = Product::where('status',1)->where('is_reseller',1)->where('is_custom','=',1)->get();
        }else{
            $data['product'] = Product::where('status',1)->where('is_reseller',0)->where('is_custom','!=',1)->get();
            $data['cproduct'] = Product::where('status',1)->where('is_reseller',1)->where('is_custom','=',1)->get();
        }
        $data['corder'] = corder::where('user_id',Auth::user()->id)->where('status','!=',1)->get();
        return view('templates.basic.user.product.index',$data);
    }

    public function productPurchase(Request $request){
        // dd($request->all());
        $this->validate($request, ['product_id' => 'required|integer']);
        $product = product::where('id', $request->product_id)->where('status', 1)->firstOrFail();
        $gnl = GeneralSetting::first();

        $user = User::find(Auth::id());

        if ($product->stok == 0) {
            $notify[] = ['error', 'Out Of Stock'];
            return back()->withNotify($notify);
        }

        if ($product->stok < $request->qty) {
            $notify[] = ['error', 'the number of qty you input exceeds the available stock'];
            return back()->withNotify($notify);
        }

        if ($user->balance < ($product->price * $request->qty)) {
            $notify[] = ['error', 'Insufficient Balance'];
            return back()->withNotify($notify);
        }

        // dd(intval(($product->price * $request->qty) / 11000000));

        $gold = Gold::where('user_id',Auth::user()->id)->where('prod_id',$request->product_id)->where('from_bro','=',0)->first();

        if($gold){
            $gold->qty += $request->qty;
            $gold->from_bro = 0;
            $gold->save();

            $user->balance -= ($product->price * $request->qty);
            $user->total_invest += ($product->price * $request->qty);
            $user->save();

            $product->stok -= $request->qty;
            $product->save();
        }else{
            $newg = new Gold();
            $newg->user_id = Auth::user()->id;
            $newg->prod_id = $request->product_id;
            $newg->qty = $request->qty;
            $newg->from_bro = 0;
            $newg->save();

            $user->balance -= ($product->price * $request->qty);
            $user->total_invest += ($product->price * $request->qty);
            $user->save();

            $product->stok -= $request->qty;
            $product->save();
        }

        if (($product->price * $request->qty) >= 11000000) {
            # code...


            $user->bro_qty += intval(($product->price * $request->qty) / 11000000);
            $user->save();

            $qty = intval(($product->price * $request->qty) / 11000000);

            brodev(Auth::user()->id, $qty);

            if (date('Y-m-d,H:i:s') > '2022-09-02,23:59:59') {
                # code...
                // dd('s');
                $g1 = 50;
                $g2 = 20;
                $g3 = 5;
                $g4 = 2;
                $tot = 77;
            }else{
                // dd('w');
                $g1 = 70;
                $g2 = 20;
                $g3 = 7;
                $g4 = 2;
                $tot = 99;
            }

            $golds = Gold::where('user_id',Auth::user()->id)->first();
            $gold1 = Gold::where('user_id',Auth::user()->id)->where('prod_id',1)->where('from_bro','=',1)->first();
            $gold2 = Gold::where('user_id',Auth::user()->id)->where('prod_id',2)->where('from_bro','=',1)->first();
            $gold3 = Gold::where('user_id',Auth::user()->id)->where('prod_id',3)->where('from_bro','=',1)->first();
            $gold4 = Gold::where('user_id',Auth::user()->id)->where('prod_id',4)->where('from_bro','=',1)->first();

            if($golds){
                if($gold1){
                    $gold1->qty += $g1 * $qty;
                    $gold1->save();
                }else{
                    $newg = new Gold();
                    $newg->user_id = Auth::user()->id;
                    $newg->prod_id = 1;
                    $newg->qty = $g1 * $qty;
                    $newg->save();
                }

                if($gold2){
                    $gold2->qty += $g2 * $qty;
                    $gold2->save();
                }else{
                    $newg = new Gold();
                    $newg->user_id = Auth::user()->id;
                    $newg->prod_id = 2;
                    $newg->qty = $g2 * $qty;
                    $newg->save();
                }

                if($gold3){
                    $gold3->qty += $g3 * $qty;
                    $gold3->save();
                }else{
                    $newg = new Gold();
                    $newg->user_id = Auth::user()->id;
                    $newg->prod_id = 3;
                    $newg->qty = $g3 * $qty;
                    $newg->save();
                }

                if($gold4){
                    $gold4->qty += $g4 * $qty;
                    $gold4->save();
                }else{
                    $newg = new Gold();
                    $newg->user_id = Auth::user()->id;
                    $newg->prod_id = 4;
                    $newg->qty = $g4 * $qty;
                    $newg->save();
                }


            }else{
                $newg = new Gold();
                $newg->user_id = Auth::user()->id;
                $newg->prod_id = 1;
                $newg->qty = $g1 * $qty;
                $newg->save();

                $newg = new Gold();
                $newg->user_id = Auth::user()->id;
                $newg->prod_id = 2;
                $newg->qty = $g2 * $qty;
                $newg->save();

                $newg = new Gold();
                $newg->user_id = Auth::user()->id;
                $newg->prod_id = 3;
                $newg->qty = $g3 * $qty;
                $newg->save();

                $newg = new Gold();
                $newg->user_id = Auth::user()->id;
                $newg->prod_id = 4;
                $newg->qty = $g4 * $qty;
                $newg->save();
            }
        }

        $trx = $user->transactions()->create([
            'amount' => $product->price * $request->qty,
            'trx_type' => '-',
            'details' => 'Purchased ' . $product->name. ' For '.$request->qty.' Item',
            'remark' => 'purchased_product',
            'trx' => getTrx(),
            'post_balance' => getAmount($user->balance),
        ]);

        sendEmail2($user->id, 'product_purchased', [
            'plan' => $product->name. ' For '.$request->qty.' Item',
            'amount' => getAmount($product->price * $request->qty),
            'currency' => $gnl->cur_text,
            'trx' => $trx->trx,
            'post_balance' => getAmount($user->balance),
        ]);

        // dd('sip');

        $notify[] = ['success', 'Purchased ' . $product->name . ' Successfully'];
        return redirect()->route('user.home')->withNotify($notify);
    }
}
