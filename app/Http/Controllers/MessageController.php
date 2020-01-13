<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use App\User;
use DB;

class MessageController extends Controller
{
    //
    public function index()
    {
        $userId = auth()->id();

        $user = User::all();
        
        //return Message::all();
        $return= Message::select('id',
        DB::raw("IF(`from_id`=$userId, TRUE, FALSE) as written_by_me"),
       
        'created_at',
        'content')->get();

        //dd($user,$userId,$return);
        return $return;
    }

    public function store(Request $request){
       // dd($request);
        $menssage = new Message();
        $menssage->from_id = auth()->id();
        $menssage->to_id = $request->to_id;
        $menssage->content = $request->content;
        $saved = $menssage->save();

        $data = [];
        $data['success'] = $saved;
        return $data;

    }
}
