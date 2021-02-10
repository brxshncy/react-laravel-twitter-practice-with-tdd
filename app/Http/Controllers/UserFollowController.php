<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserFollowController extends Controller
{
    
    public function index()
    {
        //
    }


    public function store(Request $request)
    {
        $data = [];

        $user = User::where('id', $request->user_id)->first();
      

        $following = $request->following_id;

        $data['followed']  = $user->follows()->attach($following);
        
        return response()->json([
            'success' => true,
            'data' => $data

        ], 200);
    }

 
    public function show($id)
    {
        //
    }

 
    public function edit($id)
    {
        //
    }

  
    public function update(Request $request, $id)
    {
        //
    }

    public function destroy(User $following)
    {
        
      
        $follows = DB::table('following_user')->pluck('following_id')->toArray();

        return $following->follows()->detach($follows);
        
        return response()->json([
            'success' => true
        ], 200);
    }
}
