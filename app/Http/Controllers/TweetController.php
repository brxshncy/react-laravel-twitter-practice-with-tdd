<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TweetController extends Controller
{
    
    public function index()
    {
        $data = [];

        $data['tweets'] = Tweet::orderBy('created_at','DESC');

        return response()->json([
            'success' => true,
            'data' => $data
        ], 200);
    }

    public function store(Request $request)
    {
        $data = [];
        $request->merge([
            'user_id' => Auth::user()->id
        ]);
        $data['tweet'] = Tweet::create($request->all());

        return response()->json([
            'success' => true,
            'data' => $data
        ], 200);
    }

   
    public function show(Tweet $tweet)
    {
        $data = [];
        $data['tweet'] = $tweet;

        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }
 
    public function update(Request $request, Tweet $tweet)
    {
        $data = [];
        
        $data['tweet'] =$tweet->update($request->all());

        return response()->json([
            'success' => true,
            'data' => $data
        ], 200);
    }

   
    public function destroy(Tweet $tweet)
    {
        $tweet->where('user_id', Auth::user()->id);

        if (true) {
            
            $tweet->delete();

            return response()->json([
                'success' => true
            ], 200);
        }
        
    }
}
