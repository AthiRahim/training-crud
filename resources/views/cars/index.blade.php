@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- untuk tambah alert -->
            @if(session()->has('alert'))
            <div class="alert {{ session()->get('alert-type')}}" role="alert">
                {{ session()->get('alert')}}
            </div>
            @endif

            <div class="card">
                <div class="card-header">{{ __('Car Index') }}
                    <div class="float-right">
                        <form actions="" method="">
                            <div class="input-group">
                                <input type="text" class="form-control" name="keyword" value="{{ request()->get('keyword')}}"/>
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit">Search</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <th>ID</th>
                            <th>Plate Number</th>
                            <th>User (Creator)</th>
                            <th>Actions</th>
                        </thead>
                        <tbody>
                            @foreach ($cars as $car)
                                <tr>
                                    <td>{{$car->id}}</td>
                                    <td>{{$car->plate_number}}</td>
                                    <td>{{$car->user->name}}</td>
                                    <td>
                                        <a href="{{ route('car:show', $car) }}" class="btn btn-primary">Show</a>
                                        <a href="{{ route('car:edit', $car) }}" class="btn btn-success">Edit</a>
                                        <a onclick="return confirm('Are You Sure')" href="{{ route('car:destroy', $car) }}" class="btn btn-danger">Delete</a>
                                        <hr>
                                        <a onclick="return confirm('Are You Sure')" href="{{ route('car:force-destroy', $car) }}" class="btn btn-danger">Force Delete</a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    {{ $cars->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
