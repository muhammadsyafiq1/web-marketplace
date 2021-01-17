@extends('layouts.backend.index')

@section('title')
    Show Detail product
@endsection

@section('content')
    <div class="container-fluid">
        <div class="card shadow">
            <div class="card-body">
                <h5 class="text-center">Show Profile "{{ $product->name }}"</h5>
                <hr>
                <div class="form-group mt-3">
                   <th>Name :</th>
                   <p>{{ $product->name }}</p>
                   <th>Category :</th> 
                   <p>{{ $product->category->name }}</p>
                   <th>Seller :</th>
                   <p>{{ $product->user->name }}</p>
                   <th>Created :</th>
                   <p>{{ date('d-M-y', strtotime($product->created_at)) }}</p>

                   <a href="{{ route('product.index') }}" class="btn btn-warning btn-sm mt-4">
                       <i class="fa fa-arrow-left text-white" ></i>
                   </a>
               </div>
            </div>
        </div>
    </div>
@endsection