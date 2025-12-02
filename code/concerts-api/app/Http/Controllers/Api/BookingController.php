<?php

namespace App\Http\Controllers\Api;

use App\Models\Booking;
use App\Models\Concert;
use Illuminate\Http\Request;

class BookingController extends BaseApiController
{
    public function index(Request $request)
    {
        $user = $this->requireUser($request);

        $bookings = Booking::with('concert.venue')
            ->where('user_id', $user->id)
            ->orderByDesc('id')
            ->get()
            ->map(function ($b) {
                return [
                    'id'         => $b->id,
                    'qty'        => $b->qty,
                    'total'      => $b->total,
                    'created_at' => $b->created_at,
                    'title'      => $b->concert->title ?? null,
                    'event_date' => $b->concert->event_date ?? null,
                    'venue_name' => $b->concert->venue->name ?? null,
                    'city'       => $b->concert->venue->city ?? null,
                ];
            });

        return response()->json($bookings);
    }

    public function store(Request $request)
    {
        $user = $this->requireUser($request);

        $data = $request->validate([
            'concert_id' => 'required|integer|exists:concerts,id',
            'qty'        => 'sometimes|integer|min:1',
        ]);

        $qty = $data['qty'] ?? 1;

        $concert = Concert::find($data['concert_id']);
        if (!$concert) {
            return response()->json(['error' => 'concert not found'], 404);
        }

        $total = (float)$concert->price * $qty;

        $booking = Booking::create([
            'user_id'    => $user->id,
            'concert_id' => $concert->id,
            'qty'        => $qty,
            'total'      => $total,
        ]);

        return response()->json([
            'message' => 'booking created',
            'id'      => $booking->id,
            'total'   => $total,
        ], 201);
    }
}
