@extends('layouts.backend.index')

@section('title')
    Show Detail color
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card shadow">
            <div class="card-body">
                <h5 class="text-center">Show color "{{ $color->name }}"</h5>
                <hr>
                <div class="form-group mt-3">
                   <th>Name :</th>
                   <p>{{ $color->name }}</p>
                   <th>Created :</th>
                   <p>{{ date('d-M-y', strtotime($color->created_at)) }}</p>

                   <a href="{{ route('color.index') }}" class="btn btn-warning btn-sm mt-4">
                       <i class="fa fa-arrow-left text-white" ></i>
                   </a>
               </div>
            </div>
        </div>
    </div>
@endsection