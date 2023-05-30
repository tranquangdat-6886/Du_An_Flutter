<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Event;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function eveatendance($eveatendance)
    {
        $event = Event::find($eveatendance);
        $attendance = Attendance::WHERE('EVE_ID', $eveatendance)->get();
        // $attendance = Attendance::WHERE('EVE_ID', $event->EVE_ID)->get();
        return view('backend.pages.attendances.attendance')->with('attendance', $attendance)->with('event', $event);
    }
}