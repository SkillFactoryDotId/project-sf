<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) 
    {
        $datas = new User;
        if ($request->has('nama')) {
            $datas = $datas->where('name','like', '%'.$request->nama.'%');
        }
        
        $datas = $datas->paginate();
        return response()->json($datas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'    => 'required',
            'email'   => 'required|unique:users',  
            'password'=> 'required',   
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        
        $data = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        return $data;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $data = User::findOrFail($id);
       return $data;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required',
            'email'   => 'required|unique:users',  
            'password' => 'nullable',   
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $data = User::findOrFail($id);
        
        $data->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->has('password') ? Hash::make($request->password) : $data->password,
        ]);
        return $data;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = User::findOrFail($id);
        return $data->delete();
    }
}
 