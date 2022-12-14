<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class AuthenticationController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function authenticate($user_id){
        $user_id = urldecode($user_id);
        $user = DB::table('users')
            ->where('user_id', $user_id)
            ->get();
        if($user->count()>0){
            $key = config('app.key');
            $payload = [
                "user_id" => $user,
            ];
            $jwt = JWT::encode($payload, $key, 'HS256');
            return response()->json(['status'=>'valid'])->withHeaders([
                'Content-Type'=>'application/json'
            ]);
        }else{
            return response()->json(['status'=>'Invalid'])->withHeaders([
                'Content-Type'=>'application/json'
            ]); 
        }
    }
    public function signup(Request $user_info){
        $user_id = $user_info->input('user_id');
        DB::table('users')
            ->insert([
                'user_id'=>$user_id,
                "created_at" =>  date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s')
            ]);
        return response()->json(['msg'=> $user_id.' was added'])->withHeaders([
            'Content-Type'=>'application/json'
        ]);
    }

    public function sync()
    {
        $xml = file_get_contents('https://qtlaw.info/sync.php');
        $users = json_decode($xml);
        foreach ($users as $user) {
           $numUsers = DB::table('users')->where('user_id', $user[0])->count();
           if(intval($numUsers)<1){
            DB::table('users')
            ->insert([
                'user_id'=>$user[0],
                "created_at" =>  date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s')
            ]);
           }
        }

        return response()->json(['status'=>'Sync Completed']);
        
    }

    //
}
