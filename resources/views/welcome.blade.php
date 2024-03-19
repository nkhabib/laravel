@extends('template/main')
@section('content')
<button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Tambah Event</button>
<br><br>
@if(session('Success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong> <br>
    {{session('Success')}}
    <br>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if(session('Fail'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Fail!</strong> <br>
    {{session('Fail')}}
    <br>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if($errors->any())
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Warning!</strong> <br>
    @foreach($errors->all() as $error)
    {{$error}}
    <br>
    @endforeach
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div style="display: flex;">
    <div class="col-md-5">
        <form action="{{url('search')}}" method="post">
            @method('POST')
            @csrf
            <input type="text" name="judul_event" id="judul_event" class="form-control" placeholder="Ketik Pencarian">
        </form>
    </div>

    <div class="col-md-2"></div>
    <div class="col-md-5">
        <form action="{{url('sort')}}" method="post" name="sort">
            @method('POST')
            @csrf
            <div class="mb-3 row">
                <label for="sort" class="col-sm-3 col-form-label"><strong>Urutkan</strong></label>
                <div class="col-sm-9">
                    <select name="sort" id="sort" class="form-select sort-select">
                        <option value="">--Pilih--</option>
                        <option value="judul_event">Judul</option>
                        <option value="detail">Detail</option>
                        <option value="tgl">Tanggal</option>
                        <option value="waktu">Waktu</option>
                        <option value="tempat">Tempat</option>
                        <option value="penyelenggara">penyelenggara</option>
                    </select>
                </div>
            </div>
        </form>
    </div>
</div>
<br>
<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Judul Event</th>
            <th scope="col">Detail</th>
            <th scope="col">Tanggal</th>
            <th scope="col">Waktu</th>
            <th scope="col">Tempat</th>
            <th scope="col">Penyelenggara</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($events as $event)
        <tr>
            <th scope="row">{{ $events->count() * ($events->currentPage() - 1) + $loop->iteration }}</th>
            <td>{{$event->judul_event}}</td>
            <td>{{$event->detail}}</td>
            <td>{{$event->tgl}}</td>
            <td>{{$event->waktu}}</td>
            <td>{{$event->tempat}}</td>
            <td>{{$event->penyelenggara}}</td>
            <td style="display: flex;">
                <button class="btn btn-warning" style="margin-right:10px;" data-bs-toggle="modal" data-bs-target="#editEvent{{$event->id}}">Edit</button>
                <form action="{{url('deleteEvent'.$event->id)}}" method="post" class="formDelete">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger btn-delete">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{$events->links('template/pagination/custom')}}

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Tambah Event</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{url('addEvent')}}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="mb-3 row">
                        <label for="judul_event" class="col-sm-2 col-form-label"><strong>Judul</strong></label>
                        <div class="col-sm-10">
                            <input type="text" name="judul_event" id="judul_event" class="form-control" required value="{{old('judul_event')}}">
                            @error('judul_event')
                            <small style="color: red;">{{$message}}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="detail" class="col-sm-2 col-form-label"><strong>Detail</strong></label>
                        <div class="col-sm-10">
                            <textarea name="detail" id="detail" rows="5" class="form-control" required>{{old('detail')?old('detail'):false}}</textarea>
                            @error('detail')
                            <small style="color: red;">{{$message}}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="tgl" class="col-sm-2 col-form-label"><strong>Tanggal</strong></label>
                        <div class="col-sm-4">
                            <input type="date" class="form-control" id="tgl" name="tgl" required value="{{old('tgl')}}">
                            @error('tgl')
                            <small style="color: red;">{{$message}}</small>
                            @enderror
                        </div>

                        <label for="waktu" class="col-sm-2 col-form-label"><strong>Waktu</strong></label>
                        <div class="col-sm-4">
                            <input type="time" class="form-control" id="waktu" name="waktu" required value="{{old('waktu')}}">
                            @error('waktu')
                            <small style="color: red;">{{$message}}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="tempat" class="col-sm-2 col-form-label"><strong>Tempat</strong></label>
                        <div class="col-sm-10">
                            <input type="text" name="tempat" id="tempat" name="tempat" class="form-control" value="{{old('tempat')}}">
                            @error('tempat')
                            <small style="color: red;">{{$message}}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="penyelenggara" class="col-sm-2 col-form-label"><strong>Penyelenggara</strong></label>
                        <div class="col-sm-10">
                            <input type="text" name="penyelenggara" id="penyelenggara" class="form-control" value="{{old('penyelenggara')}}">
                            @error('penyelenggara')
                            <small style="color: red;">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- edit modal -->

@foreach($events as $event)
<div class="modal fade" id="editEvent{{$event->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Edit Event</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{url('updateEvent'.$event->id)}}" method="post">
                @method('PUT')
                @csrf
                <div class="modal-body">
                    <div class="mb-3 row">
                        <label for="edit_judul_event" class="col-sm-2 col-form-label"><strong>Judul</strong></label>
                        <div class="col-sm-10">
                            <input type="text" name="edit_judul_event" id="edit_judul_event" class="form-control" required value="{{old('edit_judul_event')?old('edit_judul_event'):$event->judul_event}}">
                            @error('edit_judul_event')
                            <small style="color: red;">{{$message}}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="edit_detail" class="col-sm-2 col-form-label"><strong>Detail</strong></label>
                        <div class="col-sm-10">
                            <textarea name="edit_detail" id="edit_detail" rows="5" class="form-control" required>{{old('edit_detail')?old('edit_detail'):$event->detail}}</textarea>
                            @error('edit_detail')
                            <small style="color: red;">{{$message}}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="edit_tgl" class="col-sm-2 col-form-label"><strong>Tanggal</strong></label>
                        <div class="col-sm-4">
                            <input type="date" class="form-control" id="edit_tgl" name="edit_tgl" required value="{{old('edit_tgl')?old('edit_tgl'):$event->tgl}}">
                            @error('edit_tgl')
                            <small style="color: red;">{{$message}}</small>
                            @enderror
                        </div>

                        <label for="edit_waktu" class="col-sm-2 col-form-label"><strong>Waktu</strong></label>
                        <div class="col-sm-4">
                            <input type="time" class="form-control" id="edit_waktu" name="edit_waktu" required value="{{old('edit_waktu')?old('edit_waktu'):$event->waktu}}">
                            @error('waktu')
                            <small style="color: red;">{{$message}}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="edit_tempat" class="col-sm-2 col-form-label"><strong>Tempat</strong></label>
                        <div class="col-sm-10">
                            <input type="text" name="edit_tempat" id="edit_tempat" class="form-control" value="{{old('edit_tempat')?old('edit_tempat'):$event->tempat}}">
                            @error('edit_tempat')
                            <small style="color: red;">{{$message}}</small>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="edit_penyelenggara" class="col-sm-2 col-form-label"><strong>Penyelenggara</strong></label>
                        <div class="col-sm-10">
                            <input type="text" name="edit_penyelenggara" id="edit_penyelenggara" class="form-control" value="{{old('edit_penyelenggara')?old('edit_penyelenggara'):$event->penyelenggara}}">
                            @error('edit_penyelenggara')
                            <small style="color: red;">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
<!-- end modal -->
@endsection