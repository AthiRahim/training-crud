@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Car Edit') }}</div>

                <div class="card-body">
                    <form action="" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Plate Number</label>
                            <input type="text" name="plate_number" class="form-control" value="{{ $car->plate_number}}">
                        </div>
                        <div class="form-group">
                            <label>Model</label>
                            <textarea name="model" class="form-control">{{ $car->model }}</textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Update Cars</button>
                            <a class="btn btn-link" href="{{ route('car:index') }}">Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
