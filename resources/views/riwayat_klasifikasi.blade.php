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
                            <button class="btn btn-primary" data-toggle="modal" data-target="#modal_form_inline_{{ $value->id }}">Details</button>
                            <!-- Inline form modal -->
                            <div id="modal_form_inline_{{ $value->id }}" class="modal fade">
                                <div class="modal-dialog">
                                    <div class="modal-content text-center">
                                        <div class="modal-header">
                                            <h5 class="modal-title">{{ $value->name }}</h5>
                                        </div>
                                        <div class="modal-body">
                                            <div id="detail-map"></div>
                                            <script>
                                                function initMap() {
                                                    var pin = {
                                                        lat: {{ number_format($value->latitude, 3) }}, 
                                                        lng: {{ number_format($value->longitude, 3) }}
                                                    };
                                                    var map = new google.maps.Map(
                                                        document.getElementById('detail-map'), {zoom: 15, center: pin});
                                                    var marker = new google.maps.Marker({position: pin, map: map});
                                                }
                                            </script>
                                            <p><strong>Maps link: </strong><a href="https://www.google.com/maps/search/?api=1&query={{ $value->latitude }},{{ $value->longitude }}">https://www.google.com/maps/search/?api=1&query={{ $value->latitude }},{{ $value->longitude }}</a></p>
                                            <div class="panel">
                                                <div class="panel-body">
                                                    <p>Berikut ini adalah hasil perhitungan berdasarkan proses analisis.</p>
                                                    <table class="table datatable-basic">
                                                        <thead>
                                                            <tr>
                                                                <th style="text-align:center">Kelas</th>
                                                                <th style="text-align:center">Hasil analisis</th>
                                                                <th style="text-align:center">Status</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            {{! $counter = 1 }}
                                                            @foreach(json_decode($value->analysis) as $key => $analysis)
                                                            <tr>
                                                                <td>{{ $analysis->class }}</td>
                                                                <td>{{ $analysis->num }}</td>
                                                                <td><span class="label label-success">{{ $analysis->class == $value->classes ? "Terpilih" : "" }}</span></td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="panel">
                                                <div class="panel-body">
                                                    <table class="table datatable-basic">
                                                        <thead>
                                                            <tr>
                                                                <th style="text-align:center">No</th>
                                                                <th style="text-align:center">Waktu</th>
                                                                <th style="text-align:center">pH</th>
                                                                <th style="text-align:center">Kekeruhan</th>
                                                                <th style="text-align:center">Suhu</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            {{! $counter = 1 }}
                                                            @foreach(json_decode($value->histories) as $key => $history)
                                                            <tr>
                                                                <td>{{ $counter++ }}</td>
                                                                <td>{{ $history->created_at }}</td>
                                                                <td>{{ $history->pH }}</td>
                                                                <td>{{ $history->turbidity }}</td>
                                                                <td>{{ $history->temperature }}</td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /inline form modal -->
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
