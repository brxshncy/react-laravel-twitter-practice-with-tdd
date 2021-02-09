<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
   
    public function index()
    {
        //
    }


    public function store(Request $request)
    {
        $data = [];
        $request->merge([
            'password' => bcrypt($request->password)
        ]);
        $data['user'] = User::create($request->all());
            
        return response()->json([
            'success' => true,
            'data' => $data
        ], 200);
    }

 
    public function show($id)
    {
        //
    }

  

   
    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
