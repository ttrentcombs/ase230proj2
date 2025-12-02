<?php

namespace App\Http\Controllers\Api;

use App\Models\Venue;
use Illuminate\Http\Request;

class VenueController extends BaseApiController
{
    public function index()
    {
        return response()->json(Venue::orderByDesc('id')->get());
    }

    public function show($id)
    {
        $venue = Venue::find($id);
        if (!$venue) {
            return response()->json(['error' => 'not found'], 404);
        }
        return response()->json($venue);
    }

    public function store(Request $request)
    {
        $this->requireUser($request); // require login

        $data = $request->validate([
            'name' => 'required|string',
            'city' => 'required|string',
        ]);

        $venue = Venue::create($data);

        return response()->json([
            'message' => 'venue added',
            'id'      => $venue->id,
        ], 201);
    }
}
