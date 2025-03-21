<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function index()
    {
        $student = Student::all();
        $data = [
            'status' => 200,
            'student' => $student
        ];
        return response()->json($data, 200);
    }

    public function upload(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'email' => 'required|email'
            ]
        );
        $data = [
            "status" => 422,
            "message" => $validator->messages()
        ];
        if ($validator->fails()) {
            return response()->json($data, 422);
        } else {
            $student = new Student;
            $student->name = $request->name;
            $student->email = $request->email;
            $student->password = $request->password;
            $student -> save();
        }
        $data = [
            'status' => 200,
            'message' => 'Data uploaded success'
        ];
        return response() -> json($data, 200);
    }

    public function edit(Request $request, $id){
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'email' => 'required|email'
            ]
        );
        $data = [
            "status" => 422,
            "message" => $validator->messages()
        ];
        if ($validator->fails()) {
            return response()->json($data, 422);
        } else {
            $student = Student::find($id);
            $student->name = $request->name;
            $student->email = $request->email;
            $student->password = $request->password;

            $student -> save();
        }
        $data = [
            'status' => 200,
            'message' => 'Data updated success'
        ];
        return response() -> json($data, 200);
    }

    public function delete($id){
       $student = Student::find($id);
       $student ->delete();
       $data = [
        'status' => 200,
        'message' => 'Data deleted success'
    ];
    return response() -> json($data, 200);
    }
}
