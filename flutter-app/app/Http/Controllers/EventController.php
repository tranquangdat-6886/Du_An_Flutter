<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $event = Event::all();

        return view('backend.pages.events.list_event')->with('event', $event);
    }

    public function store(Request $request)
    {
        $event = new Event();
        $event->name = $request->input('name');
        $event->eventDate = $request->input('eventdate');

        $event->note = $request->input('note');
        $event->createdDate = now();
        $event->save();

        return redirect()->route('events.index')->with('message', "More Event Success");
    }
    //phần gọi ajax để chỉnh sửa thông tin

    public function update(Request $request, $event)
    {
        $eventupdate = Event::find($event);
        $eventupdate->name = $request->input('name');

        // Kiểm tra nếu eventDate được nhập vào
        if ($request->has('eventDate')) {
            $eventupdate->eventDate = $request->input('eventDate');
        }

        $eventupdate->updateDate = now();
        $eventupdate->note = $request->input('note');
        $eventupdate->save();

        return redirect()->route('events.index')->with('message', "Event Success Update");
    }
    public function destroy($event)
    {
        $eventdelete = Event::find($event);
        $eventdelete->delete();
        return redirect()->route('events.index')->with('message', "Successfully Delete Event");
    }

    public function editEvent($id)
    {
        // Xử lý yêu cầu AJAX và trả về dữ liệu tương ứng
        $event = Event::find($id);

        $response = [
            'eventName' => $event->name,
            'eventDate' => $event->eventDate,
            'note' => $event->note,
            // 'address' => $supplierstockoutdetaie->ADDRESS,
            // 'phone' => $supplier->PHONE,

        ];
        // Trả về dữ liệu
        return response()->json($response);
    }
}