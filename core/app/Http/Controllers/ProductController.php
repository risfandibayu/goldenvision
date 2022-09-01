<?php

namespace App\Http\Controllers;

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
        $data['product'] = Product::where('status',1)->where('is_reseller',0)->get();
        return view('templates.basic.user.product.index',$data);
    }

    public function productPurchase(Request $request){
        // dd($request->all());
        $this->validate($request, ['product_id' => 'required|integer']);
        $product = product::where('id', $request->product_id)->where('status', 1)->firstOrFail();
        $gnl = GeneralSetting::first();

        $user = User::find(Auth::id());

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
        }else{
            $newg = new Gold();
            $newg->user_id = Auth::user()->id;
            $newg->prod_id = $request->product_id;
            $newg->qty = $request->qty;
            $newg->save();

            $user->balance -= ($product->price * $request->qty);
            $user->total_invest += ($product->price * $request->qty);
            $user->save();
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
