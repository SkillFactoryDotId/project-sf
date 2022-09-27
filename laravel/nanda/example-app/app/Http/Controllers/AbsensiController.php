<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AbsensiController extends Controller
{
    private $data_absensi = [
        [
            'id' => 1,
            'nik' => '120314363459',
            'nama' => 'Nanda',
            'total_absensi' => 1
        ],
        [
            'id' => 2,
            'nik' => '2314363459',
            'nama' => 'Nindi',
            'total_absensi' => 0
        ],
        [
            'id' => 3,
            'nik' => '303143634510',
            'nama' => 'Nando',
            'total_absensi' => 5
        ]
        ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json($this->data_absensi);
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
            'id' => 'required',
            'nik' => 'required',
            'nama' => 'required',
            'total_absensi' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        array_push($this->data_absensi, $request->all());
        return $this->data_absensi;
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
        foreach ($this->data_absensi as $absen) {
            if ($absen['id'] == $id) {
                $data = $absen;
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
            'id' => 'required',
            'nik' => 'required',
            'nama' => 'required',
            'total_absensi' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 442);
        }

        foreach ($this->data_absensi as $key => $absen) {
            if ($absen['id'] == $id) {
                $this->data_absensi[$key] = $request->all();
            }
        }
        return $this->data_absensi;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        foreach ($this->data_absensi as $key => $absen) {
            if ($absen['id'] == $id) {
                unset($this->data_absensi[$key]);
            }
        }   
        return $this->data_absensi;
    }
}
