@extends('layouts.app')

@section('content')
    <div class="panel panel-flat">
        <div class="panel-body">
            <table class="table datatable-basic">
                <thead>
                <tr>
                    <th width="1">No</th>
                    <th>Nama air</th>
                    <th width="1">pH</th>
                    <th width="1">Kekeruhan</th>
                    <th width="1">Suhu</th>
                    <th>Tanggal</th>
                    <th>Waktu</th>
                    <th>Kelas</th>
                </tr>
                </thead>
                <tbody>
                {{! $counter = 1 }}
                @foreach($monitor as $key => $value)
                    <tr>
                        <td>{{ $counter++ }}</td>
                        <td>Sungai {{ $counter  }}</td>
                        <td>{{ $value->pH }}</td>
                        <td>{{ $value->turbidity }}</td>
                        <td>{{ $value->temperature }}</td>
                        <td>{{ $value->created_at->format('d-m-Y') }}</td>
                        <td>{{ $value->created_at->format('H:i') }}</td>
                        <td><span class="label label-success">IV</span></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
