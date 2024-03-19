<?php

namespace App\Http\Controllers;

use App\Models\Events;
use Illuminate\Http\Request;

class ApiEventsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Events::orderBy('created_at')->paginate(2);
        return response()->json(['data' => $events]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = [
            'judul_event' => $request->judul_event,
            'detail' => $request->detail,
            'tgl' => $request->tgl,
            'waktu' => $request->waktu,
            'tempat' => $request->tempat,
            'penyelenggara' => $request->penyelenggara,
        ];

        $event = Events::create($data);

        return response()->json(['data' => $event]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $event = Events::where('id', $id)->first();
        return response()->json(['data' => $event]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = [
            'judul_event' => $request->judul_event,
            'detail' => $request->detail,
            'tgl' => $request->tgl,
            'waktu' => $request->waktu,
            'tempat' => $request->tempat,
            'penyelenggara' => $request->penyelenggara,
        ];

        $event = Events::where('id', $id)->first();
        $update = $event->update($data);
        if ($update) {
            return response()->json(['data' => $event]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete = Events::where('id', $id)->delete();
        if ($delete) {
            return response()->json([
                'message' => 'event deleted',
            ], 204);
        }
    }
}
