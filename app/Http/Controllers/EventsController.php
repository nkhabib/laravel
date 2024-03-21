<?php

namespace App\Http\Controllers;

use App\Models\Events;
use GuzzleHttp\Client;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class EventsController extends Controller
{

    public function get(): View
    {
        $data = [
            'events' => Events::orderBy('created_at')->paginate(2),
            'title' => 'Laravel-App',
            'page' => 'Events',
        ];
        return view('welcome', $data);
    }

    public function sort($sort)
    {
        $data = [
            'events' => Events::orderBy($sort)->paginate(2),
            'title' => 'Sort By',
            'page' => 'Sort',
        ];
        return view('welcome', $data);
    }
    public function doSort(Request $request)
    {
        $sort = $request->sort;
        return redirect('events/' . $sort);
    }

    public function doAdd(Request $request)
    {
        $request->validate([
            'judul_event' => 'required|max:255',
            'detail' => 'required',
            'tgl' => 'required|date',
            'waktu' => 'required',
            'tempat' => 'required|max:255',
            'penyelenggara' => 'required|max:255',
        ]);

        $data = [
            'judul_event' => $request->judul_event,
            'detail' => $request->detail,
            'tgl' => $request->tgl,
            'waktu' => $request->waktu,
            'tempat' => $request->tempat,
            'penyelenggara' => $request->penyelenggara,
        ];

        $store = Events::create($data);
        if ($store) {
            return back()->with('Success', 'Event Ditambahkan');
        } else {
            return back()->with('Fail', 'Gagal menambahkan event');
        }
    }

    public function doUpdate(Request $request, $id)
    {
        $request->validate([
            'edit_judul_event' => 'required|max:255',
            'edit_detail' => 'required',
            'edit_tgl' => 'required|date',
            'edit_waktu' => 'required',
            'edit_tempat' => 'required|max:255',
            'edit_penyelenggara' => 'required|max:255',
        ]);

        $data = [
            'judul_event' => $request->edit_judul_event,
            'detail' => $request->edit_detail,
            'tgl' => $request->edit_tgl,
            'waktu' => $request->edit_waktu,
            'tempat' => $request->edit_tempat,
            'penyelenggara' => $request->edit_penyelenggara,
        ];

        $update = Events::where('id', $id)->update($data);
        if ($update) {
            return back()->with('Success', 'Event diupdate');
        } else {
            return back()->with('Fail', 'Event gagal diupdate');
        }
    }

    public function doDelete($id)
    {
        $delete = Events::where('id', $id)->delete();
        if ($delete) {
            return back()->with('Success', 'Event dihapus');
        } else {
            return back()->with('Fail', 'Event gagal dihapus');
        }
    }

    public function search(Request $request, $judul = '')
    {
        $judul = $request->judul_event;

        $result = Events::where('judul_event', 'like', '%' . $judul . '%')->paginate(2);

        $data = [
            'title' => 'Hasil Pencarian',
            'page' => 'Hasil Pencarian',
            'events' => $result,
        ];

        return view('welcome', $data);
    }

    public function front_get(Request $request)
    {
        $response = Http::get('https://jakarta-tourism.go.id/api/event');
        $events = $response->json();
        $data = [
            'title' => 'Front End',
            'page' => 'Front End',
            'events' => $events,
        ];

        return view('frontend', $data);
    }
}
