@extends('layouts.app')

@section('content')
{{-- notifikasi form validasi --}}
@if ($errors->has('file'))
<span class="invalid-feedback" role="alert">
    <strong>{{ $errors->first('file') }}</strong>
</span>
@endif

{{-- notifikasi sukses --}}
@if ($sukses = Session::get('sukses'))
<div class="alert alert-success alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button> 
    <strong>{{ $sukses }}</strong>
</div>
@endif

<button type="button" class="btn btn-primary mr-5 mb-5" data-toggle="modal" data-target="#importExcel">
    Import Data Training
</button>

<!-- Import Excel -->
<div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="post" action="{{ route('importTraining') }}" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Import Data Training</h5>
                </div>
                <div class="modal-body">

                    {{ csrf_field() }}

                    <label>Pilih file excel</label>
                    <div class="form-group">
                        <input type="file" name="file" required="required">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Import</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="panel panel-flat">
    <div class="panel-body">
        <table class="table datatable-basic">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Sungai</th>
                    <th>pH</th>
                    <th>Kekeruhan</th>
                    <th>Suhu</th>
                    <th>Hapus?</th>
                </tr>
            </thead>
            <tbody>
                {{! $counter = 1 }}
                @foreach($trainings as $key => $value)
                <tr>
                    <td>{{ $counter++ }}</td>
                    <td>{{ $value->name }}</td>
                    <td>{{ $value->pH }}</td>
                    <td>{{ $value->turbidity }}</td>
                    <td>{{ $value->temperature }}</td>
                    <td>
                        <form method="POST" action="{{ route('hapusTraining', $value->id) }}">
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