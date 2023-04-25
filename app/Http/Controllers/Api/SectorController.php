<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Sector;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SectorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sector = Sector::latest()->get();
        if ($sector->count() > 0) {
            return response()->json([
                'status' => 200,
                'sectors' => $sector
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
            'name' => 'required|string|unique:sectors',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        }

        $sector = Sector::create([
            'name' => $request->name
        ]);

        if ($sector) {
            return response()->json([
                'status' => 200,
                'message' => 'Sector Created Successfully'
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
        $sector = Sector::find($id);
        if ($sector->count() > 0) {
            return response()->json([
                'status' => 200,
                'sectors' => $sector
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'errors' => 'No Such Sector Found!'
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
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        }
        $sector = Sector::find($id);
        $sector->update([
            'name' => $request->name,
            'status' => $request->status
        ]);

        if ($sector) {
            return response()->json([
                'status' => 200,
                'message' => 'Sector Update Successfully'
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
        $sector = Sector::find($id);
        $sector->delete();
        if($sector){
            return response()->json([
                'status'=>200,
                'message'=>'Sector Deleted Successfully'
            ],200);
        } else {
            return response()->json([
                'status' => 404,
                'errors' => 'No Such Sector Found!'
            ], 404);
        }
    }
}
