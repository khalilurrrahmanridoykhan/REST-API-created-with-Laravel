<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $student = DB::table('students')->get();

        $data = compact('student');

        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $student = new Student();
        $student->name = $request->name;
        $student->city = $request->city;
        $student->fees = $request->fees;
        $student->save();



        return response()->json([
            'status' => 200,
            'message' =>"Added done",
        ]);
        // echo "";
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $student = DB::table('students')->where('id', $id)->delete();
// echo  $id;
        return response()->json([
            'status' => 200,
            'massage' =>'Delete Done.'

        ]);
    }
}
