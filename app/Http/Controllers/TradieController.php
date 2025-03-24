<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tradie;

class TradieController extends Controller
{
    // Fetch all tradies
    public function index()
    {
        $tradies = Tradie::all();
        return response()->json([
            'message' => 'List of all tradies',
            'data' => $tradies
        ]);
    }

    // Store a new tradie
    public function store(Request $request)
    {
        // Validate request
        $request->validate([
            'name' => 'required|string|max:255',
            'trade' => 'required|string|max:255',
        ]);

        // Create new tradie
        $tradie = Tradie::create($request->all());

        return response()->json([
            'message' => 'Tradie created successfully',
            'data' => $tradie
        ], 201);
    }

    // Fetch a single tradie by ID
    public function show($id)
    {
        $tradie = Tradie::find($id);

        if (!$tradie) {
            return response()->json([
                'message' => 'Tradie not found'
            ], 404);
        }

        return response()->json([
            'message' => 'Tradie details',
            'data' => $tradie
        ]);
    }

    // Update an existing tradie
    public function update(Request $request, $id)
    {
        $tradie = Tradie::find($id);

        if (!$tradie) {
            return response()->json([
                'message' => 'Tradie not found'
            ], 404);
        }

        $request->validate([
            'name' => 'sometimes|string|max:255',
            'trade' => 'sometimes|string|max:255',
        ]);

        $tradie->update($request->all());

        return response()->json([
            'message' => 'Tradie updated successfully',
            'data' => $tradie
        ]);
    }

    // Delete a tradie
    public function destroy($id)
    {
        $tradie = Tradie::find($id);

        if (!$tradie) {
            return response()->json([
                'message' => 'Tradie not found'
            ], 404);
        }

        $tradie->delete();

        return response()->json([
            'message' => 'Tradie deleted successfully'
        ]);
    }
}
