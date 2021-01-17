@extends('layouts.backend.index')

@section('title')
    Show Detail size
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card shadow">
            <div class="card-body">
                <h5 class="text-center">Show size "{{ $size->name }}"</h5>
                <hr>
                <div class="form-group mt-3">
                   <th>Name :</th>
                   <p>{{ $size->name }}</p>
                   <th>Created :</th>
                   <p>{{ date('d-M-y', strtotime($size->created_at)) }}</p>

                   <a href="{{ route('size.index') }}" class="btn btn-warning btn-sm mt-4">
                       <i class="fa fa-arrow-left text-white" ></i>
                   </a>
               </div>
            </div>
        </div>
    </div>
@endsection