@extends('template/main')
@section('content')

<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Judul Event</th>
            <!-- <th scope="col">Konten</th> -->
            <th scope="col">Tanggal Mulai</th>
            <th scope="col">Tanggal Selesai</th>
            <th scope="col">Tempat</th>
            <th scope="col">Penyelenggara</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @php $no = 1 @endphp
        @foreach($events['data'] as $key => $event)

        <tr>
            <th scope="row">{{ $no }}</th>
            <td>{{$event['title']}}</td>
            <!-- <td>{!!$event['content']!!}</td> -->
            <td>{{$event['start_date']}}</td>
            <td>{{$event['end_date']}}</td>
            <td>{{$event['location_name']}}</td>
            <td>{{$event['partner_name']}}</td>
            <td style="display: flex;">
                <button class="btn btn-success" style="margin-right:10px;" data-bs-toggle="modal" data-bs-target="#lihatEvent{{$event['id']}}">Lihat</button>
            </td>
        </tr>

        @php $no++ @endphp
        @endforeach
    </tbody>
</table>

@foreach($events['data'] as $event)
<div class="modal fade" id="lihatEvent{{$event['id']}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Detail</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-header">
                <div class="modal-body">

                    <div class="mb-3 row">
                        <label class="col-sm-2"><strong>Judul</strong></label>
                        <div class="col-sm-10">
                            {{$event['title']}}
                        </div>
                    </div>

                    <div class=" mb-3 row">
                        <label class="col-sm-2"><strong>Konten</strong></label>
                        <div class="col-sm-10">
                            {!!$event['content']!!}
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label class="col-sm-2"><strong>Tanggal Mulai</strong></label>
                        <div class="col-sm-10">
                            {{$event['start_date']}}
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label class="col-sm-2"><strong>Tanggal Selesai</strong></label>
                        <div class="col-sm-10">
                            {{$event['end_date']}}
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label class="col-sm-2"><strong>Tempat</strong></label>
                        <div class="col-sm-10">
                            {{$event['location_name']}}
                        </div>
                    </div>


                    <div class="mb-3 row">
                        <label class="col-sm-2"><strong>Partner</strong></label>
                        <div class="col-sm-10">
                            {{$event['partner_name']}}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endforeach

@endsection