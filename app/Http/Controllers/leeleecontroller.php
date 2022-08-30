<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class leeleecontroller extends Controller
{
    //
    public function page($page){

        // return view('pages'.$page);
        // print_r($page);
        return view('pages.'.$page);
    }

        // 로그인
        public function login (Request $request) {
            $userid = $request->input('userid');
            $passwd = $request->input('passwd');
     
            $result = collect(DB::select('SELECT isMember(?, ?) as is_member', [$userid, $passwd]))->first();
            
            
            if ($result->is_member == 1) {
                $request->session()->put('mgmt-login', true);
                // $request->session()->put('mgmt-login', '세션값');
                // $mgmt_login = $request->session()->get('mgmt-login');
                // print_r($mgmt_login);     
                return redirect('/');
                // return view('/login');
            }
            return redirect('/login');
            // return view('/login');
        }

            // 로그아웃
    public function logout (Request $request) {
        $request->session()->forget('mgmt-login');
        return redirect('/login');
    }
}
