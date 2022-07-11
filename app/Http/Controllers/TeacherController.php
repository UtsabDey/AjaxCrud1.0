<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('teacher.index');
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
        $request->validate([
            'name' => 'required',
            'title' => 'required',
            'institute' => 'required',
        ]);

        Teacher::insert([
            'name' => $request->name,
            'title' => $request->title,
            'institute' => $request->institute,
        ]);
        return response()->json([
            'status' => 200,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $data = Teacher::query()
            ->orderBy('id', 'asc')->get();
        return response()->json($data);
    }

    public function edit($id)
    {
        $data = Teacher::findOrFail($id);
        return response()->json($data);

    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'title' => 'required',
            'institute' => 'required',
        ]);

        Teacher::findOrFail($id)->update([
            'name' => $request->name,
            'title' => $request->title,
            'institute' => $request->institute,
        ]);
        return response()->json([
            'status' => 200,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Teacher::findOrFail($id);
        $data->delete();
        return response()->json($data);
    }
}
