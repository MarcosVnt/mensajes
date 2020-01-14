<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use App\User;
use DB;

class MessageController extends Controller
{
    //
    public function index(Request $request)
    {
        $userId = auth()->id();
        $contactId = $request->contact_id;

        //$user = User::all();
        //return Message::all();
        $return= Message::select('id',
        DB::raw("IF(`from_id`=$userId, TRUE, FALSE) as written_by_me"),
       
        'created_at',
        'content')
        ->where(function ($query) use($userId, $contactId){
            $query->where('from_id',$userId)->where('to_id', $contactId);

        })->orWhere(function ($query) use($userId, $contactId){
            $query->where('from_id', $contactId)->where('to_id', $userId);

        })->get();


        

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
