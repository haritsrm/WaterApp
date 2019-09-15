@extends('layouts.app')

@section('content')
<div class="panel panel-flat">
    <div class="panel-body">
        <table class="table datatable-basic">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Waktu</th>
                    <th>pH</th>
                    <th>Kekeruhan</th>
                    <th>Suhu</th>
                </tr>
            </thead>
            <tbody>
                {{! $counter = 1 }}
                @foreach($monitor as $key => $value)
                <tr>
                    <td>{{ $counter++ }}</td>
                    <td>{{ $value->created_at->format('d-m-Y') }}</td>
                    <td>{{ $value->created_at->format('H:i') }}</td>
                    <td>{{ $value->pH }}</td>
                    <td>{{ $value->turbidity }}</td>
                    <td>{{ $value->temperature }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <button class="btn btn-primary" style="margin: 0% 42%">Simpan data dan analisis</button>
    </div>
</div>
@endsection
