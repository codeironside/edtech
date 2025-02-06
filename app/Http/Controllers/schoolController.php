<?php

namespace App\Http\Controllers;

use App\Models\schools;
use Illuminate\Http\Request;

class schoolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $fields = $request->validate([
                'Name' => 'required|string|unique:schools,Name',
                'description' => 'required|string',
                'type' => 'required|string',
                'email' => 'required|string|unique:schools,email',
                'address' => 'required|string',
                'phone_number' => 'required|string|unique:schools,phone_number'
            ]);

            $user = $request->user();

            
            $school = schools::create([
                'Name' => $fields['Name'],
                'description' => $fields['description'],
                'type' => $fields['type'],
                'email' => $fields['email'],
                'address' => $fields['address'],
                'phone_number' => $fields['phone_number'],
                'owner_id' => $user->id, 
            ]);
            $user->update(['role' => 'school owner']);

            return response()->json($school, 201);
        } catch (\Illuminate\Validation\ValidationException $e) {

            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
