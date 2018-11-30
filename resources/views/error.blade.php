@extends('layouts.app')

@section('content')
    <div class="container preview">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">An Error Occurred</div>
                    <div class="card-body">
                        <p class="text-danger">Error Code: {{ $error['code'] }}</p>
                        <p class="text-danger">Error Message: {{ $error['message'] }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
