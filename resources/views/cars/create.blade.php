@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Car Create') }}</div>

                <div class="card-body">
                    <form action="{{ route('car:store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Plate Number</label>
                            <input type="text" name="plate_number" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Model</label>
                            <textarea name="model" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Attachment</label>
                            <input type="file" name="attachment" class="form-control">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Add Cars</button>
                            <a class="btn btn-link" href="{{ route('car:index') }}">Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
