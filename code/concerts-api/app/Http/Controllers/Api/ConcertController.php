<?php

namespace App\Http\Controllers\Api;

use App\Models\Concert;
use Illuminate\Http\Request;

class ConcertController extends BaseApiController
{
    public function index()
    {
        $concerts = Concert::with('venue')
            ->orderBy('event_date', 'asc')
            ->get()
            ->map(function ($c) {
                return [
                    'id'         => $c->id,
                    'title'      => $c->title,
                    'event_date' => $c->event_date,
                    'price'      => $c->price,
                    'venue_name' => $c->venue->name ?? null,
                    'city'       => $c->venue->city ?? null,
                ];
            });

        return response()->json($concerts);
    }

    public function show($id)
    {
        $concert = Concert::with('venue')->find($id);
        if (!$concert) {
            return response()->json(['error' => 'not found'], 404);
        }

        return response()->json([
            'id'         => $concert->id,
            'title'      => $concert->title,
            'event_date' => $concert->event_date,
            'price'      => $concert->price,
            'venue_id'   => $concert->venue_id,
            'venue_name' => $concert->venue->name ?? null,
            'city'       => $concert->venue->city ?? null,
        ]);
    }

    public function store(Request $request)
    {
        $this->requireUser($request);

        $data = $request->validate([
            'title'      => 'required|string',
            'venue_id'   => 'required|integer|exists:venues,id',
            'event_date' => 'required|date',
            'price'      => 'required|numeric',
        ]);

        $concert = Concert::create($data);

        return response()->json([
            'message' => 'concert created',
            'id'      => $concert->id,
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $this->requireUser($request);

        $concert = Concert::find($id);
        if (!$concert) {
            return response()->json(['error' => 'not found'], 404);
        }

        $data = $request->validate([
            'title'      => 'sometimes|string',
            'venue_id'   => 'sometimes|integer|exists:venues,id',
            'event_date' => 'sometimes|date',
            'price'      => 'sometimes|numeric',
        ]);

        $concert->update($data);

        return response()->json(['message' => 'concert updated']);
    }

    public function destroy(Request $request, $id)
    {
        $this->requireUser($request);

        $concert = Concert::find($id);
        if (!$concert) {
            return response()->json(['error' => 'not found'], 404);
        }

        $concert->delete();

        return response()->json(['message' => 'concert deleted']);
    }
}
