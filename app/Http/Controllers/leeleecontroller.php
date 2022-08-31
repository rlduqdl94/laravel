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



    public function test(Request $request){
        // return('pages.aa');
        $sDev_id = $request->input('test');
        // return view('pages.aa',['aaaa' => $sDev_id,'bbbb' => 'asd'])->render();
        
        $date_len = strlen($sDev_id);

        if ($date_len < 9) {
            $date_val = $sDev_id;
            $result = collect(DB::select('SELECT * FROM notice'));
            $result = $result->where('title', 'like', '%테%');
            $result = DB::table('notice')
                ->where('date_time', 'like', '%'.$date_val.'%')
                ->get();
        }else{
            $search_data = trim($sDev_id);
            $date_val = explode("-",$sDev_id);
            $start_date = $date_val[0].'-'.$date_val[1].'-'.$date_val[2];
            $start_date = trim($start_date);
            $end_date = $date_val[3].'-'.$date_val[4].'-'.$date_val[5];
            $end_date = trim($end_date);
            $result = collect(DB::select('SELECT * FROM notice'));
            // $result = $result->where('date_time', '=', '2022-08-31');
            $result = $result->whereBetween('date_time', [$start_date, $end_date]);
        }
        
        return response()->json([$users]);
    }
}
