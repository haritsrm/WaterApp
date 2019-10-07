@extends('layouts.app')

@section('content')
    <div class="panel panel-success">
        <div class="panel-heading">
            <h5 class="panel-title">Riwayat klasifikasi:</h5>
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>
        <div class="panel-body">
            <table class="table datatable-basic">
                <thead>
                <tr>
                    <th width="1">No</th>
                    <th>Tanggal</th>
                    <th>Waktu</th>
                    <th>Nama objek</th>
                    <th width="1">pH</th>
                    <th width="1">Kekeruhan</th>
                    <th width="1">Suhu</th>
                    <th>Kelas</th>
                    <th>Hapus?</th>
                </tr>
                </thead>
                <tbody>
                {{! $counter = 1 }}
                @foreach($result as $key => $value)
                    <tr>
                        <td>{{ $counter++ }}</td>
                        <td>{{ $value->created_at->format('d-m-Y') }}</td>
                        <td>{{ $value->created_at->format('H:i') }}</td>
                        <td>{{ $value->name }}</td>
                        <td>{{ $value->pH }}</td>
                        <td>{{ $value->turbidity }}</td>
                        <td>{{ $value->temperature }}</td>
                        <td><span class="label label-success">{{ $value->classes }}</span></td>
                        <td>
                            <form method="POST" action="{{ route('hapusRiwayat', $value->id) }}">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}

                                <div class="form-group">
                                    <button class="btn btn-danger" type="submit">Hapus</button>
                                </div>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
