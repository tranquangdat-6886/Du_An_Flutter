<?php

namespace App\Http\Controllers\ApiController;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Attribute;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $attendances = Attendance::all();
        return response()->json($attendances);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $attendances = new Attendance;
        $attendances->EVE_ID = $request->input('EVE_ID');
        $attendances->STU_ID = $request->input('STU_ID');
        $attendances->createdDate = $request->input('createdDate');
        $attendances->save();
        return response()->json($attendances);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $attendances = Attendance::find($id);
        return response()->json($attendances);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $attendances = Attendance::find($id);
        $attendances->EVE_ID = $request->input('EVE_ID');
        $attendances->STU_ID = $request->input('STU_ID');
        $attendances->createdDate = $request->input('createdDate');
        $attendances->save();
        return response()->json($attendances);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $attendances = Attendance::find($id);
        $attendances->detele();
        return response()->json(['message' => 'Attendance deleted']);
    }
}
