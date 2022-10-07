<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Employee;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $datas = new Employee;
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
            'name' => 'required',
            'address' => 'required',
            'age' => 'required',
            'position' => 'required',
        ]);
        
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $data = Employee::orderBy('created_at', 'desc')->first();

        $id_number = null;

        if (!empty($data)) {
            $id_number = $data->id + 1 . date("mY") . $this->generateRandomString();
        } else {
            $id_number = 1 . date("mY") . $this->generateRandomString();
        }

        $data = Employee::create([
            'id_number' => $id_number,
            'name' => $request->name,
            'address' => $request->address,
            'age' =>  $request->age,
            'position' =>  $request->position,
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
        $data = Employee::findOrFail($id);
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
            'name' => 'required',
            'address' => 'required',
            'age' => 'required',
            'position' => 'required',
        ]);

        $data = Employee::orderBy('created_at', 'desc')->first();

        $id_number = null;

        if (!empty($data)) {
            $id_number = $data->id + 1 . date("mY") . $this->generateRandomString();
        } else {
            $id_number = 1 . date("mY") . $this->generateRandomString();
        }

        $data = Employee::create([
            'id_number' => $id_number,
            'name' => $request->name,
            'email' => $request->email,
            'age' =>  $request->age,
            'position' =>  $request->position,
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
        $data = Employee::findOrFail($id);
        return $data->delete();
    }

    function generateRandomString($length = 4) {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
};
