<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    private $data_users = [
        [
            'id' => 1,
            'nama' => 'Nanda',
            'alamat' => 'Kec. Selesai'
        ],
        [
            'id' => 2,
            'nama' => 'Yuda',
            'alamat' => 'Kec. Binjai Utara'
        ],
        [
            'id' => 3,
            'nama' => 'Abin',
            'alamat' => 'Kec. Hamparan Perak'
        ]
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json($this->data_users);
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
            'id'     => 'required',
            'nama'     => 'required',
            'alamat'   => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        
        array_push($this->data_users, $request->all());
        return $this->data_users;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = null;
        foreach ($this->data_users as $user) {
            if ($user['id'] == $id) {
                $data = $user;
            }
        }   
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
            'id'     => 'required',
            'nama'     => 'required',
            'alamat'   => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        foreach ($this->data_users as $key => $user) {
            if ($user['id'] == $id) {
                $this->data_users[$key] = $request->all();
            }
        }
        return $this->data_users;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        foreach ($this->data_users as $key => $user) {
            if ($user['id'] == $id) {
                unset($this->data_users[$key]);
            }
        }   
        return $this->data_users;
    }
}
