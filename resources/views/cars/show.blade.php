@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Car Show') }}</div>

                <div class="card-body">
                        <div class="form-group">
                            <label>Plate Number</label>
                            <input type="text" name="plate_number" class="form-control" value="{{ $car->plate_number }}" readonly>
                        </div>
                        <div class="form-group">
                            <label>Model</label>
                            <textarea name="model" class="form-control" readonly>{{ $car->model }}</textarea>
                        </div>
                        @if($car->attachment)
                        <div class="form-group">
                            <label>Attachment (if any)</label>
                            <a target="_blank" href ="{{asset('storage/'.$car->attachment)}}" class = "btn btn-warning">Open this attachment: {{$car->attachment}} </a>
                        </div>
                        @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
