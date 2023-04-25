<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Sector;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $task = Task::latest()->get();
        if ($task->count() > 0) {
            return response()->json([
                'status' => 200,
                'tasks' => $task
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'errors' => 'Records Not Found!'
            ], 404);
        }
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
            'name' => 'required|string|unique:tasks',
            'sector_id' => 'required|numeric',
            'agree' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        }

        $task = Task::create([
            'name' => $request->name,
            'sector_id' => $request->sector_id,
            'agree' => $request->agree,
        ]);

        if ($task) {
            return response()->json([
                'status' => 200,
                'message' => 'Task Created Successfully'
            ], 200);
        } else {
            return response()->json([
                'status' => 500,
                'message' => 'Something Went Wrong!'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = Task::find($id);
        if ($task->count() > 0) {
            return response()->json([
                'status' => 200,
                'tasks' => $task
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'errors' => 'No Such Taks Found!'
            ], 404);
        }
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
            'name' => 'required|string',
            'sector_id' => 'required|numeric',
            'agree' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        }
        $task = Task::find($id);
        $task->update([
            'name' => $request->name,
            'sector_id' => $request->sector_id,
            'agree' => $request->agree,
        ]);

        if ($task) {
            return response()->json([
                'status' => 200,
                'message' => 'Task Update Successfully'
            ], 200);
        } else {
            return response()->json([
                'status' => 500,
                'message' => 'Something Went Wrong!'
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::find($id);
        $task->delete();
        if ($task) {
            return response()->json([
                'status' => 200,
                'message' => 'Task Deleted Successfully'
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'errors' => 'No Such Sector Found!'
            ], 404);
        }
    }
}
