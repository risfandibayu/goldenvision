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

        $gold = Gold::where('user_id',Auth::user()->id)->where('prod_id',$request->product_id)->first();

        if($gold){
            $gold->qty += $request->qty;
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
            $newg->save();

            $user->balance -= ($product->price * $request->qty);
            $user->total_invest += ($product->price * $request->qty);
            $user->save();

            $product->stok -= $request->qty;
            $product->save();
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
