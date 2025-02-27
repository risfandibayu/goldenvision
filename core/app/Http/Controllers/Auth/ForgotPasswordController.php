<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Frontend;
use App\Models\PasswordReset;
use App\Models\User;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    public function __construct()
    {
        $this->middleware('guest');
    }


    public function showLinkRequestForm()
    {
        return view('landing.pass_reset');
        $page_title = "Forgot Password";
        $content    = Frontend::where('data_keys', 'reset_password.content')->first();
        // dd($content);
        return view(activeTemplate() . 'user.auth.passwords.email', compact('page_title', 'content'));
    }

    public function sendResetLinkEmail(Request $request)
    {
     
        if ($request->type == 'email') {
            $validationRule = [
                'value'=>'required|email'
            ];
            $validationMessage = [
                'value.required'=>'Email field is required',
                'value.email'=>'Email must be an valide email'
            ];
        }elseif($request->type == 'username'){
            $validationRule = [
                'value'=>'required'
            ];
            $validationMessage = ['value.required'=>'Username field is required'];
        }else{
            $notify[] = ['error','Invalid selection'];
            return back()->withNotify($notify);
        }

        $request->validate($validationRule,$validationMessage);

        $user = User::where($request->type, $request->value)->first();

        if (!$user) {
            $notify[] = ['error', 'User not found.'];
            return back()->withNotify($notify);
        }

        PasswordReset::where('username', $user->username)->delete();
        $code = verificationCode(6);
        $password = new PasswordReset();
        $password->email = $user->email;
        $password->username = $user->username;
        $password->token = $code;
        $password->created_at = \Carbon\Carbon::now();
        $password->save();

        $userIpInfo = getIpInfo();
        $userBrowserInfo = osBrowser();
        sendEmail($user, 'PASS_RESET_CODE', [
            'code' => $code,
            'operating_system' => @$userBrowserInfo['os_platform'],
            'browser' => @$userBrowserInfo['browser'],
            'ip' => @$userIpInfo['ip'],
            'time' => @$userIpInfo['time']
        ]);

        $page_title = 'Account Recovery';
        $username = $user->username;
        session()->put('pass_res_username',$username);
        $notify[] = ['success', 'Password reset send to email successfully'];
        return redirect()->route('user.password.code_verify')->withNotify($notify);
    }

    public function codeVerify(){
        
        $page_title = 'Account Recovery';
        $username = session()->get('pass_res_username');
        if (!$username) {
            $notify[] = ['error','Opps! session expired'];
            return redirect()->route('user.password.request')->withNotify($notify);
        }
        
        $content    = Frontend::where('data_keys', 'reset_password.content')->first();
        return view('landing.verif_code',compact('page_title','username', 'content'));
        return view(activeTemplate().'user.auth.passwords.code_verify',compact('page_title','email', 'content'));
    }

    public function verifyCode(Request $request)
    {
        $request->validate(['code.*' => 'required', 'username' => 'required']);
        $code =  $request->code;

        if (PasswordReset::where('token', $code)->where('username', $request->username)->count() != 1) {
            $notify[] = ['error', 'Invalid token'];
            return redirect()->route('user.password.request')->withNotify($notify);
        }
        $notify[] = ['success', 'You can change your password.'];
        session()->flash('fpass_username', $request->username);
        return redirect()->route('user.password.reset', $code)->withNotify($notify);
    }

}
