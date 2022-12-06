<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class TemplateController extends Controller
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
        $title = $request->input('title');
        $publication = $request->input('template');

        DB::table('templates')->insert([
            'title' => $title,
            'template' => $publication,
            "created_at" => date('Y-m-d H:i:s'),
            "updated_at" => date('Y-m-d H:i:s')
        ]);

        return response()->json(['msg'=> 'Template '.$title.' was added', 'data'=>$request->all()])->withHeaders([
            'Content-Type'=>'application/json'
        ]);
    }

    public function list(){
        $template = DB::table('templates')
        ->select('title', 'template', 'id', 'created_at', 'updated_at')
            ->get();
        return response()->json($template)
            ->withHeaders([
                'Content-Type' => 'application/json'
            ]);
    }

    public function find($title){
        $template = DB::table('templates')
            ->where('title', $title)
            ->get();
        return response()->json($template)
            ->withHeaders([
                'Content-Type' => 'application/json'
            ]);
    }

    public function edit(Request $publication_info){
        $id = $publication_info->input('id');
        $title = $publication_info->input('title');
        $template = $publication_info->input('template');

        DB::table('templates')->where('id', $id)
            ->update([
                'title' => $title,
                'publication' => $template,
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        return response()->json(['msg' => 'Tempalete "' . $title . '" has been updated'])
            ->withHeaders([
                'Content-Type' => 'application/json'
            ]);
    }


    public function delete($id)
    {
        DB::table('templates')->where('id', $id)
            ->delete();
        return response()->json(['msg' => 'Deleted'])
            ->withHeaders([
                'Content-Type' => 'application/json'
            ]);
    }

    //
}
