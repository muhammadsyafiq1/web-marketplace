@extends('layouts.dashboard-user.index')

@section('title')
    Product
@endsection

@section('content')
<style>
    .dropdown-toggle::after 
    {
        display:none;
    }
</style>
<div class="section-content section-dashboard-home" data-aos="fade-up">
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title">My product</h2>
            <p class="dashboard-subtitle">
                Manage it well and get money
            </p>
        </div>
        <!-- section content -->
        <div class="dashboard-content">
            <div class="row">
                <div class="col-12">
                    <a href="{{ route('products.create') }}" class="btn btn-success">
                        Add new Product
                    </a>
                </div>
            </div>
            @if (session('info'))
            <div class="alert alert-danger p-2" style="margin-top: 30px;">
                <div class="text-center">
                    {{ session('info') }}
                </div>
            </div>
            @endif
            <div class="row mt-4">
                @forelse ($products as $product)
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="card-body card card-dashboard-product d-block">
                        <img src="{{ Storage::url($product->gallery->first()->image) }}" class="w-100 mb-2">
                            <div class="product-title">{{  $product->category->name }}</div>
                            <div class="product-subtitle">{{$product->name  }}</div>
                        <div class="dropdown no-arrow" style="margin-top: -10px;">
                            <a  class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                            </a>
                            <div class="dropdown-menu text-muted">
                                <form action="{{ route('products.destroy',$product->id) }}" method="POST" class="d-inline">
                                @method('DELETE')
                                @csrf
                                    <a class="dropdown-item" href="{{ route('products.show',$product->id) }}">Options</a>
                                    <a class="dropdown-item" href="#">Check Variant</a>
                                    <div class="dropdown-divider"></div>
                                    <button type="submit" class="btn btn-block btn-sm btn-danger">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="alert alert-primary text-center">
                    <h5>Belum Ada Product</h5>
                </div> 
                @endforelse
            </div>
            <div class="row">
                <div class="col-12">
                    {{$products->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
