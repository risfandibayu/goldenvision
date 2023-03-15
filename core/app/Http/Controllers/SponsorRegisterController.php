<?php

namespace App\Http\Controllers;

use App\Models\AdminNotification;
use App\Models\GeneralSetting;
use App\Models\User;
use App\Models\UserLogin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\Tree\TreeService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class SponsorRegisterController extends Controller
{
    public function __construct(public TreeService $treeService)
    {
        $this->activeTemplate = activeTemplate();
    }
    public function setSession(Request $request){
        $data = [
            'upline'    => $request->upline,
            'position'  => $request->postion,
            'url'       => $request->back
        ];
        $request->session()->put('SponsorSet', $data);
        return redirect()->route('user.sponsor.regist');
    }

    public function index(){
        // dd($request->sesion()->get('SponsorSet'));
        $data['page_title'] = "Register By Sponsor";
        $data['user'] = Auth::user();
        // $data['position'] = 1;
        return view($this->activeTemplate . 'user.registerSponsor', $data);
    }
    public function registerUser(Request $request){
        $validate = Validator::make($request->all(),[
            'sponsor'   => 'required',
            'upline'    => 'required',
            'position'  => 'required',
            'username'  => 'required|alpha_num|unique:users|min:6',
            'email'     => 'required|email',
            'phone'     => 'required'
        ]);
        if ($validate->fails()) {
           return redirect()->back()->withInput($request->all())->withErrors($validate);
        }
        event(new Registered($user = $this->create($request->all())));
    }
    protected function create(array $data)
    {

        $gnl = GeneralSetting::first(); 
        //User Create
        $user = new User();
        $user->firstname    = isset($data['firstname']) ? $data['firstname'] : null;
        $user->lastname     = isset($data['lastname']) ? $data['lastname'] : null;
        $user->email        = strtolower(trim($data['email']));
        $user->password     = Hash::make(strtolower(trim($data['username'])));
        $user->username     = strtolower(trim($data['username']));
        $user->mobile       = 62 . $data['mobile'];
        $user->address      = [
            'address' => '',
            'state' => '',
            'zip' => '',
            'country' => 'Indonesia',
            'city' => ''
        ];
        $user->status = 1;
        $user->ev = $gnl->ev ? 0 : 1;
        $user->sv = $gnl->sv ? 0 : 1;
        $user->ts = 0;
        $user->tv = 1;
        $user->save();


        $adminNotification = new AdminNotification();
        $adminNotification->user_id = $user->id;
        $adminNotification->title = 'New member registered By Sponsor: '.Auth::user()->username;
        $adminNotification->click_url = route('admin.users.detail', $user->id);
        $adminNotification->save();


        //Login Log Create
        $ip = $_SERVER["REMOTE_ADDR"];
        $exist = UserLogin::where('user_ip', $ip)->first();
        $userLogin = new UserLogin();

        //Check exist or not
        if ($exist) {
            $userLogin->longitude =  $exist->longitude;
            $userLogin->latitude =  $exist->latitude;
            $userLogin->location =  $exist->location;
            $userLogin->country_code = $exist->country_code;
            $userLogin->country =  $exist->country;
        } else {
            $info = json_decode(json_encode(getIpInfo()), true);
            $userLogin->longitude =  @implode(',', $info['long']);
            $userLogin->latitude =  @implode(',', $info['lat']);
            $userLogin->location =  @implode(',', $info['city']) . (" - " . @implode(',', $info['area']) . "- ") . @implode(',', $info['country']) . (" - " . @implode(',', $info['code']) . " ");
            $userLogin->country_code = @implode(',', $info['code']);
            $userLogin->country =  @implode(',', $info['country']);
        }

        $userAgent = osBrowser();
        $userLogin->user_id = $user->id;
        $userLogin->user_ip =  $ip;

        $userLogin->browser = @$userAgent['browser'];
        $userLogin->os = @$userAgent['os_platform'];
        $userLogin->save();


        return $user;
    }
}
