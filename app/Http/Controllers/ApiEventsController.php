<?php

namespace App\Http\Controllers;

use App\Http\Resources\EventCollection;
use App\Http\Resources\EventResource;
use App\Http\Resources\EventSimpleCollection;
use App\Http\Resources\EventSimpleResource;
use App\Http\Resources\EventWrapResource;
use App\Models\Events;
use Illuminate\Http\Request;

class ApiEventsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Events::orderBy('created_at')->get();
        # return  EventResource::collection($events);
        # di atas digunakan jika ingin mengembalikan data dengan resource yang harusnya satuan bisa menjadi collectino
        # saran jangan gunakan cara di atas buat aja collection untuk response api dengan php artisan
        # php artisan make:resource EventCollection --collection
        return new EventCollection($events);
    }

    public function simple()
    {
        $events = Events::orderBy('created_at')->get();
        return new EventSimpleCollection($events);
    }

    public function wrapResource($id)
    {
        $events = Events::where('id', $id)->first();
        return new EventWrapResource($events);
    }

    public function pagination($page)
    {
        $events = Events::paginate(perPage: 2, page: $page);
        return new EventSimpleCollection($events);
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
        return new EventResource($event);
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
