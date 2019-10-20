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
            <center><p>Klik pada nama objek untuk melihat detail analisis dari objek penelitian tersebut.</p></center>
            <table class="table datatable-basic">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Waktu</th>
                    <th>Nama objek</th>
                    <th>pH</th>
                    <th>Kekeruhan</th>
                    <th>Suhu</th>
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
                        <td><a onclick="initMap{{ $value->id }}()" data-toggle="modal" data-target="#modal_form_inline_{{ $value->id }}">{{ $value->name }}</a></td>
                        <td>{{ $value->pH }}</td>
                        <td>{{ $value->turbidity }}</td>
                        <td>{{ $value->temperature }}</td>
                        <td><span class="label label-success">{{ $value->classes }}</span></td>
                        <td>
                            <!-- Inline form modal -->
                            <div id="modal_form_inline_{{ $value->id }}" class="modal fade">
                                <div class="modal-dialog">
                                    <div class="modal-content text-center">
                                        <div class="modal-header bg-success">
                                            <h5 class="modal-title">{{ $value->name }}</h5>
                                        </div>
                                        <div class="modal-body">
                                            <div id="detail-map-{{ $value->id }}"></div>
                                            <script>
                                                function initMap{{ $value->id }}() {
                                                    var pin = "{{ number_format($value->latitude, 3) }},{{ number_format($value->longitude, 3) }}";
                                                    var img_url = "https://maps.googleapis.com/maps/api/staticmap?center="+pin+"&zoom=15&size=550x300&sensor=false&key={{ env('MAPS_API_KEY') }}";
                                                    document.getElementById("detail-map-{{ $value->id }}").innerHTML = "<img src='"+img_url+"'>";
                                                }
                                            </script>
                                            <p><strong>Maps link: </strong><a href="https://www.google.com/maps/search/?api=1&query={{ $value->latitude }},{{ $value->longitude }}">https://www.google.com/maps/search/?query={{ $value->latitude }},{{ $value->longitude }}</a></p>
                                            <hr>
                                            <div class="panel panel-success">           
                                                <div class="panel-heading">
                                                    <h5 class="panel-title">Hasil perhitungan analisis:</h5>
                                                </div>
                                                <div class="panel-body">
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
                                            <div class="panel panel-success">           
                                                <div class="panel-heading">
                                                    <h5 class="panel-title">Detail riwayat:</h5>
                                                </div>
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

                                <button class="btn btn-danger" type="submit">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
