@extends('layouts.backend.index')

@section('title')
    Show Detail Category
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card shadow">
            <div class="card-body">
                <h5 class="text-center">Show category "{{ $category->name }}"</h5>
                <hr>
                @if ($category->photo)
                       <img src="{{ Storage::url($category->photo) }}" style="width: 80px">
                    @else
                        <p>Photo belum diset.</p>
                    @endif
                <div class="form-group mt-3">
                   <th>Name :</th>
                   <p>{{ $category->name }}</p>
                   <th>slug :</th> 
                   <p>{{ $category->slug }}</p>
                   <th>Created :</th>
                   <p>{{ date('d-M-y', strtotime($category->created_at)) }}</p>

                   <a href="{{ route('category.index') }}" class="btn btn-warning btn-sm mt-4">
                       <i class="fa fa-arrow-left text-white" ></i>
                   </a>
               </div>
            </div>
        </div>
    </div>
@endsection