@extends('layouts.app')

@section('content')
<table border=1>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>pH</th>
            <th>Suhu</th>
            <th>Kekeruhan</th>
            <th>Kelas</th>
        </tr>
    </thead>
    <tbody>
        {{! $i = 1 }}
        @foreach($trainings as $training)
        <tr>
            <td>{{ $i++ }}</td>
            <td>{{ $training->name }}</td>
            <td>{{ $training->pH }}</td>
            <td>{{ $training->temperature }}</td>
            <td>{{ $training->turbidity }}</td>
            <td>{{ $training->classes }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection