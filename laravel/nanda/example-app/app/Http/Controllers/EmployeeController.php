<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class EmployeeController extends Controller
{

    private $data_employees = [
        [
            'id' => 1,
            'nik' => '1234363459',
            'nama' => 'Bejo',
            'alamat' => 'Jakarta Timur',
            'usia' => '20 th',
            'jabatan' => 'Manager'
        ],
        [
            'id' => 2,
            'nik' => '133436360',
            'nama' => 'Joko',
            'alamat' => 'Jakarta Utara',
            'usia' => '22 th',
            'jabatan' => 'Seketaris'
        ],
        [
            'id' => 3,
            'nik' => '143436360',
            'nama' => 'Jaki',
            'alamat' => 'Jakarta Selatan',
            'usia' => '25 th',
            'jabatan' => 'Bendahara'
        ]
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json($this->data_employees);
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
            'alamat' => 'required',
            'usia' => 'required',
            'jabatan' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 442);
        }

        array_push($this->data_employees, $request->all());
        return $this->data_employees;
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
        foreach ($this->data_employees as $employee) {
            if ($employee['id'] == $id) {
                $data = $employee;
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
            'alamat' => 'required',
            'usia' => 'required',
            'jabatan' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 442);
        }
        
        array_push($this->data_employees, $request->all());
        return $this->data_employees;

        foreach ($this->data_employees as $key => $employee) {
            if ($employee['id'] == $id) {
                $this->data_employees[$key] = $request->all();
            }
        }
        return $this->data_employees;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        foreach ($this->data_employees as $key => $employee) {
            if ($employee['id'] == $id) {
                unset($this->data_employees[$key]);
            }
        }   
        return $this->data_employees;
    }
}
