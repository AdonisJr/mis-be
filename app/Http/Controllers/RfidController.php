<?php

namespace App\Http\Controllers;

use App\Events\AssignRfid;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class RfidController extends Controller
{
    public function requestRfid(Request $request)
    {
        // Check if the admin is listening / channel is open
        if (!Cache::get('rfid_channel_opened')) {
            return response()->json([
                'status' => 'error',
                'message' => 'RFID request cannot be sent. Admin channel is closed.'
            ], 403);
        }

        // Broadcast the event to everyone except the sender
        Log::info('Broadcasting RFID assignment request: ' . $request->rfid);
        broadcast(new AssignRfid($request->rfid))->toOthers();

        return response()->json([
            'status' => 'success',
            'message' => 'RFID request sent to device.'
        ]);
    }

    public function openRfidChannel(Request $request)
    {
        Cache::put('rfid_channel_opened', true, 300);

        return response()->json([
            'status' => 'success',
            'message' => 'RFID channel opened for 5 minutes.'
        ]);
    }

    public function closeRfidChannel(Request $request)
    {
        Cache::forget('rfid_channel_opened');
        
        return response()->json([
            'status' => 'success',
            'message' => 'RFID channel closed.'
        ]);
    }
}
