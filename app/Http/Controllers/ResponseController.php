<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Response;
use Illuminate\Support\Facades\Auth;

class ResponseController extends Controller
{
    public function store(Request $request)
    {
        if (Auth::check()) {
            Response::create([
                'question_id' => $request->input('question_id'),
                'name' => $request->input('name'),
                'response' => $request->input('reply'),
                'user_id' => Auth::user()->id
            ]);

            return redirect()->back()->with('comentado', 'ok');
        }

       
        
    }
}
