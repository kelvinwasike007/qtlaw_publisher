<?php

namespace App\Http\Controllers;
use Illuminate\Http\Response;
class AuthController extends Controller
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

    public function sync()
    {
        $xml = file_get_contents('https://qtlaw.info/sync.php');
        return response()->json(['data'=>xml]);
    }

    //
}
