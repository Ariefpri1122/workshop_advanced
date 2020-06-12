<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use App\Room;
use Carbon\Carbon;

class RoomsController extends Controller
{
    //
    public function checkAvailableRooms($client_id, Request $request)
    {
        $dateFrom = Carbon::parse($request->input('dateFrom'))->format('Y-m-d');
        $dateTo = Carbon::parse($request->input('dateTo'))->format('Y-m-d');
        $client = new Client();
        $room = new Room();

        $data = [];
        $data['dateFrom'] = $dateFrom;
        $data['dateTo'] = $dateTo;
        $data['rooms']= $room->getAvailableRooms($dateFrom, $dateTo);
        $data['client'] = $client->find($client_id);

        return view('rooms/checkAvailableRooms', $data);
    }
}