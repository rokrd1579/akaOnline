<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\QuestionFormRequest;
use App\Question;
use App\Product;
use App\User;

class QuestionController extends Controller
{
    public function new (QuestionFormRequest $request)
    {
       
        $product = Product::findOrFail($request->product_id);
        $question = Question::create([
            'question' => $request->question,
            'user_id' => Auth::id(),
            'product_id' => $product->id
        ]);
       return redirect()->back()->with('comentado', 'ok');
      
    }
}
