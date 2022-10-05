<?php

namespace App\Http\Controllers;

use App\Models\corder;
use App\Http\Controllers\Controller;
use App\Models\GeneralSetting;
use App\Models\Gold;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Image;

class CorderController extends Controller
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
     * @param  \App\Models\corder  $corder
     * @return \Illuminate\Http\Response
     */
    public function show(corder $corder)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\corder  $corder
     * @return \Illuminate\Http\Response
     */
    public function edit(corder $corder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\corder  $corder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, corder $corder)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\corder  $corder
     * @return \Illuminate\Http\Response
     */
    public function destroy(corder $corder)
    {
        //
    }


    public function productCustom(Request $request){
        // dd($request->all());
        if ($request->qty < 500) {
            $notify[] = ['error', 'Minimum Order Quantity Must Be More Than 500 Pieces'];
            return back()->withNotify($notify);
        }
        $gnl = GeneralSetting::first();
        $user = User::where('id',Auth::user()->id)->first();
        $prod = Product::where('id',$request->prod_id)->first();
        if ($user->balance < ($prod->price * $request->qty)) {
            $notify[] = ['error', 'Insufficient Balance'];
            return back()->withNotify($notify);
        }

        $cor = new corder();
        $cor->trx = getTrx();
        $cor->name = $request->name;
        $cor->user_id = Auth::user()->id;
        $cor->prod_id = $request->prod_id;
        if ($request->hasFile('front')) {
            $image = $request->file('front');
            $filename = time() . '_image_' . strtolower(str_replace(" ", "",$cor->user_id)) . '.jpg';
            $location = 'assets/images/cproduct/f/' . $filename;
            $cor->front = $filename;

            $path = './assets/images/cproduct/f/';

            $link = $path . $cor->front;
            if (file_exists($link)) {
                @unlink($link);
            }
            // $size = imagePath()['product']['size'];
            $image = Image::make($image);
            // $size = explode('x', strtolower($size));
            // $image->crop($size[0], $size[1]);
            $image->save($location);
        }
        if ($request->hasFile('back')) {
            $image = $request->file('back');
            $filename = time() . '_image_' . strtolower(str_replace(" ", "",$cor->user_id)) . '.jpg';
            $location = 'assets/images/cproduct/b/' . $filename;
            $cor->back = $filename;

            $path = './assets/images/cproduct/b/';

            $link = $path . $cor->back;
            if (file_exists($link)) {
                @unlink($link);
            }
            // $size = imagePath()['product']['size'];
            $image = Image::make($image);
            // $size = explode('x', strtolower($size));
            // $image->crop($size[0], $size[1]);
            $image->save($location);
        }
        $cor->qty = $request->qty;
        $cor->status = 2;
        
        $newg = new Gold();
        $newg->user_id = Auth::user()->id;
        $newg->prod_id = $request->prod_id;
        $newg->qty = $request->qty;
        $newg->is_custom = 1;
        $newg->status = 1;
        $newg->from_bro = 0;
        $newg->save();
        
        $cor->gold_id = $newg->id;
        $cor->save();

        $user->balance -= ($prod->price * $request->qty);
        $user->total_invest += ($prod->price * $request->qty);
        $user->save();

        $trx = $user->transactions()->create([
            'amount' => $prod->price * $request->qty,
            'trx_type' => '-',
            'details' => 'Purchased ' . $cor->name. ' For '.$request->qty.' Item',
            'remark' => 'purchased_product',
            'trx' => getTrx(),
            'post_balance' => getAmount($user->balance),
        ]);

        sendEmail2($user->id, 'product_purchased', [
            'plan' => $cor->name. ' For '.$request->qty.' Item',
            'amount' => getAmount($prod->price * $request->qty),
            'currency' => $gnl->cur_text,
            'trx' => $trx->trx,
            'post_balance' => getAmount($user->balance),
        ]);

        $notify[] = ['success', 'Custom Order Request successfully'];
        return back()->withNotify($notify);
    }

    public function rproductCustom(Request $request){
        // dd($request->all());
        $cor = corder::where('id',$request->id)->first();
        if ($request->hasFile('front')) {
            $image = $request->file('front');
            $filename = time() . '_image_' . strtolower(str_replace(" ", "",$cor->user_id)) . '.jpg';
            $location = 'assets/images/cproduct/f/' . $filename;
            $cor->front = $filename;

            $path = './assets/images/cproduct/f/';

            $link = $path . $cor->front;
            if (file_exists($link)) {
                @unlink($link);
            }
            // $size = imagePath()['product']['size'];
            $image = Image::make($image);
            // $size = explode('x', strtolower($size));
            // $image->crop($size[0], $size[1]);
            $image->save($location);
        }
        if ($request->hasFile('back')) {
            $image = $request->file('back');
            $filename = time() . '_image_' . strtolower(str_replace(" ", "",$cor->user_id)) . '.jpg';
            $location = 'assets/images/cproduct/b/' . $filename;
            $cor->back = $filename;

            $path = './assets/images/cproduct/b/';

            $link = $path . $cor->back;
            if (file_exists($link)) {
                @unlink($link);
            }
            // $size = imagePath()['product']['size'];
            $image = Image::make($image);
            // $size = explode('x', strtolower($size));
            // $image->crop($size[0], $size[1]);
            $image->save($location);
        }
        $cor->name = $request->name;
        $cor->status = 2;
        $cor->save();

        $notify[] = ['success', 'Custom Order Resubmited successfully'];
        return back()->withNotify($notify);
    }

    public function adminIndex(){
        dd('s');
    }
}
