@extends('layouts.app')

@section('content')
    <div class="panel panel-flat">
        <div class="panel-heading">
            <div class="heading-elements">
                <ul class="icons-list">
                    <li><a data-action="collapse"></a></li>
                    <li><a data-action="reload"></a></li>
                    <li><a data-action="close"></a></li>
                </ul>
            </div>
        </div>

        <div class="panel-body">
            <div class="chart-container">
                <div class="chart has-fixed-height" id="basic_lines"></div>
            </div>
        </div>
    </div>

@endsection
