<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class PublicationController extends Controller
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

    public function new(Request $request){
        $user_id = $request->input('user_id');
        $title = $request->input('title');
        $publication = $request->input('publication');

        DB::table('publications')->insert([
            'title' => $title,
            'publication' => $publication,
            'user_id' => $user_id,
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s')
        ]);

        return response()->json(['msg'=> $title.' was added', 'data'=>$request->all()])->withHeaders([
            'Content-Type'=>'application/json'
        ]);
    }

    public function list($user_id){
        $publications = DB::table('publications')
            ->where('user_id', urldecode($user_id))
            ->get();
        return response()->json($publications)
            ->withHeaders([
                'Content-Type' => 'application/json'
            ]);
    }

    public function find($publication){
        $publications = DB::table('publications')
            ->where('id', $publication)
            ->get();
        return response()->json($publications)
            ->withHeaders([
                'Content-Type' => 'application/json'
            ]);
    }

    public function edit(Request $publication_info){
        $pub_id = $publication_info->input('pub_id');
        $title = $publication_info->input('title');
        $publication = $publication_info->input('publication');

        DB::table('publications')->where('id', $pub_id)
            ->update([
                'title' => $title,
                'publication' => $publication,
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        return response()->json(['msg' => 'publication "' . $title . '" has been updated'])
            ->withHeaders([
                'Content-Type' => 'application/json'
            ]);
    }


    public function delete($id)
    {
        DB::table('publications')->where('id', $id)
            ->delete();
        return response()->json(['msg' => 'Deleted'])
            ->withHeaders([
                'Content-Type' => 'application/json'
            ]);
    }

    //
}
