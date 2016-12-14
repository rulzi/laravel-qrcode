@extends('layouts.app')

@section('body')

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">QR Code</div>

                <div class="panel-body">
                    <img src="{{ asset('qrcode.png') }}">
                </div>
            </div>
        </div>
    </div>
</div>

@endsection